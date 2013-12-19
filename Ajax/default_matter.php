<div style="width:500px; overflow:hidden;">
	<div class="form">
		<div id="create_msg"></div>
		<form class="" id="create_form" onSubmit="return validate_this()" action="submit.php" method="post">
			<input type="hidden" name="form_id" value="create_resume" />
			<div class="textarea">
				<label class="company" for="normal-field">First Name <span style="color:red">*</span></label>
				<div class="">
					<input type="text" name="first_name" class="row-fluid required" />
				</div>
			</div>
			<div class="textarea">
				<label class="company" for="normal-field">Last Name <span style="color:red">*</span></label>
				<div class="">
					<input type="text" name="last_name" class="row-fluid required" />
				</div>
			</div>
			<div style="color:#009CB9; margin-left:10px; font-size:12px">Select Sections</div>
			<div class="textarea">
				<div style="width:450px">
					<select multiple="multiple" id="my-select" name="sections[]">
					<?php
					$sections = $co->load_sections();
					foreach($sections as $section){
						echo '<option value="'.$section['sectionid'].'">'.$section['section_name'].'</option>';
					}
					?>
					</select>
				</div>
			</div>
			<div class="footer_go_back">
            	<img src="<?=WEB_ROOT?>/Ajax/img/line.jpg" alt="" title="" />
				<span class="goback">
					<input type="button" name="skip" value="SKIP to all resumes" onClick="window.location.href='main.php'" class="blue_button" />
				</span>
				<span class="continue">
					<input type="submit" class="blue_button" value="Submit" />
                </span>
			</div>
		</form>
	</div><!-- End .form -->
</div>