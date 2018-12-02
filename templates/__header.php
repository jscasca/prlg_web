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
</script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>-->
<?php
$commonLibs = array(
	"js/jquery.min.js",
	"js/bootstrap.min.js",
	"js/commons.js",
	"js/jquery.raty.min.js");
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
	"css/font-awesome.min.css",
	"css/star-rating.min.css",
	"css/style.css",
	"fa-free/css/all.css"

);
for($i = 0; $i < count($stylesheets); $i++) {
	echo "<link rel='stylesheet' href='".$rootpath . $stylesheets[$i]."'>\n";
}
?>
<!-- <script src="translator.js"></script> -->
<link rel="icon" type="image/png" href="<?php echo $rootpath;?>img/favicon.png" />
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">-->
<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->
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
</script>