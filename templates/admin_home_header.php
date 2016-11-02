<?php
####################################################################
#	File Name	:	restaurant_owner_header.php
#	Location	:	/webroot/restaurant_owner/templates/
####################################################################

session_start();

require ("configs/config.general.settings.php");
require ("configs/config.url.settings.php");
require ("configs/config.dbase.settings.php");

require ("classes/class.main.php");
require ("classes/class.log.php");

$dbObj = new cdBConnect;
$connect = $dbObj->connectDB();
$logObj = new logClass();

$now = time();

// session_unset($_SESSION['FMS']);
if(!isset($_SESSION['FMS']) || $now > $_SESSION['FMS']['DISCARD_AFTER']) {
	session_unset($_SESSION['FMS']);
	header("Location: admin_login.php");
	exit(0);
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="author" content="Brian Cai" />
<title>Welcome &raquo; FMS - Admin Control Panel</title>
<!-- BOOTSTRAP CORE STYLE  -->
<link href="assets/css/bootstrap.css" rel="stylesheet" />
<!-- FONT AWESOME ICONS  -->
<link href="assets/css/font-awesome.css" rel="stylesheet" />
<!-- CUSTOM STYLE  -->
<link href="assets/css/style.css" rel="stylesheet" />
<script type="text/javascript" src="assets/js/jquery-2.1.4.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/bootbox.js" type="text/javascript"></script>
<script src="validations/validate_admin_home.js" type="text/javascript"></script>

</head>
<body>
<!-- HEADER END-->