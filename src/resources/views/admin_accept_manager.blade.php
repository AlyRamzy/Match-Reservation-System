@extends('base')
@section('title', 'Accept Users')

<script>

function approve(username) {
 

    $.ajax({
               type:'GET',
               url:'/Approve_User',
               data:{username:username},
   
               success:function(data) {
                  $("#".concat(data.username)).hide(2000);
                  
               }
            });
 
}




</script>


@section('side_bar')
       <br>
      <h2 ><a href="Remove_Users" >Remove Users</a></h4>
      <br>
      <h2 ><a href="Accept_Fans">Accept Fans</a></h4>
      <br>
      <h2 style="background:black"><a href="Accept_Mangers">Accept Managers</a></h4>
      <br>
      


@endsection

@section('content')
      <h1>Welcome Site Admin, Here is the user waiting for approval.</h1>
      <br><br>
      <?php

        if (empty($result)) {
            echo '<h1 " >No Users To Be Accepted.</h1><br>';
        }

   
    ?> 


<div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
        <th>User Name</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Birthdate</th>
        <th>gender</th>
        <th>City</th>
        <th>Address</th>
        <th>Email</th>
        <th>Role</th>
      </tr>
    </thead>
    <tbody>
    
        <?php #PHP CODE TO INSER DATA INSIDE HTML TABLES 
         while($row  = mysqli_fetch_array($result)){
             echo '<tr id ='.$row['user_name'].'>';
             echo '<td>'.$row['user_name'].'</td>';
             echo '<td>'.$row['first_name'].'</td>';
             echo '<td>'.$row['last_name'].'</td>';
             echo '<td>'.$row['Bdate'].'</td>';
             echo '<td>'.$row['gender'].'</td>';
             echo '<td>'.$row['city'].'</td>';
             echo '<td>'.$row['address'].'</td>';
             echo '<td>'.$row['email'].'</td>';
             echo '<td>'.$row['role'].'</td>';
             echo '<td><input type="button" class="btn btn-info" value="Accept" onClick="approve('."' {$row['user_name']}'" .')"></td>';

             echo "</tr>";

         }
    #END OF PHP CODE 
    ?> 
      
    </tbody>
  </table>
  </div>
@endsection


