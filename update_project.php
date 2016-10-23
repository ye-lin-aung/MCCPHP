<?php
require_once"mysql_connection.php";
session_start();

if(isset($_POST["update"])){
	
	
	$p_skill=$_POST["p_skill"];
	$p_payment=$_POST["p_payment"];
	$p_startdate=$_POST["p_startdate"];
	$p_enddate=$_POST["p_enddate"];
	$p_description=$_POST["p_description"];
	
	
	
	
	
	$statement =$connection ->prepare ("Update project Set p_skill=?,p_payment=? ,p_startdate=?,p_enddate=?,p_description=? Where pid=?");
	$statement->bind_param("sssssi",$p_skill,$p_payment,$p_startdate,$p_enddate,$p_description,$_SESSION["pid"]);
					
					
				$statement ->execute();
				 if ($statement ->error){
				 	$statement ->close();
				 	echo "<script> alert ('Sorry! Update Again!');</script>";
				 }
				 else
				 {
				 	$statement ->close ();
					
				$p_tittle="";
				$p_desc="";
				$p_skill="";
				$p_payment="";
				$p_startdate="";
				$p_enddate="";
				$p_description="";
				$em_id="";
				
				unset($_SESSION["pid"]);
				echo "<script> alert('Success Update!');location.assign('project_register.php');</script>";
				 }
			}

	if(isset($_GET["uid"])){
		$id=$_GET["uid"];
		$_SESSION["pid"] = $id;
		$statement=$connection->prepare("Select * From project where pid=?");
		$statement->bind_param("i",$id);
		$statement->execute();
		$statement->bind_result($id,$p_tittle,$p_desc,$p_skill,$p_payment,$p_startdate,$p_enddate,$p_description,$em_id);
		$statement->fetch();
		$statement->close();
		
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
  <li role="presentation" class="active"><a href="employer_home.php"> HOME</a></li>
  <li role="presentation"><a href="#"> About</a></li>
  <li role="presentation">	<a href="emp_logout.php">LOGOUT </a></li>
  <li role="presentation"><a href="#">Contact</a></li>
</ul>
</div> 




<div id="wholepage" class="container">
<div class="col-lg-4 col-lg-offset-4  col-md-6 col-md-offset-3" >
 
 <form name="frm" method="POST" enctype="multipart/form-data">
                
                    <h2>Project Update Form</h2>
					
					<div class="form-group">
						<label>Project Title</label>
						<input class="form-control" type="text" name="p_tittle" value="<?php echo $p_tittle;?>" readonly>
                    </div>
					<div class="form-group">
						<label>Description</label>
						<input class="form-control" type="text" name="p_desc" value="<?php echo $p_desc;?>" readonly>
                    </div>
					<div class="form-group">
						<label>Skills</label>
						<input class="form-control" type="text" name="p_skill"  value="<?php echo $p_skill;?>" required>
                    </div>
					<div class="form-group">
						<label>Payment</label>
						<input class="form-control" type="text" name="p_payment" value="<?php echo $p_payment;?>" required>$USD
                    </div>
					<div class="form-group">
						<label>Start Date</label>
						<input class="form-control" type="text" name="p_startdate" value="<?php echo $p_startdate;?>" required/>
                    </div>
					<div class="form-group">
						<label>End Date</label>
						<input class="form-control" type="text" name="p_enddate" value="<?php echo $p_enddate;?>" required/>
                    </div>
					<div class="form-group">
						<label>Details</label>
						<input class="form-control" type="text" name="p_description" value="<?php echo $p_description;?>" required/>
					</div>
                    <div class="form-group">
						<br><br>
						<input class="btn btn-primary" type="submit" value="Update" name="update" style="margin-right: 7px;" />
                    <input class="btn btn-error" type="submit" value="Cancel" name="cancel"  formnovalidate />
					</label>
					</div>
                    
                  
                
            </form>
			        

			        
</div>

</div>



</body>
</html>