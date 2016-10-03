<?php
####################################################################
#	File Name	:	ajax_secureLogin.php
#	Location	: 	WEBROOT/ajax
####################################################################
//error_reporting(E_ALL);
//ini_set("display_errors","on");

require ("../configs/config.general.settings.php");
require ("../configs/config.url.settings.php");
//require ("../classes/class.general_utils.php");
require ("../configs/config.dbase.settings.php");

require ("../classes/class.log.php");
require ("../classes/class.main.php");

$dbObj = new cdBConnect;
$connect = $dbObj->connectDB();


global $pdoConObj;
$logObj = new logClass();
$mainClassObj =	new dbClass();

session_start();

$todayDBDateTime =	date("Y-m-d H:i:s");

if(isset($_POST['op_command']) && $_POST['op_command'] == "SECURE_LOGIN") {

	$loginName			=	$_POST['loginName'];
	$loginPwd			=	$_POST['loginPwd'];
<<<<<<< HEAD

=======
>>>>>>> 35415fc59dcbc37f70fa51090118fd6248b3102d
	$targetSchema		=	"users";
	$loginCondition		=	"(name = '".$loginName."' AND password  = '".$loginPwd."')";
	$checkAvailInfo		=	$mainClassObj->getSchemaInfo($targetSchema, "*", $loginCondition, "", "", "", "");
	
	$availCount			=	sizeof($checkAvailInfo);


<<<<<<< HEAD
=======


>>>>>>> 35415fc59dcbc37f70fa51090118fd6248b3102d
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