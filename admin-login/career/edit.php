<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{
	$postdata = $_POST;
	// Include the submit file
	if(isset($_POST['form_id']) and $_POST['form_id']=="edit_career"){	
		$con['career_name'] = $postdata['career_name'];
		$co->query_update('career', $con, '`career_id`='.$postdata['id']);
		$co->setmessage("status", "Career successfully updated");
	}//end of if form_id is create company
}
?>
<div class="pagehead">Edit Career</div>
<div class="con">
<?php
	$msg = $co->theme_messages();
	if(isset($msg)){ echo $msg; }
	$c = $co->query_first("SELECT * FROM career WHERE career_id='".$_GET['id']."'");
	if(isset($c['career_id']) and $c['career_id']>0){
?>
<form action="" method="post" id="create_career">
	<input type="hidden" name="form_id" value="edit_career"/>
    <input type="hidden" name="id" value="<?=$c['career_id']?>"/>
	<div class="form-item">
		<label>Career Name</label>
		<input type="text" name="career_name" value="<?=$c['career_name']?>" class="create_input" style="width:300px;" />
	</div>
	<div class="form-submit">
    	<input type="submit" class="blue_button" name="addnew" value="Update" />
	</div>
</form>
<?php
	}
?>
</div>