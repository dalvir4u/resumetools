<?php
include('config/config.inc.php');
include('config/Database.class.php');
include('classes/common.class.php');

$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();
if($_SERVER['REQUEST_METHOD']=='POST')
{
	$postdata = $_POST;

	if(isset($_POST['form_id']) and $_POST['form_id']=="create_resume"){	
		$con['uid'] = $_SESSION['user_id'];
		$con['first_name'] = $postdata['first_name'];
		$con['last_name'] = $postdata['last_name'];
		$tim = time();
		$con['temp'] = 'classic1';
		$con['created'] = $tim;
		$con['updated'] = $tim;
		$rid = $co->query_insert('resume', $con);
		
		if(isset($postdata['sections']) and count($postdata['sections'])>0){
			$sections = $postdata['sections'];
			$i = 1;
			foreach($sections as $section){
				$res_sec = array();
				$res_sec['resume_id']=$rid;
				$res_sec['section_id']=$section;
				$res_sec['delta']=$i;
				$co->query_insert('resume_sections', $res_sec);
				$i++;
				unset($res_sec);
			}
		}
?>
<script type="text/javascript">
	window.location.href='resumecreate.php?id=<?=$rid?>';
</script>
<?php		
	}//end of if form_id is create company
	
	if(isset($_POST['form_id']) and $_POST['form_id']=="change_template"){	
		$con['temp'] = $postdata['temp'];
		$tim = time();
		$con['created'] = $tim;
		$con['updated'] = $tim;
		$co->query_update('resume', $con, 'resume_id='.$postdata['rid']);
		
	}//end of if form_id is create company
	
	if(isset($_POST['form_id']) and $_POST['form_id']=="add_section"){	
		if(isset($postdata['sections']) and count($postdata['sections'])>0){
			$sections = $postdata['sections'];
			$i = 1;
			foreach($sections as $section){
				$res_sec = array();
				$res_sec['resume_id']=$postdata['rid'];
				$res_sec['section_id']=$section;
				$res_sec['delta']=$i;
				$co->query_insert('resume_sections', $res_sec);
				$i++;
				unset($res_sec);
			}
		}		
	}//end of if form_id is create company
	
	if(isset($_POST['form_id']) and $_POST['form_id']=="delete_section"){	
		if(isset($postdata['section'])){
			$section_id = $postdata['section'];
			$resume_id = $postdata['rid'];
			$co->query("DELETE FROM resume_sections WHERE resume_id='$resume_id' and section_id='$section_id'");
			if($section_id==2){
				$co->query("DELETE FROM resume_education WHERE resume_id='$resume_id'");
			}elseif($section_id==3){
				$co->query("DELETE FROM resume_highlights WHERE resume_id='$resume_id'");
			}elseif($section_id==4){
				$co->query("DELETE FROM resume_experience WHERE resume_id='$resume_id'");
			}elseif($section_id==5){
				$co->query("DELETE FROM resume_executive_summary WHERE resume_id='$resume_id'");
			}elseif($section_id==19){
				$co->query("DELETE FROM resume_executive_exp WHERE resume_id='$resume_id'");
			}elseif($section_id==20){
				$co->query("DELETE FROM resume_technical_skills WHERE resume_id='$resume_id'");
			}elseif($section_id==21){
				$co->query("DELETE FROM resume_work_history WHERE resume_id='$resume_id'");
			}else{
				$other['section_'.$section_id] = '';					
				$co->query_update('resume_other_section', $other, 'resume_id='.$resume_id);
			}			
		}		
	}//end of if form_id is create company
	
	if(isset($_POST['form_id']) and $_POST['form_id']=="name_detail"){	
		$con['first_name'] = $postdata['first_name'];
		$con['last_name'] = $postdata['last_name'];		
		$tim = time();
		$con['created'] = $tim;
		$con['updated'] = $tim;
		$co->query_update('resume', $con, 'resume_id='.$postdata['rid']);
		
	}//end of if form_id is create company
	if(isset($_POST['form_id']) and $_POST['form_id']=="contact_detail"){	
		$con['resume_id'] = $postdata['rid'];
		$con['street'] = $postdata['street'];
		$con['street2'] = $postdata['street2'];
		$con['city'] = $postdata['city'];
		$con['state'] = $postdata['state'];
		$con['zip'] = $postdata['zip'];
		$con['phone_num'] = $postdata['phone_num'];
		//$con['cell_num'] = $postdata['cell_num'];
		$con['email'] = $postdata['email'];
		$tim = time();
		$con['created'] = $tim;
		$con['updated'] = $tim;
		$co->query_update('resume', $con, 'resume_id='.$postdata['rid']);
		
	}//end of if form_id is create company
	
	if(isset($_POST['form_id']) and $_POST['form_id']=="createcontact_detail"){	
		$con['resume_id'] = $postdata['rid'];
		$con['street'] = $postdata['street'];
		$con['street2'] = $postdata['street2'];
		$con['city'] = $postdata['city'];
		$con['state'] = $postdata['state'];
		$con['zip'] = $postdata['zip'];
		$con['phone_num'] = $postdata['phone_num'];
		$con['email'] = $postdata['email'];
		$tim = time();
		$con['created'] = $tim;
		$con['updated'] = $tim;
		$co->query_update('resume', $con, 'resume_id='.$postdata['rid']);
?>
<script type="text/javascript">
	window.location.href='resumecreate.php?id=<?=$postdata['rid']?>';
</script>
<?php		
		
	}//end of if form_id is create company
	
	if(isset($_POST['form_id']) and $_POST['form_id']=="other_section"){	
		$other['resume_id'] = $postdata['rid'];
		$section_id = $postdata['id'];
		$other['section_'.$section_id] = strip_tags($postdata['section_'.$section_id], '<p><a><ul><ol><li><br><b><i><u><strong><em>');
		
		$exist = $co->query_first("select resume_id from resume_other_section where resume_id='".$postdata['rid']."'");
		if(isset($exist['resume_id']) and $exist['resume_id']>0){
			$co->query_update('resume_other_section', $other, 'resume_id='.$postdata['rid']);		
		}else{
			$co->query_insert('resume_other_section', $other);			
		}
		$co->update_resume_section_submit($postdata['rid'], $section_id);
		$tim = time();
		$con['created'] = $tim;
		$con['updated'] = $tim;
		$co->query_update('resume', $con, 'resume_id='.$postdata['rid']);
	}//end of if form_id is create company
	if(isset($_POST['form_id']) and $_POST['form_id']=="highlight_section"){	
		$hl['resume_id'] = $postdata['rid'];
		$hl['highlight1'] = $postdata['highlight1'];
		$hl['highlight2'] = $postdata['highlight2'];			
		
		$exist = $co->query_first("select resume_id from resume_highlights where resume_id='".$postdata['rid']."'");
		if(isset($exist['resume_id']) and $exist['resume_id']>0){
			$co->query_update('resume_highlights', $hl, 'resume_id='.$postdata['rid']);		
		}else{
			$co->query_insert('resume_highlights', $hl);			
		}
		$co->update_resume_section_submit($postdata['rid'], 3);
		$tim = time();
		$con['created'] = $tim;
		$con['updated'] = $tim;
		$co->query_update('resume', $con, 'resume_id='.$postdata['rid']);
	}//end of if form_id is create company	
	if(isset($_POST['form_id']) and $_POST['form_id']=="executive_summary"){	
		$es['resume_id'] = $postdata['rid'];
		$es['main_summary'] = strip_tags($postdata['main_summary'], '<p><a><ul><ol><li><br><b><i><u><strong><em>');
		$es['expert1'] = strip_tags($postdata['expert1'], '<p><a><ul><ol><li><br><b><i><u><strong><em>');
		$es['expert2'] = strip_tags($postdata['expert2'], '<p><a><ul><ol><li><br><b><i><u><strong><em>');
		
		$exist = $co->query_first("select resume_id from resume_executive_summary where resume_id='".$postdata['rid']."'");
		if(isset($exist['resume_id']) and $exist['resume_id']>0){
			$co->query_update('resume_executive_summary', $es, 'resume_id='.$postdata['rid']);		
		}else{
			$co->query_insert('resume_executive_summary', $es);			
		}
		$co->update_resume_section_submit($postdata['rid'], 5);
		$tim = time();
		$con['created'] = $tim;
		$con['updated'] = $tim;
		$co->query_update('resume', $con, 'resume_id='.$postdata['rid']);
		
	}//end of if form_id is create company	
	if(isset($_POST['form_id']) and $_POST['form_id']=="experience_newdetail"){	
		$con['resume_id'] = $postdata['rid'];
		$con['company_name'] = $postdata['company_name'];
		$con['city'] = $postdata['city'];
		$con['state'] = $postdata['state'];
		$con['position'] = $postdata['position'];
		$con['desc'] = strip_tags($postdata['desc'], '<p><a><ul><ol><li><br><b><i><u><strong><em>');
		$date_from = $postdata['from_month'];
		if($postdata['from_month']!='Current' and $postdata['from_month']!=''){
			$date_from .= ' '.$postdata['from_year'];
		}
		$con['date_from'] = $date_from;
		$date_to = $postdata['to_month'];
		if($postdata['to_month']!='Current' and $postdata['to_month']!=''){
			$date_to .= ' '.$postdata['to_year'];
		}
		$con['date_to'] = $date_to;
		
		$co->query_insert('resume_experience', $con);
		$co->update_resume_section_submit($postdata['rid'], 4);
		$tim = time();
		$con['created'] = $tim;
		$con['updated'] = $tim;
		$co->query_update('resume', $con, 'resume_id='.$postdata['rid']);
	}//end of if form_id is create company
	if(isset($_POST['form_id']) and $_POST['form_id']=="experience_editdetail"){	
		$con['company_name'] = $postdata['company_name'];
		$con['city'] = $postdata['city'];
		$con['state'] = $postdata['state'];
		$con['position'] = $postdata['position'];
		$con['desc'] = strip_tags($postdata['desc'], '<p><a><ul><ol><li><br><b><i><u><strong><em>');
		$date_from = $postdata['from_month'];
		if($postdata['from_month']!='Current' and $postdata['from_month']!=''){
			$date_from .= ' '.$postdata['from_year'];
		}
		$con['date_from'] = $date_from;
		$date_to = $postdata['to_month'];
		if($postdata['to_month']!='Current' and $postdata['to_month']!=''){
			$date_to .= ' '.$postdata['to_year'];
		}
		$con['date_to'] = $date_to;
		
		$co->query_update('resume_experience', $con, 'experience_id='.$postdata['id']);
		$tim = time();
		$con['created'] = $tim;
		$con['updated'] = $tim;
		$co->query_update('resume', $con, 'resume_id='.$postdata['rid']);
	}//end of if form_id is create company
	if(isset($_POST['form_id']) and $_POST['form_id']=="experience_deldetail"){	
		$co->query_delete('resume_experience', 'experience_id='.$postdata['id']);

	}//end of if form_id is create company
	if(isset($_POST['form_id']) and $_POST['form_id']=="workhistory_newdetail"){	
		$con['resume_id'] = $postdata['rid'];
		$con['company_name'] = $postdata['company_name'];
		$con['city'] = $postdata['city'];
		$con['state'] = $postdata['state'];
		$con['position'] = $postdata['position'];
		$date_from = $postdata['from_month'];
		if($postdata['from_month']!='Current' and $postdata['from_month']!=''){
			$date_from .= ' '.$postdata['from_year'];
		}
		$con['date_from'] = $date_from;
		$date_to = $postdata['to_month'];
		if($postdata['to_month']!='Current' and $postdata['to_month']!=''){
			$date_to .= ' '.$postdata['to_year'];
		}
		$con['date_to'] = $date_to;
		
		$co->query_insert('resume_work_history', $con);
		$co->update_resume_section_submit($postdata['rid'], 21);
		$tim = time();
		$con['created'] = $tim;
		$con['updated'] = $tim;
		$co->query_update('resume', $con, 'resume_id='.$postdata['rid']);
	}//end of if form_id is create company
	if(isset($_POST['form_id']) and $_POST['form_id']=="workhistory_editdetail"){	
		$con['company_name'] = $postdata['company_name'];
		$con['city'] = $postdata['city'];
		$con['state'] = $postdata['state'];
		$con['position'] = $postdata['position'];
		$date_from = $postdata['from_month'];
		if($postdata['from_month']!='Current' and $postdata['from_month']!=''){
			$date_from .= ' '.$postdata['from_year'];
		}
		$con['date_from'] = $date_from;
		$date_to = $postdata['to_month'];
		if($postdata['to_month']!='Current' and $postdata['to_month']!=''){
			$date_to .= ' '.$postdata['to_year'];
		}
		$con['date_to'] = $date_to;
		
		$co->query_update('resume_work_history', $con, 'work_his_id='.$postdata['id']);
		$tim = time();
		$con['created'] = $tim;
		$con['updated'] = $tim;
		$co->query_update('resume', $con, 'resume_id='.$postdata['rid']);
	}//end of if form_id is create company
	if(isset($_POST['form_id']) and $_POST['form_id']=="workhistory_deldetail"){	
		$co->query_delete('resume_work_history', 'work_his_id='.$postdata['id']);
	}//end of if form_id is create company
	if(isset($_POST['form_id']) and $_POST['form_id']=="education_newdetail"){	
		$con['resume_id'] = $postdata['rid'];
		$con['degree'] = $postdata['degree'];
		$con['school'] = $postdata['school'];
		$con['city'] = $postdata['city'];
		$con['state'] = $postdata['state'];
		$con['country'] = $postdata['country'];
		$con['grade_year'] = $postdata['grade_year'];
		$con['field_of_study'] = $postdata['field_of_study'];
		$con['desc'] = strip_tags($postdata['desc'], '<p><a><ul><ol><li><br><b><i><u><strong><em>');
		
		$co->query_insert('resume_education', $con);
		$co->update_resume_section_submit($postdata['rid'], 2);
		$tim = time();
		$con['created'] = $tim;
		$con['updated'] = $tim;
		$co->query_update('resume', $con, 'resume_id='.$postdata['rid']);
	}//end of if form_id is create company
	if(isset($_POST['form_id']) and $_POST['form_id']=="education_editdetail"){	
		$con['degree'] = $postdata['degree'];
		$con['school'] = $postdata['school'];
		$con['city'] = $postdata['city'];
		$con['state'] = $postdata['state'];
		$con['country'] = $postdata['country'];
		$con['grade_year'] = $postdata['grade_year'];
		$con['field_of_study'] = $postdata['field_of_study'];
		$con['desc'] = strip_tags($postdata['desc'], '<p><a><ul><ol><li><br><b><i><u><strong><em>');
		
		$co->query_update('resume_education', $con, 'education_id='.$postdata['id']);
		$tim = time();
		$con['created'] = $tim;
		$con['updated'] = $tim;
		$co->query_update('resume', $con, 'resume_id='.$postdata['rid']);
	}//end of if form_id is create company
	if(isset($_POST['form_id']) and $_POST['form_id']=="education_deldetail"){	
		$co->query_delete('resume_education', 'education_id='.$postdata['id']);
	}//end of if form_id is create company
	
	if(isset($_POST['form_id']) and $_POST['form_id']=="executive_expnewform"){	
		$con['resume_id'] = $postdata['rid'];
		$con['company_name'] = $postdata['company_name'];
		$con['city'] = $postdata['city'];
		$con['state'] = $postdata['state'];
		$con['company_desc'] = $postdata['company_desc'];
		$con['position'] = $postdata['position'];
		$date_from = $postdata['from_month'];
		if($postdata['from_month']!='Current' and $postdata['from_month']!=''){
			$date_from .= ' '.$postdata['from_year'];
		}
		$con['date_from'] = $date_from;
		$date_to = $postdata['to_month'];
		if($postdata['to_month']!='Current' and $postdata['to_month']!=''){
			$date_to .= ' '.$postdata['to_year'];
		}
		$con['date_to'] = $date_to;
		$con['desc'] = strip_tags($postdata['desc'], '<p><a><ul><ol><li><br><b><i><u><strong><em>');
		
		$co->query_insert('resume_executive_exp', $con);
		$co->update_resume_section_submit($postdata['rid'], 19);
		$tim = time();
		$con['created'] = $tim;
		$con['updated'] = $tim;
		$co->query_update('resume', $con, 'resume_id='.$postdata['rid']);
	}//end of if form_id is create company
	if(isset($_POST['form_id']) and $_POST['form_id']=="executive_expeditform"){	
		$con['company_name'] = $postdata['company_name'];
		$con['city'] = $postdata['city'];
		$con['state'] = $postdata['state'];
		$con['company_desc'] = $postdata['company_desc'];
		$con['position'] = $postdata['position'];
		$date_from = $postdata['from_month'];
		if($postdata['from_month']!='Current' and $postdata['from_month']!=''){
			$date_from .= ' '.$postdata['from_year'];
		}
		$con['date_from'] = $date_from;
		$date_to = $postdata['to_month'];
		if($postdata['to_month']!='Current' and $postdata['to_month']!=''){
			$date_to .= ' '.$postdata['to_year'];
		}
		$con['date_to'] = $date_to;
		$con['desc'] = strip_tags($postdata['desc'], '<p><a><ul><ol><li><br><b><i><u>');
		
		$co->query_update('resume_executive_exp', $con, 'executive_exp_id='.$postdata['id']);
		$tim = time();
		$con['created'] = $tim;
		$con['updated'] = $tim;
		$co->query_update('resume', $con, 'resume_id='.$postdata['rid']);
	}//end of if form_id is create company
	if(isset($_POST['form_id']) and $_POST['form_id']=="executive_expdelform"){	
		$co->query_delete('resume_executive_exp', 'executive_exp_id='.$postdata['id']);
	}//end of if form_id is create company
	
	if(isset($_POST['form_id']) and $_POST['form_id']=="new_technical_skill"){	
		$con['resume_id'] = $postdata['rid'];
		$con['skills'] = $postdata['skills'];
		$con['expertise'] = $postdata['expertise'];
		$con['total_year'] = $postdata['total_year'];
		$con['last_used'] = $postdata['last_used'];
		
		$co->query_insert('resume_technical_skills', $con);
		$co->update_resume_section_submit($postdata['rid'], 20);
		$tim = time();
		$con['created'] = $tim;
		$con['updated'] = $tim;
		$co->query_update('resume', $con, 'resume_id='.$postdata['rid']);
	}//end of if form_id is create company
	
	if(isset($_POST['form_id']) and $_POST['form_id']=="edit_technical_skill"){	
		$con['skills'] = $postdata['skills'];
		$con['expertise'] = $postdata['expertise'];
		$con['total_year'] = $postdata['total_year'];
		$con['last_used'] = $postdata['last_used'];
		
		$co->query_update('resume_technical_skills', $con, 'technical_skill='.$postdata['id']);
		$tim = time();
		$con['created'] = $tim;
		$con['updated'] = $tim;
		$co->query_update('resume', $con, 'resume_id='.$postdata['rid']);
	}//end of if form_id is create company
	if(isset($_POST['form_id']) and $_POST['form_id']=="tec_skills_delete"){	
		$co->query_delete('resume_technical_skills', 'technical_skill='.$postdata['id']);
	}//end of if form_id is create company
	
	if(isset($_POST['form_id']) and $_POST['form_id']=="createresume_first"){	
		$con['uid'] = 0;
		$con['first_name'] = $postdata['fname'];
		$con['last_name'] = $postdata['lname'];
		$tim = time();
		$con['temp'] = 'classic1';
		$con['created'] = $tim;
		$con['updated'] = $tim;
		$rid = $co->query_insert('resume', $con);
		$_SESSION['resume_id'] = $rid;
		
		$sections = array('1', '2', '3', '4');
		$i = 1;
		foreach($sections as $section){
			$res_sec = array();
			$res_sec['resume_id']=$rid;
			$res_sec['section_id']=$section;
			$res_sec['delta']=$i;
			$co->query_insert('resume_sections', $res_sec);
			$i++;
			unset($res_sec);
		}
	}
		
	if(isset($_POST['form_id']) and $_POST['form_id']=="createuser_first"){	
		$con['experience'] = $postdata['experience'];
		$con['career'] = $postdata['career'];
		//$con['career-sub'] = $postdata['career-sub'];
		$con['education'] = $postdata['education'];
		$con['add_info'] = serialize($postdata['add_info']);
		
		$desired_job = $co->query_insert('user_desired_job', $con);
		$_SESSION['desired_job'] = $desired_job;
	}//end of if form_id is create company
	
	if(isset($_POST['form_id']) and $_POST['form_id']=="createuser_second"){
		$con['password'] = md5($postdata['password']);
		$con['email'] = $postdata['email'];
		$tim = time();
		$con['last_login'] = $tim;
		$con['status'] = 1;
		$con['created'] = $tim;
		$con['updated'] = $tim;
		
		$uid = $co->query_insert('users', $con);
				
		if($co->login($postdata['email'],$postdata['password'])){
			$res['uid'] = $uid;
			$co->query_update('resume', $res, 'resume_id='.$_SESSION['resume_id']);
			$co->query_update('user_desired_job', $res, 'desired_id='.$_SESSION['desired_job']);
			/*
			$con1['uid'] = $_SESSION['user_id'];
			$con1['first_name'] = 'First name';
			$con1['last_name'] = 'Last name';
			$tim = time();
			$con1['temp'] = 'classic1';
			$con1['created'] = $tim;
			$con1['updated'] = $tim;
			$rid = $co->query_insert('resume', $con1);
			$sections = array('1', '2', '4', '13', '14');
			$i = 1;
			foreach($sections as $section){
				$res_sec = array();
				$res_sec['resume_id']=$rid;
				$res_sec['section_id']=$section;
				$res_sec['delta']=$i;
				$co->query_insert('resume_sections', $res_sec);
				$i++;
				unset($res_sec);
			}
			*/
			?>
			<script language="javascript">window.location="resumecreate.php?id=<?=$_SESSION['resume_id']?>&fourth=1";</script>
			<?php	
		}
	}//end of if form_id is create company
	
		
		
	$msg = $co->theme_messages();
}
?>
