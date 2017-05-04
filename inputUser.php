<?php
	include_once('config.php');
	include_once('dbutils.php');
    
    $title ="Rigister";
    $h1 = "Rigister";
    $menuActive=4;
    include_once('guestheader.php');
?>
	
	<body>
		
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
			
			if (!$fname)
			{
				$errorMessage .="Please enter your first name.";
				$isComplete = false;
			}
			
			if (!$lname)
			{
				$errorMessage .="Please enter your last name.";
				$isComplete = false;
			}
			
			if (!$street)
			{
				$errorMessage .="Please enter your street address.";
				$isComplete = false;
			}
			
			if (!$state)
			{
				$errorMessage .="Please select a state.";
				$isComplete = false;
			}
			
			if (!$zip)
			{
				$errorMessage .="Please enter your zip code.";
				$isComplete = false;
			}
			
			if (!$phone)
			{
				$errorMessage .="Please enter your phone number.";
				$isComplete = false;
			}
			
			if ($isComplete)
			{
				//check if there's a user with the same email
				$query = "SELECT * FROM USERS1 WHERE EMAIL='" . $email . "';";
				$result = queryDB($query, $db);
				if(nTuples($result) == 0)
				{
					//if we're here it means there's already a user with the same email
					//generate the hashed version of the password
					$hashedpass = crypt($password, getSalt());
					
					//put together sql code to isert tuple or record
					$insert ="INSERT INTO USERS1(EMAIL, HASHEDPASS,FNAME,LNAME,STREET,CITY,USSTATE,ZIP,PHONE,CARDNAME,CARDNUMBER,EXMONTH,EXYEAR,CCV) VALUES ('" . $email . "', '" . $hashedpass . "','" . $fname . "','" . $lname . "','" . $street . "','" . $city . "','" . $state . "','" . $zip . "','" . $phone . "','" . $cardname . "','" . $cardnumber . "','" . $exmonth . "','" . $exyear . "','" . $ccv . "');";
					
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
		<div class="col-md-1">
			
		</div>
		
		<div class="col-md-11 col-xs-12">
		
			<form action = "inputUser.php" method="post">
				
				<div class ="form-group col-md-4">
					<label for="email">Email</label>
					<input type="email" class="form-control" placeholder="Email Address" name="email"/>
				</div>
				
				<div class="form-group col-md-4">
					<label for="password">Password</label>
					<input type="password" class="form-control" placeholder="Password" name="password"/>
				</div>
				
				<div class="form-group col-md-4">
					<label for="password2">Enter password again</label>
					<input type="password" class="form-control" placeholder="Confirm Password" name="password2"/>
				</div>
				
				<div class="form-group col-xs-6">
					<label for="fname">First Name</label>
					<input type="text" class="form-control" placeholder="FirstName" name="fname"/>
				</div>
				
				<div class="form-group col-md-6">
					<label for="lname">Last Name</label>
					<input type="text" class="form-control" placeholder="LastName" name="lname"/>
				</div>
				
				<div class="form-group col-md-6">
					<label for="street">Street Address</label>
					<input type="text" class="form-control" placeholder="Street Adress" name="street"/>
				</div>
				
				<div class="form-group col-md-6">
					<label for="city">City</label>
					<input type="text" class="form-control" placeholder="City Name" name="city"/>
				</div>
				
				<div class="form-group col-md-4"> <!-- State Button -->
					<label for="state" class="control-label">State</label>
					<select class="form-control" name="state">
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
				
				<div class="form-group col-md-6">
					<label for="zip">Zip Code</label>
					<input type="text" class="form-control" placeholder="Zip Code" name="zip"/>
				</div>
				
				<div class="form-group col-md-6">
					<label for="phone">Phone Number</label>
					<input type="text" class="form-control" placeholder="Phone Number" name="phone"/>
				</div>
				
				<div class="form-group col-md-4">
					<label for="cardname">Enter the Full Name on Card</label>
					<input type="text" class="form-control" placeholder="Name on Card" name="cardname"/>
				</div>
				
				<div class="form-group col-md-6">
					<label for="cardnumber">Card Number</label>
					<input type="text" class="form-control" placeholder="Card Number" name="cardnumber"/>
				</div>
				
				<div class="form-group col-md-4">
					<label for="exmonth">Expiration Month</label>
					<input type="text" class="form-control" placeholder="Expiration Month" name="exmonth"/>
				</div>
			
				<div class="form-group col-md-4">
					<label for="exyear">Expiration Year</label>
					<input type="text" class="form-control" placeholder="Expiration Year" name="exyear"/>
				</div>
				
				<div class="form-group col-md-3">
					<label for="ccv">CCV</label>
					<input type="text" class="form-control" placeholder="CCV" name="ccv"/>
				</div>
				
				<div class="containter">
					<div class="row">
						<div class="col-md-11">
							<button type ="submit" class="btn btn-default" name="submit">Add</button>
						</div>
					</div>
				</div>
			</form>
		
		</div>
	</div>
		
				<div class="col-md-11">
					<p>Already have an account? Click <a href="shopperlogin.php"> here</a> to login.</p>
				</div>
				
				
			
<?php
	include_once('footer.php');
?>
