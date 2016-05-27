<?php

session_start();
require('../commons.php');

if(!isset($_SESSION[SID])) {
	http_response_code(401);
	echo "You must be logged in to access this resource";
	die();
}
if(!isset($_REQUEST['user'])) {
	http_response_code(400);
	echo "No query term set";
	die();
}

$userId = $_REQUEST['user'];

$token = $_SESSION[TOKEN];

$call = tokenCurlCall($token, GET, "api/users/".$userId."/interactions");

http_response_code($call[HTTP_STATUS]);

print($call[RESPONSE]);
?>
