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
<div class="container-fluid">
	<div class="row">
	<!-- upload profile -->
		<div class="col-md-4 col-md-offset-1">
			<div class="page-header">Upload Your Photo: Only <strong style="color:#fff;">.jpg</strong> and <strong style="color:#fff;">.png</strong> are allowed.</div>
			<?php 

				// new code
	if (isset($_POST['upload_image'])) {
 	if ($_FILES['image_file']['name']!=''){
 		$allowedEx=array("jpg","png");
 		$extension=explode('.', $_FILES['image_file']['name']);
 		$ext=end($extension);

 		   // 	$ext =explode('.', $_FILES['image_file']['name']);
		    // $extension = strtolower(array_pop($ext));   
		    // $fileName = array_shift($ext);

 		if (in_array($ext, $allowedEx)) {
 			if ($_FILES['image_file']['size']<500000) {
 				$name=md5(rand()).'.'.$ext;
 				$path="images/".$name;
 				move_uploaded_file($_FILES['image_file']['tmp_name'], $path);
 				$insert_query="UPDATE  users SET  profile_picture ='$name' WHERE username='$user'";
 				$db->query($insert_query);
 				header('location:'.$username.'?file_name='.$name.'');
 			}
 			else{
 				echo "<script>alert('Image too large')</script>";
 			}
 		}
 		else{
 			echo "<script>alert('Image is invalid')</script>";

 		}
 	}
 	else{
 		echo "<script>alert('Please select a image')</script>";
 	}
 }

			// new code image upload end




		// 	if (isset($_POST['upload'])) {


		// $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
		// 	$rand_dir_name = substr(str_shuffle($chars),0,15);
		// 	mkdir("images/$rand_dir_name");
		// 	$post_image =$_FILES['file']['name'];
			// $allowedExts = array("gif", "jpeg", "jpg", "png");
			// $extension = end(explode(".", $_FILES["file"]["name"]));
			// if ((($_FILES["file"]["type"] == "image/gif")
			// || ($_FILES["file"]["type"] == "image/jpeg")
			// || ($_FILES["file"]["type"] == "image/jpg")
			// || ($_FILES["file"]["type"] == "image/png"))
			// && ($_FILES["file"]["size"] < 20000)
			// && in_array($extension, $allowedExts))

// 		if ($post_image=="") {
// 			echo "<p class='alert-danger'>You did not select any photo</p>";
			
// 		}else{
// 		$post_image =$_FILES['file']['name'];	
// 		 $image_tmp=$_FILES['file']['tmp_name'];
		 
// 		move_uploaded_file($image_tmp,"./images/$post_image");

// 	    $insert_query="UPDATE  users SET  profile_picture ='$post_image' WHERE username='$user'";
// }

// if ($db->query($insert_query))
//   {
 
//  echo "<p class='alert-success'>
//  Profile picture upload successfully! Check your profile!</p>";

//  }


// };
 

?>
			<form action="" class="form-inline" method="post" enctype="multipart/form-data"  accept="image">
				<div class="form-group">
					<input class="form-control" name="image_file" type="file">
					<input type="submit" id="upload" name="upload_image" class="form-control btn btn-sm c-success" value="Upload">
					<button class="btn btn-sm c-success" id="uploading">Uploading..</button>
				</div>
			</form>

<?php 
$updateinfo = @$_POST['updateinfo'];
$get_info = "SELECT * FROM users WHERE username='$user'";

$check_info = $db->query($get_info);

$get_row = mysqli_fetch_assoc($check_info);

$fname = $get_row['fname'];
$lname = $get_row['lname'];
$batch = $get_row['batch'];
$identy = $get_row['identy'];
$department = $get_row['department'];
$program = $get_row['program'];
$lname = $get_row['lname'];
$bio_data = $get_row['bio_data'];

// select code end here.......


// update code start here......

