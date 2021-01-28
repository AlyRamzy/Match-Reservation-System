<?php

use Illuminate\Support\Facades\Route;

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
    return view('login');
});





//---------------------------------ROUTES FROM FORMS TO CONTROLLERS ------------------------------------------------------------//
Route::post('/log_in', 'LoginController@ValnLog');

Route::post('/sign_up', 'LoginController@SignUp');

Route::post('/change_password', 'LoginController@ChangePassword');

Route::post('/logout', 'LoginController@LogOut');
