<?php
include('../config/config.inc.php');
include('../config/Database.class.php');
include('../classes/common.class.php');

$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();
$sections = $co->load_sections_except_resume($_GET['id']);
?>
<script type="text/javascript">
	$(document).ready(function() {			
		 $('#myselect').multiSelect();
	});
</script>
<div style="width:500px; overflow:hidden">
	<div class="form">
        <div class="contact_msg"></div>
        <form id="add_section" action="#" method="post">
        <input type="hidden" name="form_id" value="add_section" />
        <input type="hidden" name="rid" value="<?=$_GET['id']?>" />
            <select multiple="multiple" id="myselect" name="sections[]">
				<?php
                foreach($sections as $section){
					echo '<option value="'.$section['sectionid'].'">'.$section['section_name'].'</option>';
                }
                ?>
           </select>			
            <div class="footer_go_back">
                <img src="<?=WEB_ROOT?>/Ajax/img/line.jpg" alt="" title="" />
                <span class="continue">
                	<input type="button" onclick="fancy_close()" value="skip" class="blue_button" />
                    <input type="button" onClick="submitform('<?=$_GET['id']?>', 'add_section', 'contact_msg')" value="save changes" class="blue_button" />
                </span>
            </div>
		</form>
	</div><!-- End .form -->
</div>
