<?php
include('../config/config.inc.php');
include('../config/Database.class.php');
include('../classes/common.class.php');

$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();
$section_id=$_GET['id'];
$field = 'section_'.$section_id;
$val = $co->load_resume_single_value($_GET['rid'], $section_id);
$sec_detail = $co->load_single_section($section_id);
?>
<script type="text/javascript">
$(document).ready(function () { 

	var e = jQuery.Event("keypress");
	e.which = 0; // # Some key code value
	e.keyCode = 9;
	$("#singlechange").trigger(e);

	$("#singlechange").cleditor({
		useCSS:       false,
		controls:     // controls to add to the toolbar
          "bold italic underline " +
		  "| removeformat | bullets numbering | outdent " +
          "indent | alignleft center alignright justify | undo redo | paste pastetext",
	});
});
  </script>
<div style="width:500px; overflow:hidden">	
    <div class="blue_popup_title">
		<?=$sec_detail['section_name']?>
	</div>
    <div class="blue_popup_help">
		<?=$sec_detail['empty_text']?>
	</div>
	<div>
        <div class="other_msg"></div>
        <form id="other_section" action="" method="post">
        <input type="hidden" name="form_id" value="other_section" />
        <input type="hidden" name="rid" id="rid" value="<?=$_GET['rid']?>" />
        <input type="hidden" name="id" id="sid" value="<?=$section_id?>" />
            <div class="onerow">
                <div class="span10">                    
                    <div>
                    <textarea id="singlechange" name="<?=$field?>"><?=$val?></textarea>
                    </div>
                </div>
            </div>
            <div class="footer_go_back">
                <img src="<?=WEB_ROOT?>/Ajax/img/line.jpg" alt="" title="" />
                <span class="continue">
                	<input type="button" onClick="fancy_close()" value="skip" class="blue_button" />
                    <input type="button" onClick="submitotherform('<?=$_GET['rid']?>', 'other_section', 'other_msg')" value="save changes" class="blue_button" />
                </span>
            </div>
		</form>
	</div><!-- End .form -->
</div>
