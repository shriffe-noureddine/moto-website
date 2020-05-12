@extends('template.mytemplate')
@section('links')
@endsection

@section('style')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style>
  #mainDiv {
    display: flex;
    justify-content: space-around;
    background-color: #696969;
    padding: 30px;
    /* margin: 30px;  */
    border-radius: 50px;
  }

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
      left: 80%;
      top: 0px;
    }
  }

  @media screen and (max-width: 640px) {
    #mainDiv {
      width: 100%;
    }
  }
</style>
@endsection

@section('title', 'User Detail')

@section('content')

<div class="container" style="min-height: 80vh; ">
  <div id="mainDiv" class="row">

    <div>

      <h3><strong>Created at: </strong> {{$user->created_at}}</h3> <br>
      <h3> <strong>Last update: </strong> {{$user->updated_at}}</h3><br>
      <h3> <strong>Email verfied on: </strong> {{$user->email_veryfied_at}}</h3><br>
      <h3> <strong>User name: </strong> {{$user->name}}</h3> <br>
      <h3> <strong>Email: </strong> {{$user->email}}</h3> <br>
      <h3> <strong>Phone number: </strong> {{$user->phone}}</h3> <br>
      <h3> <strong>Location: </strong> {{$user->location}}</h3> <br>
      <h3><strong>User level:</strong> {{$user->level}}</h3> <br>
    </div>
    <div>

      @if(isset($user->picture))
      <img style="border-radius: 200px; height: 250px;" src="{{$user->picture}}" alt="{{$user->name}}"> <br>
      @endif
      <button id="buttonDelete" class="btn btn-success btn-lg" style="margin: 10px;">Delete</button> <br>
      <button id="back-button" class="btn btn-success btn-lg" style="margin: 10px;">Back</button>
      <div id="resultDiv" style="display: flex; justify-content: center;">
        <h2></h2>
      </div>
    </div>
  </div>
  <img id="animatedIcon" src="https://www.animatedimages.org/data/media/73/animated-motorbike-image-0093.gif" border="0"
    alt="animated-motorbike-image-0093" />
</div>


<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $(function() {
    $('#buttonDelete').click(function(e) {
      $.ajax({
        url: '/users/{{$user->id}}',
        type: 'delete',
        // headers: {
        //   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        // },
        //data: $('form').serialize(),
        data: {
            key: "value",                        
            '_token': '{!! csrf_token() !!}' // this makes it work without a form
        },       
        success: function(result) {
          if (result == 1){
            $('#resultDiv').html('<div style="border: 5px solid green;">' + '<img src="https://www.animatedimages.org/data/media/73/animated-motorbike-image-0069.gif" alt="animated-motorbike-image-0069" />' + '</div>');
          } else {
            $('#resultDiv').html('<div ' + "Delete not successful..." + '</div>');
          }
          setTimeout(function(){$('#resultDiv').html('<img src="https://www.animatedimages.org/data/media/73/animated-motorbike-image-0069.gif" border="0" alt="animated-motorbike-image-0069" />');}, 2000);
          setTimeout(function(){window.location="/";}, 2000);
        },
        error: function(err) {
          $('#resultDiv').html('<div style="border:5px solid red">' + JSON.stringify(err) + '</div>');
        }
      });
    });
  });
</script>


<script>
    $("#back-button").on("click",function(e){
        e.preventDefault();
        // console.log("prova");
        location.href = "/"; 
    });
</script>

@endsection