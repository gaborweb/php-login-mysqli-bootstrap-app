<?php 

$servername="localhost";
$user="root";
$passw="";
$db="authentication";

$conn=mysqli_connect($servername, $user, $passw, $db);

if(!$conn){
	
	die("connection failed: ".mysqli_connect_error());
}



?>