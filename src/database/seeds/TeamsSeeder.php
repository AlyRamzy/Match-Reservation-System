<?php

use Illuminate\Database\Seeder;

class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conn =mysqli_connect("localhost", "dbuser", "", "Match_System");
        $sql = 'insert into Teams (team_name) values("Zamalek")';
        mysqli_query($conn,$sql);
        $sql = 'insert into Teams (team_name) values("Al Ahly")';
        mysqli_query($conn,$sql);
    }
}
