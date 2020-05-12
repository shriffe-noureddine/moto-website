<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<h3>ajax testing</h3>

<form>
@csrf
<input type="text" name="test" value="I am testing">
</form>


<button id="ajaxButton">Ajax</button>
<div id="resultDiv">
    ... response ...
</div>

<script>
    $(function() {

        $('#ajaxButton').click(function(e) {           
            $.ajax({                
                url: '/testing/ajax',
                type: 'put',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: $('form').serialize(),
                success: function(result) {
                    $('#resultDiv').html('<div style="border:5px solid green">' + JSON.stringify(result) + '</div>');
                },
                error: function(err) {
                    $('#resultDiv').html('<div style="border:5px solid red">' + JSON.stringify(err) + '</div>');
                }
            });
        });
    });
</script>

<hr>
<h3>ajax function without a form</h3>

<button id="buttonAjax">without a form</button> <br>
<div id="otherResultDiv">
  ... response here
</div>



<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $(function() {
    $('#buttonAjax').click(function(e) {
      $.ajax({
        url: '/testing/ajax',
        type: 'delete',
        // headers: {
        //   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        // },
        //data: $('form').serialize(),
        data: {
            test: "test",            
            bearing: 90,
            '_token': '{!! csrf_token() !!}' // this makes it work without a form
        },       
        success: function(result) {
          $('#otherResultDiv').html('<div style="border:5px solid green">' + JSON.stringify(result) + '</div>');
        },
        error: function(err) {
          $('#otherResultDiv').html('<div style="border:5px solid red">' + JSON.stringify(err) + '</div>');
        }
      });
    });
  });
</script>