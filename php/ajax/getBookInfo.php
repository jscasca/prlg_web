<?php

require('../commons.php');

if(!isset($_REQUEST['book'])) {
	http_response_code(400);
	echo "No query term set";
	die();
}

$bookId = $_REQUEST['book'];

$call = authenticationlessCurlCall("GET", "api/books/".$bookId."/info");

http_response_code($call[HTTP_STATUS]);

print($call[RESPONSE]);
?>
