<?php
session_start();
require("../commons.php");

$lang = $_SESSION[LANG].'/';

$user = $_REQUEST['user'];

if($user != "") {
	$call = authenticationlessCurlCall("POST", "public/passwordRequest", $user);
}


header("Location: ". BASE_DIR . "forgotten?sent=success");
?>
