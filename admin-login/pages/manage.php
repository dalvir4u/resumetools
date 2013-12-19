<?php
if(isset($_GET['delid']))
{
	$qr="delete from `sponsor` where sid=$_GET[delid]";
	mysql_query($qr);
	?>
	<script language="javascript">
		window.location.href="main.php?p=pages/manage";
	</script>
	<?php
}
?>
<div class="pagehead">Manage Pages</div>
<div class="con">
<table>
<tr>
<th>Page Title</th><th>Operation</th>
</tr>
<?php
$pgs = $co->load_all_pages();
$i = 1;
foreach($pgs as $pg){
	if($i%2==0)
		$class="even";
	else
		$class="odd";
	echo '
<tr class="'.$class.'">
<td>'.$pg['title'].'</td><td>
	<a href="main.php?p=pages/edit&id='.$pg['page_id'].'">
	<img src="images/edit.png" style="width:24px; margin-left:10px;" /></a>';
?>
        </td>
</tr>	
	<?php
	$i++;
}
?>
</table>
</div>