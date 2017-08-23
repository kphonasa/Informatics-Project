<!--profile-->
<?php
//kicks users out if they are not logged in
	session_start();
	if (!isset($_SESSION['email']))
	{
		header('Location: shopperlogin.php');
		exit;
	}
?>
<?php
	include_once('config.php');
	include_once('dbutils.php');

	$title ="Profile";
	$h1 = "Profile";
	$menuActive=4;
	include_once("shopperheader.php");
?>
<div class='row'>
		<div class='col-sm-8'>
			<div><label>First Name:</label></div>
			<div><?php

			//connect to the database
			$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
			$email=($_SESSION['email']);
			$email=makeStringSafe($db,$email);
			//Set up the query to get information on the cars from the database
			$query = "SELECT FNAME FROM USERS1 WHERE EMAIL = '" . $email . "';";
			//run the query
			$result= queryDB($query, $db); 
			while($row = nextTuple($result))
			{echo $row['FNAME'];}?></div>
			
			<div><label>Last Name:</label></div>
			<div>
			<?php

			//connect to the database
			$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
			$email=($_SESSION['email']);
			$email=makeStringSafe($db,$email);
			//Set up the query to get information on the cars from the database
			$query = "SELECT LNAME FROM USERS1 WHERE EMAIL = '" . $email . "';";
			//run the query
			$result= queryDB($query, $db); 
			while($row = nextTuple($result))
			{echo $row['LNAME'];}?></div>
			
			<div><label>Street:</label></div>
			<div><?php
			//connect to the database
			$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
			$email=($_SESSION['email']);
			$email=makeStringSafe($db,$email);
			//Set up the query to get information on the cars from the database
			$query = "SELECT STREET FROM USERS1 WHERE EMAIL = '" . $email . "';";
			//run the query
			$result= queryDB($query, $db); 
			while($row = nextTuple($result))
			{echo $row['STREET'];}?></div>
			
			<div><label>City:</label></div>
			<div><?php
			//connect to the database
			$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
			$email=($_SESSION['email']);
			$email=makeStringSafe($db,$email);
			//Set up the query to get information on the cars from the database
			$query = "SELECT CITY FROM USERS1 WHERE EMAIL = '" . $email . "';";
			//run the query
			$result= queryDB($query, $db); 
			while($row = nextTuple($result))
			{echo $row['CITY'];}?></div>
			
			<div><label>State:</label></div>
			<div><?php
			//connect to the database
			$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
			$email=($_SESSION['email']);
			$email=makeStringSafe($db,$email);
			//Set up the query to get information on the cars from the database
			$query = "SELECT USSTATE FROM USERS1 WHERE EMAIL = '" . $email . "';";
			//run the query
			$result= queryDB($query, $db);
			while($row = nextTuple($result))
			{echo $row['STATE'];}?></div>
			
			<div><label>Zip:</label></div>
			<div><?php
			//connect to the database
			$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
			$email=($_SESSION['email']);
			$email=makeStringSafe($db,$email);
			//Set up the query to get information on the cars from the database
			$query = "SELECT ZIP FROM USERS1 WHERE EMAIL = '" . $email . "';";
			//run the query
			$result= queryDB($query, $db);
			while($row = nextTuple($result))
			{echo $row['ZIP'];} ?></div>
			
			<div><label>Phone Number:</label></div>
			<div><?php
			//connect to the database
			$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
			$email=($_SESSION['email']);
			$email=makeStringSafe($db,$email);
			//Set up the query to get information on the cars from the database
			$query = "SELECT PHONE FROM USERS1 WHERE EMAIL = '" . $email . "';";
			//run the query
			$result= queryDB($query, $db); 
			while($row = nextTuple($result))
			{echo $row['PHONE'];}?></div>
			
			<div><label>Name on Card:</label></div>
			<div><?php
			//connect to the database
			$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
			$email=($_SESSION['email']);
			$email=makeStringSafe($db,$email);
			//Set up the query to get information on the cars from the database
			$query = "SELECT CARDNAME FROM USERS1 WHERE EMAIL = '" . $email . "';";
			//run the query
			$result= queryDB($query, $db); 
			while($row = nextTuple($result))
			{echo $row['CARDNAME'];}?></div>
			
			<div><label>Card Number:</label></div>
			<div><?php
			//connect to the database
			$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
			$email=($_SESSION['email']);
			$email=makeStringSafe($db,$email);
			//Set up the query to get information on the cars from the database
			$query = "SELECT CARDNUMBER FROM USERS1 WHERE EMAIL = '" . $email . "';";
			//run the query
			$result= queryDB($query, $db); 
			while($row = nextTuple($result))
			{echo $row['CARDNUMBER'];}?></div>
			
			<div><label>Expiration Month:</label></div>
			<div><?php
			//connect to the database
			$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
			$email=($_SESSION['email']);
			$email=makeStringSafe($db,$email);
			//Set up the query to get information on the cars from the database
			$query = "SELECT EXMONTH FROM USERS1 WHERE EMAIL = '" . $email . "';";
			//run the query
			$result= queryDB($query, $db); 
			while($row = nextTuple($result))
			{echo $row['EXMONTH'];}?></div>
			
			<div><label>Expiration Year:</label></div>
			<div><?php
			//connect to the database
			$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
			$email=($_SESSION['email']);
			$email=makeStringSafe($db,$email);
			//Set up the query to get information on the cars from the database
			$query = "SELECT EXYEAR FROM USERS1 WHERE EMAIL = '" . $email . "';";
			//run the query
			$result= queryDB($query, $db); 
			while($row = nextTuple($result))
			{echo $row['EXYEAR'];}?></div>
			
			<div><label>CCV:</label></div>
			<div><?php
			//connect to the database
			$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
			$email=($_SESSION['email']);
			$email=makeStringSafe($db,$email);
			//Set up the query to get information on the cars from the database
			$query = "SELECT CCV  FROM USERS1 WHERE EMAIL = '" . $email . "';";
			//run the query
			$result= queryDB($query, $db); 
			while($row = nextTuple($result))
			{echo $row['CCV'];}?></div>
		
			<?php if (isset($_POST['submit']))
			{header('Location: edit.php');
			exit;} ?>
		<form action="profile.php" method="post">
			<div class="form-group">
			<button type="submit" class="btn btn-default" name="submit">Edit</button>
			</div>
		</form>
		</div>
	</div>
<?php
	include_once("footer.php");
?>