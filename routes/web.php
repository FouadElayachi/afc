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

Route::get('/fr', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('welcomeAR');
});
Route::get('/التسجيل', function () {
    return view('auth.registerAR');
});
Route::get('/الدخول', function () {
    return view('auth.loginAR');
});
Route::get('/الرئيسية', function () {
    return view('homeAR');
})->middleware('auth');

Auth::routes();
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');

/**
 * Administration
*/
Route::resource('/administration', 'UserController');
Route::get('/administration/util/endregister', 'UserController@indexRegistred');
Route::get('/administration/active/{id}', 'UserController@active');

/**
 * Administration 2
*/
Route::get('/administration2', 'UserController@index2');
Route::get('/administration2/{id}', 'UserController@show2');


Route::resource('/form', 'FormController');

