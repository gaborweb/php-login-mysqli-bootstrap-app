<?php 

session_start();

include "db.php";

if(isset($_POST['registerBtn'])){
	
	$username=$_POST['username'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$password2=$_POST['password2'];
	
	if($password==$password2){
		
		$password=md5($password); 
		$insertQuery="Insert Into users(username, email, password) 
			Values('$username','$email', '$password')";
		mysqli_query($conn, $insertQuery);
		
		$_SESSION['message']="You are registered";
		$_SESSION['username']=$username;
		header("location: login.php");
		
	}else{
		
		$_SESSION['message']="The two passwords are not matched";
	}
}

?>


<html>

<head>

	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h1>User regitration, login, logout</h1>
	</div>
	
	<form method="post" action="register.php">
	<table>
		<tr>
			<td>Username:</td>
			<td><input type="text" name="username" class="textInput" required></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><input type="text" name="email" class="textInput" required></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><input type="password" name="password" class="textInput" required></td>
		</tr>
		<tr>
			<td>Password again:</td>
			<td><input type="password" name="password2" class="textInput" required></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="registerBtn" value="Register"></td>
		</tr>
	</table>
	</form>
</body>

</html>