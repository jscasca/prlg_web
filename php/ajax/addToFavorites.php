<?php

session_start();
require('../commons.php');

if(!isset($_SESSION[SID])) {
	//header('HTTP/1.1 401 Unauthorized', true, 401);
	http_response_code(401);//
	die("You must be logged in to access this resource");
}
if(!isset($_REQUEST['book'])) {
	http_response_code(400);//
	die("No query term set");
}
$book = $_REQUEST['book'];
$token = $_SESSION[TOKEN];
//$getUser = tokenCurlCall($accessToken, "GET", ME);
$response = tokenCurlCall($token, "POST", "api/books/".$book."/favorites");
$code = $response[HTTP_STATUS];
if($code != 200 && $code != 204) {
	http_response_code($code); die("BoS");
} else {
	//$response[RESPONSE] should be a book
	header('HTTP/1.1 204 No response', true, 204);die();
}
header('HTTP/1.1 500 Internal Server E', true, 501);
?>
