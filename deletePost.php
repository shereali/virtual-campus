<?php include '../core/dbc.php'; ?>
<?php if($_GET['id']){
    $id=$_GET['id'];
    $id = mysqli_escape_string($id);
}
$del = "DELETE from posts where id = '$id'";

$result =$db->query($del);
?>

