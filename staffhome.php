<!--staff home-->
<?php
	include_once('config.php');
	include_once('dbutils.php');
?>

<?php
//kicks users out if they are not logged in
	session_start();
	if (!isset($_SESSION['email']))
	{
		header('Location: stafflogin.php');
		exit;
	}
?>

<html>
</html>