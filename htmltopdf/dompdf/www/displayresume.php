<?php
if(isset($_GET['id'])){
	include('../../../config/config.inc.php');
	include('../../../config/Database.class.php');
	include('../../../classes/common.class.php');
	$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
	$co->connect();	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,form,fieldset,input,textarea,p,blockquote,th,td { 
	margin:0 !important;
	padding:0 !important;
}
/*<!--Resumes formatting, all tag formatting to view properly-->*/
#classic1 .section_block {
    font-family:Arial !important;
	font-size:12px !important;
	line-height: 15px !important;
	color: #000000 !important;	
}
#classic1 .section_block span, #classic1 .section_block p {
	font-family:Arial !important;
	font-size:12px !important;
	line-height: 15px !important;
	color: #000000;
}
#classic1 .section_block ul, #classic1 .section_block ol {
    margin: 0 20px !important;
}
#classic1 .section_block ul li {
	list-style: disc !important;
}
#classic1 .section_block ol li {
	list-style:decimal !important;
}
#classic1 .section_block table {
	border:0 !important;	
}
#classic1 .section_block table tr {
	border:0 !important;	
}
#classic1 .section_block table tr td {
	border:0 !important;	
}
#classic1 .section_block table tr td {
	font-family:Arial !important;
	font-size:12px !important;
	line-height: 15px !important;
	color: #000000;
}
#classic1 .section_block table tr td span {
	font-family:Arial !important;
	font-size:12px !important;
	line-height: 15px !important;
	color: #000000;
}
/*<!--Resumes formatting, all tag formatting to view properly classic2-->*/
#classic2 {color: #000000;}
#classic2 .section_block {
    font-family:calibri !important;
	font-size:14px !important;
	line-height: 17px !important;
	color: #000000;
}
#classic2 .section_block span, #classic2 .section_block p {
	font-family:calibri !important;
	font-size:14px !important;
	line-height: 17px !important;
	color: #000000;
}

#classic2 .section_block ul, #classic2 .section_block ol {
    margin: 0 20px !important;
}
#classic2 .section_block ul li {
	list-style: disc !important;
}

#classic2 .section_block ol li {
	list-style:decimal !important;
}
#classic2 .section_block table tr td {
	font-family:calibri !important;
	font-size:14px !important;
	line-height: 17px !important;
	color: #000000;
}
#classic2 .section_block table tr td span {
	font-family:calibri !important;
	font-size:14px !important;
	line-height: 17px !important;
	color: #000000;
}
/*<!--Resumes formatting, all tag formatting to view properly professional_1-->*/


#professional_1 .section_block {
    font-family:verdana !important;
	font-size:13px !important;
	line-height: 16px !important;
	color: #000000;
}
#professional_1 .section_block span, #professional_1 .section_block p {
	font-family:verdana !important;
	font-size:13px !important;
	line-height: 16px !important;
	color: #000000;
}
#professional_1 .section_block ul, #professional_1 .section_block ol {
	font-family:verdana !important;
    margin: 0 20px !important;
}
#professional_1 .section_block ul li {
	font-family:verdana !important;
	list-style: disc !important;
}
#professional_1 .section_block ol li {
	
	list-style:decimal !important;
}
#professional_1 .section_block table tr td {
	font-family:verdana !important;
	font-size:13px !important;
	line-height: 16px !important;
	color: #000000;
}
#professional_1 .section_block table tr td p {
	font-family:verdana !important;
	font-size:13px !important;
	line-height: 16px !important;
	color: #000000;
}
#professional_1 .section_block table tr td div {
	font-family:verdana !important;
	font-size:13px !important;
	line-height: 16px !important;
	color: #000000;
}
#professional_1 .section_block table tr td div b {
	font-family:verdana !important;
	font-size:13px !important;
	line-height: 16px !important;
	color: #000000;
}
#professional_1 .section_block table tr td span {
	font-family:verdana !important;
	font-size:13px !important;
	line-height: 16px !important;
	color: #000000;
}
/*<!--Resumes formatting, all tag formatting to view properly professional_2-->*/
#professional_2  {
	font-family:Time new roman !important;
	color: #000000;
}
#professional_2 .section_block {
	font-family:Time new roman !important;
	font-size:16px !important;
	line-height: 20px !important;
	color: #000000;
}
#professional_2 .section_block span, #professional_2 .section_block p {
	font-family:Time new roman !important;
	font-size:16px !important;
	line-height: 20px !important;
	color: #000000;
}
#professional_2 .section_block div {
	font-family:Time new roman;
	font-size:16px;
	color: #000000;
}
#professional_2 .section_block ul, #professional_2 .section_block ol {
	font-family:Time new roman !important;
    margin: 0 20px !important;
}
#professional_2 .section_block ul li {
	font-family:Time new roman !important;
	list-style: disc !important;
}
#professional_2 .section_block ol li {
	font-family:Time new roman !important;
	list-style:decimal !important;
}
#professional_2 .section_block table tr td{
	font-family:Time new roman !important;
	font-size:16px !important;
	line-height: 16px !important;
	color: #000000;
}
#professional_2 .section_block table tr td div, #professional_2 .section_block table tr td div b {
	font-family:Time new roman !important;
	font-size:16px !important;
	line-height: 16px !important;
	color: #000000;Cambria
}
#professional_2 .section_block table tr td span {
	font-family:Time new roman !important;
	font-size:16px !important;
	line-height: 16px !important;
	color: #000000;Cambria
}

