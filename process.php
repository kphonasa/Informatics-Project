<!--profile-->
<?php
//kicks users out if they are not logged in
	session_start();
	if (!isset($_SESSION['email']))
	{
		header('Location: shopperlogin.php');
		exit;
	}
		if (!isset($_SESSION['STORE']))
	{
		header('Location: selectS.php');
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
	if(!$_SESSION['CARDNAME'])
	{
		header('Location: process2.php');
		exit;
	}
	else
	{
		
	}
?>
