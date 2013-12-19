<?php
$pg=$co->load_single_page($_GET['page_id']);
?>
	<div class="login_banner" style="padding:0;">
		<div class="createuser_login_content">
			<div class="page_title"><?=$pg['title']?></div>
			<div class="page_body"><?=$pg['body']?></div>
		</div><!-- End .login_content -->
	</div><!-- End .login_banner -->