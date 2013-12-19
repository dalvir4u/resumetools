<?php
include('../config/config.inc.php');
include('../config/Database.class.php');
include('../classes/common.class.php');

$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();
$con = $co->load_single_resume($_GET['rid']);
?>
<div style="width:500px; overflow:hidden">
	<div class="form">
        <div class="contact_msg"></div>
        <form id="contact_form" action="#" method="post">
        <input type="hidden" name="form_id" value="contact_detail" />
        <input type="hidden" name="rid" value="<?=$_GET['rid']?>" />
            <div class="onerow">
                <div class="span10">
                    <div class="input_title">Address 1</div>
                    <div>
                    <input type="text" id="stritname" name="street" value="<?=$con['street']?>" class="input_text" />
                    </div>
                </div>
            </div>
            <div class="onerow">
                <div class="span10">
                    <div class="input_title">Address 2</div>
                    <div>
                    <input type="text" name="street2" value="<?=$con['street2']?>" class="input_text" />
                    </div>
                </div>
            </div>
            <div class="onerow">
                <div class="span4">
                    <div class="input_title">City</div>
                    <div>
                        <input type="text" name="city" value="<?=$con['city']?>" class="input_text" />
                    </div>
                </div>
                <div class="span3">
                	<div class="input_title">State/Province</div>
                    <div>
                        <select name="state">
						<?php 
						$state_list = $co->load_all_states();
						foreach($state_list as $state_name){
							$sel = '';
							if($state_name['sname']==$con['state'])
								$sel .= ' selected="selected"';
							echo '<option value="'.$state_name['sname'].'"'.$sel.'>'.$state_name['sname'].'</option>';	
						}
						?>
                        </select>
                    </div>
                </div>
                <div class="span2">
                    <div class="input_title">Zip</div>
                    <div>
                        <input type="text" name="zip" id="mask_zip" value="<?=$con['zip']?>" class="input_text" />
                    </div>
                </div>
            </div>
            <div class="onerow">
                <div class="span5">
                    <div class="input_title">Home Phone Number</div>
                    <div>
                        <input type="text" name="phone_num" id="mask_phone" value="<?=$con['phone_num']?>" class="input_text" />
                    </div>
                </div>
                <?php /*?><div class="span5">
                    <div class="input_title">Cell Phone</div>
                    <div class="">
                        <input type="text" name="cell_num" value="<?=$con['cell_num']?>" class="input_text" />
                    </div>
                </div><?php */?>
            </div>
            <div class="onerow">
                <div class="span7">
                    <div class="input_title">Email</div>
                    <div>
                        <input type="text" name="email" value="<?=$con['email']?>" class="input_text" />
                    </div>
                </div>
            </div>
            <div class="footer_go_back">
                <img src="<?=WEB_ROOT?>/Ajax/img/line.jpg" alt="" title="" />               
                <span class="continue">
	                <input type="button" onClick="fancy_close()" value="skip" class="blue_button" />
                    <input type="button" onClick="submitform('<?=$_GET['rid']?>', 'contact_form', 'contact_msg')" value="Save changes" class="blue_button" />
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
	$("#stritname").trigger(e);
});
</script>
