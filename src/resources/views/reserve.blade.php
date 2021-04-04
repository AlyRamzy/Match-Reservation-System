@extends('base')
@section('title', 'Reserve')


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
