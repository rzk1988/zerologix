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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('post', 'Api\TweetController@post');
Route::post('reply', 'Api\TweetController@reply');
Route::post('retweet', 'Api\TweetController@retweet');
Route::post('like', 'Api\TweetController@like');
Route::get('timeline', 'Api\TweetController@timeline');