<?php
include('../config/config.inc.php');
include('../config/Database.class.php');
include('../classes/common.class.php');

$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();
$edu = $co->load_single_educations($_GET['id']);
$sec_detail = $co->load_single_section(2);
?>

<div style="width:500px; overflow:hidden">
	<div class="blue_popup_title">
		<?=$sec_detail['section_name']?>
	</div>
    <div class="blue_popup_help">
		<?=$sec_detail['empty_text']?>
	</div>
	<div class="form">
    	<div class="edu_msg"></div>
		<form class="" id="education_editform" action="#" method="post">
        <input type="hidden" name="form_id" value="education_editdetail" />
        <input type="hidden" name="rid" value="<?=$edu['resume_id']?>" />
        <input type="hidden" name="id" value="<?=$_GET['id']?>" />
			<div class="onerow">
            	<div class="span7">
                    <div class="input_title">School</div>
                    <div>
                        <input type="text" id="schname" name="school" value="<?=$edu['school']?>" class="input_text" />
                    </div>
                </div>
                <div class="span3">
                    <div class="input_title">Grade Year</div>
                    <div>
                        <input type="text" name="grade_year" value="<?=$edu['grade_year']?>" class="input_text" />
                    </div>
                </div>
            </div>
            <div class="onerow">
                <div class="span4">
                    <div class="input_title">City</div>
                    <div>
                        <input type="text" name="city" value="<?=$edu['city']?>" class="input_text" />
                    </div>
                </div>
                <div class="span3">
                    <div class="input_title">State</div>
                    <div>
                        <input type="text" name="state" value="<?=$edu['state']?>" class="input_text" />
                    </div>
                </div>
                <div class="span3">
                    <div class="input_title">Country</div>
                    <div>
                        <input type="text" name="country" value="<?=$edu['country']?>" class="input_text" />
                    </div>
                </div>
            </div>
			<div class="onerow">
                <div class="span5">
                    <div class="input_title">Field of study</div>
                    <div>
                        <input type="text" name="field_of_study" value="<?=$edu['field_of_study']?>" class="input_text">
                    </div>
                </div>
                <div class="span5">
                    <div class="input_title">Degree</div>
                    <div>
                        <input type="text" name="degree" value="<?=$edu['degree']?>" class="input_text">
                    </div>
                </div>
            </div>
			<div class="onerow">
            	<div class="span5">
                    <div class="input_title">Description</div>
                    <div>
                        <textarea id="desc_val" name="desc"><?=$edu['desc']?></textarea>
                    </div>
                </div>
            </div>
			<div class="footer_go_back">
				<img src="<?=WEB_ROOT?>/Ajax/img/line.jpg" alt="" title="" />				
				<span class="continue">
                	<input type="button" onClick="fancy_close()" value="skip" class="blue_button" />
					<input type="button" onClick="submiteduform('<?=$edu['resume_id']?>', 'education_editform', 'edu_msg')" value="Save changes" class="blue_button" />
				</span>
			</div>
		</form>
	</div><!-- End .form -->
</div><!-- End .content -->
<script type="text/javascript">
$(document).ready(function () { 
	var e = $.Event("keypress");
	e.which = 0; // # Some key code value
	e.keyCode = 9;
	$("#schname").trigger(e);

	$("#desc_val").cleditor({
		width:        480, // width not including margins, borders or padding
        height:       100, // height not including margins, borders or padding
		controls:     // controls to add to the toolbar
          "bold italic underline " +
		  "| removeformat | bullets numbering | outdent " +
          "indent | alignleft center alignright justify | undo redo",
	});
});
</script>