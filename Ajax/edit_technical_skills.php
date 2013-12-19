<?php
include('../config/config.inc.php');
include('../config/Database.class.php');
include('../classes/common.class.php');

$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();
$t_skills= $co->load_single_technical_skills($_GET['id']);
$sec_detail = $co->load_single_section(20);
?>		  
<div style="width:500px; overflow:hidden">
	<div class="blue_popup_title">
		<?=$sec_detail['section_name']?>
	</div>
    <div class="blue_popup_help">
		<?=$sec_detail['empty_text']?>
	</div>
	<div class="form">
		<div class="work_msg"></div>
		<form id="technical_skills_editform" action="#" method="post">
			<input type="hidden" name="form_id" class="row-fluid" value="edit_technical_skill"/>
			<input type="hidden" name="rid" value="<?=$t_skills['resume_id']?>" />
			<input type="hidden" name="id" value="<?=$_GET['id']?>" />
				<div class="textarea">
					<label class="company" for="normal-field">Skill</label>
					<div class="">
						<input type="text" id="skillname" name="skills" class="row-fluid" value="<?=$t_skills['skills']?>"/>
					</div>
				</div>
				<div class="textarea">
					<label class="company" for="normal-field">Expertise in</label>
					<div class="">
						<input type="text" name="expertise" class="row-fluid"  value="<?=$t_skills['expertise']?>"/>
					</div>
				</div>
				<div class="textarea">
					<label class="company" for="normal-field">Total Year</label>
					<div class="">
						<input type="text" name="total_year" class="row-fluid"  value="<?=$t_skills['total_year']?>"/>
					</div>
				</div>
				<div class="textarea">
					<label class="company" for="normal-field">Last Used</label>
					<div class="">
						<input type="text" name="last_used" class="row-fluid"  value="<?=$t_skills['last_used']?>"/>
					</div>
				</div>
				<div class="footer_go_back"><img src="<?=WEB_ROOT?>/Ajax/img/line.jpg" alt="" title="" />
					<span class="continue">
                    <input type="button" onClick="fancy_close()" value="skip" class="blue_button" />
                    <input type="button" onClick="submitform('<?=$t_skills['resume_id']?>', 'technical_skills_editform', 'work_msg')" value="Save changes" class="blue_button" /></span>
				</div>
		</form>						
	</div>
</div><!-- End .content -->
<script type="text/javascript">
$(document).ready(function () { 
	var e = $.Event("keypress");
	e.which = 0; // # Some key code value
	e.keyCode = 9;
	$("#skillname").trigger(e);
});
</script>
