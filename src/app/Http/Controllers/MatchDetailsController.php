<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MatchDetailsController extends Controller
{
    public function GetMatchDetails(){
        #Check Authorization
        if(isset($_COOKIE['type'])  && $_COOKIE['type']=="Admin"){
            echo '<script>alert("You Are Not Authorized To View This Page.")</script>';

        }
        #Connect With Database
        $conn =mysqli_connect("localhost", "dbuser", "", "Match_System");
        if(!$conn){
            die('Could not connect '.mysqli_error());
        }

        $input =request("match_id");
        $someExist =request("some_exist");
        $validerror =request("valid_error");
        //$input=1;

        $sql = 'select * from Matches Where match_id ='.$input.';';
        $result = mysqli_query($conn,$sql);
        $resultHomeTeam=$resultAwayTeam=$resultStadium=$row="";
        $check=0;
        
        foreach($result as $row)
        {

            $check=1;
            $sql2 = 'select * from Teams Where team_id ='.$row['home_team'].';';
            $resultHomeTeam= mysqli_query($conn,$sql2);

            $sql3 = 'select * from Teams Where team_id ='.$row['away_team'].';';
            $resultAwayTeam= mysqli_query($conn,$sql3);

            $sql4 = 'select * from Stadium Where stadium_id ='.$row['stadium_id'].';';
            $resultStadium= mysqli_query($conn,$sql4);

            $sql4 = 'select * from Ticket Where match_id ='.$row['match_id'].';';
            $resultTickets= mysqli_query($conn,$sql4);

        }
        if ($check==1)
        {
            foreach($resultStadium as $row)
            {
                #$row  = mysqli_fetch_array($resultStadium);
                $cN=$row['width'];
                $rN=$row['height'];
            }
            return View("/match_details",compact('result','resultAwayTeam','resultHomeTeam','resultStadium','resultTickets','input','cN','rN','someExist','validerror'));
        }
        else 
            return redirect('/match_list');
        
        
    }

    public function GetReservedSeats()
    {

        $input =request("matchId");
        $conn =mysqli_connect("localhost", "dbuser", "", "Match_System");
        if(!$conn){
            die('Could not connect '.mysqli_error());
        }
        $sql4 = 'select * from Ticket Where match_id ='.$input.';';
        $resultTickets= mysqli_query($conn,$sql4);

        $emparray = array();
        while($row =mysqli_fetch_assoc($resultTickets))
        {
            $emparray[] = $row;
        }
        $encoded=json_encode($emparray);

        return response()->json(array('tickets'=> $encoded), 200);
    }


}
