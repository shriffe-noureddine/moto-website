@extends('template.mytemplate')
@section('links')
@endsection


@section('style')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style>
  .buttons {
    display: flex;
    justify-content: space-around;
    height: 80px;
    /* background-color: red; */
  }

  .card {
    width: 60rem;
  }

  .card-text {
    /* border: 5px solid red; */
    height: 100px;
    overflow: scroll;
  }

  .nech {
    font-size: 12px;
    padding: 5px 15px;
  }

  @media screen and (max-width: 640px) {


    .card {
      width: 80%;
      /* background-color: red; */
    }

    .buttons {
      height: 60px;
    }
  }
</style>
@endsection

@section('title', 'Moto Detail')


<!-- this is only example to check if foreack works -->
<?php $images = []; ?>
<!-- "/profile-image/interface.jpg" -->

@section('content')
<br>

<div style="display: flex; justify-content: center; min-height: 90vh;">
  <div class="card">

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <!-- <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        @foreach ($images as $position => $image)
        <li data-target="#carouselExampleIndicators" data-slide-to=" {{ $position }} "></li>
        @endforeach
      </ol> -->
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="{{$motor->picture}}" alt="First slide">
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      <div class="card-body">
        <h4 class="card-title">Brand: {{$motor->brand}} - Model: {{$motor->model}}</h4>
        <hr>
        <h4 class="card-text">{{$motor->description}} </h4>
        <hr>
      </div>

      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <h4>ConstructionDate: {{$motor->constructionDate}}</h4>
        </li>
        <li class="list-group-item">
          <h4>Color: {{$motor->color}} </h4>
        </li>
        <li class="list-group-item">
          <h4>Price: {{$motor->price}} $</h4>
        </li>
        <!--
        <li class="list-group-item">
          <h4>Location: {{$user->location}}</h4>
        </li> -->
        <li class="list-group-item">
          <h4>By: {{$user->name}}</h4>
        </li>
        <li class="list-group-item">
          @if(isset($user->phone) || isset($user->email) || isset($user->location))
          <h4>Contact info:</h4>
          @if(isset($user->phone))
          <h4>Phone: {{$user->phone}}</h4>
          @endif
          @if(isset($user->email))
          <h4>Email: {{$user->email}}</h4>
          @endif
          @if(isset($user->location))
          <h4>Location: {{$user->location}}</h4>
          @endif
          @endif

        </li>


      </ul>
      <div class="card-body buttons">
        <!--Display just to registered user -->

   <!-- <a href="/motors/{{$motor->id}}/edit"><input class="btn btn-primary nech" type="submit" name="edit"
          value="edit"></a>
        <a href="/motors"><input class="btn btn-primary nech" type="submit" name="disactivate" value="Back"></a>
    -->
        <!-- conditions to display the bottons-->
        <a href="/motors"><input class="btn btn-primary btn-lg" type="submit" name="disactivate" value="Back"></a>
        @if(isset(Auth::user()->level))
        @if((Auth::user()->level=="user" && (Auth::user()->id==$motor->user->id)) ||
        ((Auth::user()->level=="administrator")))
          <button class="btn btn-primary btn-lg" style="height: 3rem; width: 6rem;" id="buttonDelete">Delete</button>
          <a href="/motors/{{$motor->id}}/edit"><input class="btn btn-primary btn-lg" type="submit" name="edit"
            value="edit"></a>
          @endif
         @endif
        </div>
      </div>
      <div style="display: flex; justify-content: center;" id="resultDiv"></div>
    </div>
    <br>

  <script>
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $(function() {
    $('#buttonDelete').click(function(e) {
      $.ajax({
        url: '/motors/{{$motor->id}}',        
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
          //$('#resultDiv').html('<div style="border:5px solid green">' + JSON.stringify(result) + '</div>');
          $('#resultDiv').html('<div style="border: 5px solid green;">' + '<img src="https://www.animatedimages.org/data/media/73/animated-motorbike-image-0069.gif" border="0" alt="animated-motorbike-image-0069" />' + '</div>');
          setTimeout(function(){$('#resultDiv').html('<img src="https://www.animatedimages.org/data/media/73/animated-motorbike-image-0069.gif" border="0" alt="animated-motorbike-image-0069" />');}, 2000);
          setTimeout(function(){window.location="/motors";}, 2000);
        },
        error: function(err) {
          $('#resultDiv').html('<div style="border:5px solid red">' + JSON.stringify(err) + '</div>');
        }
      });
    });
  });
  </script>

  @endsection