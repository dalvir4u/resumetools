<?php
include('../config/config.inc.php');
include('../config/Database.class.php');
include('../classes/common.class.php');

$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();
$work = $co->load_single_workhistory($_GET['id']);
$sec_detail = $co->load_single_section(21);
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
		<form id="workhistory_editform" action="#" method="post">
        <input type="hidden" name="form_id" value="workhistory_editdetail" />
        <input type="hidden" name="rid" value="<?=$work['resume_id']?>" />
        <input type="hidden" name="id" value="<?=$_GET['id']?>" />
			<div class="onerow">
                <div class="span4">
                    <div class="input_title">Company</div>
                    <div>
                        <input type="text" id="compname" name="company_name" value="<?=$work['company_name']?>" class="input_text" />
                    </div>
                </div>
                <div class="span3">
                    <div class="input_title">City</div>
                    <div>
                        <input type="text" name="city" value="<?=$work['city']?>" class="input_text" />
                    </div>
                </div>
                <div class="span3">	
                    <div class="input_title">State</div>
                    <div>
                        <input type="text" name="state" value="<?=$work['state']?>" class="input_text" />
                    </div>
                </div>
            </div>            
			<div class="onerow">
                <div class="span7">
                    <div class="input_title">Position</div>
                    <div>
                        <input type="text" name="position" value="<?=$work['position']?>" class="input_text">
                    </div>
                </div>
            </div>
			<div class="onerow">
                <div class="span4">
                    <div class="input_title">Date from<span style="color:red">*</span></div>
                    <div>
                    	<?php
						$date_from = explode(' ', $work['date_from']);
						$from_month = $date_from[0];
						if($date_from[0]=="Current" or $date_from[0]==""){
							$from_year = '';
							$from_month_style = ' style="width:90%"';
						}else{
							$from_year = $date_from[1];
							$from_month_style = ' style="width:45%"';
						}
						?>
                    	<select class="required" name="from_month" id="from_month" onchange="change_date('from_month', 'from_year')"<?=$from_month_style?>>
                        	<option value="">Select Date</option>
						<?php
						$months = array("January","February","March","April","May","June","July","August","September","October","November","December","Current");
						foreach($months as $month){
							$sel = '';
							if($month==$from_month)
								$sel = ' selected="selected"';
							echo '<option value="'.$month.'"'.$sel.'>'.$month.'</option>';
						}
						?>                    	
                        </select>
                        <?php
						if($from_month=="Current" or $from_month=="")
							$from_year_style = ' style="display:none; width:45%"';
						else
							$from_year_style = ' style="width:45%"';
						?>
                        <select name="from_year" id="from_year"<?=$from_year_style?>>
                        <?php
						for($i=1940;$i<=date('Y');$i++){
							$sel = '';
							if($i==$from_year)
								$sel = ' selected="selected"';
							echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
						}
						?>
                        </select>
                    </div>
                </div>
                <div class="span4">
                    <div class="input_title">Date to<span style="color:red">*</span></div>
                    <div>
                    	<?php
						$date_to = explode(' ', $work['date_to']);
						$to_month = $date_to[0];
						if($date_to[0]=="Current" or $date_to[0]==""){
							$to_year = '';
							$to_month_style = ' style="width:90%"';
						}else{
							$to_year = $date_to[1];
							$to_month_style = ' style="width:45%"';
						}
						?>
                        <select name="to_month" id="to_month" onchange="change_date('to_month', 'to_year')"<?=$to_month_style?>>
                        	<option value="">Select Date</option>
						<?php
						$months = array("January","February","March","April","May","June","July","August","September","October","November","December","Current");
						foreach($months as $month){
							$sel = '';
							if($month==$to_month)
								$sel = ' selected="selected"';
							echo '<option value="'.$month.'"'.$sel.'>'.$month.'</option>';
						}
						?>                       	
                        </select>
                        <?php
						if($to_month=="Current" or $to_month=="")
							$to_year_style = ' style="display:none; width:45%"';
						else
							$to_year_style = ' style="width:45%"';
						?>
                        <select name="to_year" id="to_year"<?=$to_year_style?>>
                        <?php
						for($i=1940;$i<=date('Y');$i++){
							$sel = '';
							if($i==$to_year)
								$sel = ' selected="selected"';
							echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
						}
						?>
                        </select>
                    </div>
                </div>
            </div>			
			<div class="footer_go_back">
            	<img src="<?=WEB_ROOT?>/Ajax/img/line.jpg" alt="" title="" />
				<span class="continue">
                	<input type="button" onClick="fancy_close()" value="skip" class="blue_button" />
                    <input type="button" onClick="submitform('<?=$work['resume_id']?>', 'workhistory_editform', 'work_msg')" value="Save changes" class="blue_button" />
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