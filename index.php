<?php
session_start();
include 'php/commons.php';
//if(!isset($_SESSION[SID]))die($_SESSION[SID]);
// if(isset($_SESSION['lang'])) {
// 	//$_SESSION['lang'] = 'es';
// } else {
// 	//Get the lang
// 	$lang = getLang($_SERVER);
// 	//Set the lang
// 	$_SESSION['lang'] = $lang;
// }
// header('Location: '.$_SESSION['lang'].'/index.php');
// if(!isset($_SESSION[SID]))die($_SESSION[SID]);
if(!isset($_SESSION['lang'])) {
	$lang = getLang($_SERVER);
	$_SESSION['lang'] = $lang;
}

//pass the functions to commons

function explodeUri($uri, $ignoreProloges) {
	$xParams = explode('?', $uri, 2);
	$xAnchors = explode('#', $uri, 2);
	//
	$expanded = [];
	$expanded['full_uri'] = $uri;
	$expanded['uri'] = strlen($xParams[0]) > strlen($xAnchors[0]) ? $xAnchors[0] : $xParams[0];
	if(count($xParams) > 1) $expanded['args'] = $xParams[1];
	if(count($xAnchors) > 1) $expanded['anchor'] = $xAnchors[1];
	return $expanded;
}

function mapArgs($arguments) {
	$output = [];
	parse_str($arguments, $output);
	return $output;
}

function getReferer() {
	if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== null) {
		return $_SERVER['HTTP_REFERER'];
	}
	return '';
}

$refererUri = getReferer();
$requestUri = explodeUri($_SERVER['REQUEST_URI'], false);
$content = 'templates/_500.php';

$loggedIn = isset($_SESSION[SID]);

$uri = $requestUri['uri'];

if(preg_match('"^(?:/prologes)/lang/[a-z]{2}$"', $uri) && preg_match('"https?://(?:(?:(?:[^./]+\.)?prologes.com)|(?:localhost))(?:/prologes)?/"', $refererUri)) {
	//
	$lang = substr($uri, -2);
	if(isValidLanguage($lang)) {
		$_SESSION['lang'] = $lang;
	}
	header('Location: ' . $refererUri);
	exit;
	// $uri = preg_replace('"https?://(?:(?:(?:[^./]+\.)?prologes.com)|(?:localhost))(?:/prologes)?"', '', $refererUri);
} else if(preg_match('"^(?:/prologes)/logout$"', $uri)) {
	//destroy and redirect somehwere
	$currentLang = $_SESSION['lang'];
	$_SESSION = array();
	$_SESSION['lang'] = $currentLang;
	// If it's desired to kill the session, also delete the session cookie.
	// Note: This will destroy the session, and not just the session data!
	if (ini_get("session.use_cookies")) {
	    $params = session_get_cookie_params();
	    setcookie(session_name(), '', time() - 42000,
	        $params["path"], $params["domain"],
	        $params["secure"], $params["httponly"]
	    );
	}
	header('Location: ' . $refererUri);
	exit;
}

include 'translations/__' . $_SESSION['lang'] . '.php';

function getTranslation($text) {
	$translations = $GLOBALS['translations'];
	if(isset($translations) && isset($translations[$text])) {
		return $translations[$text];
	} else {
		return $text;
	}
}

$libraries = [];
//Maybe check if the file exists first?
$libraries[] = 'js/translators/' . $_SESSION['lang'] . '.js';

if(preg_match('"^(?:/prologes)?/(?:(?:index)|(?:home))(?:.php)?$"', $uri) || preg_match('"^(?:/prologes)?/$"', $uri)) {
	//
	$content = 'templates/_index.php';
	include 'templates/__template.php';
} else if(preg_match('"/prologes/login"', $uri)) {
	// check the referer and check if it is post or get
	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		// is trying to log in
		$user = $_REQUEST['user'];
		$pass = $_REQUEST['pwd'];
		try {
			logIn($user, $pass);
			header('Location: /prologes/index');
			exit;
		} catch(Exception $e) {
			//depending on the error print variable or redirect to a different page
			$failureToLogin = 'Your username and password do not match';
		}
	}
	include 'templates/_login.php';
	//
} else if(preg_match('"^(?:/prologes)?/user"', $uri)) {
	//
} else if(preg_match('"^(?:/prologes)?/book"', $uri)) {
	//TODO:

} else if(preg_match('"^(?:/prologes)?/about"', $uri)) {

} else if(preg_match('"^(?:/prologes)?/registration"', $uri)) {

} else if(preg_match('"^(?:/prologes)?/forgotten"', $uri)) {
	//forgotten
	if(isset($requestUri['args'])) {
		//
	}

} else if(preg_match('"^(?:/prologes)?/(?:(?:search)|(?:buscar))"', $uri)) {
	//check if there is a query
	$search = '';
	if(isset($requestUri['args'])) {
		$queryArgs = mapArgs($requestUri['args']);
		if(isset($queryArgs['q']) && $queryArgs['q'] != '') {
			$search = $queryArgs['q'];
		}
	} else {
		//check for the url
		preg_match('"^(?:/prologes)?/(?:(?:search)|(?:buscar))/(.*)$"', $uri, $searchQueryMatches);
		if(isset($searchQueryMatches[1])) {
			$search = urldecode($searchQueryMatches[1]);
		}

	}
	$content = 'templates/_search.php';
	include 'templates/__template.php';

} else if(preg_match('"^(?:/prologes)?/privacy"', $uri)) {

} else if(preg_match('"^(?:/prologes)?/about"', $uri)) {
	//

} else if(preg_match('"^(?:/prologes)?/logout"', $uri)) {

} else {
	//do a 500 or 404
	echo "fail";
}
?>