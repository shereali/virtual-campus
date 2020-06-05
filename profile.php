<?php include 'core/dbc.php';?>
<?php include 'includes/header.php';
include 'includes/navigation.php';
if (!isset($_SESSION['username'])) {
    header('location:sign_in.php');
    exit();
}

$fname = @$_GET['fname'];
$lname = @$_GET['lname'];

if (isset($_GET['u'])) {
	$username = mysqli_real_escape_string($db,$_GET['u']);
	
	if (ctype_alnum($username)) {
		$check = $db->query("SELECT username, fname, lname FROM users WHERE username='$username'");
		if (mysqli_num_rows($check)==1) {

			$get = mysqli_fetch_assoc($check);
			$username = $get['username'];
			$fname = $get['fname'];
			$lname = $get['lname'];

		}

		else{
			echo"<meta http-equiv=\"refresh\"0; url=http://virtual-campus.com\">";
			exit();
		}


		
	}
}

?>
<?php $user=$_SESSION['username']; ?>
<?php include("send_post.php"); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3 feeds-and-friends">
		<div class="page-header"><p>My Social Connections</p></div>
			<!-- <h5>Yasna's news feed</h5> -->
			<?php 
			$select_social="SELECT * FROM social_connections WHERE username='$username' ";
			$socialQ=$db->query($select_social);
			while($socialRow=mysqli_fetch_assoc($socialQ)):
			extract($socialRow);

			endwhile; ?>
			<a href="https://www.facebook.com/<?=$facebook; ?>" target="_blank" title="Visit <?php echo $username; ?>'s Facebook Profile"><span class="fa fa-facebook fa-2x"></span><span class="text-warning"></span></a>&nbsp;
			<a href="https://www.twitter.com/<?=$twitter;?>" target="_blank" title="Visit <?php echo $username; ?>'s Twitter Profile"><span class="fa fa-twitter fa-2x"></span><span class="text-warning"> </span></a>&nbsp;
			<a href="https://www.linkedin.com/<?=$linkedin;?>" target="_blank" title="Visit <?php echo $username; ?>'s Linkedin Profile"><span class="fa fa-linkedin fa-2x"></span><span class="text-warning"> </span></a>&nbsp;
			<a href="https://plus.google.com/<?=$googleplus;?>" target="_blank" title="Visit <?php echo $username; ?>'s Googl+ Profile"><span class="fa fa-google-plus fa-2x"></span><span class="text-warning"></span></a>&nbsp;
			<a href="https://www.youtube.com/<?=$youtube;?>" target="_blank" title="Visit <?php echo $username; ?>'s Youtube Profile"><span class="fa fa-youtube fa-2x"></span><span class="text-warning"> </span></a>&nbsp;
			<a href="https://www.github.com/<?=$github;?>" target="_blank" title="Visit <?php echo $username; ?>'s Github Profile"><span class="fa fa-github fa-2x"></span ><span class="text-warning"> </span></a>
			<br>
			<div class="page-header"><p>Photos</p></div>
			<?php 
			$getPic =$db->query("SELECT * FROM posts WHERE user_posted_to = '$user' ORDER BY id DESC LIMIT 8") or die(mysqli_error());
						while ($rows = mysqli_fetch_assoc($getPic)): 
							$pictures=$rows['status_pic'];
							?>
			<?php if ($pictures!=0): ?>
				<a href="./post_images/<?=$pictures;?>" class="swipebox" title="<?=$fname.' '.$lname;?>">
				<img src="./post_images/<?=$pictures;?>" style="width:70px; height:70px;" alt="Image Not Found">
				</a>
			
								
			<?php endif ?>				
			
			<?php endwhile; ?>
			<div class="page-header"><p>Your classmates</p></div>
			<?php 
			$fArray="";
			$countF="";
			$fArray12="";
			$friendQ=$db->query("SELECT friend_array FROM users WHERE username='$username'");
			$fRow=mysqli_fetch_assoc($friendQ);
			$fArray=$fRow['friend_array'];
			if ($fArray!="") {
				$fArray=explode(",", $fArray);
				$countF=count($fArray);
				$fArray12=array_slice($fArray, 0, 12);
				
				}

				if ($countF!= 0):
				 
				 foreach ($fArray as $key => $value):
				 $i++;
				 $getFriendQuery = $db->query("SELECT * FROM users WHERE username='$value' LIMIT 1");
				 // var_dump($users);
				 $getFriendRow = mysqli_fetch_assoc($getFriendQuery);
				$friendUsername = $getFriendRow['username'];
				 $friendfname = $getFriendRow['fname'];
				 $friendlname = $getFriendRow['lname'];
				 $friendsProfile = $getFriendRow['profile_picture'];

				 if ($friendUsername):?>
				 <?php //var_dump($friendsProfile); ?>
				 	<li class="list-group-item">
				 	<a href='<?=$friendUsername;?>'>
				 	<?php if (empty($friendsProfile)): ?>

				 	<?php else: ?>
				 	<img style='width:50px; height:50px;' src='./images/<?=$friendsProfile;?>'  alt='<?=$friendUsername."'s Profile!;"?> title='<?=$friendUsername."'s Profile!";?>'/> 
				 		
				 	<?php endif ?>
				 	<span><?=$friendfname;?> <?=$friendlname; ?></span></a></li>
				 <?php endif;?>
				 <?php 	endforeach;?>
				

				<?php else:?>
					<h5><?=$fname;?> <?=$lname; ?> has no friend yet!</h5></br></br>
				<?php endif;?>
			
		</div>
	
			<div class="col-md-5 profile-details ">
			 <div class=" col-md-8">
				<h3><a><?=$fname; ?> <?=$lname; ?></a></h3>
					<?php $getName="SELECT * FROM users WHERE username='$username'";
					$runName=$db->query($getName);
					while($fetchName=mysqli_fetch_assoc($runName)):
					  extract($fetchName);
					$viewUser=$username;
					?>
				<p><em><?=$batch; ?><sup></sup></em> <em><?=$identy;?></em> <em><?=$program;?></em></p>
				<p class="text-justify"><?=$bio_data;?></p>
				<?php endwhile; ?>
			</div>
			<div class="profile-picture col-md-4">
				<?php 
					$select_post=" SELECT profile_picture FROM users WHERE username='$username'";
					$run_post=$db->query($select_post);
					while($row = mysqli_fetch_array($run_post)):
					extract($row);
				   $post_image=$row['profile_picture'];
				?>
				<br><img style="width:146px;height:181px;" src="./images/<?php echo $row['profile_picture'];?>" alt="image" class="img-thumbnail">
				<?php  endwhile; ?>				

				
					
				
				<!-- <form action="" method="post">
					<input type="submit" class="form-control btn btn-md custom-success" name="sendmsg" value="Send Message">
				</form> -->
				
				
			</div>
			
			
			<legend><small>Write Something you want</small></legend>
				<form action="<?=$username;?>" method="post" class="form-inline" enctype="multipart/form-data">
					<div class="form-group">
						<textarea id="post" name="post" cols="73" class="form-control" ></textarea>

					</div>
					
					<div class="form-inline">
					<input type="file" class="form-control" id="photo" name="file">
					
					<input type="submit" name="send" onclick="javascript:send_post()" value="Post" class="btn btn-success c-success " style="padding:5px 30px;border-radius: 2px !important; border:0px !important">
					<span style="color:#F92672;"> Make Journal</span> <input type="checkbox" name="importance" value="1">
					</div>
				</form>

			<div class="col-md-11 thumbnail">
				
				    <?php 
				    if (isset($_GET['del'])) {
				    	$del_id=$_GET['del'];
				    	$del="DELETE FROM posts WHERE id='$del_id' AND added_by='$username'";
				    	$runDel=$db->query($del);
				    	if ($runDel) {
				    		header('location:'.$username);
				    		exit();
				    	}
				    	
				    }
				    $getposts =$db->query("SELECT * FROM posts WHERE user_posted_to = '$username' ORDER BY id DESC ") or die(mysqli_error());
						while ($row = mysqli_fetch_assoc($getposts)):
							$id = $row['id'];
							$body = $row['body'];
							$date_added = $row['date_added'];
							
							$added_by = $row['added_by'];
							$picture=$row['status_pic'];
							$user_posted_to = $row['user_posted_to'];
							?>
				<div class="media">
				 <div class="media-left">
				 <?php 
				$select_post=" SELECT profile_picture FROM users WHERE username='$added_by'";
				$run_post=$db->query($select_post);
				while($rowpic = mysqli_fetch_array($run_post)):
				extract($rowpic);
				   
				?>
				      <img class="media-object" src="./images/<?=$profile_picture;?>" alt="..." style="width:40px; height:40px;">
				   <?php endwhile; ?>   
				    
				  </div>
				  <div class="media-body">
				    <?php if ($user_posted_to==$added_by): ?>
				    	<?php $nam="SELECT * FROM users WHERE username='$added_by'";
							$qry=$db->query($nam);
							$nr=$qry->fetch_object();
							?>
						<p class="media-heading"><a href="<?=$added_by;?>">
							
						<?=$nr->fname;?> <?=$nr->lname;?></a></p>
					<h6><smal class="custom-color"><b><?=timeAgo($date_added);?></b></smal>
				<?php else: ?>

					<p class="media-heading">
					<?php $nm="SELECT * FROM users WHERE username='$added_by'";
					$q=$db->query($nm);
					$n=$q->fetch_object();
					 	
					 ?>
					<a href="<?=$added_by;?>"><?=$n->fname.'&nbsp;'.$n->lname; ?></a><span class="glyphicon glyphicon-play"></span><a href="<?=$user_posted_to;?>"> <?=$fname; ?> <?=$lname;?></a></p>
					<h6 ><smal class="custom-color"><b><?=timeAgo($date_added);?></b></smal>
					<?php endif ?>
					<?php
					// $delSql="SELECT * FROM posts";
					// $delquery=$db->query($delSql);
					// $delData=[];
					// foreach ($delquery as $delv) {
					// 	$delData['result']=$delv;
					// echo "<pre>";
					// var_dump($delData['result']['added_by']);
					// echo "</pre>";
					// }
					
					
					 //if ($username==$delData['result']['added_by']): ?>
					<a href="profile.php?del=<?=$id;?>" class="pull-right btn btn-xs btn-default">x</a>
					<?php //endif ?></h6>

				    <p style="font-size: 15px; font-family:'Myriad pro'"><?=$body;?></p>
				    <?php $file_parts = pathinfo($picture);

						$file_parts['extension'];
						$cool_extensions = Array('jpg','png');

						if (in_array($file_parts['extension'], $cool_extensions)):?>
							<p><img src="./post_images/<?=$picture;?>" style="height:350px; width:400px;" alt=""></p>
						  <?php else: ?>
							<p><a href="http://www.tmuproject.com/virtual-campus/post_images/<?=$picture; ?>" target="_blank"><?=$picture; ?></a></p>
						  <?php endif; ?> 
				    
				   <div id="comment<?=$id;?>"></div>
						<span onclick="javascript:toggle<?=$id;?>()"  style="color:#F93A72;cursor:pointer;" class="glyphicon glyphicon-comment"></span>
						<!-- <span >Show coments</span> -->
					<?php echo $users; ?>
					<?php if($id==$id): ?>
						 <!-- <span id="theCount<?=$id;?>"></span>
    					<span id="addMe<?=$id;?>" >Like</span> -->
    				<?php endif; ?>	
    				<span  id="likes<?=$id;?>"></span>	
    				<span style="color:#000 !important; cursor: pointer;" id="like<?=$id;?>" class="glyphicon glyphicon-heart"></span>
    				<span style=" cursor:pointer;" id="liked<?=$id;?>" class="glyphicon glyphicon-heart"></span>
    				<p id="realLike<?=$id?>"></p>
    				
    					<script type="text/javascript">
						        // var counter = 0;

						    	$(document).ready(function(){
						    		// setInterval(function(){
						    			// event.preventDefault();
						        	$.ajax({
						        		url : 'like_show.php',
						        		type :'POST',
						        		data : {post_id:'<?=$id;?>',user:'<?=$username;?>'},
						        		success:function(res){
						        			$('#realLike<?=$id?>').html(res);
						        			console.log(res);

						        		}
						        	});
						        	// },1000);
						    	});
						        $(document).ready(function() {
						        	var like = 0;
						        	var unlike = 0;
						        	$("#liked<?=$id;?>").hide();
						        	$("#unliked<?=$id;?>").hide();
									$("#like<?=$id;?>").click(function(){
										$(this).hide();
										$("#liked<?=$id;?>").show();
									    like += 1;
									    // $("#likes<?=$id;?>").text(like);
									  	$.ajax({
					            		url:'like_ajax.php',
					            		type:'POST',
					            		data:{likes:like,liketext:'Liked',post_id:'<?=$id;?>',user:'<?=$username;?>'},
					            		success:function(response){
					            			$('#liked<?=$id;?>').html(response);
					            			console.log(response);
					            		}

					            	})   
									});
									$("#liked<?=$id;?>").click(function(){
										$(this).hide();
										$("#like<?=$id;?>").show();
									    like -= 1;
									    // $("#likes<?=$id;?>").text(like);
									  	$.ajax({
					            		url:'like_ajax.php',
					            		type:'POST',
					            		data:{likes:like,likedtext:'Likes',post_id:'<?=$id;?>',user:'<?=$username;?>'},
					            		success:function(response){
					            		$('#like<?=$id;?>').html(response);	
					            		console.log(response);
					            		}

					            	})   
									});
								$("#unlike<?=$id;?>").click(function(){
									$(this).hide();
									$("#unliked<?=$id;?>").show();

								    unlike += 1;
								    $("#unlikes<?=$id;?>").text(unlike);
								   	$.ajax({
					            		url:'unlike_ajax.php',
					            		type:'POST',
					            		data:{unlikes:unlike,unliketext:'Unlike',post_id:'<?=$id;?>',user:'<?=$username;?>'},
					            		success:function(response){
					            		console.log(response);
					            		}

					            	}) 
								});	
								$("#unliked<?=$id;?>").click(function(){
									$(this).hide();
									$("#unlike<?=$id;?>").show();

								    unlike -= 1;
								    $("#unlikes<?=$id;?>").text(unlike);
								   	$.ajax({
					            		url:'unlike_ajax.php',
					            		type:'POST',
					            		data:{unlikes:unlike,unlikedtext:'Unliked',post_id:'<?=$id;?>',user:'<?=$username;?>'},
					            		success:function(response){
					            		console.log(response);
					            		}

					            	}) 
								});
							      
						            // $("#addMe<?=$id;?>").click(function(){
						            // 	 counter++;
						          
						               
						    
						            //     $("#theCount<?=$id;?>").text(counter);
						            //     console.log($("#theCount<?=$id;?>").text(counter));
						            // });
						    
						        });
						    </script>

				    <div class="media" id="toggleComment<?=$id;?>" style="display: none;">
						<script type="text/javascript">
						    	function toggle<?=$id;?>(){
						    		var ele=document.getElementById('toggleComment<?=$id;?>');
						    		var text=document.getElementById('displayComment<?=$id;?>');
						    		if (ele.style.display=='block') {
						    			ele.style.display='none';
						    		}
						    		else{
						    			ele.style.display='block';


						    		}



						    		
						    	}

						    	// setInterval(function(){ 
						    	// 	$('veiwCm<?=$id;?>').on('click', function(){
					    		// 	 	var posted_by=$('#posted_by').data('postedby');
								   //    	var posted_to=$('#posted_to').data('postedto');
								   //    	var post_id=$('#posted_id').data('postid');
								   //    	$.ajax({
								   //    		url : 'loadComments.php',
								   //    		type : 'POST',
								   //    		data : {
								   //    			'posted_id' : post_id,
								   //    			'posted_by'	: posted_by,
								   //    			'posted_to' : posted_to
								   //    		}

								   //    		success : function(response){
								   //    			console.log(response);
								   //    			$('#comment<?=$id;?>').html(response);
								   //    		}
								   //    	})

						    	// }); }, 3000);

						    	

					</script>	
					<a href="profile.php?uid=<?=$username;?>"></a>
					<span id="posted_by" data-postedby="<?=$user;?>"></span>
					<span id="posted_to" data-postedto="<?=$viewUser;?>"></span>
					<span id="posted_id" data-postid="<?=$id;?>"></span>
					

					<input type="text" class="form-control" data-id="<?=$id;?>" id="inputComment<?=$id;?>" placeholder="Add your comment" />
					</div>
					<script type="text/javascript">
						$("#inputComment<?=$id?>").keypress(function(e) {

					    if (e.which == 13) {
					    	console.log($(this).attr('data-id'));
					      var comment = $(this).val();
					      var posted_by=$('#posted_by').data('postedby');
					      var posted_to=$('#posted_to').data('postedto');
					      var post_id=$(this).data('id');

					      $.ajax({
					      	url: 'send_comments.php',
					      	type: 'POST',
					      	data:{
					      		'comment': comment,
					      		'posted_by': posted_by,
					      		'posted_to': posted_to,
					      		'posted_id': post_id


					      	},
					      	success:function(response){
					      		console.log($('#comment<?=$id?>'));
					      		$(document).find('#comment<?=$id?>').html(response);
					      		// $('#comment<?=$id;?>').html(response);
					      		// console.log(response);
					      		if (status=='success') {

					      		}
					      	}
					      });
					      $(this).val('');
					    } 

					   
					  });
					</script>
					
				  </div>
				</div>
				<?php endwhile; ?>
			</div>
			
		</div>


