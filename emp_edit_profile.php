<?php

require_once"mysql_connection.php";

session_start();
if(!isset($_SESSION["em_id"])) {
            echo "<script>alert('login Please!.');location.assign('employer_login.php');</script>";
        }
else
		{
			$em_id = $_SESSION["em_id"];
			$statement=$connection->prepare("Select * From employer where em_id=?");
			$statement->bind_param("i",$em_id);
			$statement->execute();
			$statement->bind_result($em_id,$em_name,$em_mail,$em_password,$em_contact,$em_description);
			$statement->fetch();
			$statement->close();
		}		
        
       	
		if(isset($_POST["edit"])){
	
	
		$em_name=$_POST["em_name"];
		$em_password=$_POST["em_password"];
		$em_contact=$_POST["em_contact"];
		$em_description=$_POST["em_description"];
	

		$statement =$connection ->prepare ("Update employer Set em_name=?,em_password=?,em_contact=?,em_description=? Where em_id=?");
					$statement->bind_param("ssssi",$em_name,$em_password,$em_contact,$em_description,$_SESSION["em_id"]);
					
					
				$statement ->execute();
				 if ($statement ->error){
				 	$statement ->close();
				 	echo "<script> alert ('Sorry! Edit Again!');</script>";
				 }
				 else
				 {
				 	$statement ->close ();
					
				$em_name="";
				$em_mail="";
				$em_password="";
				$em_contact="";
				$em_description="";
				
				
				echo "<script> alert('Are you sure to edit!');location.assign('employer_home.php');</script>";
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
  <li role="presentation"><a href="emp_logout.php"> Logout</a></li>
  <li role="presentation"><a href="employer_home.php"> Home</a></li>
</ul>
</div> 

<div class="container"> 
<div class="col-lg-6 col-lg-offset-3  col-md-6 col-md-offset-3" >
<h2 align="center"><?php echo $em_name;?>&nbsp;Profile</h2>

  <form name="frm2" action="" method="POST">
  <div class="form-group">
	<div class="form-group"><label for="em_name">Employee Name</label>
	<input class="form-control"  type="text" id="em_name" name="em_name" value="<?php echo $em_name;?>" required>
	</div>
<div class="form-group"><label for="em_email">Employee Email</label>
	<input class="form-control"  type="text" id="em_email" name="em_mail" value="<?php echo $em_mail;?>" readonly>
	</div>
	<div class="form-group"><label for="em_password">Password</label>
	<input class="form-control"  type="password" id="em_password" name="em_password" value="<?php echo $em_password;?>" required>
	</div>
	<div class="form-group"><label for="em_contact">Contact Details</label>
	<input class="form-control"  type="text" id="em_contact" name="em_contact" value="<?php echo $em_contact;?>" required>
	</div>
	<div class="form-group"><label for="description">Description</label>
	<input class="form-control"  type="text" name="em_description" value="<?php echo $em_description;?>" required>
	</div>
	<div class="form-group">
	<input class="btn btn-primary"  type="submit" name="edit" value="Edit">
	<input class="btn btn-danger"  type="reset" name="cancel" value="Cancel">
	</div>
</form>  
           
</div>



</div>
</div>

</body>
</html>