<!--Manage Categories Staff-->
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
/*
 * This php file prompts users on whether they want to delete a particular category
 * It obtains the id for the Category to delete from an id variable passed using the GET method (in the url)
 *
 */
    include_once('config.php');
    include_once('dbutils.php');
	$title ="Categories";
	$h1 = "Categories";
	$menuActive=2;
	include_once("staffHeader.php");
    
    /*
     * If the user just made a decision on a deletion by using the form below, we process that below
     *
     */
    $id = $_GET['ID'];
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    
    
	
    $query="SELECT COUNT(*) FROM PRODUCT, CATEGORY WHERE CATEGORY.ID=PRODUCT.CATEGORYID AND CATEGORY.ID=$id;";
    $result=queryDB($query, $db);
	$row=nextTuple($result);
	$n=$row['COUNT(*)'];
	var_dump($row);
	
	
    
    
    if($n>0){
        header("Location: manageC.php?error=cann not delete");
        
        exit;   
    }

	include_once('config.php');
    include_once('dbutils.php');
	
    if (isset($_POST['submit'])) {
        // process the deletion (if selected) if the form below was submitted        
        
        // get data from form
        $id = $_POST['id'];
        $delete = $_POST['delete'];
		
        
        if ($delete == 'yes') {
            // if the user said yes to delete, we need to delete the pizza with id = $id
            
            // connect to the database
            $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
            
            //query
            $query = "DELETE FROM CATEGORY WHERE ID=$id;";
            
            // run 
            queryDB($query, $db);
            
           
        }
        
        // send user back to exit 
        header("Location: manageC.php");
        exit;
    }
    
    

    /*
     * Check if a GET variable was passed with the id for the pizza
     *
     */
    if(!isset($_GET['ID'])) {
        // if the id was not passed through the url
        
        // send them out to pizza.php and stop executing code in this page
        header('Location: manageC.php');
        exit;
    }
    
    /*
     * Now we'll check to make sure the id passed through the GET variable matches the id of a pizza in the database
     */
    
    // connect to the database
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    
    // set up a query
    $id = $_GET['ID'];
    $query = "SELECT * FROM CATEGORY WHERE ID=$id;";
    
    // run the query
    $result = queryDB($query, $db);
    
    // if the id is not in the Category table, then we need to send the user back to manageC.php
    if (nTuples($result) == 0) {
        // send them out to pizza.php and stop executing code in this page
        header('Location: manageC.php');
        exit;
    }
    
    
    
    // get some data from the Category table to ask a better question when confirming deletion
    $row = nextTuple($result);
    
    $name = $row['CNAME'];
	
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
        
        <title>Delete <?php echo $name; ?> ?</title>
    </head>
    
    <body>
        
<!-- Visible title -->
<div class="row">
    <div class="col-xs-12">
        <h1>Do you want to delete the <?php echo $name; ?> </h1>
    </div>
</div>

<!-- form to ask users to confim deletion -->
<div class="row">
    <div class="col-xs-12">
<form action="deleteC.php" method="post">
    <div class="radio">
        <label>
            <input type="radio" name="delete" value="yes" checked>
            Yes
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="delete" value="no">
            No
        </label>
    </div>
    
    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
    
    <button type="submit" class="btn btn-default" name="submit">Submit</button>
</form>

    </div>
</div>
        
    </body>
</html>