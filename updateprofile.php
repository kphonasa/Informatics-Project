<?php
/*
 * This php file enables users to edit a particular pizza
 * It obtains the id for the pizza to update from an id variable passed using the GET method (in the url)
 *
 */
    include_once('config.php');
    include_once('dbutils.php');
    session_start();
    if (!isset($_SESSION['email']))
    {
        header('Location: shopperlogin.php');
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
            // if for some reason the id didn't post, kick them back to pizza.php
            header('Location: profile.php');
            exit;
        }

        // get data from form
        $firstname = $_POST['FNAME'];
        $lastname = $_POST['LNAME'];
        $street = $_POST['STREET'];
        $city = $_POST['CITY'];
        $state = $_POST['USSTATE'];
        
        $zip = $_POST['ZIP'];
        $phonenumber=$_POST['PHONE'];
        $cardname = $_POST['CARDNAME'];
        $cardnumber = $_POST['CARDNUMBER'];
        $xm = $_POST['EXMONTH'];
        $xy = $_POST['EXYEAR'];
        $ccv = $_POST['CCV'];
        
        
        // variable to keep track if the form is complete (set to false if there are any issues with data)
        $isComplete = true;
        
        // error message we'll give user in case there are issues with data
        $errorMessage = "";
        
        
        // check each of the required variables in the table        
        if (!isset($firstname)) {
            $errorMessage .= "Please enter a First Name for the user.\n";
            $isComplete = false;
        }
        
        if (!isset($lastname)) {
            $errorMessage .= "Please enter a last name for the pizza.\n";
            $isComplete = false;
        }
        
        if (!isset($street)) {
            $errorMessage .= "Please enter street for the user.\n";
            $isComplete = false;
        }
        
        
        if (!isset($city)) {
            $errorMessage .= "Please enter city.\n";
            $isComplete = false;
        }
        if (!isset($state)) {
            $errorMessage .= "Please enter state.\n";
            $isComplete = false;
        }
        if (!isset($zip)) {
            $errorMessage .= "Please enter zip code.\n";
            $isComplete = false;
        }
        if (!isset($phonenumber)) {
            $errorMessage .= "Please enter phone.\n";
            $isComplete = false;
        }
        // If there's an error, they'll go back to the form so they can fix it
        
        if($isComplete) {
            // if there's no error, then we need to update
            
            //
            // first update pizza record
            //
            // put together SQL statement to update pizza
            $query = "UPDATE USERS1 SET FNAME='$firstname', LNAME='$lastname', STREET='$street', CITY='$city', USSTATE='$state', ZIP='$zip', PHONE='$phonenumber', CARDNAME='$cardname', CARDNUMBER=$cardnumber, EXMONTH=$xm, EXYEAR=$xy, CCV=$ccv  WHERE ID=$id;";
            
            // connect to the database
            $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
            
            // run the update
            $result = queryDB($query, $db);            
                    
            //
            // now we need to update the toppings
            //
            
            
            // now that we are done, send user back to pizza.php and exit 
            header("Location: profile.php?successmessage=Successfully updated");
            exit;
        }        
    } else {
        //
        // if the form was not submitted (first time in)
        //
    
        /*
         * Check if a GET variable was passed with the id for the pizza
         *
         */
         if(!isset($_GET['ID'])) {
            // if the id was not passed through the url
            
            // send them out to pizza.php and stop executing code in this page
            header('Location: profile.php');
            exit;
        }
        
        /*
         * Now we'll check to make sure the id passed through the GET variable matches the id of a pizza in the database
         */
        
        // connect to the database
        $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
        
        // set up a query
        
        $id = $_GET['ID'];
        $query = "SELECT * FROM USERS1 WHERE ID=$id;";
        
        // run the query
        $result = queryDB($query, $db);
        
        // if the id is not in the pizza table, then we need to send the user back to pizza.php
        if (nTuples($result) == 0) {
            // send them out to pizza.php and stop executing code in this page
            header('Location: profile.php');
            exit;
        }
        
        /*
         * Now we know we got a valid pizza id through the GET variable
         */
        
        // get data on pizza to fill out form with existing values
        $row = nextTuple($result);
        
        $firstname = $row['FNAME'];
        $lastname = $row['LNAME'];
        $street = $row['STREET'];
        $city = $row['CITY'];
        $state = $row['USSTATE'];
        
        $zip = $row['ZIP'];
        $phonenumber=$row['PHONE'];
        $cardname = $row['CARDNAME'];
        $cardnumber = $row['CARDNUMBER'];
        $xm = $row['EXMONTH'];
        $xy = $row['EXYEAR'];
        $ccv = $row['CCV'];
        
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
        
        <title>Update profile <?php echo $name; ?></title>
    </head>
    
    <body>
       
<!-- Title -->
<div class="row">
    <div class="col-xs-12">
        <h1>Update pizza</h1>        
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



<!-- form to update pizza -->
<div class="row">
    <div class="col-xs-12">
        
<form action="updateprofile.php" method="post">
<!-- name -->
<div class="form-group">
    <label for="FNAME">First Name:</label>
    <input type="text" class="form-control" name="FNAME" value="<?php if($firstname) { echo $firstname; } ?>"/>
</div>

<div class="form-group">
    <label for="LNAME">Last Name:</label>
    <input type="text" class="form-control" name="LNAME" value="<?php if($lastname) { echo $lastname; } ?>"/>
</div>

<div class="form-group">
    <label for="STREET">Street:</label>
    <input type="text" class="form-control" name="STREET" value="<?php if($street) { echo $street; } ?>"/>
</div>

<div class="form-group">
    <label for="CITY">City:</label>
    <input type="text" class="form-control" name="CITY" value="<?php if($city) { echo $city; } ?>"/>
</div>

<div class="form-group">
    <label for="USSTATE">State:</label>
    <input type="text" class="form-control" name="USSTATE" value="<?php if($state) { echo $state; } ?>"/>
</div>

<!-- crust -->
<div class="form-group">
    <label for="ZIP">Zip:</label>
    <input type="text" class="form-control" name="ZIP" value="<?php if($zip) { echo $zip; } ?>"/>
</div>


<!-- size -->
<div class="form-group">
    <label for="PHONE">Phone:</label>
    <input type="text" class="form-control" name="PHONE" value="<?php if($phonenumber) { echo $phonenumber; } ?>"/>
</div>

<div class="form-group">
    <label for="CARDNAME">CARD Name:</label>
    <input type="text" class="form-control" name="CARDNAME" value="<?php if($cardname) { echo $cardname; } ?>"/>
</div>

<div class="form-group">
    <label for="CARDNUMBER">Card Number:</label>
    <input type="text" class="form-control" name="CARDNUMBER" value="<?php if($cardnumber) { echo $cardnumber; } ?>"/>
</div>

<div class="form-group">
    <label for="EXMONTH">expiration month:</label>
    <input type="text" class="form-control" name="EXMONTH" value="<?php if($xm) { echo $xm; } ?>"/>
</div>

<div class="form-group">
    <label for="EXYEAR">expiration year:</label>
    <input type="text" class="form-control" name="EXYEAR" value="<?php if($xy) { echo $xy; } ?>"/>
</div>

<div class="form-group">
    <label for="CCV">ccv:</label>
    <input type="text" class="form-control" name="CCV" value="<?php if($ccv) { echo $ccv; } ?>"/>
</div>

<!-- hidden id (not visible to user, but need to be part of form submission so we know which pizza we are updating -->
<input type="hidden" name="ID" value="<?php echo $id; ?>"/>

<button type="submit" class="btn btn-default" name="submit">Save</button>

</form>
        
        
    </div>
</div>

       
       
        
    </body>
</html>