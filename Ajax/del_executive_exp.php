<?php
include('../config/config.inc.php');
include('../config/Database.class.php');
include('../classes/common.class.php');

$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();
$e = $co->load_single_executive_exp($_GET['id']);
?>
<div style="width:500px; overflow:hidden;">
	<div class="form">
    	<div class="exp_msg"></div>
        <div style="color:#009CB9; font-size:15px;">Are you sure you want to delete this?</div>
		<form class="" id="executive_delform" action="#" method="post">
        <input type="hidden" name="form_id" value="executive_expdelform" />
        <input type="hidden" name="rid" value="<?=$e['resume_id']?>" />
        <input type="hidden" name="id" value="<?=$_GET['id']?>" />
		<table>
        	<tr>
            	<td>Company</td><td>:</td><td><?=$e['company_name']?></td>
            </tr>
            <tr>
            	<td>City</td><td>:</td><td><?=$e['city']?></td>
            </tr>
            <tr>
            	<td>State</td><td>:</td><td><?=$e['state']?></td>
            </tr>
            <tr>
            	<td>Company Description</td><td>:</td><td><?=$e['company_desc']?></td>
            </tr>
            <tr>
            	<td>Date from</td><td>:</td><td><?=$e['date_from']?></td>
            </tr>
            <tr>
            	<td>Date to</td><td>:</td><td><?=$e['date_to']?></td>
            </tr>
            <tr>
            	<td>Description</td><td>:</td><td><?=$e['desc']?></td>
            </tr>
        </table>
			<div class="footer_go_back">
				<img src="<?=WEB_ROOT?>/Ajax/img/line.jpg" alt="" title="" />
				<span class="continue">
					<input type="button" onClick="submitform('<?=$e['resume_id']?>', 'executive_delform', 'exp_msg')" class="blue_button" value="yes" />
					<input type="button" class="blue_button" onclick="fancy_close()" value="No"  />
                </span>
			</div>           
		</form>
	</div><!-- End .form -->
</div><!-- End .content -->