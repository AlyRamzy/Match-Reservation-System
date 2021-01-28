<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class LoginController extends Controller
{
    
    public function ValnLog()
    {
        $username = request("username");
        $password = request("password");
        $conn =mysqli_connect("localhost", "dbuser", "", "Test");

        $sql = 'insert into user (username,password) values("'.$username.'","'.$password.' ")';
        if(mysqli_query($conn,$sql)){

            #echo "Succesfully Login";
            return view('/login');
        }
        else{
            
            #echo "Error "."<br>". mysqli_error($conn);
            return view('/login');
        }

    }

    public function SignUp()
    {

    }
}
