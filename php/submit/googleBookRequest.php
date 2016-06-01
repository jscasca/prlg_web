<?php

session_start();
require('../commons.php');

if(!isset($_SESSION[SID])) {
	//header('HTTP/1.1 401 Unauthorized', true, 401);
	//http_response_code(401);//
	//die("You must be logged in to access this resource");
	//Redirect to 401 page
	header("Location: ".URL_INTERNAL_SERVER_ERROR);
	die();
}

$author = isset($_REQUEST['author']) ? $_REQUEST['author'] : '';
$authorId = isset($_REQUEST['authorId']) ? $_REQUEST['authorId'] : '-1';
$workId = isset($_REQUEST['workId']) ? $_REQUEST['workId'] : '-1';
$title = isset($_REQUEST['title']) ? $_REQUEST['title'] : '';
$language = isset($_REQUEST['language']) ? $_REQUEST['language'] : '';
$icon = isset($_REQUEST['icon']) ? $_REQUEST['icon'] : '';
$thumbnail = isset($_REQUEST['thumbnail']) ? $_REQUEST['thumbnail'] : '';

if($title == '') {
	header("Location: ".URL_INTERNAL_SERVER_ERROR);
	die();
}
if($language == '') {
	header("Location: ".URL_INTERNAL_SERVER_ERROR);
	die();
}

$request['author'] = $author;
$request['authorId'] = $authorId;
$request['workId'] = $workId;
$request['title'] = $title;
$request['language'] = $language;
$request['icon'] = $icon;
$request['thumbnail'] = $thumbnail;

$token = $_SESSION[TOKEN];

$response = tokenCurlCall($token, "POST", "api/books/requests", $request);
$code = $response[HTTP_STATUS];
if($code != 200) {
	header("Location: ".URL_INTERNAL_SERVER_ERROR);
	die();
} else {
	$book = json_decode($response[RESPONSE], true);
	header('Location: '.BASE_DIR.'book.php?i='.$book['id']); die();
}

?>
