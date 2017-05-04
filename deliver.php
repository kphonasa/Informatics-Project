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
 * This php file prompts users on whether they want to delete a particular pizza
 * It obtains the id for the pizza to delete from an id variable passed using the GET method (in the url)
 *
 */
    include_once('config.php');
    include_once('dbutils.php');
    
    /*
     * If the user just made a decision on a deletion by using the form below, we process that below
     *
     */
    if (isset($_POST['submit'])) {
        // process the deletion (if selected) if the form below was submitted        
        
        // get data from form
        $id = $_POST['id'];
        $delete = $_POST['deliver'];
        
        if ($delete == 'yes') {
            // if the user said yes to delete, we need to delete the pizza with id = $id
            
            // connect to the database
            $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
            
            // first delete any pizzatopping records that point to this pizza
            $query = "UPDATE ORDERS SET STATUS='Delivered' WHERE ID=$id AND STOREID='" . $_SESSION['STOREID'] . "';";
            
            // run the delete statement to remove pizzatopping records that point to this pizza
            queryDB($query, $db);
            
           
        }
        
        // send user back to pizza.php and exit 
        header('Location: manageD.php');
        exit;
    }
    
    
    /*
     * Check if a GET variable was passed with the id for the pizza
     *
     */
    if(!isset($_GET['ID'])) {
        // if the id was not passed through the url
        
        // send them out to pizza.php and stop executing code in this page
        header('Location: manageD.php');
        exit;
    }
    
    /*
     * Now we'll check to make sure the id passed through the GET variable matches the id of a pizza in the database
     */
    
    // connect to the database
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    
    // set up a query
    $id = $_GET['ID'];
    $query = "SELECT * FROM ORDERS WHERE ID=$id;";
    
    // run the query
    $result = queryDB($query, $db);
    
    // if the id is not in the pizza table, then we need to send the user back to pizza.php
    if (nTuples($result) == 0) {
        // send them out to pizza.php and stop executing code in this page
        header('Location: manageD.php');
        exit;
    }
    
    /*
     * Now we know we got a valid pizza id through the GET variable
     */
    
    // get some data from the pizza table to ask a better question when confirming deletion
    $row = nextTuple($result);
    
    $id = $row['ID'];    
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
        
        <title>deliver <?php echo $id; ?> ?</title>
    </head>
    
    <body>
        
<!-- Visible title -->
<div class="row">
    <div class="col-xs-12">
        <h1>Do you want to deliver the order <?php echo $id; ?> </h1>
    </div>
</div>

<!-- form to ask users to confim deletion -->
<div class="row">
    <div class="col-xs-12">
<form action="deliver.php" method="post">
    <div class="radio">
        <label>
            <input type="radio" name="deliver" value="yes" checked>
            Yes
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="deliver" value="no">
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