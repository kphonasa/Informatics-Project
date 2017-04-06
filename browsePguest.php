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


<!-- sumbit order -->

<?php

//include config and utils files
include_once('config.php');
include_once('dbutils.php');

//check if form data needs to be processed
if (isset($_POST['submit'])) {
    //if we are here, the form is sumbitted and we need to process form data
    
    //get the data from the form
    $NAME = $_POST['Name'];
    $QTY = $_POST['QTY'];
	$productid = $_POST['PRODUCT-ID'];
    
    // variable to keep track if the from is complete
    $isComplete = true;
    
    //error message we'll give user in case there are issues with data
    $errorMessage = "";
    
    
    if (!$Name) {
        $errorMessage = "Please enter the product name. \n";
        $isComplete = false;
    }    

    if (!$QTY) {
        $errorMessage = "Please enter the number of selected items. \n";
        $isComplete = false;
    }

//stop the php and how error message    
    if (!$isComplete) {
        punt($errorMessage);
    }
    
    //put together sql statement to insert new data
    $query = "INSERT INTO ORDERS(PRODUCTID, QTY) VALUES('$productid', '$QTY');";
    
    //connect to the DB
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    
    //run the insert statement
    $result - queryDB($query, $db);
    
    //we have successfully entered the date
    echo ("Successfully Sumbitted new order: " . $Name);
    
    //reset so we can reset the form since we've successfully added the data
    unset($isComplete, $errorMessage, $Name, $QTY, $Sequentialid);
}

?>

    <!-- Title -->
    <div class="row">
        <div class="col-xs-12">
            <h1>New Orders</h1>
        </div>
    </div>
	

        <div class="row">
            <div class="col-xs-12">
                
                <form action="browsePguest.php" method="post">
                         
                <!-- Dropdown for product -->
					<div class="form-group">
						<label for="NAME">Product Name:</label>
						<?php
						//connect to DB
						if (!isset($db)) {
							$db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
						}
						echo (generateDropdown($db, "PRODUCT", "NAME", "ID", $productid));
						?>
						
					</div>
                
                <!-- Origin --> 
                    <div class="form-group">
                        <label for="QTY">QTY:</label>
                        <input type="number" class="form-control" name="QTY"/>
                    </div>
                
                <button type="submit" class="btn btn-default" name="submit">Submit</button>
                
                </form>
            </div>
        </div>








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
    
    // set up a query to get infor on the cars from the DB
    $query = 'SELECT PRODUCT.NAME as Name, PRODUCT.DESCRIPTION as Description, PRODUCT.CATEGORY as Category, PRODUCT.PRICE as Price, PRODUCT.QTY FROM PRODUCT;';
    
    // run the query
    $result = queryDB($query, $db);
    
    while($row = nextTuple($result)) {
        echo "\n <tr>";
        echo "<td>" .$row['Name'] . "</td>";
        echo "<td>" .$row['Description'] . "</td>";
        echo "<td>" .$row['Category'] . "</td>";
        echo "<td>" .$row['Price'] . "</td>";
        echo "<td>" .$row['QTY'] . "</td>";
		echo "<td>" .'<a href="' . 'ordersguest.php' . '">Add to Cart</a>' . "</td>";
        echo "</tr> \n";
    }
?>
	
<?php
	// picture
	echo "<td>";
	if ($row['picture']) {
		$imageLocation = $row['picture'];
		$altText = '' . $row['Name'];
		echo "<img src='$imageLocation' width='150' alt='$altText'>";
	}
	echo "</td>";

?>	
	
</table>	








<?php
	include_once('footer.php');
?>

	</body>
</html>