<?php
include('../config/config.inc.php');
include('../config/Database.class.php');
include('../classes/common.class.php');
$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();
if($co->is_adminlogin()){ header("location:main.php"); }
else{ header("location:login.php"); }
?>