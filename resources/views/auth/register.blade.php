
@extends('template.mytemplate')


@section('links')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

@endsection

@section('style')
<link rel="stylesheet" href="/styles/Sign.css">
@endsection

@section('title', 'Sign Up')






@section('content')
	
<br>
<div id="fullscreen_bg" class="fullscreen_bg" style="height: 90vh;">
<div id="regContainer" class="container">
      <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-login">
          <div class="panel-heading">
            <div class="row">
             
              <div class="col-xs-6">
                <a href="#" id="register-form-link">Register</a>
              </div>
            </div>
            <hr>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">
              <form id="register-form" action="{{ route('register') }}" method="post" role="form">
              @csrf
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="name" id="name" tabindex="1" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                  </div>
                  @error('name')
                       <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                       </span>
                   @enderror
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" tabindex="2" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                          <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                          </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" tabindex="3" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="new-password">
                    @error('password')
                          <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                          </span>
                     @enderror
        
                  </div>
                  <div class="form-group">
                    <label for="confirm-password">Confirm password</label>
                    <input type="password" name="password_confirmation" id="password-confirmation" tabindex="4" class="form-control" placeholder="Confirm Password" required autocomplete="new-password">
                    
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register">
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

@endsection
