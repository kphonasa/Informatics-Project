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
	<table class='table table-hover'>
		<!--table headers-->
		<thead>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Street</th>
			<th>City</th>
			<th>State</th>
			<th>Zip</th>
			<th>Phone Number</th>
			<th>Name on Card</th>
			<th>Card Number</th>
			<th>Expiration Month</th>
			<th>Expiration Year</th>
			<th>CCV</th>
			
		</thead>
	
		<?php

		//connect to the database
		$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
		$email=($_SESSION['email']);
		$email=makeStringSafe($db,$email);
		//Set up the query to get information on the cars from the database
		$query = "SELECT ID,FNAME,LNAME,STREET,CITY,USSTATE,ZIP,PHONE,CARDNAME,CARDNUMBER,EXMONTH,EXYEAR,CCV 
		FROM USERS1 WHERE EMAIL = '" . $email . "';";
		
		//run the query
		$result= queryDB($query, $db);
				
		while($row = nextTuple($result))
		{
			echo'<tr>';
			echo '<td>' . $row['FNAME'] . '</td>';
			echo '<td>' . $row['LNAME'] . '</td>';
			echo '<td>' . $row['STREET'] . '</td>';
			echo '<td>' . $row['CITY'] . '</td>';
			echo '<td>' . $row['USSTATE'] . '</td>';
			echo '<td>' . $row['ZIP'] . '</td>';
			echo '<td>' . $row['PHONE'] . '</td>';
			echo '<td>' . $row['CARDNAME'] . '</td>';
			echo '<td>' . $row['CARDNUMBER'] . '</td>';
			echo '<td>' . $row['EXMONTH'] . '</td>';
			echo '<td>' . $row['EXYEAR'] . '</td>';
			echo '<td>' . $row['CCV'] . '</td>';

			echo "<td><a href='updateprofile.php?ID=" . $row['ID']  .  "'>edit</a></td>";
			echo'</tr>';
		}
		?>
	</table>
		</div>
	</div>
<?php
	include_once("footer.php");
?>