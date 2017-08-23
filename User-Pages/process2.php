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

$db=connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
$query="SELECT * FROM USERS1 WHERE EMAIL='" . $_SESSION['email'] . "';";
$result = queryDB($query, $db);
while($row = nextTuple($result))
{
	$USERID=$row['ID'];
	$FNAME=$row['FNAME'];
	$LNAME=$row['LNAME'];
	$STREET=$row['STREET'];
	$CITY=$row['CITY'];
	$USSTATE=$row['USSTATE'];
	$ZIP=$row['ZIP'];
	$PHONE=$row['PHONE'];
	$CARDNAME=$row['CARDNAME'];
	$CARDNUMBER=$row['CARDNUMBER'];
	$EXMONTH=$row['EXMONTH'];
	$EXYEAR=$row['EXYEAR'];
	$CCV=$row['CCV'];
}

$db=connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	$queryx="INSERT INTO ORDERS (USERID, FNAME, LNAME, STREET, CITY, USSTATE, ZIP, PHONE, 
	STOREID, ORDERDATE, ORDERTIME, CARDNAME, CARDNUMBER, EXMONTH, EXYEAR, CCV, STATUS, TOTALP) VALUES ('" . $USERID . "', '" . $FNAME . "', 
	'" . $LNAME . "', '" . $STREET . "', '" . $CITY . "', '" . $USSTATE . "', '" . $ZIP . "', 
	'" . $PHONE . "', '" . $_SESSION['STORE'] . "', '" . $_SESSION['D'] . "', 
	'" . $_SESSION['T'] . "', '" . $CARDNAME . "', '" . $CARDNUMBER . "',
	'" . $EXMONTH . "', '" . $EXYEAR . "', '" . $CCV . "', 
	'ORDER PLACED', '" . $_SESSION['TOTALP'] . "') ;";;
	queryDB($queryx, $db);
	$remove="DELETE FROM TEMP WHERE EMAIL='" . $_SESSION['email'] . "';";
	queryDB($remove, $db);
	header('Location: cart.php');
		exit;
?>
