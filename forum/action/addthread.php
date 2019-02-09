<?php
	require '../connect.php';
	session_start();
	if(isset($_SESSION['name'])){
		$title=$_POST['Title'];
		$content=$_POST['content'];
		$author=$_SESSION['name'];
		$cid=$_GET['cid'];
		$sid=$_GET['sid'];
		$date=date('y/m/d');
		$time=date('h:i:sa');
		$query="INSERT INTO topics (`category_id`, `subcategory_id`, `author`, `title`, `content`, `date_posted`, `time`, `views`, `lastpost_date`, `lastpost_time`, `lastreply_by`) VALUES ('".$cid."','".$sid."','".$author."','".$title."','".$content."',NOW(),NOW(),0,NOW(),NOW(),'".$author."');";
		$query_run=mysqli_query($connect,$query);
		if($query_run){
			$query="UPDATE `user` SET post=post+1 WHERE user_name='$author'";
			$query_run=mysqli_query($connect,$query);
			header('location: ../topics.php?cid='.$cid.'&sid='.$sid);
		}
		else{
			echo "error";
		}
	}
	else{
		echo "Error: You have to first login";
	}
?>