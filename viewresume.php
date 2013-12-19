<?php
if(isset($_GET['id'])){
?>
<div class="icon" style="overflow:hidden">
    <div class="add_section">
        <a href="main.php">>>Back to all resumes</a>
    </div>
    <div class="add_section">
        <div class="icon_add"> 
            <img src="img/download_pdf.png" title="" alt="" />
        </div>
        <a target="_blank" href="htmltopdf/dompdf/www/domcreate.php?id=<?=$_GET['id']?>">Download as PDF</a>
    </div> 
    <div class="add_section">
        <div class="icon_add"> 
            <img src="img/download.png" title="" alt="" />
        </div>
        <a target="_blank" href="htmltopdf/create_doc.php?id=<?=$_GET['id']?>">Download as DOC</a>
    </div>
</div>
<div style="padding:0 20px;">
<?php
	$res = $co->load_single_resume($_GET['id']);
	include('classes/'.$res['temp'].'.class.php');							
	$temp = new template(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
	$temp->connect();						
	print $temp->viewresume($_GET['id']);
}
?>
</div>