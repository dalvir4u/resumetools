<?php
include('../config/config.inc.php');
include('../config/Database.class.php');
include('../classes/common.class.php');

$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();
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
		<form id="technical_skills_newform" action="#" method="post">
			<input type="hidden" name="form_id" class="row-fluid" value="new_technical_skill"/>
			<input type="hidden" name="rid" value="<?=$_GET['rid']?>" />
				<div class="textarea">
					<label class="company" for="normal-field">Skill</label>
					<div class="">
						<input type="text" id="skiname" name="skills" class="row-fluid" />
					</div>
				</div>
				<div class="textarea">
					<label class="company" for="normal-field">Expertise in</label>
					<div class="">
						<input type="text" name="expertise" class="row-fluid" />
					</div>
				</div>
				<div class="textarea">
					<label class="company" for="normal-field">Total Year</label>
					<div class="">
						<input type="text" name="total_year" class="row-fluid" />
					</div>
				</div>
				<div class="textarea">
					<label class="company" for="normal-field">Last Used</label>
					<div class="">
						<input type="text" name="last_used" class="row-fluid" />
					</div>
				</div>
				<div class="footer_go_back"><img src="<?=WEB_ROOT?>/Ajax/img/line.jpg" alt="" title="" />
					<span class="continue">
                    <input type="button" onClick="fancy_close()" value="skip" class="blue_button" />
                    <input type="button" onClick="submitform('<?=$_GET['rid']?>', 'technical_skills_newform', 'work_msg')" value="Save changes" class="blue_button" /></span>
				</div>
		</form>						
	</div>
</div><!-- End .content -->
<script type="text/javascript">
$(document).ready(function () { 
	var e = $.Event("keypress");
	e.which = 0; // # Some key code value
	e.keyCode = 9;
	$("#skiname").trigger(e);
});
</script>
