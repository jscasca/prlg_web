<?php

session_start();
require('../commons.php');

$loginPage = BASE_DIR . 'login';
$internalErrorPage = BASE_DIR . '500';
$bookPage = BASE_DIR . 'book';

// This should try to check the user is logged in
/*if(!isset($_SESSION[SID])) {
	//header('HTTP/1.1 401 Unauthorized', true, 401);
	//http_response_code(401);//
	//die("You must be logged in to access this resource");
	//Redirect to 401 page
	header("Location: " . $internalErrorPage);
	die();
}*/

print_r($_REQUEST);

$authors = isset($_REQUEST['author']) ? $_REQUEST['author'] : '';
$cleanAuthors = [];
if(is_array($authors)) {
	for($i=0; $i < sizeof($authors); $i++) {
		$cleanAuthors[] = str_replace(";", " ", $authors[$i]);
	}
}
$authors = implode(";", $cleanAuthors);
//loop escape and join
$title = isset($_REQUEST['title']) ? $_REQUEST['title'] : '';
$language = isset($_REQUEST['language']) ? $_REQUEST['language'] : '';
$icon = "//prologes.com/img/default.png";
$thumbnail = "//prologes.com/img/default.png";

if($title == '') {
	//header("Location: " . $internalErrorPage);
	die("no title");
}
if($language == '') {
	//header("Location: " . $internalErrorPage);
	die("no lang");
}

$request['authors'] = $authors;
$request['title'] = $title;
$request['language'] = $language;
$request['icon'] = $icon;
$request['thumbnail'] = $thumbnail;

$token = $_SESSION[TOKEN];
//print_r($request);

$response = tokenCurlCall($token, "POST", "api/books/requests/custom", $request);
//$response = authenticationlessCurlCall("POST", "api/books/requests", $request);
$code = $response[HTTP_STATUS];
if($code != 200) {
	if($code == 401) {
		header("Location: " . $loginPage . "?l=timeout");
	} else {
		header("Location: " . $internalErrorPage);
	}
	die();
} else {
	$book = json_decode($response[RESPONSE], true);
	header('Location: ' . $bookPage . '/'.$book['id']); die();
}

?>
