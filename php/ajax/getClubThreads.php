<?php

session_start();
require('../commons.php');

if(!isset($_REQUEST['club'])) {
	http_response_code(400);
	echo "No query term set";
	die();
}

$club = $_REQUEST['club'];
$row = isset($_REQUEST['start']) ? $_REQUEST['start'] : '0';
$limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : '100';

$call = authenticationlessCurlCall(GET, "api/comments/clubs/".$club."/threads", array('start'=>$row, 'limit'=>$limit));
http_response_code($call[HTTP_STATUS]);
print($call[RESPONSE]);


?>