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
        
        $password_signup_error ="";
        $password = request("password");
        if(empty($password))
        {
            
            $password_signup_error = "Please Enter Valid Password";
            return  ProfileController::ViewProfile($password_signup_error);        
        }
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
    

    #Simple Checks on Data 
    if(empty($username))
    {
        $username_signup_error = "Please Enter Valid username";
        return  ProfileController::ViewProfile($username_signup_error);
    }
    if(empty($firstname))
    {
        $firstname_signup_error = "Please Enter Valid Firstname";
        return  ProfileController::ViewProfile($firstname_signup_error);
    }

    if(empty($lastname))
    {
        $lastname_signup_error = "Please Enter Valid Lastname";
        return  ProfileController::ViewProfile($lastname_signup_error);
    }
    if(empty($address))
    {
        
        $address = NULL;
    }
    if(empty($city))
    {
        $city_signup_error = "Please Enter Valid City";
        return  ProfileController::ViewProfile($city_signup_error);
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $email_signup_error = "Invalid email format";
        return  ProfileController::ViewProfile($email_signup_error);
    }
    #Check The username is not created before 
    $sql = "Select * from User;";
    $result = mysqli_query($conn,$sql);
    
    $sql2 = 'select * from User Where user_name = "'.$_COOKIE['user'].'";';
    $result2 = mysqli_query($conn,$sql2);
    while($row  = mysqli_fetch_array($result))
    {
        if ($row['user_name'] == $username && $row['user_name'] !=$_COOKIE['user'])
        {
            $username_signup_error = "User Name Already Exists";
            return  View("/edit_profile",compact("username_signup_error", 'result2'));#ProfileController::ViewProfile($username_signup_error);
        }
        
    }

    #update  Database

    #$password = Hash::make($password);
    $sql4 = 'Update User set user_name ="'.$username.'" ,first_name = "'.$firstname.'",last_name = "'.$lastname.'", Bdate = "'.$birthdate.'", gender= "'.$gender.'",city ="'.$city.'",email= "'.$email.'",address = "'.$address.'"  where user_name ="'.$_COOKIE['user'].'"';
    $result4 = mysqli_query($conn,$sql4);
    #setcookie('user', $username, time() + (86400 * 30), "/");
    
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