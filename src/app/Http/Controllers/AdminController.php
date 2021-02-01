<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function AcceptFans(){
        #Check Authorization 
        if(!isset($_COOKIE['type']) || $_COOKIE['type']!="Admin"){
            echo '<script>alert("You Are Not Authorized To View This Page.")</script>';
            return View('/login');

        }
        #Connect With Database
        $conn =mysqli_connect("localhost", "dbuser", "", "Match_System");
        if(!$conn){
            die('Could not connect '.mysqli_error());
        }

        $sql = 'select * from User Where approved = 0 and role = "Fan";';
        $result = mysqli_query($conn,$sql);

        return View("/admin_accept_user",compact('result'));

    }

    public function AcceptManagers(){
        #Check Authorization
        if(!isset($_COOKIE['type']) || $_COOKIE['type']!="Admin"){
            echo '<script>alert("You Are Not Authorized To View This Page.")</script>';
            return View('/login');

        }
        #Connect With Database
        $conn =mysqli_connect("localhost", "dbuser", "", "Match_System");
        if(!$conn){
            die('Could not connect '.mysqli_error());
        }

        $sql = 'select * from User Where approved = 0 and role = "Manager";';
        $result = mysqli_query($conn,$sql);

        return View("/admin_accept_manager",compact('result'));

    }

    public function RemoveUsersSite(){
        #Check Authorization
        if(!isset($_COOKIE['type']) || $_COOKIE['type']!="Admin"){
            echo '<script>alert("You Are Not Authorized To View This Page.")</script>';
            return View('/login');

        }
        #Connect With Database
        $conn =mysqli_connect("localhost", "dbuser", "", "Match_System");
        if(!$conn){
            die('Could not connect '.mysqli_error());
        }

        $sql = 'select * from User Where  role != "Admin";';
        $result = mysqli_query($conn,$sql);

        return View("/admin_remove_users",compact('result'));

    }

    public function ApproveUser(){ #Ajax
        if(!isset($_COOKIE['type']) || $_COOKIE['type']!="Admin"){
            
            return response()->json(array('status'=> "Failed"), 401);

        }
        
        $input =request("username");
       

        #Connect With Database
        $conn =mysqli_connect("localhost", "dbuser", "", "Match_System");
        if(!$conn){
            die('Could not connect '.mysqli_error());
        }

        $sql = 'Update  User SET approved = 1 WHERE user_name = "' .$input.'";';
        mysqli_query($conn,$sql);

        #AJAX Response
      
      return response()->json(array('username'=> $input), 200);

    }

    public function RemoveUser(){ #Ajax
        if(!isset($_COOKIE['type']) || $_COOKIE['type']!="Admin"){
            
            return response()->json(array('status'=> "Failed"), 401);

        }
     
        $input =request("username");
       

        #Connect With Database
        $conn =mysqli_connect("localhost", "dbuser", "", "Match_System");
        if(!$conn){
            die('Could not connect '.mysqli_error());
        }

        $sql = 'Delete From  User  WHERE user_name = "' .$input.'";';
        mysqli_query($conn,$sql);

        #AJAX Response
      
      return response()->json(array('username'=> $input), 200);

    }
}
