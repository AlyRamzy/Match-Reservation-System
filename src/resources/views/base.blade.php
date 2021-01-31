<!DOCTYPE html>
<html lang="en">
<head>
  <title>@yield('Title')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>

    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }

    .row.content {height: 1212px}

    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }


    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;}
    }
  </style>

</head>
</html>
<body>
  <nav class="navbar navbar-inverse" >
      <a class="navbar-brand" style= " margin-left:15px"> Match Reservation System </a>
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        </button>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right" style="margin-right:12px">

          <form action="/logout" method="post">
            {{ csrf_field() }}
            <button type="submit" name="logout" value="logout" class="btn-link" style="margin-top:12px"><span class="glyphicon glyphicon-log-out"></span> LogOut</button>
          </form>
        </ul>
         </form>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container-fluid text-center" @yield('img') >
    <div class="row content">
      <div class="col-sm-2 sidenav">
  @yield('side_bar')
  </div>
    <div class="col-sm-8 text-left">

    @yield('content')

    </div>
    </div>

</body>

</html>
