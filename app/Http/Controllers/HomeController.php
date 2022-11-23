<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postcard;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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
        $list_postcard = Postcard::where("to_id", $id)->get(["img",'holiday','text']);
        
        //Список отправленных открыток
        $list_postcard_send = Postcard::where("from_id", $id)->get("img");
        return view ('main', compact('list_postcard','list_postcard_send'));

    }

    public function check()
    {
        $id = Auth::id();
        //Список полученных открыток
        $list_postcard = Postcard::where(["to_id" => $id, "notify" => "no"])->get(["id","img",'holiday','text']);
        //Список отправленных открыток
        #$list_postcard_send = Postcard::where("from_id", $id)->get("img");

        foreach ($list_postcard as $list){
            //print_r($list->id);
            Postcard::where(["to_id" => $id, "notify" => "no"])->update(['notify' => 'yes']);
        }
        return response()->json($list_postcard);

    }
}
