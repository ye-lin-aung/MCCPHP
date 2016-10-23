<?php
require_once"mysql_connection.php";
session_start();
if(isset($_GET["d_pid"])){
	$id=$_GET["d_pid"];
	$statement=$connection->prepare("Delete From project where pid=?");
	$statement->bind_param("i",$id);
	$statement->execute();
	if($statement->error){
		$statement->close();
		echo"<script>alert('Something Wrong!Try Again!');</script>";
	}
	else{
		echo"<script>alert('Delete Successfully!');location.assign('admin_home.php');</script>";
	}
}
if(isset($_GET["d_eid"])){
	$id=$_GET["d_eid"];
	$statement=$connection->prepare("Delete From employer where em_id=?");
	$statement->bind_param("i",$id);
	$statement->execute();
	if($statement->error){
		$statement->close();
		echo"<script>alert('Something Wrong!Try Again!');</script>";
	}
	else{
		echo"<script>alert('Delete Successfully!');location.assign('admin_home.php');</script>";
	}
}
if(isset($_GET["d_sid"])){
	$id=$_GET["d_sid"];
	$statement=$connection->prepare("Delete From student where stid=?");
	$statement->bind_param("i",$id);
	$statement->execute();
	if($statement->error){
		$statement->close();
		echo"<script>alert('Something Wrong!Try Again!');</script>";
	}
	else{
		echo"<script>alert('Delete Successfully!');location.assign('admin_home.php');</script>";
	}
}	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Home Page</title>
	<link href="style.css" rel="stylesheet" type="text/css"/>
</head>
<body background="pic/b7.jpg">

	<div  id='navbar' align="center">
		<ul class="nav nav-tabs">
			<li role="presentation" class="active"><a href="#"> About</a></li>
			<li role="presentation"><a href="#"> Contact</a></li>
			<li role="presentation"><a href="admin_logout.php"> Logout</a></li>
		</ul>
	</div> 
	<div id="wholepage" class="container">
		<?php
		$ad_id = $_SESSION["ad_id"];
		$statement=$connection->prepare("Select ad_id,ad_name,ad_mail From admin where ad_id=?");
		$statement->bind_param("i",$ad_id);
		$statement->execute();
		$statement->bind_result($ad_id,$ad_name,$ad_mail);
		$statement->fetch();
		$statement->close();
		?>
		<center><h3 style="color:#60c0dc;">Hello <?php echo $ad_name; ?>
			<?php $_SESSION['ad_id'];?></h3></center>
			<h2 align="center"> Project List </h2></center>
			<h6 style="color:#5fb760;" align="center"> Admin can delect the project if not appropriate! </h6>

			<div style="border-style:solid; overflow:auto;">
				<form name="frm2" action="" method="post" enctype="multipart/form-data">
					<table class="table table-striped">
						<tr>
							<td>Name</td>
							<td>Project Description</td>
							<td>Needed Skills</td>
							<td>Paynment</td>
							<td>Start Date</td>
							<td>End Date</td>	
							<td>Description</td>				
							<td>Action</td>
						</tr>
						<?php
						$result=$connection->query("Select * from project");
						while($row=$result->fetch_assoc()){
							$pid = $row["pid"];

							?>
							<tr>

								<td><?php echo $row["p_tittle"];?></td>
								<td><?php echo $row["p_desc"];?></td>
								<td><?php echo $row["p_skill"];?></td>
								<td><?php echo $row["p_payment"];?>$USD</td>
								<td><?php echo $row["p_startdate"];?></td> 
								<td><?php echo $row["p_enddate"];?></td> 
								<td><?php echo $row["p_description"];?></td> 


								<td>
									<div><input type="button" value="Delete"  class="btn btn-danger" onclick="location.assign('admin_home.php?d_pid=<?php echo $pid;?>')"/></td>
									</tr>
									<?php } $result->free(); ?>
								</table>
							</form>
						</div>

						<h2 align="center"> Student List </h2>

						<div style="border-style:solid; overflow:auto;">
							<form name="frm2" action="" method="post" enctype="multipart/form-data">
								<table class="table table-striped">
									<tr>
										<td>Name</td>
										<td>Mail</td>
										<td>Location</td>
										<td>Ph No</td>
										<td>Skills</td>
										<td>Work Experience</td>	
										<td>Edu_attianment</td>				
										<td>Action</td>
									</tr>
									<?php
									$result=$connection->query("Select * from student");
									while($row=$result->fetch_assoc()){
										$stid = $row["stid"];

										?>
										<tr>

											<td><?php echo $row["name"];?></td>
											<td><?php echo $row["email"];?></td>
											<td><?php echo $row["location"];?></td>
											<td><?php echo $row["phno"];?></td>
											<td><?php echo $row["skill"];?>$USD</td>
											<td><?php echo $row["workdesc"];?></td> 
											<td><?php echo $row["edudesc"];?></td> 


											<td><input type="button" value="Delete"  class="btn btn-danger"   onclick="location.assign('admin_home.php?d_sid=<?php echo $stid;?>')"/></td>
										</tr>
										<?php } $result->free(); ?>
									</table>
								</form>
							</div>		


							<h2 align="center"> Employer List </h2>

							<div style="border-style:solid; overflow:auto;">
								<form name="frm2" action="" method="post" enctype="multipart/form-data">
									<table class="table table-striped">
										<tr>
											<td>Name</td>
											<td>Mail</td>
											<td>Contact</td>
											<td>Description</td>
											<td>Action</td>
										</tr>
										<?php
										$result=$connection->query("Select * from employer");
										while($row=$result->fetch_assoc()){
											$em_id = $row["em_id"];

											?>
											<tr>

												<td><?php echo $row["em_name"];?></td>
												<td><?php echo $row["em_mail"];?></td>
												<td><?php echo $row["em_contact"];?></td>
												<td><?php echo $row["em_description"];?></td>



												<td><input type="button" value="Delete"  class="btn btn-danger"  onclick="location.assign('admin_home.php?d_eid=<?php echo $em_id;?>')"/></td>
											</tr>
											<?php } $result->free(); ?>
										</table>
									</form>
								</div>				





								<h2 align="center"> Job Apply List </h2>

								<div style="border-style:solid; overflow:auto;">
									<form name="frm2" action="" method="post"  enctype="multipart/form-data">
										<table class="table table-striped">	
											<tr>
												<td>Applicant Name</td>
												<td>E-Mail</td>
												<td>Job</td>
												<td>Description</td>
												<td>Salary</td>
											</tr>
											<?php
											$result=$connection->query("select a.a_id,s.name,s.email,p.p_tittle,p.p_description,p.p_payment from student s,project p,apply a where s.stid=a.stid and p.pid=a.pid");
											while($row=$result->fetch_assoc()){
												$a_id = $row["a_id"];

												?>
												<tr>

													<td><?php echo $row["name"];?></td>
													<td><?php echo $row["email"];?></td>
													<td><?php echo $row["p_tittle"];?></td>
													<td><?php echo $row["p_description"];?></td>
													<td><?php echo $row["p_payment"];?></td>			

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