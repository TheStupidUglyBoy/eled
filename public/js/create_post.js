

$(document).ready(function() {

    $('#editor').summernote({

    	placeholder: 'Create Your Post Now',
        tabsize: 2,
        height: 300,
        callbacks : {
	        onImageUpload: function(image) {
	            uploadImage(image[0]);
	        }
	    },
	    toolbar: [
		    ['style', ['bold', 'italic', 'underline', 'clear']],
		    ['font', ['strikethrough', 'superscript', 'subscript']],
		    ['fontsize', ['fontsize']],
		    ['color', ['color']],
		    ['para', ['ul', 'ol']],
		    ['height', ['height']],
		    ['insert', ['link', 'picture', 'video']]
		]
    });


    function uploadImage(image) {

	    var data = new FormData();
	    data.append("image",image);
	    $.ajax ({
	        data: data,
	        type: "POST",
	        headers: {"X-CSRF-TOKEN": $('meta[name="_token"]').attr('content') } ,
	        url: $('#upload_image_url').text() ,
	        cache: false,
	        contentType: false,
	        processData: false,
	        success: function(data) {

	           		$('#editor').summernote("insertImage", data , 'class=img-fluid');
	           		//console.log(data);

            	},
            	
	            error: function (request, status, error) {
			        alert( "Image validation fails , file type must be : peg,png,jpg,gif,svg , size must not larger than 2048 kilobytes" );
			    }
	        });
	}

	$("#tag").tagsinput('items');

	$('#product-inforamtion-form').hide();
	$('#link-product-btn').click(
		function(event) {
			event.preventDefault();
			$("#product-inforamtion-form").toggle();
	});


});