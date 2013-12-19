<?php
	include("html_to_doc.inc.php");
	
	$htmltodoc= new HTML_TO_DOC();
	
	//$htmltodoc->createDoc("reference1.html","test");
	$htmltodoc->createDocFromURL("displayresume.php?id=".$_GET['id'],"test",TRUE);
	

?>