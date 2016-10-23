<?php
require_once"mysql_connection.php";
session_start();

	if (isset($_POST["btnreg"])) 
	{
		# code...
		$em_name=$_POST["em_name"];
		$em_mail=$_POST["em_mail"];
		$em_password=$_POST["em_password"];
		$em_contact=$_POST["em_contact"];
		$em_description=$_POST["em_description"];
		
		
		$statement=$connection->prepare("Select * From employer Where em_mail=?");
		$statement->bind_param("s",$em_mail);
		$statement->execute();
		if($statement->fetch()){
			echo"<script>alert('Email already exist!Choose another email and register again!');</script>";
		}
		else{	
		$statement = $connection ->prepare("Insert Into employer (em_name,em_mail,em_password,em_contact,em_description) Values(?,?,?,?,?)");
		
			$statement ->bind_param("sssss",$em_name,$em_mail,$em_password,$em_contact,$em_description);
			$statement ->execute();
			if($statement->error)
			{
				$err=$statement ->error;
				echo"<script>alert('$err');</script>";
			}
			else{
				echo "<script>alert('Success Register!');location.assign('employer_login.php');</script>";
			}
			$statement ->close();
		}
	}
?>
<!DOCTYPE html>
<html>
<head> 
	<title>Employer Register</title>
	<link href="style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div id='navbar' style="color:#FFCA28;" align="center">
	PROJECT MARKETPLACE
</div>
<div id="wholepage" class="container">
<center>
	<h3>Employer Register Form</h3>
</center>	
		<form name="frm2" action="" method="POST">
		<div class="col-lg-6 col-lg-offset-3  col-md-6 col-md-offset-3" >
		
			<div class="form-group">
				<label>Name:</label>
				<input class="form-control" type="text" size="26" name="em_name" required>
			</div>
            <div class="form-group">
				<label>Email:</label>
				<input class="form-control" type="text" size="26" name="em_mail" required>
			</div>
			<div class="form-group">
				<label>Password:</label>
				<input class="form-control" type="password" size="26" name="em_password" required>
			</div>
			<div class="form-group">
				<label>Contact:</label>
				<textarea   class="form-control" name="em_contact" rows="5" cols="20" required> </textarea>
			</div>
			<div class="form-group">
				<label>Description:</label>
				<textarea   class="form-control" name="em_description" rows="5" cols="20" required> </textarea>
			</div>
			<div class="form-group">
			
				<input class="btn btn-primary" type="submit" name="btnreg" value="Register">
				<input class="btn btn-danger" type="reset" name="btncancel" value="Cancel"></label>
			</div>
			
	</div>
			</form>
			</div>


	</body>
</html>
