<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class EditMatchController extends Controller
{
    public function Submit()
    {
       
        #Connect With Database
        $conn =mysqli_connect("localhost", "dbuser", "", "Match_System");
        if(!$conn){
            die('Could not connect '.mysqli_error());
        }
        
        $home_team = request("home_team");
        $away_team = request("away_team");
        $stadium = request("stadium");
        $date_time = request("date_time");
        $main_referee = request("main_referee");
        $first_linesman = request("first_linesman");
        $second_linesman = request("second_linesman");
        $type = request("type");

        if($type=="edit"){

        }
        else {

        }
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
                // if ($password === $row['password']) {
                    // Same Password
                    //Check User Type 
                    if($row['role']=="Admin"){
                        //Route To Admin Page
                        setcookie('user', $username, time() + (86400 * 30), "/"); //Available for approximately one day
                        setcookie('type', "Admin", time() + (86400 * 30), "/"); //Available for approximately one day
                        return View('/admin');
                        
                    }
                    if($row['approved']==1){
                        //Approved Fan or Manger
                        if($row['role']=="Fan"){
                            //Route To Fan Page
                            setcookie('user', $username, time() + (86400 * 30), "/"); //Available for approximately one day
                            setcookie('type', "Fan", time() + (86400 * 30), "/"); //Available for approximately one day
                            echo "Fan";
                            return redirect('/match_list');
                        }
                        else{
                            //Route To Manager Page
                            setcookie('user', $username, time() + (86400 * 30), "/"); //Available for approximately one day
                            setcookie('type', "Manager", time() + (86400 * 30), "/"); //Available for approximately one day
                            echo "Manager";
                            return redirect('/match_list');
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


    public function GetMatchDetails(){
        #Check Authorization
        if(!isset($_COOKIE['type']) || $_COOKIE['type']!="Manager"){
            echo '<script>alert("You Are Not Authorized To View This Page.")</script>';
            return redirect('/');
        }

        #Connect With Database
        $conn =mysqli_connect("localhost", "dbuser", "", "Match_System");
        if(!$conn){
            die('Could not connect '.mysqli_error());
        }

        $input = request("match_id");

        $sql = 'select * from Matches where match_id ='.$input.';';

        $result = mysqli_query($conn, $sql);
        
        $sql = 'select * from teams';
        $teams1 = mysqli_query($conn, $sql);
        $teams2 = mysqli_query($conn, $sql);

        $sql = 'select * from stadium';
        $stadiums = mysqli_query($conn, $sql);

        return View("/edit_match",compact('result', 'teams1', 'teams2', 'stadiums'));

    }


}