<div class="col-md-4">
<?php
$select_id="SELECT * FROM friend_request";
$result_id=$db->query($select_id);
while($row_id=mysqli_fetch_assoc($result_id)){
	extract($row_id);
} 

if (isset($_POST['sendmsg'])) {
	header('location:send_message.php?u=<?=$username;?>');
}

$errorMsg="";
if (isset($_POST['addfriend'])) {

	$friend_request =$_POST['addfriend'];
	$user_to = $user;
	$user_from = $username;
	$request="SELECT * FROM friend_request WHERE id='$id' ";
	$check=$db->query($request);
	$check_request=mysqli_num_rows($check);
	$fetch=mysqli_fetch_assoc($check);
	$to=$fetch['user_to'];
	$from=$fetch['user_from'];
	if ($user_to==$username) {
		$errorMsg = "You can't sent friend request yourself!";
		
	}
	
	else{

		$create_request = $db->query("INSERT INTO friend_request VALUES('','$user_to','$user_from')");
		$errorMsg = "<p style='color:#E6E6E6;'>Your friend request has been sent!</p>";
	}
	
}
else{


}



 ?>


<!-- add friend php code -->
</br>
<form action="<?php echo $username; ?>" method="POST">
<?php
$addAsFriend="";
$friendsArray="";
$countFriends="";
$friendsArray12="";
$selectFriendsQuery=$db->query("SELECT friend_array FROM users WHERE username='$username'");
$friendsRow=mysqli_fetch_assoc($selectFriendsQuery);
$friendsArray=$friendsRow['friend_array'];

