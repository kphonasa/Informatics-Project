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
<h1>Your Shopping Cart</h1>
<table class='table table-hover'>
		<thead>
			<th>Products</th>
			<th>Quantity</th>
			<th>Price</th>
		</thead>


		<!--include config and util files-->
		<?php

		//connect to the database
		$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
		//run the query
		$query="(SELECT PNAME, QTY, PRICE FROM TEMP WHERE ID=1);";
		$result= queryDB($query, $db);
			
		while($row = nextTuple($result))
		{
			echo'<tr>';
			echo '<td>' . $row['PNAME'] . '</td>';
			echo '<td>' . $row['QTY'] . '</td>';
			echo '<td>' . $row['PRICE'] . '</td>';
			echo'</tr>';
		}

		?>
		
	</table>
<?php
	include_once("footer.php");
?>