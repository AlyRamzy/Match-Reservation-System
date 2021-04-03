@extends('base')
@section('title', 'View Reservations')

<script>
function cancel_reservations(ticket_id )
{
 

    $.ajax({
               type:'GET',
               url:'/Cancel_Reservations',
               data:{ticket_id :ticket_id },
   
               success:function(data) {
                  $("#".concat(data.ticket_id )).hide(2000);
                  
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
      <h2 style="background:black"><a href="Edit_Users" >Remove Users</a></h4>
      <br>
      <h2 ><a href="View_Reservations">Accept Fans</a></h4>
      <br>
      <h2 ><a href="Matches_List">Accept Managers</a></h4>
      <br>
      
@endsection

@section('content')

      <h1>Welcome Site Admin, Here is the users of the system remove whoever you want.</h1>
      <br><br>
      <?php

        if (empty($result)) 
        {
            echo '<h1 " >No Reservations To Be Viewed.</h1><br>';
        }

   
    ?> 

<div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
        <th>Ticket ID</th>
        <th>Row </th>
        <th>Col </th>
        <th>Credit Card ID</th>
        <th>User Name</th>
        <th>Match ID</th>
      </tr>
    </thead>
    <tbody>
    
        <?php #PHP CODE TO INSER DATA INSIDE HTML TABLES 
         while($row  = mysqli_fetch_array($result))
         {
            echo '<tr id ='.$row[0].'>';
            echo '<td>'.$row[0].'</td>';
             echo '<td>'.$row[1].'</td>';
             echo '<td>'.$row[2].'</td>';
             echo '<td>'.$row[3].'</td>';
             echo '<td>'.$row[4].'</td>';
             echo '<td>'.$row[5].'</td>';
          
             echo '<td><input type="button" class="btn btn-info" value="Remove" onClick="cancel_reservations('."' {$row['ticket_id']}'" .')"></td>';
           
             echo "</tr>";

         }
    #END OF PHP CODE 
    ?> 
      
    </tbody>
  </table>
  </div>
@endsection