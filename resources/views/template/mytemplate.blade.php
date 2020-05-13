<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
<!-- ************** START Internet links ***************** -->
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
    integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="/styles/mytemplate.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
    integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css"
    integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

  <!-- For AJAX, must be in the head and must be more than the slim version -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <!-- ************** END Internet links ***************** -->

  <!-- ************** START Local links ***************** -->
  <!-- <link href="/css/font-awesome.min.css" rel="stylesheet"
    integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/bootstrap.min-4-4-1.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="/styles/mytemplate.css">
  <link rel="stylesheet" href="/css/bootstrap.min-3-4-1.css"
    integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/bootstrap-theme.min.css"
    integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous"> -->

  <!-- For AJAX, must be in the head and must be more than the slim version -->
  <!-- <script src="/js/jquery-3.4.1.min.js"></script> -->
  <!-- ************** END Local links ***************** -->

  @yield('links')
  @yield('style')
  <title>@yield('title')</title>
</head>

<body>

  <header>
    <nav>

      <div class="topnav" id="myTopnav">
        <a class="navbar-brand" href="#"><img src="/profile-image/logo.png" alt=""></a>

        <a href="/" class="{{ (request()->is('/')) ? 'active' : '' }}">N.E.CH Vehicles</a>
        <a href="/news" class="{{ (request()->is('news*')) ? 'active' : '' }}">Blogs</a>
        <a href="/motors" class="{{ (request()->is('motors*')) ? 'active' : '' }}">Gallery</a>
        <a href="/contact" class="{{ (request()->is('contact*')) ? 'active' : '' }}">Contact Us</a>
        <a href="/aboutus" class="{{ (request()->is('aboutus*')) ? 'active' : '' }}">About Us</a>

        @if(isset(Auth::user()->level) && (Auth::user()->level=="administrator"))
        <a href="/blog/create" class="{{ (request()->is('blog*')) ? 'active' : ''  }}">New Blog</a>
        <a href="/users" class="{{ (request()->is('users*')) ? 'active' : '' }}">Users</a>
        <a href="/offer/create" class="{{ (request()->is('offer*')) ? 'active' : '' }}">New Offer</a>
        @elseif(isset(Auth::user()->level) && ((Auth::user()->level=="user")))
        <a href="/offer/create" class="{{ (request()->is('offer*')) ? 'active' : '' }}">New Offer</a>

        @endif
        
        @yield('nav-content')

        <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>

        <?php $user = 'exist'; ?>
        <div class="right">
          @if(!isset(Auth::user()->level))
          <a href="{{ route('register')}}">Sign Up </a>
          <a href="{{ route('login') }}">Sign In </a>

          @elseif(isset(Auth::user()->level) && (Auth::user()->level=="user"))
          <!-- part of code to be otimized-->
          <a href="/users/{{Auth::user()->id}}/edit">{{Auth::user()->name}}</a>
          <a href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">Sign out</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
          @elseif(isset(Auth::user()->level) && (Auth::user()->level=="administrator"))
          <a href="/users/{{Auth::user()->id}}/edit">ADMIN</a>
          <a href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">Sign out</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
          @endif
        </div>
      </div>
    </nav>

  </header>

  <main>

    @yield('content')
  </main>

  @if(!(request()->is('/')) )
  <footer class="footer">
    <div style="display: flex; justify-content: center; color: white">Copyright © {{ date('Y') }}</div>
  </footer>
  @endif


  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>

  <script>
    /* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
    function myFunction() {
      var x = document.getElementById("myTopnav");
      if (x.className === "topnav") {
        x.className += " responsive";
      } else {
        x.className = "topnav";
      }
    }
  </script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>

</body>

</html>
