<?php
include 'core/dbc.php';
$sql2="SELECT * FROM chat WHERE chat_from='" . $_POST['chatfrom'] . "' AND chat_to='" . $_POST['chatto'] . "' OR chat_from='" . $_POST['chatto'] . "' AND chat_to='" . $_POST['chatfrom'] . "' ORDER BY id ASC";

$query2=$db->query($sql2);

while($sms=mysqli_fetch_assoc($query2)):
	extract($sms);

	$dt =[
	'message' =>$message,
	'chatfrom'=>$chat_from,
	'chatto'=>$chat_to,
	'msg_date'=>$sent];
	// echo json_decode($dt);
	// echo $dt['message'];

if($chatfrom === $user && $chatto!=$user){
?>
<div class="msg_b"><?php echo $message; ?></div>
<?php
}
else {
?>
<div class="msg_a">
 <?php 
	$sql="SELECT profile_picture FROM users WHERE username='$chat_from'";
		$result=$db->query($sql);
		while($row=$result->fetch_assoc()):
	?>
	<img  src="images/<?php echo $row['profile_picture']; ?>" alt="..." style="width:30px; height:30px;">&nbsp;&nbsp;<?php echo $message; ?>
			<?php endwhile; ?>

</div>

<?php
}
endwhile; ?>