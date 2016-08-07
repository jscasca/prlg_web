<?php
session_start();
require("../commons.php");

$lang = $_SESSION[LANG].'/';

$loginUrl = BASE_DIR . $lang . URL_LOGIN;
$notFoundUrl = BASE_DIR . $lang . URL_NOT_FOUND;
$internalErrorPage = BASE_DIR . $lang . URL_INTERNAL_SERVER_ERROR;
$indexUrl = BASE_DIR . $lang . URL_INDEX;
$registration = BASE_DIR . $lang . URL_REGISTRATION;

/**
 * 409 if already exists
 */
if(!isset($_REQUEST['email'])) {
	header("Location: ".URL_INTERNAL_SERVER_ERROR);
	die();
}
$user = $_REQUEST['user'];
$email = $_REQUEST['email'];
$pass = $_REQUEST['pwd'];
$passConf = $_REQUEST['pwdConfirmation'];

try {
	registration($user, $pass, $email);
	header('Location: ' . $indexUrl);
} catch(DuplicateResourceException $e) {
	if($e->getCode() == 0) 
		header("Location: " . $registration . "?e=user");
	else
		header("Location: " . $registration . "?e=email");
} catch(Exception $e) {
	header("Location: " . $internalErrorPage);
}
//$call = authenticationlessCurlCall("POST", "public/registration", array("username" => $user, "email" => $email, "password" => $pass));
//print_r($call);

?>
