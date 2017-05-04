<?php
	session_start();
	if (!isset($_SESSION['STORE']))
	{
		header('Location: selectSguest.php');
		exit;
	}
	if (!isset($_SESSION['COOKIE']))
	{
		header('Location: selectSguest.php');
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

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

	<style>
		body {
			background-image: url("https://webdev.cs.uiowa.edu/~kwang9/project/image/FoodBackground.jpg");
		}
	</style>
	
	</head>
	
	<body>
		
<?php
	include_once('config.php');
	include_once('dbutils.php');
?>
		
<?php
include_once("guestheader.php")
?>		
			<div class="jumbotron">
				<div class="row">
					<div class="col-sm-9 col-xs-12">
						<h1>Welcome to Hvyee !</h1>
					</div>
				</div>
			</div>
		
<HR>		
<!-- thumbnail icons /-->
		<div class="containter">			
			<div class="row">
						<?php											/*
						 *List all Productes that are in the DB
						 *
						 */    
						// connect to the DB
						$db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
						
						// set up a query to get infor on the cars from the DB
						$query = "SELECT * FROM PRODUCT WHERE STOREID='" . $_SESSION['STORE'] . "' order by RAND() LIMIT 4;";
						
						// run the query
						$result = queryDB($query, $db);
						
						
						while($row = nextTuple($result))
							{
								if ($row['IMAGE'])				
								{$imagelocation=$row['IMAGE'];
								$altText="product" . $row['PNAME'];
								echo '<div class="col-xs-3 col-md-3">';
								echo "<a href='Descriptionguest.php?ID=" . $row['ID'] . "'><img src='$imagelocation' width='150' height='150' alt=$altText'><BR>";}
								echo "<a href='Descriptionguest.php?ID=" . $row['ID'] . "'>" . $row['PNAME'] . "</a>";
								echo '</div>';
							}
						?>
				
			</div>	
		</div>
		
	



<?php
	include_once("footer.php");
?>
Contact GitHub API Training Shop Blog About