if ($friendsArray!="") {
	$friendsArray=explode(",", $friendsArray);
	$countFriends=count($friendsArray);
	$friendsArray12=array_slice($friendsArray, 0, 100);


$i = 0;
if (in_array($user, $friendsArray)) {
	
	$addAsFriend = '<input type="submit" class="btn btn-sm c-success" name="removefriend" value="Leave Classmate">';


}

else{

// Friend Request  validation eg. if add classmaite is clicked once time then add classmate button will be disappear and text message will be appeared.
	$sql="SELECT concat(user_from,' ',user_to) as from_to  FROM friend_request WHERE user_from='$user' OR user_from='$username'";
	$query=$db->query($sql);

	$arr[]='';

		   $both=$user.' '.$username;

	foreach ($query as $data) {

		$arr[]=$data['from_to'];
		
	}

	
	if ($both==$arr[1] || $both==$arr[2] || $both==$arr[3]|| $both==$arr[4]||$both==$arr[5]||$both==$arr[6]||$both==$arr[7]||$both==$arr[8]||$both==$arr[9]||$both==$arr[10]) {
		// echo "<a href='#' class='btn btn-md c-success'>Request already sent</a>";
		// print_r($arr);

	}
	else{
	$addAsFriend = '<input type="submit" class="btn btn-sm c-success" id="add_request" name="addfriend" value="Add Classmate">';	
	}
}
	

	

	// <button class="btn btn-sm btn-danger" id="sent_request">Request Sent</button>

// }


	

// }


if ($_SESSION['username']==$username) {
	
}else{
	echo $addAsFriend;
}

}

