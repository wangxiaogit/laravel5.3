<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:api');

Route::group(['namespace'=>'Api'], function () {
    Route::get('commentable/{commentableId}/comment', 'CommentController@show');
    Route::post('comments', 'CommentController@store')->middleware('auth:api');
    Route::delete('comments/{id}', 'CommentController@destroy')->middleware('auth:api');
});
