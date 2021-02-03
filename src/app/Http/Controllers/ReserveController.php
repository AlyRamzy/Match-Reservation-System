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
        /*if(!isset($_COOKIE['type'])  ||  $_COOKIE['type']!="Fan"){

            echo '<script>alert("You Are Not Authorized To View This Page.")</script>';
            return View('/login');

        }*/
        //$credit_error = $password_error= "";
        $conn =mysqli_connect("localhost", "dbuser", "", "Match_System");
        if(!$conn){
            die('Could not connect '.mysqli_error());
        }

        $creditcard = request("creditcard");
        $password = request("password");
        $Num = request("Num");
        $match_id = request("match_id");

        for ($x = 1; $x <= $Num; $x++) {
            
            $r=request("row".$x);
            $c=request("col".$x);
            //reserve seat by seat

            //$sql = 'insert into Ticket (row,col,credit_card_id,user_name,match_id) values('.$r.','.$c.',"'.$creditcard.'","'.$_COOKIE['user'].'",'.$match_id.');';
            $sql = 'insert into Ticket (row,col,credit_card_id,user_name,match_id) values('.$r.','.$c.',"'.$creditcard.'","nourahmed",'.$match_id.');';

            $result = mysqli_query($conn,$sql);
            if($result){
                $wait = "Done Reserved Ticket";
            }
            else{
                $wait =  mysqli_error($conn);
            }

          }  
        
        #Simple Checks on Data 

        /*if(empty($creditcard)){
            $credit_error = "Please Enter Valid creditcard ";
            return view('/reserve',compact("credit_error"));
        }
        if(empty($password)){
            $password_error = "Please Enter Valid Password";
            return view('/reserve',compact("password_error"));
        }*/
        //return view('test',compact('Num','password','match_id'));
        return redirect('/Match_Details?match_id='.$match_id);

    }




}
