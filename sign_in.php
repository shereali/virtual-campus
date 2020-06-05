<?php include 'core/dbc.php';?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navigation.php'; ?>
<?php if (isset($_SESSION['username'])) {
	echo "<script>window.open('index.php','_self');</script>";
} ?>
<div class="container-fluid custom-success" style="background: url(img/signup.jpg)no-repeat !important;background-size: 100% !important;height:670px; width:100%!important;">
	<div class="row">
	<div class="col-md-6"></div>
		<div class="col-md-4 pull-right">
<?php   
$email=((isset($_POST['email']))?sanitize($_POST['email']):'');
// $email=trim($email);
//$password=123456;
$password=((isset($_POST['password']))?sanitize($_POST['password']):'');
$passwordMd5=md5($password);
//$hashed=password_hash($password, PASSWORD_DEFAULT);
$errors=array();
// Form validation
if ($_POST) {
	if (empty($_POST['email']) || empty($_POST['password'])) {
		$errors[]='Email or password is missing';

	}

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors[]='You must enter a valid email';
	}



	// if (strlen($password)<6) {
	// 	$errors[]='Password must be at least 6 characters';
	// }


	$query=$db->query("SELECT * FROM users WHERE email='$email' AND password='$passwordMd5' AND code_confirm>0 ");
	$user=mysqli_fetch_assoc($query);
	$userCount=mysqli_num_rows($query);
	// echo $user['password'];

	if ($user['code_confirm']==0 || empty($user['code_confirm'])) {
	 	$errors[]='Your account is not activated. Please check your email and submit your activation code!';
	 } 

	if ($userCount<1) {
		$errors[]='That email does not exit!';
	}

	if ($passwordMd5!=$user['password']) {
		$errors[]="Your password does not match";
	}
// 	if (!password_verify($password, $user['password'])) {
// 	$errors[]='The password doest not match!';
// }

if (!empty($errors)) {
	echo display_errors($errors);
}
else{
	$username=$user['username'];
	echo "<script>alert('Sign In Successfull')</script>";
	// echo $username=$user['username'];
	login($username);
	// echo "<script>window.open('$username')</script>";
}
}
?>
			
				<div class="panel-heading"><h3>Sign In</h3><hr></div>
				<form action="sign_in.php" class="form" method="post">
						<div class="form-group">
							<label for="email">Email</label>
							<input type="text" name="email" class="form-control">
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" name="password" class="form-control">
						</div>
					<div class="form-group">
					<input type="submit" value="Sign In" class="form-control">
					</div>
				</form>	
				<p>Already have not an account? <a href="sign_up.php">Sign Up here</a> </p>
		</div>
	</div>
</div>
<?php include 'includes/footer.php'; ?>