<!--orders-->
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

	$title ="Orders";
	$h1 = "Orders";
	$menuActive=3;
	include_once("shopperheader.php");
?>
<?php 
$db=connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
$query = "CREATE TABLE IF NOT EXISTS TEMP(
	ID INT NOT NULL AUTO_INCREMENT,
	PNAME VARCHAR(128) NOT NULL,
	PRODUCTID INT NOT NULL,
	QTY INT NOT NULL,
	PRICE INT NOT NULL,
	PRIMARY KEY(ID));";
queryDB($query, $db);
?>
<table class='table table-hover'>
		<thead>
			<th>Order ID</th>
			<th>Order scheduled for</th>
			<th>Order Status</th>
		</thead>


		<!--include config and util files-->
		<?php

		//connect to the database
		$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
		//run the query
		$email=($_SESSION['email']);
		$email=makeStringSafe($db,$email);

		$query="(SELECT ORDERS.ID, ORDERS.ORDERDATE, ORDERS.STATUS FROM ORDERS INNER JOIN USERS1 ON ORDERS.USERID=USERS1.ID WHERE USERS1.EMAIL='" . $email . "');";
		$result= queryDB($query, $db);
			
		while($row = nextTuple($result))
		{
			echo'<tr>';
			echo '<td>' . $row['ID'] . '</td>';
			echo '<td>' . $row['ORDERDATE'] . '</td>';
			echo '<td>' . $row['STATUS'] . '</td>';
			echo'</tr>';
		}

		?>
		
	</table>
<?php
	include_once("footer.php");
?>