<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReserveController extends Controller
{
    public function Reserve(){
        $SeatsNum= request("SeatsNum");
        $a=array();
        $m_id= request("match_id");
        for ($x = 1; $x <= $SeatsNum; $x++) {
            
            array_push($a,request("row".$x ),request("col".$x));
          }  
        return View("/reserve",compact('SeatsNum','a','m_id'));

    }

    public function Confirm(){
        if(!isset($_COOKIE['type'])  ||  $_COOKIE['type']!="Fan"){

            echo '<script>alert("You Are Not Authorized To View This Page.")</script>';
            return View('/login');

        }
        
        $conn =mysqli_connect("localhost", "dbuser", "", "Match_System");
        if(!$conn){
            die('Could not connect '.mysqli_error());
        }

        


        $Num = request("Num");
        $match_id = request("match_id");
        $someExist=0;

        $creditcard = request("creditcard");
        $password = request("password");

        if (!is_numeric($creditcard) || strlen($creditcard) != 14 ||!is_numeric($password) || strlen($password) != 4)
        {
            return redirect('/Match_Details?match_id='.$match_id.'&some_exist='.$someExist.'&valid_error=1');
        }



        for ($x = 1; $x <= $Num; $x++) {
            
            $r=request("row".$x);
            $c=request("col".$x);
            //reserve seat by seat
            //$sqlExist='select * from Ticket where row='.$r.' and col='.$c.' and match_id='.$match_id.' ;';
            //$resultExistance = mysqli_query($conn,$sqlExist);
            ///$exist=0;
            //foreach($resultExistance as $res)
            //{
            //    $exist=1;
            //    $someExist=1;
            //}
            //if($exist!=1)
            //{
            $sql = 'insert into Ticket (row,col,credit_card_id,user_name,match_id) values('.$r.','.$c.',"'.$creditcard.'","'.$_COOKIE['user'].'",'.$match_id.');';
            
            $result = mysqli_query($conn,$sql);
            //}
            if($result<=0)
            {
                $someExist=1;
            }

          }  
        
        
        return redirect('/Match_Details?match_id='.$match_id.'&some_exist='.$someExist.'&valid_error=0');

    }




}
