<?php
/*basic config files and including databace and common function files */
include('config/config.inc.php');
include('config/Database.class.php');
include('classes/common.class.php');
/*colling db conaction function*/
$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="" />
	 <link rel="shortcut icon" href="img/jobshepherd_icon.png" />
    <title>Homepage - Job Shepherd</title>
    <link rel="stylesheet" type="text/css" href="index_style.css"/>
    <script type="text/javascript" src="lib/jquery-1.10.1.min.js"></script>
	<script src="js/modernizr.custom.js"></script>
	<script src="js/lightbox-2.6.min.js"></script>
    <link rel="stylesheet" href="js/lightbox.css" media="screen"/>
</head>

<body>
	<div class="header">
	 <div class="main_header">
		 <div class="logo">
					<a href="index.php" style="text-decoration:none"><img border="0" src="images/logo.png" alt="" title=""/></a>
		 </div>	
		<div class="index_chat_now">
			<?php
			/*cheking if user is loging or not*/
			if($co->is_login()){
			?>
            <ul>
			<li> <a href="main.php" style="text-decoration:none"><img border="0" src="images/my_account.png" alt="" title=""/></a></li>
            <li> <a href="logout.php" style="text-decoration:none"><img border="0" src="images/log_out.png" alt="" title=""/></a></li>
			</ul>
            <?php
			}else{
			?>
            <ul>
			<li> <a href="login.php" style="text-decoration:none"><img border="0" src="images/login.jpg" alt="" title=""/></a></li>
			</ul>
            <?php
			}
			?>
				 
		</div>
		
	</div>		
	</div><!--End of header class-->
	<div class="line"></div>
<?php
/*including files for templeate page and all other pages managesd for backand*/ 
if(isset($_GET['page_id'])){
	if($_GET['page_id']=="templates"){
		include('templates.php');	
	}else{
		include('page.php');
	}
}else{
	include('homepage.php');		
}
?>
<div class="index_footer">
<div class="footer_logo"><a href="index.php" style="text-decoration:none"><img border="0" src="images/footer_logo.png" title="" alt="" /></a></div>
<div class="index_footer_menu">
 <ul>
<li> <a href="index.php">  Home  </a></li>
<li> <a href="index.php?page_id=1"> About Us</a></li>
<li> <a href="index.php?page_id=2">  Terms & Conditions </a></li>
<li> <a href="index.php?page_id=3">  Privacy Policy </a></li>
<li> <a href="#">  Contact Us </a></li>

</ul>
</div>
<h5>Copyright c 2013,JobShepherd, Ltd. First publication dates for works posted from 2013, all rights reserved.</h5>
</div>



</body>
</html>