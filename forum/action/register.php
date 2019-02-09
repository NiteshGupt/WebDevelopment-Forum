<?php
	require "../connect.php";
	$name=ucfirst($_POST['name']);
	$email=$_POST['email'];
	$pass=$_POST['pass'];
	$query="INSERT INTO user (`user_name`,`user_pass`,`email`,`join_date`) value('$name','$pass','$email',NOW())";
	$query_run=mysqli_query($connect,$query);
	if($query_run){
		$msg="Success";
		header('location: ../index.php?msg='.$msg);
	}
?>