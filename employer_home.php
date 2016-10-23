<?php

require_once"mysql_connection.php";

session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Employer Home </title>
	<link href="style.css" rel="stylesheet" type="text/css"/>
</head>
<body>

<div  id='navbar' align="center">
<ul class="nav nav-tabs">
  <li role="presentation" class="active"><a href="#"> About</a></li>
  <li role="presentation"><a href="project_register.php"> Add Project</a></li>
  <li role="presentation"><a href="emp_logout.php"> Logout</a></li>
  <li role="presentation"><a href="emp_edit_profile.php"> Edit Profile</a></li>
</ul>
</div>
<div class="col-lg-4 col-lg-offset-4  col-md-6 col-md-offset-3" >


<?php
			$em_id = $_SESSION["em_id"];
			$statement=$connection->prepare("Select em_id,em_name,em_mail From employer where em_id=?");
			$statement->bind_param("i",$em_id);
			$statement->execute();
			$statement->bind_result($em_id,$em_name,$em_mail);
			$statement->fetch();
			$statement->close();
?>
<h2><?php echo $em_name; ?>  Home</h2>

<?php $_SESSION['em_id'];?><br>
<div class="row">
<a href="project_register.php"   class="btn btn-success" > Add Project</a>
	<a href="emp_logout.php"   class="btn btn-default" > Logout</a>
	<a href="emp_edit_profile.php"   class="btn btn-primary" > Edit Profile</a>
</div>	
</div>

</div>

</body>
</html>		