<?php
  //
require('../commons.php');

if(!isset($_REQUEST['title'])) {
	http_response_code(400);
	echo "No query term set";
	die();
}

$title = $_REQUEST['title'];
$author = isset($_REQUEST['author']) ? $_REQUEST['author'] : '';

$call = authenticationlessCurlCall(GET, "https://scrounge.prologes.com/scrounger/bookprices", array('title'=>$title, 'author'=>$author));

http_response_code($call[HTTP_STATUS]);

print($call[RESPONSE]);

// $title = 'El Hobbit';
// $author = 'Tolkien';

// $ip = getIpAddr();

// // example: https://api.bookdepository.com/search/books?clientId=[clientId]&authenticationKey=[authKey]&IP=[ipAddress]&keywords=eclipse&author=meyer

// function getCall($url) {
// 	$curl = curl_init();
// 	$headers = [];
// 	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
// 	curl_setopt($curl, CURLOPT_URL, $url);
// 	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
// 	return executeCurl($curl);
// }
// function executeThisCurl($curl) {
// 	$result = curl_exec($curl);
// 	$http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
// 	$curl_errno = curl_errno($curl);
// 	$response = array();
// 	$response[HTTP_STATUS] = $http_status;
//   $response[CURL_ERRNO] = $curl_errno;
//   $response[RESPONSE] = $result;
// 	curl_close($curl);
// 	return $response;
// }

// function concatenateParams($assoc) {
//   $params = [];
//   foreach($assoc as $k => $v) {
//     array_push($params, $k . '=' . urlencode($v));
//   }
//   return implode('&', $params);
// }

// /*

// Client Id:a688d457
// Affiliate Id:prologes
// API Key:0b08b0be558f829bdce0dd25f5d341d138bdf8b5
// */

// //https://api.bookdepository.com/search/comingsoon?clientId=a688d457&authenticationKey=0b08b0be558f829bdce0dd25f5d341d138bdf8b5&IP=127.0.0.1

// //https://api.bookdepository.com/search/books?clientId=a688d457&authenticationKey=0b08b0be558f829bdce0dd25f5d341d138bdf8b5&IP=127.0.0.1&title=El%20Hobbit&author=Tolkien

// function getNewIpAddr() {
//   return '127.0.0.1';
// }

// function getUrl($client, $key, $ip, $title, $author) {
//   $params = array(
//     'clientId'=>$client,
//     'authenticationKey'=>$key,
//     'IP'=>$ip,
//     'title'=>$title,
//     'author'=>$author,
//     'currencies'=>'USD,AUD,CAD,NZD,GBP,EUR,MXN',
//     'images'=>'small,medium,large'
//   );
//   $urlparams = concatenateParams($params);
//   return 'https://api.bookdepository.com/search/books?' . $urlparams;
// }
// $url = getUrl('a688d457', '0b08b0be558f829bdce0dd25f5d341d138bdf8b5', getNewIpAddr(), $title, $author);
// // $response = getCall($url);
// // print($url);
// // file_put_contents('sample.xml', $response[RESPONSE]);

// // CALL ^^^^^^

// // PARSE >>>>

// function parseItems($items) {
//   // parse items
//   $response = array();
//   foreach($items->children() as $item) {
//     $book = array();
//     if ($item->url[0]['type'] == 'direct') {
//       $book['url'] = (string)$item->url[0];
//     }
//     if ($item->biblio[0]->title) {
//       $book['title'] = (string) $item->biblio[0]->title;
//     }
//     foreach($item->images as $img) {
//       // var_dump($img);
//       foreach($img->children() as $i) {
//         // var_dump($i['name']);
//         $book['img'][(string)$i['name']] = (string)$i;
//       }
//     }
//     foreach($item->pricing as $pricing) {
//       foreach($pricing->children() as $p) {
//         $book['price'][(string)$p['currency']]['retail'] = (string)$p->retail;
//         $book['price'][(string)$p['currency']]['sale'] = (string)$p->selling;
//         // if selling price (on sale)
//       }
//     }
//     // print_r($book);
//     $response[] = $book;
//   }
//   return $response;
// }

// $xmlString = file_get_contents('sample.xml');

// $xml = simplexml_load_string($xmlString);

// $response = array();
// if ($xml->resultset[0]->status['code'] == '1') {
//   $response = json_encode(parseItems($xml->items));
//   print($response);
// } else {
//   print('failure');
// }
// // $json = json_encode($xml);
// // $arr = json_decode($json, true);

// // print_r($arr);
// // print($json);


?>