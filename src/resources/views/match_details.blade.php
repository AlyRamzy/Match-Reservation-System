

@extends('base')
@section('title', 'MatchDetails')

<script>

setInterval(function() {
     
        $.ajax({
            type: "GET",
            url: "/Reserved_Seats", 
            data:{matchId:""+<?php echo $input;?>},
   
               success:function(data) {
                   
                    for (var i = 1; i < <?php echo $rN;?> ; i++) {
                    
                         for (var j = 1; j < <?php echo $cN;?> ; j++) {
                              var elem;
                              id=i+":"+j;
                              
                              if (elem=document.getElementById(id)) {
                                   elem.style.backgroundColor='rgb(66, 155, 245)';
                              }
                         }
                    }
                    jsonn= JSON.parse(data.tickets);

                        
                    jsonn.forEach(function(obj) {
                         
                         index = seats.findIndex(x => x.row ==obj.row && x.col==obj.col);

          
                         if (index > -1) {
                              
                              seats.splice(index, 1);
                              numberOfseats=numberOfseats-1;
                         }
                         
                         var elem;
                         id=obj.row+":"+obj.col;
                         
                         if (elem=document.getElementById(id)) {
                              elem.style.backgroundColor='rgb(255, 0, 0)';
                         }
                         
          
                    });
                    for(let seat of seats){
                         var col = seat.col;
                         var row = seat.row;
                         var elem;
                         id=row+":"+col;
                         
                         if (elem=document.getElementById(id)) {
                              elem.style.backgroundColor='rgb(245, 164, 66)';
                         }
                     }
                        

               },
               error: function() {
                    alert("not responding");
                    
                   
                }
        });
    }, 500);
    


let seats = [];
numberOfseats=0;
function clickedfunc(row,column) {
 
     var elem;
 id=row+":"+column;
 
  if (elem=document.getElementById(id)) {
     
   if (elem.style.backgroundColor=='rgb(66, 155, 245)')
   {
     let seat = {
     "row": row,
     "col": column,
     
     }
     seats.unshift(seat);
     numberOfseats=numberOfseats+1;

     elem.style.backgroundColor='rgb(245, 164, 66)';
   }
   else if (elem.style.backgroundColor=='rgb(245, 164, 66)')
   {
     let seat = {
     "row": row,
     "col": column,
     
     }
     index = seats.findIndex(x => x.row ===row && x.col===column);

     
     if (index > -1) {
          
     seats.splice(index, 1);
     }
     numberOfseats=numberOfseats-1;
     elem.style.backgroundColor='rgb(66, 155, 245)';
   }

 }
 
}

function reserve(m_id) {
     
     if (numberOfseats==0)
     {
          alert("please select seats first");
     }
     else
     {
          var urll="Reserve?SeatsNum="+numberOfseats; 
          var index=1;
          for(let seat of seats){
               var col = seat.col;
               var row = seat.row;
               urll=urll+"&col"+index+"="+col+"&row"+index+"="+row;
               
               index=index+1;
               }
          urll=urll+"&match_id="+m_id;
          location.href = urll;
     } 
}

</script>


@section('side_bar')
    <?php
        # GUEST
        if(!isset($_COOKIE['type'])) {
            echo '<br>';
            echo '<h4><a href="match_list">View All Matches</a></h4>';
            echo '<br>';
            echo '<h4><a href="login">Login / Signup</a></h4>';
            echo '<br>';
        }

        # FAN
        else if($_COOKIE['type']=="Fan") {
            echo '<br>';
            echo '<h4><a href="match_list">View All Matches</a></h4>';
            echo '<br>';
            echo '<h4><a href="View_Profile">Edit Profile</a></h4>';
            echo '<br>';
            echo '<h4><a href="View_Reservations">My Reservations</a></h4>';
            echo '<br>';
        }

        # MANAGER
        else if($_COOKIE['type']=="Manager") {
            echo '<br>';
            echo '<h4><a href="match_list">View All Matches</a></h4>';
            echo '<br>';
            echo '<h4><a href="add_match">Add Match</a></h4>';
            echo '<br>';
            echo '<h4><a href="add_stadium">Add Stadium</a></h4>';
            echo '<br>';
            echo '<h4><a href="View_Profile">Edit Profile</a></h4>';
            echo '<br>';
        }
    ?> 
