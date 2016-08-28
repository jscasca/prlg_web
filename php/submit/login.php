<?php
session_start();

require("../commons.php");

$lang = $_SESSION[LANG].'/';

$loginUrl = BASE_DIR . $lang . URL_LOGIN;
$notFoundUrl = BASE_DIR . $lang . URL_NOT_FOUND;
$internalErrorPage = BASE_DIR . $lang . URL_INTERNAL_SERVER_ERROR;
$indexUrl = BASE_DIR . $lang . URL_INDEX;

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
