<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postcard;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::id();
        //Список полученных открыток
        //$list_postcard = Postcard::where("to_id", $id)->get(["img",'holiday','text'])->paginate(10);

        $list_postcard = Postcard::where("to_id", $id)->paginate(10);

        //Список отправленных открыток
        $list_postcard_send = Postcard::where("from_id", $id)->latest(5);
        return view ('main', compact('list_postcard','list_postcard_send'));

    }

    public function check()
    {
        $id = Auth::id();
        //Список полученных открыток
        $list_postcard = Postcard::where(["to_id" => $id, "notify" => "no"])->get();
        //dd(User::where("id", $list_postcard[0]->id)->first("name"));
        $name_list = [];
        foreach($list_postcard as $from_id){
            $name_list[] = User::where("id", $from_id->from_id)->get("name");
            
          
        }
      
        if(empty($list_postcard[0])){
            return response(['error' => true, 'error-msg' => 'Not found'], 404);
        }
        $users = User::where("id", $list_postcard[0]->to_id);
        //Список отправленных открыток
        #$list_postcard_send = Postcard::where("from_id", $id)->get("img");

        foreach ($list_postcard as $list){
            //print_r($list->id);
            Postcard::where(["to_id" => $id, "notify" => "no"])->update(['notify' => 'yes']);
        }
        return response((["name" => $name_list[0][0]->name]),200)->header('Content-Type', 'text/plain');
        

    }
}
