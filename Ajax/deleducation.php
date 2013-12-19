<?php
include('../config/config.inc.php');
include('../config/Database.class.php');
include('../classes/common.class.php');

$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();
$edu = $co->load_single_educations($_GET['id']);
?>
<div style="width:500px; overflow:hidden;">
	<div class="form">
    	<div style="color:#009CB9; font-size:15px;">Are you sure you want to delete this?</div>
		<form class="" id="education_delform" action="#" method="post">
        <input type="hidden" name="form_id" value="education_deldetail" />
        <input type="hidden" name="rid" value="<?=$edu['resume_id']?>" />
        <input type="hidden" name="id" value="<?=$_GET['id']?>" />
		<table>
        	<tr>
            	<td>School</td><td>:</td><td><?=$edu['school']?></td>
            </tr>
            <tr>
            	<td>Grade Year</td><td>:</td><td><?=$edu['grade_year']?></td>
            </tr>
            <tr>
            	<td>City</td><td>:</td><td><?=$edu['city']?></td>
            </tr>
            <tr>
            	<td>State</td><td>:</td><td><?=$edu['state']?></td>
            </tr>
            <tr>
            	<td>Field Of Study</td><td>:</td><td><?=$edu['field_of_study']?></td>
            </tr>
            <tr>
            	<td>Degree</td><td>:</td><td><?=$edu['degree']?></td>
            </tr>
            <tr>
            	<td>Description</td><td>:</td><td><?=$edu['desc']?></td>
            </tr>
        </table>
			<div class="footer_go_back">
				<img src="<?=WEB_ROOT?>/Ajax/img/line.jpg" alt="" title="" />
				<span class="continue">
					<input type="button" value="yes" class="blue_button" onClick="submitform('<?=$edu['resume_id']?>', 'education_delform', 'edu_msg')" />
					<input type="button" class="blue_button" onclick="fancy_close()" value="No"  />
                </span>
			</div>
		</form>
	</div><!-- End .form -->
</div><!-- End .content -->
