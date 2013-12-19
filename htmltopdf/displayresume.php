<?php
if(isset($_GET['id'])){
	include('../config/config.inc.php');
	include('../config/Database.class.php');
	include('../classes/common.class.php');
	$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
	$co->connect();	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
.section_block span{
	font-family:Arial !important;
	font-size:14px !important;
}
</style>
</head>
<?php
	$res = $co->load_single_resume($_GET['id']);
	include('../classes/'.$res['temp'].'.class.php');							
	$temp = new template(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
	$temp->connect();						
	print $temp->viewresume($_GET['id']);
}
?>
<body>
</body>
</html>