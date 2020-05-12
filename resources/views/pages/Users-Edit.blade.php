@extends('template.mytemplate')
@section('links')
@endsection


@section('style')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style>
    #mainDiv {
        background-color: #696969;
        padding: 30px;
        margin: auto;
        border-radius: 50px;
        width: 70%;

    }
    #save-button{
        margin-left:10rem;
    }
    #sec-div{
    display: flex; 
    justify-content: space-around;
    }

    @media screen and (max-width: 640px) {
        #mainDiv {
            width: 100%;
        }
        #save-button{
        margin-left:1rem;
        /* margin-top:1rem; */
    }
    #sec-div{
    display: block; 
    justify-content: space-around;
    }

    }
</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
@endsection

@section('title', 'User Edit')
@section('content')
<div style="min-height: 90vh;">


    <div class="container" id="mainDiv">

        <!-- edit form column -->
        <div class="text-lg-center">
            <h2 style="padding: 15px;">Edit Profile</h2>
        </div>

        <form action="/users/{{$user->id}}" method="POST" enctype="multipart/form-data">
            <div class="col-lg-12 push-lg-4 personal-info">
                @csrf
                @method('PUT')
                <div id="sec-div">
                    <section>


                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">
                                <h3>Name</h3>
                            </label>
                            <div class="col-lg-9">
                                <input class="form-control @error('name') is-invalid @enderror" style="height: 40px;" type="text" value="{{$user->name}}" name="name" placeholder="name"> <br>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <h3>{{ $message }}</h3>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">
                                <h3>Phone</h3>
                            </label>
                            <div class="col-lg-9">
                                <input class="form-control @error('phone') is-invalid @enderror" style="height: 40px;" type="text" value="{{$user->phone}}" name="phone" placeholder="phone"><br>
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <h3>{{ $message }}</h3>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">
                                <h3>Location</h3>
                            </label>
                            <div class="col-lg-9">
                                <input class="form-control @error('location') is-invalid @enderror" style="height: 40px;" type="text" value="{{$user->location}}" name="location" placeholder="location"><br>
                                @error('location')
                                <span class="invalid-feedback" role="alert">
                                    <h3>{{ $message }}</h3>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">
                                <h3>Level</h3>
                            </label>
                            <div class="col-lg-9">
                                <select name="level" class="form-control @error('level') is-invalid @enderror">
                                    <option {{$user->level == 'user' ? "selected" : ""}}>user</option>
                                    <option {{$user->level == 'administrator' ? "selected" : ""}}>administrator</option>
                                </select>
                                @error('level')
                                <span class="invalid-feedback" role="alert">
                                    <h3>{{ $message }}</h3>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">
                                <h3>Email</h3>
                            </label>
                            <div class="col-lg-9">
                                <a href="/logout2register"><input type="button" class="btn btn-primary" value="Register new user" /></a>
                                <h4 style="display:inline;">For email change, please create a new user (and delete old one)
                                </h4>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">
                                <h3>Password</h3>
                            </label>
                            <div class="col-lg-9">
                                <a href="/password/reset"><input type="button" class="btn btn-primary" value="Forget my password" /></a>
                                <h4 style="display:inline;">For password change, please use the reset functionality</h4>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">
                                <h3>Picture</h3>
                            </label>
                            <div class="col-lg-9">
                                <label class="custom-file">

                                    <span class="custom-file-control">
                                        <input type="file" name="picture" id="file" class="custom-file-input @error('picture') is-invalid @enderror" value="here">
                                        @error('picture')
                                        <span class="invalid-feedback" role="alert">
                                            <h3>{{ $message }}</h3>
                                        </span>
                                        @enderror
                                        <input type="hidden" name="MAX_FILE_SIZE" value="10240000" />

                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </section>
                    <section class="col-lg-4 pull-lg-8 text-xs-center">
                        <img src="{{$user->picture}}" class="m-x-auto img-fluid img-circle" alt="{{$user->name}}" />
                    </section>
                </div>
                <div style=" display: flex; justify-content:space-around; margin-top: 2rem;">
                    <input id="save-button" type="submit" class="btn btn-success btn-lg" value="Save Changes" /><br>
                    @if(isset(Auth::user()->level))
                        @if(Auth::user()->level=="administrator")
                         <input type=button style="display:flex; justify-content:center" class="btn btn-success btn-lg" value="Back"id="button-back">
                        @endif
                    @endif
                </div>
            </div>
        </form>
        {{-- <a href="/motors" class="btn btn-success btn-lg" value="Back"> --}}
        
    </div>





</div>
<script>
    $("#button-back").on("click",function(e){
        e.preventDefault();
        console.log("prova");
        location.href = "/users"; 
    });
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        console.log($(this).val());
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>

@endsection