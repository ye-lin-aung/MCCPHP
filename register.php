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
		
		
		$statement=$connection->prepare("Select * From customer Where cemail=?");
		$statement->bind_param("s",$cemail);
		$statement->execute();
		if($statement->fetch()){
			echo"<script>alert('Email already exist!Choose another email and register again!');</script>";
		}
		else{	
		$statement = $connection ->prepare("Insert Into customer (cname,cemail,cpwd,caddress,cph) Values(?,?,?,?,?)");
		
			$statement ->bind_param("sssss",$cname,$cemail,$cpwd,$caddress,$cph);
			$statement ->execute();
			if($statement->error)
			{
				$err=$statement ->error;
				echo"<script>alert('$err');</script>";
			}
			else{
				echo "<script>alert('Success Register!');location.assign('index.php');</script>";
			}
			$statement ->close();
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
<link href="mystyle.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div id='navbar'>
	<a href="index.php"> Index</a>
</div> 
<center><img src="Pic/b2.jpg"></center>
<div class='login' style="font-size:18px;color:orange;font-family:Tahoma;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome to Register page	
</div>
<div id="wholepage" style="height: 550px;width:940px;">

				<form name="frm" method="POST">
                
                    Customer Registration
					<br><br><br><br><br><br><br><br>
					<table border="0" align="center" width="50%" height="90%" cellpadding="10">
					<tr>
						<td>Customer Name</td>
						<td><input type="text" name="cname" required maxlength="30" pattern="[a-zA-Z][a-zA-Z ]+" title="Customer name only in letter with space" autofocus /></td>
                    </tr>
					<tr>
						<td>Email</td>
						<td> <input type="email" name="cemail"  required maxlength="50" title="Valid email to use in log in" /></td>
                    </tr>
					<tr>
						<td>Password</td>
						<td><input type="password" name="cpwd" value="" required maxlength="20" pattern="\w+" title="Password" onchange="frm.cpassword.pattern = this.value;" /></td>
                    </tr>
					<tr>
						<td>Retype Password</td>
						<td><input type="password" name="rpwd" value="" required maxlength="20" title="Retype password same as above password" /></td>
					</tr>
					<tr>
						<td>Address</td>
						<td><textarea name="caddress" required maxlength="100"></textarea></td>
                    </tr>
					<tr>
						<td>Phone</td>
						<td> <input type="text" name="cph"  required maxlength="30" pattern="[0-9][0-9\-, ]+" title="Phone no only allow number, hyphen and comma." /></td>
                    </tr>
                    <tr>
						<td colspan="2" align="center"><input type="submit" value="Create" name="create" style="margin-right: 7px;" />
                    <input type="submit" value="Cancel" name="cancel"  formnovalidate />
					</td>
					</tr>
                    <label style="color: red;"></label>
                  </table> 
                
            </form>
           			        
</div>

<div id="footer" style="width:940px;"><center> &copy; Copyright By MCC Naypyitaw Myanmar </center>
</div>

</body>
</html>