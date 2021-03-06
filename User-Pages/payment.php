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
<form action = "payment.php?D=<?php echo($ORDERDATE); ?>T=<?php echo($ORDERTIME); ?>" method="post">
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
	<button type ="submit" class="btn btn-default" name="cancel">Cancel</button>
</form>
</div>
<?php
if (isset($_POST['cancel']))
	{header('Location: cart.php');
	exit;} 
if (isset($_POST['submit']))
	{	
		$cardname=$_POST['cardname'];
		$cardnumber=$_POST['cardnumber'];
		$exmonth=$_POST['exmonth'];
		$exyear=$_POST['exyear'];
		$ccv=$_POST['ccv'];
		$isComplete = true;
		$errorMessage="";
		if (!$cardname)
			{
				$errorMessage .="Please fill out the name on the card.";
				$isComplete = false;
			}
			if (!$cardnumber)
			{
				$errorMessage .="Please fill out the card number.";
				$isComplete = false;
			}
			if (!$exmonth)
			{
				$errorMessage .="Please fill out the card's expiration month.";
				$isComplete = false;
			}
			if (!$exyear)
			{
				$errorMessage .="Please fill out the card's expiration year.";
				$isComplete = false;
			}
			if (!$ccv)
			{
				$errorMessage .="Please fill out the card's ccv.";
				$isComplete = false;
			}
		if ($isComplete)
		{if (session_start())
	{
		$_SESSION['CARDNAME']=$cardname;
		$_SESSION['CARDNUMBER']=$cardnumber;
		$_SESSION['EXMONTH']=$exmonth;
		$_SESSION['EXYEAR']=$exyear;
		$_SESSION['CCV']=$ccv;
		header('Location: process.php?D=' . $ORDERDATE . 'T=' . $ORDERTIME . '');
		exit;}
	}
	}		
	if(isset($isComplete) && !$isComplete)
			{
				echo '<div class="alert alert-danger" role="alert">';
				echo ($errorMessage);
				echo '</div>';
			}
?>