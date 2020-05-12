@extends('template.mytemplate')
@section('links')
@endsection


@section('style')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
            width: 90%;
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



<div style="display: flex; justify-content: center; ">
    <div class="card" style=" padding: 15px; font-size: 120%;">
        <form action="/news/{{$new->id}}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group form-group-lg">
                <h4>Title: </h4>
                <div class="col-sm-12">
                    <input class="form-control form-control @error('title') is-invalid @enderror" type="text" id="lg" value="{{$new->title}}" name="title">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <h4>Published on: </h4>
                    <h4>Author: </h4>

                    <div class="form-group shadow-textarea">
                        <label for="exampleFormControlTextarea6">Description: </label>
                        <textarea style="font-size: 150%; padding: 30px; font-family: 'Times New Roman', Times, serif; font-style: italic; " name="description" class="form-control z-depth-1 text-left @error('description') is-invalid @enderror" id="exampleFormControlTextarea6" rows="15" cols="30">{{$new->description}}</textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror


                    </div >
                    <div style="display: flex; justify-content: space-around;">

                        <input class="btn btn-success" type="submit" name="Save" value="Save changes">
                        <input id="backButton" type="button" class="btn btn-success" value="Back">                        
                    </div>
                </div>
            </div>


        </form>
    </div>
</div>

<img id="animatedIcon" src="https://www.animatedimages.org/data/media/73/animated-motorbike-image-0093.gif" border="0" alt="animated-motorbike-image-0093" />

<script>
$("#backButton").click(function(){
    window.location.href = "/news";
});
</script>

@endsection

<script>
     $("#button-back").on("click",function(e){
        e.preventDefault();
        
        location.href = "/users"; 
    });
</script>





<!-- <h1>Title: {{$new->title}}</h1>
    <h1> New Id: {{$new->id}}</h1>   

    
    <form action="/news/{{$new->id}}" method="POST">
    @csrf
    @method('PUT')
    <h1>Title</h1>
    <input type="text" name=title value="{{$new->title}}">
    <h1>Description</h1>
    <textarea name="description" id="" cols="50" rows="20">{{$new->description}}</textarea>
    <input type="submit" value="Update">
    </form> -->