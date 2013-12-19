<?php
include('../config/config.inc.php');
include('../config/Database.class.php');
include('../classes/common.class.php');

$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();
$val = $co->load_resume_exeutive_summary($_GET['rid']);
$sec_detail = $co->load_single_section(5);
?>

<div style="width:500px; overflow:hidden">
	<div class="blue_popup_title">
		<?=$sec_detail['section_name']?>
	</div>
    <div class="blue_popup_help">
		<?=$sec_detail['empty_text']?>
	</div>
	<div class="form">
        <div class="exesum_msg"></div>
        <form id="executive_summary_form" action="#" method="post">
        <input type="hidden" name="form_id" value="executive_summary" />
        <input type="hidden" name="rid" value="<?=$_GET['rid']?>" />
            <div class="onerow">
                <div class="span10">
                    <div class="input_title">Main Summary</div>
                    <div>
                    <textarea id="singlechange" name="main_summary"><?=$val['main_summary']?></textarea>
                    </div>
                </div>
            </div>
            <div class="onerow">
                <div class="span5">
                    <div class="input_title">Expert 1</div>
                    <div>
                    <textarea id="editor1" name="expert1"><?=$val['expert1']?></textarea>
                    </div>
                </div>
                <div class="span5">
                    <div class="input_title">Expert 2</div>
                    <div>
                    <textarea id="editor2" name="expert2"><?=$val['expert2']?></textarea>
                    </div>
                </div>
            </div>
                        
            <div class="footer_go_back">
                <img src="<?=WEB_ROOT?>/Ajax/img/line.jpg" alt="" title="" />
                <span class="continue">
                    <input type="button" onClick="fancy_close()" value="skip" class="blue_button" />
                    <input type="button" onClick="submitexe_sumform('<?=$_GET['rid']?>', 'executive_summary_form', 'exesum_msg')" value="Save changes" class="blue_button" />
                </span>
            </div>
		</form>
	</div><!-- End .form -->
</div>
<script type="text/javascript">
$(document).ready(function () {
	var e = $.Event("keypress");
	e.which = 0; // # Some key code value
	e.keyCode = 9;
	$("#singlechange").trigger(e);
	
	$("#singlechange").cleditor({
		width:        470, // width not including margins, borders or padding
        height:       150, // height not including margins, borders or padding
		controls:     // controls to add to the toolbar
          "bold italic underline " +
		  "| removeformat | bullets numbering | outdent " +
          "indent | alignleft center alignright justify | undo redo",
	}); 
	$("#editor1").cleditor({
		width:        220, // width not including margins, borders or padding
        height:       110, // height not including margins, borders or padding
		controls:     // controls to add to the toolbar
          "bold italic underline " +
		  "| removeformat bullets numbering | undo redo",
	});
	$("#editor2").cleditor({
		width:        220, // width not including margins, borders or padding
        height:       110, // height not including margins, borders or padding
		controls:     // controls to add to the toolbar
          "bold italic underline " +
		  "| removeformat bullets numbering | undo redo",
	});
});
  </script>