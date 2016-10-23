<?php
	
	session_start();
	require_once"mysql_connection.php";
	if(isset($_POST["btnlogin"]))
	{
	$ad_mail=$_POST["ad_mail"];
	$ad_pwd=$_POST["ad_pwd"];
		
		$result = $connection -> query("Select * From admin Where ad_mail='$ad_mail' And ad_pwd='$ad_pwd'");
				if($row=$result -> fetch_assoc())
				{
			
					$_SESSION['ad_id']=$row['ad_id'];
					$_SESSION['ad_name']=$row['ad_name'];
					$_SESSION['ad_mail']=$row['ad_mail'];
					echo "<script>alert('Success Login!');location.assign('admin_home.php');</script>";
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
<center><h3>Admin Login Here!</h3></center>
<div class="col-lg-4 col-lg-offset-4  col-md-6 col-md-offset-3" >
<form name="login" action="" method="post">
		<div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="ad_mail" name="ad_mail" placeholder="Email">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="ad_pwd" name="ad_pwd" placeholder="Password">
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



