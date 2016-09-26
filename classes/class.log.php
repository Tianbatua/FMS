<?php
####################################################################
#	File Name	:	log_class.php
#	Location	: 	WEBROOT/classes/
####################################################################

if (!defined('DOC_ROOT'))
	define("DOC_ROOT", $_SERVER['DOCUMENT_ROOT'].'/FMS/');

if (!defined('ERR_LOG_FILE'))
	define("ERR_LOG_FILE", DOC_ROOT."err_log.txt");

class logClass {
	/**********************************************************************
	 # FUNCTION TO PRINT MESSAGE TO ERROR LOG
	**********************************************************************/
	public static function printLog($info) {
		$exist_content = file_get_contents(ERR_LOG_FILE);
		file_put_contents(ERR_LOG_FILE, $info . "\n" . $exist_content);
	}
}

?>