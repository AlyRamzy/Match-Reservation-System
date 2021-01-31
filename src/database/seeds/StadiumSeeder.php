<?php

use Illuminate\Database\Seeder;

class StadiumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conn =mysqli_connect("localhost", "dbuser", "", "Match_System");
        $sql = 'insert into Stadium (name,width,height) values("Cairo Stadium",10,10)';
        mysqli_query($conn,$sql);
        
    }
}
