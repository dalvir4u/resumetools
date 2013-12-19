<?php
include('../config/config.inc.php');
include('../config/Database.class.php');
include('../classes/common.class.php');

$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();
$con = $co->load_single_resume($_GET['rid']);
?>
<script type="text/javascript">
	
</script>
<div style="width:500px; overflow:hidden">
	<div class="form">
        <div class="name_msg"></div>
        <form id="name_form" action="" method="post">
        <input type="hidden" name="form_id" value="name_detail" />
        <input type="hidden" name="rid" value="<?=$_GET['rid']?>" />
            <div class="textarea">
                <label class="company" for="normal-field">First name <span style="color:red">*</span></label>
                <div>
                    <input type="text" id="firname" name="first_name" value="<?=$con['first_name']?>" class="row-fluid required" />
                </div>
            </div>
            <div class="textarea">
                <label class="company" for="normal-field">Last name <span style="color:red">*</span></label>
                <div>
                    <input type="text" name="last_name" value="<?=$con['last_name']?>" class="row-fluid required" />
                </div>
            </div>		
            <div class="footer_go_back">
                <img src="<?=WEB_ROOT?>/Ajax/img/line.jpg" alt="" title="" />                
                <span class="continue">
                    <input type="button" onClick="fancy_close()" value="Skip" class="blue_button" />
                    <input type="button" onClick="submitform('<?=$_GET['rid']?>', 'name_form', 'name_msg')" value="Save Changes" class="blue_button" />
                </span>
            </div>
		</form>
	</div><!-- End .form -->
</div>
<script type="text/javascript">
$(document).ready(function () { 
	var e = jQuery.Event("keypress");
	e.which = 9; // # Some key code value
	e.keyCode = 9;
	$("#firname").trigger(e);
});
</script>