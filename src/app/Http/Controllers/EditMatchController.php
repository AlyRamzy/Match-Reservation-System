<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class EditMatchController extends Controller
{
    public function GetMatchDetails(){
        #Check Authorization
        // if($_COOKIE['type']=="Manager"){
        //     echo '<script>alert("You Are Not Authorized To View This Page.")</script>';
        //     return redirect('/');
        // }

        #Connect With Database
        $conn =mysqli_connect("localhost", "dbuser", "", "Match_System");
        if(!$conn){
            die('Could not connect '.mysqli_error());
        }

        $input =request("match_id");

        $sql = 'select matches.match_id, matches.main_referee, matches.lineman_first, matches.lineman_second, 
            matches.date_time, t1.team_name as home, t2.team_name as away, stadium.name as stadium_name 
            from matches, teams t1, teams t2, stadium 
            where match_id ='.$input.' and 
                t1.team_id = matches.home_team and 
                t2.team_id = matches.away_team and 
                stadium.stadium_id = matches.stadium_id;';

        $result = mysqli_query($conn, $sql);
        
        $sql = 'select * from teams';
        $teams1 = mysqli_query($conn, $sql);
        $teams2 = mysqli_query($conn, $sql);

        $sql = 'select * from stadium';
        $stadiums = mysqli_query($conn, $sql);

        return View("/add_match",compact('result', 'teams1', 'teams2', 'stadiums'));

    }


}
