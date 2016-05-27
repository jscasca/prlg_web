<?php

require('../commons.php');

if(!isset($_REQUEST['book'])) {
	http_response_code(400);
	echo "No query term set";
	die();
}

$bookId = $_REQUEST['book'];
$row = isset($_REQUEST['start']) ? $_REQUEST['start'] : '0';
$limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : '10';

$call = authenticationlessCurlCall(GET, "api/books/".$bookId."/readings", array('start'=>$row, 'limit'=>$limit));

http_response_code($call[HTTP_STATUS]);

print($call[RESPONSE]);
?>
