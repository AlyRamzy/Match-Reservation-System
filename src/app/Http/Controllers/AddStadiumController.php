<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AddStadiumController extends Controller
{
    public function Submit()
    {
        #Check Authorization 
        if(!isset($_COOKIE['type']) || $_COOKIE['type']!="Manager"){
            echo '<script>alert("You Are Not Authorized To Take this Action.")</script>';
            return redirect('/');
        }

        echo "here";
        #Connect With Database
        $conn =mysqli_connect("localhost", "dbuser", "", "Match_System");
        if(!$conn){
            die('Could not connect '.mysqli_error());
        }
        
        $stadium_name = request("stadium_name");
        $height = request("height");
        $width = request("width");
       
        $sql = "INSERT INTO `Stadium`(`name`, `width`, `height`) VALUES ('".$stadium_name."',".$width.",".$height.")";
        $result = mysqli_query($conn,$sql);
        echo "here";
        return redirect('/');
    }

}
