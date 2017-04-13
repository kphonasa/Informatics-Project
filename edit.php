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

	$title ="Edit Profile";
	$h1 = "Edit Profile";
	$menuActive=4;
	include_once("shopperheader.php");
?>
	<body>
	
	<div class="row">
		<div class="col-xs-12">
			<h1>Edit Profile</h1>
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
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$street = $_POST['street'];
			$city = $_POST['city'];
			$state = $_POST['state'];
			$zip = $_POST['zip'];
			$phone = $_POST['phone'];
			$cardname = $_POST['cardname'];
			$cardnumber = $_POST['cardnumber'];
			$exmonth = $_POST['exmonth'];
			$exyear = $_POST['exyear'];
			$ccv = $_POST['ccv'];
			
			//connect to database
			$db=connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
			
			//check for required fields
		
			

			if ($fname)
			{
				//check if there's a user with the same email
				$query = "UPDATE USERS1 SET FNAME ='" . $fname . "' WHERE EMAIL='" . $_SESSION['email'] . "';";
				$result = queryDB($query, $db);
			}
			if ($lname)
			{
				//check if there's a user with the same email
				$query = "UPDATE USERS1 SET LNAME ='" . $lname . "' WHERE EMAIL='" . $_SESSION['email'] . "';";
				$result = queryDB($query, $db);
			}
			if ($street)
			{
				//check if there's a user with the same email
				$query = "UPDATE USERS1 SET STREET ='" . $street . "' WHERE EMAIL='" . $_SESSION['email'] . "';";
				$result = queryDB($query, $db);
			}
			if ($city)
			{
				//check if there's a user with the same email
				$query = "UPDATE USERS1 SET CITY ='" . $city . "' WHERE EMAIL='" . $_SESSION['email'] . "';";
				$result = queryDB($query, $db);
			}
			if ($state)
			{
				//check if there's a user with the same email
				$query = "UPDATE USERS1 SET USSTATE ='" . $state . "' WHERE EMAIL='" . $_SESSION['email'] . "';";
				$result = queryDB($query, $db);
			}
			if ($zip)
			{
				//check if there's a user with the same email
				$query = "UPDATE USERS1 SET ZIP ='" . $zip . "' WHERE EMAIL='" . $_SESSION['email'] . "';";
				$result = queryDB($query, $db);
			}
			if ($phone)
			{
				//check if there's a user with the same email
				$query = "UPDATE USERS1 SET PHONE ='" . $phone . "' WHERE EMAIL='" . $_SESSION['email'] . "';";
				$result = queryDB($query, $db);
			}
			if ($cardname)
			{
				//check if there's a user with the same email
				$query = "UPDATE USERS1 SET CARDNAME ='" . $cardname . "' WHERE EMAIL='" . $_SESSION['email'] . "';";
				$result = queryDB($query, $db);
			}
			if ($cardnumber)
			{
				//check if there's a user with the same email
				$query = "UPDATE USERS1 SET CARDNUMBER ='" . $cardnumber . "' WHERE EMAIL='" . $_SESSION['email'] . "';";
				$result = queryDB($query, $db);
			}
			if ($exmonth)
			{
				//check if there's a user with the same email
				$query = "UPDATE USERS1 SET EXMONTH ='" . $exmonth . "' WHERE EMAIL='" . $_SESSION['email'] . "';";
				$result = queryDB($query, $db);
			}
			if ($exyear)
			{
				//check if there's a user with the same email
				$query = "UPDATE USERS1 SET EXYEAR ='" . $exyear . "' WHERE EMAIL='" . $_SESSION['email'] . "';";
				$result = queryDB($query, $db);
			}
			if ($ccv)
			{
				//check if there's a user with the same email
				$query = "UPDATE USERS1 SET CCV ='" . $ccv . "' WHERE EMAIL='" . $_SESSION['email'] . "';";
				$result = queryDB($query, $db);
			}
			echo("Successfully updated profile.");
		}
		else if (isset($_POST['delete']))
			{header('Location: deleteuser.php');
			exit;}
		
	?>
		</div>
	</div>
	<!--showing errors if any--->

	<!--form for inputting data-->
	<div class="row">
		<div class="col-xs-12">
			<div id="container">
		
