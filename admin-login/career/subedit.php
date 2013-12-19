<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{
	$postdata = $_POST;
	// Include the submit file
	if(isset($_POST['form_id']) and $_POST['form_id']=="edit_careersub"){	
		$con['csub_name'] = $postdata['csub_name'];
		$con['career'] = $postdata['career'];
		$co->query_update('career_sub', $con, '`csub_id`='.$postdata['id']);
		$co->setmessage("status", "career sub successfully updated");
	}//end of if form_id is create company
}
?>
<div class="pagehead">Edit Sub Career</div>
<div class="con">
<?php
	$msg = $co->theme_messages();
	if(isset($msg)){ echo $msg; }
	$c = $co->query_first("SELECT * FROM career_sub WHERE csub_id='".$_GET['id']."'");
	if(isset($c['csub_id']) and $c['csub_id']>0){
?>
<form action="" method="post" id="create_career">
	<input type="hidden" name="form_id" value="edit_careersub"/>
    <input type="hidden" name="id" value="<?=$c['csub_id']?>"/>
	<div class="form-item">
		<label>Career Sub Name : </label>
		<input type="text" name="csub_name" value="<?=$c['csub_name']?>" class="create_input" style="width:300px;" />
	</div>
    <div class="form-item">
		<label>Career Name : </label>
		<select name="career">
			<?php
            $careers = $co->fetch_all_array("select * from career");
            foreach($careers as $career){
				$sel = '';
				if($c['career']==$career['career_id'])
					$sel = ' selected="selected"';
                echo '<option value="'.$career['career_id'].'"'.$sel.'>'.$career['career_name'].'</option>';
            }
            ?>
        </select>
	</div>
	<div class="form-submit">
    	<input type="submit" class="blue_button" name="addnew" value="Update" />
	</div>
</form>
<?php
	}
?>
</div>