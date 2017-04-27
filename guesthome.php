<!--shopper home-->
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
    // connect to the DB
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
	
    // set up a query to get infor on the cars from the DB
	$query = 'SELECT * FROM PRODUCT order by RAND() LIMIT 2';
    
    // run the query
    $result = queryDB($query, $db);
    
	
    while($row = nextTuple($result))
		{
			echo'<tr>';
			echo'<td>';
			
			if ($row['IMAGE'])
			{$imagelocation=$row['IMAGE'];
			$altText="product" . $row['PNAME'];
			echo "<img src='$imagelocation' width='150' alt=$altText'>";}  
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

	
	
	
	
	
	
	</body>
</html>



