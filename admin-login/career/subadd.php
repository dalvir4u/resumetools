<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{
	$postdata = $_POST;
	// Include the submit file
	if(isset($_POST['form_id']) and $_POST['form_id']=="create_careersub"){	
		$con['csub_name'] = $postdata['csub_name'];
		$con['career'] = $postdata['career'];
		$co->query_insert('career_sub', $con);
		$co->setmessage("status", "new career sub successfully created");
	}//end of if form_id is create company
}
?>
<div class="pagehead">Create Sub Career</div>
<div class="con">
<?php
	$msg = $co->theme_messages();
	if(isset($msg)){ echo $msg; }
?>
<form action="" method="post" id="create_career">
	<input type="hidden" name="form_id" value="create_careersub"/>
	<div class="form-item">
		<label>Career Sub Name : </label>
		<input type="text" name="csub_name" class="create_input" style="width:300px;" />
	</div>
    <div class="form-item">
		<label>Career Name : </label>
		<select name="career">
			<?php
            $careers = $co->fetch_all_array("select * from career");
            foreach($careers as $career){
                echo '<option value="'.$career['career_id'].'">'.$career['career_name'].'</option>';
            }
            ?>
        </select>
	</div>
	<div class="form-submit">
    	<input type="submit" class="blue_button" name="addnew" value="Update" />
	</div>
</form>
</div>