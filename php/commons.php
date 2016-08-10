<?php
//IMPORTS
require 'exceptions.php';
//WEB CLIENT CREDENTIALS (CHANGE FOR PRODUCTIVE)
define('CLIENT_ID', 'webApp');
define('CLIENT_SECRET', 'web123');
//FRONT_END SERVER
define('BASE_DIR', '/prologes/');
define('RELATIVE_PATH','../../');
define('AVATAR_LOC', 'img/avatar/');
//Addresses to be used as $url = BASE_DIR . $lang . $URL;
define('URL_PROFILE', 'profile.php');
define('URL_BOOK', 'book.php');
define('URL_INTERNAL_SERVER_ERROR', '500.html');
define('URL_NOT_FOUND', '404.html');
define('URL_INDEX', 'index.php');
define('URL_LOGIN', 'login.php');
define('URL_REGISTRATION', 'registration.php');
//BACK_END SERVER (CHANGE FOR PRODUCTIVE)
//define('REST_API','http://209.177.158.134:8080/posdta/');
//define('REST_API','http://localhost:8080/posdta/');
define('REST_API','http://localhost:8080/posdta/');
//SERVER PATHS
define('TOKEN_URL', 'oauth/token');
define('ME', 'api/myservice');
define('API_SEARCH_ANYTHING', 'api/search/anything');
//CONSTANTS
//session context
define('LANG', 'lang');
//session
define('SID','user_id');
define('ICON','user_icon');
define('DISPLAY_NAME','user_display');
define('USERNAME','user_name');
define('TOKEN','user_token');
define('REFRESH','user_refresh');
//curl calls
define('HTTP_STATUS', 'http_status');
define('CURL_ERRNO', 'curl_errno');
define('RESPONSE', 'response');
//http method
define('POST', 'POST');
define('GET', 'GET');
define('PUT', 'PUT');
define('DELETE', 'DELETE');
define('USERNAME_REGEX', '#^[a-zA-Z0-9_]{1,24}$#');
define('EMAIL_REGEX', '#^[_A-Za-z0-9-\\+]+(\\.[_A-Za-z0-9-]+)*@[A-Za-z0-9-]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})$#');
define('PROVIDER_REGEX', '#^[_A-Za-z0-9-\\+]+(\\.[_A-Za-z0-9-]+)*@[A-Za-z0-9-]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})$#');
define('JSON_START', '{');
define('JSON_END', '}');
define('XML_START', '<');
define('XML_END', '>');
/********************FUNCTIONS********************************/ 
/**
 * Calls for a token an sets it in the session variables
 * May throw exceptions
 */
function logIn($username, $password) {
	$logIn = getToken(CLIENT_ID, CLIENT_SECRET, $username, $password);
	//print_r($logIn);die("ON LOGIN");
	$logInInfo = json_decode($logIn[RESPONSE], true);
	$accessToken = $logInInfo["value"];
	$refreshToken = $logInInfo["refreshToken"];
	$getUser = tokenCurlCall($accessToken, "GET", ME);
	if($getUser[HTTP_STATUS] != 200) {
		throw new Exception("User access failed");
	}
	$userInfo = json_decode($getUser[RESPONSE], true);
	//print_r($userInfo);die("SESSION START");
	//Void function, sets the values in session vars
	$_SESSION[SID] = $userInfo['id'];
	$_SESSION[ICON] = $userInfo['icon'];
	$_SESSION[DISPLAY_NAME] = $userInfo['displayName'];
	$_SESSION[USERNAME] = $userInfo['userName'];
	$_SESSION[TOKEN] = $logInInfo['value'];
	$_SESSION[REFRESH] = $logInInfo['refreshToken'];
}

function registration($username, $password, $email) {
	$call = authenticationlessCurlCall("POST", "public/registration", array("username" => $username, "email" => $email, "password" => $password));
	if($call[HTTP_STATUS] == 200) {
		//Try to log in
		logIn($username, $password);
	} else if($call[HTTP_STATUS] == 409){
		//Duplicate resources
		//TODO: make coherent error codes
		$code = 0;
		$exception = json_decode($call[RESPONSE], true);
		if(startsWith($exception["message"], "User")){
			throw new DuplicateResourceException("The username already exists", 0);
		} else {
			throw new DuplicateResourceException("The email address already exists", 1);
		}
	} else {
		throw new RemoteServerError("Token request failed", $call[HTTP_STATUS]);
	}
}
/**
 * Refreshes the token and sets it in the session vars
 * 
 */
function updateToken($token) {
	try {
		$response = refreshToken(CLIENT_ID, CLIENT_SECRET, $token);
		
	} catch(Exception $e) {
		
	}
}
/**
 * Refreshes the token and cleans it from the vars (also cleans the session vars)
 */
function logout($token) {
	
}
/**
 * Refreshes the token and sets it in the session vars
 * 
 * returns an access token
 * {"value":"xxxx","expiration":000,"tokenType":"bearer","refreshToken":{"value":"xxxx","expiration":000},"scope":[],"additionalInformation":{},"expiresIn":000,"expired":false} 
 */
