<?php

require('../commons.php');

if(!isset($_REQUEST['userid']) && !isset($_REQUEST['username'])) {
	http_response_code(400);
	echo "No query term set";
	die();
}

$userId = $_REQUEST['userid'];
$username = $_REQUEST['username'];

if($userId == '' && $username == '') {
	http_response_code(400);
	echo "No query term set";
	die();
}

$call[HTTP_STATUS] = 500;
$call[RESPONSE] = 'Internal Server Error';

if($userId != '') {
	$call = authenticationlessCurlCall("GET", "api/users/".$userId."/library");
} else if($username != '') {
	$call = authenticationlessCurlCall("GET", "api/usersbyname/".$username."/library");
}

http_response_code($call[HTTP_STATUS]);

print($call[RESPONSE]);
?>
