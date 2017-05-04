
	<?php
//kicks users out if they are not logged in
	session_start();
	if (!isset($_SESSION['COOKIE']))
	{
		header('Location: selectSguest.php');
		exit;
	}
		if (!isset($_SESSION['STORE']))
	{
		header('Location: selectSguest.php');
		exit;
	}
?>
<?php
	include_once('config.php');
	include_once('dbutils.php');

	$title ="Shopping Cart";
	$h1 = "Shopping Cart";
	$menuActive=5;
	include_once("guestheader.php");

?>
	<body>
	
	<div class="row">
		<div class="col-xs-12">
			<h1>Enter Payment Information</h1>
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
			$FNAME = $_POST['fname'];
			$LNAME = $_POST['lname'];
			$STREET = $_POST['street'];
			$CITY = $_POST['city'];
			$STATE = $_POST['state'];
			$ZIP = $_POST['zip'];
			$PHONE = $_POST['phone'];
			$CARDNAME = $_POST['cardname'];
			$CARDNUMBER = $_POST['cardnumber'];
			$EXMONTH = $_POST['exmonth'];
			$EXYEAR = $_POST['exyear'];
			$CCV = $_POST['ccv'];
			
			//connect to database
			$db=connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
			
			//check for required fields
			$isComplete = true;
			$errorMessage="";
			
			if (!$FNAME)
			{
				$errorMessage .="Please enter your first name.";
				$isComplete = false;
			}
			
			if (!$LNAME)
			{
				$errorMessage .="Please enter your last name.";
				$isComplete = false;
			}
			
			if (!$STREET)
			{
				$errorMessage .="Please enter your street address.";
				$isComplete = false;
			}
			
			if (!$STATE)
			{
				$errorMessage .="Please select a state.";
				$isComplete = false;
			}
			
			if (!$ZIP)
			{
				$errorMessage .="Please enter your zip code.";
				$isComplete = false;
			}
			
			if (!$PHONE)
			{
				$errorMessage .="Please enter your phone number.";
				$isComplete = false;
			}
			
			if (!$CARDNUMBER)
			{
				$errorMessage .="Please fill out the name on the card.";
				$isComplete = false;
			}
			if (!$CARDNUMBER)
			{
				$errorMessage .="Please fill out the card number.";
				$isComplete = false;
			}
			if (!$EXMONTH)
			{
				$errorMessage .="Please fill out the card's expiration month.";
				$isComplete = false;
			}
			if (!$EXYEAR)
			{
				$errorMessage .="Please fill out the card's expiration year.";
				$isComplete = false;
			}
			if (!$CCV)
			{
				$errorMessage .="Please fill out the card's ccv.";
				$isComplete = false;
			}
			if ($isComplete)
			{
				$db=connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
			$queryx="INSERT INTO ORDERS (USERID, FNAME, LNAME, STREET, CITY, USSTATE, ZIP, PHONE, 
			STOREID, ORDERDATE, ORDERTIME, CARDNAME, CARDNUMBER, EXMONTH, EXYEAR, CCV, STATUS, TOTALP) VALUES ('" . $USERID . "', '" . $FNAME . "', 
			'" . $LNAME . "', '" . $STREET . "', '" . $CITY . "', '" . $USSTATE . "', '" . $ZIP . "', 
			'" . $PHONE . "', '" . $_SESSION['STORE'] . "', '" . $_SESSION['D'] . "', 
			'" . $_SESSION['T'] . "', '" . $CARDNAME . "', '" . $CARDNUMBER . "',
			'" . $EXMONTH . "', '" . $EXYEAR . "', '" . $CCV . "', 
			'ORDER PLACED', '" . $_SESSION['TOTALP'] . "') ;";
			queryDB($queryx, $db);
			$remove="DELETE FROM TEMP WHERE COOKIE='" . $_SESSION['COOKIE'] . "';";
			queryDB($remove, $db);
			}
			$query="SELECT MAX(ID) FROM ORDERS;";
			$result=queryDB($query, $db);
			while($row = nextTuple($result))
			{
			if (session_start())
			{$row['ID']=$_SESSION['CONFIRM'];
			header("Location: guestconfirm.php?ID='" . $_SESSION['CONFIRM'] . "'");
				exit;}
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
			<div id="container">
		
<form action = "processguest.php" method="post">
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
	
	<button type ="submit" class="btn btn-default" name="submit">Add</button>
</form>
		</div>
	</div>
	