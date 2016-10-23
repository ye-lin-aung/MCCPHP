<?php
require_once"mysql_connection.php";
session_start();

	if (isset($_POST["btnreg"])) 
	{
		# code...
		$p_tittle=$_POST["p_tittle"];
		$p_desc=$_POST["p_desc"];
		$p_skill=$_POST["p_skill"];
		$p_payment=$_POST["p_payment"];
		$p_startdate=$_POST["p_startdate"];
	    $p_enddate=$_POST["p_enddate"];
	    $p_description=$_POST["p_description"];
		$em_id = $_SESSION["em_id"];

		
		$statement=$connection->prepare("Select * From project  Where p_tittle=?");
		$statement->bind_param("s",$p_tittle);
		$statement->execute();
		if($statement->fetch()){
			echo"<script>alert('Tittle already exist!Choose another tittle and register again!');</script>";
		}
		else{	
		$statement = $connection ->prepare("Insert Into project (p_tittle,p_desc,p_skill,p_payment,p_startdate,p_enddate,p_description,em_id) Values(?,?,?,?,?,?,?,?)");
		
			$statement ->bind_param("sssssssi",$p_tittle,$p_desc,$p_skill,$p_payment,$p_startdate,$p_enddate,$p_description,$em_id);
			$statement ->execute();
			if($statement->error)
			{
				$err=$statement ->error;
				echo"<script>alert('$err');</script>";
			}
			else{
				echo "<script>alert('Success Register!');location.assign('project_register.php');</script>";
			}
			$statement ->close();
		}
	
	}
	if(isset($_GET["did"])){
		$id=$_GET["did"];
		$statement=$connection->prepare("Delete From project where pid=?");
		$statement->bind_param("i",$id);
		$statement->execute();
		if($statement->error){
		$statement->close();
			echo"<script>alert('Something Wrong!Try Again!');</script>";
		}
		else{
			echo"<script>alert('Delete Successfully!');location.assign('project_register.php');</script>";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>

<link href="style.css" rel="stylesheet" type="text/css"/>
</head>
<body>



<div id='navbar' align="center">

<ul class="nav nav-tabs">
  <li role="presentation" class="active"><a href="about.php"> About</a></li>
  <li role="presentation"><a href="#php"> Contact</a></li>
  <li role="presentation"><a href="emp_logout.php"> Logout</a></li>
  <li role="presentation"><a href="employer_home.php"> Home</a></li>
</ul>
</div>
<div class="container">
<div class="col-lg-6 col-lg-offset-3" >
	<h2>Project Register Form</h2>
	Hello&nbsp; <b><?php echo $_SESSION["em_name"]; ?></b> &nbsp; you can add project here! <br><br>
	
		<form name="frm2" action="" method="POST">
		
			
				<div class="form-group"><label>Project Tittle:</label>
				<input class="form-control" type="text" size="26" name="p_tittle" required></div>
			
			
				<div class="form-group"><label>Description:</label>
				<select name="p_desc" required>
							<option value="">Select Description</option>
							<?php
					$result=$connection->query("Select * From category Order By categoryid");
					while($row=$result->fetch_assoc()){
						$s=($cid==$row["category"])? "selected": "";
						echo "<option value='".$row["category"]."' $s>".$row["category"]."</option>";
						}
						$result->free();
				?>	
				</select> </div>
		
				<div class="form-group"><label>Skill:</label>
				<textarea  class="form-control" name="p_skill" rows="5" cols="20" required> </textarea></div>
			
				<div class="form-group"><label>Payment:</label>
				<input class="form-control" type="text"  size="26" name="p_payment" required></div>
			
				<div class="form-group"><label>Start Date:</label>
				<input class="form-control" type="text" size="26" name="p_startdate" required></div>
			
	
				<div class="form-group"><label>End Date:</label>
				<input class="form-control" type="text" size="26" name="p_enddate" required></div>
	
	
				<div class="form-group"><label> Detail Description:</label>
				<textarea  class="form-control" name="p_description" rows="7" cols="20" required> </textarea> </div>
			
	
				<input class="btn btn-primary" type="submit" name="btnreg" value="Register">
				<input class="btn btn-danger" type="reset" name="btncancel" value="Cancel"></label></div>
			
			
			</form>
			</div>
			
<h2 align="center"> Project List </h2>	

<div class="container">
<div   style="border-style:solid;margin-bottom:40px;  overflow:auto;">
<form  action="" method="post" enctype="multipart/form-data">
<table class="table table-striped">
<tr>
	
	<td>Tite</td>
	<td>Type</td>
	<td>Skill</td>
	<td>Payment</td>
	<td>Start Date</td>
	<td>End Date</td>
	<td>Details</td>
	<td colspan="2">Action</td>
</tr>
<?php

	$em_id=$_SESSION["em_id"];
	$result=$connection->query("select * from project where em_id=$em_id");
	while($row=$result->fetch_assoc()){
	$pid = $row["pid"];
	
?>
<tr>
	
	<td><?php echo $row["p_tittle"];?></td>
	<td><?php echo $row["p_desc"];?></td>
	<td><?php echo $row["p_skill"];?></td>
	<td><?php echo $row["p_payment"];?></td>
	<td><?php echo $row["p_startdate"];?></td>
	<td><?php echo $row["p_enddate"];?></td>
	<td><?php echo $row["p_description"];?></td>
	
	
	<td><input type="Button" class="btn btn-primary" value="Update" onclick="location.assign('update_project.php?uid=<?php echo $pid;?>')"/></td>
	<td><input type="Button" value="Delete"  class="btn btn-danger" onclick="location.assign('project_register.php?did=<?php echo $pid;?>')"/></td>
</tr>
<?php } $result->free(); ?>
</table>
</form>	
	
</div>
</div>
</div>
</div>

</body>
</html>