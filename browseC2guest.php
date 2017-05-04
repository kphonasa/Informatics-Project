<!--browse categories-->
<?php
//kicks users out if they are not logged in
        session_start();
	
		if (!isset($_SESSION['STORE']))
	{
		header('Location: selectSguest.php');
		exit;
	}
?>
<?php
	include_once('config.php');
	include_once('dbutils.php');
	$title ="Categories";
	$h1 = "Categories";
	$menuActive=2;
	include_once("guestheader.php");
?>
<?php 
$CID=$_GET['ID'];
?>
	<div class="col-xs-6">
		<div class="col-xs-12">
			<div id="container">
			<form action = "browseC2guest.php?ID=<?php echo ($CID); ?>" method="post">
			<!--<input  type="text" name="name"> 
	<input  type="submit" class="btn btn-default" name="search" value="Search"> -->
	<select class="form-control" style="width: 200" name="order" data-default-value=<?php $query ?>>
		<option selected disabled hidden>Order By:</option>
		<option value="SELECT PRODUCT.ID, PRODUCT.PNAME, PRODUCT.CATEGORYID, PRODUCT.IMAGE, PRODUCT.PRICE, CATEGORY.CNAME FROM PRODUCT, CATEGORY WHERE CATEGORY.ID=PRODUCT.CATEGORYID AND PRODUCT.STOREID=<?php echo($_SESSION['STORE']); ?> AND PRODUCT.CATEGORYID=<?php echo ($CID); ?> ORDER BY PRODUCT.PNAME ASC;">A-Z</option>
		<option value="SELECT PRODUCT.ID, PRODUCT.PNAME, PRODUCT.CATEGORYID, PRODUCT.IMAGE, PRODUCT.PRICE, CATEGORY.CNAME  FROM PRODUCT, CATEGORY WHERE CATEGORY.ID=PRODUCT.CATEGORYID AND PRODUCT.STOREID=<?php echo($_SESSION['STORE']); ?> AND PRODUCT.CATEGORYID=<?php echo ($CID); ?> ORDER BY PRODUCT.PNAME DESC;">Z-A</option>
		<option value="SELECT PRODUCT.ID, PRODUCT.PNAME, PRODUCT.CATEGORYID, PRODUCT.IMAGE, PRODUCT.PRICE, CATEGORY.CNAME  FROM PRODUCT, CATEGORY WHERE CATEGORY.ID=PRODUCT.CATEGORYID AND PRODUCT.STOREID=<?php echo($_SESSION['STORE']); ?> AND PRODUCT.CATEGORYID=<?php echo ($CID); ?> ORDER BY PRODUCT.PRICE;">Price</option>
	</select><button type ="submit" class="btn btn-default" name="organize">Go</button>
	</form>
	</div>
</div>
		

	<table class='table table-hover'>

		<thead>
			<th></th>
			<th>Product</th>
			<th>Category</th>
			<th>Price</th>
			<!--<th>Quantity</th>
			<th>Add to Cart</th>-->
		</thead>
		<!--include config and util files-->
		<?php
		//connect to the database
		$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
		//run the query
		if (isset($_POST['order']))
		{$query = $_POST['order'];}
		//else if (isset($_POST['search']))
		//{$query ="SELECT PRODUCT.ID, PRODUCT.PNAME, PRODUCT.CATEGORYID, PRODUCT.IMAGE, PRODUCT.PRICE, CATEGORY.CNAME FROM PRODUCT, CATEGORY WHERE PRODUCT.STOREID='" . $_SESSION['STORE'] . "' AND PRODUCT.CATEGORYID='" . $CID . "' AND PRODUCT.PNAME LIKE '%" . $_POST['name'] . "%';";}
		else{$query ="SELECT PRODUCT.ID, PRODUCT.PNAME, PRODUCT.CATEGORYID, PRODUCT.IMAGE, PRODUCT.PRICE, CATEGORY.CNAME FROM PRODUCT, CATEGORY WHERE CATEGORY.ID=PRODUCT.CATEGORYID AND PRODUCT.STOREID='" . $_SESSION['STORE'] . "' AND CATEGORY.ID='" . $CID . "' ORDER BY PRODUCT.PNAME ASC;";}
	
		$result= queryDB($query, $db);
				
		while($row = nextTuple($result))
		{
			echo'<tr>';
			echo'<td>';
			
			if ($row['IMAGE'])
			{$imagelocation=$row['IMAGE'];
			$altText="product" . $row['PNAME'];
			echo "<a href='Descriptionguest.php?ID=" . $row['ID'] . "CID=" . $CID . "'><img src='$imagelocation' width='150' height='150' alt=$altText'>";}  
			echo'</td>';
			echo "<td><a href='Descriptionguest.php?ID=" . $row['ID'] . "CID=" . $CID . "'>" . $row['PNAME'] . "</a></td>";
			echo '<td>' . $row['CATEGORY'] . '</td>';
			echo '<td>'; echo"$"; echo $row['PRICE']; echo'</td>';
			//echo '<td>'; echo"Quantity"; echo"<form method='post' action='browseC2.php?ID=" . $row['ID'] . "'><input type='text' name='quantity' size='2'/>"; echo '</td>';
			//echo '<td>'; echo"<button type ='submit' class='btn btn-default' name='Add'>Add to Cart</button></form>";echo'</td>';
			if (isset($_POST['Add']))
			{$QTY=$_POST['quantity'];
			
			$_SESSION['QTY']=$QTY;
			$_SESSION['ID']=$_GET['ID'];
			header('Location: browseC3guest.php?ID=' . $_SESSION['ID'] . 'QTY=' . $QTY . 'CID=' . $CID . '');
			//exit;
			}
			
			
			echo'</tr>';
			
		}
		
	?>
	</table>
<?php
	include_once("footer.php");
?>
Contact GitHub API Training Shop Blog About