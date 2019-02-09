<?php
	session_start();
	require 'connect.php';
	require 'func.php';
	require 'discontent.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php
		echo getpagetitle();	

	?></title>
	<link rel="stylesheet" href="css/style.css">
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
		<?php
			if(isset($_SESSION['name'])){
				$path="newthread.php?cid".$_GET["cid"]."&sid=".$_GET["sid"];
				echo '<form action="newthread.php?cid='.$_GET["cid"].'&sid='.$_GET["sid"].'" method="post">
						<button class ="thread_but" type="submit">NEW THREAD</button>
					</form>';
			}

		?>
		<div class="body">
			<?php
				distopics();				
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