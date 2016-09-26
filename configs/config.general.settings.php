<?php
####################################################################
#	File Name	:	config.general.settings
#	Author		:	Brian Cai
#	Location	: 	WEBROOT/configs
#	Description	:	Includes the required configuration settings
####################################################################

# Timezone settings
date_default_timezone_set('America/New_York');

# Obtaining Browser's Public IP
define("BROWSER_PUBLIC_IP", $_SERVER['REMOTE_ADDR']);

# Mail Server Settings
define("SMTP_HOST", "");
define("SMTP_PORT", "");
define("SMTP_USER", "");
define("SMTP_PWD", '');
?>