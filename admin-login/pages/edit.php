<div class="pagehead">Edit Page</div>
<div class="con">
<?php
if(isset($_GET['id'])){
	$pg=$co->load_single_page($_GET['id']);
	$msg = $co->theme_messages();
    if(isset($msg)){ echo $msg; }
?>
<script type="text/javascript">
$(document).ready(function () { $("#page_body").cleditor();
});
  </script>
<form method="post" enctype="multipart/form-data">
	<input type="hidden" name="form_id" value="page_edit" />
	<input type="hidden" name="pid" value="<?=$pg['page_id']?>" />
	<div class="form-item">
		<label>Title : </label>
        <input type="text" name="title" value="<?=$pg['title']?>" />
	</div>
	<div class="form-item">
		<label>Description : </label>
		<textarea id="page_body" name="body"><?=$pg['body']?></textarea>
	</div>
    <div class="form-submit">
    	<input type="submit" class="blue_button" name="addnew" value="Update" />
	</div>
</form>
<?php
}
?>
</div>