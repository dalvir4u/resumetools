<div class="pagehead">Change Password</div>
<div class="con">
<?php
	$msg = $co->theme_messages();
    if(isset($msg)){ echo $msg; }
	$spn=$co->load_admin();
?>
<form method="post">
	<input type="hidden" name="form_id" value="change_pass" />
	<div class="form-item">
		<label>Username : </label>
        <input type="text" name="uname" value="<?=$spn['adminuser']?>" />
	</div>
	<div class="form-item">
		<label>Password : </label>
        <input type="password" name="upassword" value="<?=$spn['adminpass']?>" />
	</div>
	<div class="form-submit">
    	<input type="submit" class="blue_button" name="addnew" value="Update" />
	</div>
</form>
</div>