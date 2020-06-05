<?php include 'core/dbc.php';?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navigation.php';
 
if (!isset($_SESSION['username'])) {
    header('location:sign_in.php');
    exit();
}
?>

<div class="container-fluid" style="background: url(img/holding-hands-2ib1ouh.jpg)no-repeat; background-size: 100%;height:670px;">
	<div class="row">
		<div class="col-md-6 col-md-offset-6">
<?php
$getFriendName=$db->query("SELECT * FROM users WHERE username='$user'");
$fetchName=mysqli_fetch_assoc($getFriendName);
$firstName=$fetchName['fname']; 
$lastName=$fetchName['lname']; 
$friend_request = $db->query("SELECT * FROM friend_request WHERE user_to ='$user'");
$numrows = mysqli_num_rows($friend_request);

if ($numrows == 0):
	echo "You have no friends request!";


	$user_from="";
?>

<?php else:?>

<?php	while ($get_row = mysqli_fetch_assoc($friend_request)):
		$user_to = $get_row['user_to'];
		$id = $get_row['id'];
		$user_from = $get_row['user_from'];
		?>

	<p style="color:#F92672;"><?=$user_from;?>  wants to be your friend!</p>



	




<?php 

if (isset($_POST['acceptrequest'.$user_from])) {

	// Get friend arry for logged in user

	$get_friend_check = $db->query("SELECT friend_array FROM users WHERE username='$user'");
	$get_friend_row = mysqli_fetch_assoc($get_friend_check);
	$friend_array = $get_friend_row['friend_array'];
	$friendArray_explode = explode(",", $friend_array);

	$friendArray_count = count($friendArray_explode);

	

// Get friend_array for who sent friend request 

	$get_friend_check_friend = $db->query("SELECT friend_array FROM users WHERE username='$user'");
	$get_friend_row_friend = mysqli_fetch_assoc($get_friend_check_friend);
	$friend_array_friend = $get_friend_row_friend['friend_array'];
	$friendArray_friend_explode = explode(",", $friend_array_friend);
	$friendArray_count_friend = count($friendArray_friend_explode);

	

	if ($friend_array == "") {
		$friendArray_count = count(NULL);
	}


	if ($friend_array_friend == "") {
		$friendArray_count_friend = count(NULL);
	}

	if ($friendArray_count == NULL) {
		$add_friend_query = $db->query("UPDATE users SET friend_array= CONCAT(friend_array,'$user_from') WHERE username='$user'");
	}



	if ($friendArray_count_friend == NULL) {
		$add_friend_query = $db->query("UPDATE users SET friend_array= CONCAT(friend_array,'$user_to') WHERE username='$user_from'");

	
	}


	if ($friendArray_count >=1) {
		$add_friend_query = $db->query("UPDATE users SET friend_array= CONCAT(friend_array,',$user_from') WHERE username='$user'");
	}

	if ($friendArray_count_friend >=1) {
		$add_friend_query = $db->query("UPDATE users SET friend_array= CONCAT(friend_array,',$user_to') WHERE username='$user_from'");


		
	}


$delete_request = $db->query("DELETE FROM friend_request WHERE user_to='$user_to' && user_from='$user_from'");


 echo "Yahoo! Your are now friend and you have $friendArray_count_friend friends!";
 echo "<script>window.location='friend_request.php'</script>";

 // header("location:friend_request.php");


}

if (isset($_POST['ignorerequest'. $user_from])) {
	$ignore_request = $db->query("DELETE FROM friend_request WHERE user_to='$user_to' && user_from='$user_from'");

	echo "$user_from 's Request Ignored!";
	
}


  ?>

<?php $getinfo=$db->query("SELECT u.fname,u.lname,u.username,u.profile_picture,f.id,f.user_from,f.user_to FROM users AS u LEFT JOIN friend_request AS f ON u.username=f.user_from WHERE username='$user_from'");
while($gr=mysqli_fetch_assoc($getinfo)):
extract($gr); ?>
<?php endwhile; ?>
<form action="friend_request.php" method="POST">
<div class="col-md-12 custom-shadow">
				<div class="col-md-6">
				<img src="./images/<?=$profile_picture;?>" style="margin-top:2px;"  width="80px" height="80px" class="thumbnail-rounded pull-left" alt="">
				<div class="form-group col-md-8">
					<h4><b><?=$fname;?> <?=$lname;?></b></h4>
					<p>Department: <?=$department;?></p>
				</div>

			</div>
			<div class="col-md-6 col-xs-3">
				<br><div class="form-inline pull-right">
				<form action="friend_list.php" method="POST">
					<input class="btn  c-success btn-xs" type="submit" name="acceptrequest<?php echo $user_from; ?>" value="Accept">
					<input class="btn btn-default btn-xs" type="submit" name="ignorerequest<?php echo $user_from; ?>" value="Reject">
				</form>
				</div>
			</div>
			</div>

</form>
<?php endwhile; ?>

<?php endif; ?>

		</div>
		<div class="col-md-6">
			
		</div>
	</div>
</div>


<?php include 'includes/footer.php'; ?>