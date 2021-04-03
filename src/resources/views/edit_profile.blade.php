@extends('base')
@section('title', 'Admin')
<script>
function editProfile(user_name )
{
 

    $.ajax({
               type:'GET',
               url:'/Cancel_Reservations',
               data:{user_name :user_name },
   
               success:function(data) {
                  $("#".concat(data.user_name )).hide(2000);
                  
               },
               error: function() {
                    alert("You Are Not Authorized To Take This Action.");
                    window.location.href = "{{URL::to('/')}}"
                   
                }
            });
 
}
</script>

@section('side_bar')
       <br>
      <h2><a href="Remove_Users">Remove Users</a></h4>
      <br>
      <h2><a href="Accept_Fans">Accept Fans</a></h4>
      <br>
      <h2><a href="Accept_Mangers">Accept Managers</a></h4>
      <br>
      


@endsection

@section('content')
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<?php #PHP CODE TO INSER DATA INSIDE HTML TABLES 
        $row  = mysqli_fetch_array($result);
      ?>
<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">Profile</a></li>
      <li><a href="#profile" data-toggle="tab">Password</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <form id="tab" method="post" action="/Edit_Profile">
            <label>Username</label>
            <?php 
            echo'<input type="text" name="username" value='.$row['user_name'].' class="input-xlarge">'
            ?>

            <label>First Name</label>
            <?php 
            echo'<input type="text" name="firstname" value='.$row['first_name'].' class="input-xlarge">'
            ?>

            <label>Last Name</label>
            <?php 
            echo'<input type="text" name="lastname" value='.$row['last_name'].' class="input-xlarge">'
            ?>

            <label>Birth Date</label>
            <?php 
            echo'<input type="date" name="birthdate" value='.$row['Bdate'].' id="inputlg"class="textcolor">'   
            ?>

            <label>Email</label>
            <?php
            echo'<input type="text" name="email" value='.$row['email'].'  class="input-xlarge">'
            ?>

            <label>Address</label>
            <?php
            if ($row['address'] != null ) 
            echo '<input type="text" name="address" value='.$row['address'].'  class="input-xlarge">';
            else
            echo '<input type="text" class="input-xlarge">';
            ?>
    
            
            <label>City</label>
            <?php
            echo'<input type="text" name="city" value='.$row['city'].'  class="input-xlarge">'
            ?>
            <label>gender</label>
            
            <select name="gender" id="DropDownGender" class="input-xlarge" >
            <?php
            if ($row['gender'] == 'F' )  
            echo '<option value="F" selected> female selected</option>';
            else
            echo '<option value="M" selected> male </option>' ;
            ?>
              </select>
          	<div>
        	    
              <input type="submit" name="submit" value="Update" style="color:black;">
        	</div>
          
        </form>
      </div>
      <div class="tab-pane fade" id="profile">
    	<form id="tab2">
        	<label>New Password</label>
        	<input type="password" class="input-xlarge">
        	<div>
        	    <button class="btn btn-primary" >Update</button>
        	</div>
    	</form>
      </div>
  </div>

@endsection

