<!--browse category-->
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

$title ="Category";
$h1 = "Category";
$menuActive=2;
include_once("guestheader.php");
?>
	<body>
<!-- Browse Product -->


<div class='row'>
    <div class="col-sm-9 col-xs-12">
        <p>
            <h1>Category Information</h1>
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
    $query = 'SELECT CATEGORY.NAME as Name FROM CATEGORY;';
    
    // run the query
    $result = queryDB($query, $db);
    
    while($row = nextTuple($result)) {
        echo "\n <tr>";
        echo "<td>" .$row['Name'] . "</td>";
        echo "</tr> \n";
    }
?>
</table>	
	
	

<?php
	include_once('footer.php');
?>

	</body>
</html>