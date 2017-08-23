<!--shopper home-->
<html>
    <head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        

        <title>Store1</title>
    </head>
    <body>


        
<div class="row">
    <div class="col-xs-12">
        
<table class="table table hover">
    <thead>
        <th>PNAME</th>
        <th>IMAGE</th>
        <th>CARTEGORY</th>
        <th>PRICE</th>
    </thead>
<?php
	include_once('config.php');
	include_once('dbutils.php');
	$title ="Home";
	$h1 = "Home";
	$menuActive=0;
	include_once("shopperheader.php");
    
    $db= connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
    
    $query= 'SELECT * FROM PRODUCT;';
    
    $result= queryDB($query,$db);
    
    while($row = nextTuple($result)) {
        echo "\n <tr>";
        echo "<td>" . $row['PNAME'] . "</td>";
        echo "<td>";
        if ($row['IMAGE']) {
            $imageLocation = $row['IMAGE'];
            $altText = 'PRODUCT' . $row['PNAME'];
            echo "<img src='$imageLocation' width='150' alt='$altText'>";
        }
        echo "</td>";
        echo "<td>" . $row['CATEGORY'] . "</td>";
        echo "<td>" . $row['PRICE'] . "</td>";
        
        
        echo "<tr> \n";
    }
?>
   
    
</table>

    </div>
</div>       