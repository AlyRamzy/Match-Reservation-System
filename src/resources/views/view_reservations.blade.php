@extends('base')
@section('title', 'View Reservations')

<script>
function cancel_reservations(ticket_id )
{
 

    $.ajax({
               type:'GET',
               url:'/Cancel_Reservations',
               data:{ticket_id :ticket_id},
   
               success:function(data) {
                  $("#".concat(data.ticket_id )).hide(2000);
                  
               },
               error: function(data) {

                    
                      if (data.status == 400){
                        alert("You Are Not Authorized To Take This Action.");


                      }
                      else if(data.status ==401){
                        alert("You Can only delete within 3 days before the match starts .");

                      }
                      
                    
                       

                    
                      

                    
                    
                   
                }
                
            });
 
}
</script>


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
        echo'<h1>Welcome, '.$_COOKIE['user'].' !</h1>';
        echo '<br>';
        echo'<br>';
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