<?php
session_start(); //Start the current session
if(isset($_SESSION['webadmin']) and $_SESSION['webadmin']=="job-shep admin"){
	unset($_SESSION['webadmin']);
	unset($_SESSION['utype']);
	unset($_SESSION['aid']);
}
header("location:index.php");
?>
