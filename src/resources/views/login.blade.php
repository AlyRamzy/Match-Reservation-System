<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  .resize{
      width:1024px;
      height:560px;
      display:block;
      margin-left:auto;
      margin-right:auto;
      width:100%;
  }
  .background{
      background-color:#D0CACA;
   
  }

  .resz {
      width:1080px;
  }
  .error {color: #FF0000;}
  

  </style>
</head>
<body class="background">

<div class="container">
  <div id="myCarousel" class="carousel slide resize" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">

      <div class="item active resize">
        <img src="{{asset('img/egypt football.jpeg')}}"  class="img-rounded" alt="egypy football" style="width:100%;">
        <div class="carousel-caption">
          <h3>Egypt</h3>
          <p>Egyptian Football !!!</p>
        </div>
      </div>

      <div class="item resize">
        <img src="{{asset('img/stadium.jpeg')}}"  class="img-rounded" alt="stadium" style="width:100%;">
        <div class="carousel-caption">
          <h3>stadium</h3>
          <p>Huge stadium!!</p>
        </div>
      </div>

      <div class="item resize">
        <img src="{{asset('img/abutreka.jpeg')}}"  class="img-rounded" alt="abutreka" style="width:100%;">
        <div class="carousel-caption">
          <h3>Abutreka</h3>
          <p>Abutreka legend Egyptian Player</p>
        </div>
      </div>

    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <!-- The log Window   -->
  <div class="row">
  <div class="col-lg-6" style="text-align:center;"><h1>Already a Member?</h1>

<h2>Log in</h2>
<form method="post" action="/log_in">
  {{ csrf_field() }}
  Username:<input type="text" name="username">
  <span class="error"></span>
  <br><br>
  Password:  <input type="password" name="password">
  <span class="error"></span>
  <br><br>

  <input type="submit" name="submit" value="Log in" >

</form>

  </div>

  <div class="col-lg-6" style="margin-top:6px"><h1>New Member?</h1>

<h2>Sign up</h2>
<p><span class="error" style="color:red"> * required field</span></p>
<form method="post" action="/sign_up">
  {{ csrf_field() }}
  
  Username: <input type="text" name="username" required>
  <span class="error" style="color:red"> *</span>
  <br><br>
  Password: <input type="password" name="passWwrd" style="margin-left:6px" required>
  <span class="error" style="color:red"> *</span>
  <br><br>
  First Name: <input type="text" name="first_name" style="margin-left:28px" required>
  <span class="error" style="color:red"> *</span>
  <br><br>
  Last Name: <input type="text" name="last_name" style="margin-left:28px" required>
  <span class="error" style="color:red"> *</span>
  <br><br>
  Birthdate <input type="date" name="birthdate" style="margin-left:28px" required>
  <span class="error" style="color:red"> *</span>
  <br><br>
  Address: <input type="text" name="address" style="margin-left:18px">
  <span class="error" style="color:red"></span>
  <br><br>
  City: <input type="text" name="city" style="margin-left:18px">
  <span class="error" style="color:red"></span>
  <br><br>
  Email Address: <input type="email" name="email" style="margin-left:18px">
  <span class="error" style="color:red"></span>
  <br><br>


  Gender:
  <input type="radio" name="gender" style="margin-left:25px" value="female">Female
  <input type="radio" name="gender" style="margin-left:6px" value="male">Male
  <span class="error" style="color:red"></span>
  <br><br>

  Role:
  <input type="radio" name="role" style="margin-left:25px" value="Fan">Fan
  <input type="radio" name="role" style="margin-left:6px" value="Manager">Manager
  <span class="error" style="color:red"></span>
  <br><br>
  <input type="submit" name="submit" value="Register">
</form>
  </div>
</div>
</div>

</body>
</html>
