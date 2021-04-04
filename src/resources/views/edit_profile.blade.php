@extends('base')
@section('title', 'Admin')


@section('side_bar')
      
<?php
            echo '<br>';
            echo '<h4><a href="match_list">View All Matches</a></h4>';
            echo '<br>';
            echo '<h4><a href="View_Profile">Edit Profile</a></h4>';
            echo '<br>';
            echo '<h4><a href="View_Reservations">My Reservations</a></h4>';
            echo '<br>';
?>

@endsection

@section('content')
<head>
<style>
.error {color: #FF0000;}
</style>
</head>

<!------ Include the above in your HEAD tag ---------->

<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">Profile</a></li>
      <li><a href="#profile" data-toggle="tab">Password</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <form id ="tab"  method="post" action="/Edit_Profile">
        @csrf <!-- add csrf field on your form -->
        <br>
            
           
            
            <?php
              echo '<label>Username</label>';
              echo '<br>';
              
                $row  = mysqli_fetch_array($result);
                
                echo'<input type="text" name="username" value='.$row['user_name'].' class="input-xlarge" readonly>';
                
                echo '<br>';
                echo'<label>First Name</label>';
                echo '<br>';
                echo'<input type="text" name="firstname" value='.$row['first_name'].' class="input-xlarge" required>';
                echo '<br>';
                echo'<label>Last Name</label>';
                echo '<br>';
                
                echo'<input type="text" name="lastname" value='.$row['last_name'].' class="input-xlarge" required>';
              
                echo '<br>';
                echo'<label>Birth Date</label>';
                echo '<br>';
                
                echo'<input type="date" name="birthdate" value='.$row['Bdate'].' id="inputlg"class="textcolor" required>'  ; 
            
                echo '<br>';
    
                echo'<label>Email</label>';
                echo '<br>';
                
                echo'<input type="text" name="email" value='.$row['email'].'  class="input-xlarge" readonly>';
                
                echo '<br>';
    
                echo'<label>Address</label>';
                echo '<br>';
                
                if ($row['address'] != null ) 
                echo '<input type="text" name="address" value='.$row['address'].'  class="input-xlarge" >';
                else
                echo '<input type="text" class="input-xlarge">';
                
                echo '<br>';
        
                
                echo'<label>City</label>';
                echo '<br>';
                
                echo'<input type="text" name="city" value='.$row['city'].'  class="input-xlarge" required>';
              
                echo '<br>';
                echo'<label>gender</label>';
                echo '<br>';
                echo '<select name="gender" id="DropDownGender"  required" >';
                
                if ($row['gender'] == 'F' )  
                {
                echo '<option value="F" selected> F </option>';
                echo '<option value="M" > M </option>' ;
                }
                else
                {
                echo '<option value="M" selected> M </option>' ;
                echo '<option value="F" > F </option>' ;
                }
                
    
                  echo'</select>';
                  echo'<br>';
               

            ?> 
            
            
          	<div>
            <br>
              <input type="submit" name="submit1" class="btn btn-primary" value="Update" style="color:black;">
        	</div>
          <br>
          
        </form>
      </div>
      <div class="tab-pane fade" id="profile">
    	<form id="tab2" method="post" action="/Edit_Password">
      @csrf <!-- add csrf field on your form -->

      <br>
        	<label>New Password</label>
          <br>
        	<input type="password"  name="password" class="input-xlarge" >
          <br>
        	<div>
          <br>
          <?php
          
          ?>
          <input type="submit" name="submit2" class="btn btn-primary" value="Update" style="color:black;">
        	</div>
          <br>
    	</form>
      </div>
  </div>

@endsection