/*<!--Resumes formatting, all tag formatting to view properly contemporary_1-->*/
#contemporary_1 .section_block {
	font-family:Cambria !important;
	font-size:15px !important;
	line-height: 18px !important;
	color: #000000;
	padding:10px 0;
}
#contemporary_1 .section_block span, #contemporary_1 .section_block p {
	font-family:Cambria !important;
	font-size:15px !important;
	line-height: 18px !important;
	color: #000000;
}
#contemporary_1 .section_block div, #contemporary_1 .section_block div b {
	font-family:Cambria;
	font-size:15px;
	color: #000000;
}
#contemporary_1 .section_block ul, #contemporary_1 .section_block ol {
	font-family:Cambria !important;
    margin: 0 20px !important;
}
#contemporary_1 .section_block ul li {
	font-family:Cambria !important;
	list-style: disc !important;
}
#contemporary_1 .section_block ol li {
	font-family:Cambria !important;
	list-style:decimal !important;
}
#contemporary_1 .section_block table tr td{
	font-family:Cambria !important;
	font-size:15px !important;
	line-height: 18px !important;
	color: #000000;
}
#contemporary_1 .section_block table tr td div {
	font-family:Cambria !important;
	font-size:15px !important;
	line-height: 18px !important;
	color: #000000;
}
#contemporary_1 .section_block table tr td div b {
	font-family:Cambria !important;
	font-size:15px !important;
	line-height: 18px !important;
	color: #000000;
}
#contemporary_1 .section_block table tr td span {
	font-family:Cambria !important;
	font-size:15px !important;
	line-height: 18px !important;
	color: #000000;
}
/*<Resumes formatting, all tag formatting to view properly contemporary_2>*/

#contemporary_2 .section_block{
	font-family:Cambria Math !important;
	font-size:15px !important;
	line-height: 18px !important;
	color: #000000;
}
#contemporary_2 .section_block span, #contemporary_2 .section_block p {
	font-family:Cambria Math !important;
	font-size:15px !important;
	line-height: 18px !important;
	color: #000000;
}
#contemporary_2 .section_block ul, #contemporary_2 .section_block ol {
    margin: 0 20px !important;
}
#contemporary_2 .section_block ul li {
	list-style: disc !important;
}
#contemporary_2 .section_block ol li {
	list-style:decimal !important;
}
#contemporary_2 .section_block table tr td{
	font-family:Cambria Math !important;
	font-size:15px !important;
	line-height: 18px !important;
	color: #000000;
}
#contemporary_2 .section_block table tr td span {
	font-family:Cambria Math !important;
	font-size:15px !important;
	line-height: 18px !important;
	color: #000000;
}
/*<Resumes formatting, all tag formatting to view properly executive_1>*/

