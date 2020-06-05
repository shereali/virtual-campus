<?php include 'core/dbc.php';
$cmSql="SELECT * FROM post_comments WHERE post_id='" . $_POST['posted_id'] . "'";
$cmdQ=$db->query($cmSql);
while ($cmdRow=mysqli_fetch_assoc($cmdQ)) {
	extract($cmdRow);
	echo $post_body;
}


?>