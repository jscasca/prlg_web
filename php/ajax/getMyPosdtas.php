<?php
session_start();
require('../commons.php');

$token = $_SESSION[TOKEN];
//TODO: Implement on the server side
/*$call = tokenCurlCall($token, GET, "api/myservice/libraryView");
http_response_code($call[HTTP_STATUS]);
print($call[RESPONSE]);*/
echo '';
?>
