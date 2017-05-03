<!--browse categories-->
<?php
//kicks users out if they are not logged in
	session_start();
	if (!isset($_SESSION['email']))
	{
		header('Location: shopperlogin.php');
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
$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
$queryx="SELECT CNAME FROM CATEGORY WHERE ID='" . $ID . "';";
$resultx=queryDB($queryx, $db);
while($row = nextTuple($resultx)){$CNAME=$row['CNAME'];}
?>
<div class="col-xs-6">
		<div class="col-xs-12">
			<div id="container">
		
<form action = "browseC2.php" method="post">
	<input  type="text" name="name"> 
	<input  type="submit" class="btn btn-default" name="search" value="Search"> 
	<select class="form-control" style="width: 200" name="order" data-default-value=<?php $query ?>>
			<option selected disabled hidden>Order By:</option>
			<option value="SELECT IMAGE,PNAME,CATEGORY, PRICE FROM PRODUCT WHERE CATEGORY=<?php $CNAME ?> ORDER BY PNAME ASC;">A-Z</option>
			<option value="SELECT IMAGE,PNAME, CATEGORY, PRICE FROM PRODUCT WHERE CATEGORY=<?php $CNAME ?> ORDER BY PNAME DESC;">Z-A</option>
			<option value="SELECT IMAGE,PNAME,CATEGORY, PRICE FROM PRODUCT WHERE CATEGORY=<?php $CNAME ?> ORDER BY PRICE;">Price</option>
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

		if (isset($_POST['order']))
		{$query = $_POST['order'];}
		else if (isset($_POST['search']))
		{$query ="SELECT IMAGE,PNAME, ID, CATEGORY, PRICE FROM PRODUCT WHERE CATEGORY='" . $CNAME . "' PNAME LIKE '%" . $_POST['name'] . "%';";}
		else{$query ="SELECT IMAGE,PNAME,CATEGORY, PRICE, ID FROM PRODUCT WHERE CATEGORY='" . $CNAME . "' ORDER BY PNAME ASC;";}
		$result= queryDB($query, $db);
				
		while($row = nextTuple($result))
		{

			echo'<tr>';
			echo'<td>';
			
			if ($row['IMAGE'])
			{$imagelocation=$row['IMAGE'];
			$altText="product" . $row['PNAME'];
			echo "<a href='Description.php?ID=" . $row['ID'] . "'><img src='$imagelocation' width='150' height='150' alt=$altText'>";}  
			echo'</td>';
			echo "<td><a href='Description.php?ID=" . $row['ID'] . "'>" . $row['PNAME'] . "</a></td>";
			echo '<td>' . $row['CATEGORY'] . '</td>';
			echo '<td>'; echo"$"; echo $row['PRICE']; echo'</td>';
			echo '<td>'; echo"Quantity"; echo"<form method='post' action='browseC2.php?ID=" . $row['ID'] . "'><input type='text' name='quantity' size='2'/>"; echo '</td>';
			echo '<td>'; echo"<button type ='submit' class='btn btn-default' name='Add'>Add to Cart</button></form>";echo'</td>';
			if (isset($_POST['Add']))
			{$QTY=$_POST['quantity'];
			
			$_SESSION['QTY']=$QTY;
			$_SESSION['ID']=$_GET['ID'];
			header('Location: browseC3.php?ID=' . $_SESSION['ID'] . 'QTY=' . $QTY . '');
			exit;
			}
			
			
			echo'</tr>';
			
		}
		
	?>
	</table>
