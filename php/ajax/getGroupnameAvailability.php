<?php

require('../commons.php');

if(!isset($_REQUEST['name'])) {
	http_response_code(400);
	echo "No query term set";
	die();
}

$name = $_REQUEST['name'];

$call = authenticationlessCurlCall("GET", "public/groupnameAvailability", array("name" => $name));

http_response_code($call[HTTP_STATUS]);

print($call[RESPONSE]);
?>
