<?php

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


Route::group(['prefix' => 'user', 'middleware' => 'auth'], function() {
    
    Route::get('coordination/create', 'User\CoordinationController@add');
    Route::post('coordination/create', 'User\CoordinationController@create');
    
    // ↓↓投稿一覧をmypagesへ表示させるため不要↓↓
    //Route::get('coordination/upload' , 'User\CoordinationController@upload');
    
    Route::get('coordination', 'User\CoordinationController@index');
    
    Route::get('coordination/edit', 'User\CoordinationController@edit');
    Route::post('coordination/edit', 'User\CoordinationController@update');
    
    Route::get('coordination/delete', 'User\CoordinationController@delete');

    
    
    
    Route::get('profile/create', 'User\ProfileController@add');
    Route::post('profile/create', 'User\ProfileController@create');
    
    
    
    Route::get('profile/edit', 'User\ProfileController@edit');
    Route::post('profile/edit', 'User\ProfileController@update');
    
    Route::get('profile/mypages', 'User\ProfileController@mypages');
    Route::get('profile/toppages', 'User\ProfileController@toppages');
    Route::get('profile/othermypages', 'User\ProfileController@othermypages');
    
    
    //Route::post('/posts/{psot}/likes', 'AjaxlikeController@store');
    //Route::post('/post/{post}/likes/{like}', 'AjaxlikeController@destroy');
    
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
