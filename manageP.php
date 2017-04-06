<!--Manage Products Staff-->
<!--Manage Categories Staff-->
<?php
// this kicks users out if they are not logged in
    session_start();
    if (!isset($_SESSION['EMAIL'])) {
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
        

        <title>Product</title>
    </head>
    <body>
<?php
	include_once('config.php');
	include_once('dbutils.php');

	$title ="Products";
	$h1 = "Products";
	$menuActive=1;
	include_once("staffHeader.php");
	
	if(isset($_POST['submit'])){
    //if we are here, it means that the form was submitted and we need to process form data
    
    //get data from form
    $storeid=$_POST['CATEGORY-STOREID'];
	$storeid2=$_POST['STOREID'];
	$pname=$_POST['PNAME'];
    $description=$_POST['DESCRIPTION'];
    $price=$_POST['PRICE'];
    $qty=$_POST['QTY'];
    
    //variable to keep track if the form is complete (set to false if there are any issue with data)
    $isComplete=true;
    
    //error message 
    $errorMessage="";
    
    if(!isset($storeid)){
        $errorMessage .= "Please enter maker.\n";
        $isComplete =false;
    }
	if(!isset($storeid2)){
        $errorMessage .= "Please enter storeid.\n";
        $isComplete =false;
    }
     if(!isset($pname)){
        $errorMessage .= "Please enter name.\n";
        $isComplete =false;
    }
    
    if(!isset($price)){
        $errorMessage .= "Please enter price.\n";
        $isComplete =false;
    }
    
    if(!isset($qty)){
        $errorMessage .= "Please enter quantity.\n";
        $isComplete =false;
    }
    
   
    
    //Stop execution and show error if the form is not complete
    if($isComplete){
        
    
    
    //put together SQL to insert new record
    $query="INSERT INTO PRODUCT(STOREID,PNAME,DESCRIPTION,PRICE,QTY) VALUES ('$storeid','$pname','$description','$price','$qty');";
    
    //get a handle to database
     $db= connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
     
     //run the insert statement
    $result =queryDB($query,$db);
	 
	$productid = mysqli_insert_id($db);
	
	// check if there's a picture
        if ($_FILES['IMAGE']['size'] > 0) {
            // if there is a picture
            
            // copy image to images directory
            $tmpName = $_FILES['IMAGE']['tmp_name'];
            $fileName = $_FILES['IMAGE']['name'];
            
            $newFileName = $imagesDir . $productid . $fileName;
            
            // we create a filename that includes the pizza id, followed by the filename ($imagesDir comes from config.php)
            if (move_uploaded_file($tmpName, $newFileName)) {
                // since we successfully copied the file, we now enter its filename in the pizza table
                $query = "UPDATE PRODUCT SET IMAGE = '$newFileName' WHERE id=$productid;";
            
                // run insert query
                queryDB($query, $db);
            } else {
                echo "error copying image";
            }
    	}
     
     //we have successfully enter the data
     echo("Successfully entered new products: " . $pname);
     
     unset($categoryid,$pname,$description,$price,$qty);
    }
}



?>



<div class="row">
    <div class="col-xs-12">
        <h1>Product</h1>
    </div>
</div>
 
 
<div class="row">
    <div class="col-xs-12">
    
 <!--show error-->
<?php
    if(isset($isComplete) && !$isComplete){
        echo '<div class="alert alert-danger" role="alert">';
        echo($errorMessage);
        echo '</div>';
    }
?>
        
    </div>
</div>


<!--form to enter new cara-->
<div class="row">
    <div class="col-xs-12">

<form action="manageP.php" method="post">
<!--maker-->
<div class="form-group">
    <label for="CATEGORY.STOREID">Category:</label>
    <?php
        //connect to the database
        if(!isset($db)){
            $db=connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
        }
        echo (generateDropdown($db,"CATEGORY","CNAME","STOREID",$storeid));
    ?>
</div>
<div class="form-group">
    <label for="STOREID">Storeid:</label>
    <input type="text" class="form-control" name="STOREID" value="<?php if($storeid2){echo $storeid2; } ?>"/>
</div>
<!--name-->
<div class="form-group">
    <label for="PNAME">Name:</label>
    <input type="text" class="form-control" name="PNAME" value="<?php if($pname){echo $pname; } ?>"/>
</div>

<!--year-->
<div class="form-group">
    <label for="DESCRIPTION">Description:</label>
    <input type="text" class="form-control" name="DESCRIPTION" value="<?php if($description){echo $description; } ?>"/>
</div>
<!--trim-->

<div class="form-group">
    <label for="PRICE">Price:</label>
    <input type="text" class="form-control" name="PRICE" value="<?php if($price){echo $price; } ?>"/>
</div>
<!--URL--> 
 <div class="form-group">
    <label for="QTY">QTY:</label>
    <input type="text" class="form-control" name="QTY" value="<?php if($qty){echo $qty; } ?>"/>
</div>
 
 <div class="form-group">
    <label for="picture">Picture of product</label>
    <input type="file" class="form-control" name="picture"/>
</div>
 
<button type="submit" class="btn-btn-default" name="submit">Save</button>
 
</form> 
        
    </div>
</div>
        
<div class="row">
    <div class="col-xs-12">
        
<table class="table table hover">
    <thead>
        <th>Category</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Qty</th>
    </thead>
    
<?php
    include_once('config.php');
    include_once('dbutils.php');
    
    $db= connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
    
    $query= 'SELECT PNAME,DESCRIPTION,PRICE,QTY,CATEGORY.CNAME as category FROM CATEGORY,PRODUCT WHERE CATEGORY.STOREID=PRODUCT.STOREID;';
    
    $result= queryDB($query,$db);
    
    while($row = nextTuple($result)) {
        echo "\n <tr>";
        echo "<td>" . $row['category'] . "</td>";
        echo "<td>" . $row['PNAME'] . "</td>";
        echo "<td>" . $row['DESCRIPTION'] . "</td>";
        echo "<td>" . $row['PRICE'] . "</td>";
        echo "<td>" . $row['QTY'] . "</td>";
		echo "<td>";
        if ($row['IMAGE']) {
            $imageLocation = $row['IMAGE'];
            $altText = 'PRODUCT' . $row['PNAME'];
            echo "<img src='$imageLocation' width='150' alt='$altText'>";
        }
        echo "</td>";
                
        
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
