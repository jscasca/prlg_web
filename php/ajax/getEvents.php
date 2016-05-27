<?php

require('../commons.php');

$row = isset($_REQUEST['start']) ? $_REQUEST['start'] : '0';
$limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : '20';

$call = authenticationlessCurlCall(GET, "api/events/all", array('start'=>$row, 'limit'=>$limit));

http_response_code($call[HTTP_STATUS]);

print($call[RESPONSE]);
?>
