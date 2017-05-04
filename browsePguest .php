<!--browse products-->
<?php
//kicks users out if they are not logged in
	session_start();
	if (!isset($_SESSION['COOKIE']))
	{
		header('Location: guesthome.php');
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

	$title ="Products";
	$h1 = "Products";
	$menuActive=1;
	include_once("guestheader.php");
?>

<?php 
$db=connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
$query = "CREATE TABLE IF NOT EXISTS TEMP(
	ID INT NOT NULL AUTO_INCREMENT,
	PNAME VARCHAR(128) NOT NULL,
	PRODUCTID INT NOT NULL,
	QTY INT NOT NULL,
	PRICE INT NOT NULL,
	PRIMARY KEY(ID));";
queryDB($query, $db);
?>
	<div class="col-xs-6">
		<div class="col-xs-12">
			<div id="container">
		
<form action = "browsePguest.php" method="post">
	<input  type="text" name="name"> 
	<input  type="submit" class="btn btn-default" name="search" value="Search"> 
	<select class="form-control" style=width: "200" name="order" data-default-value=<?php $query ?>>
		<option selected disabled hidden>Order By:</option>
		<option value="SELECT * FROM PRODUCT, CATEGORY WHERE CATEGORY.ID=PRODUCT.CATEGORYID AND PRODUCT.STOREID=<?php echo($_SESSION['STORE']); ?> ORDER BY PRODUCT.PNAME ASC;">A-Z</option>
		<option value="SELECT * FROM PRODUCT, CATEGORY WHERE CATEGORY.ID=PRODUCT.CATEGORYID AND PRODUCT.STOREID=<?php echo($_SESSION['STORE']); ?> ORDER BY PRODUCT.PNAME DESC;">Z-A</option>
		<option value="SELECT * FROM PRODUCT, CATEGORY WHERE CATEGORY.ID=PRODUCT.CATEGORYID AND PRODUCT.STOREID=<?php echo($_SESSION['STORE']); ?> ORDER BY CATEGORY.CNAME ASC;">Category</option>
		<option value="SELECT * FROM PRODUCT, CATEGORY WHERE CATEGORY.ID=PRODUCT.CATEGORYID AND PRODUCT.STOREID=<?php echo($_SESSION['STORE']); ?> ORDER BY PRODUCT.PRICE;">Price</option>
	</select><button type ="submit" class="btn btn-default" name="organize">Go</button>
	<div>
	</div>
</form>
	<table class='table table-hover'>

		<thead>
			<th></th>
			<th>Product</th>
			<th>Category</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>Add to Cart</th>
		</thead>
		<!--include config and util files-->
		<?php

		//connect to the database
		$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
		//run the query
		$query= "SELECT * FROM PRODUCT";
		
		if (isset($_POST['order'])){
			$query = $_POST['order'];
		} else if (isset($_POST['search'])) {
			$query ="SELECT IMAGE, PNAME, ID, CNAME, PRICE FROM PRODUCT, CATEGORY WHERE CATEGORY.ID=PRODUCT.CATEGORYID AND PRODUCT.PNAME PNAME LIKE '%" . $_POST['name'] . "%';";
		} else if (isset($_GET['CATEGORY'])) {
			$query ="SELECT IMAGE, PNAME, ID, CATEGORY.CNAME, PRICE FROM PRODUCT, CATEGORY WHERE CATEGORY.CNAME = '" . $_GET['CATEGORY.CNAME'] . "';";
		} else if (isset($_GET['CATEGORY'])) {
			$query ="SELECT IMAGE, PRODUCT.PNAME, CATEGORY.CNAME, PRICE, ID FROM PRODUCT, CATEGORY ORDER BY PNAME ASC;";
		}
		
		$result= queryDB($query, $db);
				
		while($row = nextTuple($result))
		{

			echo'<tr>';
			echo'<td>';
			
			if ($row['IMAGE'])
			{$imagelocation=$row['IMAGE'];
			$altText="product" . $row['PNAME'];
			echo "<a href='Descriptionguest.php?ID=" . $row['ID'] . "'><img src='$imagelocation' width='150' height='150' alt=$altText'>";}  
			echo'</td>';
			echo "<td><a href='Descriptionguest.php?ID=" . $row['ID'] . "'>" . $row['PNAME'] . "</a></td>";
			echo '<td>' . $row['CATEGORY'] . '</td>';
			echo '<td>'; echo"$"; echo $row['PRICE']; echo'</td>';
			echo '<td>'; echo"Quantity"; echo"<form method='post' action='browsePguest.php?ID=" . $row['ID'] . "'><input type='text' name='quantity' size='2'/>"; echo '</td>';
			echo '<td>'; echo"<button type ='submit' class='btn btn-default' name='Add'>Add to Cart</button></form>";echo'</td>';
			if (isset($_POST['Add']))
			{$QTY=$_POST['quantity'];
			
			$_SESSION['QTY']=$QTY;
			$_SESSION['ID']=$_GET['ID'];
			header('Location: browseP2guest.php?ID=' . $_SESSION['ID'] . 'QTY=' . $QTY . '');
			exit;
			}
			
			echo'</tr>';
		}
		?>
	</table>
<?php
	include_once("footer.php");
?>