#executive_1 .section_block{
	font-family:Time new roman !important;
	font-size:17px !important;
	line-height: 20px !important;
	color: #000000;
}
#executive_1 .section_block span, #executive_1 .section_block p {
	font-family:Time new roman !important;
	font-size:17px !important;
	line-height: 20px !important;
	color: #000000;
}
#executive_1 .section_block ul, #executive_1 .section_block ol {
    margin: 0 20px !important;
}
#executive_1 .section_block ul li {
	list-style: disc !important;
}
#executive_1 .section_block ol li {
	list-style:decimal !important;
}
#executive_1 .section_block table tr td{
	font-family:Time new roman !important;
	font-size:17px !important;
	line-height: 20px !important;
	color: #000000;
}
#executive_1 .section_block table tr td span {
	font-family:Time new roman !important;
	font-size:17px !important;
	line-height: 20px !important;
	color: #000000;
}
/*<Resumes formatting, all tag formatting to view properly executive_2>*/

#executive_2 .section_block{
	font-family:Time new roman !important;
	font-size:18px !important;
	line-height: 20px !important;
	color: #000000;
}
#executive_2 .section_block span, #executive_2 .section_block p {
	font-family:Time new roman !important;
	font-size:18px !important;
	line-height: 20px !important;
	color: #000000;
}
#executive_2 .section_block ul, #executive_2 .section_block ol {
    margin: 0 20px !important;
}
#executive_2 .section_block ul li {
	list-style: disc !important;
}
#executive_2 .section_block ol li {
	list-style:decimal !important;
}
#executive_2 .section_block table tr td{
	font-family:Time new roman !important;
	font-size:18px !important;
	line-height: 20px !important;
	color: #000000;
}
#executive_2 .section_block table tr td span {
	font-family:Time new roman !important;
	font-size:18px !important;
	line-height: 20px !important;
	color: #000000;
}
/*<Resumes formatting, all tag formatting to view properly traditional_1>*/

#traditional_1 .section_block{
	font-family:Arial !important;
	font-size:16px !important;
	line-height: 20px !important;
	color: #000000;
}
#traditional_1 .section_block span, #traditional_1 .section_block p {
	font-family:Arial !important;
	font-size:16px !important;
	line-height: 20px !important;
	color: #000000;
}
#traditional_1 .section_block ul, #traditional_1 .section_block ol {
    margin: 0 20px !important;
}
#traditional_1 .section_block ul li {
	list-style: disc !important;
}
#traditional_1 .section_block ol li {
	list-style:decimal !important;
}
#traditional_1 .section_block table tr td{
	font-family:Arial !important;
	font-size:16px !important;
	line-height: 20px !important;
	color: #000000;
}
#traditional_1 .section_block table tr td span {
	font-family:Arial !important;
	font-size:16px !important;
	line-height: 20px !important;
	color: #000000;
}
/*<Resumes formatting, all tag formatting to view properly traditional_2>*/

#traditional_2 .section_block{
	font-family:verdana !important;
	font-size:14px !important;
	line-height: 20px !important;
	color: #000000;
}
#traditional_2 .section_block span, #traditional_2 .section_block p {
	font-family:verdana !important;
	font-size:14px !important;
	line-height: 20px !important;
	color: #000000;
}
#traditional_2 .section_block ul, #traditional_2 .section_block ol {
    margin: 0 20px !important;
}
#traditional_2 .section_block ul li {
	list-style: disc !important;
}
#traditional_2 .section_block ol li {
	list-style:decimal !important;
}
#traditional_2 .section_block table tr td{
	font-family:verdana !important;
	font-size:14px !important;
	line-height: 20px !important;
	color: #000000;
}
#traditional_2 .section_block table tr td span {
	font-family:verdana !important;
	font-size:14px !important;
	line-height: 20px !important;
	color: #000000;
}
/*<Resumes formatting, all tag formatting to view properly modern_1>*/

#modern_1 .section_block{
	font-family:calibri !important;
	font-size:14px !important;
	line-height: 20px !important;
	color: #000000;
}
#modern_1 .section_block span, #modern_1 .section_block p {
	font-family:calibri !important;
	font-size:14px !important;
	line-height: 20px !important;
	color: #000000;
}
#modern_1 .section_block ul, #modern_1 .section_block ol {
    margin: 0 20px !important;
}
#modern_1 .section_block ul li {
	list-style: disc !important;
}
#modern_1 .section_block ol li {
	list-style:decimal !important;
}
#modern_1 .section_block table tr td{
	font-family:calibri !important;
	font-size:14px !important;
	line-height: 20px !important;
	color: #000000;
}
#modern_1 .section_block table tr td span {
	font-family:calibri !important;
	font-size:14px !important;
	line-height: 20px !important;
	color: #000000;
}
/*<Resumes formatting, all tag formatting to view properly modern_2>*/

