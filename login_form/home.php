<?php 

session_start();

?>

<html>

<head><link rel="stylesheet" type="text/css" href="style.css"></head>

<body>


	<div class="header">
		<h1>User regitration, login, logout</h1>
	</div>
	
	<?php
		if(isset($_SESSION['message'])){
			
			echo "<div id='sessionMessage'>".$_SESSION['message']."</div>";
		}
	?>
		
	<h1>Welcome <?php echo $_SESSION['username']; ?></h1>
	<div><a href="logout.php">Logout</a></div>

</body>

</html>