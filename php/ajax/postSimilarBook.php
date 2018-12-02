<?php

session_start();
require('../commons.php');

if(!isset($_SESSION[SID])) {
	//header('HTTP/1.1 401 Unauthorized', true, 401);
	http_response_code(401);//
	die("You must be logged in to access this resource");
}
if(!isset($_REQUEST['original']) || !isset($_REQUEST['similar'])) {
	http_response_code(400);//
	die("Missing component");
}

$token = $_SESSION[TOKEN];
$original = $_REQUEST['original'];
$similar = $_REQUEST['similar'];
//$getUser = tokenCurlCall($accessToken, "GET", ME);
$response = tokenCurlCall($token, "POST", "api/books/" . $original . "/similar", $similar);
$code = $response[HTTP_STATUS];
if($code != 200 && $code != 204) {
	http_response_code($code);
	$error = json_decode($response[RESPONSE], true);
	print( json_encode(array("code" => $code, "message" => $error['message'])) );
} else {
	//$response[RESPONSE] should be a comment
	//header('HTTP/1.1 204 No response', true, 204);die();
	print($response[RESPONSE]);
}
//header('HTTP/1.1 500 Internal Server E', true, 501);
?>
