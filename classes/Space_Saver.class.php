<?php
class template extends commonClass {	
	function printresume($resume_id){
		$output = '<div id="space_saver">';
		$output .= $this->printname($resume_id);
		$output .= $this->printaddress($resume_id);
		$output .= $this->print_all_sections($resume_id);
		$output .= '</div>';
		return $output;
	}
	
	function printname($resume_id){
		$res = $this->load_single_resume($resume_id);		
		$out = '<div style="text-align:left; font-size:35px; font-family:verdana;" class="name">
           '.$res['first_name'].' '.$res['last_name'];
		$out .= '<div class="name_edit">
					<a class="fancybox fancybox.ajax" href="Ajax/nameedit.php?rid='.$resume_id.'" title="Edit Name">Edit</a>
				</div>';
		$out .= '</div>';
		return $out;
	}
	
	function printaddress($resume_id){
		$res = $this->load_single_resume($resume_id);
				$addr = '';
		//street
		if($res['street']!=""){
			$addr .= $res['street'];	
		}
		if($res['street']!="" and $res['street2']!=""){
			$addr .=' ';	
		}
		//street2
		if($res['street2']!=""){
			$addr .= $res['street2'].' ';	
		}
		if($res['street']!="" or $res['street2']!="" and $res['city']!="" or $res['state']!="" or $res['zip']!=""){
			$addr .=', ';
		}
		//city
		if($res['city']!=""){
			$addr .= $res['city'].' ';	
		}
		//state
		if($res['state']!=""){
			$addr .= $res['state'].' ';	
		}
		//Zip
		if($res['zip']!=""){
			$addr .= ' '.$res['zip'];
		}
		if($addr!=""){
			$addr .=' | ';
		}
		//Phone NUmber
		if($res['phone_num']!=""){
			$addr .= ' Home: '.$res['phone_num'];	
		}
		if($res['email']!="" and $res['phone_num']!=""){
			$addr .=' | ';
		}
		//email
		if($res['email']!=""){
			$addr .= ' '.$res['email'];
		}
		if($res['street']=="" and $res['street2']=="" and $res['city']=="" and $res['state']=="" and $res['zip']=="" and $res['phone_num']==""){
			$addr = 'Street Address, City State Zip | Home: Phone Number | Email address';
		}
		$out = '<div style="text-align:left;  font-size:15px; font-family:verdana; padding:10px;" class="address"> 
           '.$addr;
		$out .= '<div class="address_edit">
					<a class="fancybox fancybox.ajax" href="Ajax/contact.php?rid='.$resume_id.'" title="Edit Address">Edit</a>
				</div>';
		$out .= '</div>';
		return $out;
	}
	
	function print_all_sections($resume_id){
		$res_secs = $this->load_resume_sections($resume_id);
		$thisout = '';
		foreach($res_secs as $res_sec) {
			$section = $this->load_single_section($res_sec['section_id']);
			$thisout .= '
			<div class="section_block" style="margin-top:10px;">
			<div style="font-size:23px; text-align:center; font-family:verdana;" class="section_title">'.$section['section_name'];
			$formfile = substr($section['print_function'], 6);
			if($formfile=="single_value"){
				$thisout .= '
				<div class="section_title_edit">
					<a class="fancybox fancybox.ajax" href="Ajax/'.$formfile.'.php?rid='.$resume_id.'&id='.$section['sectionid'].'" title="Edit Section">Edit</a>
					 &nbsp; |  &nbsp; 
					<a class="fancybox fancybox.ajax" href="Ajax/section_delete.php?rid='.$resume_id.'&id='.$section['sectionid'].'" title="Remove Section">Remove</a>
					 &nbsp; |  &nbsp; 
					<a class="fancybox fancybox.ajax" href="Ajax/reorder_section.php?id='.$resume_id.'" title="Move Section">Move</a>
				</div>';				
			}elseif($formfile=="highlight" or $formfile=="executive_summary"){
				$thisout .= '
				<div class="section_title_edit">
					<a class="fancybox fancybox.ajax" href="Ajax/'.$formfile.'.php?rid='.$resume_id.'" title="Edit Section">Edit</a>
					 &nbsp; |  &nbsp; 
					<a class="fancybox fancybox.ajax" href="Ajax/section_delete.php?rid='.$resume_id.'&id='.$section['sectionid'].'" title="Remove Section">Remove</a>
					 &nbsp; |  &nbsp; 
					<a class="fancybox fancybox.ajax" href="Ajax/reorder_section.php?id='.$resume_id.'" title="Move Section">Move</a>
				</div>';
			}else{
				$thisout .= '
				<div class="section_title_edit">
					<a class="fancybox fancybox.ajax" href="Ajax/'.$formfile.'.php?rid='.$resume_id.'" title="Add New">Add New</a>
					 &nbsp; |  &nbsp; 
					<a class="fancybox fancybox.ajax" href="Ajax/section_delete.php?rid='.$resume_id.'&id='.$section['sectionid'].'" title="Remove">Remove</a>
					 &nbsp; |  &nbsp; 
					<a class="fancybox fancybox.ajax" href="Ajax/reorder_section.php?id='.$resume_id.'" title="Move Section">Move</a>
				</div>';
			}
			$thisout .= '</div>';
			if($res_sec['submitted']==0){
				$thisout .= '<div class="empty_text" style="overflow:hidden">'.$section['empty_text'].'</div>';
			}else{
				if($section['print_function']=="print_single_value"){
					$thisout .= $this->$section['print_function']($resume_id, $section['sectionid']);
				}else{
					$thisout .= $this->$section['print_function']($resume_id);
				}
			}
			$thisout .= '</div>';
		}
		return $thisout;
	}
	
