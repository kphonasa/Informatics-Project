<!--browse categories-->
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

	$title ="Categories";
	$h1 = "Categories";
	$menuActive=2;
	include_once("shopperheader.php");
?>

<?php
	$ID=$_GET['ID'];
	$CID=$_GET['CID'];
	$QTY=$_SESSION['QTY'];
	$queryx="SELECT PNAME, PRICE FROM PRODUCT WHERE ID='" . $ID . "';";
	$db= connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	$solution=queryDB($queryx,$db);
	while($row = nextTuple($solution)){
		$query="INSERT INTO TEMP(PNAME, PRODUCTID, QTY, PRICE, EMAIL) VALUES ('" . $row['PNAME'] . "','" . $ID . "','" . $QTY . "','" . $row['PRICE'] . "','" . $_SESSION['email'] . "');";
		//get a handle to database
		$db= connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
		//run the insert statement
		queryDB($query,$db);
		
	}	
		header('Location: browseP.php');
		exit;
?>