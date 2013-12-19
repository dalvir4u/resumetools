<?php
session_start();
//database server
define('DB_SERVER', "localhost");
//database login name
define('DB_USER', "root");
//database login password
define('DB_PASS', "");
//database name
define('DB_DATABASE', "job_shep");

// setting up the web root and server root for
// this shopping cart application
$thisFile = str_replace('\\', '/', __FILE__);

$webRoot  = 'http://localhost/resume';
define('WEB_ROOT', $webRoot);
?>