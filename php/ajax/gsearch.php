<?php

session_start();
require('../commons.php');

/*if(!isset($_SESSION[SID])) {
	//header('HTTP/1.1 401 Unauthorized', true, 401);
	http_response_code(401);//
	die("You must be logged in to access this resource");
}*/
define('MAX_LIMIT', '40');


if(!isset($_REQUEST['q'])) {
	http_response_code(400);
	echo "No query term set";
	die();
}

function getDetails($data) {
	$details = array();
	if(isset($data['volumeInfo']['description'])) $details['description'] = $data['volumeInfo']['description'];
	return json_encode($details);
}

$query = $_REQUEST['q'];
$row = isset($_REQUEST['start']) ? $_REQUEST['start'] : '0';
$limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : '50';
if($limit > MAX_LIMIT) $limit = MAX_LIMIT;

$gQuery = "https://www.googleapis.com/books/v1/volumes?q=".urlencode($query)."&maxResults=".$limit;
$gCall = file_get_contents($gQuery);
$gItems = json_decode($gCall, true);
$gResults = array();
if(isset($gItems['items'])) {
	foreach($gItems['items'] as $result) {
		//$book['author'] = isset($result['volumeInfo']['authors'][0])?$result['volumeInfo']['authors'][0]:'';
		$book['authors'] = isset($result['volumeInfo']['authors'])?$result['volumeInfo']['authors']:array();
		$book['title'] = isset($result['volumeInfo']['title'])?$result['volumeInfo']['title']:'';
		$book['lang'] = isset($result['volumeInfo']['language'])?$result['volumeInfo']['language']:'';
		$book['icon'] = isset($result['volumeInfo']['imageLinks']['thumbnail'])?$result['volumeInfo']['imageLinks']['thumbnail']:'';
		$book['thumbnail'] = isset($result['volumeInfo']['imageLinks']['smallThumbnail'])?$result['volumeInfo']['imageLinks']['smallThumbnail']:'';
		$book['details'] = getDetails($result);
		$book['q'] = $gQuery;
		
		$gResults[] = $book;
	}
}

print(json_encode($gResults));
?>
