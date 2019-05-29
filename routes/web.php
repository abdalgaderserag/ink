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
    return redirect('/login');
});

//Auth::routes();

Route::get('/login','Auth\LoginController@showLoginForm')->name('login');

Route::post('/login','Auth\LoginController@login');

Route::post('/logout','Auth\LoginController@logout')->name('logout');

Route::post('/password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

Route::get('/password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');

Route::post('/password/reset','Auth\ResetPasswordController@reset')->name('password.update');

Route::get('/password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');

Route::post('register','Auth\RegisterController@register')->name('register');



Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile/{slug?}', 'HomeController@profile')->name('profile');
