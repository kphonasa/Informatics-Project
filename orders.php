
<!--orders-->
<?php
//kicks users out if they are not logged in
	session_start();
	if (!isset($_SESSION['email']))
	{
		header('Location: shopperlogin.php');
		exit;
	}
	if (!isset($_SESSION['id']))
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

?>
<table class='table table-hover'>
		<thead>
			<th>Image</th>
			<th>Order ID</th>
			<th>Order scheduled for</th>
			<th>Order Status</th>
		</thead>


		<!--include config and util files-->
		<?php
		//connect to the database
		include_once('config.php');
		include_once('dbutils.php');
		$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
		//run the query
		$email=$_SESSION['email'];
		$id=$_SESSION['id'];
		$email=makeStringSafe($db,$email);
		$query="SELECT * FROM ORDERS,PRODUCT WHERE ORDERS.PRODUCTID=PRODUCT.ID AND USERID=$id;";
		$result= queryDB($query, $db);
			
		while($row = nextTuple($result))
		{
			echo'<tr>';
			echo "<td>";
			if ($row['IMAGE']) {
            $imageLocation = $row['IMAGE'];
            $altText = 'PRODUCT' . $row['PNAME'];
            echo "<img src='$imageLocation' width='150' alt='$altText'>";
			}
			echo "</td>";
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
