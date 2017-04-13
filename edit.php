<!--profile-->
<?php
//kicks users out if they are not logged in
	session_start();
	if (!isset($_SESSION['email']))
	{
		header('Location: shopperlogin.php');
		exit;
	}
?>
<?php
	include_once('config.php');
	include_once('dbutils.php');

	$title ="Profile";
	$h1 = "Profile";
	$menuActive=4;
	include_once("shopperheader.php");
?>