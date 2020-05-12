@extends('template.mytemplate')

@section('links')

@endsection

@section('style')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<style>
  #animatedIcon {
    width: 100px;
    height: 100px;
    /* background-color: red; */
    position: relative;
    -webkit-animation-name: example;
    /* Safari 4.0 - 8.0 */
    -webkit-animation-duration: 4s;
    /* Safari 4.0 - 8.0 */
    -webkit-animation-iteration-count: infinite;
    /* Safari 4.0 - 8.0 */
    animation-name: example;
    animation-duration: 6s;
    animation-iteration-count: infinite;
  }



  @keyframes example {
    0% {
      left: -80%;
      top: 0px;
    }

    100% {
      left: 70%;
      top: 0px;
    }
  }

  .card {
    width: 50%;
    display: flex;
    justify-content: space-between;
    padding: 35px;
    font-size: 120%;
  }



  @media screen and (max-width: 640px) {
    .card {
      width: 100%;
      /* background-color: red; */
    }


    h2 {
      font-size: 1.5em;
    }
  }
</style>

@endsection

@section('title', 'Moto Detail')

@section('nav-content')

@endsection

@section('content')

<br>
<div style="min-height:90vh;">
  <div style="display: flex; justify-content: center;">
    <div class="card" style=" padding: 15px; font-size: 120%;">
      <div style="display: flex; justify-content: space-between;">
        <h1 style="color: red; text-transform: uppercase;">{{$new->title}}</h1>
      </div>
      <div>
        <h6>Published on: {{$new->created_at}}</h6>
        <h6>Author: {{$user->name}}</h6>
      </div>
      <div>
        <p style=" font-size: 150%;padding: 30px; font-family: 'Times New Roman', Times, serif; font-style: italic; "
          class="text-left">{{$new->description}}</p>
      </div>
      <div style="display: flex; justify-content: space-between;">
        <a style="color:white; text-decoration:none;" href="/news"><button class="btn btn-success"
            value="Back">Back</button></a>
        @if(isset(Auth::user()->level))
        @if(Auth::user()->level=="administrator")
        <a style="color:white; text-decoration:none;" href="/news/{{$new->id}}/edit"><button class="btn btn-success"
            value="Back">Edit</button></a>
        <button class="btn btn-success" id="buttonDelete">Delete</button>
        @endif
      </div>
      <br>
      <div id="resultDiv" style="display: flex; justify-content: center;"></div>

      <script>
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $(function() {
            $('#buttonDelete').click(function(e) {
              $.ajax({
                url: '/news/{{$new->id}}',
                type: 'delete',                
                data: {
                  key: "value",
                  '_token': '{!! csrf_token() !!}' // this makes it work without a form
                },
                success: function(result) {
                  if (result == 1) {
                    $('#resultDiv').html('<div style="border: 5px solid green;">' + '<img src="https://www.animatedimages.org/data/media/73/animated-motorbike-image-0069.gif" alt="animated-motorbike-image-0069" />' + '</div>');
                  } else {
                    $('#resultDiv').html('<div ' + "Delete not successful..." + '</div>');
                  }
                  setTimeout(function() {
                    $('#resultDiv').html('<img src="https://www.animatedimages.org/data/media/73/animated-motorbike-image-0069.gif" border="0" alt="animated-motorbike-image-0069" />');
                  }, 2000);
                  setTimeout(function() {
                    window.location = "/news";
                  }, 2000);
                },
                error: function(err) {
                  $('#resultDiv').html('<div style="border:5px solid red">' + JSON.stringify(err) + '</div>');
                }
              });
            });
          });
      </script>


      @endif

    </div>

  </div>

</div>



<br>



</div>

<img id="animatedIcon" src="https://www.animatedimages.org/data/media/73/animated-motorbike-image-0093.gif" border="0"
  alt="animated-motorbike-image-0093" />





@endsection