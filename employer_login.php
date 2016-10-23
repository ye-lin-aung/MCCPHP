<?php
	
	session_start();
	require_once"mysql_connection.php";
	if(isset($_POST["btnlogin"]))
	{
	$em_mail=$_POST["em_mail"];
	$em_password=$_POST["em_password"];
		
		$result = $connection -> query("Select * From employer Where em_mail='$em_mail' And em_password='$em_password'");
				if($row=$result -> fetch_assoc())
				{
			
					$_SESSION['em_id']=$row['em_id'];
					$_SESSION['em_name']=$row['em_name'];
					$_SESSION['em_mail']=$row['em_mail'];
					echo "<script>alert('Success Login!');location.assign('employer_home.php');</script>";
				} 	
			else 
				{
				echo "<script>alert('Login Fail! Please Login Again!');</script>";
				}
		}		
		
?>	
<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
	<link href="style.css" rel="stylesheet" type="text/css"/>
</head>
<body>

<div  id='navbar' align="center">
<ul class="nav nav-tabs">
  <li role="presentation" class="active"><a href="#"> About</a></li>
  <li role="presentation"><a href="#"> Contact</a></li>
  <li role="presentation"><a href="employer_register.php"> Signup</a></li>
</ul>
</div>

<div class="container" id="wholepage">
<center><h3>Employee Login Here!</h3></center>
<div class="col-lg-4 col-lg-offset-4  col-md-6 col-md-offset-3" >
<form name="login" action="" method="post">
		<div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="em_mail" name="em_mail" placeholder="Email">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="em_password" name="em_password" placeholder="Password">
  </div>

  	<div class="form-group">
			<input type="submit"  class="btn btn-primary" name="btnlogin" value="Login">
			<input type="reset"  class="btn btn-default" name="btncancel" value="Exit">
		</div>
		
	
</form>	
</div>
</div>
			
</div>
</body>
</html>		


<!DOCTYPE html>
<html>
<head>
	<title>Employer Login</title>
	<link href="style.css" rel="stylesheet" type="text/css"/>
</head>
<body>

