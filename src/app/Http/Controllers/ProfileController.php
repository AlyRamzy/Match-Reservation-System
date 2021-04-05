<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
Use Crypt;
use DB;
use Session;
class ProfileController extends Controller
{
    public function Edit_Password ()
    {
       
        $conn =mysqli_connect("localhost", "dbuser", "", "Match_System");
        if(!$conn)
        {
            die('Could not connect '.mysqli_error());
        }
        #Fetch Data From Request 
        
       $password = request("password");
       
        $password = Hash::make($password);
        $sql = 'Update User set password ="'.$password.'" where user_name ="'.$_COOKIE['user'].'" ';
        $result = mysqli_query($conn,$sql);
        
    
    return   ProfileController::ViewProfile();
    }
    public function Edit_Profile ()
    {
        
    #Connect With Database
    $conn =mysqli_connect("localhost", "dbuser", "", "Match_System");
    if(!$conn)
    {
        die('Could not connect '.mysqli_error());
    }
    #Fetch Data From Request 
    $username_signup_error = $password_signup_error = $firstname_signup_error = $lastname_signup_error = $city_signup_error = $email_signup_error = "";

    $username = request("username");
    $firstname = request("firstname");
    $lastname = request("lastname");
    $birthdate = request("birthdate");
    $address = request("address");
    $city = request("city");
    $email = request("email");
    $gender = request("gender");
    

   
    if(empty($address))
    {
        
        $address = NULL;
    }
   

    #update  Database

    #$password = Hash::make($password);
    $sql4 = 'Update User set user_name ="'.$username.'" ,first_name = "'.$firstname.'",last_name = "'.$lastname.'", Bdate = "'.$birthdate.'", gender= "'.$gender.'",city ="'.$city.'",email= "'.$email.'",address = "'.$address.'"  where user_name ="'.$_COOKIE['user'].'"';
    $result4 = mysqli_query($conn,$sql4);
    
    $sql3 = 'select * from User Where user_name = "'.$username.'";';
    $result = mysqli_query($conn,$sql3);

    return View("/edit_profile",compact('result'));#ProfileController::ViewProfile($username_signup_error);
    }
    public function ViewProfile ($error='')
    {
        
        #Check Authorization
        if(!isset($_COOKIE['type']) )
        {
            echo '<script>alert("You Are Not Authorized To View This Page.")</script>';
            return View('/login');

        }
         #Connect With Database
         $conn =mysqli_connect("localhost", "dbuser", "", "Match_System");
         if(!$conn){
             die('Could not connect '.mysqli_error());
         }
         
         $sql = 'select * from User Where user_name = "'.$_COOKIE['user'].'";';
         $result = mysqli_query($conn,$sql);
         return View("/edit_profile",compact('result'));
    }

}