<?php

/**
 * This is for the facebook login, do not commit
 * 
 */
$fb = new Facebook\Facebook([
	'app_id' => '1508878956086860',
	'app_secret' => '2ebff6035cdbf85b96157285447c7244',
	'default_graph_version' => 'v2.5'
]);

$appId = '1508878956086860';

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email'];
$loginUrl = $helper->getLoginUrl('http://localhost/prologes/php/fb-callback.php', $permissions);

?>
