<?php

session_start();
require('../commons.php');

if(!isset($_SESSION[SID])) {
	//header('HTTP/1.1 401 Unauthorized', true, 401);
	http_response_code(401);//
	die("You must be logged in to access this resource");
}
if(!isset($_REQUEST['similarity'])) {
	http_response_code(400);//Make a return for no comment
	die("Mssing similarity parameter");
}
if(!isset($_REQUEST['vote'])) {
	http_response_code(400);//Make a return for no comment
	die("Incorrect vote parameter");
}
$similarity = $_REQUEST['similarity'];
$token = $_SESSION[TOKEN];
if($_REQUEST['vote'] === "1") {
	$response = tokenCurlCall($token, "POST", "api/books/similar/".$similarity."/up");
} else {
	$response = tokenCurlCall($token, "POST", "api/books/similar/".$similarity."/down");
}
// $response = tokenCurlCall($token, "POST", "api/books/similar/".$similarity."/".$voteValue);
$code = $response[HTTP_STATUS];
if($code != 200 && $code != 204) {
	http_response_code($code); print_r($response);
	die("BoS");
} else {
	print($response[RESPONSE]); die();
}
header('HTTP/1.1 500 Internal Server E', true, 501);
?>
