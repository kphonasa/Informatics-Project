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
		else{$query ="SELECT CNAME FROM CATEGORY ORDER BY CNAME ASC;";}
		$result= queryDB($query, $db);
				
		while($row = nextTuple($result))
		{
			echo'<tr>';
			echo '<td>' . $row['CNAME'] . '</td>';
			echo'</tr>';
		}
		?>
	</table>
<?php
	include_once("footer.php");
?>