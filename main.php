<?php
include('config/config.inc.php');
include('config/Database.class.php');
include('classes/common.class.php');
$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();
if(!$co->is_login()){ header("location:login.php"); }
$u = $co->getcurrentuser();
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="" />
   
    <title>job-shep</title>
     <link rel="stylesheet" type="text/css" href="index_style.css"/>
     <script type="text/javascript" src="lib/jquery-1.10.1.min.js"></script>
     <script src="js/religions_edit.js"></script>
     <!--<link rel="stylesheet" type="text/css" href="style.css"/>-->
	 <!-- Add jQuery library -->
</head>

<body>
<!--header-->
<div class="header">
             <div class="main_header">
					 <div class="logo">
								<a href="index.php" style="text-decoration:none"><img border="0" src="images/logo.png" alt="" title=""/></a>
					 </div>	
			  </div>
</div>

<div class="line"></div>
<!--header_closed-->

<!--banner-->
<div class="index_content" style="padding:0; overflow:hidden">
	<div class="container">
    	<h2>All Resumes
        <span style="float:right;">
        <a href="resumecreate.php" style="text-decoration:none;">
        <img border="0" src="images/create_resume.jpg" alt="" title="" />
        </a>
        </span>
        </h2>	
	<?php
	$u_resumes = $co->load_users_resume($_SESSION['user_id']);
	foreach($u_resumes as $u_resume){
		echo '		
		<div class="block">
			<div class="title">'.$u_resume['first_name'].' '.$u_resume['last_name'].'</div>
			<div class="resume_imeage"><img src="images/'.strtolower($u_resume['temp']).'.jpg" title="" alt="" />  </div>
			<p><br /><br />
			<a href="resumeview.php?id='.$u_resume['resume_id'].'" class="clean-gray">View Full Resume</a>  
			<a href="resumecreate.php?id='.$u_resume['resume_id'].'" class="clean-gray">Edit Resume</a> 
			<a href="printresume.php?id='.$u_resume['resume_id'].'" class="clean-gray">Print</a>
			<a target="_blank" href="htmltopdf/dompdf/www/domcreate.php?id='.$u_resume['resume_id'].'" class="clean-gray">Download as PDF</a>  
			<a target="_blank" href="htmltopdf/create_doc.php?id='.$u_resume['resume_id'].'" class="clean-gray">Download as DOC</a>   
			</p>
		</div>		
		';
	}
	
	?>
<!--<a target="_blank" href="htmltopdf/create_DOC.php?id='.$u_resume['resume_id'].'"><img src="img/doc_icon.png" title="" alt="" />Download as DOC</a>   
<a target="_blank" href="htmltopdf/create_DOC.php?id='.$u_resume['resume_id'].'"><img src="img/email_icon.png" title="" alt="" />E mail</a>-->	
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
<div class="footer_logo"><a href="index.php" style="text-decoration:none"><img border="0" src="images/footer_logo.png" title="" alt="" /></a></div>
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