/*
	$(document).ready(function() {
			

					
			// validate contact form on keyup and submit
			$("#the_only_form").validate({
			
			 errorElement: "span", 
			 
			 
			//set the rules for the fields
			rules: {
			
				std_num: {
					required: true,
					minlength: 5,
					maxlength:25,
					lettersonly: true
				},
				email: {
					required: true,
					email: true
				},
				password: {
					required: true,
					minlength: 5,
					maxlength:15
				},
				
				gender : {
					required :true
				},
				
				state : {
					required :true
				},
				
				terms : {
					required :true
				},	
				
			},
			//set messages to appear inline
			messages: {
			
				std_num: {
					required: "Name is required..",
					minlength: "Your ppp must be at least 5 characters long"
				},
				
				password: {
				required: "Please provide a password.",
				minlength: "Your ppp must be at least 5 characters long",
				maxlength: "Password can not be more than 15 characters"
				},
				
				email: "Valid email is required.",
				
				terms: "You must agree to our terms.",
				gender: "Gender is required",
				state: "Select state"
				
				
				
			},
			
		errorPlacement: function(error, element) {               
					error.appendTo(element.parent());     
				}

		});
	});
*/


$(document).ready(function() {
	$( "#the_only_form" ).validate({

		errorElement: "span", 

		rules: {
			std_num: {
				required: true,
				minlength: 9,
				maxlength: 9,
			}
		},

		// set error message
		messages: {
			std_num: {
				required: " Please provide your student number",
				minlength: " Invalid Student number format, please re-etner.",
				maxlength: " Invalid Student number format, please re-etner."
			},
		}
	});
});
