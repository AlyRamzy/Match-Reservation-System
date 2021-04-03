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

        $sql = 'select Matches.match_id, Matches.date_time, t1.team_name as home, t2.team_name as away, Stadium.name as stadium_name 
                from Matches, Teams t1, Teams t2, Stadium 
                where t1.team_id = Matches.home_team and 
                    t2.team_id = Matches.away_team and 
                    Stadium.stadium_id = Matches.stadium_id
                    and date_time >= NOW()
                    ORDER BY Matches.match_id;';

        $result = mysqli_query($conn, $sql);
        
        return View("/match_list", compact('result'));
    }


}
