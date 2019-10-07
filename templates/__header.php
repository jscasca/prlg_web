<?php
$rootpath = BASE_DIR;
?>
<meta charset="UTF-8">
<!-- Global site tag (gtag.js) - Google Analytics -->
<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-78449381-1"></script> -->
<script>
  /*window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-78449381-1');*/
</script>
<script type="text/javascript">
//Any additional header goes ehre
const ROOT_PATH = '/prologes/';
const IMG_ROOT = '/prologes/';

const DEFAULT_CLUB = ROOT_PATH + 'img/user_dark.png';
const DEFAULT_USER = ROOT_PATH + 'img/user_clear.png';
const DEFAULT_AUTHOR = ROOT_PATH + 'img/author_clear_trans.png';
</script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>-->

<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
<?php
$commonLibs = array(
	// "js/jquery.min.js",
	// "js/bootstrap.min.js",
	"js/commons.js",
	"js/jquery.raty.min.js"
);
for($i = 0; $i < count($commonLibs); $i++) {
	echo "<script src='".$rootpath . $commonLibs[$i]."'></script>\n";
}
if(isset($libraries) && sizeof($libraries) > 0) {
	for($i = 0; $i < sizeof($libraries); $i++) {
		echo "<script src='".$rootpath . $libraries[$i]."'></script>\n";
	}
}
$stylesheets = array(
	"css/bootstrap.min.css",
	// "css/font-awesome.min.css",
	"css/star-rating.min.css",
	"css/style.css",
	// "fa-free/css/all.css"

);
for($i = 0; $i < count($stylesheets); $i++) {
	echo "<link rel='stylesheet' href='".$rootpath . $stylesheets[$i]."'>\n";
}
?>
<!-- <script src="translator.js"></script> -->
<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<!-- Bootstrap -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<!-- Fav icon -->
<link rel="icon" type="image/png" href="<?php echo $rootpath;?>img/favicon.png" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.css">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<script type="text/javascript">
//Any additional header goes ehre
// const ROOT_PATH = '/prologes/';
// const IMG_ROOT = '/prologes/';
var translator = new Translator();

var getText = function(text) {
	return translator.getText(text);
}

var getSpan = function(name, args) {
	return translator.getSpan(name, args);
}

var createTextNode = function(text) {
	return document.createTextNode(getText(text));
}

var simpleTextNode = function(text) {
	return document.createTextNode(text);
}
</script>