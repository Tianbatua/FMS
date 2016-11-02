<?php
####################################################################
#	File Name	:	logout.php
#	Location	:	/webroot/
####################################################################
session_start();
session_destroy();
header("Location: admin_login.php");
exit(0);
?>