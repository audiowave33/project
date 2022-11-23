<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostcardController;
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
Route::get('/postcard', [PostcardController::class, 'index']);
Route::post('/create-postcard', [PostcardController:: class, 'generate']);

Route::get('/postcardlayout', [PostcardController::class, 'index']);
Route::post('/create-postcardlayout', [PostcardController:: class, 'generate']);

Route::get('/main', [MainController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
