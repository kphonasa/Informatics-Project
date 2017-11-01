<!--profile-->
<?php
	session_start();
	if (!isset($_SESSION['COOKIE']))
	{
		header('Location: selectSguest.php');
		exit;
	}
		if (!isset($_SESSION['STORE']))
	{
		header('Location: selectSguest.php');
		exit;
	}
?>
<?php
	include_once('config.php');
	include_once('dbutils.php');

	$title ="Shopping Cart";
	$h1 = "Shopping Cart";
	$menuActive=5;
	include_once("guestheader.php");
?>
<div class="container">
<form method="post" action="placeorderguest.php">
<div class="form-group">
  Day for delivery (can at most be done a week in advance):
  <input type="date" name="ORDERDATE">
  </div>
 <div class="form-group">
    Select a time (delivery hours between the times of 8:00AM-8:00PM):
  <input type="time" name="ORDERTIME">
  </div>
  <button type="submit" class="btn btn-default" name="submit">Set Delivery</button>
  <button type ="submit" class="btn btn-default" name="back">Go Back</button>
</form>
</div>
<?php
if (isset($_POST['submit'])) 
{
	$ORDERDATE=$_POST['ORDERDATE'];
	$ORDERTIME=$_POST['ORDERTIME'];
	
	//check for required fields
	$isComplete = true;
	$errorMessage="";
	if (!$ORDERDATE)
	{
		$errorMessage .= "Please select a date for delivery.";
		$isComplete = false;
	}
	if (!$ORDERTIME)
	{
		$errorMessage .= "Please select a time for delivery.";
		$isComplete = false;
	}
	$start = strtotime('08:00');
	$end = strtotime('20:00');
	
	if((strtotime($ORDERTIME) >= $start) && (strtotime($ORDERTIME) <= $end) )
	{
		$ORDERTIME=$ORDERTIME;
	} 
	else 
	{
		$errorMessage .= "Delivery time is not within hours of operations.";
		$isComplete = false;
	}
	$today=(date('Y-m-d'));
	$nextweek=strtotime("+1 week");
	$check=date(('Y-m-d'), $nextweek);
	$timestamp = strtotime($ORDERDATE); 
	$newdate=(date('Y-m-d', $timestamp));
	if(( $newdate >= $today ) && ( $newdate <= $check )){$newdate=$newdate;}
	else
	{
		$errorMessage .= "Delivery date is not in range of operations.";
		$isComplete = false;
	}
	if(isset($isComplete) && !$isComplete)
	{
		echo '<div class="alert alert-danger" role="alert">';
		echo ($errorMessage);
		echo '</div>';
	}
	else{

	if (session_start())
	{
		$_SESSION['D']=$newdate;
		$_SESSION['T']=$ORDERTIME;
	}
	header ('Location: processguest.php');exit;
	}
}
if (isset($_POST['back']))
	{header('Location: guestcart.php');
	exit;} 
?>
