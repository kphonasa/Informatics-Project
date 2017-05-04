<!--orders-->
<?php
	include_once('config.php');
	include_once('dbutils.php');

	$title ="Orders";
	$h1 = "Orders";
	$menuActive=3;
	include_once("guestheader.php");
?>

<div class="container">
<form action="ordersguest.php" method="post">
<!--maker-->
<div class="form-group">
<div class="form-group">
	<label for="check">Enter your confirmation number:</label>
	<input type="text" style="width: 500" class="form-control" name="check"/>
</div>

<div>
	<button type="submit" class="btn-btn-default" name="submit">Select</button>
</div>
</form>
</div>
<?php
if (isset($_POST['submit']))
{	$db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
	$query="SELECT * FROM ORDERS WHERE ID='" . $_POST['check'] . "';";
	$result=queryDB($query, $db);
	echo'<table class="table table-hover"><thead><th>Order ID</th><th>Order scheduled for</th><th></th><th>Order Status</th></thead>';
	while($row = nextTuple($result))
		{
			echo'<tr>';
			echo '<td>' . $row['ID'] . '</td>';
			echo '<td>' . $row['ORDERDATE'] . '</td>';
			echo '<td>' . $row['ORDERTIME'] . '</td>';
			echo '<td>' . $row['STATUS'] . '</td>';
			echo'</tr>';
		}
	echo'</table>';
}
?>
<?php 	include_once("footer.php");?>