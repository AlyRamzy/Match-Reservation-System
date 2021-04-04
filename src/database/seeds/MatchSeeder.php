<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conn =mysqli_connect("localhost", "dbuser", "", "Match_System");
        $sql = "Select * from Stadium;";
        $result = mysqli_query($conn,$sql);
        $row  = mysqli_fetch_array($result);
        $stadium_id = $row['stadium_id'];
        

        $sql = "Select * from Teams;";
        $result = mysqli_query($conn,$sql);
        $row  = mysqli_fetch_array($result);
        $hometeam_id = $row['team_id'];
        $row  = mysqli_fetch_array($result);
        $awayteam_id = $row['team_id'];

        
        $date = Carbon::now();

        $date = $date->addDays(7);
        
        
        $sql = 'insert into Matches (date_time,main_referee,lineman_first,lineman_second,home_team,away_team,stadium_id) values("'.$date.'","Ramzy","Aly","Ahmed",'.$hometeam_id.','.$awayteam_id.','.$stadium_id.')';
        mysqli_query($conn,$sql);
        $date = Carbon::now();

        $date = $date->addDays(2);
        $sql = 'insert into Matches (date_time,main_referee,lineman_first,lineman_second,home_team,away_team,stadium_id) values("'.$date.'","Ramzy","Aly","Ahmed",'.$hometeam_id.','.$awayteam_id.','.$stadium_id.')';
        mysqli_query($conn,$sql);
        #insert into Matches (date_time, main_referee,lineman_first,lineman_second,home_team,away_team,stadium_id) values("2021-04-09 14:13:18","Ramzy","Aly","Ahmed",9,10,4);

    }
}
