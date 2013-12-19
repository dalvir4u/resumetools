<?php
include('config/config.inc.php');
include('config/Database.class.php');
include('classes/common.class.php');
$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();
if(!$co->is_login()){ header("location:login.php"); }


if($_SERVER['REQUEST_METHOD']=='POST')
{
	$postdata = $_POST;
	// Include the submit file
	if(isset($_POST['form_id']) and $_POST['form_id']=="edituser"){	
		$u = $co->getcurrentuser();
		if($postdata['password']!=""){
			if($u['password']==md5($postdata['oldpassword'])){
				$con['password'] = md5($postdata['password']);
				$con['email'] = $postdata['email'];
				$tim = time();
				$con['updated'] = $tim;		
				$co->query_update('users', $con, 'user_id='.$_SESSION['user_id']);
				$co->setmessage("status", "login information updated successfully");
			}else
				$co->setmessage("error", "Old password is not correct");
		}else{
			$con['email'] = $postdata['email'];
			$tim = time();
			$con['updated'] = $tim;		
			$co->query_update('users', $con, 'user_id='.$_SESSION['user_id']);
			$co->setmessage("status", "login information updated successfully");
		}
	}//end of if form_id is create company
}
$u = $co->getcurrentuser();
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="content-type" content="text/html" />
<meta name="author" content="" />
<title>Edit account - Job shepherd</title>
<link rel="stylesheet" type="text/css" href="index_style.css"/>
<!--<link rel="stylesheet" type="text/css" href="style.css"/>-->
<!-- Add jQuery library -->
<script type="text/javascript" src="lib/jquery-1.10.1.min.js"></script>
<!-- Add fancyBox main JS and CSS files -->
<script src="js/jquery.validate.js"></script>

<script>
$(document).ready(function() {
	
	
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
</head>

<body>
    <!--header-->
    <div class="header">
         <div class="main_header">
            <div class="logo">
                <a href="index.php" style="text-decoration:none">
                    <img border="0" src="images/logo.png" alt="" title=""/>
                </a>
            </div>		 
        </div>
    </div>
    <div class="line"></div>
    <!--header_closed-->
<div class="index_content" style="padding:0; overflow:hidden">
	<div class="container">
    	<h2>Edit Account</h2>	
			<?php
			$msg = $co->theme_messages();
			if(isset($msg)){ echo $msg; }
			?>
			<form action="" method="post" id="edituser">
			<input type="hidden" name="form_id" value="edituser"/>
				<div class="textarea">
					<label class="create_text" for="normal-field">Email</label>
					<div>
						<input type="text" name="email" value="<?=$u['email']?>" id="email" class="create_input" />
					</div>
				</div>
                <div class="textarea">
					<label class="create_text" for="normal-field">Old Password</label>
					<div>
						<input type="password" name="oldpassword" id="oldpassword" class="create_input">
					</div>
				</div>					
				<div class="textarea">
					<label class="create_text" for="normal-field">New Password</label>
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
					<input type="submit" name="submit_bt" value="Save Changes" class="blue_button"/>
					</span>
				</div>
			</form> <br />
    </div>
    <div class="sidebar">
    	<div class="block" id="user_menu">
        	<div class="title">User Menu</div>
            <div class="matter">
            	<ul>
                	<li><a href="main.php">My Account</a></li>
                    <li><a href="editaccount.php">Edit Account</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>				
</div>    
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