<?php

session_start();
require('../commons.php');

if(!isset($_SESSION[SID])) {
	//header('HTTP/1.1 401 Unauthorized', true, 401);
	http_response_code(401);//
	die("You must be logged in to access this resource");
}
if(!isset($_REQUEST['club'])) {
	http_response_code(400);//
	die("No query term set");
}

// TODO: Do one at a time
$club = $_REQUEST['club']; //the id

if (!isset($_REQUEST['attribute']) || !isset($_REQUEST['value'])) {
	http_response_code(400);//
	die("No attribute value set");
}

$wrapper[$_REQUEST['attribute']] = $_REQUEST['value'];

$token = $_SESSION[TOKEN];
//$getUser = tokenCurlCall($accessToken, "GET", ME);
$response = tokenCurlCall($token, "POST", "api/clubs/".$club."/attributes", $wrapper);

$code = $response[HTTP_STATUS];
if($code != 200 && $code != 204) {
	http_response_code($code);
	$error = json_decode($response[RESPONSE], true);
	print( json_encode(array("code" => $code, "message" => $error['message'])) );
} else {
	//header('HTTP/1.1 204 No response', true, 204);die();
	print($response[RESPONSE]);
}
//header('HTTP/1.1 500 Internal Server E', true, 501);
?>
