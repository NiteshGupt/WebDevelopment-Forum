<?php
	require '../connect.php';
	session_start();	
	$comment=$_POST['content'];
	$author=$_SESSION['name'];
	$cid=$_GET['cid'];
	$sid=$_GET['sid'];
	$tid=$_GET['tid'];
	$query="INSERT INTO `replies`(`category_id`, `subcategory_id`, `topic_id`, `author`, `comment`, `date_posted`, `time`) VALUES ('$cid','$sid','$tid','$author','$comment',NOW(),NOW())";
	$query_run=mysqli_query($connect,$query);
	if($query_run){
		$query="UPDATE `user` SET post=post+1 WHERE user_name='$author'";
		$query_run=mysqli_query($connect,$query);
		$query="UPDATE `topics` SET lastpost_date=NOW(), lastpost_time=NOW(), lastreply_by='$author' WHERE category_id='$cid' AND subcategory_id='$sid' AND topic_id='$tid'";
		$query_run=mysqli_query($connect,$query);
		if($query_run){
			header('location: ../readthread.php?cid='.$cid.'&sid='.$sid.'&tid='.$tid);
		}
		else{
			echo "Errorr";
		}
	}
	else{
		echo "Error";
	}

?>