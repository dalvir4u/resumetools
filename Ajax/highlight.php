<?php
include('../config/config.inc.php');
include('../config/Database.class.php');
include('../classes/common.class.php');

$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();
$val = $co->load_resume_highlight($_GET['rid']);
$sec_detail = $co->load_single_section(3);	
?>

<div style="width:500px; overflow:hidden">
	<div class="blue_popup_title">
		<?=$sec_detail['section_name']?>
	</div>
    <div class="blue_popup_help">
		<?=$sec_detail['empty_text']?>
	</div>
	<div class="form">
        <div class="other_msg"></div>
        <form id="highlight_form" action="#" method="post">
        <input type="hidden" name="form_id" value="highlight_section" />
        <input type="hidden" name="rid" value="<?=$_GET['rid']?>" />
            <div class="onerow">
                <div class="span5">
                    <div class="input_title">Highlight 1</div>
                    <div>
                    <textarea id="editor1" name="highlight1"><?=$val['highlight1']?></textarea>
                    </div>
                </div>
                <div class="span5">
                    <div class="input_title">Highlight 2</div>
                    <div>
                    <textarea id="editor2" name="highlight2"><?=$val['highlight2']?></textarea>
                    </div>
                </div>
            </div>
                        
            <div class="footer_go_back">
                <img src="<?=WEB_ROOT?>/Ajax/img/line.jpg" alt="" title="" />
                <span class="continue">
                	<input type="button" onClick="fancy_close()" value="skip" class="blue_button" />
                    <input type="button" onClick="submitform('<?=$_GET['rid']?>', 'highlight_form', 'highlight_msg')" value="save changes" class="blue_button" />
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
	$("#editor1").trigger(e);
	 
	$("#editor1").cleditor({
		width:        230, // width not including margins, borders or padding
        height:       150, // height not including margins, borders or padding
		controls:     // controls to add to the toolbar
          "bold italic underline " +
		  "| removeformat bullets numbering | undo redo",
	});
	$("#editor2").cleditor({
		width:        230, // width not including margins, borders or padding
        height:       150, // height not including margins, borders or padding
		controls:     // controls to add to the toolbar
          "bold italic underline " +
		  "| removeformat bullets numbering | undo redo",
	});
});
  </script>