<?php
####################################################################
#	File Name	:	config.url.settings.php
#	Author		:	Brian Cai
#	Location	: 	WEBROOT/configs/
####################################################################

# Getting Server's Document root path
define("DOC_ROOT", $_SERVER['DOCUMENT_ROOT'].'/FMS/');
# Error Log File
define("ERR_LOG_FILE", DOC_ROOT."err_log.txt");

define("SITE_URL", "http://".$_SERVER["HTTP_HOST"]."/FMS/"); 

define("URL_404", SITE_URL."file-not-found/");

?>