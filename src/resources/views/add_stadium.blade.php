@extends('base')

@section('Title', 'Add Stadium - Match Reservation System')


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

    <form method="post" action="/submit_stadium">
    {{ csrf_field() }}
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">Add Stadium</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Stadium Name</label>
                            <input type="text" class="form-control" name="stadium_name" id="stadium_name" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Rows Count</label>
                            <input type="text" class="form-control" name="height" id="height" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Columns Count</label>
                            <input type="text" class="form-control" name="width" id="width" required>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" value="Save">
            </div>
        </div>
    </div>
    </form>
@endsection


