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
    Route::get('coordination', 'User\CoordinationController@index');
    Route::get('coordination/edit', 'User\CoordinationController@edit');
    Route::post('coordination/edit', 'User\CoordinationController@update');
    Route::get('coordination/delete', 'User\CoordinationController@delete');
    
    Route::get('profile/create', 'User\ProfileController@add');
    Route::post('profile/create', 'User\ProfileController@create');
    
    
    Route::get('profile/edit', 'User\ProfileController@edit');
    Route::post('profile/edit', 'User\ProfileController@update');
    Route::get('profile/delete', 'User\ProfileController@delete');
    
    Route::get('profile/mypages', 'User\ProfileController@mypages');
    Route::get('profile/toppages', 'User\ProfileController@toppages');
    
});

    //いいね！
Route::prefix('posts')->name('posts.')->group(function () {
    Route::put('/{post}/like', 'User\CoordinationController@like')->name('like')->middleware('auth');
    Route::delete('/{post}/like', 'User\CoordinationController@unlike')->name('unlike')->middleware('auth');

});

    //フォロー
Route::resource('users', 'User\ProfileController', ['only' => ['show']]);

Route::group(['prefix' => 'users/{id}'], function () {
    Route::get('followings', 'User\ProfileController@followings')->name('followings');
    Route::get('followers', 'User\ProfileController@followers')->name('followers');
    });

Route::group(['middleware' => 'auth'], function () {
    //Route::post('users', 'User\ProfileController@rename')->name('');
    
    Route::group(['prefix' => 'users/{id}'], function (){
        Route::post('follow', 'User\FollowController@store')->name('follow');
        Route::delete('unfollow', 'User\FollowController@destroy')->name('unfollow');
        
        Route::resource('posts', 'User\ProfileController', ['only' =>['create', 'store', 'destroy']]);
    });
    
});    



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
