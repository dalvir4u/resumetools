<?php
include('config/config.inc.php');
include('config/Database.class.php');
include('classes/common.class.php');
$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();
if($co->is_login()){ header("location:main.php"); }
// Include the random string file
require 'rand.php';
// Begin the session
// Set the session contents
$_SESSION['captcha_id'] = $str;
if($_SERVER['REQUEST_METHOD']=='POST')
{
	$postdata = $_POST;
	// Include the submit file
	if(isset($_POST['form_id']) and $_POST['form_id']=="create_new_user"){	
		//$con['username'] = $postdata['username'];
		$con['password'] = md5($postdata['password']);
		$con['email'] = $postdata['email'];
		$tim = time();
		$con['last_login'] = $tim;
		$con['status'] = 1;
		$con['created'] = $tim;
		$con['updated'] = $tim;
		
		$co->query_insert('users', $con);
		
		if($co->login($postdata['email'],$postdata['password'])){
			?>
			<script language="javascript">window.location="main.php";</script>
			<?php	
		}
	}//end of if form_id is create company
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="content-type" content="text/html" />
<meta name="author" content="" />
<title>User register - Job shepherd</title>
<link rel="stylesheet" type="text/css" href="index_style.css"/>
<!--<link rel="stylesheet" type="text/css" href="style.css"/>-->
<!-- Add jQuery library -->
<script type="text/javascript" src="lib/jquery-1.10.1.min.js"></script>
<!-- Add fancyBox main JS and CSS files -->
<script src="js/jquery.validate.js"></script>
<script>
$(document).ready(function() {
	
	$("#refreshimg").click(function(){
		$.post('newsession.php');
		$("#captchaimage").load('image_req.php');
		return false;
	});
	// validate the comment form when it is submitted
	// validate signup form on keyup and submit
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
	$("#createuser").validate({
		rules: {
			password: {
				required: true,
				minlength: 5
			},
			confirm_password: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			},
			email: {
				required: true,
				email: true,
				checkemail:true
			},			
			agree: "required"
		},
		messages: {
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},
			confirm_password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long",
				equalTo: "Please enter the same password as above"
			},
			email: {
				email: "Please enter a valid email address",
				checkemail: "Email Already Exists",
			},
			agree: "Please accept our policy"
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
</head>

<body>
    <!--header-->
    <div class="header">
	   <div class="main_header">
		 <div class="logo">
					<a href="index.php" style="text-decoration:none"><img border="0" src="images/logo.png" alt="" title=""/></a>
		 </div>	
				<div class="index_chat_now">
				 <ul>
					<li><a href="login.php" style="text-decoration:none"><img border="0" src="images/login.jpg" alt="" title=""/></a></li>
					</ul>
				</div>
	  </div>		
    </div>
    <div class="line"></div>
    <!--header_closed-->
	<!--banner-->
	<div class="login_banner" style="padding:0;">
		<div class="createuser_login_content">
		<div class="register_now">register now</div>
			<div>
            	<?php
				$msg = $co->theme_messages();
				if(isset($msg)){ echo $msg; }
				?>
				<form action="" method="post" id="createuser">
				<input type="hidden" name="form_id" value="create_new_user"/>
					<div class="textarea">
						<label class="create_text" for="normal-field">Email address</label>
						<div>
							<input type="text" name="email" id="email" class="create_input" />
						</div>
					</div>					
					<div class="textarea">
						<label class="create_text" for="normal-field">Password</label>
						<div>
							<input type="password" name="password" id="password" class="create_input">
						</div>
					</div>
                    <div class="textarea">
						<label class="create_text" for="normal-field">Confirm Password</label>
						<div>
							<input type="password" name="confirm_password" id="confirm_password" class="create_input">
						</div>
					</div>
                	<div class="textarea">
                    	<label class="create_text" for="normal-field">&nbsp;</label>
                        <div>
                        	<input type="checkbox" name="agree" id="agree" class="create_checkbox"> <a href="index.php?page_id=2" target="_blank">(I agree to the terms and conditions of the Website)</a>
                        </div>
                    </div>
<?php /*?>                    <div class="textarea">
                    	<div id="captchaimage">
                        <img src="images/image.php?<?php echo time(); ?>" width="132" height="38" alt="Captcha image" />
                        <a href="#" id="refreshimg">Not readable? Change text.</a>
					    </div>
                    </div> 
					 <div class="textarea">   
                        <label class="create_text" for="normal-field">Write Above word</label>
                        <div>
                        	<input type="text" class="captcha" maxlength="6" name="captcha" id="captcha" autocomplete="off" />
                        </div>
					</div>	<?php */?>
                   
				   				
					<div class="footer_go_back">						
						<span class="continue">
                        <input type="submit" name="submit_bt" class="blue_button" value="Create an account" />
                        </span>
					</div>
				</form>		<br />				
			</div><!-- End .login_form -->  				
		</div><!-- End .login_content -->
	</div><!-- End .login_banner -->
	<div class="banner_line"></div>
	<!--footer-->
	<div class="index_footer">
	<div class="footer_logo"><a href="index.php" style="text-decoration:none"><img border="0" src="images/footer_logo.png" title="" alt="" /></a></div>
		<div class="index_footer_menu">
        	<ul>
				<li> <a href="#">  Home  </a></li>
				<li> <a href="#"> About Us</a></li>
				<li> <a href="#">  Terms & Conditions </a></li>
				<li> <a href="#">  Privacy Policy </a></li>
				<li> <a href="#">  Contact Us </a></li>
			</ul>
		</div>
		<h5>Copyright c 2013,JobShepherd, Ltd. First publication dates for works posted from 2013, all rights reserved.</h5>
	</div><!-- End .index_footer_menu -->
	<!-- End .index_footer -->
</body>
</html>