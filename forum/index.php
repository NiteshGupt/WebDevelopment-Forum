<?php
	session_start();
	require 'connect.php';
	require 'func.php';
	require 'discontent.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sa-mp Forum</title>
	
	<link rel="stylesheet" href="css/style.css?c=o">
</head>
<body>
	<?php
		regform();
	?>
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
			<?php
				displaycat();				
			?>
		</div>
	</div>
	<div class="footer">
		<p>Copyright ©2000 - 2018, San Andreas Multiplayer Ltd.</p>
	</div>
	<script type="text/javascript" src="jquery/jq.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="js/regajax.js"></script>
</body>
</html>