<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewReservationsController extends Controller
{
    public function ViewReservations()
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
        $sql = 'select * from ticket Where user_name = "'.$_COOKIE['user'].'";';
        $result = mysqli_query($conn,$sql);
        return View("/view_reservations",compact('result'));

    }
    public function CancelReservations()
    {
        if(!isset($_COOKIE['type']) || $_COOKIE['type']!="Fan"){
            
            return response()->json(array('status'=> "Failed"), 401);

        }
     
        $input =request("ticket_id");
       

        #Connect With Database
        $conn =mysqli_connect("localhost", "dbuser", "", "Match_System");
        if(!$conn){
            die('Could not connect '.mysqli_error());
        }

        $sql = 'Delete From  ticket  WHERE ticket_id  = ' .$input.';';
        mysqli_query($conn,$sql);

        #AJAX Response
      
      return response()->json(array('ticket_id'=> $input), 200);
    }

}