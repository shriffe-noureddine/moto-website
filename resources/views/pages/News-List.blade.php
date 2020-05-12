@extends('template.mytemplate')

@section('links')
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
@endsection


@section('style')
<style>
  h2{
    font-size: 1.5em;
  }
  .card{
    width: 60%; 
    display: flex; 
    justify-content: space-between; 
    padding: 30px; 
    background-color: #999999;
    padding: 10px; 
    border: 2px solid green; 
    border-radius: 25px;
  }

  @media screen and (max-width: 640px) {
  .card {
    width: 90%;
    /* background-color: red; */
  }
}

</style>
@endsection
@section('title', 'News List')



@section('content')
<div style="min-height: 90vh;">
@foreach ($news->reverse() as $new)
<br>
<div style="display: flex; justify-content: center; ">
<div class="card" style="display: flex; justify-content: space-between; ">
<div class="card-body" style="white-space: nowrap; overflow: hidden; text-overflow: clip; ">
          <h2 class="card-title" style="color: red;">{{$new->title}}</h2>
          <h6 class="card-aupdated_at mb-2">Last Update: {{$new->updated_at}}</h6>
          <p class="card-text lead text-left" style="padding: 30px; font-family: 'Times New Roman', Times, serif; font-style: italic; font-size: 150%; height: 30px; ">{{$new->description}}</p>
          <a class="btn btn-success" href="/news/{{$new->id}}">Read more...</a>
        </div>
      </div>
 </div>
@endforeach
<br>
</div>
@endsection

      

