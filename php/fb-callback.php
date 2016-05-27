<?php
require_once '/var/www/html/prologes/php/facebook-php-sdk-v4-5.0.0/src/Facebook/autoload.php';
require_once '/var/www/html/prologes/php/commons.php';
session_start();

require_once 'fb-aux.php';

$helper = $fb->getRedirectLoginHelper();

try {
	$accessToken = $helper->getAccessToken();
} catch(Facebook\Exception\FacebookResponseException $e) {
	echo 'Graph returned an error: ' . $e->getMessage();
	exit;
} catch(Facebook\Exception\FacebookSDKException $e) {
	echo 'Facebook SDK returned an error: ' . $e->getMessage();
	exit;
}

if(! isset($accessToken)) {
	echo "something wrong";
	exit;
}

$token = $accessToken->getValue();

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);

$user = $tokenMetadata->getUserId();

// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId($appId); // Replace {app-id} with your app id
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();
/*
if (! $accessToken->isLongLived()) {
  // Exchanges a short-lived access token for a long-lived one
  try {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
    exit;
  }

  echo '<h3>Long-lived</h3>';
  var_dump($accessToken->getValue());
}*/

//Check if the user exist and log him in, if not, send them to registration to pick a username
$checkUserId = authenticationlessCurlCall("GET", "login/facebook/isUserRegistered", array('userId'=>$user));
$isUserRegistered = $checkUserId[RESPONSE];
if($checkUserId[HTTP_STATUS] != 200) {
	//header('Location: ../e.php');
	die("unplugged");
}

if($isUserRegistered == "true") {
	
	try {
		logIn("facebook:".$user, $token);
		header('Location: ../index.php');
		die();
	} catch(Exception $e) {
		$code = $e->getCode();
		$message = $e->getMessage();
		echo $code."<br/>";
		echo $message;
	}
} else {
	//Change header to social registration
	$socialUser = array();
	$socialUser['id'] = $user;
	$socialUser['token'] = $token;
	$socialUser['icon'] = "//graph.facebook.com/".$user."/picture?width=140&height=110";
	$_SESSION['SocialLogin'] = $socialUser;
	header('Location: ../socialregistration.php');
	die();
}

?>
