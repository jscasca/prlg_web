<?php

session_start();
require('../commons.php');

if(!isset($_SESSION[SID])) {
	//header('HTTP/1.1 401 Unauthorized', true, 401);
	http_response_code(401);//
	die("You must be logged in to access this resource");
}
if(!isset($_REQUEST['prologe'])) {
	http_response_code(403);//Make a return for no comment
	die("Mssing prologe parameter");
}
$prologe = $_REQUEST['prologe'];
$token = $_SESSION[TOKEN];
//$getUser = tokenCurlCall($accessToken, "GET", ME);
$response = tokenCurlCall($token, "POST", "api/posdtas/".$prologe."/upvote");
$code = $response[HTTP_STATUS];
if($code != 200 && $code != 204) {
	http_response_code($code); print_r($response);
	die("BoS");
} else {
	print($response[RESPONSE]); die();
}
header('HTTP/1.1 500 Internal Server E', true, 501);
?>
