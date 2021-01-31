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



//-----------------------------------BASIC ROUTES------------------------------------------------------------------------------//
Route::get('/', function () {
    return view('login');
});

//---------------------------------ROUTES FROM FORMS TO CONTROLLERS ------------------------------------------------------------//
Route::post('/log_in', 'LoginController@LogIn');

Route::post('/sign_up', 'LoginController@SignUp');

//-----------------------------------ROUTES FOR VIEWS THAT NEED DATA TO START--------------------------------------------------//
Route::get('/Accept_Fans','AdminController@AcceptFans');
Route::get('/Accept_Mangers','AdminController@AcceptManagers');



//------------------------------------POST REQUESTS-----------------------------------------------------------------------//
Route::get('/Approve_User','AdminController@ApproveUser');


