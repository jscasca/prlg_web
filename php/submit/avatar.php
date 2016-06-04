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

if(!isset($_FILES['avatar'])) {
	//There was no file
	failOn("000");
}

if($_FILES['avatar']['size'] > (1024000)) {
	//File too large
	failOn("001");
}

$check = getimagesize($_FILES['avatar']['tmp_name']);
if($check === false) {
	//File is not an image
	failOn("002");
}

//Check either $check['mime'] or $_FILES['avatar']['type'] for the type
//Check mime size

$_SESSION[USERNAME];
//Move img

$target = AVATAR_LOC.$_SESSION[USERNAME];
move_uploaded_file($_FILES['avatar']['tmp_name'], RELATIVE_PATH.$target);

$request['field'] = 'avatar';
$request['value'] = 'tin';

$token = $_SESSION[TOKEN];

$response = tokenCurlCall($token, "POST", "api/myservice/displayname", $request);
$code = $response[HTTP_STATUS];
if($code != 200 && $code != 204) {
	print_r($response);die();
	header("Location: ".URL_INTERNAL_SERVER_ERROR);
	die();
} else {
	header('Location: '.URL_PROFILE); die();
}

function failOn($code) {
	header("Location: ".URL_PROFILE."?e=".$code);
	die();
}

?>
