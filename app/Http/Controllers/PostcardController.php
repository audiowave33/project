<?php

namespace App\Http\Controllers;
use Image;
use Illuminate\Http\Request;
use App\Models\Postcard;
use Illuminate\Support\Facades\Auth;
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

        if(User::where("name", $address)->first()){
            $to_id = User::where("name", $address)->first();
        }
        else{
            return redirect('/postcard');
        }

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
