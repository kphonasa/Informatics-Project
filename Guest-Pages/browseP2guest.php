<!--browse products-->
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
	$title ="Products";
	$h1 = "Products";
	$menuActive=1;
	include_once("guestheader.php");
?>

<?php
	$ID=$_GET['ID'];
	$QTY=$_SESSION['QTY'];
	$queryx="SELECT PNAME, PRICE FROM PRODUCT WHERE ID='" . $ID . "';";
	$db= connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	$solution=queryDB($queryx,$db);
	while($row = nextTuple($solution)){
		$query="INSERT INTO TEMP(PNAME, PRODUCTID, QTY, PRICE, COOKIE) VALUES ('" . $row['PNAME'] . "','" . $ID . "','" . $QTY . "','" . $row['PRICE'] . "','" . $_SESSION['COOKIE'] . "');";
		//get a handle to database
		$db= connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
		//run the insert statement
		queryDB($query,$db);
		
	}	
		header('Location: browsePguest.php');
		exit;
	//
?>