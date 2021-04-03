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
    if(isset($_COOKIE['type']) && $_COOKIE['type']=="Admin"){
        return View('/admin');
    }
    return view('login');

});

//---------------------------------ROUTES FROM FORMS TO CONTROLLERS ------------------------------------------------------------//
Route::post('/log_in', 'LoginController@LogIn');

Route::post('/sign_up', 'LoginController@SignUp');

Route::post('/log_out', 'LoginController@LogOut');

Route::post('/Edit_Profile','ProfileController@EditProfile');

//-----------------------------------ROUTES FOR VIEWS THAT NEED DATA TO START--------------------------------------------------//
Route::get('/Accept_Fans','AdminController@AcceptFans');
Route::get('/View_Reservations','ViewReservationsController@ViewReservations');
Route::get('/Accept_Mangers','AdminController@AcceptManagers');
Route::get('/Remove_Users','AdminController@RemoveUsersSite');
Route::get('/Match_Details','MatchDetailsController@GetMatchDetails');
Route::get('/View_Profile','ProfileController@ViewProfile');

//------------------------------------POST REQUESTS-----------------------------------------------------------------------//
Route::get('/Approve_User','AdminController@ApproveUser');
Route::get('/Remove_One_User','AdminController@RemoveUser');
Route::get('/Cancel_Reservations','ViewReservationsController@CancelReservations');




