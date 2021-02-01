@extends('base')
@section('title', 'Admin')
<script>

function clickedfunc(row,column) {
 
     var elem;
 id=row+":"+column;
 
  if (elem=document.getElementById(id)) {
     
   if (elem.style.backgroundColor=='rgb(66, 155, 245)')
   {
     elem.style.backgroundColor='rgb(245, 164, 66)';
   }
   else
   {
   elem.style.backgroundColor='rgb(66, 155, 245)';
   }

 }
 
}

</script>

@section('side_bar')
       <br>
      <h4><a href="">Add Stadium</a></h4>
      <br>
      <h4><a href="">Add Match</a></h4>
      <br>
      <h4><a href="">View All Matches</a></h4>
      <br>
      


@endsection

@section('content')

<?php 
     $home=$away=$stadium=$date=$referee=$lineman1=$lineman2="";
     $row  = mysqli_fetch_array($resultHomeTeam);
     $home=$row['team_name'];
          
     $row  = mysqli_fetch_array($resultAwayTeam);
     $away=$row['team_name'];
     
     $row  = mysqli_fetch_array($result);
     $referee=$row['main_referee'];
     $date=$row['date_time'];
     $lineman1=$row['lineman_first'];
     $lineman2=$row['lineman_second'];

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
          #resultTickets
         $row =$rowsNum;
         while($row  >0){
             echo '<tr >';
             $column=1;
             while($column  <=$columnsNum){
             $s=$row.':'.$column ;
             echo '<td >';
             echo '<input type="button" style="background-color:rgb(66, 155, 245);" class="btn btn-info" value='.$s.' id='.$s.' onClick="clickedfunc('.$row.','.$column.')">';
             echo '</td>';
             
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


@endsection


