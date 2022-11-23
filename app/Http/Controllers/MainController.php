<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Postcard;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MainController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        //Список полученных открыток
        $list_postcard = Postcard::where("to_id", $id)->get("img");

        //Список отправленных открыток
        $list_postcard_send = Postcard::where("from_id", $id)->get("img");
        return view ('main', compact('list_postcard','list_postcard_send'));
    }
    
}
