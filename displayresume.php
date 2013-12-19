<?php
if(isset($_GET['id'])){
	include('config/config.inc.php');
	include('config/Database.class.php');
	include('classes/common.class.php');
	$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
	$co->connect();	
	$res = $co->load_single_resume($_GET['id']);
	include('classes/'.$res['temp'].'.class.php');							
	$temp = new template(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
	$temp->connect();						
	print $temp->printresume($_GET['id']);
}
?>