<?php

session_start();
require('../commons.php');

if(!isset($_SESSION[SID])) {
	//header('HTTP/1.1 401 Unauthorized', true, 401);
	http_response_code(401);//
	die();
}
if(!isset($_REQUEST['club'])) {
	http_response_code(400);//
	die();
}
$club = $_REQUEST['club'];
$token = $_SESSION[TOKEN];
//$getUser = tokenCurlCall($accessToken, "GET", ME);
$response = tokenCurlCall($token, "DELETE", "api/clubs/".$club."/memberships");
$code = $response[HTTP_STATUS];
if($code != 200 && $code != 204) {
	http_response_code($code);
	$error = json_decode($response[RESPONSE], true);
	print( json_encode(array("code" => $code, "message" => $error['message'])) );
} else {
	//$response[RESPONSE] should be a book
	header('HTTP/1.1 204 No response', true, 204);die();
}
header('HTTP/1.1 500 Internal Server E', true, 501);
//06:52:22.441 [http-8080-1] WARN  o.s.web.servlet.PageNotFound - No mapping found for HTTP request with URI [/Posdta/api/clubs/thrillerreaders/api/clubs/thrillerreaders/memberships] in DispatcherServlet with name 'api'
?>
