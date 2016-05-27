<?php

require('../commons.php');

if(!isset($_REQUEST['q'])) {
	http_response_code(400);
	echo "No query term set";
	die();
}

$query = $_REQUEST['q'];
$row = isset($_REQUEST['start']) ? $_REQUEST['start'] : '0';
$limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : '20';

$call = authenticationlessCurlCall(GET, API_SEARCH_ANYTHING, array('start'=>$row, 'limit'=>$limit, 'query'=>$query));

http_response_code($call[HTTP_STATUS]);

print($call[RESPONSE]);
?>
