The request object is:
<hr>
{{request()}}
<hr>
The request-&gt;path
<hr>
@if (\Request::is('navigation'))  
  This is navigation
@endif
@if (\Request::is('navigation/*'))  
  This is any subpage of navigation/
@endif

<br>************<br>

{{$test}}

<br>************<br>

{{$request2}}

<br>************<br>

{{Request::path()}}<br>
{{Request::url()}}<br>
{{Request::fullUrl()}}<br>
{{Request::ip()}}<br>
{{Request::secure()}}<br>
{{Request::prefetch()}}<br>
{{Request::ajax()}}<br>
{{Request::userAgent()}}<br>
{{Request::decodedPath()}}<br>


<br>************<br>

{{dd(request())}}

@php dd(request()); @endphp

<hr>
The auth::user object is:
<hr>
{{Auth::user()}}
<hr>