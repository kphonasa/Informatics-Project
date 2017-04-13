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

include_once("guestheader.php");
?>

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
	echo "\n <tr>";
	echo "<td>" .$row['PNAME'] . "</td>";
	echo "</tr> \n";
	}



?>

<?php
	include_once('footer.php');
?>

	</body>
</html>