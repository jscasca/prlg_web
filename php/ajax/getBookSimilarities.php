<?php
session_start();
require('../commons.php');

if(!isset($_REQUEST['book'])) {
	http_response_code(400);
	echo "No query term set";
	die();
}

$bookId = $_REQUEST['book'];
$row = isset($_REQUEST['start']) ? $_REQUEST['start'] : '0';
$limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : '10';

if(isset($_SESSION[TOKEN])) {
	$token = $_SESSION[TOKEN];
	$call = tokenCurlCall($token, GET, "api/books/".$bookId."/similarBooks", array('start'=>$row, 'limit'=>$limit));
} else {
	$call = authenticationlessCurlCall(GET, "api/books/".$bookId."/similarBooks", array('start'=>$row, 'limit'=>$limit));
}

// $call = authenticationlessCurlCall(GET, "api/books/".$bookId."/similarBooks", array('start'=>$row, 'limit'=>$limit));

http_response_code($call[HTTP_STATUS]);

print($call[RESPONSE]);
?>
