<?php

	session_start();
	
	unset($_SESSION['username']);
	
	
	$_SESSION['message']="You are logged out!";
	
	header("location: login.php");

?>