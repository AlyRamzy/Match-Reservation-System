@extends('base')

@section('Title', 'Edit Match - Match Reservation System')



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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    
    <script>
        $(function () {
            $('#datetimepicker1').datetimepicker();
                // format: "yy-mm-dd HH:mm:ss");
        });
    </script>
    

    <form method="post" action="/submit_match">
    {{ csrf_field() }}
    <?php
        if(!empty($result)) {
            echo '<input type="hidden" name="type" value="edit"/>';
            echo '<input type="hidden" name="match_id" value="'.$match_id.'"/>';
        }
        else {
            echo '<input type="hidden" name="type" value="add"/>';
        }
    ?>
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">Add Match</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Home Team</label>
                            <select name="home_team" id="home_team" class="form-control" required>
                                <?php
                                    if(!empty($result)){
                                        mysqli_data_seek($result, 0);
                                        $selected = mysqli_fetch_array($result);
                                    }
                                    while($team = mysqli_fetch_array($teams1)) {
                                        if($result && $team['team_id']==$selected['home_team']){
                                           echo '<option value="'.$team['team_id'].'" selected>'.$team['team_name'].'</option>';    
                                        }
                                        else {
                                            echo '<option value="'.$team['team_id'].'">'.$team['team_name'].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Away Team</label>
                            <select name="away_team" id="away_team" class="form-control" required>
                                <?php
                                    if(!empty($result)){
                                        mysqli_data_seek($result, 0);
                                        $selected = mysqli_fetch_array($result);
                                    }
                                    while($team = mysqli_fetch_array($teams2)) {
                                        if($result && $team['team_id']==$selected['away_team']){
                                            echo '<option value="'.$team['team_id'].'" selected>'.$team['team_name'].'</option>';
                                        }
                                        else {
                                            echo '<option value="'.$team['team_id'].'">'.$team['team_name'].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Stadium</label>
                            <select name="stadium" id="stadium" class="form-control" required>
                                <?php
                                    if(!empty($result)){
                                        mysqli_data_seek($result, 0);
                                        $selected = mysqli_fetch_array($result);
                                    }
                                    while($s = mysqli_fetch_array($stadiums)) {
                                        if($result && $s['stadium_id']==$selected['stadium_id']){
                                            echo '<option value="'.$s['stadium_id'].'" selected>'.$s['name'].'</option>';
                                        }
                                        else {
                                            echo '<option value="'.$s['stadium_id'].'">'.$s['name'].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class='col-md-6'>
                        <div class="form-group">
                            <label class="control-label">Match Time and Date</label>
                            <div class='input-group date' id='datetimepicker1'>
                                <input type="text" name="date_time" class="form-control" required/>
                                <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Main Referee</label>
                            <?php
                                if(!empty($result)){
                                    mysqli_data_seek($result, 0);
                                    $selected = mysqli_fetch_array($result);
                                    echo '<input type="text" class="form-control" name="main_referee" id="main_referee" value="'.$selected['main_referee'].'" required>';
                                }
                                else {
                                    echo '<input type="text" class="form-control" name="main_referee" id="main_referee" required>';
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">First Linesman</label>
                            <?php
                                if(!empty($result)){
                                    mysqli_data_seek($result, 0);
                                    $selected = mysqli_fetch_array($result);
                                    echo '<input type="text" class="form-control" name="first_linesman" id="first_linesman"  value="'.$selected['lineman_first'].'" required>';
                                }
                                else {
                                    echo '<input type="text" class="form-control" name="first_linesman" id="first_linesman" required>';
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Second Linesman</label>
                            <?php
                                if(!empty($result)){
                                    mysqli_data_seek($result, 0);
                                    $selected = mysqli_fetch_array($result);
                                    echo '<input type="text" class="form-control" name="second_linesman" id="second_linesman" value="'.$selected['lineman_second'].'" required>';
                                }
                                else {
                                    echo '<input type="text" class="form-control" name="second_linesman" id="second_linesman" required>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                    if(!empty($error)) {
                        echo '<div class="alert alert-danger" role="alert">
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            <span class="sr-only">Error:</span>';
                            echo $error;
                        echo '</div>';
                    }
                ?>
                <input type="submit" class="btn btn-primary" value="Save">
            </div>
        </div>
    </div>
    </form>
@endsection


