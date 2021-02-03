@extends('base')

@section('Title', 'Matches List - Match Reservation System')

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
            echo '<h4><a href="edit_profile">Edit Profile</a></h4>';
            echo '<br>';
            echo '<h4><a href="user_reservations">My Reservations</a></h4>';
            echo '<br>';
        }

        # MANAGER
        else if($_COOKIE['type']!="Manager") {
            echo '<br>';
            echo '<h4><a href="match_list">View All Matches</a></h4>';
            echo '<br>';
            echo '<h4><a href="add_match">Add Match</a></h4>';
            echo '<br>';
            echo '<h4><a href="add_stadium">Add Stadium</a></h4>';
            echo '<br>';
            echo '<h4><a href="edit_profile">Edit Profile</a></h4>';
            echo '<br>';
        }
    ?> 
@endsection



@section('content')
    <h1>Add Match</h1>
    <br><br>
     
    <h2>Log in</h2>
    <form method="post" action="/add_match">
        {{ csrf_field() }}
        Home Team:<input type="text" name="username" class="textcolor" required>
        <span class="error">*</span>
        <br><br>
        <?php
            if (!empty($username_login_error)) {
                echo '<span class="error">',$username_login_error,'</span><br>';
            }    
        ?> 
        
        
        Password:  <input type="password" name="password" class="textcolor" required>
        <span class="error">*</span>
        <br><br>
        <?php
            if (!empty($password_login_error)) {
                echo '<span class="error">',$password_login_error,'</span><br>';
            }
            if(!empty($approved) ){
                echo '<span class="error">Account Not Aprroved , Please Wait</span><br>';
            }    
        ?> 

        <input type="submit" name="submit" value="Log in"class="textcolor" >

    </form>
@endsection


