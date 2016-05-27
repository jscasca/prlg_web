<?php
session_start();
require('../commons.php');

$token = $_SESSION[TOKEN];
$call = tokenCurlCall($token, GET, "api/myservice");

http_response_code($call[HTTP_STATUS]);

print($call[RESPONSE]);
?>