	function print_single_value($resume_id, $section_id){
		$field = 'section_'.$section_id;	
		
		$sql = "SELECT $field FROM resume_other_section where resume_id='$resume_id'";
		$row = $this->query_first($sql);
		return '<div>'.$row[$field].'</div>';
	}
	function print_education($resume_id){
		$edu_value=$this->load_resume_educations($resume_id);
		$thisout = '';
		$address = '';
		$degree = '';
		foreach($edu_value as $edu){
			if($edu['city']!="")
				$address .= $edu['city'];
			if($edu['city']!="" and $edu['state']!="")
				$address .= ', ';
			if($edu['state']!="")
				$address .= $edu['state'];
			if(($edu['city']!="" or $edu['state']!="") and $edu['country']!="")
				$address .= ', ';
			if($edu['country']!="")
				$address .= $edu['country'];
			if($edu['field_of_study']!="")
				$degree .=$edu['field_of_study'];
			if($edu['field_of_study']!="" and $edu['degree']!="")
				$degree .=' : ';
			if($edu['degree']!="")
				$degree .=$edu['degree'];
			$thisout .= '			
		<div style=" overflow:hidden; margin-bottom:10px;margin-top:10px;" class="highlights">
			<div class="highlights_edit">
			<a class="fancybox fancybox.ajax" href="Ajax/editeducation.php?id='.$edu['education_id'].'" title="Edit Section">Edit</a>
			 &nbsp; |  &nbsp; 
			<a class="fancybox fancybox.ajax" href="Ajax/deleducation.php?id='.$edu['education_id'].'" title="Delete Section">Delete</a>
			</div>
			<table style="width:100%">
					<tr>
						<td style="vertical-align:top; width:70%">
							<div><b>'.$degree.'</b> '.$edu['school'].'</div>
							<div><b>'.$address.'</b></div>
						</td>
						<td style="vertical-align:top; width:30%; text-align:right;">
							<div>'.$edu['grade_year'].'</div>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="vertical-align:top; width:97%">'.$edu['desc'].'</td>
					</tr>
				</table>
		</div>';
		}
		return $thisout;
	}
	function print_highlight($resume_id){
		$high=$this->load_resume_highlight($resume_id);
		if($high['highlight1']==""){
			$high['highlight1'] = '&nbsp;';
		}
		if($high['highlight2']==""){
			$high['highlight2'] = '&nbsp;';
		}
		$thisout = '
		<div style="overflow:hidden;margin-top:10px;" class="highlights">
		 	<table style="width:98%;">
				<tr>
					<td style="vertical-align:top; width:50%">'.$high['highlight1'].'</td>
					<td style="vertical-align:top; width:50%">'.$high['highlight2'].'</td>
				</tr>
			</table>		   
	    </div>';
		
		return $thisout;
	}
	function print_experience($resume_id){
		$exp_value=$this->load_resume_experiences($resume_id);	 	 	
		$thisout = '';
		foreach($exp_value as $exp) {
			$date_between = '';
			$address = '';
			if($exp['city']!="")
				$address .= $exp['city'];
			if($exp['city']!="" and $exp['state']!="")
				$address .= ', ';
			if($exp['state']!="")
				$address .= $exp['state'];
			
			if($exp['date_from']!="")
				$date_between = $exp['date_from'];
			if($exp['date_from']!="" and $exp['date_to']!="")
				$date_between .= ' to ';
			if($exp['date_to']!="")
				$date_between .= $exp['date_to'];		
			$thisout .= '
			<div style=" overflow:hidden;margin-top:10px;" class="highlights">
				<div class="highlights_edit">
				<a class="fancybox fancybox.ajax" href="Ajax/editexperience.php?id='.$exp['experience_id'].'" title="Edit Section">Edit</a>
				 &nbsp; |  &nbsp; 
				<a class="fancybox fancybox.ajax" href="Ajax/delexperience.php?id='.$exp['experience_id'].'" title="Delete Section">Delete</a>
				</div>
				<table style="width:100%">
					<tr>
						<td style="vertical-align:top; width:70%">
							<div><b>'.$exp['position'].'</b></div>
							<div>'.$exp['company_name'].'</div>
						</td>
						<td style="vertical-align:top; width:30%; text-align:right">
						<div><b>'.$date_between.'</b></div>
						<div>'.$address.'</div>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="vertical-align:top; width:97%">'.$exp['desc'].'</td>
					</tr>
				</table>
			</div>
			';
		}
		return $thisout;
	}
	function print_executive_summary($resume_id){
		$exsum=$this->load_resume_exeutive_summary($resume_id);
		if($exsum['expert1']=="")
			$exsum['expert1'] = '&nbsp;';
		if($exsum['expert2']=="")
			$exsum['expert2'] = '&nbsp;';
		$thisout = '
		<div style="overflow:hidden;margin-top:10px;" class="highlights">
		   <table style="width:100%">
		   		<tr>
					<td colspan="2">'.$exsum['main_summary'].'</td>
				</tr>
				<tr>
					<td style="width:50%; vertical-align:top;">'.$exsum['expert1'].'</td>
					<td style="width:50%; vertical-align:top;">'.$exsum['expert2'].'</td>
				</tr>
		   </table>
	    </div>';
		return $thisout;
	}
	function print_work_history($resume_id){
		$work_value=$this->load_resume_workhistory($resume_id);	 	 	
		$thisout = '';
		foreach($work_value as $work) {
			$address = '';
			$date_between = '';
			if($work['city']!="")
				$address .= $work['city'];
			if($work['city']!="" and $work['state']!="")
				$address .= ', ';
			if($work['state']!="")
				$address .= $work['state'];	
				
			if($work['date_from']!="")
				$date_between = $work['date_from'];
			if($work['date_from']!="" and $work['date_to']!="")
				$date_between .= ' to ';
			if($work['date_to']!="")
				$date_between .= $work['date_to'];	
			$thisout .= '
			<div style=" overflow:hidden;margin-top:10px;" class="highlights">
				<div class="highlights_edit">
				<a class="fancybox fancybox.ajax" href="Ajax/editwork_history.php?id='.$work['work_his_id'].'" title="Edit Section">Edit</a>
				 &nbsp; |  &nbsp; 
				<a class="fancybox fancybox.ajax" href="Ajax/delwork_history.php?id='.$work['work_his_id'].'" title="Delete Section">Delete</a>
				</div>
				<table style="width:100%">
				<tr>
					<td style="width:60%; vertical-align:top;">
						<div><b>'.$work['position'].'</b></div>
						<div>'.$work['company_name'].'</div>
					</td>
					<td style="width:40%; vertical-align:top; text-align:right;">
						<div><b>'.$date_between.'</b></div>
						<div>'.$address.'</div>
					</td>
				</tr>
				</table>
			</div>
			';
		}
		return $thisout;
	}
	function print_executive_exp($resume_id){
		$exe_exps=$this->load_resume_executive_exp($resume_id);	 	 	
		$thisout = '';
		foreach($exe_exps as $exp) {
			$date_between = '';
			
			if($exp['date_from']!="")
				$date_between = $exp['date_from'];
			if($exp['date_from']!="" and $exp['date_to']!="")
				$date_between .= ' to ';
			if($exp['date_to']!="")
				$date_between .= $exp['date_to'];
			$thisout .= '
		<div style=" overflow:hidden;margin-top:10px;" class="highlights">
				<div class="highlights_edit">
				<a class="fancybox fancybox.ajax" href="Ajax/edit_executive_exp.php?id='.$exp['executive_exp_id'].'" title="Edit Section">Edit</a>
				 &nbsp; |  &nbsp; 
				<a class="fancybox fancybox.ajax" href="Ajax/del_executive_exp.php?id='.$exp['executive_exp_id'].'" title="Delete Section">Delete</a>
				</div>
				<table style="width:100%">
				<tr>
					<td style="width:60%; vertical-align:top; font-weight:bold;">'.$exp['company_name'].'</td>
					<td style="width:40%; vertical-align:top; text-align:right;">'.$exp['city'].'</td>
				</tr>
				<tr>
					<td colspan="2" style="font-style:italic;">'.$exp['company_desc'].'</td>
				</tr>
				<tr>
					<td style="width:60%; vertical-align:top; font-weight:bold;">'.$exp['position'].'</td>
					<td style="width:40%; vertical-align:top; text-align:right;">'.$date_between.'</td>
				</tr>
				<tr>
					<td colspan="2">'.$exp['desc'].'</td>
				</tr>
			</table>
	    </div>
			';
		}
		return $thisout;
	}
	function print_technical_skills($resume_id){
		$skills=$this->load_resume_technical_skills($resume_id);	 	 	
		$thisout = '';
		if(count($skills)>0){
			$thisout = '
			<table style="width:97%;">
			   <tr>
			   <td style="text-decoration:underline; width:20%;">Skills</td>
			   <td style="text-decoration:underline;">Experience</td>
			   <td style="text-decoration:underline;" >Total Years</td>
			   <td style="text-decoration:underline;" >Last Used</td>
			   </tr></table>';
			foreach($skills as $skill) {		
				$thisout .= '<div style="width:100%;" class="t_skills">
				<div class="t_skills_edit">
				<a class="fancybox fancybox.ajax" title="Edit Section" href="Ajax/edit_technical_skills.php?id='.$skill['technical_skill'].'">Edit</a>
				 &nbsp; |  &nbsp; <a class="fancybox fancybox.ajax" title="Delete Section" href="Ajax/del_technical_skills.php?id='.$skill['technical_skill'].'">Delete</a>&nbsp;&nbsp;
				</div>
				<table style="width:97%;">
				<tr class="t_skills">
		   		<td style=" overflow:hidden; width:20%;">'.$skill['skills'].'</td>
		   		<td style=" overflow:hidden; width:29%;">'.$skill['expertise'].'</td>
		   		<td style=" overflow:hidden; width:28%;">'.$skill['total_year'].'</td>
		   		<td style=" overflow:hidden; width:25%;">'.$skill['last_used'].'</td>
		   		</tr></table></div>
				';
			}
			
		}
		return $thisout;
	}
	
