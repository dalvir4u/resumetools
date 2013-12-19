<?php
include('../config/config.inc.php');
include('../config/Database.class.php');
include('../classes/common.class.php');

$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();
$work = $co->load_single_workhistory($_GET['id']);
?>		  
<div style="width:500px; overflow:hidden;">
	<div class="form">
    	<div style="color:#009CB9; font-size:15px;">Are you sure you want to delete this?</div>
    	<div class="work_msg"></div>
		<form id="workhistory_delform" action="#" method="post">
        <input type="hidden" name="form_id" value="workhistory_deldetail" />
        <input type="hidden" name="rid" value="<?=$work['resume_id']?>" />
        <input type="hidden" name="id" value="<?=$_GET['id']?>" />
        <table>
        	<tr>
            	<td>Company</td><td>:</td><td><?=$work['company_name']?></td>
            </tr>
            <tr>
            	<td>City</td><td>:</td><td><?=$work['city']?></td>
            </tr>
            <tr>
            	<td>State</td><td>:</td><td><?=$work['state']?></td>
            </tr>
            <tr>
            	<td>Position</td><td>:</td><td><?=$work['position']?></td>
            </tr>
            <tr>
            	<td>Date from</td><td>:</td><td><?=$work['date_from']?></td>
            </tr>
            <tr>
            	<td>Date to</td><td>:</td><td><?=$work['date_to']?></td>
            </tr>
        </table>
            <div class="footer_go_back">
				<img src="<?=WEB_ROOT?>/Ajax/img/line.jpg" alt="" title="" />
				<span class="continue">
					<input type="button" class="blue_button" value="yes" onClick="submitform('<?=$work['resume_id']?>', 'workhistory_delform', 'work_msg')" />
					<input type="button" class="blue_button" onclick="fancy_close()" value="No"  />
                </span>
			</div>
		</form>
	</div><!-- End .form -->
</div><!-- End .content -->
