<?php
if(isset($_GET['delid']))
{
	$u=$co->load_single_user($_GET['delid']);
	if(isset($u['user_id']) and $u['user_id']>0){
		if($co->query_delete('users', 'user_id='.$_GET['delid']))
			$co->setmessage("status", "User successfully deleted");
	}
	?>
	<script language="javascript">
		//window.location.href="main.php?p=user/manage";
	</script>
	<?php
}
?>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#manage_user').dataTable( {
			"sPaginationType": "full_numbers",
			"bLengthChange": false,
			"bInfo": false,
		} );
	} );
</script>
 <script>
 function confirm_del(uid){
	$( "#dialog-confirm" ).dialog({
		resizable: false,
		height:140,
		modal: true,
		buttons: {
			"Delete": function() {
				window.location.href='main.php?p=user/manage&delid='+uid;
			},
			Cancel: function() {
				$( this ).dialog( "close" );
			}
		}
	});
 }
</script>
<div id="dialog-confirm" title="DELETE USER" style="display:none;">
	<p>Are you sure you want to delete this user?</p>
</div>
<div class="pagehead">Manage User</div>
<div class="con">
<?php
$msg = $co->theme_messages();
if(isset($msg)){ echo $msg; }
?>
<table id="manage_user">
<thead>
	<tr>
		<th>Email</th><th>Created on</th>
        <th>No. of Resumes</th><th>No. of Downloads</th>
        <th>Status</th><th>Operation</th>
	</tr>
</thead>
<tbody>
<?php
$pgs = $co->load_all_users();
$i = 1;
foreach($pgs as $pg){
	if($i%2==0)
		$class="even";
	else
		$class="odd";
	if($pg['status']==1){
		$status = 'Active';	
	}else{
		$status = 'Inactive';	
	}
	$no_resumes = $co->query_first("SELECT count(resume_id) as cres FROM `resume` WHERE `uid`='".$pg['user_id']."'");
	$no_download = $co->query_first("SELECT count(resume_id) as cres FROM `resume_downloads` WHERE `uid`='".$pg['user_id']."'");
	echo '
<tr class="'.$class.'">
<td>'.$pg['email'].'</td>
<td>'.date('j M Y, h:ia', $pg['created']).'</td>
<td>'.$no_resumes['cres'].'</td>
<td>'.$no_download['cres'].'</td>
<td>'.$status.'</td>
<td>
	<a href="main.php?p=user/edit&id='.$pg['user_id'].'">
	<img src="images/edit.png" style="width:24px; margin-left:10px;" /></a>
	<img src="images/delete.png" style="width:24px; margin-left:10px; cursor:pointer" onclick="confirm_del('.$pg['user_id'].')" />
	';
?>
        </td>
</tr>	
	<?php
	$i++;
}
?>
</tbody>
</table>
</div>