<?php
	require_once"mysql_connection.php";
	session_start();
		if (isset($_POST["register"])) {
			# code...
			$name=$_POST["name"];
			$email=$_POST["email"];
			$password=$_POST["password"];
			$location=$_POST["location"];	
			$phno=$_POST["phno"];
			$skill=$_POST["skill"];
			$workdesc=$_POST["workdesc"];
			$edudesc=$_POST["edudesc"];
			
			
			
		$statement=$connection->prepare("Select * From student Where email=?");
		$statement->bind_param("s",$email);
		$statement->execute();
		if($statement->fetch()){
			echo"<script>alert('Email is already used!Registration Fail!');</script>";
		}
		else{
			$statement = $connection ->prepare("Insert Into student (name,email,password,location,phno,skill,workdesc,edudesc) Values(?,?,?,?,?,?,?,?)");
				$statement ->bind_param("ssssssss",$name,$email,$password,$location,$phno,$skill,$workdesc,$edudesc);
				$statement ->execute();
				if($statement->error){
					$err=$statement ->error;
					echo"<script>alert('$err');</script>";
				} else{
					echo "<script>alert('You are register successfully!');location.assign('student_login.php');</script>";
				}
				$statement ->close();
			}
		}	
?>
<!DOCTYPE HTML>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div id='navbar' style="color:#FFCA28;" align="center">

	PROJECT MARKETPLACE
</div>
<div id="wholepage" style="height: 550px;">
<body>
<center>
<h2>Student Register</h2>
</center>
<div class="col-lg-6 col-lg-offset-3  col-md-6 col-md-offset-3" >
	<form name="f1" action="" method="POST">
	
		<div class="form-group">
			<label>Student Name:</label>
			<input class="form-control" type="text" size="26" name="name" required>
		</div>	
		<div class="form-group">
			<label>Email address:</label>
			<input class="form-control" type="text" size="26" name="email" required>
		</div>
		<div class="form-group">
			<label>Password:</label>
			<input class="form-control" type="password" size="26" name="password" required>
		</div>	
		<div class="form-group">
			<label>Retype password:</label>
			<input class="form-control" type="password" size="26" name="repwdd" required>
		</div>
		<div class="form-group">
			<label>Address:</label>
			<input class="form-control" type="text" size="26" name="location" required>
		</div>
		<div class="form-group">
			<label>Phone number:</label>
			<input class="form-control" type="text" size="26" name="phno" required>
		</div>
		<div class="form-group">
			<label>Skills:</label>
			<input class="form-control" type="text" size="26" name="skill" required>
		</div>
		<div class="form-group">
			<label>A short work experience description:</label>
			<textarea rows="5" cols="20"   class="form-control" name="workdesc" required></textarea>
		</div>
		<div class="form-group">
			<label>A short  description of education attainment:</label>
			<textarea rows="5" cols="20"   class="form-control" name="edudesc" required></textarea>
		</div>
		<div class="form-group">
			<input  class="btn btn-primary" type="submit" name="register" value="register"/>	
			<input  class="btn btn-default" type="reset" name="cancel" value="cancel"/>
		</div>
			
	</form>
	</div>
	</div>
			
</div>
</body>
</html>