<?php
####################################################################
#	File Name	:	admin_login_header.php
#	Location	:	/webroot/templates/
####################################################################

//ob_start();
session_start();
//error_reporting(E_ALL);
//ini_set("dispay_errors", "on");

require ("configs/config.general.settings.php");
require ("configs/config.url.settings.php");
//require ("../classes/class.general_utils.php");
require ("configs/config.dbase.settings.php");

require ("classes/class.log.php");
require ("classes/class.main.php");
//require ("../classes/class.smtp.php"); # SMTP
//require ("../classes/class.phpmailer.php"); # PHP MAILER
//require ("../classes/class.mail.templates.php"); # MAIL TEMPLATES



$dbObj  		=	new cdBConnect;
$connect		=	$dbObj->connectDB();
$logObj = new logClass();



$now=time();


<<<<<<< HEAD
// if(isset($_SESSION['FMS'])) {
//     $logObj->printLog($_SESSION['FMS']['USER_ID']);	
// 	header("Location: admin_home.php");
	
// }
=======
if(isset($_SESSION['FMS'])) {
    $logObj->printLog($_SESSION['FMS']['USER_ID']);	
	header("Location: admin_home.php");
	
}
>>>>>>> 35415fc59dcbc37f70fa51090118fd6248b3102d

?>


<!DOCTYPE html>

<head>
     <meta charset="utf-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
     <meta name="description" content="Bless Admin Control Panel" />
     <meta name="author" content="Brian Cai" />
     <title>FMS Admin</title>
     <!-- BOOTSTRAP CORE STYLE  -->


     <link rel="stylesheet" href="assets/css/bootstrap.css" type="text/css" />
     <link href="assets/css/admin_login.css" rel="stylesheet"/>


</head>
<body>
<!-- HEADER END-->	