#modern_2 .section_block{
	font-family:Time new roman !important;
	font-size:14px !important;
	line-height: 20px !important;
	color: #000000;
}
#modern_2 .section_block span, #modern_2 .section_block p {
	font-family:Time new roman !important;
	font-size:14px !important;
	line-height: 20px !important;
	color: #000000;
}
#modern_2 .section_block ul, #modern_2 .section_block ol {
    margin: 0 20px !important;
}
#modern_2 .section_block ul li {
	list-style: disc !important;
}
#modern_2 .section_block ol li {
	list-style:decimal !important;
}
#modern_2 .section_block table tr td{
	font-family:Time new roman !important;
	font-size:14px !important;
	line-height: 20px !important;
	color: #000000;
}
#modern_2 .section_block table tr td span {
	font-family:Time new roman !important;
	font-size:14px !important;
	line-height: 20px !important;
	color: #000000;
}
/*<Resumes formatting, all tag formatting to view properly standard>*/

#standard .section_block{
	font-family:Arial !important;
	font-size:16px !important;
	line-height: 20px !important;
	color: #000000;
}
#standard .section_block span, #standard .section_block p {
	font-family:Arial !important;
	font-size:16px !important;
	line-height: 20px !important;
	color: #000000;
}
#standard .section_block ul, #standard .section_block ol {
    margin: 0 20px !important;
}
#standard .section_block ul li {
	list-style: disc !important;
}
#standard .section_block ol li {
	list-style:decimal !important;
}
#standard .section_block table tr td{
	font-family:Arial !important;
	font-size:16px !important;
	line-height: 20px !important;
	color: #000000;
}
#standard .section_block table tr td span {
	font-family:Arial !important;
	font-size:16px !important;
	line-height: 20px !important;
	color: #000000;
}
/*<Resumes formatting, all tag formatting to view properly space_saver>*/

#space_saver .section_block{
	font-family:verdana !important;
	font-size:14px !important;
	line-height: 20px !important;
	color: #000000;
}
#space_saver .section_block span, #space_saver .section_block p {
	font-family:verdana !important;
	font-size:14px !important;
	line-height: 20px !important;
	color: #000000;
}
#space_saver .section_block ul, #space_saver .section_block ol {
    margin: 0 20px !important;
}
#space_saver .section_block ul li {
	list-style: disc !important;
}
#space_saver .section_block ol li {
	list-style:decimal !important;
}
#space_saver .section_block table tr td{
	font-family:verdana !important;
	font-size:14px !important;
	line-height: 20px !important;
	color: #000000;
}
#space_saver .section_block table tr td span {
	font-family:verdana !important;
	font-size:14px !important;
	line-height: 20px !important;
	color: #000000;
}
/*<Resumes formatting, all tag formatting to view properly contemporary_5>*/

#contemporary_5 .section_block{
	font-family:Time new roman !important;
	font-size:14px !important;
	line-height: 20px !important;
	color: #000000;
}
#contemporary_5 .section_block span, #contemporary_5 .section_block p {
	font-family:Time new roman !important;
	font-size:14px !important;
	line-height: 20px !important;
	color: #000000;
}
#contemporary_5 .section_block ul, #contemporary_5 .section_block ol {
    margin: 0 20px !important;
}
#contemporary_5 .section_block ul li {
	list-style: disc !important;
}
#contemporary_5 .section_block ol li {
	list-style:decimal !important;
}
#contemporary_5 .section_block table tr td{
	font-family:Time new roman !important;
	font-size:14px !important;
	line-height: 20px !important;
	color: #000000;
}
#contemporary_5 .section_block table tr td span {
	font-family:Time new roman !important;
	font-size:14px !important;
	line-height: 20px !important;
	color: #000000;
}
</style>
</head>
<body>
<?php	
	$res = $co->load_single_resume($_GET['id']);
	$con['uid']=$res['uid'];
  	$con['resume_id']=$_GET['id'];
  	$con['download_type']=$_GET['type'];
  	$con['download_time']=time();
  	$co->query_insert('resume_downloads', $con);
	include('../../../classes/'.$res['temp'].'.class.php');							
	$temp = new template(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
	$temp->connect();						
	print $temp->viewresume($_GET['id']);
}
?>
</body>
</html>