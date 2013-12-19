<?php
if(isset($_POST['cid']) and $_POST['cid']>0){
	include('../config/config.inc.php');
	include('../config/Database.class.php');
	include('../classes/common.class.php');
	
	$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
	$co->connect();
	$csubs = $co->fetch_all_array("SELECT * FROM `career_sub` WHERE `career`='".$_POST['cid']."'");
	echo '<option value="">Select One</option>';
	foreach($csubs as $csub){
		echo '<option value="'.$csub['csub_id'].'">'.$csub['csub_name'].'</option>';
	}
}
?>
