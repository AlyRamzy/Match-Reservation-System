<?php

use Illuminate\Database\Seeder;

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
        
        $sql = 'insert into Matches (main_referee,lineman_first,lineman_second,home_team,away_team,stadium_id) values("Ramzy","Aly","Ahmed",'.$hometeam_id.','.$awayteam_id.','.$stadium_id.')';
        mysqli_query($conn,$sql);
    }
}
