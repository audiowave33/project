<?php

namespace App\Http\Controllers;
use Image;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
       $img = Image::make(public_path('img/text.jpg'));  

       $img->text('This is a example ', 120, 100);  

       $img->save(public_path('img/hardik1.jpg'));
       
       return $img->response(); 
    }
}
