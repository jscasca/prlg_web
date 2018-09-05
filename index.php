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
	if(preg_match('"(?:(?:profile)|(?:library))"', $refererUri)) {
		header('Location: ' . BASE_DIR . 'index');
		exit;
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
			if(isset($_SESSION['login_referer']) && true) {
				header('Location: ' . $_SESSION['login_referer']);
			} else {
				header('Location: ' . BASE_DIR . 'index');
			}
			exit;
		} catch(Exception $e) {
			//depending on the error print variable or redirect to a different page
			$failureToLogin = 'Your username and password do not match';
		}
	} else {
		//store referer
		//TODO: Check that the referer is actually inside prologes/localhost
		if(preg_match('"(?:(?:prologes\.com)|(?:localhost))"', $refererUri)) {
			if(!preg_match('"(?:/prologes)?/(?:(?:regis)|(?:log)|(?:reset)|(?:forg)|(?:olv))"', $refererUri)) {
				$_SESSION['login_referer'] = $refererUri;
			}
		} else {
			unset($_SESSION['login_referer']);
		}
	}
	include 'templates/_login.php';
	//
} else if(preg_match('"^(?:/prologes)?/(?:(?:registration)|(?:register)|(?:registr))"', $uri)) {
	// TODO: set a session variable to validate
	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$user = $_REQUEST['user'];
		$email = $_REQUEST['email'];
		$pass = $_REQUEST['pwd'];
		$passConf = $_REQUEST['pwdConfirmation'];
		//TODO: validate properly	
		$error = null;
		$args = null;
		if($user === '' && $email === '' && $pass === '') {
			$error = 'missing';
		}
		//Check that pass === passConf
		if($pass === $passConf && $error === null) {
			try {
				registration($user, $pass, $email);
				header('Location: ' . $indexUrl);
				exit;
			} catch(DuplicateResourceException $e) {
				if($e->getCode() == 0) {
					$error = 'user';
					$args = $user;
				} else {
					$error = 'email';
					$args = $email;
				}
			} catch(Exception $e) {
				$error = 'unk';
			}
		}
	} else {
		//Set the sess var
	}
	include 'templates/_registration.php';
} else if(preg_match('"^(?:/prologes)?/(?:(?:forgotten)|(?:olvid))"', $uri)) {
	//forgotten
	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		//
		if(isset($_REQUEST['user']) && $_REQUEST['user'] !== '') {
			$user = $_REQUEST['user'];
			$call = authenticationlessCurlCall("POST", "public/passwordRequest", $user);
			// TODO: check that the call does not fail
			$sent = true;
		}
	} else {
		//
	}
	include 'templates/_forgotten.php';
} else if(preg_match('"^(?:/prologes)?/(?:(?:reset)|(?:restablecer))"', $uri)) {
	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		//
		if(isset($_REQUEST['token']) && isset($_REQUEST['pwd']) && isset($_REQUEST['pwdCnf'])) {
			//
			if($_REQUEST['pwd'] === $_REQUEST['pwdCnf']) {
				$call = authenticationlessCurlCall("POST", "public/passwordReset", array('token'=>$_REQUEST['token'], 'password'=>$_REQUEST['pwd']));
				//
				$code = $call[HTTP_STATUS];
				if($code != 200 && $code != 204) {
					include 'templates/_forgotten.php';
					exit;
				}
				$sent = true;
			}
		} else {
			//
			$error = '';
		}
	} else {
		//
	}
	include 'templates/_reset.php';
} else if(preg_match('"^(?:/prologes)?/(?:(?:user)|(?:usuario))"', $uri)) {
	$userid = null;
	$username = null;
	if(isset($requestUri['args'])) {
		$queryArgs = mapArgs($requestUri['args']);
		if(isset($queryArgs['i']) && $queryArgs['i'] != '') {
			$userid = $queryArgs['i'];
		}
	} else {
		preg_match('"^(?:/prologes)?/(?:(?:user)|(?:usuario))/(.*)$"', $uri, $nameQueryMatches);
		if(isset($nameQueryMatches[1])) {
			$username = urldecode($nameQueryMatches[1]);
		}
	}
	$content = 'templates/_user.php';
	include 'templates/__template.php';
} else if(preg_match('"^(?:/prologes)?/(?:(?:author)|(?:autor))"', $uri)) {
	$author = null;
	if(isset($requestUri['args'])) {
		$queryArgs = mapArgs($requestUri['args']);
		if(isset($queryArgs['i']) && $queryArgs['i'] != '') {
			$author = $queryArgs['i'];
		}
	} else {
		preg_match('"^(?:/prologes)?/(?:(?:author)|(?:autor))/(.*)$"', $uri, $authorQueryMatches);
		if(isset($authorQueryMatches[1])) {
			$author = urldecode($authorQueryMatches[1]);
		}
	}
	$content = 'templates/_author.php';
	include 'templates/__template.php';
} else if(preg_match('"^(?:/prologes)?/book"', $uri)) {
	//TODO:
	$book = null;
	if(isset($requestUri['args'])) {
		$queryArgs = mapArgs($requestUri['args']);
		if(isset($queryArgs['i']) && $queryArgs['i'] != '') {
			$book = $queryArgs['i'];
		}
	} else {
		preg_match('"^(?:/prologes)?/(?:(?:book)|(?:libro))/(.*)$"', $uri, $bookQueryMatches);
		if(isset($bookQueryMatches[1])) {
			$book = urldecode($bookQueryMatches[1]);
		}
	}
	$content = 'templates/_book.php';
	include 'templates/__template.php';

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

} else if(preg_match('"^(?:/prologes)?/(?:(?:profile)|(?:perfil))"', $uri)) {
	if($loggedIn) {
		if(isset($requestUri['args'])) {
			//checkl for e
			$queryArgs = mapArgs($requestUri['args']);
			if(isset($queryArgs['e'])) {
				$profileError = true;
			}
		}
		$content = 'templates/_profile.php';
		include 'templates/__template.php';
	} else {
		// Send a 401 or redirect to login
		header('Location: ' . BASE_DIR . 'index');
		exit;
	}

} else if(preg_match('"^(?:/prologes)?/(?:(?:library)|(?:biblioteca))"', $uri)) {
	if($loggedIn) {
		$content = 'templates/_mylibrary.php';
		include 'templates/__template.php';
	} else {
		header('Location: ' . BASE_DIR . 'index');
		exit;
	}

} else if(preg_match('"^(?:/prologes)?/privacy"', $uri)) {
	include 'templates/_building.php';
} else if(preg_match('"^(?:/prologes)?/about"', $uri)) {
	include 'templates/_building.php';
} else {
	//do a 500 or 404
	// echo "fail";
	include 'templates/_building.php';
}
?>