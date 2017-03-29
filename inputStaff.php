<?php
	include_once('config.php');
	include_once('dbutils.php');
?>

<html>
	<head>
	
	<title>Enter Users</title>
		<neta name="viewport" content="width=device-widthe, initial-scale-1.0">
	
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
	</head>
	
	<body>
	
	<div class="row">
		<div class="col-xs-12">
			<h1>Enter Staff Members</h1>
		</div>
	</div>
	
	<!---Processing form input--->
	<div class="row">
		<div class="col-xs-12">
		
	<?php
		if (isset($_POST['submit'])) 
		{
			//only run if the form was submitted
			//get data from form
			$email = $_POST['email'];
			$password = $_POST['password'];
			$password2 = $_POST['password2'];
			$admin =$_POST['admin'];
			
			//connect to database
			$db=connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
			
			//check for required fields
			$isComplete = true;
			$errorMessage="";
			
			if (!$email)
			{
				$errorMessage .= "Please enter an email.";
				$isComplete = false;
			} 
			else { $email= makeStringSafe($db,$email);}
			
			if (!$password)
			{
				$errorMessage .="Please enter a password.";
				$isComplete = false;
			}
			
			if (!$password2)
			{
				$errorMessage .="Please enter a password again.";
				$isComplete=false;
			}
			
			if ($password != $password2)
			{
				$errorMessage .="Your two passwords do not match.";
				$isComplete = false;
			}
			
			if (!$admin)
			{
				$errorMessage .="Please choose if this staff member has admin priva.";
				$isComplete=false;
			}
			
			if ($isComplete)
			{
				//check if there's a user with the same email
				$query = "SELECT * FROM USERS WHERE EMAIL='" . $email . "';";
				$result = queryDB($query, $db);
				if(nTuples($result) == 0)
				{
					//if we're here it means there's already a user with the same email
					//generate the hashed version of the password
					$hashedpass = crypt($password, getSalt());
					
					//put together sql code to isert tuple or record
					$insert ="INSERT INTO USERS(EMAIL, HASHEDPASS) VALUES ('" . $email . "', '" . $hashedpass . "');";
					
					//run insert
					$result = queryDB($insert, $db);
					
					//we have successfully inserted
					echo("Successfully entered " . $email . " into the database.");
				} else 
				{
					$isComplete=false; 
					$errorMessage ="Sorry. We already have a user account under this email.";
				}
			}
		}
	?>
		</div>
	</div>
	<!--showing errors if any--->
	<div class ="row">
		<div class="col-xs-12">
		<?php
			if(isset($isComplete) && !$isComplete)
			{
				echo '<div class="alert alert-danger" role="alert">';
				echo ($errorMessage);
				echo '</div>';
			}
		?>
		</div>
	</div>
	
	<!--form for inputting data-->
	<div class="row">
		<div class="col-xs-12">
		
<form action = "inputUser.php" method="post">
	<div class ="form-group">
		<label for="email">Email</label>
		<input type="email" class="form-control" name="email"/>
	</div>
	
	<div class="form-group">
		<label for="password">Password</label>
		<input type="password" class="form-control" name="password"/>
	</div>
	
	<div class="form-group">
		<label for="password2">Enter password again</label>
		<input type="password" class="form-control" name="password2"/>
	</div>
	
	<button type ="submit" class="btn btn-default" name="submit">Add</button>
</form>
		</div>
	</div>
	
	<p>Already have an account? Click <a href="login.php"> here</a> to login.</p>
	</body>
</html>