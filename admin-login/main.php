<?php
include('../config/config.inc.php');
include('../config/Database.class.php');
include('../classes/common.class.php');
include('submit.php');
$co = new commonClass(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
$co->connect();
if(!$co->is_adminlogin()){ header("location:index.php"); }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Job Sheperd Administration</title>
<link rel="stylesheet" type="text/css" href="sty.css" />
<link rel="stylesheet" type="text/css" href="../source/jquery.cleditor.css" />
<?php /*?><style type="text/css" title="currentStyle">
	@import "css/demo_page.css";
	@import "css/demo_table.css";
</style><?php */?>
<script type="text/javascript" src="../lib/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui.js"></script>
<script language="JavaScript" type="text/javascript" src="../js/jquery.cleditor.min.js"></script>
<script language="JavaScript" type="text/javascript" src="js/jquery.dataTables.js"></script>
</head>
<body>
<div class="main">
	<div class="pagearea">
    	<div class="header">
        	<img src="../images/logo.png" alt="logo" height="80" title="logo" />        	   
        </div><!--end of header-->
        <div class="topnav">
            <div id='cssmenu'>
                <ul>
                   <li class="active"><a href="main.php?p=pages/manage"><span>Manage pages</span></a></li>
                   <li class='has-sub'><a href='#'><span>Career Management</span></a>
                      <ul>
                         <li class='has-sub'><a href='main.php?p=career/add'><span>Add Career</span></a></li>
                         <li class='has-sub'><a href='main.php?p=career/manage'><span>Manage Career</span></a></li>
                         <li class='has-sub'><a href='main.php?p=career/subadd'><span>Add Sub Career</span></a></li>
                         <li class='has-sub'><a href='main.php?p=career/submanage'><span>Manage Sub Career</span></a></li>
                      </ul>
                   </li>
                   <li><a href='main.php?p=user/manage'><span>Manage Users</span></a></li>
                   <li><a href="main.php?p=change_pass"><span>Change Password</span></a></li>
                   <li class='last'><a href='logout.php'><span>Logout</span></a></li>
                </ul>
            </div>
        </div><!--end of topnav-->
        <div class="breadcrumb"></div>
        <div class="content">            
            <div style="min-height:420px;">
                <?php                    
                    if(isset($_GET['p'])){
                        $page = $_GET['p'].'.php';
                        if(!file_exists($page)){
                            $page="notfound.php";
                        }
                    }else{
                        $page = 'dashboard.php';
                    }
                    include($page);			
                ?>
            </div>
        </div><!--end of content-->
    </div>
</div>
</body>
</html>
