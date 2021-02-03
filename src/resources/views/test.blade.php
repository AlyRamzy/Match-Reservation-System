@extends('base')
@section('title', 'Admin')


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
      <h1>Welcome Site Admin</h1>
        <?php
        
        echo $match_id;
        ?>

@endsection