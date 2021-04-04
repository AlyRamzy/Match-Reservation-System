<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

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

        $sql = 'select date_time  from matches m , ticket e where ticket_id  = ' .$input.'  and  e.match_id = m.match_id ';
        $result = mysqli_query($conn,$sql);
        $row  = mysqli_fetch_array($result);
        $date1 = $row['date_time'];
       
        
        $date1 = Carbon::parse($date1);
        $date1 = $date1->subDays(3);
        $date2 = Carbon::now();
      
        echo $date2 ;
        echo $date1 ;
        
        $check = $date1->gte($date2);
        dump($check);
        if ($check)
        {
        $sql = 'Delete From  ticket  WHERE ticket_id  = ' .$input.';';
        mysqli_query($conn,$sql);
        return response()->json(array('ticket_id'=> $input), 200);
        }
        else 
        return response()->json(array('ticket_id'=> $input), 401);

        #AJAX Response
      
      
    }

}