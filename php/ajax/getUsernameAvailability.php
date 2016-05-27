<?php

require('../commons.php');

if(!isset($_REQUEST['username'])) {
	http_response_code(400);
	echo "No query term set";
	die();
}

$username = $_REQUEST['username'];

$call = authenticationlessCurlCall("GET", "public/usernameAvailability", array("username" => $username));

http_response_code($call[HTTP_STATUS]);

print($call[RESPONSE]);
?>
