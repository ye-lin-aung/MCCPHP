<?php

require_once"mysql_connection.php";

session_start();
if(!isset($_SESSION["stid"])) {
            echo "<script>alert('login Please!.');location.assign('employer_login.php');</script>";
        }
else
		{
			$stid = $_SESSION["stid"];
			$statement=$connection->prepare("Select * From student where stid=?");
			$statement->bind_param("i",$stid);
			$statement->execute();
			$statement->bind_result($stid,$name,$email,$password,$location,$phno,$skill,$workdesc,$edudesc);
			$statement->fetch();
			$statement->close();
		}		
        
       	
		if(isset($_POST["edit"])){
	
	
		$name=$_POST["name"];
		
		$password=$_POST["password"];
		$location=$_POST["location"];
		$phno=$_POST["phno"];
		$skill=$_POST["skill"];
		$workdesc=$_POST["workdesc"];
		$edudesc=$_POST["edudesc"];
	

		$statement =$connection ->prepare ("Update student Set name=?,password=?,location=?,phno=?, skill=?,workdesc=?,edudesc=? Where stid=?");
		$statement->bind_param("sssssssi",$name,$password,$location,$phno,$skill,$workdesc,$edudesc,$_SESSION["stid"]);
					
					
				$statement ->execute();
				 if ($statement ->error){
				 	$statement ->close();
				 	echo "<script> alert ('Sorry! Edit Again!');</script>";
				 }
				 else
				 {
				 	$statement ->close ();
					
				$name="";
				$email="";
				$password="";
				$location="";
				$phno="";
				$skill="";
				$workdesc="";
				$edudesc="";
				
				
				echo "<script> alert('edit successfully!');location.assign('student_home.php');</script>";
				 }
			}


		
		
		
?>



<!DOCTYPE html>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css"/>
</head>
<body>

<div  id='navbar' align="center">
<ul class="nav nav-tabs">
  <li role="presentation" class="active"><a href="about.php"> About</a></li>
  <li role="presentation"><a href="contact.php"> Contact</a></li>
  <li role="presentation"><a href="std_logout.php"> Logout</a></li>
  <li role="presentation"><a href="student_home.php"> Home</a></li>
</ul>
</div> 

<div class="container">
<div id="wholepage">
<h2 align="center"><?php echo $name;?>&nbsp;Profile</h2>

<div class="col-lg-6 col-lg-offset-3  col-md-6 col-md-offset-3" >
  <form name="frm_er" action="" method="POST">
  <div class="form-group">
	<label for="name">Student Name</label>
	<input type="text"  class="form-control" name="name" value="<?php echo $name;?>" required>
</div>

 <div class="form-group">
	<label for="email">Student Email</label>
	<input type="text"  class="form-control" name="email" value="<?php echo $name;?>" required>
	
</div>
<div class="form-group">
	<label for="password">Password</label>
	<input type="password"  class="form-control" name="password" value="<?php echo $password;?>" required>
	
</div>
<div class="form-group">
	<label for="location">Location</label>
	<input type="text" name="location"  class="form-control" value="<?php echo $location;?>" required>
	
</div>
<div class="form-group">
	<label for="phone">Phone number</label>
	<input type="text" name="phno"  class="form-control" value="<?php echo $phno;?>" required>
</div>
<div class="form-group">
	<label for="phone">Skills</label>
	<input type="text" name="skill"  class="form-control" value="<?php echo $skill;?>" required>
	
</div>
<div class="form-group">
	<label for="experience">Experience</label>
		<input type="text" name="workdesc" class="form-control" value="<?php echo $workdesc;?>" required>
	
</div>

<div class="form-group">
	<label for="description">Educational Information</label>
	<input type="text" name="edudesc" class="form-control" value="<?php echo $edudesc;?>" required>
	
</div>
<div class="form-group">
	<input type="submit" class="btn btn-primary" name="edit" value="Edit">
	<input type="reset" class="btn btn-danger" name="cancel" value="Cancel">
</div>
</form>  
</div>
           
</div>

</div>

</div>

</body>
</html>