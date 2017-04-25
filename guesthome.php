<!--guest home-->
<?php
	include_once('config.php');
	include_once('dbutils.php');

	$title ="Home";
	$h1 = "Home";
	$menuActive=0;
	include_once("guestheader.php");
?>

    <div class='row'>
            <div class='col-xs-12'>

		<p>
			Welcome to our store, how about try some random items?
		</p>
			</div>
	</div>
	
<!-- Content table here -->
    <div class='row'>
        <div class='col-xs-12'>
<table class="table table-inverse">
    <!-- header for the table -->
    <thead>
        <tr>
			<th></th>
			<th>Name</th>
			<th>Description</th>
			<th>Category</th>
			<th>Price</th>
			<th>QTY</th>
			<th> </th>
		</tr>	

    </thead>
	
	<?php
    /*
     *List all Productes that are in the DB
     *
     */    
    // connect to the DB
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
	
    // set up a query to get infor on the cars from the DB
	$query = 'SELECT * FROM PRODUCT order by RAND() LIMIT 2';
    
    // run the query
    $result = queryDB($query, $db);
    
	
    while($row = nextTuple($result)) {
        echo "\n <tr>";
		if ($row['IMAGE'])
		{$imagelocation=$row['IMAGE'];
		$altText="product" . $row['PNAME'];
		echo "<td><img src='$imagelocation' width='150' alt=$altText'>";}
		echo'</td>';
        echo "<td>" .$row['PNAME'] . "</td>";
        echo "<td>" .$row['DDESCRIPTION'] . "</td>";
        echo "<td>" .$row['CATEGORY'] . "</td>";
        echo "<td>" .$row['PRICE'] . "</td>";
        echo "<td>" .$row['QTY'] . "</td>";
		echo "<td>" .'<a href="' . 'ordersguest.php' . '">Add to Cart</a>' . "</td>";
		
		echo '<td>';
        echo "</tr> \n";
    }
?>
	
	</table>	

	
	
	
	
	
	
	</body>
</html>






<?php
	include_once("footer.php");
?>