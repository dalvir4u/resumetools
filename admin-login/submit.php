<?php
$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();
if($_SERVER['REQUEST_METHOD']=='POST')
{
	$postdata = $_POST;
	if(isset($_POST['form_id']) and $_POST['form_id']=="change_pass"){		
		$c['adminuser'] = $postdata['uname'];
		$c['adminpass'] = $postdata['upassword'];
		if(!$co->query_update('admin', $c, 'id="1"')){
			$co->setmessage("error", "login information not updated");			   
		}else{
			$co->setmessage("status", "login information updated successfully");			   
		}
	}
	if(isset($_POST['form_id']) and $_POST['form_id']=="page_edit"){		
		$p['title'] = $postdata['title'];
		$p['body'] = $postdata['body'];
		if(!$co->query_update('pages', $p, 'page_id='.$postdata['pid'])){
			$co->setmessage("error", "Page not updated");			   
		}else{
			$co->setmessage("status", "Page updated successfully");			   
		}
	}
	
}
?>