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
<div>
	<p>Are you sure you wish to delete your account?</p>
</div>
<form action = "deleteuser.php" method="post">
	<button type ="submit" class="btn btn-default" name="confirm">Confirm</button>
	<button type ="submit" class="btn btn-default" name="cancel">Go Back</button>
</form>
<?php if (isset($_POST['confirm']))
	{
	$db=connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	$query = "DELETE FROM USERS1 WHERE EMAIL='" . $_SESSION['email'] . "';";
	$result = queryDB($query, $db);
	header('Location: shopperlogin.php');
	exit;}
	else if (isset($_POST['cancel']))
	{header('Location: profile.php');
	exit;} 
?>
<?php
	include_once("footer.php");
?>