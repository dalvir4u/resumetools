<?php
date_default_timezone_set('Asia/Kolkata');
class commonClass extends Database
{
	protected $self = array();
	
	public function __get( /*string*/ $name = null ) 
	{
		return $this->self[$name];
	}
	function insert_syslog($order, $product, $customer, $msg){
		$sys['order_id'] = $order;
		$sys['product_id'] = $product;
		$sys['customer_id'] = $customer;
		$sys['message'] = $msg;
		$sys['created'] = time();
		$this->query_insert('syslog', $sys);
	}
	function currencyformat($number){
		setlocale(LC_MONETARY, 'en_US');
		return money_format('%n', $number);	
	}
	function setmessage($type="status", $message = NULL)
	{
		if ($message) {
			if (!isset($_SESSION['messages'][$type])) {
			  $_SESSION['messages'][$type] = array();
			}		
			if (!in_array($message, $_SESSION['messages'][$type])) {
			  $_SESSION['messages'][$type][] = $message;
			}
		}		
		// Messages not set when DB connection fails.
		return isset($_SESSION['messages']) ? $_SESSION['messages'] : NULL;
	}
	function getmessage($type = NULL, $clear_queue = TRUE)
	{
		if ($messages = $this->setmessage()) {
			if ($type) {
				if ($clear_queue) {
					unset($_SESSION['messages'][$type]);
			  	}
			  	if (isset($messages[$type])) {
					return array($type => $messages[$type]);
			  	}
			}
			else {
				if ($clear_queue) {
					unset($_SESSION['messages']);
				}
			  	return $messages;
			}
		}
		return array();
	}
	function theme_messages() {
	  $output = '';
	
	  $status_heading = array(
		'status' => 'alert-success', 
		'error' => 'alert-error', 
		'warning' => 'alert-block',
	  );
	  foreach ($this->getmessage() as $type => $messages) {
		$output .= "<div class=\"alert $status_heading[$type]\">\n
		";
		if (count($messages) > 1) {
		  $output .= " <ul>\n";
		  foreach ($messages as $message) {
			$output .= '  <li>' . $message . "</li>\n";
		  }
		  $output .= " </ul>\n";
		}
		else {
		  $output .= $messages[0];
		}
		$output .= "</div>\n";
	  }
	  return $output;
	}
	function adminlogin($username,$pwd)
	{
		//$pwd = md5($pwd);
		$sql = "SELECT * FROM `admin` WHERE `adminuser`='$username' and `adminpass`='$pwd' LIMIT 1";
		$row = $this->query_first($sql);
		if(isset($row['id']) and $row['id']>0)
		{
			$_SESSION['utype'] = 'admin';
			$_SESSION['aid'] = $row['id'];
			$_SESSION['webadmin']="job-shep admin";
			return true;
		}else{
			return false;
		}
	}
	function is_adminlogin()
	{
		if(isset($_SESSION['utype']) && isset($_SESSION['webadmin']) && $_SESSION['webadmin']=="job-shep admin")
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function login($username,$pwd)
	{
		$pwd = md5($pwd);
		$sql = "SELECT * FROM `users` WHERE `email`='$username' and `password`='$pwd' and `status`='1' LIMIT 1";
		$row = $this->query_first($sql);
		if(isset($row['user_id']) and $row['user_id']>0)
		{
			$_SESSION['user_type'] = 'user';
			$_SESSION['user_id'] = $row['user_id'];
			$_SESSION['weblogin']="job-shep";
			return true;
		}else{
			return false;
		}
	}
	function is_login()
	{
		if(isset($_SESSION['user_type']) && isset($_SESSION['weblogin']) && $_SESSION['weblogin']=="job-shep")
		{
			return true;
		}
		else
		{
			return false;
		}
	}	
	function is_userExists($username)
	{
		$sql = "SELECT count(*) as total FROM `users` WHERE `username`='$username'";
		$row = $this->query_first($sql);
		if($row['total']>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function is_emailExists($email)
	{
		if($this->is_login()){			
			$sql = "SELECT count(*) as total FROM `users` WHERE `email`='$email' and `user_id`!='".$_SESSION['user_id']."'";
		}else{
			$sql = "SELECT count(*) as total FROM `users` WHERE `email`='$email'";
		}
		$row = $this->query_first($sql);
		if($row['total']>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function is_emailExists_admin($email, $uid)
	{
		$sql = "SELECT count(*) as total FROM `users` WHERE `email`='$email' and `user_id`!='".$uid."'";
		
		$row = $this->query_first($sql);
		if($row['total']>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function generate_password($length = 8){
	  	$chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.
				'0123456789``-=~!@#$%^&*()_+,./<>?;:[]{}\|';
	
	  	$str = '';
	  	$max = strlen($chars) - 1;
	
	  	for ($i=0; $i < $length; $i++)
			$str .= $chars[rand(0, $max)];
	
	  	return $str;
	}
	function generate_resetpath($length = 20, $sent_id){
	  	$chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.
				'0123456789!()_[]{}|';
	
	  	$str = '';
	  	$max = strlen($chars) - 1;
	
	  	for ($i=0; $i < $length; $i++)
			$str .= $chars[rand(0, $max)];
		$str .= 'path'.$sent_id;
	  	$max = strlen($chars) - 1;
	
	  	for ($i=0; $i < $length; $i++)
			$str .= $chars[rand(0, $max)];
		$check_path = $this->query_first("SELECT * FROM `users` WHERE resetpath='$str'");
		if(isset($check_path['user_id']) and $check_path['user_id']>0)
			$this->generate_resetpath(20, $sent_id);
	
	  	return $str;
	}
	function send_email($to, $subject, $msg)
	{
		// To send HTML mail, the Content-type header must be set
		$from = 'Support <dalvir4u@gmail.com>';
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		// Additional headers
		$headers .= 'To: '. $to . "\r\n";
		$headers .= 'From: ' . $from . "\r\n";
		
		// Mail it
		return mail($to, $subject, $msg, $headers);		
	}

	function getPagingQuery($sql, $itemPerPage = 10)
	{
		if (isset($_GET['page']) && (int)$_GET['page'] > 0) {
		$page = (int)$_GET['page'];
		} else {
		$page = 1;
		}
	
		// start fetching from this row number
		$offset = ($page - 1) * $itemPerPage;
		
		return $sql . " LIMIT $offset, $itemPerPage";
	}
	function getPagingLink($sql, $itemPerPage = 10, $strGet = '')
	{
		$result = mysql_query($sql);
		$pagingLink = '';
		$totalResults = mysql_num_rows($result);
		$totalPages = ceil($totalResults / $itemPerPage);
		
		// how many link pages to show
		$numLinks = 10;
		
		
		// create the paging links only if we have more than one page of results
		if ($totalPages > 1) {
		
		$self = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] ;
		$self = 'main.php';
		
		if (isset($_GET['page']) && (int)$_GET['page'] > 0) {
		$pageNumber = (int)$_GET['page'];
		} else {
		$pageNumber = 1;
		}
		
		// print 'previous' link only if we're not
		// on page one
		if ($pageNumber > 1) {
		$page = $pageNumber - 1;
		if ($page > 1) {
		$prev = " <a href=\"$self?page=$page&$strGet\">Prev</a> ";
		} else {
		$prev = " <a href=\"$self?page=$page&$strGet\">Prev</a> ";
		}
		
		$first = " <a href=\"$self?page=$page&$strGet\">First</a> ";
		} else {
		$prev = ''; // we're on page one, don't show 'previous' link
		$first = ''; // nor 'first page' link
		}
		
		// print 'next' link only if we're not
		// on the last page
		if ($pageNumber < $totalPages) {
		$page = $pageNumber + 1;
		$next = " <a href=\"$self?page=$page&$strGet\">Next</a> ";
		$last = " <a href=\"$self?page=$page&$strGet\">Last</a> ";
		} else {
		$next = ''; // we're on the last page, don't show 'next' link
		$last = ''; // nor 'last page' link
		}
		
		$start = $pageNumber - ($pageNumber % $numLinks) + 1;
		$end = $start + $numLinks - 1;
		
		$end = min($totalPages, $end);
		
		$pagingLink = array();
		for($page = $start; $page <= $end; $page++) {
		if ($page == $pageNumber) {
		$pagingLink[] = " <span class=\"current\">$page</span> "; // no need to create a link to current page
		} else {
		if ($page == 1) {
		$pagingLink[] = " <a href=\"$self?page=$page&$strGet\">$page</a> ";
		} else {
		$pagingLink[] = " <a href=\"$self?page=$page&$strGet\">$page</a> ";
		}
		}
		
		}
		
		$pagingLink = implode(' ', $pagingLink);
		
		// return the page navigation link
		$pagingLink = $first . $prev . $pagingLink . $next . $last;
		}
		
		return $pagingLink;
	}
	
//function for images uploading,resizing,cropping
	function resize_crop_image($filein,$fileout,$imagethumbsize_w,$imagethumbsize_h)
	{
		// Get new dimensions"255","255","255"
		$red="255";
		$green="255";
		$blue="255";
		$percent = 1;	
		list($width, $height) = getimagesize($filein);
		$new_width = $width * $percent;
		$new_height = $height * $percent;
		if(preg_match("/.jpg/i", "$filein"))
  		{
  		    $format = 'image/jpeg';
  		}
  		if (preg_match("/.gif/i", "$filein"))
  		{
  		    $format = 'image/gif';
  		}
  		if(preg_match("/.png/i", "$filein"))
  		{
  		    $format = 'image/png';
  		}
 
	      	switch($format)
      		{
      		    case 'image/jpeg':
      		    	$image = imagecreatefromjpeg($filein);
      		    	break;
      		    case 'image/gif';
      		    	$image = imagecreatefromgif($filein);
      		    	break;
      		    case 'image/png':
      		    	$image = imagecreatefrompng($filein);
      		    	break;
      		}
		$width = $imagethumbsize_w ;
		$height = $imagethumbsize_h ;
		list($width_orig, $height_orig) = getimagesize($filein);
		if ($width_orig < $height_orig) {
 			$height = ($imagethumbsize_w / $width_orig) * $height_orig;
		} else {
   			$width = ($imagethumbsize_h / $height_orig) * $width_orig;
		}
		if ($width < $imagethumbsize_w)
		{
				//if the width is smaller than supplied thumbnail size
    			$width = $imagethumbsize_w;
    			$height = ($imagethumbsize_w/ $width_orig) * $height_orig;;
		}
		if ($height < $imagethumbsize_h)		
		{
				//if the height is smaller than supplied thumbnail size
    			$height = $imagethumbsize_h;
    			$width = ($imagethumbsize_h / $height_orig) * $width_orig;
		}
		$thumb = imagecreatetruecolor($width , $height); 
		$bgcolor = imagecolorallocate($thumb, $red, $green, $blue);  
		ImageFilledRectangle($thumb, 0, 0, $width, $height, $bgcolor);

		imagefilledrectangle($thumb, 0, 0, $width, $height, $bgcolor);
		imagealphablending($thumb, true);
		imagecopyresampled($thumb, $image, 0, 0, 0, 0,$width, $height, $width_orig, $height_orig);
		$thumb2 = imagecreatetruecolor($imagethumbsize_w , $imagethumbsize_h);
		// true color for best quality
		$bgcolor = imagecolorallocate($thumb2, $red, $green, $blue);

		ImageFilledRectangle($thumb2, 0, 0,$imagethumbsize_w , $imagethumbsize_h , $bgcolor);
		
		imagefilledrectangle($thumb2, 0, 0,$imagethumbsize_w , $imagethumbsize_h , $bgcolor);
		imagealphablending($thumb2, true);
		$w1 =($width/2) - ($imagethumbsize_w/2);
		$h1 = ($height/2) - ($imagethumbsize_h/2);
		imagecopyresampled($thumb2, $thumb, 0,0, 0, 0,$imagethumbsize_w , $imagethumbsize_h ,$imagethumbsize_w, $imagethumbsize_h);
		// Output
		//header('Content-type: image/gif');
		//imagegif($thumb); //output to browser first image when testing
		//if ($fileout !="")
		
		//imagegif($thumb2, $fileout); //write to file
		//header('Content-type: image/gif');
		//imagegif($thumb2); //output to browser
		//echo '<br>Thumb2 : '.$thumb2.'<br>';
		//chmod($fileout,0777);
		imagejpeg($thumb2,$fileout);

	}
	
	function resize_image($filein,$fileout,$imagethumbsize_w,$imagethumbsize_h)
	{
		// Get new dimensions"255","255","255"
		$red="255";
		$green="255";
		$blue="255";
		if(preg_match("/.jpg/i", "$filein"))
  		{
  		    $format = 'image/jpeg';
  		}
  		if (preg_match("/.gif/i", "$filein"))
  		{
  		    $format = 'image/gif';
  		}
  		if(preg_match("/.png/i", "$filein"))
  		{
  		    $format = 'image/png';
  		}
 
	      	switch($format)
      		{
      		    case 'image/jpeg':
      		    	$image = imagecreatefromjpeg($filein);
      		    	break;
      		    case 'image/gif';
      		    	$image = imagecreatefromgif($filein);
      		    	break;
      		    case 'image/png':
      		    	$image = imagecreatefrompng($filein);
      		    	break;
      		}
		$width = $imagethumbsize_w ;
		$height = $imagethumbsize_h ;
		list($width_orig, $height_orig) = getimagesize($filein);
		if ($width_orig < $height_orig) {
 			$height = ($imagethumbsize_w / $width_orig) * $height_orig;
		} else {
   			$width = ($imagethumbsize_h / $height_orig) * $width_orig;
		}
		if ($width < $imagethumbsize_w)
		//if the width is smaller than supplied thumbnail size
		{
    			$width = $imagethumbsize_w;
    			$height = ($imagethumbsize_w/ $width_orig) * $height_orig;;
		}
		if ($height < $imagethumbsize_h)
		//if the height is smaller than supplied thumbnail size
		{
    			$height = $imagethumbsize_h;
    			$width = ($imagethumbsize_h / $height_orig) * $width_orig;
		}
		$thumb2 = imagecreatetruecolor($width , $height);
		imagecopyresampled($thumb2, $image, 0 ,0, 0, 0, $width, $height , $width_orig, $height_orig);
		// Output
		//header('Content-type: image/gif');
		//imagegif($thumb); //output to browser first image when testing
		//if ($fileout !="")
		
		//imagegif($thumb2, $fileout); //write to file
		//header('Content-type: image/gif');
		//imagegif($thumb2); //output to browser
		//echo '<br>Thumb2 : '.$thumb2.'<br>';
		//chmod($fileout,0777);
		imagejpeg($thumb2,$fileout);

	}
	
	function uploadimage($photos_uploaded, $dest_path, $resize='yes', $width, $height)
	{
		// List of our known photo types
    		$known_photo_types = array(
                        		'image/pjpeg' => 'jpg',
                        		'image/jpeg' => 'jpg',
                        		'image/gif' => 'gif',
                        		'image/bmp' => 'bmp',
                        		'image/x-png' => 'png',
								'image/png' => 'png'
                    	);
   
    		// GD Function List
    		$gd_function_suffix = array(
                        		'image/pjpeg' => 'JPEG',
                        		'image/jpeg' => 'JPEG',
                        		'image/gif' => 'GIF',
                        		'image/bmp' => 'WBMP',
                        		'image/x-png' => 'PNG',
								'image/png' => 'PNG'
                    	);

    		if(!array_key_exists($photos_uploaded['type'], $known_photo_types))
    		{
        			return false;
    		}
    		else
    		{
			move_uploaded_file($photos_uploaded["tmp_name"], $dest_path);
    		if($resize=='crop_resize'){
				$this->resize_crop_image($dest_path,$dest_path,$width,$height);
			}
			if($resize=='resize'){
				$this->resize_image($dest_path,$dest_path,$width,$height);
			}
			return true;
    		}    
	}	
//load all html pages
	function load_admin(){
		$sql = "SELECT * FROM admin where id='1'";
		$row = $this->query_first($sql);
		return $row;	
	}
	function load_all_pages(){
		$sql = "SELECT * FROM pages";
		$row = $this->fetch_all_array($sql);
		return $row;
	}
	function load_single_page($id){
		$sql = "SELECT * FROM pages WHERE page_id='$id'";
		$row = $this->query_first($sql);
		return $row;
	}
	function load_all_users(){
		$sql = "SELECT * FROM users";
		$row = $this->fetch_all_array($sql);
		return $row;
	}
	function load_single_user($id){
		$sql = "SELECT * FROM users WHERE user_id='$id'";
		$row = $this->query_first($sql);
		return $row;
	}
//load current user detail
	function getcurrentuser(){
		$uid = $_SESSION['user_id'];
		$sql = "SELECT * FROM users where user_id='$uid'";
		$row = $this->query_first($sql);
		return $row;
	}
//load all sections	
	function load_sections()
	{
		$sql = "SELECT * FROM sections";
		$row = $this->fetch_all_array($sql);
		return $row;
	}
//load single section detail
	function load_single_section($id)
	{
		$sql = "SELECT * FROM sections where sectionid='$id'";
		$row = $this->query_first($sql);
		return $row;
	}
//load resume credential and all section of particular resume	
	function load_single_resume($resume_id){
		$sql = "SELECT * FROM resume where resume_id='$resume_id'";
		$row = $this->query_first($sql);
		return $row;
	}
	function load_resume_sections($resume_id)
	{
		$sql = "SELECT * FROM resume_sections where resume_id='$resume_id' order by delta asc";
		$row = $this->fetch_all_array($sql);
		return $row;
	}
	function load_sections_except_resume($resume_id)
	{
		$sql = "SELECT * FROM sections where sectionid not in (select section_id from resume_sections where resume_id='$resume_id')";
		$row = $this->fetch_all_array($sql);
		return $row;
	}
//load any section of single value of resume	
	function load_resume_single_value($resume_id, $section_id)
	{
		$field = 'section_'.$section_id;
		$sql = "SELECT $field FROM resume_other_section where resume_id='$resume_id'";
		$row = $this->query_first($sql);
		return $row[$field];
	}
//load all the education detail of resume	
	function load_resume_educations($resume_id)
	{
		$sql = "SELECT * FROM resume_education where resume_id='$resume_id' order by delta asc";
		$row = $this->fetch_all_array($sql);
		return $row;
	}
	function load_single_educations($eduid)
	{
		$sql = "SELECT * FROM resume_education where education_id='$eduid'";
		$row = $this->query_first($sql);
		return $row;
	}
//load all the experience detail of resume	
	function load_resume_experiences($resume_id)
	{
		$sql = "SELECT * FROM resume_experience where resume_id='$resume_id' order by delta asc";
		$row = $this->fetch_all_array($sql);
		return $row;
	}
	function load_single_experience($expid)
	{
		$sql = "SELECT * FROM resume_experience where experience_id='$expid'";
		$row = $this->query_first($sql);
		return $row;
	}
//load executive summary section of resume
	function load_resume_exeutive_summary($resume_id)
	{
		$sql = "SELECT * FROM resume_executive_summary where resume_id='$resume_id'";
		$row = $this->query_first($sql);
		return $row;		
	}
//load highlight section of resume
	function load_resume_highlight($resume_id)
	{
		$sql = "SELECT * FROM resume_highlights where resume_id='$resume_id'";
		$row = $this->query_first($sql);
		return $row;
	}
//load all the experience detail of resume	
	function load_resume_workhistory($resume_id)
	{
		$sql = "SELECT * FROM resume_work_history where resume_id='$resume_id' order by delta asc";
		$row = $this->fetch_all_array($sql);
		return $row;
	}
	function load_single_workhistory($id)
	{
		$sql = "SELECT * FROM resume_work_history where work_his_id='$id'";
		$row = $this->query_first($sql);
		return $row;
	}	
//load all the experience detail of resume	
	function load_resume_executive_exp($resume_id)
	{
		$sql = "SELECT * FROM resume_executive_exp where resume_id='$resume_id' order by delta asc";
		$row = $this->fetch_all_array($sql);
		return $row;
	}
	function load_single_executive_exp($id)
	{
		$sql = "SELECT * FROM resume_executive_exp where executive_exp_id='$id'";
		$row = $this->query_first($sql);
		return $row;
	}
//load all the experience detail of resume	
	function load_resume_technical_skills($resume_id)
	{
		$sql = "SELECT * FROM resume_technical_skills where resume_id='$resume_id' order by delta asc";
		$row = $this->fetch_all_array($sql);
		return $row;
	}
	function load_single_technical_skills($id)
	{
		$sql = "SELECT * FROM resume_technical_skills where technical_skill='$id'";
		$row = $this->query_first($sql);
		return $row;
	}
//load all resumes of user
	function load_users_resume($uid)
	{
		$sql = "SELECT * FROM resume where uid='$uid'";
		$row = $this->fetch_all_array($sql);
		return $row;
	}
	function load_all_states(){
		$sql = "SELECT * FROM states";
		$row = $this->fetch_all_array($sql);
		return $row;
	}
//load all resumes of user
	function update_resume_section_submit($rid, $sid)
	{
		$this->query("UPDATE `resume_sections` SET `submitted`='1' WHERE `resume_id`='$rid' and `section_id`='$sid'");
	}		
}
?>