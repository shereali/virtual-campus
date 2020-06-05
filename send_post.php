<?php 
$post = @$_POST['post'];
if ($post!="") {
	
	$added_by = $user;

	$user_posted_to = $username;
	$importance=$_POST['importance'];

	if ($_FILES['file']['name'] !="") {
		$post_images=time().$_FILES['file']['name'];
		$pc="post_images/".$post_images;
		copy($_FILES['file']['tmp_name'],$pc);
	}

	$sqlCommands = "INSERT INTO posts VALUES('','$post',NOW(),'$added_by','$user_posted_to','$post_images', '$importance')";
	$query = $db->query($sqlCommands) or die(mysqli_error());
}
else{
	// echo "<script>alert('You do not  enter any text!')</script>";
}


 ?>