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

$base64 = $_REQUEST['img64'];

$file = AVATAR_LOC . getImageName($_SESSION[USERNAME]) . '.png';
$data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64));
file_put_contents(RELATIVE_PATH . $file, $data);

// Save to server
$request['field'] = 'avatar';
$request['value'] = BASE_DIR . $file;

$token = $_SESSION[TOKEN];

$response = tokenCurlCall($token, "POST", "api/myservice/avatar", $request);
$code = $response[HTTP_STATUS];
if($code != 200 && $code != 204) {
	// print_r($response);die();
  // header("Location: " . $internalErrorPage);
  http_response_code(500);
	die();
} else {
  $result['url'] = BASE_DIR . $file;
  print(json_encode($result));
}
?>