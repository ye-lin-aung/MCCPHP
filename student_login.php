<?php
  
  session_start();
  require_once"mysql_connection.php";
  if(isset($_POST["btnlogin"]))
  {
  $email=$_POST["loginmail"];
  $password=$_POST["loginpwd"];
    echo $email;
    $result = $connection -> query("Select * From student Where email='$email' And password='$password'");
        if($row=$result -> fetch_assoc())
        {
      
          $_SESSION['stid']=$row['stid'];
          $_SESSION['name']=$row['name'];
          $_SESSION['email']=$row['email'];
          echo "<script>alert('Success Login!');location.assign('student_home.php');</script>";
        }   
      else 
        {
        echo "<script>alert('Login Fail! Please Login Again!');</script>";
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
  <li role="presentation" class="active"><a href="#"> About</a></li>
  <li role="presentation"><a href="#"> Contact</a></li>
  <li role="presentation"><a href="student_register.php"> Signup</a></li>
</ul>
</div>



<div id="wholepage" class="container">
<div class="col-lg-4 col-lg-offset-4  col-md-6 col-md-offset-3" >
<center><h1>Student Login</hi></center>
 <form action="student_login.php" name="login" method="post">
          <div class="form-group">
            <label for="loginmail">Email</label>
            <input type="email" class="form-control" id="loginmail" name="loginmail" placeholder="Email" required>
          </div>
          <div class="form-group">
            <label for="loginpwd">Password</label>
            <input type="password" class="form-control" id="loginpwd" name="loginpwd" placeholder="Password" required>
          </div>
          <button type="submit" class="btn btn-primary" name="btnlogin">Submit</button>
          <button type="reset" class="btn btn-danger">Clear</button>
        </form>
			        
</div>

</div>



</body>
</html>