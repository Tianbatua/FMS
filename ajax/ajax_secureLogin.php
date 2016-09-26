<?php
####################################################################
#	File Name	:	ajax_secureLogin.php
#	Location	: 	WEBROOT/ajax
####################################################################
//error_reporting(E_ALL);
//ini_set("display_errors","on");
require ("configs/db.config.php");
require ("configs/general.config.php");
require ("configs/url.config.php");

require ("classes/class.log.php");
require ("classes/main_class.php");

$dbObj = new dbConnect;
$connect = $dbObj->connectDB();
global $pdoConObj;
$logObj = new logClass();
$mainClassObj =	new dbClass();

session_start();

$todayDBDateTime =	date("Y-m-d H:i:s");

if(isset($_POST['op_command']) && $_POST['op_command'] == "SECURE_LOGIN") {
	
	$loginName			=	$_POST['loginName'];
	$loginPwd			=	$_POST['loginPwd'];
	$targetSchema		=	"users";
	$loginCondition		=	"(name = '".$loginName."' AND password  = '".$loginPwd."')";
	$checkAvailInfo		=	$mainClassObj->getSchemaInfo($targetSchema, "*", $loginCondition, "", "", "", "");
	
	$availCount			=	sizeof($checkAvailInfo);
	if($availCount == 1) {
		$now = time();
		$_SESSION['FMS'] = array(
			'USER_ID' => $loginName,
			'DISCARD_AFTER' => $now + 1000
		);	
		$logObj->printLog("Successfully authenticate user!");
		echo "SUCCESS";
	} else if ($availCount == 0) {
		$logObj->printLog("Failed authenticate user!");
	} else {
		$logObj->printLog("Something weird happened!");
	}
}
?>