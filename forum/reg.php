<?php
	if(isset($_GET['msg'])) {
		if($_GET['msg']=="username"){
			echo '<script> alert("Error: Username already registered") </script>';
		}
		if($_GET['msg']=="email"){
			echo '<script> alert("Error: Email id already registered") </script>';
		}
		if($_GET['msg']=="match"){
			echo '<script> alert("Error: Password and Confirm Password does not match.") </script>';	
		}
		if($_GET['msg']=="length"){
			echo '<script> alert("Error: Password must be greater than 6 character.") </script>';	
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>SA-MP Registration</title>
	<link rel="stylesheet" href="css/regstyle.css">
</head>
<body>
	<div class="mainContainer">
		<div class="header">
			<div class="logo">
				<h1>SA-MP</h1>
				<p>forum</p>
			</div>
		</div>

		<div class="regform">
			<h1> Create your Account</h1>
			<form action="action/Registration.php" method="post">
				<table>
					<tr>
						<td>
							<label for="uname">Username</label>
							<input class="inputbox" type="text" name="name">
						</td>
						<td>
							<label for="email">Email Address</label>
							<input class="inputbox" type="email" name="email">
						</td>
					</tr>
					<tr>
						<td>
							<label for="upass">Password</label>
							<input class="inputbox" type="Password" name="pass">
						</td>
						<td>
							<label for="cpass">Confirm Password</label>
							<input class="inputbox" type="Password" name="cpass">
						</td>
					</tr>
					<tr>
						<td>
							<input name="signin" class="Signup_but" type="submit" value="Signup">
						</td>
					</tr>
				</table>
			</form>
		</div>

	</div>
</body>
</html>