<!doctype html>

<html lang="en">
<head>
    <title>Insert the Ttile</title>
    
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <style>
		body  {
			background-color: green;
			color: black;
			font-size: 20px;
		}
	</style>
    
    
</head>
        
        
        
    <!-- Menu bar -->
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container-fluid">
            <ul class="nav navbar-nav navbar-left">
                <li <?php if($logActive == 0) { echo 'class="active"'; } ?>><a href="https://webdev.cs.uiowa.edu/~kwang9/project/login.php"><span class="glyphicon glyphicon-home"></span> &nbsp;&nbsp;  Login</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <li <?php if($menuActive == 1) { echo 'class="active"'; } ?>><a href="https://webdev.cs.uiowa.edu/~kwang9/project/logout.php"><span class="glyphicon glyphicon-file"></span> &nbsp;&nbsp;  Logout</a></li>
            </ul>
        </div>
    </nav> 
