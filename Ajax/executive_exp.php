<?php
include('../config/config.inc.php');
include('../config/Database.class.php');
include('../classes/common.class.php');

$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();
$sec_detail = $co->load_single_section(19);
?>

<div style="width:500px; overflow:hidden">
	<div class="blue_popup_title">
		<?=$sec_detail['section_name']?>
	</div>
    <div class="blue_popup_help">
		<?=$sec_detail['empty_text']?>
	</div>
	<div class="form">
    	<div class="exp_msg"></div>
		<form class="" id="executive_expform" action="#" method="post">
        <input type="hidden" name="form_id" value="executive_expnewform" />
        <input type="hidden" name="rid" value="<?=$_GET['rid']?>" />
        	<div class="onerow">
                <div class="span4">
                    <div class="input_title">Company</div>
                    <div>
                        <input type="text" id="compname" name="company_name" class="input_text required" />
                    </div>
                </div>
                <div class="span3">
                    <div class="input_title">City</div>
                    <div>
                        <input type="text" name="city" class="input_text" />
                    </div>
                </div>
                <div class="span3">
                    <div class="input_title">State</div>
                    <div>
                        <input type="text" name="state" class="input_text" />
                    </div>
                </div>
            </div>
			<div class="onerow">
                <div class="span8">
                    <div class="input_title">Company Description</div>
                    <div>
                        <input type="text" name="company_desc" class="input_text" />
                    </div>
                </div>
            </div>
            <div class="onerow">
                <div class="span8">
                    <div class="input_title">Position</div>
                    <div>
                        <input type="text" name="position" class="input_text" />
                    </div>
                </div>
            </div>
            <div class="onerow">
                <div class="span4">
                    <div class="input_title">Date from<span style="color:red">*</span></div>
                    <div>
                    	<select class="required" name="from_month" id="from_month" onchange="change_date('from_month', 'from_year')" style="width:90%">
                        	<option value="">Select Date</option>
						<?php
						$months = array("January","February","March","April","May","June","July","August","September","October","November","December","Current");
						foreach($months as $month){
							echo '<option value="'.$month.'">'.$month.'</option>';
						}
						?>                        	
                        </select>
                        <select name="from_year" id="from_year" style="display:none; width:45%">
                        <?php
						for($i=1940;$i<=date('Y');$i++)
							echo '<option value="'.$i.'">'.$i.'</option>';
						?>
                        </select>
                    </div>
                </div>
                <div class="span4">
                    <div class="input_title">Date to<span style="color:red">*</span></div>
                    <div>
                        <select name="to_month" id="to_month" onchange="change_date('to_month', 'to_year')" style="width:90%">
                        	<option value="">Select Date</option>
						<?php
						$months = array("January","February","March","April","May","June","July","August","September","October","November","December","Current");
						foreach($months as $month){
							echo '<option value="'.$month.'">'.$month.'</option>';
						}
						?>                        	
                        </select>
                        <select name="to_year" id="to_year" style="display:none">
                        <?php
						for($i=1940;$i<=date('Y');$i++)
							echo '<option value="'.$i.'">'.$i.'</option>';
						?>
                        </select>
                    </div>
                </div>
            </div>
			<div class="onerow">
                <div class="span10">
                    <div class="input_title">Description</div>
                    <div>
                        <textarea name="desc" id="desc_val"></textarea>
                    </div>
                </div>
            </div>
			
			<div class="footer_go_back">
            	<img src="<?=WEB_ROOT?>/Ajax/img/line.jpg" alt="" title="" />
				<span class="continue">
                	<input type="button" onClick="fancy_close()" value="skip" class="blue_button" />
                    <input type="button" onClick="submiteduform('<?=$_GET['rid']?>', 'executive_expform', 'exp_msg')" value="save changes" class="blue_button" />
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
	$("#compname").trigger(e);

	$("#desc_val").cleditor({
		width:        480, // width not including margins, borders or padding
        height:       100, // height not including margins, borders or padding
		controls:     // controls to add to the toolbar
          "bold italic underline " +
		  "| removeformat | bullets numbering | outdent " +
          "indent | alignleft center alignright justify | undo redo",
	});
});
function change_date(month, year){
	var monval = $('#'+month).val();
	if(monval=="Current" || monval==""){
		$('#'+month).css("width", "90%" );
		$('#'+year).hide();
	}else{
		$('#'+month).css("width", "45%" );
		$('#'+year).show();
	}
}
</script>