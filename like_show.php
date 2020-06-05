<?php include 'core/dbc.php';?>
<?php 
$post_id=$_POST['post_id'];
$username=$_POST['user'];
$selectLike="SELECT *  FROM like_system WHERE post_id='$post_id' AND username='$username'";
$likequery=$db->query($selectLike);
// $likeArray=[];
while ($row=mysqli_fetch_assoc($likequery)) {

	echo $row['likes']." ".$row['liketext'];



 }
// echo json_encode($likeArray);

 ?>