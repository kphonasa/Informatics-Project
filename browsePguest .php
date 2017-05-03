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
	<div class="col-xs-12">
		<div class="col-xs-12">
			<div id="container">
		
<form action = "browseP.php" method="post">
	<input  type="text" name="name"> 
	<input  type="submit" class="btn btn-default" name="search" value="Search"> 
	<select class="form-control" style=width: "200" name="order" data-default-value=<?php $query ?>>
			<option selected disabled hidden>Order By:</option>
			<option value="SELECT IMAGE,PNAME,CATEGORY, PRICE FROM PRODUCT ORDER BY PNAME ASC;">A-Z</option>
			<option value="SELECT IMAGE,PNAME, CATEGORY, PRICE FROM PRODUCT ORDER BY PNAME DESC;">Z-A</option>
			<option value="SELECT IMAGE,PNAME,CATEGORY, PRICE FROM PRODUCT ORDER BY PNAME ASC;">Category</option>
			<option value="SELECT IMAGE,PNAME,CATEGORY, PRICE FROM PRODUCT ORDER BY PRICE;">Price</option>
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

		if (isset($_POST['order'])){
			$query = $_POST['order'];
		} else if (isset($_POST['search'])) {
			$query ="SELECT IMAGE,PNAME, ID, CATEGORY, PRICE FROM PRODUCT WHERE PNAME LIKE '%" . $_POST['name'] . "%';";
		} else if (isset($_GET['CATEGORY'])) {
				$query ="SELECT IMAGE,PNAME, ID, CATEGORY, PRICE FROM PRODUCT WHERE CATEGORY = '" . $_GET['CATEGORY'] . "';";
		} else if (isset($_GET['CATEGORY'])) {
			$query ="SELECT IMAGE,PNAME,CATEGORY, PRICE, ID FROM PRODUCT ORDER BY PNAME ASC;";
		}
		$result= queryDB($query, $db);
				
		while($row = nextTuple($result))
		{
			echo'<tr>';
			echo'<td>';
			
			if ($row['IMAGE'])
			{$imagelocation=$row['IMAGE'];
			$altText="product" . $row['PNAME'];
			echo "<img src='$imagelocation' width='150' height='150' alt=$altText'>";}  
			echo'</td>';
			echo "<td><a href='Description.php?ID=" . $row['ID'] . "'>" . $row['PNAME'] . "</a></td>";
			echo '<td>' . $row['CATEGORY'] . '</td>';
			echo '<td>'; echo"$"; echo $row['PRICE']; echo'</td>';
			echo '<td>'; echo"Quantity"; echo"<form method='post' action='browsePguest.php?action=add&code='" . ['ID'] . "'><input type='text' name='quantity' size='2'/>"; echo '</td>';
			echo '<td>'; echo"<button type ='submit' class='btn btn-default' name='Add'>Add to Cart</button></form>";echo'</td>';
			echo'</tr>';
		}
		?>
	</table>
<?php
	include_once("footer.php");
?>
