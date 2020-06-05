<?php include 'core/dbc.php';?>
<?php 
// var_dump($_POST);
if ($_POST['likedtext']=="") {
	$likedtext="Liked";
}else{
	$likedtext=$_POST['likedtext'];
}
$likes=$_POST['likes'];
// var_dump($_POST);
$liketext=$_POST['liketext'];

$post_id=$_POST['post_id'];
$username=$_POST['user'];
$select="SELECT * FROM like_system WHERE post_id='$post_id' AND username='$username'";
$upQ=$db->query($select);
$row=mysqli_fetch_assoc($upQ);
// $totalLike=$row['likes']+$likes;
// echo $row['username'];
if ($row['username']==$username) {
	if ($likes==0) {
		$totalLike=$row['likes']-1;
		$update="UPDATE like_system SET likes='$totalLike', liketext='$likedtext', post_id='$post_id', username='$username' WHERE post_id='$post_id' AND username='$username'";
	$q=$db->query($update);
	}
	else{
	$totalLike=$row['likes']+$likes;
		$update="UPDATE like_system SET likes='$totalLike', liketext='$likedtext', post_id='$post_id', username='$username' WHERE post_id='$post_id' AND username='$username'";
	$q=$db->query($update);	
	}
	
}
else{
$likeSql="INSERT INTO like_system SET likes='$likes', liketext='$liketext',post_id='$post_id', username='$username'";
$query=$db->query($likeSql);
if ($query) {
	
}

}
$post_id=$_POST['post_id'];
$username=$_POST['user'];
$selectLike="SELECT *  FROM like_system WHERE post_id='$post_id' AND username='$username'";
$likequery=$db->query($selectLike);
while ($row=mysqli_fetch_assoc($likequery)) {
	echo $row['likes']." ".$row['liketext'];
 }

 ?>