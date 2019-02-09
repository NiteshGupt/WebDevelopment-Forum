<?php
	require '../connect.php';
	session_start();
	if(isset($_POST['login_but'])){
		$uname=$_POST['uname'];
		$upass=$_POST['upass'];
		$query="SELECT *FROM user WHERE user_name='$uname' AND user_pass='$upass'";
		$query_run=mysqli_query($connect,$query);
		$rows=mysqli_fetch_array($query_run);
		if(mysqli_num_rows($query_run)>0){
			$_SESSION['name']=$rows['user_name'];
			$_SESSION['joindate']=$rows['join_date'];
			$_SESSION['uid']=$rows['user_id'];

			header('location:../index.php');
		}
		else{
			$msg="err";
			header('location:../index.php?msg='.$msg);
		}
		

	}

?>