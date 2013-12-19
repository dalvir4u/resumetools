<?php
include('config/config.inc.php');
include('config/Database.class.php');
include('classes/common.class.php');
$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();
if($co->is_login()){ header("location:main.php"); }
$username = "";
$pwd = "";	
$errormsg = "";
$msg = "";
if($_SERVER['REQUEST_METHOD']=='POST')
{
	if($_POST['submit']=="Login")
	{
		$username = trim($_POST['username']);
		$pwd = $_POST['password'];
		
		if($username=='' && $pwd=='')
		{
			$co->setmessage("error", "Please enter username and password!");
		}
		elseif($co->login($username,$pwd))
		{				
			if($_POST['redirect']=="resumecreate"){
			?>
			<script language="javascript">window.location="resumecreate.php";</script>
			<?php
			}else{
			?>
			<script language="javascript">window.location="main.php";</script>
			<?php
			}
			exit();
		}		
		else
		{
			$co->setmessage("error", "Invalid Username/Password");
		}
	}
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="" />
   
    <title>job-shep</title>
     <link rel="stylesheet" type="text/css" href="index_style.css"/>
     <!--<link rel="stylesheet" type="text/css" href="style.css"/>-->
	 <!-- Add jQuery library -->
	<script type="text/javascript" src="lib/jquery-1.10.1.min.js"></script>
	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="source/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css?v=2.1.5" media="screen" />
	<script src="js/jquery.validate.js"></script>
	<script src="js/religions_edit.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */
			jQuery.validator.addMethod("alphanumericspecial", function(value, element) {
				return this.optional(element) || value == value.match(/^[-a-zA-Z0-9_]+$/);
			}, "Only letters, Numbers & Underscore Allowed.");
			
			$("#loginuser").validate({
				rules: {
					username: {
						required: true,
						email:true			
					},
					password: {
						required: true,		
					}
				},
				messages: {
					username: {
						required: "Please enter a username"
					},
					password: {
						required: "Please enter a password"
					}
				}
			});
			
			$('.fancybox').fancybox();

			/*
			 *  Different effects
			 */
		});
	</script>
</head>

<body>
<!--header-->
<div class="header">
               <div class="main_header">
					 <div class="logo">
					 <a href="index.php" style="text-decoration:none">
                     	<img src="images/logo.png" border="0" alt="" title="" />
                     </a>
					 </div>	
               </div>		   
</div>

<div class="line"></div>
<!--header_closed-->

<!--banner-->
<div class="login_banner" style="padding:0;">
				<div class="login_content">
					<div class="login_content_left">
						<div class="login_welcome">Welcome back! Please sign in.</div>
									<div class="login_form">
                                    <?php
									$msg = $co->theme_messages();
									if(isset($msg)){ echo $msg; }
									?>
											<form action="" method="post" id="loginuser">
												<input type="hidden" name="form_id" value="form_login_page"/>
                                                <input type="hidden" name="redirect" value="<?php if(isset($_GET['redirect'])){ echo $_GET['redirect']; } ?>" />
												<div class="login_textarea">
													<label class="login_class" for="normal-field">Email Address</label>
													<div class="">
														<input type="text" name="username" class="login_Email_text" />
													</div>
												</div>
												<div class="login_textarea">
													<label class="login_class" for="normal-field">Password</label>
													<div class="">
														<input type="password" name="password" class="login_Email_text" />
													</div>
												</div>
												<div class="login_text">
													<label class="login_class" for="normal-field"><a href="forgetpassword.php">Forgot your password?</a></label>
												</div>
                                                <div class="login_textarea">
														<div class="">
														<input type="submit" name="submit" value="Login" class="blue_button" />
													</div>
												</div>
												
											</form>
						</div>				
						
                        </div>
						<div class="login_content_right">
						<div class="login_right_text">
						New to Job Shepherd?
						<h4>Get started now. It's fast and easy!<br/>
Only for new users who have never created a resume on our site.</h4>
<div class="login_sign">
<a style="text-decoration:none" href="createuser.php">
<img src="images/sign.png" border="0" alt="" title="" /></a></div>
						
						</div>
						
                        </div>  				
				</div>
				
</div>
<div class="banner_line"></div>
<!--banner_closed-->
<!--footer-->
<div class="index_footer">
<div class="footer_logo"><a href="index.php" style="text-decoration:none">
<img src="images/footer_logo.png" border="0" title="" alt="" /></a></div>
										 <div class="index_footer_menu"> <ul>
											 <li> <a href="#">  Home  </a></li>
											 <li> <a href="#"> About Us</a></li>
											 <li> <a href="#">  Terms & Conditions </a></li>
											 <li> <a href="#">  Privacy Policy </a></li>
											 <li> <a href="#">  Contact Us </a></li>
											 
																	 </ul>
										 </div>
										 <h5>Copyright c 2013,JobShepherd, Ltd. First publication dates for works posted from 2013, all rights reserved.</h5>
</div>
<!--footer_cloced-->



</body>
</html>