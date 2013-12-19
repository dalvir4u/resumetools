<?php
include('../config/config.inc.php');
include('../config/Database.class.php');
include('../classes/common.class.php');

$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();
$t_skills= $co->load_single_technical_skills($_GET['id']);
?>
<div style="width:500px; overflow:hidden;">
	<div class="form">
    	<div style="color:#009CB9; font-size:15px;">Are you sure you want to delete this?</div>
		<form class="" id="tec_skills_delform" action="#" method="post">
        <input type="hidden" name="form_id" value="tec_skills_delete" />
        <input type="hidden" name="rid" value="<?=$t_skills['resume_id']?>" />
        <input type="hidden" name="id" value="<?=$_GET['id']?>" />
		<table>
        	<tr>
            	<td>Skill</td><td>:</td><td><?=$t_skills['skills']?></td>
            </tr>
            <tr>
            	<td>Expertise in</td><td>:</td><td><?=$t_skills['expertise']?></td>
            </tr>
            <tr>
            	<td>Total Year</td><td>:</td><td><?=$t_skills['total_year']?></td>
            </tr>
            <tr>
            	<td>Last Used</td><td>:</td><td><?=$t_skills['last_used']?></td>
            </tr>
        </table>
			<div class="footer_go_back">
				<img src="<?=WEB_ROOT?>/Ajax/img/line.jpg" alt="" title="" />
				<span class="continue">
					<input type="button" value="yes" class="blue_button" onClick="submitform('<?=$t_skills['resume_id']?>', 'tec_skills_delform', 'edu_msg')" />
					<input type="button" class="blue_button" onclick="fancy_close()" value="No"  />
                </span>
			</div>
		</form>
	</div><!-- End .form -->
</div><!-- End .content -->
