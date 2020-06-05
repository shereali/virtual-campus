<?php include 'core/dbc.php';?>
<form action="" method="post">
	<input type="text" name="code_confirm"><input type="submit" name="code_sb" value="Confirm">
</form>

<?php 
if (isset($_POST['code_sb'])) {
$user=$_GET['user'];
$code=$_POST['code_confirm'];

$sql="UPDATE users SET code_confirm='$code' WHERE username='$user'";
$qry=$db->query($sql);
if ($qry) {
	echo "<p>Your email address successfully confirmed. You can login now <a href='sign_in.php'>here</a></p>";

}
else{
	echo "Email confirmation failed!";
}
 } 

?>

