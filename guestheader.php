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
	
	<style>
		body  {
			background-color: hsl(120, 100%, 75%);;
			color: black;
			font-size: 20px;
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
				
				<h1><font color="black" face="Constantia" font size="24"><b><?php echo $h1;?></b></font></h1>
				</div>
			</div>
		</div>
        
		<div class="navbar navbar-inverse navbar-static-top">
			<div class="container-fluid">
				<div class="navbar-header">
				<!--Menu-->
					<div class="container fluid">
						<ul class="nav nav-pills">
							<li <?php if($menuActive==0){echo 'class="active"';}?>><a href="guesthome.php">Home</a></li>
							<li <?php if($menuActive==1){echo 'class="active"';}?>><a href="browsePguest.php">Browse Products</a></li>
							<li <?php if($menuActive==2){echo 'class="active"';}?>><a href="browseCguest.php">Browse Categories</a></li>
							<li <?php if($menuActive==3){echo 'class="active"';}?>><a href="ordersguest.php">Orders</a></li>
							<li <?php if($menuActive==4){echo 'class="active"';}?>><a href="inputUser.php">Register</a></li>
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
			</div>
		</div>
