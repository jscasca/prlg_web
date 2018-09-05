<?php
session_start();
require("../commons.php");

if(!isset($_REQUEST['token'])) {
	header("Location: ". BASE_DIR . "reset?e=403");
	die();
}
$token = $_REQUEST['token'];

if(!isset($_REQUEST['pwd'])) {
	header("Location: ". BASE_DIR . "reset?e=401");
	die();
}
$pwd = $_REQUEST['pwd'];

$call = authenticationlessCurlCall("POST", "public/passwordReset", array('token'=>$token, 'password'=>$pwd));
$code = $call[HTTP_STATUS];
if($code != 200 && $code != 204) {
	http_response_code($code);
	$error = json_decode($call[RESPONSE], true);
	//log or something
	//print( json_encode(array("code" => $code, "message" => $error['message'])) );
	//This means that the token does not exist, has expired or other...
	header("Location: ". BASE_DIR . "forgotten?e=" . $code);
} else {
	//$response[RESPONSE] should be a book
	//header('HTTP/1.1 204 No response', true, 204);die();
	//print($response[RESPONSE]);
	header("Location: ". BASE_DIR . "reset?sent=success");
}

//Possible headers:
// Forgotten if the token expired or cant be found
// reset:Success it it was succesful
//header("Location: ". BASE_DIR . $lang . "reset.php?sent=success");
?>
