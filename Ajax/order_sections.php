<?php
include('../config/config.inc.php');
include('../config/Database.class.php');
include('../classes/common.class.php');

$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();

$action 				= $_POST['action'];
$updateRecordsArray 	= $_POST['recordsArray'];

if ($action == "updateRecordsListings"){

	$listingCounter = 1;
	foreach ($updateRecordsArray as $recordIDValue) {
		
		$sec['delta'] = $listingCounter;
		if(!$co->query_update('resume_sections', $sec, 'orderid='.$recordIDValue)){
			$co->setmessage("error", "visits not sorted");			   
		}
		$listingCounter = $listingCounter + 1;
	}
	echo 'All saved!';
}
?>