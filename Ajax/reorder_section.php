<?php
include('../config/config.inc.php');
include('../config/Database.class.php');
include('../classes/common.class.php');

$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();
$sections = $co->load_resume_sections($_GET['id']);
?>
<script type="text/javascript">
$(document).ready(function(){ 	
function slideout(){
  setTimeout(function(){
  $("#response").slideUp("slow", function () {
      });
    
}, 2000);}
	
    $("#response").hide();
	$(function() {
	$("ul.sortable").sortable({ opacity: 0.8, cursor: 'move', update: function() {
			
			var order = $(this).sortable("serialize") + '&action=updateRecordsListings'; 
			$.post("Ajax/order_sections.php", order, function(theResponse){
				$("#response").html(theResponse);
				$("#response").slideDown('slow');
				slideout();
			}); 															 
		}								  
		});
	});

});	
</script>
<div style="width:500px; overflow:hidden">
	<div style="font-size:11px;">
		Mouseover the Section whose position you want to change, press left click when you are there, 
        move it to the position where you want it to go and then release the left click button. 
        Once done Click on save changes
    </div>
	<div class="form">
    	<div id="response"> </div>
        <ul class="sortable" style="max-height:200px; overflow-y:scroll">
		<?php
		foreach($sections as $section){
			$sec_d = $co->load_single_section($section['section_id']);
			echo '
			<li id="recordsArray_'.$section['orderid'].'" style="cursor:move">
				'.$sec_d['section_name'].'			
			</li>
			';
		}
		?>
        </ul>
        <div class="footer_go_back">
            <img src="<?=WEB_ROOT?>/Ajax/img/line.jpg" alt="" title="" />
            <span class="goback"><br />
			<form><input type="button" onClick="close_andrefresh(<?=$_GET['id']?>)" name="preview" class="blue_button" value="save changes" /></form>
                </span>            
        </div>
	</div><!-- End .form -->
</div>
