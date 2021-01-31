<?php

use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conn =mysqli_connect("localhost", "dbuser", "", "Match_System");
        $sql = "Select * from Matches;";
        $result = mysqli_query($conn,$sql);
        $row  = mysqli_fetch_array($result);
        $match_id = $row['match_id'];
        

        
        $sql = 'insert into Ticket (row,col,credit_card_id,user_name,match_id) values(1,2,"9104120492140124","Aly",'.$match_id.');';
        mysqli_query($conn,$sql);
    }
}
