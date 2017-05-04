<html>
<head>
    <title><?php echo $title;?></title>
    
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


	<div class="container">
	<!--Container for all content to be displayed-->
		<div class="row">
			<div class="col-xs-12">
				<div class="page-header">
				<!--Header-->		
					<h1><b><?php echo $h1;?></b></font></h1>
				</div>
			</div>
		</div>
	</div>
	
	<nav class="navbar navbar-inverse">
		<div class="containter">
			<!--Menu-->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav nav-tabs">
					<li <?php if($menuActive==0){echo 'class="active"';}?>><a href="guesthome.php">Home</a></li>
					<li <?php if($menuActive==1){echo 'class="active"';}?>><a href="browsePguest.php">Browse Products</a></li>
					<li <?php if($menuActive==3){echo 'class="active"';}?>><a href="ordersguest.php">Orders</a></li>
					<li <?php if($menuActive==4){echo 'class="active"';}?>><a href="shopperlogin.php">Log in</a></li>
					<li <?php if($menuActive==5){echo 'class="active"';}?>><a href="guestcart.php">Shopping Cart</a></li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Category <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<?php
								include_once('config.php');
								include_once('dbutils.php');
								$db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);											
								// set up a query to get infor on the cars from the DB
								$query = 'SELECT DISTINCT CNAME FROM CATEGORY';											
										// run the query
								$result = queryDB($query, $db);											
								while($row = nextTuple($result))
								{
									echo "<li><a href='https://webdev.cs.uiowa.edu/~kwang9/project/browsePguest.php?CATEGORY=" . $row['CNAME'] . "'>" . $row['CNAME'] . "</a></li>";	
								}
							?>
						</ul>
					</li>
				
					<form action="get.php" method="get" class="navbar-form navbar-right" role="search">
						<div class="input-group add-on">
						  <input class="form-control" placeholder="Search for our products" name="srch-term" id="srch-term" type="text">
							<div class="input-group-btn">
							<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>							  </div>
						</div>
					</form>
				</ul>
			</div>
		</div>
	</nav>
