<?php
	session_start();
        session_destroy();
	header("location: employer_login.php");
?>