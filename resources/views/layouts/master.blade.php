<?PHP
$user = Auth::user();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  @section('header')
  <title>Golf MS - @yield('title')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/bootstrap-datetimepicker.min.css" />
  <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>

  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="/js/moment.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/bootstrap-datetimepicker.min.js"></script>
  @show
</head>
<body>

  @section('sidebar')
  <nav class="navbar navbar-default">
    <div class="container">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{action('GuestController@index')}}">GGMS</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          @if ($user)
          <ul class="nav navbar-nav">
            @if ($user->hasRole('membership_manager') || $user->hasRole('marketing_manager') || $user->hasRole('system_administrator'))
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Membership <span class="caret"></span></a>
              
              <ul class="dropdown-menu">
                @if ($user->hasRole('membership_manager'))
                  <li><a href="{{action('AccountController@index')}}">View accounts</a></li>
                  <li><a href="{{action('AccountController@create')}}">Register a new account</a></li>
                  <li class="divider"></li>
                  <li><a href="{{action('UserController@index')}}">View users</a></li>
                  <li><a href="{{action('UserController@create')}}">Register a new user</a></li>
                  <li class="divider"></li>
                  <li><a href="{{action('GroupController@index')}}">View groups</a></li>
                  <li><a href="{{action('GroupController@create')}}">Create a new group</a></li>
                @endif

                @if ($user->hasRole('marketing_manager'))
                  <li><a href="{{action('EventController@index')}}">View events</a></li>
                  <li><a href="{{action('EventController@create')}}">Create an event</a></li>                
                  <li><a href="#">View reports</a></li>
                @endif

                @if ($user->hasRole('system_administrator'))
                  <li><a href="{{action('ResourceController@index')}}">View facilities</a></li>
                  <li><a href="{{action('ResourceController@create')}}">Add a new facility</a></li>
                  <li><a href="{{action('ResourceController@rent')}}">Rent a facility</a></li>
                @endif

              </ul>
            </li>
            @endif

            @if ($user->hasRole('golf_ops_manager'))
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Golf Operations <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
            @endif
            @if ($user->hasRole('finance_manager'))
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Finance <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
            @endif
          </ul>
          @endif
          <ul class="nav navbar-nav navbar-right">
            <form class="navbar-form navbar-left hidden-xs hidden-sm" role="search">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="">
            </div>
            <button type="submit" class="btn btn-default">Search</button>
          </form>

          @if (Auth::check())
            <li><a href="{{action('Auth\AuthController@getLogout')}}">Log out</a></li>
          @else
            <li><a href="{{action('Auth\AuthController@getLogin')}}">Log in</a></li>
          @endif

          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </div>
  </nav>
  @show

  <div class="container">
    @yield('content')
  </div>


    
</body>
</html>