else{


	if ($_SESSION['username']==$username) {
		
	}
	else{
//Friend Request  validation eg. if add classmaite is clicked once time then add classmate button will be disappear and text message will be appeared.	
	$sql="SELECT concat(user_from,' ',user_to) as from_to  FROM friend_request WHERE user_from='$user' OR user_from='$username'";
	$query=$db->query($sql);
	$arr[]='';

		
		   $both=$user.' '.$username;

	foreach ($query as $data) {

		$arr[]=$data['from_to'];
		
	}

	
	if ($both==$arr[1] || $both==$arr[2] || $both==$arr[3]|| $both==$arr[4]||$both==$arr[5]||$both==$arr[6]||$both==$arr[7]||$both==$arr[8]||$both==$arr[9]||$both==$arr[10]) {
		// echo "<a href='#' class='btn btn-md c-success'>Request already sent</a>";
		// print_r($arr);

	}
	else{
	$addAsFriend = '<input type="submit" class="btn btn-sm c-success" id="add_request" name="addfriend" value="Add Classmate">';
	echo $addAsFriend;	
	}
		
	}

	
}


// removefriend
if (isset($_POST['removefriend'])) {
	$add_friend_check=$db->query("SELECT friend_array FROM users WHERE username='$user'");
	$get_friend_row=mysqli_fetch_assoc($add_friend_check);
	$friend_array=$get_friend_row['friend_array'];
	$friend_array_explode=explode(',', $friend_array);
	$friend_array_count=count($friend_array_explode);

	// friend array for user who owns profile
	$add_friend_check_username=$db->query("SELECT friend_array FROM users WHERE username='$username'");
	$get_friend_row_username=mysqli_fetch_assoc($add_friend_check_username);
	$friend_array_username=$get_friend_row_username['friend_array'];
	$friend_array_explode_username=explode(',', $friend_array_username);
	$friend_array_count_username=count($friend_array_explode_username);
	$usernameComma=",".$username;
	$usernameComma2=$username.",";
	$userComma=",".$user;
	$userComma2=$user.",";
	if (strstr($friend_array, $usernameComma)) {
		$friend1=str_replace($usernameComma, "", $friend_array);
	}
	else
		if (strstr($friend_array, $usernameComma2)) {
			$friend1=str_replace($usernameComma2, "", $friend_array);
		}
		else
			if (strstr($friend_array, $username)) {
				$friend1=str_replace($username, "", $friend_array);
			}
		
	

	if (strstr($friend_array, $userComma)) {
		$friend2=str_replace($userComma, "", $friend_array);
	}

	else
		if (strstr($friend_array, $userComma2)) {
			$friend2=str_replace($userComma2, "", $friend_array);
		}
		else
			if (strstr($friend_array, $user)) {
				$friend2=str_replace($user, "", $friend_array);
			}
		
	

	$friend2="";
	// echo $user; 
	$removeFriendQuery=$db->query("UPDATE users SET friend_array='$friend1' WHERE username='$user' ");
	$removeFriendQuery_username=$db->query("UPDATE users SET friend_array='$friend2' WHERE username='$username' ");
	echo "<script>window.open('$username','_self')</script>";
}

