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
        
        $match_id = request("match_id");
        $home_team = request("home_team");
        $away_team = request("away_team");
        $stadium = request("stadium");
        $date_time = request("date_time");
        $main_referee = request("main_referee");
        $first_linesman = request("first_linesman");
        $second_linesman = request("second_linesman");
        $type = request("type");

        if($home_team == $away_team) {
            $error = "Home Team and Away Team can't be the same!";
            return EditMatchController::GetMatchDetails($error);
        } 

        if(!empty($date_time)) {
            $date = date_create_from_format('d/m/Y h:i a', $date_time);
            $date_time = date_format($date, 'Y-m-d h:i:s');
        }

        $sql = '';
        if($type=="edit"){
            $sql = "UPDATE `Matches` SET `date_time`='".$date_time."',`main_referee`='".$main_referee."',
            `lineman_first`='".$first_linesman."',`lineman_second`='".$second_linesman."',`home_team`=".$home_team.",
            `away_team`=".$away_team.",`stadium_id`=".$stadium." WHERE match_id=".$match_id.";"; 
        }
        else {
            $sql = "INSERT INTO `Matches`(`date_time`, `main_referee`, `lineman_first`, 
                        `lineman_second`, `home_team`, `away_team`, `stadium_id`) VALUES
                        ('".$date_time."','".$main_referee."','".$first_linesman."','".$second_linesman."',
                        ".$home_team.",".$away_team.",".$stadium.");";
        }

        $result = mysqli_query($conn, $sql);
        if($result) {
            return redirect('/');
        } else {
            $error = "Server Error!";
            return EditMatchController::GetMatchDetails($sql);
        }
    }


    public function GetMatchDetails($error=''){
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
        $match_id = $input;
        $sql = 'select * from Matches where match_id ='.$input.';';

        $result = mysqli_query($conn, $sql);
        
        $sql = 'select * from Teams';
        $teams1 = mysqli_query($conn, $sql);
        $teams2 = mysqli_query($conn, $sql);

        $sql = 'select * from Stadium';
        $stadiums = mysqli_query($conn, $sql);

        return View("/edit_match",compact('error', 'result', 'teams1', 'teams2', 'stadiums', 'match_id'));

    }


}
