<!--browse categories-->
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

	$title ="Categories";
	$h1 = "Categories";
	$menuActive=2;
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
	<div class="col-xs-6">
		<div class="col-xs-12">
			<div id="container">
		
<form action = "browseC.php" method="post">
	<select class="form-control" style="width: 200" name="order" data-default-value=<?php $query ?>>
			<option selected disabled hidden>Order By:</option>
			<option value="SELECT CNAME FROM CATEGORY ORDER BY CNAME ASC;">A-Z</option>
			<option value="SELECT CNAME FROM CATEGORY ORDER BY CNAME DESC;">Z-A</option>
	</select><button type ="submit" class="btn btn-default" name="submit">Go</button>
</form>
	<table class='table table-hover'>


		<!--include config and util files-->
		<?php

		//connect to the database
		$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);

		//Set up the query to get information on the cars from the database
		
		
		//run the query

		if (isset($_POST['submit']))
		{$query = $_POST['order'];}
		else{$query ="SELECT * FROM CATEGORY ORDER BY CNAME ASC;";}
		$result= queryDB($query, $db);
				
		while($row = nextTuple($result))
		{
			echo'<tr>';
			echo "<td><a href='browseC2.php?ID=" . $row['ID'] . "'>" . $row['CNAME'] . "</a></td>";
			echo'</tr>';
		}
		?>
	</table>
<?php
	include_once("footer.php");
?>