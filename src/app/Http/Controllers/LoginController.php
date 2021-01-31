<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use DB;

class LoginController extends Controller
{
    
    public function LogIn()
    {
       
        #Connect With Database
        $conn =mysqli_connect("localhost", "dbuser", "", "Match_System");
        if(!$conn){
            die('Could not connect '.mysqli_error());
        }
        #Fetch Data From Request
        $username_login_error = $password_login_error = $approved = "";

        $username = request("username");
        $password = request("password");

        #Simple Checks on Data 

        if(empty($username)){
            $username_login_error = "Please Enter Valid username";
            return view('/login',compact("username_login_error"));
        }
        if(empty($password)){
            $password_login_error = "Please Enter Valid Password";
            return view('/login',compact("password_login_error"));
        }

        #Check username and password 
        $sql = "Select * from User;";
        $result = mysqli_query($conn,$sql);
        while($row  = mysqli_fetch_array($result)){
            if ($row['user_name'] == $username){ //Found The User Search For 
                //Check Password 
                if (Hash::check($password, $row['password'])) {
                    // Same Password
                    //Check User Type 
                    if($row['role']=="Admin"){
                        //Route To Admin Page
                        return View('/admin');
                        
                    }
                    if($row['approved']==1){
                        //Approved Fan or Manger
                        if($row['role']=="Fan"){
                            //Route To Fan Page
                            echo "Fan";
                            return;
                        }
                        else{
                            //Route To Manager Page
                            echo "Manager";
                            return;
                        }

                    }
                    else{
                        //Not Approved
                        $approved = "Please Wait to be Approved.";
                        return view('/login',compact("approved"));

                    }


                 }
                 else{
                     //Wrong Password
                     $password_login_error = "Invaild Password";
                     return view('/login',compact("password_login_error"));
                 }
                
            }
           
        }


       
        $username_login_error = "UserName Does Not Exist";
        return view('/login',compact("username_login_error"));

    }

    public function SignUp()
    {
        #Connect With Database
        $conn =mysqli_connect("localhost", "dbuser", "", "Match_System");
        if(!$conn){
            die('Could not connect '.mysqli_error());
        }
        #Fetch Data From Request 
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

        #Simple Checks on Data 
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
        #Get Gender
        if($gender=="female"){
            $gender = 'F';
        }
        else{
            $gender = 'M';
        }

        #Check The username is not created before 
        $sql = "Select * from User;";
        $result = mysqli_query($conn,$sql);
        while($row  = mysqli_fetch_array($result)){
            if ($row['user_name'] == $username){
                $username_signup_error = "User Name Already Exists";
                return view('/login',compact("username_signup_error"));
            }
           
        }

        #Insert inside Database
        $password = Hash::make($password);
        $sql = 'insert into User (user_name,password,first_name,last_name,Bdate,gender,city,email,role,address,approved) values("'.$username.'","'.$password.'","'.$first_name.'","'.$last_name.'","'.$birthdate.'","'.$gender.'","'.$city.'","'.$email.'","'.$role.'","'.$address.'",0)';
        if(mysqli_query($conn,$sql)){
            $wait = "Please Wait To Be Approved.";
        }
        else{
            $wait =  mysqli_error($conn);
        }
        
        
       
        return view('/login',compact("wait"));

    

    }
}
