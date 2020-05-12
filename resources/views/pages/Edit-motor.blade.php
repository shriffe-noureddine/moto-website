@extends('template.mytemplate')
@section('links')

@endsection


@section('style')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style>
    .card {
        width: 60rem;
    }


    .card-text {
        /* border: 5px solid red; */
        height: 200px;
        overflow: scroll;
    }

    .nech {
        font-size: 12px;
        padding: 5px 15px;
    }

    .normalLabels {
        font-weight: 900;
        font-size: 2rem;
        margin: 0;
        padding: 0;
    }
</style>
@endsection

@section('title', 'Edit Motor')


@section('content')
<br>

<div style="display: flex; justify-content: center; min-height: 90vh;">
    <div class="card">
        <div class="card-body">

            <div class="list-group list-group-flush" style="padding: 10px;">

                <form style="padding: 10px;" enctype="multipart/form-data" action="/motors/{{$motor->id}}" method="POST">
                    @csrf
                    @method('PUT')

                    <h4>Price: </h4>
                    <input class="form-control @error('price') is-invalid @enderror" style="width: 90% ; margin: 2rem;" type="number" name="price" lang="nb" value="{{$motor->price}}" step="500">
                    @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <h4>Construction Date: </h4>
                    <input class="form-control @error('constructionDate') is-invalid @enderror" style="width: 90%; margin: 2rem;" type="text" name="constructionDate" lang="nb" value="{{$motor->constructionDate}}">
                    @error('constructionDate')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <h4>Color: </h4>
                    <input class="form-control @error('color') is-invalid @enderror" style="width: 90%; margin: 2rem;" type="text" name="color" lang="nb" value="{{$motor->color}}">
                    @error('color')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror


                    <h4>Model: </h4>
                    <input class="form-control @error('model') is-invalid @enderror" style="width: 90% ; margin: 2rem;" type="text" name="model" lang="nb" value="{{$motor->model}}">
                    @error('model')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <h4>Brand: </h4>
                    <input class="form-control  @error('brand') is-invalid @enderror" style="width: 90% ; margin: 2rem;" type="text" name="brand" lang="nb" value="{{$motor->brand}}">
                    @error('brand')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <h4>Description: </h4>
                    <textarea class="form-control  @error('description') is-invalid @enderror" name="description" style="width: 90% ; margin: 2rem; font-size: 2rem;" rows="8" value="">{{$motor->description}}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <span class="normalLabels">Picture:</span>
                    <div class="custom-file" style="margin: 10px 0;">
                    <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
                    <input id="picFile" value="browse" type="file" class="custom-file-input @error('picture') is-invalid @enderror" name="picture" placeholder="Upload picture..."><br>
                    @error('picture')
                    <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                    </span>
                     @enderror
                    <label class="custom-file-label" for="picFile">Choose picture</label>
                    </div>






                    <span class="normalLabels">Thumbnail picture:</span>
                    <div class="custom-file" style="margin: 10px 0;">
                    <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
                    <input id="thumbFile" value="browse" type="file" class="custom-file-input @error('picture') is-invalid @enderror" name=" thumbnail" placeholder="Upload thumbnail..."><br>
                    @error('thumbnail')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <label class="custom-file-label" for="thumbFile">Choose thumbnail</label>
                    </div>


                    <div style="display: flex; justify-content: space-around;">

                        <input class="btn btn-success btn-lg" type="submit" value="Update">                        
                        <input id="backButton" type="button" value="Back" class="btn btn-success btn-lg">
                        <!-- !! This button below is a simple button but is submitting the form! -->
                        <!-- <button>simple 1</button> -->

                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>
<br>

<script>
$("#backButton").click(function(){
    window.location.href = "/motors";
});
  // Add the following code if you want the name of the file appear on select
  $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });


</script>

@endsection




