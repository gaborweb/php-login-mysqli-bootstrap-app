<?php 

session_start();

include "db.php";

if(isset($_POST['loginBtn'])){
	
	$username=$_POST['username'];
	$password=$_POST['password'];
	
	$password=md5($password);
	
	$selectQuery="SELECT * FROM users WHERE username='$username' AND password='$password'";
	$result=mysqli_query($conn, $selectQuery);
	
	if(mysqli_num_rows($result)==1){
				
		$_SESSION['message']="You are logged in";
		$_SESSION['username']=$username;
		header("location: ../crudajax/index.php");
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <title>Login page</title>
</head>
<body>
<script>
    if(window.history.replaceState){
        window.history.replaceState(null,null,window.location.href);
    }
</script>

<?php
		if(isset($_SESSION['message'])){
			
			echo "<div id='sessionMessage'>".$_SESSION['message']."</div>";
		}
	?>

<div class="container">
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div class="jumbotron">
            <h1 class="display-6">Login</h1>
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="username1">Username:</label>
                    <input type="text" id="username1" name="username" class="form-control col-lg-12" placeholder="username">
                </div>
                <div class="form-group">
                    <label for="password1">Password:</label>
                    <input type="password" id="password1" name="password" class="form-control col-lg-12" placeholder="password">
                </div>
                <input type="submit" class="btn btn-dark" name="loginBtn" value="Login"> 
                <input type="button" onclick="location.href='register.php'" class="btn btn-info" value="Registration">
             </form>
            </div>
        </div>
        <div class="col-lg-4"></div>
    </div>
</div>

	<!-- <?php
		if(isset($_SESSION['message'])){
			
			echo "<div id='sessionMessage'>".$_SESSION['message']."</div>";
		}
	?>
	
	
	<form method="post" action="login.php">
	<table>
		<tr>
			<td>Username:</td>
			<td><input type="text" name="username" class="textInput"></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><input type="password" name="password" class="textInput"></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="submit" name="loginBtn" value="Login">
				<a href="register.php">Registration</a>
			</td>
		</tr>
	</table>
	</form> -->
</body>

</html>