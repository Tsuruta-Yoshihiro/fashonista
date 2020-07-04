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
    
    Route::get('/profile', 'User\ProfileController@index')->name('user.index');
    Route::get('profile/edit', 'User\ProfileController@edit')->name('user.edit');
    Route::post('profile/edit', 'User\ProfileController@update')->name('user.update');
    
    Route::get('profile/mypages', 'User\ProfileController@mypages');
    Route::get('profile/toppages', 'User\ProfileController@toppages');
    Route::get('profile/othermypages', 'User\ProfileController@othermypages');
    
});
    //いいね！
Route::prefix('posts')->name('posts.')->group(function () {
    Route::put('/{post}/like', 'User\CoordinationController@like')->name('like')->middleware('auth');
    Route::delete('/{post}/like', 'User\CoordinationController@unlike')->name('unlike')->middleware('auth');

});
    //フォロー
Route::prefix('users')->name('users')->group(function() {
    Route::post('follow', 'User\ProfileController@follow');
    Route::post('unfollow', 'User\ProfileController@unfollow');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
