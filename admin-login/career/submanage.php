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
<div class="pagehead">Manage Sub Careers</div>
<div class="con">
Filter By Career :
<form method="post"> 
<select name="career">
	<option value="">All</option>
<?php
$scareer = "SELECT * FROM `career`";
$careers = $co->fetch_all_array($scareer);
$i = 1;
foreach($careers as $career){
	$sel = '';
	if($career['career_id']==$_POST['career'])
		$sel = ' selected="selected"';
	echo '<option value="'.$career['career_id'].'"'.$sel.'>'.$career['career_name'].'</option>';
}
?>
</select>
<input type="submit" name="apply" value="Apply" />
</form>
<table>
<tr>
<th>Sub field</th><th>Career</th><th>Operation</th>
</tr>
<?php
if(isset($_POST['career']) and $_POST['career']!=""){
	$sql = "SELECT * FROM `career_sub` WHERE `career`='".$_POST['career']."'";
}else{
	$sql = "SELECT * FROM `career_sub`";
}
$pgs = $co->fetch_all_array($co->getPagingQuery($sql, 20));
$i = 1;
foreach($pgs as $pg){
	if($i%2==0)
		$class="even";
	else
		$class="odd";
	$c = $co->query_first("SELECT * FROM career WHERE career_id='".$pg['career']."'");		
	echo '
<tr class="'.$class.'">
<td>'.$pg['csub_name'].'</td>
<td>'.$c['career_name'].'</td>
<td>
	<a href="main.php?p=career/subedit&id='.$pg['csub_id'].'">
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
<div class="paging"><?=$co->getPagingLink($sql, 20, 'p=career/manage')?></div>