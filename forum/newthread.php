<?php
	session_start();
	require 'connect.php';
	require 'func.php';
	require 'discontent.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>New Thread</title>
	<link rel="stylesheet" href="css/style1.css">
</head>
<body>
	<div class="mainContainer">
		<div class="header">
			<div class="logo">
				<h1>SA-MP</h1>
				<p>forum</p>
			</div>
			<div class="login">
				<?php
					if(isset($_SESSION['name'])){
						logoutform();
					}
					else{
						loginform();
						if(isset($_GET['msg'])) {
							if($_GET['msg']=="err") {
								echo '<script type="text/javascript"> alert("Invalid Username or Password")</script>';
							}
							if($_GET['msg']=="Success") {
								echo '<script type="text/javascript"> alert("You have successfully registered. Now you can login into account.")</script>';
							}
						}
					}
				?>
			</div>		
		</div>
		<div class="body">
			<div class="container">
				<h3>Post New Thread</h3>
				<?php
					if(isset($_SESSION['name'])){
						disnewthread();
					}
					else{

					}				
				?>
			</div>
		</div>
	</div>
	<div class="footer">
		<p>Copyright ©2000 - 2018, San Andreas Multiplayer Ltd.</p>
	</div>
</body>
</html>