function refreshToken($clientId, $clientSecret, $token) {
	//http://localhost:8080/Posdta/oauth/token?grant_type=refresh_token&refresh_token=48b527bc-2614-46c9-bfc0-d5c7961a0212" -H "Accept: application/json"
	$tokenParams = "?grant_type=refresh_token&refresh_token=" . $token;
	$response = basicCurlCall($clientId, $clientSecret, "POST", TOKEN_URL . $tokenParams);
	if($response[HTTP_STATUS] != 200) {
		throw new Exception("Token request failed", $response[HTTP_STATUS]);
	}
	return $response;
}
/**
 * 
 * 
 * returns an access token
 * {"value":"xxxx","expiration":000,"tokenType":"bearer","refreshToken":{"value":"xxxx","expiration":000},"scope":[],"additionalInformation":{},"expiresIn":000,"expired":false} 
 */
function getToken($clientId, $clientSecret, $username, $pass) {
	//if(!preg_match(USERNAME_REGEX, $username) && !preg_match(EMAIL_REGEX, $username)) throw new Exception("Invalid username", 1);
	$tokenParams = "?grant_type=password&username=" . $username . "&password=" . urlencode($pass);
	$response = basicCurlCall($clientId, $clientSecret, "POST", TOKEN_URL . $tokenParams);
	if($response[HTTP_STATUS] != 200) {
		//print_r($response);die("DEAD: On get token");
		throw new Exception("Token request failed", $response[HTTP_STATUS]);
	}
	return $response;
}
function authenticationlessCurlCall($method, $url, $data = false) {
	$url = REST_API . $url;
	$curl = curl_init();
	$headers = [];
	switch($method) {
		case "POST":
			curl_setopt($curl, CURLOPT_POST, 1);
			if($data) {
				$data_string = $data;
				if(is_array($data)) {
					$data_string = json_encode($data);
				}
				$headers[] = "Content-Type: application/json";
				$headers[] = "Content-Length: ".strlen($data_string);
				//curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Content-Length:".strlen($data_string)));
				curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
			}
			break;
		case "PUT":
			curl_setopt($curl, CURLOPT_PUT, 1);
			break;
		default:
			if($data) {
				$url = sprintf("%s?%s", $url, http_build_query($data));
			}
	}
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	return executeCurl($curl);
}
function basicCurlCall($user, $password, $method, $url, $data = false) {
	$url = REST_API . $url;
	$curl = curl_init();
    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data) {
                curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:application/json"));
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			}
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }
    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, $user . ":" . $password);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    return executeCurl($curl);
}
function tokenCurlCall($token, $method, $url, $data = false) {
	$url = REST_API . $url;
	$curl = curl_init();
	$headers = [];
	$headers[] = "Authorization: Bearer " . $token;
	switch($method) {
		case "POST":
			curl_setopt($curl, CURLOPT_POST, 1);
			if($data) {
				$data_string = $data;
				if(is_array($data)) {
					$data_string = json_encode($data);
				}
				$headers[] = "Content-Type: application/json";
				$headers[] = "Content-Length: ".strlen($data_string);
				curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
			}
			/*if($data) {
				$headers[] = "Content-Type: application/json";
				curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			}*/
			break;
		case "PUT":
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
			if($data) {
				$data_string = $data;
				if(is_array($data)) {
					$data_string = json_encode($data);
				}
				curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: '.strlen($data_json)));
				curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
			}
			break;
		case "DELETE":
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
			break;
		default: 
			if($data) {
				$url = sprintf("%s?%s", $url, http_build_query($data));
			}
	}
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    return executeCurl($curl);
}
function executeCurl($curl) {
	$result = curl_exec($curl);
	$http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	$curl_errno = curl_errno($curl);
	$response = array();
	$response[HTTP_STATUS] = $http_status;
	$response[CURL_ERRNO] = $curl_errno;
	/*if(startsWith($result, JSON_START) && endsWith($result, JSON_END)) {
		$response[RESPONSE] = json_decode($result, true);
	} else if(startsWith($result, XML_START) && endsWith($result, XML_END)) {
		$response[RESPONSE] = "";
	} else {
		$response[RESPONSE] = $result;
	}*/$response[RESPONSE] = $result;
	curl_close($curl);
	return $response;
}
function startsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}
function endsWith($haystack, $needle) {
    // search forward starting from end minus needle length characters
    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
}

function getLang($server) {
	$default = 'en';
	$accepted = array('en'=>'en','es'=>'es');
	$langs = array();
	if(isset($server['HTTP_ACCEPT_LANGUAGE'])) {
		preg_match_all('/([a-z]{1,8}(-[a-z]{1,8})?)\s*(;\s*q\s*=\s*(1|0\.[0-9]+))?/i', $_SERVER['HTTP_ACCEPT_LANGUAGE'], $lang_parse);
		if(count($lang_parse[1])) {
			$langs = array_combine(($lang_parse[1]), $lang_parse[4]);
		}
		// set default to 1 for any without q factor
        foreach ($langs as $lang => $val) {
            if ($val === '') $langs[$lang] = 1;
        }
        // sort list based on value	
        arsort($langs, SORT_NUMERIC);
        print_r($langs);
	}
	foreach($langs as $lang => $val) {
		$l = substr($lang, 0, 2);
		if(array_key_exists($l, $accepted)) {
			return $accepted[$l];
		}
	}
	return $default;
}
?>
