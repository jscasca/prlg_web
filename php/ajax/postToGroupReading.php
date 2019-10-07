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
if(!isset($_REQUEST['book']) && !isset($_REQUEST['reading'])) {
	http_response_code(400);//
	die("No query term set");
}

$club = $_REQUEST['club']; //the id
$url; // which url to call
if ( isset($_REQUEST['book'])) {
	// do for book
	$url = "api/clubs/".$club."/readings"."/start"."/book". "/" .$_REQUEST['book'];
}
if ( isset($_REQUEST['reading'])) {
	// do for reading
	$url = "api/clubs/".$club."/readings"."/start"."/reading" . "/" .$_REQUEST['reading'];
}

$token = $_SESSION[TOKEN];
$response = tokenCurlCall($token, "POST", $url);
$code = $response[HTTP_STATUS];
if($code != 200 && $code != 204) {
	http_response_code($code);
	$error = json_decode($response[RESPONSE], true);
	print( json_encode(array("code" => $code, "message" => $error['message'])) );
} else {
	//$response[RESPONSE] should be a reading Object
	//header('HTTP/1.1 204 No response', true, 204);die();
	print($response[RESPONSE]);
}
//header('HTTP/1.1 500 Internal Server E', true, 501);
?>