if ($updateinfo) {
	$firstname = strip_tags(@$_POST['fname']);
	$lastname = strip_tags(@$_POST['lname']);
	$batch = strip_tags(@$_POST['batch']);
	$identy = strip_tags(@$_POST['identy']);
	$department = strip_tags(@$_POST['department']);
	$program = strip_tags(@$_POST['program']);
	$bio = @$_POST['bio_data'];

	if (strlen($firstname) < 3) {
		echo "Your first name must be greater than 3 characters!";
	}

	else if(strlen($lastname) < 4){
			echo "Your last name must be greater than 4 characters!";
	}

	else{

		$info_submit_query = $db->query("UPDATE users SET fname='$firstname',lname='$lastname',batch='$batch',identy='$identy',department='$department',program='$program', bio_data='$bio' WHERE username='$user'");

		echo "Your profile updated successfully!";
	}
}

else{

}


$check_pic = $db->query("SELECT profile_picture FROM users  WHERE username='$user'");
	
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
			$rand_dir_name = substr(str_shuffle($chars),0,15);
			mkdir("images/$rand_dir_name");


	$get_pic_row = mysqli_fetch_assoc($check_pic);
	$profile_pic_db = $get_pic_row['profile_picture'];
	if ($profile_pic_db == "") {

		$profile_pic = "img/011.png";
	}

	else{

		$profile_pic = "images/$rand_dir_name/".$profile_pic_db;
	}




	if (isset($_FILES['profilepic'])) {
		if (((@$_FILES["profilepic"]["type"]=="image/jpeg") || (@$_FILES["profilepic"]["type"]=="image/gif") || (@$_FILES["profilepic"]["type"]=="image/png")) && (@$_FILES["profilepic"]["size"]<1048576))
		{

			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
			$rand_dir_name = substr(str_shuffle($chars),0,15);
			mkdir("images/$rand_dir_name");

			if (file_exists("images/$rand_dir_name".@$_FILES['profilepic']['name'])) 
			{
				echo @$_FILES["profilepic"]["name"]."Already exists";

			}

			else{

					move_uploaded_file(@$_FILES["profilepic"]["tmp_name"],"images/$rand_dir_name".$_FILES["profilepic"]["name"]);
					// echo "Uploaded and stored in". @$_FILES["profilepic"]["name"];

						$profile_pic_name = @$_FILES['profilepic']['name'];

					$profile_pic_query = $db->query("UPDATE users SET profile_picture='$rand_dir_name/$profile_pic_name' WHERE username='$user'");


			}

			
		}

		else{


		}
	}




