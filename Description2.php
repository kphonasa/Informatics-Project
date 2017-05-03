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
$ID=$_GET['ID'];

if (!isset($_GET['ID'])){header ('Location:browseP.php'); exit;}
$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
$query = "SELECT * FROM PRODUCT, CATEGORY WHERE CATEGORY.ID=PRODUCT.CATEGORYID AND PRODUCT.STOREID='" . $_SESSION['STORE'] . "' AND PRODUCT.ID='" . $ID . "';";
$result=queryDB($query, $db);
$row=nextTuple($result);
$PNAME=$row['PNAME'];
$DESCRIPTION=$row['DESCRIPTION'];
$IMAGE=$row['IMAGE'];
$CATEGORY=$row['CNAME'];
$PRICE=$row['PRICE'];
?>
<div align="middle" class="row">
	<div class="col-xs-12">
		<h1><?php echo $PNAME; ?></h1>
	</div>
</div>
<div align="middle" class="row">
	<div class="col-xs-12">
		<h1><?php if ($row['IMAGE'])
			{$imagelocation=$row['IMAGE'];
			$altText="product" . $row['PNAME'];
			echo "<img src='$imagelocation' width='150' alt=$altText'>";} ?></h1>
	</div>
</div>
<div align="middle" class="row">
	<div class="col-xs-12">
		<p><?php echo $DESCRIPTION; ?></p>
	</div>
</div>
<div align="middle" class="row">
	<div class="col-xs-12">
		<h1><?php echo $CATEGORY; ?></h1>
	</div>
</div>
<div align="middle" class="row">
	<div class="col-xs-12">
		<h1>$<?php echo $PRICE; ?></h1>
	</div>
</div>
<div align="middle">
<form method="post" action="Description2.php?ID=<?php echo $ID ?>"><input type="text" name="quantity" size="2"/> 
	<button type ="submit" class="btn btn-default" name="Add">Add to Cart</button>
	<button type ="submit" class="btn btn-default" name="back">Go Back</button>
</form>
</div>
<?php if (isset($_POST['back']))
	{header('Location: browseC2.php?ID=' . $ID . '');
	exit;} 
	if (isset($_POST['Add']))
			{$QTY=$_POST['quantity'];
			
			$_SESSION['QTY']=$QTY;
			$_SESSION['ID']=$ID;
			header('Location: browseC2.php?ID=' . $ID . 'QTY=' . $QTY . '');
			exit;
			}
?>

<?php
	include_once("footer.php");
?>