	//function for view resume
	function viewresume($resume_id){
		$output = '<div id="space_saver">';
		$output .= $this->viewname($resume_id);
		$output .= $this->viewaddress($resume_id);
		$output .= $this->view_all_sections($resume_id);
		$output .= '</div>';
		return $output;
	}
	
	function viewname($resume_id){
		$res = $this->load_single_resume($resume_id);		
		$out = '<div style="text-align:left; font-size:35px; font-family:verdana;" class="name">
           '.$res['first_name'].' '.$res['last_name'];
		$out .= '</div>';
		return $out;
	}
	
	function viewaddress($resume_id){
		$res = $this->load_single_resume($resume_id);
				$addr = '';
		//street
		if($res['street']!=""){
			$addr .= $res['street'];	
		}
		if($res['street']!="" and $res['city']!="" or $res['state']!="" or $res['zip']!=""){
			$addr .=', ';
		}
		//city
		if($res['city']!=""){
			$addr .= $res['city'].' ';	
		}
		//state
		if($res['state']!=""){
			$addr .= $res['state'].' ';	
		}
		//Zip
		if($res['zip']!=""){
			$addr .= ' '.$res['zip'];
		}
		if($addr!=""){
			$addr .=' | ';
		}
		//Phone NUmber
		if($res['phone_num']!=""){
			$addr .= ' Home: '.$res['phone_num'];	
		}
		//Cell number
		if($res['cell_num']!=""){
			$addr .= ' Cell: '.$res['cell_num'];	
		}
		if($res['email']!="" and $res['phone_num']!="" or $res['cell_num']!=""){
			$addr .=' | ';
		}
		//email
		if($res['email']!=""){
			$addr .= ' '.$res['email'];
		}
		if($res['street']=="" and $res['city']=="" and $res['state']=="" and $res['zip']=="" and $res['phone_num']=="" and $res['cell_num']==""){
			$addr = 'Street Address, City State Zip | Home: Phone Number Cell: Cell Phone Number | Email address';
		}
		$out = '<div style="text-align:left;  font-size:15px; font-family:verdana; padding:10px;" class="address"> 
           '.$addr;
		$out .= '</div>';
		return $out;
	}
	
