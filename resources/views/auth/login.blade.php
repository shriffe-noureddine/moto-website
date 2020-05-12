@extends('template.mytemplate')


@section('links')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

@endsection

@section('style')
<link rel="stylesheet" href="/styles/Sign.css">

 <style> 
        .input-icons i { 
            position: absolute; 
        } 
          
        .input-icons { 
            width: 100%; 
            margin-bottom: 10px; 
        } 
          
        .icon { 
            padding: 10px; 
            min-width: 40px; 
        } 
          
        .input-field { 
            width: 100%; 
            padding: 10px; 
            text-align: center; 
        } 
    </style> 

@endsection

@section('title', 'Sign In')





@section('content')
<!-- <div class="row d-flex justify-content-center mx-auto" style="height: 90vh;">
    <div class="col-md-6 col-xs-12 div-style">
        <form>
            <div class="d-flex justify-content-center mx-auto main-label">
                <h2>Sign In</h2>
            </div>
            <div class="form-group">
                <input type="email" class="form-control text-box" id="email" aria-describedby="email"
                    placeholder="Enter email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control text-box" id="password" placeholder="Password">
            </div>

            <div class="form-group justify-content-center d-flex">
                <button type="submit" class="btn btn-danger button-submit">Sing In</button>
            </div>
        </form>
    </div>
</div> -->

<br>
<div id="fullscreen_bg" class="fullscreen_bg" style="height: 90vh;">
  <div id="regContainer" class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-login">
          <div class="panel-heading">
            <div class="row">

              <div class="col-xs-6">
                <a href="#" id="register-form-link">Sign In</a>
              </div>
            </div>
            <hr>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">
                <form id="login-form" method="post" action="{{ route('login') }}" role="form" style="display: block;">
                  @csrf
                  <div class="form-group">
                    <label for="username">Email</label>
                    <input type="email" name="email" id="email" tabindex="1"
                      class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                      value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                  </div>
                  <div class="form-group input-icons">
                    <label for="password">Password</label>
                    <!-- <i id="eye" class="fa fa-eye icon"></i> input-field  id="pwd"-->
                    <input type="password"  name="password" tabindex="2"
                      class="form-control @error('password') is-invalid @enderror " placeholder="Password">
                      
                      <!-- {{-- <input type="checkbox" name="remember" id="eye"> --}} -->

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group text-center">
                    <input type="checkbox" tabindex="3" class="" name="remember" id="remember"
                      {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">Remember Me</label>
                  </div>
                
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="login-submit" id="login-submit" tabindex="4"
                          class="form-control btn btn-login" value="Log In">
                        @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                          Forgot your password

                        </a>
                        @endif
                      </div>
                    </div>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(function() {

$('#login-form-link').click(function(e) {
    $("#login-form").delay(100).fadeIn(100);
     $("#register-form").fadeOut(100);
    $('#register-form-link').removeClass('active');
    $(this).addClass('active');
    e.preventDefault();
});
$('#register-form-link').click(function(e) {
    $("#register-form").delay(100).fadeIn(100);
     $("#login-form").fadeOut(100);
    $('#login-form-link').removeClass('active');
    $(this).addClass('active');
    e.preventDefault();
});

});
</script>

<script>
  $('#eye').click(function(e){
    e.preventDefault();
    if($('#pwd').attr("type") == "text"){
      $('#pwd').attr("type", "password");  
    } else {
      $('#pwd').attr("type", "text");  
    }
    });

  

</script>

@endsection