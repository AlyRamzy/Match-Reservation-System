<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function AcceptFans(){
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
        #Connect With Database
        $conn =mysqli_connect("localhost", "dbuser", "", "Match_System");
        if(!$conn){
            die('Could not connect '.mysqli_error());
        }

        $sql = 'select * from User Where approved = 0 and role = "Manager";';
        $result = mysqli_query($conn,$sql);

        return View("/admin_accept_manager",compact('result'));

    }

    public function ApproveUser(){ #Ajax
        $msg = "This is a simple message.";
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
}
