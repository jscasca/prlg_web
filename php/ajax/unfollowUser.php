<?php

session_start();
require('../commons.php');

if(!isset($_SESSION[SID])) {
	//header('HTTP/1.1 401 Unauthorized', true, 401);
	http_response_code(401);//
	die("You must be logged in to access this resource");
}
if(!isset($_REQUEST['user'])) {
	http_response_code(400);//
	die("No user set");
}
$user = $_REQUEST['user'];
$token = $_SESSION[TOKEN];

$response = tokenCurlCall($token, "DELETE", "api/users/".$user."/followers");
$code = $response[HTTP_STATUS];
if($code != 200 && $code != 204) {
	http_response_code($code); die("BoS");
} else {
	//$response[RESPONSE] should be a book
	header('HTTP/1.1 204 No response', true, 204);die();
}
header('HTTP/1.1 500 Internal Server E', true, 501);
?>
