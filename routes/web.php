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
    return view('top');
});

Route::get('/top', 'User\CoordinationController@new_index')->name('new_index');

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
    Route::get('/top', 'User\ProfileController@top');
    
    //test
    Route::get('profile/test', 'User\ProfileController@test');
});

    //いいね！関連
Route::prefix('posts')->name('posts.')->group(function () {
    Route::put('/{post}/like', 'User\CoordinationController@like')->name('like')->middleware('auth');
    Route::delete('/{post}/like', 'User\CoordinationController@unlike')->name('unlike')->middleware('auth');

});


Auth::routes();
    // ログイン状態
    Route::group(['middleware' => 'auth'], function() {
    // ユーザ関連
    Route::resource('users', 'User\ProfileController', ['only' => ['index', 'show', 'edit', 'update']]);


    //フォロー関連
Route::group(['prefix' => 'users/{id}'], function () {
    Route::get('followings', 'User\ProfileController@followings')->name('followings');
    Route::get('followers', 'User\ProfileController@followers')->name('followers');
    });

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::match(['get', 'post'], 'follow', 'User\FollowController@store')->name('follow');
        Route::match(['get', 'post'], 'unfollow', 'User\FollowController@destroy')->name('unfollow');
        
        Route::resource('posts', 'User\ProfileController', ['only' =>['create', 'store', 'destroy']]);
    });
    
});    

}); 