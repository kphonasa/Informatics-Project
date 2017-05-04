<?php


	$cookie_name = "user";
	$cookie_value = "John Doe";
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

	include_once('config.php');
	include_once('dbutils.php');
	$db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
	//$cookie=$_POST['COOKIE'];
	
	if (!isset($_COOKIE[$cookie_name]))
	{
		$query="INSERT INTO TEMP(COOKIE) VALUES ('" . $cookie_value . "')";
		queryDB($query, $db);
	}
	else
	{
		$query="UPDATE  TEMP SET COOKIE='" . $cookie_value . "'";
		queryDB($query, $db);
	}
	
	$_SESSION['COOKIE']=$_COOKIE[$cookie_name];
	
?>
	
<div class="container">
<form action="selectS.php" method="post">
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
