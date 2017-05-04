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
	$ID=$_GET['ID'];
?>
<div>
	<p>Are you sure you wish to remove this from your cart?</p>
</div>
<form action = "removeitem.php?ID=<?php echo $ID ?>" method="post">
	<button type ="submit" class="btn btn-default" name="confirm">Confirm</button>
	<button type ="submit" class="btn btn-default" name="cancel">Go Back</button>
</form>
<?php if (isset($_POST['confirm']))
	{
	$db=connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	$query = "DELETE FROM TEMP WHERE ID='" . $ID . "';";
	queryDB($query, $db);
	header('Location: cart.php');
	exit;}
	else if (isset($_POST['cancel']))
	{header('Location: cart.php');
	exit;}	
?>