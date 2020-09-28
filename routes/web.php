<?php

use Illuminate\Support\Facades\Route;

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



Route::get('/Contact', function () {
    return view('Contact');
});

Route::get('/About', function () {
    return view('About');
});

Route::get('/Login', function () {
    return view('Login');
});

Route::prefix('Post')->middleware('auth')->group(function(){
    Route::get('/create', 'PostController@create')->middleware("auth");

    Route::post('/store', 'PostController@store');

    Route::get('/{post:slug}/edit', 'PostController@edit');

    Route::patch('/{post:slug}/edit', 'PostController@update');
    
    Route::delete('/{post:slug}/delete', 'PostController@destroy');
});

Route::get('/Post', 'PostController@index')->name('post.index');

Route::get('/Category/{category:slug}', 'CategoryController@show');
Route::get('/Post/{post:slug}', 'PostController@show');
Route::get('/Tag/{tag:slug}', 'TagController@show');
Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
