<?php
include('../config/config.inc.php');
include('../config/Database.class.php');
include('../classes/common.class.php');

$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();
if($_SERVER['REQUEST_METHOD']=='GET'){
	if(isset($_GET['id'])){
		$sec = $co->load_single_section($_GET['id']);
?>
<div style="width:400px; text-align:center; overflow:hidden;">
	<div class="sec_msg"></div>
        <form id="del_sec" action="#" method="post">
        <input type="hidden" name="form_id" value="delete_section" />
        <input type="hidden" name="rid" value="<?=$_GET['rid']?>" />
        <input type="hidden" name="section" value="<?=$sec['sectionid']?>" />
            <div class="onerow">
                <div class="input_title">Are you sure you want to remove section "<?=$sec['section_name']?>"</div> 
            </div>	
            <div class="footer_go_back">
                <span class="continue">
                    <input type="button" value="YES" onClick="submitform('<?=$_GET['rid']?>', 'del_sec', 'sec_msg')" class="blue_button" />
                    <input type="button" value="NO" onClick="fancy_close()" class="blue_button" />
                </span>
            </div>
		</form>
</div>        
<?php		
	}
}
?>