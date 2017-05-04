<html>
<head>
    <title><?php echo $title;?></title>
    
    <neta name="viewport" content="width=device-widthe, initial-scale-1.0">
    
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
</head>


    <div class="container">
		<!--Container for all content to be displayed-->
		<div class="row">
			<div class="col-xs-12">
				<div class="page-header">
				<!--Header-->
				
				<h1><font color="black" face="Constantia" font size="24"><b><?php echo $h1;?></b></font></h1> 
			</div>
		</div>
        
		<div class="row">
			<div class="col-xs-12">
				<div class="navbar navbar-inverse">
				<!--Menu-->
					<div class="container fluid">
					<ul class="nav nav-pills">
						<li <?php if($menuActive==1){echo 'class="active"';}?>><a href="manageP.php">Products</a></li>
						<li <?php if($menuActive==2){echo 'class="active"';}?>><a href="manageC.php">Categories</a></li>
						<li <?php if($menuActive==3){echo 'class="active"';}?>><a href="manageD.php">Deliveries</a></li>
						<li <?php if($menuActive==4){echo 'class="active"';}?>><a href="stafflogout.php">Logout</a></li>
					</ul>
					</div>
				</div>
			</div>
		</div>