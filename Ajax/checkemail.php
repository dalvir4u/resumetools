<?php
include('../config/config.inc.php');
include('../config/Database.class.php');
include('../classes/common.class.php');

$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();
if(isset($_GET['va'])){
	if($co->is_emailExists($_GET['va'])){
		echo 'exists';
	}else{
		echo 'notexist';		
	}
}
?>
