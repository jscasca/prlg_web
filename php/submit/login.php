<?php
session_start();
require("../commons.php");
$loginUrl = BASE_DIR."login.php";
$notFoundUrl = BASE_DIR."404.html";
$internalErrorPage = BASE_DIR."500.html";
$indexUrl = BASE_DIR."index.php";
$user = $_REQUEST['user'];
$pass = $_REQUEST['pwd'];
try {
	logIn($user, $pass);
	header('Location: '.$indexUrl);
} catch(Exception $e) {
	$code = $e->getCode();
	$message = $e->getMessage();
	
	//print($code);die();
	if($code == 1 || $code == 401 || $message == "Token request failed") {
		header('Location: '.$loginUrl.'?l=failed'); die();
	} else if($code == 500 || $code == 404) {
		header('Location: '.$internalErrorPage); die();
	} else {
		header('Location: '.$notFoundUrl); die();
	}
}
?>
