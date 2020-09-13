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
Route::get('/top', 'User\CoordinationController@top');

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function() {
    
    Route::get('coordination/create', 'User\CoordinationController@add');
    Route::post('coordination/create', 'User\CoordinationController@create');
    //Route::get('coordination', 'User\CoordinationController@index');
    Route::get('coordination/edit', 'User\CoordinationController@edit');
    Route::post('coordination/edit', 'User\CoordinationController@update');
    Route::get('coordination/delete', 'User\CoordinationController@delete')->name('delete');
    Route::post('coordination/delete', 'User\CoordinationController@delete')->name('delete');
    Route::get('coordination/show', 'User\CoordinationController@show')->name('show');
    
    Route::get('profile/create', 'User\ProfileController@add');
    Route::post('profile/create', 'User\ProfileController@create');
    Route::get('profile/edit', 'User\ProfileController@edit');
    Route::post('profile/edit', 'User\ProfileController@update');
    Route::get('profile/delete', 'User\ProfileController@delete');
    Route::get('profile/mypages', 'User\ProfileController@mypages');
});

//いいね！関連
Route::group(['prefix' => 'posts', 'middleware' => 'auth'], function() {
    Route::put('/{post}/like', 'User\CoordinationController@like')->name('like');
    Route::delete('/{post}/like', 'User\CoordinationController@unlike')->name('unlike');
    Route::get('/{id}/likes', 'User\ProfileController@likes')->name('likes');
});


Auth::routes();
    // ログイン状態
    Route::group(['middleware' => 'auth'], function() {
    // ユーザ関連
    //Route::resource('users', 'User\ProfileController', ['only' => ['index', 'show', 'edit', 'update']]);


    //フォロー関連
Route::group(['prefix' => 'user/{id}', 'middleware' => 'auth'], function () {
    Route::get('followings', 'User\ProfileController@followings')->name('followings');
    Route::get('followers', 'User\ProfileController@followers')->name('followers');
    });

    // ログイン認証通過したユーザだけが「フォロー」「フォロー解除」を実行できる
Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'user/{id}'], function () {
        Route::match(['get', 'post'], 'follow', 'User\FollowController@store')->name('follow');
        Route::match(['get', 'post'], 'unfollow', 'User\FollowController@destroy')->name('unfollow');
        
        Route::resource('posts', 'User\ProfileController', ['only' =>['create', 'store', 'destroy']]);
    });
    
});    

}); 