<form action = "edit.php" method="post">
	<div class="form-group">
		<label for="fname">First Name</label>
		<input type="text" style="width: 500" class="form-control" name="fname"/>
	</div>
	
	<div class="form-group">
		<label for="lname">Last Name</label>
		<input type="text" style="width: 500" class="form-control" name="lname"/>
	</div>
	
	<div class="form-group">
		<label for="street">Street Address</label>
		<input type="text" style="width: 500" class="form-control" name="street"/>
	</div>
	
	<div class="form-group">
		<label for="city">City</label>
		<input type="text" style="width: 500" class="form-control" name="city"/>
	</div>
	
	<div class="form-group" > <!-- State Button -->
		<label for="state" class="control-label">State</label>
		<select class="form-control" style="width: 500" name="state">
			<option value="AL">Alabama</option>
			<option value="AK">Alaska</option>
			<option value="AZ">Arizona</option>
			<option value="AR">Arkansas</option>
			<option value="CA">California</option>
			<option value="CO">Colorado</option>
			<option value="CT">Connecticut</option>
			<option value="DE">Delaware</option>
			<option value="DC">District Of Columbia</option>
			<option value="FL">Florida</option>
			<option value="GA">Georgia</option>
			<option value="HI">Hawaii</option>
			<option value="ID">Idaho</option>
			<option value="IL">Illinois</option>
			<option value="IN">Indiana</option>
			<option value="IA">Iowa</option>
			<option value="KS">Kansas</option>
			<option value="KY">Kentucky</option>
			<option value="LA">Louisiana</option>
			<option value="ME">Maine</option>
			<option value="MD">Maryland</option>
			<option value="MA">Massachusetts</option>
			<option value="MI">Michigan</option>
			<option value="MN">Minnesota</option>
			<option value="MS">Mississippi</option>
			<option value="MO">Missouri</option>
			<option value="MT">Montana</option>
			<option value="NE">Nebraska</option>
			<option value="NV">Nevada</option>
			<option value="NH">New Hampshire</option>
			<option value="NJ">New Jersey</option>
			<option value="NM">New Mexico</option>
			<option value="NY">New York</option>
			<option value="NC">North Carolina</option>
			<option value="ND">North Dakota</option>
			<option value="OH">Ohio</option>
			<option value="OK">Oklahoma</option>
			<option value="OR">Oregon</option>
			<option value="PA">Pennsylvania</option>
			<option value="RI">Rhode Island</option>
			<option value="SC">South Carolina</option>
			<option value="SD">South Dakota</option>
			<option value="TN">Tennessee</option>
			<option value="TX">Texas</option>
			<option value="UT">Utah</option>
			<option value="VT">Vermont</option>
			<option value="VA">Virginia</option>
			<option value="WA">Washington</option>
			<option value="WV">West Virginia</option>
			<option value="WI">Wisconsin</option>
			<option value="WY">Wyoming</option>
		</select>	
			</div>
	</div>
	
	<div class="form-group">
		<label for="zip">Zip Code</label>
		<input type="text" style="width: 500" class="form-control" name="zip"/>
	</div>
	
	<div class="form-group">
		<label for="phone">Phone Number</label>
		<input type="text" style="width: 500" class="form-control" name="phone"/>
	</div>
	
	<div class="form-group">
		<label for="cardname">Enter the Full Name on Card</label>
		<input type="text" style="width: 500" class="form-control" name="cardname"/>
	</div>
	
	<div class="form-group">
		<label for="cardnumber">Card Number</label>
		<input type="text" style="width: 500" class="form-control" name="cardnumber"/>
	</div>
	
	<div class="form-group">
		<label for="exmonth">Expiration Month</label>
		<input type="text" style="width: 100" class="form-control" name="exmonth"/>
	</div>

	<div class="form-group">
		<label for="exyear">Expiration Year</label>
		<input type="text" style="width: 100" class="form-control" name="exyear"/>
	</div>
	
	<div class="form-group">
		<label for="ccv">CCV</label>
		<input type="text" style="width: 100" class="form-control" name="ccv"/>
	</div>
	
	<button type ="submit" class="btn btn-default" name="submit">Update</button>
	<button type ="submit" class="btn btn-default" name="delete">Delete</button>
</form>
		</div>
	</div>
	<?php
	include_once("footer.php");
?>