?>


		<div class="page-header">Change personal info</div>
		<?php if (isset($_GET['changinfo'])):
		$changinfo=$_GET['changinfo'];
		 ?>
			<form action="" class="form" method="post">
			<div class="form-group">
				<label for="first_name">First Name</label>
				<input type="text" name="fname" value="<?=$fname;?>" class="form-control">
			</div>
			<div class="form-group">
			<label for="last_name">Last Name</label>
			<input type="text" name="lname" value="<?=$lname;?>" class="form-control">
			</div>
			<div class="form-group">
			<label for="batch">Batch</label>
			<input type="text" name="batch" value="<?=$batch;?>" class="form-control">
			</div>
			<div class="form-group">
			<label for="identy">Identy</label>
			<input type="text" name="identy" value="<?=$identy;?>" class="form-control">
			</div>
			<div class="form-group">
			<label for="department">Department</label>
			<input type="text" name="department" value="<?=$department;?>" class="form-control">
			</div>
			<div class="form-group">
			<label for="program">Program</label>
			<input type="text" name="program" value="<?=$program;?>" class="form-control">
			</div>
			<div class="form-group">
				<label for="bio">Bio Data</label>
				<textarea name="bio_data" class="form-control" id="" cols="40" rows="5"><?=$bio_data;?></textarea>
			</div>
			<div class="form-inline">
			<input type="submit" value="Update" name="updateinfo" class="btn c-success btn-sm">
				<a href="settings.php" class="btn btn-sm btn-default">Cancel</a>
			</div>

		</form>

	<?php else: ?>
		<ul class="list-group">
			<li class="list-group-item">
				<span class="badge" style="background: #fff !important;"><a href="settings.php?changinfo"><span class="glyphicon glyphicon-pencil"></span></a></span>
				<?=$fname;?>
			</li>
			<li class="list-group-item">
				<span class="badge" style="background: #fff !important;"><a href="settings.php?changinfo"><span class="glyphicon glyphicon-pencil"></span></a></span>
				<?=$lname;?>
			</li>
			<li class="list-group-item">
				<span class="badge" style="background: #fff !important;"><a href="settings.php?changinfo"><span class="glyphicon glyphicon-pencil"></span></a></span>
				<?=$batch;?>
			</li>
			<li class="list-group-item">
				<span class="badge" style="background: #fff !important;"><a href="settings.php?changinfo"><span class="glyphicon glyphicon-pencil"></span></a></span>
				<?=$identy;?>
			</li>
			<li class="list-group-item">
				<span class="badge" style="background: #fff !important;"><a href="settings.php?changinfo"><span class="glyphicon glyphicon-pencil"></span></a></span>
				<?=$department;?>
			</li>
			<li class="list-group-item">
				<span class="badge" style="background: #fff !important;"><a href="settings.php?changinfo"><span class="glyphicon glyphicon-pencil"></span></a></span>
				<?=$program;?>
			</li>
			
			<li class="list-group-item">
				<span class="badge" style="background: #fff !important;"><a href="settings.php?changinfo"><span class="glyphicon glyphicon-pencil"></span></a></span>
				<?=$bio_data;?>
			</li>
		</ul>
		<?php endif;?>
		


		<!-- change info -->

		<!-- change password -->
<?php
// variable diclaration of password form
$senddata = $_POST['senddata'];
$old_password = $_POST['old_pass'];
$new_password = $_POST['new_pass'];
$new_password2 = $_POST['confirm_pass'];
// if data already sent the database then this code select those data for dispaly updated form
if ($senddata) {
$password_query =$db->query("SELECT * FROM users WHERE username='$user'");
while ($row=mysqli_fetch_assoc($password_query)) {
	$db_password = $row['password'];

	$old_password_md5 = md5($old_password);


	if ($old_password_md5 == $db_password) {

		if ($new_password == $new_password2) {

			if (strlen($new_password) <= 4) {

				echo "Your password must be greter than 4 characters long!";
				
			}

			else{
			
			
			$new_password_md5 = md5($new_password);
			$password_updated_query =$db->query("UPDATE users SET password='$new_password_md5' WHERE username='$user'");
			echo "Your Password updated successfully!";
		}


		}
		else{
			echo "Your new password does not matched!";
		}
	}
	else{
		echo "Old password does not match!";
	}

}
	
}

