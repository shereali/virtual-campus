<?php include 'core/dbc.php'; ?>
<?php 
$chat_from = $_POST['chatfrom'];
$chat_to = $_POST['chatto'];
$msg = $_POST['chatmsg'];

$sql="INSERT INTO chat SET chat_from='$chat_from', chat_to='$chat_to', message='$msg'";
$query=$db->query($sql);

if($chat_from == $user){
?>
<div class="msg_a"><?php echo $msg; ?></div>
<?php
}
else {
	?>
<div class="msg_b"><?php echo $msg; ?></div>
	<?php
}
?>

