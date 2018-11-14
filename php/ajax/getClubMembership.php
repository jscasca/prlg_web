<?php
session_start();
require('../commons.php');

if(!isset($_REQUEST['club'])) {
	echo "No query term set";
	http_response_code(400);
	die();
}

$club = $_REQUEST['club'];

$token = $_SESSION[TOKEN];

$call = tokenCurlCall($token, GET, "api/clubs/".$club."/memberships");

http_response_code($call[HTTP_STATUS]);

print($call[RESPONSE]);
?>