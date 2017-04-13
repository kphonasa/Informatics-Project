<!--browse products-->
<html>

<!-- Boostrap link -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<?php
include_once('config.php');
include_once('dbutils.php');

$title ="Products";
$h1 = "Products";
$menuActive=1;
include_once("guestheader.php");
?>

<!-- font size and color -->
	<style>
		body  {
			font-size: 20px;
		}
	</style>


<!-- sumbit order -->




	<body>
<!-- Browse Product -->


<div class='row'>
    <div class="col-sm-9 col-xs-12">
        <p>
            <h1>Product Information</h1>
        </p>
    </div>
</div>

<!-- image part 
<form action = "browsePguest.php" method="post">
	<select class="form-control" style=width: '150' name="order" data-default-value=<?php //$query ?>>
			<option selected disabled hidden>Order By:</option>
			<option value="SELECT IMAGE,PNAME,CATEGORY, PRICE FROM PRODUCT ORDER BY PNAME ASC;">A-Z</option>
			<option value="SELECT IMAGE,PNAME, CATEGORY, PRICE FROM PRODUCT ORDER BY PNAME DESC;">Z-A</option>
			<option value="SELECT IMAGE,PNAME,CATEGORY, PRICE FROM PRODUCT ORDER BY PNAME ASC;">Category</option>
	</select><button type ="submit" class="btn btn-default" name="submit">Go</button>
</form> -->




<!-- Content table here -->
    <div class='row'>
            <div class='col-xs-12'>
<table class='table table-hover'>
    <!-- header for the table -->
    <thead>
        <th></th>
		<th>Name</th>
        <th>Description</th>
        <th>Category</th>
        <th>Price</th>
        <th>QTY</th>
		<th> </th>

    </thead>

<?php
    /*
     *List all Productes that are in the DB
     *
     */
    //include config and utils files
    include_once('config.php');
    include_once('dbutils.php');
    
    // connect to the DB
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    
	if (isset($_POST['submit']))
		{$query = $_POST['order'];}
	
    // set up a query to get infor on the cars from the DB
	else{$query = 'SELECT IMAGE, PRODUCT.PNAME as Name, PRODUCT.DESCRIPTION as Description, PRODUCT.CATEGORY as Category, PRODUCT.PRICE as Price, PRODUCT.QTY FROM PRODUCT;';}
    
    // run the query
    $result = queryDB($query, $db);
    
	
    while($row = nextTuple($result)) {
        echo "\n <tr>";
		if ($row['IMAGE'])
		{$imagelocation=$row['IMAGE'];
		$altText="product" . $row['PNAME'];
		echo "<img src='$imagelocation' width='150' alt=$altText'>";}
		echo'</td>';
        echo "<td>" .$row['Name'] . "</td>";
        echo "<td>" .$row['Description'] . "</td>";
        echo "<td>" .$row['Category'] . "</td>";
        echo "<td>" .$row['Price'] . "</td>";
        echo "<td>" .$row['QTY'] . "</td>";
		echo "<td>" .'<a href="' . 'ordersguest.php' . '">Add to Cart</a>' . "</td>";
		
		echo '<td>';
        echo "</tr> \n";
    }
?>	
	
</table>	








<?php
	include_once('footer.php');
?>

	</body>
</html>