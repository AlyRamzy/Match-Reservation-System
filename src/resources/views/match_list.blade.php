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
        if (!isset($_COOKIE['type']) || !isset($_COOKIE['user'])) {
            echo "<h1>Welcome !</h1>";
        }
        else {
            echo "<h1>Welcome ".$_COOKIE['user']."!</h1>";
        }

    ?> 
    <br><br>
    <?php
        if (empty($result)) {
            echo '<h1>No Upcoming Matches!</h1><br>';
        }
    ?> 


    <div class="table-responsive">          
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Home</th>
                <th>Away</th>
                <th>Date & Time</th>
                <th>Stadium</th>
                <th>Show Details</th>
            </tr>
            </thead>
            
            <tbody>
                <?php #PHP CODE TO INSERT DATA INSIDE HTML TABLES
                    while($row  = mysqli_fetch_array($result)){
                        $id = $row['match_id'];
                        $time = $row['date_time'];
                        $home = $row['home'];
                        $away = $row['away'];
                        $venue = $row['stadium_name'];
                        echo '<tr id ='.$id.'>';
                            echo '<td>'.$home.'</td>';
                            echo '<td>'.$away.'</td>';
                            echo '<td>'.$time.'</td>';
                            echo '<td>'.$venue.'</td>';
                            echo '<td><a href="Match_Details?match_id='.$id.'">More</a></td>';
                        echo "</tr>";
                    }
                ?> 
            </tbody>
        </table>
    </div>
@endsection


