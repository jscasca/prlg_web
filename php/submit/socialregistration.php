<?php
session_start();
require_once '/var/www/html/prologes/php/commons.php';

$username = $_REQUEST['username'];
$user = $_REQUEST['user'];
$token = $_REQUEST['token'];
$icon = $_REQUEST['icon'];

try {
	registration($user, $token, $username, $icon);
} catch(Exception $e) {
	$eCode = $e->getCode();
	if($code == 0) {
		header('Location: sww.html'); die();
	} else if($code == 500 || $code = 404) {
		header('Location: oos.html'); die();
	} else {
		header('Location: sww.html'); die();
	}
}

try {
	//log in again with facebook
	$socialLoginCall = authenticationlessCurlCall("GET", "login/facebook", array('id'=>$user, 'token'=>$token));
	$loginInfo = json_decode($socialLoginCall[RESPONSE], true);
	$accessToken = $logInInfo["value"];
	$refreshToken = $logInInfo["refreshToken"];
	$getUser = tokenCurlCall($accessToken, "GET", ME);
	$userInfo = json_decode($getUser[RESPONSE], true);
	//Void function, sets the values in session vars
	$_SESSION[SID] = $userInfo['id'];
	$_SESSION[ICON] = $userInfo['icon'];
	$_SESSION[DISPLAY_NAME] = $userInfo['displayName'];
	$_SESSION[USERNAME] = $userInfo['userName'];
	$_SESSION[TOKEN] = $logInInfo['value'];
	$_SESSION[REFRESH] = $logInInfo['refreshToken'];
	header('Location: ../../index.php'); die();
} catch(Exception $e) {
	//The user was created succesfully but there was an error trying to log in
	header('Location: ../../login.html?e=10001'); die();
}

//Throw exception if the username or email are taken
function registration($user, $token, $username, $icon) {
	$registrationWrapper = json_encode(array('id'=>$user, 'token'=>$token, 'username'=>$username, 'icon'=>$icon));
	$regUser = authenticationlessCurlCall(POST, 'public/socialRegistration/facebook', $registrationWrapper);
	if($regUser[HTTP_STATUS] != 200) {
		print_r($regUser);
		die();
		throw new Exception("Failed", $regUser[HTTP_STATUS]);
	}
	//If the response is 200 the user is created, we can log in now
	
}
?>
