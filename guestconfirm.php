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
	$query="SELECT MAX(ID) FROM ORDERS;";
			$result=queryDB($query, $db);
			while($row = nextTuple($result))
			{$row['ID']=$_SESSION['CONFIRM'];}
	echo '<div><strong> <p>';echo "Thank you for your purchase! Your confirmation number is:"; echo (number_format($row['ID'])); echo '</p></strong></div>';
?>
