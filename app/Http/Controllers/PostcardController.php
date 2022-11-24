<?php

namespace App\Http\Controllers;
use Image;
use Illuminate\Http\Request;
use App\Models\Postcard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\User;

class PostcardController extends Controller
{
    public function index()
    {
        return view('createpostcard');
       #$img = Image::make(public_path('img/text.jpg'));  

       #$img->text('This is a example ', 120, 100);  

       #$img->save(public_path('img/hardik1.jpg'));
       
       #return $img->response(); 
    }

    public function generate(Request $request)
    {
        if(Auth::user()){
            $user = Auth::user();
        }
        else{
            return redirect('/welcome');
        }

        #Забираем данные которые ввёл пользователь
        $holiday = $request->input('holiday');
        $description = $request->input('description');
        $address =  $request->input('address');
        $type_holiday =  $request->input('type_holiday');
        $text =  $request->input('text');
        $address_list =  $request->file('address_list');

        #Сохраняем изображение
        $path = "img/" . uniqid()  . ".jpg";
        $request_image = $request->file('img');
        $image = Image::make($request_image);
        $image->text($text, 0, 0, function($font){
            $font->file('fonts/ofont.ru_Montserrat.ttf');
            $font->align('bottom');
            $font->valign('bottom');
            $font->size(48);
            $font->color('#000');  
        }); 


        if(!empty($address) && User::where("name", $address)->first())
        {
            $to_id = User::where("name", $address)->first();

            Postcard::create([
                'holiday' => $holiday,
                'img' => $path,
                'type_holiday' => $type_holiday,
                'text' => $text,
                'description' => $description,
                'to_id' => $to_id->id,
                'from_id' => $user->id,
            ]);
            $image->save(public_path($path));

        }
        // Иначе берём из списка 
        else
        {
            if(!empty($address_list))
            {
                //Читаем файл
                $array_to_id = collect([]);

                $content = File::get($address_list);
                $content_arrya = explode(",", $content);
                $i = 0;
                //Поиск всех пользователей из списка
                foreach( $content_arrya as $address)
                {

                    //Если пользователен найден, то добавляем в список
                    if(User::where("name", $address)->first())
                    {
                        
                        $array_to_id[] = User::where("name", $address)->first();
                        Postcard::create([
                            'holiday' => $holiday,
                            'img' => $path,
                            'type_holiday' => $type_holiday,
                            'text' => $text,
                            'description' => $description,
                            'to_id' => $array_to_id[$i]->id,
                            'from_id' => $user->id,
                        ]);
                        $image->save(public_path($path));
                        
                        
                    }
                    else{ }
                    $i++; 
                    
                }
                
                
            }
            //Если и списка нет, то возвращаем ошибку
            else
            {
                return redirect('/postcard');
            }
        }


        
        $image->save(public_path($path));
        return redirect('/postcard');


        #$path = "img/" . uniqid()  . ".jpg";
        #$request_image = $request->file('img');
        #$image = Image::make($request_image);
        #$image->text('This is a example ', 120, 100, function($font){
        #    $font->size(48);
        #    $font->color('#e1e1e1');  
        #});  
        #$image->save(public_path($path));
        #return redirect('/test');
    }
}
