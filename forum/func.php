<?php
	function loginform(){
		echo '<form action="action/login.php" method="post">
			<table>
				<tr>
					<td> <label for="username">UserName</label> </td>
					<td> <input name="uname" class="loginbox" type="text"  id="username" required placeholder="Username"></td>
				</tr>
				<tr>
					<td> <label for="userpass">Password</label> </td>
					<td> <input class="loginbox" type="Password" name="upass" id="userpass" required placeholder="Password">	</td> 
					<td> <button class="log_but" type="submit" name="login_but" >Log in</button></td>
				</tr>
			</table>
		</form>
		<h4>Haven\'t registered? <span id="reg">Register here</span></h4>';
	}
	function logoutform(){
		echo '<h3> Welcome, <a href="user.php?uid='.$_SESSION["uid"].'">'.$_SESSION['name'].'</a></h3>
				<p>Join date: '.$_SESSION['joindate'].'
				<form action="action/logout.php" method="post">
				<button class="login_but" type="submit">Log out</button>
				</form>';
	}
	function regform(){
		echo '<div id="regbg">
		<div class="regform">
			<h1> Create your Account <span id="close">&times</span></h1>
			<form action="action/registeration.php" method="post">
				<table>
					<tr>
						<td>
							<div id="name_error" class="error name"></div>
							<label for="uname">Username</label>
							<input id="name" class="inputbox" type="text" name="name">
						</td>
						<td>
							<div id="email_error" class="error email"></div>
							<label for="email">Email Address</label>
							<input id="email" class="inputbox" type="email" name="email">
						</td>
					</tr>
					<tr>
						<td>
							<div id="pass_error" class="error pass"></div>
							<label for="upass">Password</label>
							<input id="pass" class="inputbox" type="Password" name="pass">
						</td>
						<td>
							<div id="cpass_error" class="error cpass"></div>
							<label for="cpass">Confirm Password</label>
							<input id="cpass" class="inputbox" type="Password" name="cpass">
						</td>
					</tr>
					<tr>
						<td>
							<input name="signin" id="Signup_but" type="button" value="Signup">
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>';
	}
?>