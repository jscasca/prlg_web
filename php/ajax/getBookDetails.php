<?php

require('../commons.php');

if(!isset($_REQUEST['book'])) {
	http_response_code(400);
	echo "No query term set";
	die();
}

// First get the details
$bookId = $_REQUEST['book'];

$call = authenticationlessCurlCall("GET", "api/books/".$bookId."/details");

if($call[HTTP_STATUS] != 200) {
  http_response_code($call[HTTP_STATUS]);
  die();
}
$currentDetails = json_decode($call[RESPONSE], true);
// Validate the current details
// var_dump($currentDetails);
if(!isset($currentDetails['description'])) {
  // google/scrounge it and save

  // And update current details
}

print(json_encode($currentDetails));
?>