<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Lil Cat project for Sony">
    <meta name="author" content="Andrew Smith">

    <title>CATastrophe! - {{Route::currentRouteName()}}</title>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script
			  src="https://code.jquery.com/jquery-3.2.1.min.js"
			  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
			  crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link href="/global.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="#"> ^ * _ * ^</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse pull-right" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link <?php if(\Route::currentRouteName() == '') echo 'active'; ?>" href="/home">Home</a>
          </li>
          @if(Auth::check())
            <li class="nav-item">
              <a class="nav-link <?php if(\Route::currentRouteName() == 'user.view') echo 'active'; ?>" href="/user/{{Auth::user()->id}}">{{Auth::user()->forename}} {{Auth::user()->surname}}</a>
            </li>
            @if(Auth::user()->member == 1)
            <li class="nav-item">
              <a class="nav-link <?php if(\Route::currentRouteName() == 'user.member') echo 'active'; ?>" href="/user/{{Auth::user()->id}}/member">Member</a>
            </li>
            @else
            <li class="nav-item">
              <a class="nav-link <?php if(\Route::currentRouteName() == 'user.membership') echo 'active'; ?>" href="/user/membership">Membership</a>
            </li>
            @endif
            <li class="nav-item">
              <a class="nav-link <?php if(\Route::currentRouteName() == 'logout') echo 'active'; ?>" href="/logout">Logout</a>
            </li>
          @else
          <li class="nav-item">
            <a class="nav-link <?php if(\Route::currentRouteName() == 'user.create') echo 'active'; ?>" href="/user/create">Join</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if(\Route::currentRouteName() == 'user.login') echo 'active'; ?>" href="/login">Login</a>
          </li>
          @endif
        </ul>
      </div>
    </nav>
    <main role="main" class="container">
      @if(count($errors->all()) > 0)
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <ul>
          @foreach($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
      @endif
      @yield('content')
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </body>
</html>
