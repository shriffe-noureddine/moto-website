{{json_encode(request()->route()->getAction())}}
<hr>
{{$status}}
<hr>
{{$message}}
<hr>
<hr>

<div id="message">

</div>

<?php
$uri = request()->route()->uri;
switch ($status) {
    case "info":
        $color = "blue";
        break;
    case "warning":
        $color = "orange";
        break;
    default:
        $color = "red";
}

$redirect = "/";
if (strpos($uri, 'motor') !== false) {
    $redirect = '/motors';
}

echo '
    <script>
    document.getElementById("message").innerHTML = "<span style=\"font-size:3rem;border: 5px solid '.$color.'\";>' . $message . '</span>";
    setTimeout(function(){
        window.location.href = "'.$redirect.'";    
    }, 3000);    
    </script>
    ';
?>