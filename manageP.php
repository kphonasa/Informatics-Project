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
	$storeid=$_POST['STOREID'];
	$pname=$_POST['PNAME'];
    $description=$_POST['DESCRIPTION'];
	$image=$_POST['IMAGE'];
	$category=$_POST['CATEGORY'];
    $price=$_POST['PRICE'];
    $qty=$_POST['QTY'];
    
    //variable to keep track if the form is complete (set to false if there are any issue with data)
    $isComplete=true;
    
    //error message 
    $errorMessage="";
    
    if(!isset($storeid)){
        $errorMessage .= "Please select the store.\n";
        $isComplete =false;
    }
     if(!isset($pname)){
        $errorMessage .= "Please enter name.\n";
        $isComplete =false;
    }
		if(!isset($category)){
        $errorMessage .= "Please select the category.\n";
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
    $query="INSERT INTO PRODUCT(STOREID,PNAME,DESCRIPTION,CATEGORY,PRICE,QTY) VALUES ('" . $storeid . "','" . $pname . "','" . $pname . "','" . $description . "','" . $category . "','" . $qty . "','" . $category . "');";
    
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
    <label for="STOREID">Storeid:</label>
	<select class="form-control" style="width: 100" name="STOREID">
		<?php $db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
		//run the query
	
		$query="SELECT ID FROM STORE;";
		$result= queryDB($query, $db);
			
		while($row = nextTuple($result))
		{ echo'<option value=' . $row['ID'] . '>';echo($row['ID']); echo'</option>';}?>
	</select>
</div>
<div class="form-group">
    <label for="CATEGORY">Category:</label>
        <select class="form-control" style="width: 500" name="STOREID">
		<?php $db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
		//run the query
	
		$query="SELECT CNAME,ID FROM CATEGORY;";
		$result= queryDB($query, $db);
			
		while($row = nextTuple($result))
		{ echo'<option value=' . $row['ID'] . '>';echo($row['CNAME']); echo'</option>';}?>
	</select>
    
</div>
<!--name-->
<div class="form-group">
    <label for="PNAME">Name:</label>
    <input type="text" class="form-control" name="PNAME"style="width: 500" value="<?php if($pname){echo $pname; } ?>"/>
</div>


<div class="form-group">
    <label for="DESCRIPTION">Description:</label>
    <input type="text" class="form-control" name="DESCRIPTION"/>
</div>

<div class="form-group">
    <label for="PRICE">Price:</label>
    <input type="text" style="width: 500" class="form-control" name="PRICE"/>
</div>


 <div class="form-group">
    <label for="QTY">QTY:</label>
    <input type="text" style="width: 500" class="form-control" name="QTY"/>
</div>
 
 <div class="form-group">
    <label for="IMAGE">Picture of product</label>
    <input type="file" style="width: 500" class="form-control" name="IMAGE"/>
</div>
 
<button type="submit" class="btn-btn-default" name="submit">Save</button>
 
</form> 
        
    </div>
</div>
        
<div class="row">
    <div class="col-xs-12">
        
<table class='table table-hover'>
    <thead>
        <th>Name</th>
        <th>Description</th>
		<th>Category</th>
        <th>Price</th>
        <th>Qty</th>
		<th>Image</th>
    </thead>
    
<?php
    include_once('config.php');
    include_once('dbutils.php');
    
    $db= connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
    
    $query= "SELECT ID,PNAME,DESCRIPTION,CATEGORY, PRICE, QTY, IMAGE FROM PRODUCT;";
    
    $result= queryDB($query,$db);
    
    while($row = nextTuple($result)) {
        echo "\n <tr>";
        echo "<td>" . $row['PNAME'] . "</td>";
        echo "<td>" . $row['DESCRIPTION'] . "</td>";
		echo "<td>" . $row['CATEGORY'] . "</td>";
        echo "<td>" . $row['PRICE'] . "</td>";
        echo "<td>" . $row['QTY'] . "</td>";
		echo "<td>";
        if ($row['IMAGE']) {
            $imageLocation = $row['IMAGE'];
            $altText = 'PRODUCT' . $row['PNAME'];
            echo "<img src='$imageLocation' width='150' alt='$altText'>";
        }
        echo "</td>";
        
		echo "<td><a href='updateproduct.php?ID=" . $row['ID']  .  "'>edit</a></td>";
		
		echo "<td><a href='deleteproduct.php?ID=" . $row['ID']  .  "'>delete</a></td>";
        
        echo "<tr> \n";
    }
?>       
    
</table>

    </div>



<?php
	include_once("footer.php");
?>