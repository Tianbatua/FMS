<?php
####################################################################
#	File Name	:	admin_login_header.php
#	Location	:	/webroot/templates/
####################################################################

session_start();

require ("configs/config.general.settings.php");
require ("configs/config.url.settings.php");
require ("configs/config.dbase.settings.php");

require ("classes/class.log.php");
require ("classes/class.main.php");

$dbObj  		=	new cdBConnect;
$connect		=	$dbObj->connectDB();
$logObj = new logClass();

$now=time();



// if(isset($_SESSION['FMS'])) {
//     $logObj->printLog($_SESSION['FMS']['USER_ID']);	
// 	header("Location: admin_home.php");
	
// }


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