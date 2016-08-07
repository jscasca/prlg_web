<?php
session_start();
include 'php/commons.php';
//if(!isset($_SESSION[SID]))die($_SESSION[SID]);
if(isset($_SESSION['lang'])) {
	//$_SESSION['lang'] = 'es';
} else {
	//Get the lang
	$lang = getLang($_SERVER);
	//Set the lang
	$_SESSION['lang'] = $lang;
}
header('Location: '.$_SESSION['lang'].'/index.php');
?>