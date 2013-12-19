<script>
	function validationVideo(){
		var video_title=document.getElementById('video_title');
		var video_url=document.getElementById('video_url');
		var day=document.getElementById('day');
		var month=document.getElementById('month');
		var year=document.getElementById('year');
		if(video_title.value==""){
			alert('Please Fill Video Title');
			video_title.focus();	
			return false;
		}
		if(video_url.value==""){
			alert('Plese Fill Video URL');
			video_url.focus();	
			return false;
		}
		if(day.value=="0"){
			alert('Please Select Day');
			day.focus();	
			return false;
		}
		if(month.value=="0"){
			alert('Please Select Month');
			month.focus();	
			return false;
		}
		if(year.value=="0"){
			alert('Please Select Year');
			year.focus();	
			return false;
		}
	}
</script>
	<div class="video_upload_us">
		<div class="video_upload_main">
			<h1>Uploads Your Video</h1>
			<form action="PHPClass/VideoUpload.php" method="post" onsubmit="return validationVideo()">
				<table>
					<tr>
						<td>Video Title</td>
						<td><input type="text" name="video_title" id="video_title"></td>
					</tr>
					<tr>
						<td>Video URL (Only YouTube)</td>
						<td><input type="text" name="video_url" id="video_url"></td>
					</tr>
					<tr>
						<td>Video Date</td>
						<td>
							<select name="day" id="day">
								<option value="0">Day</option>
							<?php
								for($i=1;$i<=31;$i++){
									echo '<option value="'.$i.'">'.$i.'</option>';
								}	
							?>
							</select>
							<select name="month" id="month">
								<option value="0">Month</option>
							<?php
								for($i=1;$i<=12;$i++){
									echo '<option value="'.$i.'">'.$i.'</option>';
								}	
							?>
							</select>
							<select name="year" id="year">
								<option value="0">Year</option>
							<?php
								for($i=2013;$i>=2000;$i--){
									echo '<option value="'.$i.'">'.$i.'</option>';
								}	
							?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Artist Name</td>
						<td><input type="text" name="video_artist"></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><input type="submit" name="PandhersSubmit" value="Uploads"></td>
					</tr>
				</table>
			</form>	
		</div>
	</div>
