<?php
	session_start();
	$allowed_lang = array('en' , 'fa');
	if(isset($_GET['lang']) === true && in_array($_GET['lang'], $allowed_lang) === true){
		$_SESSION['lang'] = $_GET['lang'];
	} else if (isset($_SESSION['lang']) === false) {
		$_SESSION['lang'] = 'fa';
	}
	//include 'lang/' . $_SESSION['lang'] . '.php';

	$db = mysqli_connect('127.0.0.1', 'root', 'waisjan', 'fumis');

	if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
	}
	if (!mysqli_set_charset($db, "utf8")) {
	    printf("Error loading character set utf8: %s\n", mysqli_error($db));
	    exit();
		}
	define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/mis/');
?>
