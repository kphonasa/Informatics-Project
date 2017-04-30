<!--shopper home-->

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
?>
<html>
	<head>
	<meta name="viewport" content="width=device-widthe, initial-scale-1.0">
    
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<style>
		body {
			background-image: url("https://webdev.cs.uiowa.edu/~kwang9/project/image/FoodBackground.jpg");
		}
	</style>


	</head>
	
	<body>
		
		<div class="container">
		<!--Container for all content to be displayed-->
			<div class="row">
				<div class="col-xs-12">
					<div class="page-header">
					<!--Header-->		
						<h1><b>Hvyee.com</b></font></h1>
					</div>
				</div>
			</div>
		</div>
		
		
			<div class="jumbotron">
				<div class="row">
					<div class="col-sm-9 col-xs-12">
						<h1>Welcome to Hvyee !</h1>
						<p><a class="btn btn-primary btn-lg" href="https://webdev.cs.uiowa.edu/~kwang9/project/shopperlogin.php" role="button">Login</a>&nbsp;<a class="btn btn-primary btn-lg" href="https://webdev.cs.uiowa.edu/~kwang9/project/browsePguest.php" role="button">Products</a>&nbsp;<a class="btn btn-primary btn-lg" href="https://webdev.cs.uiowa.edu/~kwang9/project/browseCguest.php" role="button">Categories</a>&nbsp;<a class="btn btn-primary btn-lg" href="https://webdev.cs.uiowa.edu/~kwang9/project/ordersguest.php" role="button">Orders</a>&nbsp;<a class="btn btn-primary btn-lg" href="https://webdev.cs.uiowa.edu/~kwang9/project/inputUser.php" role="button">Register</a>&nbsp;<a class="btn btn-primary btn-lg" href="https://webdev.cs.uiowa.edu/~kwang9/project/guestcart.php" role="button">Shopping Cart</a></p>
					</div>	
				</div>	
			</div>
		
		
<!-- thumbnail icons /-->
		<div class="containter">			
			<div class="row">
				<div class="col-xs-6 col-md-3">
					<a href="#" class="thumbnail">
						<?php											/*
						 *List all Productes that are in the DB
						 *
						 */    
						// connect to the DB
						$db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
						
						// set up a query to get infor on the cars from the DB
						$query = 'SELECT * FROM PRODUCT order by RAND() LIMIT 1';
						
						// run the query
						$result = queryDB($query, $db);
						
						
						while($row = nextTuple($result))
							{
								if ($row['IMAGE'])				
								{$imagelocation=$row['IMAGE'];
								$altText="product" . $row['PNAME'];
								echo "<img src='$imagelocation' width='150' height='150' alt=$altText'>";}
								echo "<td><a href='Description.php?ID=" . $row['ID'] . "'>" . $row['PNAME'] . "</a></td>";
							}
						?>
				  </a>
				</div>
				
				
				<div class="col-xs-6 col-md-3">
					<a href="#" class="thumbnail">
						<?php											/*
						 *List all Productes that are in the DB
						 *
						 */    
						// connect to the DB
						$db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
						
						// set up a query to get infor on the cars from the DB
						$query = 'SELECT * FROM PRODUCT order by RAND() LIMIT 1';
						
						// run the query
						$result = queryDB($query, $db);
						
						
						while($row = nextTuple($result))
							{
								if ($row['IMAGE'])				
								{$imagelocation=$row['IMAGE'];
								$altText="product" . $row['PNAME'];
								echo "<img src='$imagelocation' width='150' height='150' alt=$altText'>";}
								echo "<td><a href='Description.php?ID=" . $row['ID'] . "'>" . $row['PNAME'] . "</a></td>";
							}
						?>
				  </a>
				</div>
			
				<div class="col-xs-6 col-md-3">
					<a href="#" class="thumbnail">
						<?php											/*
						 *List all Productes that are in the DB
						 *
						 */    
						// connect to the DB
						$db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
						
						// set up a query to get infor on the cars from the DB
						$query = 'SELECT * FROM PRODUCT order by RAND() LIMIT 1';
						
						// run the query
						$result = queryDB($query, $db);
						
						
						while($row = nextTuple($result))
							{
								if ($row['IMAGE'])				
								{$imagelocation=$row['IMAGE'];
								$altText="product" . $row['PNAME'];
								echo "<img src='$imagelocation' width='150' height='150' alt=$altText'>";}
								echo "<td><a href='Description.php?ID=" . $row['ID'] . "'>" . $row['PNAME'] . "</a></td>";
							}
						?>
				  </a>
				</div>

				<div class="col-xs-6 col-md-3">
					<a href="#" class="thumbnail">
						<?php											/*
						 *List all Productes that are in the DB
						 *
						 */    
						// connect to the DB
						$db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
						
						// set up a query to get infor on the cars from the DB
						$query = 'SELECT * FROM PRODUCT order by RAND() LIMIT 1';
						
						// run the query
						$result = queryDB($query, $db);
						
						
						while($row = nextTuple($result))
							{
								if ($row['IMAGE'])				
								{$imagelocation=$row['IMAGE'];
								$altText="product" . $row['PNAME'];
								echo "<img src='$imagelocation' width='150' alt=$altText'>";}
								echo "<td><a href='Description.php?ID=" . $row['ID'] . "'>" . $row['PNAME'] . "</a></td>";
							}
						?>
				  </a>
				</div>
				
			</div>	
		</div>
		
	



<?php
	include_once("footer.php");
?>
