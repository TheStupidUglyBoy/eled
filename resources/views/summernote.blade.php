<!DOCTYPE html>
<html lang="en">


<head>
<!-- include libraries(jQuery, bootstrap) -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</head>


<body>


<form method="post" id="summernote-form">
  <textarea id="summernote" name="editordata"></textarea>
  <input type="text" name="text">
  <input type="submit" name="submit" value="submit">
</form>

<script src="{{asset('app/js/jquery.validate.js')}}" ></script>
<script type="text/javascript">
	

$(document).ready(function() {
jQuery.validator.setDefaults({

  ignore: ":hidden, [contenteditable='true']:not([name])"
  //ignore: ":hidden:not(#summernote),.note-editable.card-block",
});

	$("#summernote-form").validate({

		rules: {
			// ignore: ":hidden:not(#summernote),.note-editable.card-block",
			text: {
		        required: true,
		    }
		},

		submitHandler: function(form) {
			console.log('asd');

	    }
	});
});


$(document).ready(function() {
  $('#summernote').summernote();
});


</script>

</body>
</html>
