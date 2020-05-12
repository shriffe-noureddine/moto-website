@extends('template.mytemplate')

@section('links')
@endsection

@section('style')

<style>
h1{
    justify-content: center;
    margin: 0;
    padding: 20px;

}
#mainDiv{
    padding: 15px;
    min-height: 90vh;
}
</style>
@endsection

@section('title', 'Users table')

@section('nav-content')
@endsection


@section('content')
<div id="mainDiv" class="table-responsive">

    <h1 style=" font-family: 'Times New Roman', Times, serif; font-style: italic; " class="container">This is users list page ...</h1>
    
    @if(count($users) > 0)
    <table  class="table table-dark table-striped table-hover">
        <tr>
            <th>ID</th>
            <th>User name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Location</th>
            <th>level</th>
            
        </tr>
        @foreach($users as $user)
        <tr> 
            <td>
                {{$user->id}}
            </td>
            <td>
                {{$user->name}} 
            </td>
            <td>
                {{$user->email}}
            </td>
            <td>
                {{$user->phone}}
            </td>
            <td>
                {{$user->location}}
            </td>
            <td>
                {{$user->level}}
            </td>
            <td>
                
            <a class="btn btn-outline-success" href="/users/{{$user->id}}"><button>Details</button></a>    
            <a class="btn btn-outline-success" href="/users/{{$user->id}}/edit"><button>Edit</button></a>              
            </td>
    
        </tr>
        @endforeach
    </table>
    @endif
</div>

@endsection

