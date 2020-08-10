
$(document).ready(function() {

jQuery.validator.setDefaults({
  ignore: ":hidden, [contenteditable='true']:not([name])",
});

	$("#login-form").validate({
		rules: {
			email: {
		        required: true,
		        email: true,

			    normalizer: function(value) {
					return $.trim(value);
				}
		    },
		    password: {
		        required: true,
		        minlength: 2
		    },
		    captcha:{
		    	required: true
		    }
		},

		submitHandler: function(form) {
	      form.submit();
	    }
	});
});

$(document).ready(function() {

	$("#registration-form").validate({

		rules: {
			email: {
		        required: true,
		        email: true,
			    normalizer: function(value) {
					return $.trim(value);
				}
		    },
		    username: {
		        required: true,
		        minlength: 3,
		        maxlength: 15
		    },
		    first_name: {
		        minlength: 2,
		        maxlength: 32
		    },
		    last_name: {
		        minlength: 2,
		        maxlength: 32
		    },
		    password: {
		        required: true,
		        minlength: 6,
		        maxlength: 32
		    },
		    password_confirmation: {
		        equalTo: "#password"
		    },
		    captcha:{
		    	required: true
		    }
		},

		submitHandler: function(form) {
	      $('.loader-warapper').removeClass('d-none');
	      form.submit();

	    }
	});
});



$(document).ready(function() {

	$("#create-post-form").validate({
		rules: {
			title: {
		        required: true,
		    },
		    category_id: {
		        required: true,
		    },
		    tag: {
		        required: true,
		    },
		    captcha:{
		    	required: true
		    }
		},

		submitHandler: function(form) {
	      form.submit();
	    }
	});
});

$(document).ready(function() {

	$("#update-post-form").validate({
		rules: {
			title: {
		        required: true,
		    },
		    category_id: {
		        required: true,
		    },
		    tag: {
		        required: true,
		    },
		    description: {
		        required: true,
		    },
		    captcha:{
		    	required: true
		    }
		},

		submitHandler: function(form) {
	      form.submit();
	    }
	});
});


$(document).ready(function() {
    $("#profile-form").validate({
      rules: {
          username: {
              required: true,
              minlength: 3,
              maxlength: 15
          },
          first_name: {
              minlength: 2,
              maxlength: 32
          },
          last_name: {
              minlength: 2,
              maxlength: 32
          }
      },

      submitHandler: function(form) {
          form.submit();
        }
    });
    
    $("#company-form").validate({
      rules: {
          name: {
              required: true
          },
          website: {
              url: true
          },
          about: {
              required: true
          },
	      contact_number: {
            	required: true,
    			digits: true,
            	minlength : 11,
            	maxlength : 11
          },
          location: {
              required: true
          }
      },
      messages: {

	        contact_number: {
	        	required : "Please enter a cell phone number",
	            digits: "Please Enter a 11 digits number",
	            minlength: "Please Enter a 11 digits number"
	        }
	   },

      submitHandler: function(form) {
          form.submit();
      }
    });

    $("#change-password-form").validate({
      rules: {
          current_password: {
              required : true,
              minlength: 6,
              maxlength: 32
          },
          new_password: {
              required : true,
              minlength: 6,
              maxlength: 32
          },
          new_confirm_password: {
              equalTo: "#new_password"
          }
      },

      submitHandler: function(form) {
          form.submit();
        }
    });
});    