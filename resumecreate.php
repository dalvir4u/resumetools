<?php
include('config/config.inc.php');
include('config/Database.class.php');
include('classes/common.class.php');

$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();

//chking if user is able to edit this resume. if user does not have access, user will be redirected to appropiate page
$user_resumes = array();
if($co->is_login()){
	$u = $co->getcurrentuser();
	$uu_res = $co->load_users_resume($u['user_id']);
	foreach($uu_res as $uu_re){
		$user_resumes[] = $uu_re['resume_id'];
	}
}
if($co->is_login()){
	if(isset($_GET['id'])){
		if(!in_array($_GET['id'], $user_resumes)){
			header('Location: main.php');
		}
	}
}else{
	if(isset($_GET['id'])){
		if(!in_array($_GET['id'], $user_resumes)){
			$co->setmessage("warning", "Please login to update resume");
			header('Location: login.php?redirect=resumecreate');
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
    <link rel="stylesheet" type="text/css" href="source/uniform.default.css"/>
	<!-- Add jQuery library -->
	<script type="text/javascript" src="lib/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="source/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css?v=2.1.5" media="screen" />
	<link href="source/multi-select.css" media="screen" rel="stylesheet" type="text/css">	
    <link rel="stylesheet" type="text/css" href="source/jquery.cleditor.css" />
	<script language="JavaScript" type="text/javascript" src="js/jquery.cleditor.min.js"></script>
	<script src="js/jquery.validate.js"></script>
	<script src="js/religions_edit.js"></script>
    <script src="js/jquery.multi-select.js" type="text/javascript"></script>
    <script src="js/jquery.uniform.js" type="text/javascript"></script>
    <script src="js/jquery.maskedinput.js" type="text/javascript"></script>    
	<script type="text/javascript">
		$(document).ready(function() {			
			 <?php
			 if(!$co->is_login()){
			 ?>
			 $.fancybox( {href : '#createresume_block', title : '&nbsp;', helpers : {
					title: {
						type: 'outside',
						position: 'top'
					}
			   },
			   'modal'          : true,
			   'closeBtn '      : false,} );
			 <?php
			 }
			 elseif(isset($_GET['fn'])){
			 ?>
				$(".name_edit a").trigger('click');
			 <?
			 }
			 else{
				 if(!isset($_GET['id'])){
			 ?>			 
			 $.fancybox( {href : '#default_matter', title : 'Create Resume', helpers : {
					title: {
						type: 'outside',
						position: 'top'
					}
			   },
			   'modal'          : true,
			   'closeBtn '      : false,} );
			   
			  
			 <?php
				
				 }else{
					 if(isset($_GET['fourth'])){
			 ?>
			   $.fancybox( {href : '#create_address_block', title : 'Edit Resume', helpers : {
					title: {
						type: 'outside',
						position: 'top'
					}
			   },
			   'modal'          : true,
			   'closeBtn '      : false,} );
			 <?php
					 }
				 }
			 }			 
			 ?>			 
		});		
	</script>
	<script src="js/resumeworking.js" type="text/javascript"></script>  
</head>
<body>
<div style="display:none">
    <div id="createresume_block">
        <?php include('Ajax/createresume_block.php'); ?>
    </div>
    
    <div id="select_temp_block">
        <?php include('Ajax/select_temp_block.php'); ?>
    </div>
    
    <div id="create_user_block">
        <?php include('Ajax/create_user_block.php'); ?>
    </div>
    
    <div id="create_address_block">
        <?php include('Ajax/create_address_block.php'); ?>
    </div>
            
    <div id="default_matter">
        <?php include('Ajax/default_matter.php'); ?> 
    </div>        
</div>

<a id="default_pop" style="display:none" class="fancybox" title="Create Resume" href="#default_matter"></a>
<!--Start of header file-->
<div class="header">
	<div class="main_header">
		<div class="logo">
			<a href="index.php" style="text-decoration:none">
			<img border="0" src="images/logo.png" alt="" title=""/></a>
		</div>	
		<div class="index_chat_now">
			<?php
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
</div>
<!--End of header file-->
<div class="line"></div>

<div class="resume_inner_content">		
	<img src="img/inner_logo.png" title="" alt="" />
		<span style="text-align:center; margin-left:20%;">
        	<a style="font-size:12px; text decoration:none; font-weight:bold; color:#00C" href="main.php">Save and return to my Resumes</a>
        </span>
		<div class="qwe1">
			<!--icon-->
			<!--updated on every time resume updated-->
            <div class="edit" id="edit_resume_auto">Edit Your Resume
				<span style="font-size:12px; margin-left:20px;">
				Current Template: 
				<?php
				if(isset($_GET['id'])){
					$res = $co->load_single_resume($_GET['id']);
					echo str_replace("_", " ", $res['temp']);
					echo ' &nbsp; &nbsp; ';
					echo 'Autosaved at '.date('h:i a', $res['updated']);
				}
				?>
				</span>
			</div>
			<!--resume link for updation-->
            <div class="icon">
				<div class="add_section">
					<div class="icon_add"><img src="img/add_section.png" title="" alt="" /></div>
					<a class="fancybox fancybox.ajax" title="Add Section" href="Ajax/add_section.php?id=<?=$_GET['id']?>">Add section</a>
				</div>
				<div class="add_section">
					<div class="icon_add"> <img src="img/manage_sections.png" title="" alt="" /></div>
					<a class="fancybox fancybox.ajax" title="Manage Sections" href="Ajax/manage_section.php?id=<?=$_GET['id']?>">Manage Sections</a>
                </div> 
				<div class="add_section">
                	<div class="icon_add"> <img src="img/download_pdf.png" title="" alt="" /></div>
                    <a target="_blank" href="htmltopdf/dompdf/www/domcreate.php?type=PDF&id=<?=$_GET['id']?>">Download as PDF</a>
                </div> 
				<div class="add_section">
                	<div class="icon_add"> <img src="img/download.jpg" title="" alt="" /></div>
                    <a target="_blank" href="htmltopdf/create_doc.php?id=<?=$_GET['id']?>">Download as DOC</a>
                </div>
				<div class="add_section">
                	<div class="icon_add"> <img src="img/download.jpg" title="" alt="" /></div>
					<a href="printresume.php?id=<?=$_GET['id']?>">Print</a>
                </div>
			</div>
			<!--icon_closd-->
            
			<div class="qwe2">
				<div id="qwe3">
					<?php
					if(isset($_GET['id'])){
						$res = $co->load_single_resume($_GET['id']);
						include('classes/'.$res['temp'].'.class.php');							
						$temp = new template(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
						$temp->connect();						
						print $temp->printresume($_GET['id']);
					}
					?>
				</div>
			</div>
			<div class="qwe4">
				<?php
				if(isset($_GET['id'])){
				?>
				<table  style="font-size:24px; " >
				<tr>
					<td width="200"height="150" style="text-align:center;">
						<a href="#" style="text-decoration:none" class="tempimg<?php if($res['temp']=="classic1") echo ' tempactive'; ?>" id="classic1" onClick="resumePages('classic1', '<?=$_GET['id']?>')">
						<img border="0" src="images/classic1.jpg"  alt="" title="" />
						</a>
					</td>
					<td width="200"height="150" style="text-align:center;">
						<a href="#" class="tempimg<?php if($res['temp']=="classic2") echo ' tempactive'; ?>" id="classic2" onClick="resumePages('classic2', '<?=$_GET['id']?>')">
						<img src="images/classic2.jpg" alt="" title="" />
						</a>
					</td>
				</tr>
				<tr>                        
					<td width="200"height="150" style="text-align:center;">
						<a href="#" class="tempimg<?php if($res['temp']=="Professional_1") echo ' tempactive'; ?>" id="Professional_1" onClick="resumePages('Professional_1', '<?=$_GET['id']?>')">
						<img src="images/professional_1.jpg" alt="" title="" />
						</a>
					</td>
					<td width="200"height="150" style="text-align:center;">
						<a href="#" class="tempimg<?php if($res['temp']=="Professional_2") echo ' tempactive'; ?>" id="Professional_2" onClick="resumePages('Professional_2', '<?=$_GET['id']?>')">
						<img src="images/professional_2.jpg"  alt="" title="" />
						</a>
					</td>						
				</tr>
				<tr>
					<td width="200" height="150" style="text-align:center;">
						<a href="#" class="tempimg<?php if($res['temp']=="Contemporary_1") echo ' tempactive'; ?>" id="Contemporary_1" onClick="resumePages('Contemporary_1', '<?=$_GET['id']?>')">
						<img src="images/contemporary_1.jpg"  alt="" title="" />
						</a>
					</td>						
					<td width="200" height="150" style="text-align:center;">
						<a href="#" class="tempimg<?php if($res['temp']=="Contemporary_4") echo ' tempactive'; ?>" id="Contemporary_4" onClick="resumePages('Contemporary_4', '<?=$_GET['id']?>')">
						<img src="images/contemporary_4.jpg" alt="" title="" />
						</a>
					</td>					                        
				</tr>
				<tr>
					<td width="200" height="150" style="text-align:center;">
						<a href="#" class="tempimg<?php if($res['temp']=="Executive_1") echo ' tempactive'; ?>" id="Executive_1" onClick="resumePages('Executive_1', '<?=$_GET['id']?>')">
						<img src="images/executive_1.jpg" alt="" title="" />
						</a>
					</td>                   	
					<td width="200"height="150" style="text-align:center;">
						<a href="#" class="tempimg<?php if($res['temp']=="Executive_2") echo ' tempactive'; ?>" id="Executive_2" onClick="resumePages('Executive_2', '<?=$_GET['id']?>')">
						<img src="images/executive_2.jpg"  alt="" title="" />
						</a>
					</td>
				</tr>
				<tr>                    	
					<td width="200"height="150" style="text-align:center;">
						<a href="#" class="tempimg<?php if($res['temp']=="Traditional_1") echo ' tempactive'; ?>" id="Traditional_1" onClick="resumePages('Traditional_1', '<?=$_GET['id']?>')">
						<img src="images/traditional_1.jpg" alt="" title="" />
						</a>
					</td>                       
					<td width="200"height="150" style="text-align:center;">
						<a href="#" class="tempimg<?php if($res['temp']=="Traditional_2") echo ' tempactive'; ?>" id="Traditional_2" onClick="resumePages('Traditional_2', '<?=$_GET['id']?>')">
						<img src="images/traditional_2.jpg"  alt="" title="" />
						</a>
					</td>
				</tr>
				<tr>                    	
					<td width="200"height="150" style="text-align:center;">
						<a href="#" class="tempimg<?php if($res['temp']=="Modern_1") echo ' tempactive'; ?>" id="Modern_1" onClick="resumePages('Modern_1', '<?=$_GET['id']?>')">
						<img src="images/modern_1.jpg" alt="" title="" />
						</a>
					</td>                       
					<td width="200"height="150" style="text-align:center;">
						<a href="#" class="tempimg<?php if($res['temp']=="Modern_2") echo ' tempactive'; ?>" id="Modern_2" onClick="resumePages('Modern_2', '<?=$_GET['id']?>')">
						<img src="images/modern_2.jpg"  alt="" title="" />
						</a>
					</td>
				</tr>
				<tr>                    	
					<td width="200"height="150" style="text-align:center;">
						<a href="#" class="tempimg<?php if($res['temp']=="Standard") echo ' tempactive'; ?>" id="Standard" onClick="resumePages('Standard', '<?=$_GET['id']?>')">
						<img src="images/standard.jpg" alt="" title="" />
						</a>
					</td>                       
					<td width="200"height="150" style="text-align:center;">
						<a href="#" class="tempimg<?php if($res['temp']=="Space_Saver") echo ' tempactive'; ?>" id="Space_Saver" onClick="resumePages('Space_Saver', '<?=$_GET['id']?>')">
						<img src="images/space_saver.jpg"  alt="" title="" />
						</a>
					</td>
				</tr>                    
				<tr>
					<td width="200"height="150" style="text-align:center;">
						<a href="#" class="tempimg<?php if($res['temp']=="Contemporary_5") echo ' tempactive'; ?>" id="Contemporary_5" onClick="resumePages('Contemporary_5', '<?=$_GET['id']?>')">
						<img src="images/contemporary_5.jpg"  alt="" title="" />
						</a>
					</td>
					<td>&nbsp;</td>
				</tr>
			</table>
			<?php
			}
			?>
		</div>
	</div>
</div>

<div class="index_footer">
	<div class="footer_logo"><a href="index.php"><img src="images/footer_logo.png" title="" alt="" /></a></div>
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
	</div>
</div>	
<!--copy-->
</body>
</html>