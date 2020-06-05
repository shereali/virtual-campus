<!DOCTYPE html>
<?php session_start();?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Virtual Campus</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/chat.css">
  <link rel="stylesheet" href="css/swipebox.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lobster+Two|Satisfy" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lobster+Two|Patrick+Hand|Satisfy" rel="stylesheet">
  <!-- Bootstrap styles -->
<!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"> -->
<!-- Generic page styles -->
<!-- <link rel="stylesheet" href="upload/css/style.css"> -->
<!-- blueimp Gallery styles -->
<link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="upload/css/jquery.fileupload.css">
<link rel="stylesheet" href="upload/css/jquery.fileupload-ui.css">
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript><link rel="stylesheet" href="upload/css/jquery.fileupload-noscript.css"></noscript>
<noscript><link rel="stylesheet" href="upload/css/jquery.fileupload-ui-noscript.css"></noscript>
  <!-- <link rel="stylesheet" href="css/screen_ie.css">
  <link rel="stylesheet" href="css/screen.css"> -->
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.10.2.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->


    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="js/chat.js"></script>
    <script type="text/javascript" src="js/dropzone.js"></script>
  <script src="js/jquery.swipebox.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
 
  </head>
  <?php
if(isset($_SESSION["username"])){

$user = $_SESSION["username"];


}

else{

// header('location:sign_in.php','_self');
// exit();
}
?>
<?php $getName="SELECT * FROM users WHERE username='$user'";
$runName=$db->query($getName);
while($fetchName=mysqli_fetch_assoc($runName)){
  extract($fetchName);
}


?>
  <body>