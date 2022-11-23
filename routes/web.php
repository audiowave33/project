<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostcardController;
use App\Http\Controllers\PostCardLayoutController;
use App\Http\Controllers\MainController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//Загрузка собсвтенного шаблона с поздравлением
Route::get('/postcard', [PostcardController::class, 'index']);
Route::post('/create-postcard', [PostcardController:: class, 'generate']);

//Загрузка готового шаблона (ещё не работает)
Route::get('/postcardlayout', [PostCardLayoutController::class, 'index']);
Route::post('/create-postcardlayout', [PostCardLayoutController::class, 'generate']);


//Проверка увдомлений
Route::get('/check',[App\Http\Controllers\HomeController:: class, 'check']);

//Route::get('/main', [MainController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
