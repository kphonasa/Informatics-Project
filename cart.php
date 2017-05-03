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
<div class="container">
<h1>Your Shopping Cart</h1>
<table class='table table-hover'>
		<thead>
			<th>Products</th>
			<th>Quantity</th>
			<th>Price</th>
			<th></th>
		</thead>


		<!--include config and util files-->
		<?php

		//connect to the database
		$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
		//run the query
		$query="(SELECT * FROM TEMP);";
		$result= queryDB($query, $db);
			
		while($row = nextTuple($result))
		{
			echo'<tr>';
			echo '<td>' . $row['PNAME'] . '</td>';
			echo '<td>' . $row['QTY'] . '</td>';
			echo '<td>'; echo"$"; echo $row['PRICE'] . '</td>';
			echo '<td>'; echo"<form method='post' action='cart.php?ID=" . $row['ID'] . "'>"; echo"<button type ='submit' class='btn btn-default' name='remove'>Remove</button></form>";echo'</td>';
			echo'</tr>';
			if (isset($_POST['remove']))
			{
			$_SESSION['ID']=$_GET['ID'];
			header('Location: removeitem.php?ID=' . $_SESSION['ID'] . '');
			exit;
			}
		}
		
		?>
		
	</table>
	<table class='table table-hover'>
	<thead>
		<th>Total</th>
		</thead>
		<?php 
		$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
		//run the query
		$queryx="SELECT SUM(QTY*PRICE) AS GRAND_TOTAL FROM TEMP;";
		$resultx= queryDB($queryx, $db);
		while($row = nextTuple($resultx))
		{echo '<tr><td>';echo "$"; echo $row['GRAND_TOTAL']; echo '</tr></td>';}
		?>
	</table>
		<div class="container">
		<form action="cart.php" method="post">
			<div class="form-group">
			<button type="submit" class="btn btn-default" name="order">Place Order</button>
			</div>
		</form>
		</div>

	<?php if (isset($_POST['order']))
			{header('Location: placeorder.php');
			exit;} ?>
	</div>
<?php
	include_once("footer.php");
?>