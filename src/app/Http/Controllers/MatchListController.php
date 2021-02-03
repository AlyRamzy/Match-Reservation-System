<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatchListController extends Controller
{
    public function GetMatchList(){
        #Connect With Database
        $conn = mysqli_connect("localhost", "dbuser", "", "Match_System");
        if(!$conn){
            die('Could not connect '.mysqli_error());
        }

        $sql = 'select matches.match_id, matches.date_time, t1.team_name as home, t2.team_name as away, stadium.name as stadium_name 
                    from matches, teams t1, teams t2, stadium 
                    where t1.team_id = matches.home_team and 
                        t2.team_id = matches.away_team and 
                        stadium.stadium_id = matches.stadium_id;';

        $result = mysqli_query($conn, $sql);
        
        return View("/match_list", compact('result'));
    }


}
