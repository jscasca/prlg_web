<?php

session_start();
require('../commons.php');

$internalErrorPage = BASE_DIR . URL_INTERNAL_SERVER_ERROR;
$groupPage = BASE_DIR . 'group';

/*if(!isset($_SESSION[SID])) {
	//header('HTTP/1.1 401 Unauthorized', true, 401);
	//http_response_code(401);//
	//die("You must be logged in to access this resource");
	//Redirect to 401 page
	header("Location: " . $internalErrorPage);
	die();
}*/

$name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';

if($name == '') {
	header("Location: " . $internalErrorPage);
	die();
}

$request['name'] = $name;

$token = $_SESSION[TOKEN];

//$response = tokenCurlCall($token, "POST", "api/books/requests", $request);
$response = tokenCurlCall($token, "POST", "api/clubs/", $request);
$code = $response[HTTP_STATUS];
if($code != 200) {
	header("Location: " . $internalErrorPage);
	die();
} else {
	$group = json_decode($response[RESPONSE], true);
	header('Location: ' . $groupPage . '/'.$group['id']); die();
}

?>
