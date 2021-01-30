<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class LoginController extends Controller
{
    
    public function ValnLog()
    {
        $username = request("username");
        $password = request("password");
        $conn =mysqli_connect("localhost", "dbuser", "", "Match_System");
        if(!$conn){
            die('Could not connect '.mysqli_error());
        }

        #$sql = 'insert into user (username,password) values("'.$username.'","'.$password.' ")';
       /* if(mysqli_query($conn,$sql)){

            #echo "Succesfully Login";
            return view('/login',compact("Test"));
        }
        else{
            
            #echo "Error "."<br>". mysqli_error($conn);
            return view('/login');
        }*/
        $t = "TEST";
        return view('/login',compact("t"));

    }

    public function SignUp()
    {
        $username_signup_error = $password_signup_error = $firstname_signup_error = $lastname_signup_error = $city_signup_error = $email_signup_error = $wait = "";

        $username = request("username");
        $password = request("password");
        $first_name = request("first_name");
        $last_name = request("last_name");
        $birthdate = request("birthdate");
        $address = request("address");
        $city = request("city");
        $email = request("email");
        $gender = request("gender");
        $role = request("role");

        if(empty($username)){
            $username_signup_error = "Please Enter Valid username";
            return view('/login',compact("username_signup_error"));
        }
        if(empty($password)){
            $password_signup_error = "Please Enter Valid Password";
            return view('/login',compact("password_signup_error"));
        }
        if(empty($first_name)){
            $firstname_signup_error = "Please Enter Valid Firstname";
            return view('/login',compact("firstname_signup_error"));
        }
        if(empty($last_name)){
            $lastname_signup_error = "Please Enter Valid Lastname";
            return view('/login',compact("lastname_signup_error"));
        }
       
        if(empty($address)){
            $address = "NULL";
        }
        if(empty($city)){
            $city_signup_error = "Please Enter Valid City";
            return view('/login',compact("city_signup_error"));
        }
       
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_signup_error = "Invalid email format";
            return view('/login',compact("email_signup_error"));
        }
        
        $wait = "Please Wait To Be Approved.";
        return view('/login',compact("wait"));

    

    }
}