?>

<?php echo $errorMsg;?>


</form>

<?php 
echo "<div id='friendsProfile'>";

if ($countFriends!= 0) {
 
 foreach ($friendsArray as $key => $value) {
 $i++;
 $getFriendQuery = $db->query("SELECT * FROM users WHERE username='$value' LIMIT 1");
 $getFriendRow = mysqli_fetch_assoc($getFriendQuery);
 $friendUsername = $getFriendRow['username'];
 

 }
}

else{
	// echo  "<h5>".$fname.'&nbsp;&nbsp;'.$lname.'&nbsp;&nbsp;'."has no friend yet!</h5>"."</br>";
}
echo "</div>";
 ?>
			
<?php include 'chat.php'; ?>
	<?php if (isset($_POST['submit'])) {
			$name=$fname." ".$lname;

			$msg=$_POST['msg'];
			$insert="INSERT INTO chat(name,msg) VALUES('$name','$msg')";
			$result=$db->query($insert);
			if ($result) {
				echo "";
			}
		} ?>
		</div>
	</div>
</div>

<script type="text/javascript">
;( function( $ ) {

	$( '.swipebox' ).swipebox( {
		useCSS : true, // false will force the use of jQuery for animations
		useSVG : true, // false to force the use of png for buttons
		initialIndexOnArray : 0, // which image index to init when a array is passed
		hideCloseButtonOnMobile : false, // true will hide the close button on mobile devices
		removeBarsOnMobile : true, // false will show top bar on mobile devices
		hideBarsDelay : 3000, // delay before hiding bars on desktop
		videoMaxWidth : 1140, // videos max width
		beforeOpen: function() {}, // called before opening
		afterOpen: null, // called after opening
		afterClose: function() {}, // called after closing
		loopAtEnd: false // true will return to the first image after the last image is reached
	} );

} )( jQuery );

$(document).ready(function(){
	$('#sent_request').hide();
	$('$add_request').on('click',function(){
		$(this).hide();
		$('#sent_request').show();
	})
})

// var comments=document.getElementById('comments');

</script>
<?php include 'includes/footer.php'; ?>



 































