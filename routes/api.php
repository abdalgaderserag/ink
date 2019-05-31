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


Route::get('/ink/{type}','Api\InkController@all');
Route::post('/create-ink','Api\InkController@store');
Route::put('/edit-ink','Api\InkController@update');
Route::delete('/delete-ink/{ink}','Api\InkController@destroy');


Route::get('/show-ink/{ink}','Api\InkController@show');


Route::post('/create-comment','Api\CommentController@store');
Route::get('/show-comment/{comment}','Api\CommentController@show');
Route::put('/edit-comment','Api\CommentController@update');
Route::delete('/delete-comment/{comment}','Api\CommentController@destroy');


Route::post('/upload','Api\UploadController@upload');


Route::post('/like','Api\InteractController@like');
Route::post('/like/check','Api\InteractController@likeCheck');
Route::post('/share','Api\InteractController@share');

Route::get('/ink','Api\InkController@index');

