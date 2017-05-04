
<?php
	include_once('config.php');
	include_once('dbutils.php');
?>

	
<div class="container">
<form action="selectSguest.php" method="post">
<!--maker-->
<div class="form-group">
    <label for="STORE">Select Store:</label>
        <select class="form-control" style="width: 500" name="STORE">
		<?php 
		$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
		//run the query
	
		$query="SELECT ID, NAME FROM STORE;";
		$result= queryDB($query, $db);
			
		while($row = nextTuple($result))
		{ echo'<option value=' . $row['ID'] . '>'; echo($row['NAME']); echo'</option>';}?>
		</select>
</div>
<div>
	<button type="submit" class="btn-btn-default" name="submit">Select</button>
</div>
</form>
</div>
<?php
if (isset($_POST['submit']))
{
	if (session_start())
			{
				$_SESSION['STORE']=$_POST['STORE'];
				header("Location: guesthome.php");
			exit;}
}
?>