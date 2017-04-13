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

	$title ="Shopping Cart";
	$h1 = "Shopping Cart";
	$menuActive=5;
	include_once("shopperheader.php");
?>
<?php
	include_once("footer.php");
?>