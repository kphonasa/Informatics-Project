<!--profile-->
<?php
//kicks users out if they are not logged in
	session_start();
	if (!isset($_SESSION['COOKIE']))
	{
		header('Location: selectSguest.php');
		exit;
	}
	if (!isset($_SESSION['STORE']))
	{
		header('Location: selectSguest.php');
		exit;
	}
?>
<?php
	include_once('config.php');
	include_once('dbutils.php');

	$title ="Shopping Cart";
	$h1 = "Shopping Cart";
	$menuActive=5;
	include_once("guestheader.php");
	$ID=$_GET['ID'];
?>
<div>
	<p>Are you sure you wish to remove this from your cart?</p>
</div>
<form action = "removeitemguest.php?ID=<?php echo $ID ?>" method="post">
	<button type ="submit" class="btn btn-default" name="confirm">Confirm</button>
	<button type ="submit" class="btn btn-default" name="cancel">Go Back</button>
</form>
<?php if (isset($_POST['confirm']))
	{
	$db=connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	$query = "DELETE FROM TEMP WHERE ID='" . $ID . "';";
	queryDB($query, $db);
	header('Location: guestcart.php');
	exit;}
	else if (isset($_POST['cancel']))
	{header('Location: guestcart.php');
	exit;}	
?>