else{

	echo "";
}






 ?>
 <!-- changing password -->
	
			<div class="page-header">Change Password</div>
			<?php if (isset($_GET['edit-password'])):
			$edit_pass=$_GET['edit-password']; ?>
				<form action="settings.php" method="post">
			<div class="form-group">
				<label for="old_pass">Old password</label>
				<input type="password" class="form-control" name="old_pass">
			</div>
			<div class="form-group">
				<label for="new_pass">New password</label>
				<input type="password" class="form-control" name="new_pass">
			</div>
			<div class="form-group">
				<label for="confirm_pass">Confirm password</label>
				<input type="password" class="form-control" name="confirm_pass">
			</div>
			<div class="form-inline">
				<input type="submit" name="senddata" value="Save Changes" class="btn btn-sm c-success">
				<a href="settings.php" class="btn btn-sm btn-default">Cancel</a>
			</div>
			</form>
		<?php else: ?>
			<li class="list-group-item" >
			<span class="badge" style="background:#fff !important;" ><a href="settings.php?edit-password"><span class="glyphicon glyphicon-pencil "></span></a></span>

			****************************
				
			</li>
		
			<?php endif; ?>
			
		</div><!--col-md-4 end here-->
		<div class="col-md-4 col-offset-1">
			<div class="page-header text-success">Social Connections</div>
			
			
			<?php if (isset($_POST['social_urls'])) {
				// var_dump($_POST);

				$facebook=mysqli_real_escape_string($db,$_POST['facebook']);
				$twitter=mysqli_real_escape_string($db,$_POST['twitter']);
				$linkedin=mysqli_real_escape_string($db,$_POST['linkedin']);
				$googleplus=mysqli_real_escape_string($db,$_POST['googleplus']);
				$youtube=mysqli_real_escape_string($db,$_POST['youtube']);
				$github=mysqli_real_escape_string($db,$_POST['github']);
				if (isset($_GET['social_id'])) {
					$insert_urls="UPDATE social_connections SET username='$user', facebook='$facebook',twitter='$twitter', linkedin='$linkedin',googleplus='$googleplus',youtube='$youtube', github='$github' WHERE username='$user'";
				// echo $insert_urls;
				$result=$db->query($insert_urls);
				}
				else{
					$insert_urls="INSERT INTO social_connections SET username='$user', facebook='$facebook',twitter='$twitter', linkedin='$linkedin',googleplus='$googleplus',youtube='$youtube', github='$github'";
				// echo $insert_urls;
				$result=$db->query($insert_urls);
				}
				if ($result) {
					if (isset($_GET['social_id'])) {
						echo "<p style='color:green';>Social links updated  successfully!</p>";

					}
					else{
						echo "<p style='color:green';>Social links inserted successfully!</p>";

					}
				}
			} ?>


			<?php $select_social="SELECT * FROM social_connections WHERE username='$user' ";
			$socialQ=$db->query($select_social);
			$check=mysqli_num_rows($socialQ);
			while($socialRow=mysqli_fetch_assoc($socialQ)):
			extract($socialRow);

			endwhile; ?>
			
				<form action="" class="form" method="post">
				<div>
				<?php if (empty($check)): ?>
				<a href="settings.php?add" class="btn btn-sm btn-success">+Add</a>
				<?php else: ?>	
					<a href="settings.php?social_id" class="btn btn-sm btn-warning">Edit</a>
				<?php endif ?>
			
			<a href="settings.php" class="btn btn-sm btn-danger">Cancel</a>
				</div><br>
				<div class="form-group"><label class="sr-only" for=""></label>
					<div class="input-group" style="<?php echo ((isset($_GET['social_id'])|| isset($_GET['add']))?'':'display: none') ?>">
				      <div class="input-group-addon">Facebook</div>
				      <input type="text" class="form-control" value="<?php echo ((isset($_GET['social_id']))?$facebook:'')?>" name="facebook" id="exampleInputUrl" placeholder="Type your Facebook Usearname">
				      
				    </div>
				</div>
				<div class="form-group"><label class="sr-only"  for=""></label>
					<div class="input-group" style="<?php echo ((isset($_GET['social_id'])|| isset($_GET['add']))?'':'display: none') ?>">
				      <div class="input-group-addon">Twitter</div>
				      <input type="text" class="form-control" value="<?php echo ((isset($_GET['social_id']))?$twitter:'')?>" name="twitter" id="exampleInputUrl" placeholder="Type your Twitter Usearname">
				      
				    </div>
				</div>
				<div class="form-group"><label class="sr-only" for=""></label>
					<div class="input-group" style="<?php echo ((isset($_GET['social_id'])|| isset($_GET['add']))?'':'display: none') ?>">
				      <div class="input-group-addon">Linkedin</div>
				      <input type="text" class="form-control" value="<?php echo ((isset($_GET['social_id']))?$linkedin:'')?>" name="linkedin" id="exampleInputUrl" placeholder="Type your Linkedin Usearname">
				      
				    </div>
				</div>
				<div class="form-group"><label class="sr-only" for=""></label>
					<div class="input-group" style="<?php echo ((isset($_GET['social_id'])|| isset($_GET['add']))?'':'display: none') ?>">
				      <div class="input-group-addon">Google+</div>
				      <input type="text" class="form-control" value="<?php echo ((isset($_GET['social_id']))?$googleplus:'')?>" name="googleplus" id="exampleInputUrl" placeholder="Type your Google+ Usearname">
				      
				    </div>
				</div>
				<div class="form-group"><label class="sr-only" for=""></label>
					<div class="input-group" style="<?php echo ((isset($_GET['social_id'])|| isset($_GET['add']))?'':'display: none') ?>">
				      <div class="input-group-addon">Youtube</div>
				      <input type="text" class="form-control" value="<?php echo ((isset($_GET['social_id']))?$youtube:'')?>" name="youtube" id="exampleInputUrl" placeholder="Type your Youtube Username">
				      
				    </div>
				</div>
				<div class="form-group"><label class="sr-only" for=""></label>
					<div class="input-group" style="<?php echo ((isset($_GET['social_id'])|| isset($_GET['add']))?'':'display: none') ?>">
				      <div class="input-group-addon">Github</div>
				      <input type="text" class="form-control" value="<?php echo ((isset($_GET['social_id']))?$github:'')?>" name="github" id="exampleInputUrl" placeholder="Type your Github Username">
				      
				    </div>
				</div>
				<div class="form-group" style="<?php echo ((isset($_GET['social_id'])|| isset($_GET['add']))?'':'display: none') ?>">
				<label class="sr-only" for=""></label>

				      <input type="submit" class="btn btn-sm c-success" name="social_urls" value="<?php echo ((isset($_GET['social_id']))?'Update':'Save') ?>" id="exampleInputUrl" placeholder="Url">
				      
				      
				   
				</div>
			</form>

			<ul class="list-group" style="<?php echo ((isset($_GET['social_id'])|| isset($_GET['add']))?'display: none':'') ?>">
				<li class="list-group-item">
					<span class="badge" style="background: #fff !important;"><a href="settings.php?social_id"><span class="glyphicon glyphicon-pencil"></span></a></span>
					Facebook: <?=$facebook;?>
				</li>
				<li class="list-group-item">
					<span class="badge" style="background: #fff !important;"><a href="settings.php?social_id"><span class="glyphicon glyphicon-pencil"></span></a></span>
					Twitter: <?=$twitter;?>
				</li>
				<li class="list-group-item">
					<span class="badge" style="background: #fff !important;"><a href="settings.php?social_id"><span class="glyphicon glyphicon-pencil"></span></a></span>
					Google+ <?=$googleplus;?>
				</li>
				<li class="list-group-item">
					<span class="badge" style="background: #fff !important;"><a href="settings.php?social_id"><span class="glyphicon glyphicon-pencil"></span></a></span>
					Linkedin: <?=$linkedin;?>
				</li>
				<li class="list-group-item">
					<span class="badge" style="background: #fff !important;"><a href="settings.php?social_id"><span class="glyphicon glyphicon-pencil"></span></a></span>
					Youtube: <?=$youtube;?>
				</li>
				<li class="list-group-item">
					<span class="badge" style="background: #fff !important;"><a href="settings.php?social_id"><span class="glyphicon glyphicon-pencil"></span></a></span>
					Github: <?=$github;?>
				</li>
			</ul>	
		
		</div>

			</div>
		</div>
	</div>
</div>
<br>
<br>
<script type="text/javascript">
	$(document).ready(function(){
		$('#uploading').hide();
		$("#upload").on('click',function(){
			$(this).hide();
			$('#uploading').show();
		})
	})
</script>
<?php include 'includes/footer.php'; ?>