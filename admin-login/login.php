<?php
include('../config/config.inc.php');
include('../config/Database.class.php');
include('../classes/common.class.php');
$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();
if($co->is_adminlogin()){ header("location:main.php"); }

$username = "";
$pwd = "";	
$errormsg = "";
$msg = "";
if($_SERVER['REQUEST_METHOD']=='POST')
{
	
	$username = trim($_POST['user']);
	$pwd = $_POST['pass'];
	if($username=='' && $pwd=='')
	{
		$co->setmessage("error", "Please enter username and password!");
	}
	else if($co->adminlogin($username,$pwd))
	{	?>
		<script language="javascript">window.location="main.php";</script>
		<?php
		exit();
	}		
	else
	{
		$co->setmessage("error", "You have entered invalid login detail, Please try again.");
	}
	$msg = $co->theme_messages();
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Job Sheperd Administration Login</title>
</head>
<style type="text/css">
body{
background-image: url('images/body_bg.jpg');
background-repeat: repeat-x;
background-color: #6398a3;
font-family:Verdana, Geneva, sans-serif;
}
fieldset{
width:300px;
margin:auto;
text-align:center;
border:10px solid #C1C1C1;
}
label{
width:100px;
text-align:left;
display:block;
float:left;
}
hr{
	color:#F00;
}
</style>
<body>
<div style="margin:110px auto; width:330px; background: #f0f0f0;">
	<span style="color:#333; font-size:36px; font-weight:bold;"></span>
	<form method="post">
    <fieldset>
    	<div style="color:#333; margin:5px 0 30px 0; background:#d5d5d5; padding:10px; font-size:17px; font-weight:bold;">
			LOGIN &nbsp; TO &nbsp; ADMIN &nbsp; PANEL
		</div>
		<?php echo $msg; ?>
		<label>Username</label>
        <input type="text" name="user" class="name" /><br/><br/>
    	<label>Password</label>
        <input type="password" name="pass"  class="pass"/><br/><br/>
    	<input type="submit" name="login"  value="Login" class="login"/><br/><br/>
        </fieldset>
	</form> 
</div>    
</body>
</html>
