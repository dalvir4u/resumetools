<?php
include('config/config.inc.php');
include('config/Database.class.php');
include('classes/common.class.php');
$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();
if($co->is_login()){ header("location:main.php"); }

if($_SERVER['REQUEST_METHOD']=='POST')
{
	$postdata = $_POST;
	// Include the submit file
	if(isset($_POST['form_id']) and $_POST['form_id']=="user_pass_reset"){	
		$uu = $co->query_first("select * from users where resetpath='".$_POST['resetid']."'");
		if(isset($uu['user_id']) and $uu['user_id']>0){
			$con['resetpath'] = '';
			$co->query_update('users', $con, 'user_id='.$uu['user_id']);
			$_SESSION['user_type'] = 'user';
			$_SESSION['user_id'] = $uu['user_id'];
			$_SESSION['weblogin']="job-shep";
			?>
			<script language="javascript">window.location="editaccount.php";</script>
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
		<div class="register_now">Reset Password</div>
			<div>
            	<?php
				$msg = $co->theme_messages();
				if(isset($msg)){ echo $msg; }
				if(isset($_GET['path'])){
					$uu = $co->query_first("select * from users where resetpath='".$_GET['path']."'");
					if(isset($uu['user_id']) and $uu['user_id']>0){
						$rtime = $uu['resettime']+(60*60*24);
						echo '<div><p>This is a one-time login for <em class="placeholder">'.$uu['username'].'
						</em> and will expire on <em class="placeholder">'.date('d M Y, h:ia', $rtime).'</em>.
						</p><p>Click on this button to log in to the site and change your password.</p>
						<p>This login can be used only once.</p>';
				?>
<form method="post">                
<input type="hidden" value="<?=$uu['resetpath']?>" name="resetid">
<input type="hidden" value="user_pass_reset" name="form_id">
<input type="submit" class="form-submit" value="Log in" name="op" id="edit-submit">
</form>
						</div>	
				<?php
                	}else{
						
					}
				}
				?>
										
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