	function view_all_sections($resume_id){
		$res_secs = $this->load_resume_sections($resume_id);
		$thisout = '';
		foreach($res_secs as $res_sec) {
			$section = $this->load_single_section($res_sec['section_id']);
			$thisout .= '
			<div class="section_block" style="margin-top:10px;">
			<div style="font-size:23px; text-align:center; font-family:verdana;" class="section_title">'.$section['section_name'];
			$thisout .= '</div>';
			$viewfun = str_replace("print", "view", $section['print_function']);		
			if($res_sec['submitted']==0){
				$thisout .= '<div class="empty_text" style="overflow:hidden">'.$section['empty_text'].'</div>';
			}else{
				if($section['print_function']=="print_single_value"){
					$thisout .= $this->$viewfun($resume_id, $section['sectionid']);
				}else{
					$thisout .= $this->$viewfun($resume_id);
				}
			}
			$thisout .= '</div>';
		}
		return $thisout;
	}
	
	function view_single_value($resume_id, $section_id){
		$field = 'section_'.$section_id;	
		
		$sql = "SELECT $field FROM resume_other_section where resume_id='$resume_id'";
		$row = $this->query_first($sql);
		return '<div>'.$row[$field].'</div>';
	}
	function view_education($resume_id){
		$edu_value=$this->load_resume_educations($resume_id);
		$thisout = '';
		$address = '';
		$degree = '';
		foreach($edu_value as $edu){
			if($edu['city']!="")
				$address .= $edu['city'];
			if($edu['city']!="" and $edu['state']!="")
				$address .= ', ';
			if($edu['state']!="")
				$address .= $edu['state'];
			if(($edu['city']!="" or $edu['state']!="") and $edu['country']!="")
				$address .= ', ';
			if($edu['country']!="")
				$address .= $edu['country'];
			if($edu['field_of_study']!="")
				$degree .=$edu['field_of_study'];
			if($edu['field_of_study']!="" and $edu['degree']!="")
				$degree .=' : ';
			if($edu['degree']!="")
				$degree .=$edu['degree'];
			$thisout .= '			
		<div style=" overflow:hidden; margin-bottom:10px;" class="highlights">
			<table style="width:100%">
					<tr>
						<td style="vertical-align:top; width:70%">
							<div><b>'.$degree.'</b> '.$edu['school'].'</div>
							<div><b>'.$address.'</b></div>
						</td>
						<td style="vertical-align:top; width:30%; text-align:right">
							<div>'.$edu['grade_year'].'</div>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="vertical-align:top; width:97%">'.$edu['desc'].'</td>
					</tr>
				</table>
		</div>';
		}
		return $thisout;
	}
	function view_highlight($resume_id){
		$high=$this->load_resume_highlight($resume_id);
		if($high['highlight1']==""){
			$high['highlight1'] = '&nbsp;';
		}
		if($high['highlight2']==""){
			$high['highlight2'] = '&nbsp;';
		}
		$thisout = '
		<div style="overflow:hidden;" class="highlights">
		 	<table style="width:98%;">
				<tr>
					<td style="vertical-align:top; width:50%">'.$high['highlight1'].'</td>
					<td style="vertical-align:top; width:50%">'.$high['highlight2'].'</td>
				</tr>
			</table>		   
	    </div>';
		return $thisout;
	}
	function view_experience($resume_id){
		$exp_value=$this->load_resume_experiences($resume_id);	 	 	
		$thisout = '';
		foreach($exp_value as $exp) {
			$date_between = '';
			$address = '';
			if($exp['city']!="")
				$address .= $exp['city'];
			if($exp['city']!="" and $exp['state']!="")
				$address .= ', ';
			if($exp['state']!="")
				$address .= $exp['state'];
			
			if($exp['date_from']!="")
				$date_between = $exp['date_from'];
			if($exp['date_from']!="" and $exp['date_to']!="")
				$date_between .= ' to ';
			if($exp['date_to']!="")
				$date_between .= $exp['date_to'];		
			$thisout .= '
			<div style=" overflow:hidden;margin-top:10px;" class="highlights">
				<table style="width:100%">
					<tr>
						<td style="vertical-align:top; width:70%">
							<div><b>'.$exp['position'].'</b></div>
							<div>'.$exp['company_name'].'</div>
						</td>
						<td style="vertical-align:top; width:30%; text-align:right">
						<div><b>'.$date_between.'</b></div>
						<div>'.$address.'</div>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="vertical-align:top; width:97%">'.$exp['desc'].'</td>
					</tr>
				</table>
			</div>
			';
		}
		return $thisout;
	}
	function view_executive_summary($resume_id){
		$exsum=$this->load_resume_exeutive_summary($resume_id);
		if($exsum['expert1']=="")
			$exsum['expert1'] = '&nbsp;';
		if($exsum['expert2']=="")
			$exsum['expert2'] = '&nbsp;';
		$thisout = '
		<div style="overflow:hidden;margin-top:10px;" class="highlights">
		   <table style="width:100%">
		   		<tr>
					<td colspan="2">'.$exsum['main_summary'].'</td>
				</tr>
				<tr>
					<td style="width:50%; vertical-align:top;">'.$exsum['expert1'].'</td>
					<td style="width:50%; vertical-align:top;">'.$exsum['expert2'].'</td>
				</tr>
		   </table>
	    </div>';
		return $thisout;
	}
	function view_work_history($resume_id){
		$work_value=$this->load_resume_workhistory($resume_id);	 	 	
		$thisout = '';
		foreach($work_value as $work) {
			$address = '';
			$date_between = '';
			if($work['city']!="")
				$address .= $work['city'];
			if($work['city']!="" and $work['state']!="")
				$address .= ', ';
			if($work['state']!="")
				$address .= $work['state'];	
				
			if($work['date_from']!="")
				$date_between = $work['date_from'];
			if($work['date_from']!="" and $work['date_to']!="")
				$date_between .= ' to ';
			if($work['date_to']!="")
				$date_between .= $work['date_to'];	
			$thisout .= '
			<div style=" overflow:hidden;margin-top:10px;" class="highlights">
				<table style="width:100%">
				<tr>
					<td style="width:60%; vertical-align:top;">
						<div><b>'.$work['position'].'</b></div>
						<div>'.$work['company_name'].'</div>
					</td>
					<td style="width:40%; vertical-align:top; text-align:right;">
						<div><b>'.$date_between.'</b></div>
						<div>'.$address.'</div>
					</td>
				</tr>
				</table>
			</div>
			';
		}
		return $thisout;
	}
	function view_executive_exp($resume_id){
		$exe_exps=$this->load_resume_executive_exp($resume_id);	 	 	
		$thisout = '';
		foreach($exe_exps as $exp) {
			$date_between = '';
			
			if($exp['date_from']!="")
				$date_between = $exp['date_from'];
			if($exp['date_from']!="" and $exp['date_to']!="")
				$date_between .= ' to ';
			if($exp['date_to']!="")
				$date_between .= $exp['date_to'];
			$thisout .= '
		<div style=" overflow:hidden;margin-top:10px;" class="highlights">
				<table style="width:100%">
				<tr>
					<td style="width:60%; vertical-align:top; font-weight:bold;">'.$exp['company_name'].'</td>
					<td style="width:40%; vertical-align:top; text-align:right;">'.$exp['city'].'</td>
				</tr>
				<tr>
					<td colspan="2" style="font-style:italic;">'.$exp['company_desc'].'</td>
				</tr>
				<tr>
					<td style="width:60%; vertical-align:top; font-weight:bold;">'.$exp['position'].'</td>
					<td style="width:40%; vertical-align:top; text-align:right;">'.$date_between.'</td>
				</tr>
				<tr>
					<td colspan="2">'.$exp['desc'].'</td>
				</tr>
			</table>
	    </div>
			';
		}
		return $thisout;
	}
	function view_technical_skills($resume_id){
		$skills=$this->load_resume_technical_skills($resume_id);	 	 	
		$thisout = '';
		if(count($skills)>0){
			$thisout = '
			<table style="width:100%;margin-top:10px;">
			   <tr>
			   <td style="text-decoration:underline;">Skills</td>
			   <td style="text-decoration:underline;">Experience</td>
			   <td style="text-decoration:underline;" >Total Years</td>
			   <td style="text-decoration:underline;" >Last Used</td>
			   </tr>';
			foreach($skills as $skill) {		
				$thisout .= '
				<tr class="highlights">
		   		<td>'.$skill['skills'].'</td>
		   		<td>'.$skill['expertise'].'</td>
		   		<td>'.$skill['total_year'].'</td>
		   		<td>'.$skill['last_used'].'
				</td>
		   		</tr>
				';
			}
			$thisout .= '
			</table>
			';
		}
		return $thisout;
	}
	
}
?>