<?php
session_start();
require("../commons.php");

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
	header('Location: '.URL_INDEX);
} catch(DuplicateResourceException $e) {
	if($e->getCode() == 0) 
		header("Location: ".URL_REGISTRATION."?e=user");
	else
		header("Location: ".URL_REGISTRATION."?e=email");
} catch(Exception $e) {
	print_r($e);die();
	header("Location: ".URL_INTERNAL_SERVER_ERROR);
}
//$call = authenticationlessCurlCall("POST", "public/registration", array("username" => $user, "email" => $email, "password" => $pass));
//print_r($call);

?>
