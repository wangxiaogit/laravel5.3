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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

//password
Route::get('password/change', 'UserController@changePassword' )->middleware('auth');

// Tag
Route::group(['prefix'=>'tag'], function () {
    Route::get('/', 'TagController@index');
    Route::get('{tag}', 'TagController@show');
});

//Category
Route::group(['prefix'=> 'category'], function () {
    Route::get('/', 'CategoryController@index');
    Route::get('{category}', 'CategoryController@show');
});

//user
Route::group(['prefix'=>'user'], function (){
    Route::get('/', 'UserController@index');

    Route::group(['middleware'=>'auth'], function (){
        Route::get('profile', 'UserController@edit');
        Route::post('avatar', 'UserController@avatar');
        Route::put('profile/{id}', 'UserController@update');
        Route::post('follow/{id}', 'UserController@doFollow');
    });
    Route::group(['prefix'=>'{username}'], function (){
        Route::get('/', 'UserController@show');
        Route::get('following', 'UserController@following');
        Route::get('discussions', 'UserController@discussions');
        Route::get('comments', 'UserController@comments');
    });
});

// User Setting
Route::group(['middleware' => 'auth', 'prefix' => 'setting'], function () {
    Route::get('/', 'SettingController@index')->name('setting.index');
    Route::get('binding', 'SettingController@binding')->name('setting.binding');

    Route::get('notification', 'SettingController@notification')->name('setting.notification');
    Route::post('notification', 'SettingController@setNotification');
});

// Article
Route::get('/', 'ArticleController@index');
Route::get('{slug}', 'ArticleController@show');
