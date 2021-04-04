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
    return  redirect ('match_list');
});

Route::get('/login', function () {
    if(isset($_COOKIE['type']) && $_COOKIE['type']=="Admin"){
        return View('/admin');
    } elseif (isset($_COOKIE['type'])&& $_COOKIE['type']=="Fan") {
       return  redirect ('match_list');
    } 
    elseif (isset($_COOKIE['type'])&& $_COOKIE['type']=="Manager") {
        return  redirect ('match_list');
    } 
    return view('login');
});

// Route::get('/add_match', function () {
//     if(isset($_COOKIE['type']) && $_COOKIE['type']=="Manager"){
//         return View('/add_match');
//     }
//     return redirect('/');
// });

Route::get('/add_stadium', function () {
    if(isset($_COOKIE['type']) && $_COOKIE['type']=="Manager"){
        return View('/add_stadium');
    }
    return redirect('/');
});

//---------------------------------ROUTES FROM FORMS TO CONTROLLERS ------------------------------------------------------------//
Route::post('/log_in', 'LoginController@LogIn');

Route::post('/sign_up', 'LoginController@SignUp');

Route::post('/log_out', 'LoginController@LogOut');
Route::post('/ConfirmReservation','ReserveController@Confirm');
Route::post('/submit_match','EditMatchController@Submit');

Route::post('/submit_stadium','AddStadiumController@Submit');


Route::post('/Edit_Profile','ProfileController@Edit_Profile');
Route::post('/Edit_Password','ProfileController@Edit_Password');

//-----------------------------------ROUTES FOR VIEWS THAT NEED DATA TO START--------------------------------------------------//
Route::get('/Accept_Fans','AdminController@AcceptFans');
Route::get('/View_Reservations','ViewReservationsController@ViewReservations');
Route::get('/Accept_Mangers','AdminController@AcceptManagers');
Route::get('/Remove_Users','AdminController@RemoveUsersSite');
Route::get('/Match_Details','MatchDetailsController@GetMatchDetails');
Route::get('/View_Profile','ProfileController@ViewProfile');
Route::get('/Reserve','ReserveController@Reserve');
Route::get('/Accept_Fans', 'AdminController@AcceptFans');
Route::get('/Accept_Mangers', 'AdminController@AcceptManagers');
Route::get('/Remove_Users', 'AdminController@RemoveUsersSite');
Route::get('/Match_Details', 'MatchDetailsController@GetMatchDetails');
Route::get('/match_list', 'MatchListController@GetMatchList');
Route::get('/edit_match', 'EditMatchController@GetMatchDetails');
Route::get('/Reserved_Seats', 'MatchDetailsController@GetReservedSeats');
Route::get('/add_match', 'EditMatchController@GetMatchDetails');


//------------------------------------POST REQUESTS-----------------------------------------------------------------------//
Route::get('/Approve_User','AdminController@ApproveUser');
Route::get('/Remove_One_User','AdminController@RemoveUser');
Route::get('/Cancel_Reservations','ViewReservationsController@CancelReservations');




