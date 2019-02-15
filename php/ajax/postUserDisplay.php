<?php

session_start();

require('../commons.php');

if(!isset($_SESSION[SID])) {
  // throw new 403
  http_response_code(403); // Forbidden
  die();
}

$displayName = $_REQUEST['display'];

if($displayName === '') {
  http_response_code(500);
  die();
}

// Save to server
$request['field'] = 'name';
$request['value'] = $displayName;

$token = $_SESSION[TOKEN];

$response = tokenCurlCall($token, "POST", "api/myservice/displayname", $request);
$code = $response[HTTP_STATUS];
if($code != 200 && $code != 204) {
	// print_r($response);die();
  // header("Location: " . $internalErrorPage);
  http_response_code(500);
	die();
} else {
  $result['name'] = $displayName;
  print(json_encode($result));
}
?>