<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{
	$postdata = $_POST;
	// Include the submit file
	if(isset($_POST['form_id']) and $_POST['form_id']=="create_career"){	
		$con['career_name'] = $postdata['career_name'];
		$co->query_insert('career', $con);
		$co->setmessage("status", "new career successfully created");
	}//end of if form_id is create company
}
?>
<div class="pagehead">Create Career</div>
<div class="con">
<?php
	$msg = $co->theme_messages();
	if(isset($msg)){ echo $msg; }
?>
<form action="" method="post" id="create_career">
	<input type="hidden" name="form_id" value="create_career"/>
	<div class="form-item">
		<label>Career Name</label>
		<input type="text" name="career_name" class="create_input" style="width:300px;" />
	</div>
	<div class="form-submit">
    	<input type="submit" class="blue_button" name="addnew" value="Update" />
	</div>
</form>
</div>