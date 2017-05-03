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
<div class="container">
<form action = "payment.php" method="post">
	<div class="form-group">
		<label for="cardname">Enter the Full Name on Card</label>
		<input type="text" style="width: 500" class="form-control" name="cardname"/>
	</div>
	
	<div class="form-group">
		<label for="cardnumber">Card Number</label>
		<input type="text" style="width: 500" class="form-control" name="cardnumber"/>
	</div>
	
	<div class="form-group">
		<label for="exmonth">Expiration Month</label>
		<input type="text" style="width: 100" class="form-control" name="exmonth"/>
	</div>

	<div class="form-group">
		<label for="exyear">Expiration Year</label>
		<input type="text" style="width: 100" class="form-control" name="exyear"/>
	</div>
	
	<div class="form-group">
		<label for="ccv">CCV</label>
		<input type="text" style="width: 100" class="form-control" name="ccv"/>
	</div>
	
	<button type ="submit" class="btn btn-default" name="submit">Submit</button>
	<button type ="submit" class="btn btn-default" name="delete">Cancel</button>
</form>
</div>