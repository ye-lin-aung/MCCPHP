<?php
    session_start();
    require_once"mysql_connection.php"; 
	
	
		if (isset($_POST["apply"])) 
	{
		# code...
		$stid=$_SESSION["stid"];
		$pid=$_POST["pid"];
		
	
			
		$statement = $connection ->prepare("Insert Into apply (stid,pid) Values(?,?)");
		
			$statement ->bind_param("ii",$stid,$pid);
			$statement ->execute();
		
			if($statement->error)
			{
				$err=$statement ->error;
				echo"<script>alert('$err');</script>";
			}
			else{				
					
				echo "<script>alert('Apply successfully! We will send the confirm  mail to you!');location.assign('student_home.php');</script>";
			}
			$statement ->close();
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Student Home </title>
	<link href="style.css" rel="stylesheet" type="text/css"/>
</head>
<body>

<div  id='navbar' align="center">
<ul class="nav nav-tabs">
  <li role="presentation" class="active"><a href="#"> About</a></li>
  <li role="presentation"><a href="#"> Contact</a></li>
  <li role="presentation"><a href="student_edit_profile.php"> Edit Profile</a></li>
</ul>
</div> 
<div class="container">
<center>
		
</center>
		
		<?php
			$stid = $_SESSION["stid"];
			$statement=$connection->prepare("Select stid,name,email From student where stid=?");
			$statement->bind_param("i",$stid);
			$statement->execute();
			$statement->bind_result($stid,$name,$email);
			$statement->fetch();
			$statement->close();
?>
<center>
<h1 style="color:#FFB300"><?php echo $name; ?> </h1>
<?php $_SESSION['stid'];?>

</center>
<table cellspacing="10" class="table" cellpadding="10">
	<tr>
		<td>
		<form name="frm1" method="POST">
		<div class="row">
		
				<?php
						if(isset($_GET["sid"])){
							$sid=$_GET["sid"];
							$result=$connection->query("Select * From project Where p_desc='$sid'");
							}
							else{
						$result=$connection->query("Select * From project");
						
						}
						
						while($row=$result->fetch_assoc()){
						$pid = $row["pid"];	
							
					?>
						<div style="padding:10px;margin-bottom:10px;background:#4f5d6b;" class="col-lg-offset-1 col-lg-3"  > 
					    <p>Title:<?php echo $row["p_tittle"]; ?></p>
						<p>Category:<?php echo $row["p_desc"]; ?></p>
						<p>Required Skills:<?php echo $row["p_skill"]; ?></p> 
						<p>Payment(per month):<?php echo $row["p_payment"]; ?> $USD </p>
						<p>From:<?php echo $row["p_startdate"]; ?> </p>
						<p>To:<?php echo $row["p_enddate"]; ?> </p>
						<p>Description:<?php echo $row["p_description"]; ?></p>

					<input type="submit"  class="btn btn-primary" name="apply" value="Apply" style="margin-right:30px;">
					
						</div>
						
					<?php
						}
						$result->free();
				?>
		</form>				
	  </td>
	 
		
	</div>
	
	</tr>

</table> 
<div class="row">
<center>
	<div id="f1"  class="col-lg-3"><a href='student_home.php' style='color:white;'>All Project</a></div>
			<?php
							$result=$connection->query("Select * From category");
							while($row=$result->fetch_assoc()){
								$id = $row["categoryid"];
						?>
						<div  class="col-lg-3" ><a  style='color:white;' href="student_home.php?sid=<?php echo $row['category']; ?>" ><?php echo $row["category"];?></a></div>
						<?php
							}
							$result->free();
						?>	</div>
				</div>
				</center>
	</body>
</div>


</div>

</html>		