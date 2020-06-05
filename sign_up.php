<?php include 'core/dbc.php';?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navigation.php'; ?>

<div class="container-fluid custom-success" style="background: url(img/Verimli-Ders-Çalışmanın-Teknikleri.jpg)no-repeat !important;background-size: 100% !important;height:670px; width:100%!important;">
<div class="row">
<div class="col-md-7">
<h3 class="pull-right">Join with Virtual Campus.<br><br> It's Always Free!</h3>
<!-- <h3 class="pull-right">It's Always Free!</h3> -->
</div>
<div class="col-md-4  pull-right">
	<div class="panel-heading"><h3>Sign Up</h3><hr></div>
<?php 
$fn=((isset($_POST['fname']))?sanitize($_POST['fname']):'');
$ln=((isset($_POST['lname']))?sanitize($_POST['lname']):'');
$email=((isset($_POST['email']))?sanitize($_POST['email']):'');
$email2=((isset($_POST['email2']))?sanitize($_POST['email2']):'');
$password=((isset($_POST['password']))?sanitize($_POST['password']):'');
$gn=((isset($_POST['gender']))?sanitize($_POST['gender']):'');
$un=strtolower($fn.$ln);
$batch="";
$identy="";
$department="";
$program="";
$bio_data="";
$code=0;
$d = date("Y-m-d");
$post_image = "";
$friend_array= "";
$u_check = "";
$confirm_code=rand();
$msg=
'<h2>Hi ' .$fn.' '.$ln."</h2>"."<br>"
.'Email : ' .$email."<br><br>"
.'Confirmation Code : ' .$confirm_code."<br><br>"
.'Username : ' .$un."<br><br>"
."Thank you for joining our Virtual Campus"."<br><br>"
."<td><a href='www.shereali.me/virtual-campus/confirm_email.php?user=$un'>Confirm Your email address</a></td>"."<br><br>"
.'If above link does not work then copy the link below and paste it on browser'.'<br><br>'
.'Confirmation Link : '.'<a href="#">www.shereali.me/virtual-campus/confirm_email.php?user='.$un.'</a>';

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

if ($_POST) {
	$emailQuery=$db->query("SELECT * FROM users WHERE email='$email'");
	$emailCount=mysqli_num_rows($emailQuery);
	if ($emailCount !=0) {
		$errors[]='This Email Already exist!';
	}


	$required=array('fname', 'lname','email','email2', 'password','gender');
	foreach($required as $f){
		if (empty($_POST[$f])) {
			$errors[]='Please fill out the all fields!';
			break;
		}
	}

	if (strlen($password)<6) {
		$errors[]='Your provided password must at least 6 characters!';
	}

	if ($email!=$email2) {
		$errors[]='Your email does not match!';
	}

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors[]='You must enter a valid email!';
	}

	// $email_domain = preg_replace('/^.+?@/', '', $email).'.';
	// if(!checkdnsrr($email_domain, 'MX') && !checkdnsrr($email_domain, 'A')){
	//   $errors[]='Your Email is not valid!'; 
	// }

	// if (mail($email,'Virtual Campus User Registration Notification', $msg)) {
		
	// }else{
	// 	$errors[]='Invalid mail!';
	// }

	if (!empty($errors)) {
		echo display_errors($errors);
	}
	

	else{
		// add user to database
		$pmd5=md5($password);
		$userData=$db->query("INSERT INTO users VALUES('','$fn','$ln','$un','$email','$pmd5','$gn','$d','0','$post_image', '$friend_array','$batch','$identy','$department','$program','$bio_data','$code') ");
		if ($userData) {
			$_SESSION['success_flash']='<span style="color:green;">Your account is created! you can sign in now<span>';
				echo "<script>alert('Sign Up Successfull. Sign in please!');</script>";
				echo "<script>window.open('sign_in.php','_self');</script>";
				mail($email,'New user registration Successful',$msg, $headers);

		}
		
	}
}

?>
	
			<form action="" class="form" method="post">
				<div class="form-group">
				<label for="fname">First Name</label>
				<input type="text" name="fname" class="form-control">
				</div>
				<div class="form-group">
				<label for="lname">Last Name</label>
				<input type="text" name="lname" class="form-control">
				</div>
				<div class="form-group">
				
				<input type="hidden" name="username" value="<?=$username;?>" class="form-control">
				</div>
				<div class="form-group">
				<label for="email">Email</label>
				<input type="text" name="email" class="form-control">
				</div>
				<div class="form-group">
				<label for="email2">Confirm Email</label>
				<input type="text" name="email2" class="form-control">
				</div>
				<div class="form-group">
				<label for="password">Password</label>
				<input type="password" name="password" class="form-control">
				</div>
				<div class="form-inline">
				<label for="confirm">Male</label>
				<input type="radio" name="gender" value="male" class="form-control">
				<label for="confirm">Female</label>
				<input type="radio" name="gender" value="female" class="form-control">
				</div>
				<div class="form-group">
				<input type="submit" name="reg" value="Sign Up" class="form-control">
				</div>
			</form>
			<p>Already have an account? <a href="sign_in.php"> Signin here</a> </p>
		</div>
	</div>
</div>
<?php include 'includes/footer.php'; ?>