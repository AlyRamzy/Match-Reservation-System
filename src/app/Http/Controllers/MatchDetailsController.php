<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MatchDetailsController extends Controller
{
    public function GetMatchDetails(){
        #Check Authorization
        //if($_COOKIE['type']=="Admin"){
          //  echo '<script>alert("You Are Not Authorized To View This Page.")</script>';
            //return View('/login');

       // }
        #Connect With Database
        $conn =mysqli_connect("localhost", "dbuser", "", "Match_System");
        if(!$conn){
            die('Could not connect '.mysqli_error());
        }

        //$input =request("match_id");
        $input=1;

        $sql = 'select * from Matches Where match_id ='.$input.';';
        $result = mysqli_query($conn,$sql);
        $resultHomeTeam=$resultAwayTeam=$resultStadium=$row="";
        $temp=mysqli_query($conn,$sql);
        if (!empty($result))
        {
            
            while($row  = mysqli_fetch_array($temp))
            {
                
                $sql2 = 'select * from Teams Where team_id ='.$row['home_team'].';';
                $resultHomeTeam= mysqli_query($conn,$sql2);

                $sql3 = 'select * from Teams Where team_id ='.$row['away_team'].';';
                $resultAwayTeam= mysqli_query($conn,$sql3);

                $sql4 = 'select * from Stadium Where stadium_id ='.$row['stadium_id'].';';
                $resultStadium= mysqli_query($conn,$sql4);

                $sql4 = 'select * from Ticket Where match_id ='.$row['match_id'].';';
                $resultTickets= mysqli_query($conn,$sql4);

            }
            
        }
        
        return View("/match_details",compact('result','resultAwayTeam','resultHomeTeam','resultStadium','resultTickets'));

    }


}
