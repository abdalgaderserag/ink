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


Route::middleware('auth:api')->group(function () {


    Route::get('/inks/{type}', 'Api\Inks');

    Route::get('/ink/{type}', 'Api\InkController@all');
    Route::post('/create-ink', 'Api\InkController@store');
    Route::put('/edit-ink/{media}', 'Api\InkController@update');
    Route::delete('/delete-ink/{ink}', 'Api\InkController@destroy');

    Route::get('/show-ink/{ink}', 'Api\InkController@show');


    Route::post('/create-comment', 'Api\CommentController@store');
    Route::get('/show-comment/{comment}', 'Api\CommentController@show');
    Route::put('/edit-comment/{media}', 'Api\CommentController@update');
    Route::delete('/delete-comment/{comment}', 'Api\CommentController@destroy');

    Route::post('/upload', 'Api\UploadController');

    Route::post('/interest', 'Api\InterestController');


    Route::post('/like', 'Api\LikeController');

    Route::post('/follow', 'Api\FollowController');


    Route::get('/ink', 'Api\InkController@index');


    Route::get('/notification', 'Api\NotificationController@index');
    Route::get('/notification/mark-all-as-read', 'Api\NotificationController@markAllAsRead');
    Route::get('/notification/{id}/mark-as-read', 'Api\NotificationController@markAsRead');
    Route::get('/notification/delete', 'Api\NotificationController@deleteAllRead');
});
