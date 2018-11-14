<?php

session_start();
require('../commons.php');

if(!isset($_REQUEST['club'])) {
	http_response_code(400);
	echo "No query term set";
	die();
}

$clubId = $_REQUEST['club'];
$row = isset($_REQUEST['start']) ? $_REQUEST['start'] : '0';
$limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : '10';

$call = authenticationlessCurlCall("GET", "api/comments/clubs/".$clubId."/comments");

http_response_code($call[HTTP_STATUS]);

print($call[RESPONSE]);


?>
