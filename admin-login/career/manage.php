<?php
if(isset($_GET['delid']))
{
	$qr="delete from `career` where career_id=$_GET[delid]";
	mysql_query($qr);
	?>
	<script language="javascript">
		window.location.href="main.php?p=career/manage";
	</script>
	<?php
}
?>
<div class="pagehead">Manage Careers</div>
<div class="con">
<table>
<tr>
<th>Title</th><th>Operation</th>
</tr>
<?php
$sql = "SELECT * FROM `career`";
$pgs = $co->fetch_all_array($co->getPagingQuery($sql));
$i = 1;
foreach($pgs as $pg){
	if($i%2==0)
		$class="even";
	else
		$class="odd";
	echo '
<tr class="'.$class.'">
<td>'.$pg['career_name'].'</td><td>
	<a href="main.php?p=career/edit&id='.$pg['career_id'].'">
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
<div class="paging"><?=$co->getPagingLink($sql, 10, 'p=career/manage')?></div>