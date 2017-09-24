<?php

session_start();
require('../commons.php');

$lang = $_SESSION[LANG].'/';

$internalErrorPage = BASE_DIR . $lang . URL_INTERNAL_SERVER_ERROR;
$bookPage = BASE_DIR . $lang . URL_BOOK;

/*if(!isset($_SESSION[SID])) {
	//header('HTTP/1.1 401 Unauthorized', true, 401);
	//http_response_code(401);//
	//die("You must be logged in to access this resource");
	//Redirect to 401 page
	header("Location: " . $internalErrorPage);
	die();
}*/

$authors = isset($_REQUEST['authors']) ? $_REQUEST['authors'] : '';
$title = isset($_REQUEST['title']) ? $_REQUEST['title'] : '';
$language = isset($_REQUEST['language']) ? $_REQUEST['language'] : '';
$icon = isset($_REQUEST['icon']) ? $_REQUEST['icon'] : 'http://prologes.com/img/default.png';
$thumbnail = isset($_REQUEST['thumbnail']) ? $_REQUEST['thumbnail'] : 'http://prologes.com/img/default.png';

if($title == '') {
	header("Location: " . $internalErrorPage);
	die();
}
if($language == '') {
	header("Location: " . $internalErrorPage);
	die();
}

$request['authors'] = $authors;
$request['title'] = $title;
$request['language'] = $language;
$request['icon'] = $icon;
$request['thumbnail'] = $thumbnail;

$token = $_SESSION[TOKEN];

//$response = tokenCurlCall($token, "POST", "api/books/requests", $request);
$response = authenticationlessCurlCall("POST", "api/books/requests", $request);
$code = $response[HTTP_STATUS];
if($code != 200) {
	header("Location: " . $internalErrorPage);
	die();
} else {
	$book = json_decode($response[RESPONSE], true);
	header('Location: ' . $bookPage . '?i='.$book['id']); die();
}

?>
