@extends('base')
@section('title', 'MatchDetails')
<script>
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

</script>

@section('side_bar')
    <?php
     #if(isset($_COOKIE['type'])  && $_COOKIE['type']=="Fan"){
         echo '<br>';
         echo '<h4><a href="">Edit My Data</a></h4>';
         echo '<br>';
         echo '<h4><a href="">My Reservation List</a></h4>';
         echo '<br>';
         echo '<h4><a href="">Matches List</a></h4>';
         echo '<br>';
      #}
      if(isset($_COOKIE['type'])  && $_COOKIE['type']=="Manager"){
          echo '<br>';
         echo '<h4><a href="">Add Stadium</a></h4>';
         echo '<br>';
         echo '<h4><a href="">Add Match</a></h4>';
         echo '<br>';
         echo '<h4><a href="">View All Matches</a></h4>';
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
     #if(isset($_COOKIE['type'])  && $_COOKIE['type']=="Fan"){
          foreach($result as $row)
          {
               $m_id=$row['match_id'];
           }
          echo '<input type="button" style="margin: 1em; background-color:rgb(66, 155, 245);" class="btn btn-info" value="Reserve" onClick="reserve('.$m_id.')">';
          
      #}
      if(isset($_COOKIE['type'])  && $_COOKIE['type']=="Manager"){
          echo '<input type="button" style="margin: 1em; background-color:rgb(66, 155, 245);" class="btn btn-info" value="Edit" >';
          
      }
      


?>
@endsection


