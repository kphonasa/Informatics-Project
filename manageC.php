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
	$title ="Categories";
	$h1 = "Categories";
	$menuActive=2;
	include_once("staffHeader.php");
	
	if(isset($_POST['submit'])){
    //if we are here, it means that the form was submitted and we need to process form data
    
    //get data from form
	$storeid=$_SESSION['STOREID'];
    $name=$_POST['CNAME'];
    
    //variable to keep track if the form is complete (set to false if there are any issue with data)
    $isComplete=true;
    
    //error message 
    $errorMessage="";
    
	if(!$storeid){
        $errorMessage .= "Please enter storeid.\n";
        $isComplete =false;
    }
    if(!$name){
        $errorMessage .= "Please enter name.\n";
        $isComplete =false;
    } else{
        //connect database
        $db= connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
        
        
        $query ="SELECT CNAME FROM CATEGORY WHERE CNAME='$name' AND CATEGORY.STOREID=$storeid;";
        
        //run query
        $result =queryDB($query,$db);
        
        if(nTuples($result)>0){
            $isComplete =false;
            $errorMessage .="The name is already in the database.\n";
        }
    }
    
    
    
    //Stop execution and show error if the form is not complete
    if($isComplete){
        
    
    
    //put together SQL to insert new record
    $query="INSERT INTO CATEGORY(STOREID,CNAME) VALUES ($storeid,'$name');";
    
    //get a handle to database
     $db= connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
     
     //run the insert statement
     $result =queryDB($query,$db);
     
     //we have successfully enter the data
     echo("Successfully entered new category: " . $name);
     
     unset($isComplete,$errorMessage,$storeid,$name);
	 header('Location: manageC.php');
	 exit;
	 
    }
}
?>



<div class="row">
    <div class="col-xs-12">
        <h1>category</h1>
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

<!--form-->

<div class="row">
    <div class="col-xs-12">

<form action="manageC.php" method="post">
<!--name-->


<!--country-->
<div class="form-group">
    <label for="CNAME">Name:</label>
    <input type="text" class="form-control" name="CNAME" value="<?php if($name){echo $name; } ?>"/>
</div>

 
<button type="submit" class="btn-btn-default" name="submit">Save</button>
 
</form> 
        
    </div>
</div>





<!--show category-->
	<table class='table table-hover'>


		<!--include config and util files-->
		<?php
		//connect to the database
		$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
		//Set up the query to get information on the cars from the database

		
		//run the query
		if (isset($_POST['submit']))
		{$query = $_POST['order'];}
		else{$query ="SELECT * FROM CATEGORY WHERE STOREID='" . $_SESSION['STOREID'] . "' ORDER BY CNAME ASC;";}
		$result= queryDB($query, $db);
				
		while($row = nextTuple($result))
		{
			echo'<tr>';
			echo '<td>' . $row['CNAME'] . '</td>';
			echo "<td><a href='deleteC.php?ID=" . $row['ID']  .  "'>delete</a></td>";
			echo "<td><a href='updateC.php?ID=" . $row['ID']  .  "'>update</a></td>";
			echo'</tr>';
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