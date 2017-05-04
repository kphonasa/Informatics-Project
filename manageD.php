<!--Manage Deliveries Staff-->
<?php
	include_once('config.php');
	include_once('dbutils.php');

	$title ="Deliveries";
	$h1 = "Deliveries";
	$menuActive=3;
	include_once("staffHeader.php");
?>
<!--Manage Deliveries Staff-->
<?php
// this kicks users out if they are not logged in
    session_start();
    if (!isset($_SESSION['EMAIL'])) {
        header('Location: stafflogin.php');
        exit;
    }
	else if (!isset($_SESSION['STOREID'])) {
        header('Location: stafflogin.php');
        exit;
    }
?>

<html>
    <head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        

        <title>Category</title>
    </head>
    <body>
<?php
	include_once('config.php');
	include_once('dbutils.php');

	$title ="Deliveries";
	$h1 = "Deliveries";
	$menuActive=3;
	include_once("staffHeader.php");
	
	

?>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <ul class="nav navbar-nav navbar-left">
        <li class="active"><a href="manageD.php">order placed</a></li>
        <li><a href="manageD2.php">shipping</a></li>
		<li><a href="manageD3.php">delivered</a></li>
		<li><a href="manageD4.php">returned</a></li>
     </ul>
     
  </div>
</nav>

<div class="row">
    <div class="col-xs-12">
        
<table class="table table hover">
    <thead>
        <th>OrderID</th>
        <th>UserID</th>
        <th>ProductID</th>
        <th>OrderDate</th>
		<th>Status</th>
        <th>TotalPrice</th>
    </thead>
    
<?php
    include_once('config.php');
    include_once('dbutils.php');
    
    $db= connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
    
    $query= "SELECT ID, USERID,PRODUCTID,ORDERDATE,STATUS,TOTALP FROM ORDERS WHERE STOREID='" . $_SESSION['STOREID'] . "' AND STATUS='ORDER PLACED';";
    
    $result= queryDB($query,$db);
    
    while($row = nextTuple($result)) {
		
        echo "\n <tr>";
        echo "<td>" . $row['ID'] . "</td>";
        echo "<td>" . $row['USERID'] . "</td>";
        echo "<td>" . $row['PRODUCTID'] . "</td>";
        echo "<td>" . $row['ORDERDATE'] . "</td>";
		echo "<td>" . $row['STATUS'] . "</td>";
		echo "<td>" . $row['TOTALP'] . "</td>";
		echo "<td><a href='ship.php?ID=" . $row['ID']  .  "'>ship</a></td>";
        echo "<tr> \n";
    }
	
?>       
    
</table>

    </div>
</div>

    </body>
</html>

<?php
	include_once("footer.php");
?>