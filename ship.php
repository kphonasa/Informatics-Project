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
 * This php file prompts users on whether they ship the order
 * It obtains the id for the pizza to delete from an id variable passed using the GET method (in the url)
 *
 */
    include_once('config.php');
    include_once('dbutils.php');
    
    
    if (isset($_POST['submit'])) {
        // process the update (if selected) if the form below was submitted        
        
        // get data from form
        $id = $_POST['id'];
        $delete = $_POST['ship'];
        
        if ($delete == 'yes') {
            // if the user said yes to update, we need to update the order with id = $id
            
            // connect to the database
            $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
            
            
            $query = "UPDATE ORDERS SET STATUS='Shipping' WHERE ID=$id AND STOREID='" . $_SESSION['STOREID'] . "';";
            
            // run the update statement 
            queryDB($query, $db);
            
           
        }
        
        // send user back to manageD.php and exit 
        header('Location: manageD.php');
        exit;
    }
    
    

    /*
     * Check if a GET variable was passed with the id for the order
     *
     */
    if(!isset($_GET['ID'])) {
        // if the id was not passed through the url
        
        // send them out to manageD.php and stop executing code in this page
        header('Location: manageD.php');
        exit;
    }
    
    /*
     * Now we'll check to make sure the id passed through the GET variable matches the id of a order in the database
     */
    
    // connect to the database
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    
    // set up a query
    $id = $_GET['ID'];
    $query = "SELECT * FROM ORDERS WHERE ID=$id;";
    
    // run the query
    $result = queryDB($query, $db);
    
    // if the id is not in the order table, then we need to send the user back to manageD.php
    if (nTuples($result) == 0) {
        // send them out to manageD.php and stop executing code in this page
        header('Location: manageD.php');
        exit;
    }
    
    /*
     * Now we know we got a valid order id through the GET variable
     */
    
    // get some data from the order table to ask a better question when confirming deletion
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
        
        <title>SHIP <?php echo $id; ?> ?</title>
    </head>
    
    <body>
        
<!-- Visible title -->
<div class="row">
    <div class="col-xs-12">
        <h1>Do you want to ship the order <?php echo $id; ?> </h1>
    </div>
</div>

<!-- form to ask users to confim update -->
<div class="row">
    <div class="col-xs-12">
<form action="ship.php" method="post">
    <div class="radio">
        <label>
            <input type="radio" name="ship" value="yes" checked>
            Yes
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="ship" value="no">
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