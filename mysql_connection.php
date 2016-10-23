<?php
	$dblink= "127.0.0.1";
	$dbname="learnforlife_yla";
	$dbusername="root";
	$dbpassword="root";
	$dbportno=3306;

/*	$connection=mysqli_connect($dblink,$dbusername,$dbpassword,$dbname,$dbportno);
	if (mysqli_connect_error(){

		die(mysqli_connect_error());
	}
*/
	$connection= new mysqli($dblink,$dbusername,$dbpassword,$dbname,$dbportno);
	if($connection->connect_error){
		die($connection->connect_error);
	}

?>
