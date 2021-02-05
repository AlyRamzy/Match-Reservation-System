@extends('base')
@section('title', 'Reserve')


@section('side_bar')
       <br>
      <h2><a href="">Edit My Data</a></h4>
      <br>
      <h2><a href="">My Reservation List</a></h4>
      <br>
      <h2><a href="">Matches List</a></h4>
      <br>
      


@endsection

@section('content')
      
      <?php 
      echo '<h2>Number Of Reserved Seats : '.$SeatsNum.'</h2>';
      for ($x = 0; $x < $SeatsNum*2; $x=$x+2) {
            echo '<p>seat position ( '.$a[$x].' , '.$a[$x+1].' )</p>';
          }  
      ?>
      <form method="post" action="/ConfirmReservation">
      {{ csrf_field() }}
      <input type="hidden" name="Num"  value="<?php echo $SeatsNum;?>" >
      <?php
            $ind=1;
            for ($x = 0; $x < $SeatsNum*2; $x=$x+2) {
                  
                  echo '<input type="hidden" name="row'.$ind.'" value="'.$a[$x].'" >';
                  echo '<input type="hidden" name="col'.$ind.'"  value="'.$a[$x+1].'">';
                  $ind=$ind+1;
                }  
      ?>
      <input type="hidden" name="match_id"  value="<?php echo $m_id;?>" >
      <h4>Please enter 14 digits creditcard number and 4 digits password :</h4>
      <p>Creditcard:</p><input type="text" name="creditcard" class="textcolor" required pattern="[0-9]{14}">
      
      
      <p>Password: </p> <input type="password" name="password" class="textcolor" required pattern="[0-9]{4}">
      
      <p></p>
      <input type="submit" name="submit" value="Confirm Reservation"class="textcolor" >

</form>


@endsection
