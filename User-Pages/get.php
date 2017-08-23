<!--browse products-->

<?php
include_once('config.php');
include_once('dbutils.php');
include_once("shopperheader.php");
?>

	<body>
<!-- Browse Product -->


<div class='row'>
    <div class="col-sm-9 col-xs-12">
        <p>
            <h1>Product Information</h1>
        </p>
    </div>
</div>


<!-- Content table here -->
    <div class='row'>
            <div class='col-xs-12'>
<table class='table table-hover'>
    <!-- header for the table -->
    <thead>
        <th>Name</th>
        <th>Description</th>
        <th>Category</th>
        <th>Price</th>
        <th>QTY</th>
    </thead>


<?php
//include config and utils files
include_once('config.php');
include_once('dbutils.php');
// connect to the DB
$db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
if (isset($_GET['srch-term'])) {
	$search = $_GET['srch-term'];   
    $query = "SELECT PRODUCT.ID, PRODUCT.PNAME, PRODUCT.CATEGORYID, PRODUCT.IMAGE, PRODUCT.PRICE, CATEGORY.CNAME FROM PRODUCT, CATEGORY WHERE CATEGORY.ID=PRODUCT.CATEGORYID AND PRODUCT.STOREID='" . $_SESSION['STORE'] . "' AND PRODUCT.PNAME LIKE '%$search%';";
	$result = queryDB($query, $db);
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
			echo '<td>' . $row['CNAME'] . '</td>';
			echo '<td>'; echo"$"; echo $row['PRICE']; echo'</td>';
			//echo '<td>'; echo"Quantity"; echo"<form method='post' action='browseP.php?ID=" . $row['ID'] . "QTY=" . $QTY . "'><input type='text' name='quantity' size='2'/>"; echo '</td>';
			//echo '<td>'; echo"<button type ='submit' class='btn btn-default' name='Add'>Add to Cart</button></form>";echo'</td>';
			if (isset($_POST['Add']))
			{$QTY=$_POST['quantity'];
			
			$_SESSION['QTY']=$QTY;
			$_SESSION['ID']=$_GET['ID'];
			header('Location: browseP2.php?ID=' . $_SESSION['ID'] . 'QTY=' . $QTY . '');
			exit;
			}
			
			
			echo'</tr>';
			
		}
	//run the query
	
	}
	//**while($row = nextTuple($result)) {
	//echo "<tr>";
	//echo "<td>";
	//if ($row['IMAGE'])
	//{$imagelocation=$row['IMAGE'];
	//$altText="product" . $row['PNAME'];
	//echo "<img src='$imagelocation' width='150' alt=$altText'>";}
	//echo'</td>';
	//echo "<td>" .$row['PNAME'] . "</td>";
	//echo "<td>" .$row['DESCRIPTION'] . "</td>";
	//echo "<td>" .$row['CNAME'] . "</td>";
	//echo "<td>" .$row['PRICE'] . "</td>";
	//echo "</tr> \n";
	//}
?>

</table>


<?php
	include_once('footer.php');
?>