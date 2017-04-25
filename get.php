<!--browse products-->

<?php
include_once('config.php');
include_once('dbutils.php');
include_once("guestheader.php");
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
    $query = "SELECT * FROM PRODUCT WHERE PNAME LIKE '%$search%'";
	
	
	//run the query
	$result = queryDB($query, $db);
	}
	while($row = nextTuple($result)) {
	echo "<tr>";
	echo "<td>";
	if ($row['IMAGE'])
	{$imagelocation=$row['IMAGE'];
	$altText="product" . $row['PNAME'];
	echo "<img src='$imagelocation' width='150' alt=$altText'>";}
	echo'</td>';
	echo "<td>" .$row['PNAME'] . "</td>";
	echo "<td>" .$row['DESCRIPTION'] . "</td>";
	echo "<td>" .$row['CATEGORY'] . "</td>";
	echo "<td>" .$row['PRICE'] . "</td>";
	echo "<td>" .$row['QTY'] . "</td>";
	echo "</tr> \n";
	}
?>

</table>


<?php
	include_once('footer.php');
?>