@endsection

@section('content')

<?php 
     
     $home=$away=$stadium=$date=$referee=$lineman1=$lineman2="";
     $row  = mysqli_fetch_array($resultHomeTeam);
     $home=$row['team_name'];
          
     $row  = mysqli_fetch_array($resultAwayTeam);
     $away=$row['team_name'];
     
     foreach($result as $row)
     {
          $referee=$row['main_referee'];
          $date=$row['date_time'];
          $lineman1=$row['lineman_first'];
          $lineman2=$row['lineman_second'];
     }
     #$row  = mysqli_fetch_array($resultStadium);
     foreach($resultStadium as $row)
     {
     $stadium=$row['name'];
     }

     echo '<h1>'.$home.'  vs  '.$away.'</h1>
     <p>Date: '.$date.'</p><p>Stadium: '.$stadium.'</p><p>Main Referee: '.$referee.'</p>
     <p>Linemen:  '.$lineman1.'   ,   '.$lineman2.'</p>';
     
     
?> 


<div class="table-responsive">          
  <table class="table">
  <thead>
  </thead>
    <tbody>
    
        <?php #PHP CODE TO INSER DATA INSIDE HTML TABLES 
         $columnsNum=$rowsNum="";
          foreach($resultStadium as $row)
          {
               #$row  = mysqli_fetch_array($resultStadium);
               $columnsNum=$row['width'];
               $rowsNum=$row['height'];
          }
          $reserved=0;
         $row =$rowsNum;
         $colorr='rgb(66, 155, 245)';
         while($row  >0){
             echo '<tr >';
             $column=1;
             while($column  <=$columnsNum){
               foreach($resultTickets as $tick)
                {
                     if ($row==$tick['row'] && $column==$tick['col'])
                     {
                         $colorr='rgb(255, 0, 0)';
                         $reserved=1;
                         break;
                     }
                    }
               
               $s=$row.':'.$column ;
               echo '<td >';
               echo '<input type="button" style="background-color:'.$colorr.';" class="btn btn-info" value='.$s.' id='.$s.' onClick="clickedfunc('.$row.','.$column.')">';
               echo '</td>';
               if ($reserved==1)
               {
                    $reserved=0;
                    $colorr='rgb(66, 155, 245)';

               }
               
               $column=$column+1;
             }
             echo "</tr>";
             $row =$row -1;
         }
    #END OF PHP CODE 
    ?> 
      
    </tbody>
  </table>
  </div>
  
  <?php 
     if(isset($_COOKIE['type'])  && $_COOKIE['type']=="Fan"){
          foreach($result as $row)
          {
               $m_id=$row['match_id'];
           }
          echo '<input type="button" style="margin: 1em; background-color:rgb(66, 155, 245);" class="btn btn-info" value="Reserve" onClick="reserve('.$m_id.')">';
          
      }
      if(isset($_COOKIE['type'])  && $_COOKIE['type']=="Manager"){
          foreach($result as $row)
          {
               $m_id=$row['match_id'];
          }
          echo '<form action="/edit_match" method="GET">';
          echo '<input type="hidden" name="match_id" value="'.$m_id.'">';
          echo '<input type="submit" class="btn btn-primary" value="Edit">';
          
      }
      


?>
<script>

if (<?php echo $someExist;?> ==1)
{
     alert("Sorry but some seats reserved before your confirmation so check your reservation list");
}
if (<?php echo $validerror;?> ==1)
{
     alert("Sorry but there is a problem with your creditcard or password so check that you wrote right data");
}
</script>
@endsection


