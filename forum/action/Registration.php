<?php
	require '../connect.php';
	if(isset($_POST['action'])){
		if($_POST['action']=="checkname"){
			$name=ucfirst($_POST['name']);
			$query="SELECT *FROM user WHERE user_name='$name'";
			$query_run=mysqli_query($connect,$query);
			if(mysqli_num_rows($query_run)>0){
				//USERNAME already exist
				echo "exist";

			}
			else if(strlen($name)<3){
				echo "length";
			}
		}
		else if($_POST['action']=="checkemail"){
			$email=$_POST['email'];
			$query="SELECT *FROM user WHERE email='$email'";
			$query_run=mysqli_query($connect,$query);
			if(mysqli_num_rows($query_run)>0){
				//USERNAME already exist
				echo "exist";

			}
			else if(filter_var($email, FILTER_VALIDATE_EMAIL)==false){
				echo "invalid";
			}
		}
		else if($_POST['action']=="checkpass"){
			$pass=$_POST['pass'];
			if(strlen($pass)<7){
				echo "length";
			}
		}
		else if($_POST['action']=="checkmatch"){
			$pass=$_POST['pass'];
			$cpass=$_POST['cpass'];

			if($pass!=$cpass){
				echo "miss";
			}
		}
	}/*
	if(isset($_POST['signin'])){
		$name=ucfirst($_POST['name']);
		$email=$_POST['email'];
		$pass=$_POST['pass'];
		$cpass=$_POST['cpass'];
		$query="SELECT *FROM user WHERE user_name='$name'";
		$query_run=mysqli_query($connect,$query);
		if(mysqli_num_rows($query_run)>0){
			//USERNAME already exist
			$msg="username";
			header('location: ../reg.php?msg='.$msg);

		}
		else{
			$query="SELECT *FROM user WHERE email='$email'";
			$query_run=mysqli_query($connect,$query);
			if(mysqli_num_rows($query_run)>0){
				//email already exist
				$msg="email";
				header('location: ../reg.php?msg='.$msg);
			}
			else{
				if(strlen($pass)>6){
					if($pass==$cpass){
						$query="INSERT INTO user (`user_name`,`user_pass`,`email`,`join_date`) value('$name','$pass','$email',NOW())";
						$query_run=mysqli_query($connect,$query);
						if($query_run){
							$msg="Success";
							header('location: ../index.php?msg='.$msg);
						}
					}
					else{
						$msg="match";
						header('location: ../reg.php?msg='.$msg);
					}
				}
				else{
					$msg="length";
					header('location: ../reg.php?msg='.$msg);
				}
			}
		}
	}*/

?>