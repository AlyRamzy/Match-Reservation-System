@extends('base')
@section('title', 'Admin')


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


         
<div class="table-responsive">          
  <table class="table">
  <thead>
  </thead>
    <tbody>
    
        <?php #PHP CODE TO INSER DATA INSIDE HTML TABLES 
        $row =10;
         while($row  >0){
             echo '<tr >';
             $column=1;
             while($column  <=30){
             $s=$row.':'.$column ;
             echo '<td >';
             echo '<input type="button" class="btn btn-info" value='.$s.'>';
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


