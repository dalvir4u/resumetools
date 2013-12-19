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
	if(isset($_POST['form_id']) and $_POST['form_id']=="request_new_passr"){
		if($postdata['username']!=""){
		$val = $postdata['username'];	
		$user = $co->query_first("SELECT * FROM users WHERE username='$val' or email='$val'");
		if(isset($user['user_id']) and $user['user_id']>0){
			$newpath = $co->generate_resetpath(20, $user['user_id']);
			$to=$user['email'];
			$subject = 'Replacement login information for '.$user['username'].' at Job Sheperd';
			$body = ''.$user['username'].',<p>A request to reset the password for your account has been made at 
			Job sheperd.</p><p>You may now login by clicking this link or copying and pasting it to your browser:<br />
			<a href="'.WEB_ROOT.'/resetpassword.php?path='.$newpath.'">'.WEB_ROOT.'/resetpassword.php?path='.$newpath.'</a>			
			</p>
			<p>This link can only be used once  to log in and will lead you to a page where you can login.
			it expires after one day and nothing will happen if its not used.
			</p>
			';
			$co->send_email($to, $subject, $body);
			$u_up['resetpath'] = $newpath;
			$u_up['resettime'] = time();
			$co->query_update('users', $u_up, 'user_id='.$user['user_id']);
			$co->setmessage("status", "Further instructions have been sent to your e-mail address.");	
		}
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
	
	$("#forgetpass").validate({
		rules: {
			username: {
				required: true,				
			}
		},
		messages: {
			username: {
				required: "Please enter a username or email"
			}
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
        <div class="index_chat_now">
        	<ul>
			<li> <a href="login.php"><img src="images/login.jpg" alt="" title=""/></a></li>
			</ul>
            <div class="logo">
                <a href="<?=WEB_ROOT?>">
                    <img style="margin-top:10px;" src="images/logo.jpg" alt="" title=""/>
                </a>
            </div>		 
        </div>
    </div>
    <div class="line"></div>
    <!--header_closed-->
	<!--banner-->
	<div class="login_banner" style="padding:0;">
		<div class="createuser_login_content">
		<div class="register_now">Request New Password</div>
			<div>
            	<?php
				$msg = $co->theme_messages();
				if(isset($msg)){ echo $msg; }
				?>
				<form action="" method="post" id="forgetpass">
				<input type="hidden" name="form_id" value="request_new_passr"/>
					<div style="margin:10px auto; width:500px;">
						<div style="color:#009CB9;font-size:18px;">Enter Username or Email</div>
						<div>
							<input type="text" name="username" id="username" class="create_input" />
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
                        <input type="submit" name="submit_bt" class="blue_button" value="Submit" />
                        </span>
					</div>
				</form>						
			</div><!-- End .login_form -->  				
		</div><!-- End .login_content -->
	</div><!-- End .login_banner -->
	<div class="banner_line"></div>
	<!--footer-->
	<div class="index_footer">
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