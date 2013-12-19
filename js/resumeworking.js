$(document).ready(function() {
	// validate the comment form when it is submitted
	// validate signup form on keyup and submit
	$("#create_form").validate({
		rules: {
			first_name: {
				required: true,		
			},
			last_name: {
				required: true,		
			}
		},
		messages: {
			first_name: {
				required: "Please enter a First Name"
			},
			last_name: {
				required: "Please enter a Last Name"
			}
		}
	});
	
	$('.fancybox').fancybox({
	   helpers : {
			title: {
				type: 'outside',
				position: 'top'
			}
	   },
	   'modal'          : true,
	   'closeBtn '      : false,
	});	
	
	$("#createcontact_form").validate({
		rules: {
			street: {
				required: true,
			},			
			city: {
				required: true,
			},
			zip: {
				required: true,
			},
			phone_num: {
				required: true,
			},
			email: {
				required: true,
			},
			disclaimer: {
				required: true,
			},
		}
	});
	
	$.validator.addMethod("checkemail", 
		function(value, element) {
			var result = false;
			$.ajax({
				type:"GET",
				async: false,
				url: "Ajax/checkemail.php?va=" + value,
				success: function(msg) {
					if(msg=="exists")
					   result = false;
				    else
					   result = true;
				}
			});
			return result;
		}, 
		"Email Already Exists."
	);
	jQuery.validator.addMethod("alphanumericspecial", function(value, element) {
				return this.optional(element) || value == value.match(/^[-a-zA-Z0-9_]+$/);
	}, "Only letters, Numbers & Underscore Allowed.");
	$("#createuser_second").validate({
		rules: {
			password: {
				required: true,
				minlength: 5
			},			
			email: {
				required: true,
				email: true,
				checkemail:true
			},
			confirm_email: {
				required: true,
				email: true,
				equalTo: "#email"
			},
		},
		messages: {
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},			
			email: {
				email: "Please enter a valid email address",
				checkemail: "Email Already Exists",
			},
			confirm_password: {
				email: "Please enter a valid email address",
				equalTo: "Please enter the same email address as above"
			},
		}
	});		
	
	$("#mask_phone").mask("999-999-9999");
	$("#mask_zip").mask("99999");
	
	$('#my-select').multiSelect();
	$("#createuser_first input:checkbox").uniform();
});

function fancy_close(){
	parent.jQuery.fancybox.close();	
}
function close_andrefresh(id){
	$('#qwe3').load('displayresume.php?id='+id);
	parent.jQuery.fancybox.close();
}
function delete_education(id){
	var r = confirm("Are you you want to delete ");
	$('#qwe3').load('displayresume.php?id='+id);
	parent.jQuery.fancybox.close();
}
function load_career_sub(id){
	var url = "Ajax/load_career_sub.php";
	$.post(url, {cid: id}, 
		function(data){
			$('#career_sub_val').html(data);
		}
	);	
}