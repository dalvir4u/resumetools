<script>
	function validation(){
		var username=document.getElementById('username');
		var email=document.getElementById('email');
		var con_email=document.getElementById('con_email');
		var password=document.getElementById('password');
		if(username.value==""){
			alert('Please Fill User Name');
			username.focus();	
			return false;
		}
		if(email.value==""){
			alert('Plese Fill Email');
			email.focus();	
			return false;
		}
		if(con_email.value==""){
			alert('Please Fill Conform Email');
			con_email.focus();	
			return false;
		}
		if(con_email.value!=email.value){
			alert('Please Fill Right Conform Email');
			con_email.focus();	
			return false;
		}
		if(password.value==""){
			alert('Please Fill Password');
			password.focus();	
			return false;
		}
		
	}
</script>
    <div class="main"> </div>
	<div class="center">
	    <div class="content">
				<div class="chat_now1"><img src="Ajax/img/skip.jpg" alt="" title=""/></div>
				<div class="form">
					<form action="submit.php" method="post"onsubmit="return validation()">
						<input type="hidden" name="form_id" value="create_new_user"/>
						<div class="textarea">
							<label class="company" for="normal-field">User Name</label>
							<div class="">
								<input type="text" name="username"id="username" class="row-fluid" />
							</div>
						</div>
						<div class="textarea">
							<label class="company" for="normal-field">Email</label>
							<div class="">
								<input type="text" name="email" id="email" class="row-fluid" />
							</div>
						</div>
						<div class="textarea">
							<label class="company" for="normal-field">Conform Email</label>
							<div class="">
								<input type="text" name="con_email"id="con_email" class="row-fluid" />
							</div>
						</div>
						<div class="textarea">
							<label class="company" for="normal-field">Password</label>
							<div class="">
								<input type="password" name="password"id="password"class="row-fluid">
							</div>
						</div>						
						<div class="footer_go_back"><img src="Ajax/img/line.jpg" alt="" title="" />
							<span class="goback"><img src="Ajax/img/goback_button.jpg"  alt="" title="" /></span>
							<span class="continue"><input type="submit" name="submit_bt"class="submit_butten"/></span>
						</div><!-- End .form -->
					</form>		
				</div>
		</div><!-- End .content -->
	</div><!-- End .center -->
	