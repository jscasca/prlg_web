<?php

session_start();

require('../commons.php');

$lang = $_SESSION[LANG].'/';

$internalErrorPage = BASE_DIR . $lang . URL_INTERNAL_SERVER_ERROR;

if(!isset($_SESSION[SID])) {
	//header('HTTP/1.1 401 Unauthorized', true, 401);
	//http_response_code(401);//
	//die("You must be logged in to access this resource");
	//Redirect to 401 page
	header("Location: " . $internalErrorPage);
	die();
}

if(!isset($_FILES['avatar'])) {
	//There was no file
	failOn("000");
}

if($_FILES['avatar']['size'] > (1024000)) {
	//File too large
	failOn("001");
}

$check = getimagesize($_FILES['avatar']['tmp_name']);
if($check === false) {
	//File is not an image
	failOn("002");
}

//Check either $check['mime'] or $_FILES['avatar']['type'] for the type
//Check mime size

$imgname = getImageName($_SESSION[USERNAME]);
$ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
$image = null;
switch($ext) {
	case 'jpg': case 'jpeg':
	//do the exif stuff
		$image = imagecreatefromjpeg($_FILES['avatar']['tmp_name']);
		//do the exif orientation
		/*
		$img = imagecreatefromjpeg($filename);
        $exif = exif_read_data($filename);
        if ($img && $exif && isset($exif['Orientation']))
        {
            $ort = $exif['Orientation'];

            if ($ort == 6 || $ort == 5)
                $img = imagerotate($img, 270, null);
            if ($ort == 3 || $ort == 4)
                $img = imagerotate($img, 180, null);
            if ($ort == 8 || $ort == 7)
                $img = imagerotate($img, 90, null);

            if ($ort == 5 || $ort == 4 || $ort == 7)
                imageflip($img, IMG_FLIP_HORIZONTAL);
        }
        return $img;
		*/
		break;
	case 'gif':
		$image = imagecreatefromgif($_FILES['avatar']['tmp_name']);
		break;
	case 'png':
		$image = imagecreatefrompng($_FILES['avatar']['tmp_name']);
		break;
}

if($image == null) {
	//die with exception
	die('Image null');
}

$imagelocation = AVATAR_LOC . $imgname . '.png';
imagepng($image, RELATIVE_PATH . $imagelocation);

// $target = AVATAR_LOC.$_SESSION[USERNAME];
// move_uploaded_file($_FILES['avatar']['tmp_name'], RELATIVE_PATH.$target);

$request['field'] = 'avatar';
$request['value'] = BASE_DIR . $imagelocation;

$token = $_SESSION[TOKEN];

$response = tokenCurlCall($token, "POST", "api/myservice/avatar", $request);
$code = $response[HTTP_STATUS];
if($code != 200 && $code != 204) {
	print_r($response);die();
	header("Location: " . $internalErrorPage);
	die();
} else {
	header('Location: ' . BASE_DIR . 'profile'); die();
}

function failOn($code) {
	header("Location: " . BASE_DIR ."profile?e=".$code);
	die();
}

function getImageName($seed) {
	return md5(uniqid($seed, true));
}

?>
