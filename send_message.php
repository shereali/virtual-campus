<?php include 'core/dbc.php';?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navigation.php'; ?>
<?php 
if ($user) {



}

else{

	die("You must logged in!");
}
 ?>


 <?php if (isset($_GET['u'])):
 	$username=mysqli_real_escape_string($db,$_GET['u']);
 	if (ctype_alnum($username)):
 		$check=$db->query("SELECT username FROM users WHERE username='$username'");
 		if (mysqli_num_rows($check===1)):
 			$get=mysqli_fetch_assoc($check);
 			$username=$get['username'];
 			if ($username !=$user):
 				if (isset($_POST['submit'])) {
 					$msg_body=@$_POST['msg_body'];
 					$msg_date=date("Y-m-d");
 					$opened="no";
 					$send_msg=$db->query("INSERT INTO messages VALUES('','$user','$username','$msg_body','$opened')");
 				}
 				
?>

<div class="container">
	<div class="row">
		<div class="col-md-6">
			<form action="send_message.php?u='<?=$username;?>'" method="post">
	<textarea class="form-control" name="" id="" cols="30" name="msg_body" rows="10"></textarea>
	<input type="submit" name="sendmsg" value="Send Message">
</form>
		</div>
	</div>
</div>

<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
 <?php endif;?>


 <?php include 'includes/footer.php'; ?>