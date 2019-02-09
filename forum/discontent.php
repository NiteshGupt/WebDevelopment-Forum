<?php
	function displaycat(){
		require 'connect.php';

		$query="SELECT *FROM categories";
		$query_run=mysqli_query($connect,$query);
		echo "<table>";
		while($rows=mysqli_fetch_array($query_run)){
			echo "<tr>
						<td colspan='3'>
							<div class='cat'>
								<h3>".$rows['cat_title']."</h3>
							</div>
						</td>
					</tr>";
					displaysub($rows['cat_id']);
		}
		echo "</table>";

	}
	function displaysub($cat_id){
		require 'connect.php';

		echo '<tr class="contenthead">
				<td>
					<h4>FORUMS</h4>
				</td>
				<td>
					<h4>Last Post</h4>
				</td>
				<td>
				</td>
				
			</tr>';
		$query="SELECT *FROM sub_cat WHERE parent_id='$cat_id'";
		$query_run=mysqli_query($connect,$query);
		while($rows=mysqli_fetch_array($query_run)){
			echo "<tr>
					<td>
						<div class='content'>
							<h5><a href='topics.php?cid=".$rows['parent_id']."&sid=".$rows['sub_id']."'>".$rows['sub_title']."</a></h5>
							<p>".$rows['sub_desc']."</p>
						</div>
					</td>
					<td><div class='content no'>";
			$q="SELECT *FROM topics WHERE category_id='".$rows['parent_id']."' AND subcategory_id='".$rows['sub_id']."'";
			$q_run=mysqli_query($connect,$q);
			if(mysqli_num_rows($q_run)){
				getlastpost($rows['parent_id'],$rows['sub_id']);
			}
			echo "</div>
					</td>
					<td><div class='content no'><p>Threads: ".totalthreads($cat_id,$rows['sub_id'])."</p><p>Replies: ".totalreplies($cat_id,$rows['sub_id'])."
						</div>
					</td>
					
				</tr>";
		}
	}
	function getlastpost($cid,$sid){
		require 'connect.php';

		$query="SELECT topic_id, title, lastpost_date, lastpost_time, lastreply_by FROM topics WHERE category_id='$cid' AND subcategory_id='$sid' ORDER BY lastpost_date DESC, lastpost_time DESC LIMIT 1";
		$query_run=mysqli_query($connect,$query);
		$rows=mysqli_fetch_array($query_run);
		echo '<p><a href="readthread.php?cid='.$cid.'&sid='.$sid.'&tid='.$rows['topic_id'].'">'.$rows['title'].'</a></p><p>by <strong>';
		getuserlink($rows['lastreply_by']);
		echo $rows['lastreply_by'].'</a></strong></p><p>on '.$rows['lastpost_date'].' at '.$rows['lastpost_time'].'</p>';
	}
	function getuserlink($name){
		require 'connect.php';

		$query="SELECT user_id FROM user WHERE user_name='$name'";
		$query_run=mysqli_query($connect,$query);
		$rows=mysqli_fetch_array($query_run);
		echo '<a href="user.php?uid='.$rows["user_id"].'">';
	}
	function totalthreads($cat_id,$sub_id){
		require 'connect.php';
		$query = "SELECT *FROM topics WHERE category_id='$cat_id' AND subcategory_id='$sub_id'";
		$query_run = mysqli_query($connect,$query);
		return mysqli_num_rows($query_run); 
	}
	function totalreplies($cat_id,$sub_id){
		require 'connect.php';
		$query = "SELECT *FROM replies WHERE category_id='$cat_id' AND subcategory_id='$sub_id'";
		$query_run = mysqli_query($connect,$query);
		return mysqli_num_rows($query_run); 
	}
	
	function distopics(){
		require 'connect.php';

		$query="SELECT *FROM topics WHERE category_id='".$_GET['cid']."' AND subcategory_id='".$_GET['sid']."' ORDER BY lastpost_date DESC, lastpost_time DESC";
		$query_run=mysqli_query($connect,$query);
		echo "<table><tr>
						<td colspan='4'>
							<div class='path'>
								<h3>
									<a href='index.php'>SA-MP</a> > <span class='pathcurrent'>".getpagetitle()."</span>
								 </h3>
							</div>
						</td>
					</tr>
					<tr class='contenthead'>
						<td>
							<h4>THREADS</h4>
						</td>
						<td>
							<h4>Last Post</h4>
						</td>
						<td>
							<h4>Replies</h4>
						</td>
						<td>
							<h4>Views</h4>
						</td>
					</tr>";
		if(mysqli_num_rows($query_run)!=0){
		while($rows=mysqli_fetch_array($query_run)){
			echo "<tr>
					<td>
						<div class='content'>
							<h5><a href='readthread.php?cid=".$_GET['cid']."&sid=".$_GET['sid']."&tid=".$rows['topic_id']."'>".$rows['title']."</a></h5>
							<p>".$rows['author']."</p>
						</div>
					</td>
					<td><div class='content no'><p>on ".$rows['lastpost_date']." at ".$rows['lastpost_time']."</p><p> by ";
				getuserlink($rows['lastreply_by']);
				echo $rows['lastreply_by']."</a><div>
					</td>
					<td><div class='content no'><p>".threadreplies($_GET['cid'],$_GET['sid'],$rows['topic_id'])."</p></div>
					</td>
					<td><div class='content no'><p>".$rows['views']."</p></div>
					</td>
				</tr>";
		}
		}
		else{
			echo "<tr>
					<td>
					<div class='no_thread'><p>There id no thread yet to show</p></div></td>
			</tr>";
		}
		echo "</table>";
	}
	function threadreplies($cat_id,$sub_id,$topic_id){
		require 'connect.php';

		$query ="SELECT * FROM replies WHERE category_id='$cat_id' AND subcategory_id='$sub_id' AND topic_id='$topic_id'";
		$query_run=mysqli_query($connect,$query);
		return mysqli_num_rows($query_run);
	}
	function getpagetitle(){
		require 'connect.php';

		$query ="SELECT * FROM sub_cat WHERE sub_id='".$_GET['sid']."'";
		$query_run=mysqli_query($connect,$query);
		$rows=mysqli_fetch_array($query_run);
		return $rows['sub_title'];
	}
	function gettopictitle(){
		require 'connect.php';

		$query ="SELECT * FROM topics WHERE topic_id='".$_GET['tid']."'";
		$query_run=mysqli_query($connect,$query);
		$rows=mysqli_fetch_array($query_run);
		return $rows['title'];
	}
	function disnewthread(){
		if(isset($_SESSION['name'])){
			echo '<form action="action/addthread.php?cid='.$_GET["cid"].'&sid='.$_GET["sid"].'" method="post">
						<label for="title">Title: </label><br>
						<input class="titleinput "id="title" type="text" name="Title" required><br>
						<label for="content">Message: </label><br>
						<textarea class="msginput" type="text" name="content" id="content" rows="10" cols="100" required></textarea><br>
						<button type="submit" name="submitthread" class="submitthread">Submit New Thread</button>
					</form>';
		}		
	}
	function disthread(){
		require 'connect.php';
		$query="UPDATE topics SET views=views+1 WHERE category_id='".$_GET['cid']."' AND subcategory_id='".$_GET['sid']."' AND topic_id='".$_GET['tid']."'";
		mysqli_query($connect,$query);
		$query="SELECT *FROM topics WHERE category_id='".$_GET['cid']."' AND subcategory_id='".$_GET['sid']."' AND topic_id='".$_GET['tid']."'";
		$query_run=mysqli_query($connect,$query);
		$rows=mysqli_fetch_array($query_run);
		echo "
			<div class='path'>
				<h3>
					<a href='index.php'>SA-MP</a> > <a href='topics.php?cid=".$_GET['cid']."&sid=".$_GET['sid']."'> ".getpagetitle()."</a> > <span class='pathcurrent'>".gettopictitle()."</span>
				 </h3>
			</div>
			<div class='topic'>
				<div class='title'>
					<h3>Thread: ".$rows['title']."</h3>
					<p>on ".$rows['date_posted']." at ".$rows['time']."</p>
				</div>
				<div class='tinfo'>
					<div class='userinfo'>
						<h4>";
				getuserlink($rows['author']);
				echo $rows['author']."</a></h4>
						";
				getdp($rows['author']);
				getuserinfo($rows['author']);
				echo	"</div>
					<pre>".$rows['content']."</pre>
				</div>
			</div>";
		$query="SELECT * FROM replies WHERE category_id='".$_GET['cid']."' AND subcategory_id='".$_GET['sid']."' AND topic_id='".$_GET['tid']."'";
		$query_run=mysqli_query($connect,$query);
		while($rows=mysqli_fetch_array($query_run)){
			echo	"<div class='reply'>
						<div class='title'>
							<h3>Reply: ".gettopictitle()."</h3>
							<p>on ".$rows['date_posted']." at ".$rows['time']."</p>
						</div>
						<div class='tinfo'>
							<div class='userinfo'>
								<h4>";
				getuserlink($rows['author']);
				echo $rows['author']."</a></h4>
							";
					getdp($rows['author']);
					getuserinfo($rows['author']);
					echo	"</div>
							<pre>".$rows['comment']."</pre>
						</div>
					</div>";
		}	
	}
	function getdp($name){
		require 'connect.php';
		$query="SELECT avatar_path, isset_avatar FROM user WHERE user_name='".$name."'";
		$query_run=mysqli_query($connect,$query);
		$rows=mysqli_fetch_array($query_run);
		if($rows['isset_avatar']==true){
			echo "<div class='img' style='background: url(".$rows['avatar_path']."); background-size:100% 100%;'>";
		}else{
			echo "<div class='img' style='background: url(img/i.jpg); background-size:100% 100%;'>";
		}
		echo "</div>";

	}
	function getuserinfo($user){
		require 'connect.php';
		$query="SELECT join_date, post FROM user WHERE user_name='$user'";
		$query_run=mysqli_query($connect,$query);
		$rows=mysqli_fetch_array($query_run);
		echo '<p>Join date:'.$rows['join_date'].'<br>
				Posts: '.$rows['post'].'</p>';
	}
	function disreplybox(){
		echo '<div class="replybox">
				<div class="title"><h3>Reply:</hr></div>';
		echo '<form action="action/addreply.php?cid='.$_GET["cid"].'&sid='.$_GET["sid"].'&tid='.$_GET["tid"].'" method="post">
					<textarea class="msginput" type="text" name="content" id="content" rows="8" cols="80" required></textarea><br>
					<button type="submit" name="submitthread" class="reply_but">Reply</button>
				</form>
			</div>';
			
	}
	function displayprofile(){
		require 'connect.php';
		$query="SELECT * FROM user WHERE user_id='".$_GET['uid']."'";
		$query_run=mysqli_query($connect,$query);
		$rows=mysqli_fetch_array($query_run);
		echo "<div class='profile'>";
			if(isset($_SESSION['name'])){
				
					echo "<div class='imgcontainer'>
								<p>".$rows['user_name']."'s Avatar</p>";
								if($rows['isset_avatar']==true){
									echo "<div class='img' style='background: url(".$rows['avatar_path']."); background-size:100% 100%;'>";
								}else{
									echo "<div class='img' style='background: url(img/i.jpg); background-size:100% 100%;'>";
								}
									if($rows['user_name']==$_SESSION['name']){
										echo "<div class='edit'><h4>Edit</h4></div>";
									}
							echo "</div>";
							if($rows['user_name']==$_SESSION['name']){

								echo "<form action='action/upload.php?uid=".$rows['user_id']."' method='post' enctype='multipart/form-data'>
									<input class='file' type='file' name='file'><br>
									<button class='upload' type='submit' name='upload'>UPLOAD</button>
								</form>";
							}
						echo "</div>";
				
			}
			else{
				echo "<div class='imgcontain'>
								<p>".$rows['user_name']."'s Avatar</p>";
								if($rows['isset_avatar']==1){
									echo "<div class='img' style='background: url(".$rows['avatar_path']."); background-size:100% 100%;'>";
								}else{
									echo "<div class='img' style='background: url(img/i.jpg); background-size:100% 100%;'>";
								}echo "</div>
						</div>";
			}
				echo	"<div class='uinfo'><h1>".$rows['user_name']."</h1>
							<p>Join Date: ".$rows['join_date']."<br>
							Email id: ".$rows['email']."<br>
							Posts: ".$rows['post']."</p>
					
						</div>
			</div>";
	}
	
?>