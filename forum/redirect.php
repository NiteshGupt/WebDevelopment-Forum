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
	
	<link rel="stylesheet" href="css/style.css">
</head>
<body>			
	<div class="mainContainer">	
		<div class="redirectmsg">
			<h1>Successfully Registered!</h1><br>
			<p>You will be automatically redirect in <span class="delay">5</span> seconds.</p>
		</div>
	</div>
	<div class="footer">
		<p>Copyright ©2000 - 2018, San Andreas Multiplayer Ltd.</p>
	</div>
	<script type="text/javascript" src="jquery/jq.js"></script>
	<script type="text/javascript">
		var count=5;
		setInterval(function(){
			count--;
			$('.delay').html(count);
			if(count==0){
				window.location="index.php";
			}
		},1000);

	</script>
</body>
</html>