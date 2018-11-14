<?php
session_start();
require('../commons.php');

if(!isset($_REQUEST['club']) || $_REQUEST['club'] == '') {
	http_response_code(400);
	die();
}

$club = $_REQUEST['club'];

$call = authenticationlessCurlCall(GET, "api/clubs/".$club."/views");

http_response_code($call[HTTP_STATUS]);

print($call[RESPONSE]);
?>
