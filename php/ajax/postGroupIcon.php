<?php

session_start();

require('../commons.php');

function getImageName($seed) {
	return md5(uniqid($seed, true));
}

if(!isset($_SESSION[SID])) {
  // throw new 403
  http_response_code(403); // Forbidden
  die();
}

if (!isset($_REQUEST['club']) || $_REQUEST['club'] == '' || !isset($_REQUEST['img64'])) {
  http_response_code(400);
  die();
}

$club = $_REQUEST['club']; 

$base64 = $_REQUEST['img64'];

$file = AVATAR_LOC . getImageName($club) . '.png';
$data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64));
file_put_contents(RELATIVE_PATH . $file, $data);

// Save to server
// $request['field'] = 'avatar';
// $request['value'] = BASE_DIR . $file;

// $token = $_SESSION[TOKEN];

// $response = tokenCurlCall($token, "POST", "api/myservice/avatar", $request);
// $code = $response[HTTP_STATUS];
// if($code != 200 && $code != 204) {
// 	// print_r($response);die();
//   // header("Location: " . $internalErrorPage);
//   http_response_code(500);
// 	die();
// } else {
//   $result['url'] = BASE_DIR . $file;
//   print(json_encode($result));
// }
$wrapper['icon'] = BASE_DIR . $file;

$token = $_SESSION[TOKEN];
//$getUser = tokenCurlCall($accessToken, "GET", ME);
$response = tokenCurlCall($token, "POST", "api/clubs/".$club."/attributes", $wrapper);

$code = $response[HTTP_STATUS];
if($code != 200 && $code != 204) {
	http_response_code($code);
	$error = json_decode($response[RESPONSE], true);
	print( json_encode(array("code" => $code, "message" => $error['message'])) );
} else {
	//header('HTTP/1.1 204 No response', true, 204);die();
	print($response[RESPONSE]);
}
?>