
		
<?php
	include_once('config.php');
	include_once('dbutils.php');
?>
		
<?php
include_once("guestheader.php")
?>		
			<div class="jumbotron">
				<div class="row">
					<div class="col-sm-9 col-xs-12">
						<h1>Welcome to Hvyee !</h1>
					</div>
				</div>
			</div>
		
<HR>		
<!-- thumbnail icons /-->
		<div class="containter">			
			<div class="row">
						<?php											/*
						 *List all Productes that are in the DB
						 *
						 */    
						// connect to the DB
						$db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
						
						// set up a query to get infor on the cars from the DB
						$query = 'SELECT * FROM PRODUCT order by RAND() LIMIT 4';
						
						// run the query
						$result = queryDB($query, $db);
						
						
						while($row = nextTuple($result))
							{
								if ($row['IMAGE'])				
								{$imagelocation=$row['IMAGE'];
								$altText="product" . $row['PNAME'];
								echo '<div class="col-xs-3 col-md-3">';
								echo "<a href='Descriptionguest.php?ID=" . $row['ID'] . "'><img src='$imagelocation' width='150' height='150' alt=$altText'><BR>";}
								echo "<a href='Descriptionguest.php?ID=" . $row['ID'] . "'>" . $row['PNAME'] . "</a>";
								echo '</div>';
							}
						?>
				
			</div>	
		</div>
		
	



<?php
	include_once("footer.php");
?>
