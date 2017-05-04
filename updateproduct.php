<?php
/*
 * This php file enables users to edit a particular product
 * It obtains the id for the pizza to update from an id variable passed using the GET method (in the url)
 *
 */
    include_once('config.php');
    include_once('dbutils.php');
    session_start();
    if (!isset($_SESSION['EMAIL']))
    {
        header('Location: stafflogin.php');
        exit;
    }
	else if (!isset($_SESSION['STOREID'])) {
        header('Location: stafflogin.php');
        exit;
    }
    /*
     * If the user submitted the form with updates, we process the form with this block of code
     *
     */
    if (isset($_POST['submit'])) {
        // process the update if the form was submitted
        
        // get data from form
        $id = $_POST['ID'];
        if (!isset($id)) {
            // if for some reason the id didn't post, kick them back to manageP.php
            header('Location: manageP.php');
            exit;
        }

        // get data from form
        $pname = $_POST['PNAME'];
        $description = $_POST['DESCRIPTION'];
        $image=$_POST['IMAGE'];
        $price = $_POST['PRICE'];
        $qty = $_POST['QTY'];
        
        
        
        // variable to keep track if the form is complete (set to false if there are any issues with data)
        $isComplete = true;
        
        // error message we'll give user in case there are issues with data
        $errorMessage = "";
        
        
        // check each of the required variables in the table        
        
        
        
        
       
        // If there's an error, they'll go back to the form so they can fix it
        
        if($isComplete) {
            // if there's no error, then we need to update
            
            //
            // first update product record
            //
            // put together SQL statement to update product
            $query = "UPDATE PRODUCT SET PNAME='$pname', DESCRIPTION='$description', PRICE=$price WHERE ID=$id;";
            
            // connect to the database
            $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
            
            // run the update
            $result = queryDB($query, $db);
            
             if ($_FILES['IMAGE']['size'] > 0) {
            // if there is a picture
            
            // copy image to images directory
                $tmpName = $_FILES['IMAGE']['tmp_name'];
                $fileName = $_FILES['IMAGE']['name'];
            
                $newFileName = $imagesDir . $id . $fileName;
            
            // we create a filename that includes the product id, followed by the filename ($imagesDir comes from config.php)
                if (move_uploaded_file($tmpName, $newFileName)) {
                    // since we successfully copied the file, we now enter its filename in the product table
                    $query = "UPDATE PRODUCT SET IMAGE = '$newFileName' WHERE id=$id;";
            
                    // run insert query
                    queryDB($query, $db);
            } else {
                echo "error copying image";
            }
    	}
                    
            //
            // now we need to update the toppings
            //
            
            
            // now that we are done, send user back to product.php and exit 
            header("Location: manageP.php?successmessage=Successfully updated");
            exit;
        }        
    } else {
        //
        // if the form was not submitted (first time in)
        //
    
        /*
         * Check if a GET variable was passed with the id for the product
         *
         */
         if(!isset($_GET['ID'])) {
            // if the id was not passed through the url
            
            // send them out to manageP.php and stop executing code in this page
            header('Location: manageP.php');
            exit;
        }
        
        /*
         * Now we'll check to make sure the id passed through the GET variable matches the id of a product in the database
         */
        
        // connect to the database
        $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
        
        // set up a query
        
        $id = $_GET['ID'];
        $query = "SELECT * FROM PRODUCT WHERE ID=$id;";
        
        // run the query
        $result = queryDB($query, $db);
        
        // if the id is not in the product table, then we need to send the user back to pizza.php
        if (nTuples($result) == 0) {
            // send them out to manageP.php and stop executing code in this page
            header('Location: manageP.php');
            exit;
        }
        
        /*
         * Now we know we got a valid product id through the GET variable
         */
        
        // get data on product to fill out form with existing values
        $row = nextTuple($result);
        
        $pname = $row['PNAME'];
        $description = $row['DESCRIPTION'];
   
        $price = $row['PRICE'];
        $qty = $row['QTY'];
        
        
        
    }
?>


<html>
    <head>
<!-- Bootstrap links -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>        
        
        <title>Update profile <?php echo $pname; ?></title>
    </head>
    
    <body>
       
<!-- Title -->
<div class="row">
    <div class="col-xs-12">
        <h1>Update Product</h1>        
    </div>
</div>


<!-- Showing errors, if any -->
<div class="row">
    <div class="col-xs-12">
<?php
    if (isset($isComplete) && !$isComplete) {
        // executes only if form was previously submitted (and therefore $isComplete is set) and isComplete was set to false
        // you'll never be here if the form wasn't submitted (the first time you get in)
        
        echo '<div class="alert alert-danger" role="alert">';
        echo ($errorMessage);
        echo '</div>';
    }
?>            
    </div>
</div>



<!-- form to update product -->
<div class="row">
    <div class="col-xs-12">
        
<form action="updateproduct.php" method="post" enctype="multipart/form-data">
<!-- name -->
<div class="form-group">
    <label for="PNAME">Product Name:</label>
    <input type="text" class="form-control" name="PNAME" value="<?php if($pname) { echo $pname; } ?>"/>
</div>

<div class="form-group">
    <label for="DESCRIPTION">Description:</label>
    <input type="text" class="form-control" name="DESCRIPTION" value="<?php if($description) { echo $description; } ?>"/>
</div>

<div class="form-group">
    <label for="PRICE">Price:</label>
    <input type="text" class="form-control" name="PRICE" value="<?php if($price) { echo $price; } ?>"/>
</div>

<div class="form-group">
    <label for="QTY">QTY:</label>
    <input type="text" class="form-control" name="QTY" value="<?php if($qty) { echo $qty; } ?>"/>
</div>

 <div class="form-group">
    <label for="IMAGE">Picture of product</label>
    <input type="file" style="width: 500" class="form-control" name="IMAGE"/>
</div>



<!-- hidden id (not visible to user, but need to be part of form submission so we know which product we are updating -->
<input type="hidden" name="ID" value="<?php echo $id; ?>"/>

<button type="submit" class="btn btn-default" name="submit">Save</button>

</form>
        
        
    </div>
</div>

       
       
        
    </body>
</html>