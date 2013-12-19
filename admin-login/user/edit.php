<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{
	$postdata = $_POST;
	// Include the submit file
	if(isset($_POST['form_id']) and $_POST['form_id']=="edituser"){	
		if($postdata['password']!=""){
			$con['password'] = md5($postdata['password']);
		}
		$con['email'] = $postdata['email'];
		$con['status'] = $postdata['status'];
		$tim = time();
		$con['updated'] = $tim;		
		$co->query_update('users', $con, 'user_id='.$postdata['uid']);
		$co->setmessage("status", "login information updated successfully");
	}//end of if form_id is create company
}
?>
<script type="text/javascript" src="../lib/jquery-1.10.1.min.js"></script>
<!-- Add fancyBox main JS and CSS files -->
<script src="../js/jquery.validate.js"></script>

<script>
$(document).ready(function() {
	
	
	$.validator.addMethod("checkemail", 
		function(value, element) {
			var result = false;
			$.ajax({
				type:"GET",
				async: false,
				url: "checkemail.php?id=<?=$_GET['id']?>&va=" + value,
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
	$("#edituser").validate({
		rules: {
			password: {
				minlength: 5
			},
			confirm_password: {
				minlength: 5,
				equalTo: "#password"
			},
			email: {
				required: true,
				email: true,
				checkemail:true
			}
		},
		messages: {
			password: {
				minlength: "Your password must be at least 5 characters long"
			},
			confirm_password: {
				minlength: "Your password must be at least 5 characters long",
				equalTo: "Please enter the same password as above"
			},
			email: {
				email: "Please enter a valid email address",
				checkemail: "Email Already Exists",
			},
		}
	});
	
});

/*captcha: {
				required: true,
				remote: "process.php"
			},
			
captcha: {
				remote: "Correct captcha is required. Click the captcha to generate a new one"
			},
				*/		
</script>
<div class="pagehead">Edit User</div>
<div class="con">
<?php
if(isset($_GET['id'])){
	$u=$co->load_single_user($_GET['id']);
	$msg = $co->theme_messages();
	if(isset($msg)){ echo $msg; }
if(isset($u['user_id']) and $u['user_id']>0){	
?>
<form action="" method="post" id="edituser">
	<input type="hidden" name="form_id" value="edituser"/>
    <input type="hidden" name="uid" value="<?=$u['user_id']?>"/>
	<div class="form-item">
		<label>User Name : </label>
		<input type="text" name="user" disabled value="<?=$u['username']?>" class="create_input" />
	</div>
	<div class="form-item">
		<label>Email</label>
		<input type="text" name="email" value="<?=$u['email']?>" id="email" class="create_input" />
	</div>					
	<div class="form-item">
		<label>Password</label>
		<input type="password" name="password" id="password" class="create_input">
	</div>
	<div class="form-item">
		<label>Confirm Password</label>
		<input type="password" name="confirm_password" id="confirm_password" class="create_input">
	</div>
    <div class="form-item">
		<label>Status</label>
		<input type="radio" name="status"<?php if($u['status']==1){ echo ' checked="checked"';} ?> value="1" />Active &nbsp; 
        <input type="radio" name="status"<?php if($u['status']==0){ echo ' checked="checked"';} ?> value="0" />Inactive
	</div>
	<div class="form-submit">
    	<input type="submit" class="blue_button" name="addnew" value="Update" />
	</div>
</form>
<?php
}
}
?>
</div>