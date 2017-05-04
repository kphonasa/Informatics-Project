<?php
	include_once('config.php');
	include_once('dbutils.php');
?>

<html>
	<head>
	
	<title>Login</title>
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
			<h1>Login</h1>
		</div>
	</div>
		<!---Processing form input--->
	<div class="row">
		<div class="col-xs-12">
<!--php--->
<?php
//Code to handle input form

if (isset($_POST['submit']))
{
	//get data from form
	$email=$_POST['email'];
	$password=$_POST['password'];

	//connect to database
	$db=connectDB($DBHost,$DBUser,$DBPasswd,$DBName);

	//check for required fields
	$isComplete=true;
	$errorMessage="";

	if(!$email)
	{
		$errorMessage .= "Please enter an email.";
		$isComplete=false;
	} else{$email=makeStringSafe($db,$email);}

	if(!$password)
	{
		$errorMessage .="Please enter a password.";
		$isComplete=false;
	}

	if(!$isComplete)
	{
		punt($errorMessage);
	}

	//get the hashed password from the user with the email that got entered
	$query="SELECT HASHEDPASS FROM USERS1 WHERE EMAIL='" . $email . "';";
	$result=queryDB($query, $db);
	if (nTuples($result)>0)
	{
		//there is an account that corresponds to the email that the user entered
		//get the hashed pass for the account
		$row = nextTuple($result);
		$hashedpass = $row['HASHEDPASS'];
	
		//compare entered pass to pass in database
		if ($hashedpass==crypt($password, $hashedpass))
		{
			if (session_start())
			{
				$_SESSION['email']=$email;
				header("Location: selectS.php");
				exit;
			}
			else{punt("Unable to start seesion when logged in.");}
		}
		else {punt("Wrong password. <a href='shopperlogin.php'>Try again</a>.");}
	}
	else{punt("This email is not in our system. <a href='shopperlogin.php'> Try again</a>.");}
	

}
?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
		
<!--form-->
<form action="shopperlogin.php" method="post">
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" style="width: 500" class="form-control" name="email"/>
	</div>
	
	<div class="form-group">
		<label for="password">Password</label>
		<input type="password" style="width: 500" class="form-control" name="password"/>
	</div>
	
	<button type="submit" class="btn btn-default" name="submit">Login</button>
	
</form>
		</div>
	</div>
<p>Set up an account <a href="inputUser.php"> here</a>.</p>
<p>Continue as guest <a href="guesthome.php"> here</a>.</p>


	</body>

</html>