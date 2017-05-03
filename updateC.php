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

<?php
	include_once('config.php');
	include_once('dbutils.php');
	$title ="Categories";
	$h1 = "Categories";
	$menuActive=2;
	include_once("staffHeader.php");
    
    
    if (isset($_POST['submit'])) {
        // process the update if the form was submitted
        
        // get data from form
        $id = $_POST['ID'];
        if (!isset($id)) {
            // if for some reason the id didn't post, kick them back to manageC.php
            header('Location: manageC.php');
            exit;
        }

        // get data from form
        $cname = $_POST['CNAME'];        
        
        // variable to keep track if the form is complete (set to false if there are any issues with data)
        $isComplete = true;
        
        // error message we'll give user in case there are issues with data
        $errorMessage = "";
                
        // check each of the required variables in the table        
        
        // If there's an error, they'll go back to the form so they can fix it
        
        if($isComplete) {
            
            $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
           
            // put together SQL statement to update Category
            
			
            
			
			
			
			
			
            
			$query = "UPDATE CATEGORY SET CNAME='$cname' WHERE ID=$id;";
            
            
            // connect to the database
            //$db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
            
            // run the update
            queryDB($query, $db);
			 
            
          
                    
           
            
            
            // now that we are done, send user back to manageC.php and exit 
            header("Location: manageC.php?successmessage=Successfully updated");
            exit;
        }        
    } else {
        //
        // if the form was not submitted (first time in)
        //
    
        /*
         * Check if a GET variable was passed with the id for the manageC
         *
         */
         if(!isset($_GET['ID'])) {
            // if the id was not passed through the url
            
            // send them out to manageC.php and stop executing code in this page
            header('Location: manageC.php');
            exit;
        }
        
        /*
         * Now we'll check to make sure the id passed through the GET variable matches the id of a Category in the database
         */
        
        // connect to the database
        $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
        
        // set up a query
        
        $id = $_GET['ID'];
        $query = "SELECT * FROM CATEGORY WHERE ID=$id;";
        
        // run the query
        $result = queryDB($query, $db);
        
        // if the id is not in the category table, then we need to send the user back to manageC.php
        if (nTuples($result) == 0) {
            // send them out to manageC.php and stop executing code in this page
            header('Location: manageC.php');
            exit;
        }
        
        /*
         * Now we know we got a valid category id through the GET variable
         */
        
        // get data on category to fill out form with existing values
        $row = nextTuple($result);
        
        $cname = $row['CNAME'];
        
        
        
        
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
        
        <title>Update Category <?php echo $cname; ?></title>
    </head>
    
    <body>
       
<!-- Title -->
<div class="row">
    <div class="col-xs-12">
        <h1>Update Category</h1>        
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



<!-- form to update category -->
<div class="row">
    <div class="col-xs-12">
        
<form action="updateC.php" method="post">
<!-- name -->
<div class="form-group">
    <label for="CNAME">Product Name:</label>
    <input type="text" class="form-control" name="CNAME" value="<?php if($cname) { echo $cname; } ?>"/>
</div>





<!-- hidden id (not visible to user, but need to be part of form submission so we know which category we are updating -->
<input type="hidden" name="ID" value="<?php echo $id; ?>"/>

<button type="submit" class="btn btn-default" name="submit">Save</button>

</form>
        
        
    </div>
</div>

       
       
        
    </body>
</html>