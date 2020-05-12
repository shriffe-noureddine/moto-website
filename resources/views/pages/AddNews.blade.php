@extends('template.mytemplate')

@section('style')
@endsection

@section('title', 'Add Blog')

@section('content')
<div class="container" style="min-height: 90vh; ">

<div>
        <form style="padding: 20px;" action="/news" method="POST">
            @csrf
            <h2>Tilte: </h2><input class="form-control @error('title') is-invalid @enderror" placeholder="Write your blog title here..." type="text" name="title">
            @error('title')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
            @enderror
            <h2>Description:</h2>
            <textarea style=" font-size: 150%;padding: 30px; font-family: 'Times New Roman',
            Times, serif; font-style: italic; "  
            class="form-control z-depth-1 text-left form-control @error('description') is-invalid @enderror"  name="description" id="descritpion"
                placeholder="Write your blog here..." cols="30" rows="10"></textarea><br>
            @error('description')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
            @enderror
                <input class="btn btn-success" type="submit" value="Publish Blog">
                <input type="button" class="btn btn-success" value="Back" id="buttonback"> 
        </form>
    </div> 
    

</div>
    <script>
    $("#buttonback").click( function(e){

            location.href = "/news"; 
        });
    </script>
@endsection




{{-- <form action="/news" method="POST">
    @csrf
    <input type="text" name="title">
    <textarea name="description" id="descritpion" cols="50" rows="20">Description</textarea>
    <input type="submit" value="Create News">
    </form> --}}