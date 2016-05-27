<?php

require('../commons.php');

if(!isset($_REQUEST['author'])) {
	http_response_code(400);
	echo "No query term set";
	die();
}

$authorId = $_REQUEST['author'];

$call = authenticationlessCurlCall("GET", "api/authors/".$authorId."/books");

http_response_code($call[HTTP_STATUS]);

print($call[RESPONSE]);
?>
