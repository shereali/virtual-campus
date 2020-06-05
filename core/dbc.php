<?php ob_start(); ?>
<?php $db=mysqli_connect('localhost','root','','tmuproje_vc');
if (mysqli_connect_errno()) {
	echo "Database connection failed with following errors".mysqli_connect_error();
	die();
}
?>

<?php include 'helpers/helpers.php'; 

if (isset($_SESSION['success_flash'])) {
	echo '<div class="bg-success"><p class="text-success text-center"> '.$_SESSION['success_flash'].'</p></div>';
	unset($_SESSION['success_flash']);
}


if (isset($_SESSION['error_flash'])) {
	echo '<div class="bg-danger"><p class="text-danger text-center"> '.$_SESSION['error_flash'].'</p></div>';
	unset($_SESSION['error_flash']);
}


?>