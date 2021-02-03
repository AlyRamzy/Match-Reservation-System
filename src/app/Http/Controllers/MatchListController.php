<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatchListController extends Controller
{
    public function GetMatchList(){
        # prepare sidebar
        // if(!isset($_COOKIE['type']) || $_COOKIE['type']!="Fan"){
            
        // }

        // if(!isset($_COOKIE['type']) || $_COOKIE['type']!="Manager"){
            
        // }

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
        // $match_id = $result['match_id'];
        // $date_time = $result['date_time'];
        
        // $sql = 'select team_name from teams where team_id in (select home_team from matches);';
        // $home_team = mysqli_query($conn, $sql);
        
        // $sql = 'select team_name from Teams where team_id in (select away_team from matches);';
        // $away_team = mysqli_query($conn, $sql);
        
        // $sql = 'select name from stadium where stadium_id in (select stadium_id from matches);';
        // $stadium = mysqli_query($conn, $sql);
        
        // echo "here";
        // return ;
        return View("/match_list", compact('result'));
    }


}
