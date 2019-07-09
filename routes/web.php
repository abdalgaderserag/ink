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

Route::get('/','HomeController@index');



Route::get('/login','Auth\LoginController@showLoginForm')->name('login');
Route::post('/login','Auth\LoginController@login');
Route::post('/logout','Auth\LoginController@logout')->name('logout');
Route::post('/password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/reset','Auth\ResetPasswordController@reset')->name('password.update');
Route::get('/password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('register','Auth\RegisterController@register')->name('register');



Route::get('/home', 'HomeController@index')->name('home');
Route::get('/search', 'HomeController@search')->name('search');



//Route::get('/download/{path}', 'Api\DownloadController');




Route::get('/profile/{slug?}', 'ProfileController@index')->name('profile');
Route::get('/profile/user/edit', 'profileController@edit')->name('profile.edit');
Route::put('/profile/{user}', 'profileController@update')->name('profile.update');
Route::delete('/profile/{user}', 'profileController@update')->name('profile.destroy');