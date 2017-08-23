<?php
	include_once('config.php');
	include_once('dbutils.php');
?>

	
<div class="container">
<form action="selectSguest.php" method="post">
<!--maker-->
<div class="form-group">
    <label for="STORE">Select Store:</label>
        <select class="form-control" style=width: "500" name="STORE">
		<?php 
		$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
		//run the query
	
		$query="SELECT ID, NAME FROM STORE;";
		$result= queryDB($query, $db);
			
		while($row = nextTuple($result))
		{ echo'<option value=' . $row['ID'] . '>'; echo($row['NAME']); echo'</option>';}?>
		</select>
</div>
		
<div class="form-group">
	<label for="COOKIE">Enter the name you would like to use:</label>
	<input type="text" style="width: 500" class="form-control" name="COOKIE"/>
</div>

<div>
	<button type="submit" class="btn-btn-default" name="submit">Select</button>
</div>
</form>
</div>
<?php
if (isset($_POST['submit']))
{
	$isComplete = true;
	$errorMessage="";
	if (!$_POST['COOKIE'])
	{
		$errorMessage .="Please write a name.";
		$isComplete = false;
	}
	$db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
	// set up a query to get infor on the cars from the DB
	$query = "SELECT * FROM TEMP WHERE COOKIE='" . $_POST['COOKIE'] . "';";
	// run the query
	$result = queryDB($query, $db);
	if (nTuples($result) == 0) 
	{$isComplete = true;}
	else {$errorMessage .="Please choose a name; name currently in use.";
		$isComplete = false;}
	if ($isComplete){
	if (session_start())
	{
		//$cookie_name = "user";
		//$cookie_value = $_POST['COOKIE'];
		//setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
		//$cookie_value=$_SESSION['COOKIE'];
		$_SESSION['COOKIE']=$_POST['COOKIE'];
		$_SESSION['STORE']=$_POST['STORE'];
		header("Location: guesthome.php");
	exit;}}
	if(isset($isComplete) && !$isComplete)
			{
				echo '<div class="alert alert-danger" role="alert">';
				echo ($errorMessage);
				echo '</div>';
			}
}
?>