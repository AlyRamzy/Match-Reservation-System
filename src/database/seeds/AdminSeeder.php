<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conn =mysqli_connect("localhost", "dbuser", "", "Match_System");
        $password = Hash::make("admin");
        $sql = 'insert into User (user_name,password,first_name,last_name,Bdate,gender,city,email,approved,role) values("admin","'.$password.'","Aly","Ramzy","1998-6-12","M" , "Cairo","alyhassan62@yahoo.com",1,"Admin")';
        mysqli_query($conn,$sql);
    }
}
