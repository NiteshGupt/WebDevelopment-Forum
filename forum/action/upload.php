<?php
	require '../connect.php';
	if(isset($_POST['upload'])){
		$file=$_FILES['file'];
		$filename=$_FILES['file']['name'];
		$filetemp=$_FILES['file']['tmp_name'];
		$filesize=$_FILES['file']['size'];
		$fileerror=$_FILES['file']['error'];
		$filetype=$_FILES['file']['type'];

		$fileExt=explode('.', $filename);
		$fileActualExt=strtolower(end($fileExt));
		$query="SELECT user_name FROM user WHERE user_id='".$_GET['uid']."'";
		$query_run=mysqli_query($connect,$query);
		$rows=mysqli_fetch_array($query_run);
		$allowfile= array('jpg','jpeg', 'png');
		if(in_array($fileActualExt, $allowfile)){
			if($fileerror===0){
				if($filesize < 500000){
					$fileNewName=$rows['user_name']."avatar.".$fileActualExt;
					$fileDest='../img/'.$fileNewName;
					$path='img/'.$fileNewName;
					$query="UPDATE `user` SET avatar_path='".$path."', isset_avatar=true WHERE user_id='".$_GET['uid']."'";
					$query_run=mysqli_query($connect,$query);
					move_uploaded_file($filetemp, $fileDest);
					if($query_run){
						$err='success';
						header('location: ../user.php?uid='.$_GET['uid'].'&msg='.$err);
					}
				}
				else{
					$err='size';
					header('location: ../user.php?uid='.$_GET['uid'].'&msg='.$err);
				}
			}
			else{
				$err='error';
				header('location: ../user.php?uid='.$_GET['uid'].'&msg='.$err);	
			}
		}
		else{
			$err='type';
			header('location: ../user.php?uid='.$_GET['uid'].'&msg='.$err);
		}
	}

?>
