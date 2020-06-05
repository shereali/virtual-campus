<?php include 'core/dbc.php';?>
<?php 
// var_dump($_POST);
$unlikes=$_POST['unlikes'];
var_dump($unlikes);
$unliketext=$_POST['unliketext'];
$post_id=$_POST['post_id'];
$username=$_POST['user'];

$unlikeSql="INSERT INTO unlike_system SET unlikes='$unlikes', unliketext='$unliketext',post_id='$post_id', username='$username'";
$query=$db->query($unlikeSql);
if ($query) {
	echo "success";
}
// $like=$_POST['likes'];

 ?>