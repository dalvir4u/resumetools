<?php
	include("html_to_doc/html_to_doc.inc.php");
	
	$htmltodoc= new HTML_TO_DOC();
	
	include('../config/config.inc.php');
  	include('../config/Database.class.php');
  	include('../classes/common.class.php');
  	$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
  	$co->connect();
  	$res = $co->load_single_resume($_GET['id']);
  	$filename = $res['first_name'].'_'.$res['last_name'].'_resume';
	
	//$htmltodoc->createDoc("reference1.html","test");
	$htmltodoc->createDocFromURL("http://resumetool.dikonia.net/htmltopdf/dompdf/www/displayresume.php?type=DOC&id=".$_GET['id'],$filename,TRUE);
	

?>