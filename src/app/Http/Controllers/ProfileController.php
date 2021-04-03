<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
Use Crypt;
use DB;
use Session;
class ProfileController extends Controller
{
    public function EditProfile ()
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
        return view('/edit_profile',compact("username_edit_error"));
    }
    if(empty($password))
    {
        $password_signup_error = "Please Enter Valid Password";
        return view('/edit_profile',compact("password_edit_error"));
    }
    if(empty($first_name))
    {
        $firstname_signup_error = "Please Enter Valid Firstname";
        return view('/edit_profile',compact("firstname_edit_error"));
    }
    if(empty($last_name))
    {
        $lastname_signup_error = "Please Enter Valid Lastname";
        return view('/edit_profile',compact("lastname_edit_error"));
    }
    
    if(empty($address))
    {
        $address = "NULL";
    }
    if(empty($city))
    {
        $city_signup_error = "Please Enter Valid City";
        return view('/edit_profile',compact("city_edit_error"));
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $email_signup_error = "Invalid email format";
        return view('/edit_profile',compact("email_edit_error"));
    }
    #Get Gender
    if($gender=="female")
    {
        $gender = 'F';
    }
    else{
        $gender = 'M';
    }

    #Check The username is not created before 
    $sql = "Select * from User;";
    $result = mysqli_query($conn,$sql);
    while($row  = mysqli_fetch_array($result))
    {
        if ($row['user_name'] == $username){
            $username_signup_error = "User Name Already Exists";
            return view('/edit_profile',compact("username_edit_error"));
        }
        
    }

    #update  Database

    #$password = Hash::make($password);
    $sql = 'update user set user_name ="'.$username.'" ,first_name = "'.$firstname.'",last_name = "'.$lastname.'", Bdate = "'.$birthdate.'", gender= "'.$gender.'",city ="'.$city.'",email= "'.$email.'",address = "'.$address.'"';
    
   
    
    return view('/edit_profile');
    }
    public function ViewProfile ()
    {
        #Check Authorization
        if(!isset($_COOKIE['type']) || $_COOKIE['type']!="Fan")
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