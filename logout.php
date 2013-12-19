<?php
session_start(); //Start the current session
if(isset($_SESSION['weblogin']) and $_SESSION['weblogin']=="job-shep"){
	unset($_SESSION['user_type']);
	unset($_SESSION['weblogin']);
	unset($_SESSION['user_id']);
}
header("location:index.php");
?>
