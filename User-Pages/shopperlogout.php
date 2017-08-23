<?php
	//log user out by unsetting session variable called email and destroying the session
	$menuActive==6;
	session_start();
	if (isset($_SESSION['email']))
	{
		unset($_SESSION['email']);
	}
	session_destroy();
	
	header("Location: shopperlogin.php");
	exit;
?>