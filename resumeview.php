<?php
include('config/config.inc.php');
include('config/Database.class.php');
include('classes/common.class.php');
$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();
if(!$co->is_login()){ header("location:login.php"); }
$u = $co->getcurrentuser();
$uu_res = $co->load_users_resume($u['user_id']);
$user_resumes = array();
foreach($uu_res as $uu_re){
	$user_resumes[] = $uu_re['resume_id'];
}
if(!isset($_GET['id']) or !in_array($_GET['id'], $user_resumes)){
	header('Location: login.php?redirect=resumecreate');
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
</head>

<body>
<!--header-->
<div class="header">
             <div class="main_header">
					 <div class="logo">
						<a href="index.php" style="text-decoration:none">
                        <img src="images/logo.png" border="0" alt="" title=""/></a>
					 </div>	
			  </div>
</div>

<div class="line"></div>
<!--header_closed-->

<!--banner-->
<div class="index_content" style="padding:0; overflow:hidden">
	<div class="container">
    	<?php
			include('viewresume.php');
		?>
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
<!--banner_closed-->
<!--footer-->
<div class="index_footer">
<div class="footer_logo"><a href="index.php" style="text-decoration:none">
<img border="0" src="images/footer_logo.png" title="" alt="" /></a></div>
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