<?php include 'core/dbc.php';?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navigation.php'; ?>
<?php include"send_post.php"; 

if (!isset($_SESSION['username'])) {
    header('location:sign_in.php');
    exit();
}
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-2"><br>
			<div class="media">
				  <div class="media-left">
				  <?php 
				  	$sql="SELECT profile_picture FROM users WHERE username='$user'";
				  	$result=$db->query($sql);
				  	while($row=$result->fetch_assoc()):
				   ?>
				
				 <img class="media-object " src="images/<?php echo $row['profile_picture']; ?>" alt="..." style="width:60px; height:60px;">
			<?php endwhile; ?>
				     
				     
				    
				  </div>
				  <div class="media-body">
				    <h5><a href="" style="color:#fff;" class="media-heading"><?=$fname;?> <?=$lname;?></a></h5>
				   
				  </div>
				</div>
				<div class="page-header"><p>My Social Connections</p></div>
				<?php 
			$select_social="SELECT * FROM social_connections WHERE username='$username' ";
			$socialQ=$db->query($select_social);
			while($socialRow=mysqli_fetch_assoc($socialQ)):
			extract($socialRow);

			endwhile; ?>
			<p><a style="color:#fff;" href="https://www.facebook.com/<?=$facebook; ?>" target="_blank" title="Visit <?php echo $username; ?>'s Facebook Profile"><span class="fa fa-facebook fa-2x"></span><span class="text-warning"></span></a></p>&nbsp;
			<p><a style="color:#fff;" href="https://www.twitter.com/<?=$twitter;?>" target="_blank" title="Visit <?php echo $username; ?>'s Twitter Profile"><span class="fa fa-twitter fa-2x"></span><span class="text-warning"> </span></a></p>&nbsp;
			<p><a style="color:#fff;" href="https://www.linkedin.com/<?=$linkedin;?>" target="_blank" title="Visit <?php echo $username; ?>'s Linkedin Profile"><span class="fa fa-linkedin fa-2x"></span><span class="text-warning"> </span></a></p>&nbsp;
			<p><a style="color:#fff;" href="https://www.https://plus.google.com/u/0/+<?=$googleplus;?>" target="_blank" title="Visit <?php echo $username; ?>'s Googl+ Profile"><span class="fa fa-google-plus fa-2x"></span><span class="text-warning"></span></a></p>&nbsp;
			<p><a style="color:#fff;" href="https://www.youtube.com/<?=$youtube;?>" target="_blank" title="Visit <?php echo $username; ?>'s Youtube Profile"><span class="fa fa-youtube fa-2x"></span><span class="text-warning"> </span></a></p>&nbsp;
			<p><a style="color:#fff;" href="https://www.github.com/<?=$github;?>" target="_blank" title="Visit <?php echo $username; ?>'s Github Profile"><span class="fa fa-github fa-2x"></span ><span class="text-warning"> </span></a></p>
		</div>
		<div class="col-md-7">
		<legend><small>Write Something you want</small></legend>
				<form action="<?=$username;?>" method="post" class="form-inline" enctype="multipart/form-data">
					<div class="form-group">
						<textarea id="post" name="post" cols="101" class="form-control" ></textarea>
					</div>
					
					<div class="form-inline">
					<input type="file" class="form-control" id="photo" name="file">
					
					<input type="submit" name="send" onclick="javascript:send_post()" value="Post" class="btn btn-success c-success" style="padding:5px 50px; margin:5px;border-radius: 3px !important;border:0px !important;">
					Make Journal <input type="checkbox" name="importance" value="1">
					</div>
				</form>
			
			

			<div class="col-md-12 thumbnail" style="min-height: 900px; background:#F2F2F2;">
				
				    <?php 
				    if (isset($_GET['del'])) {
				    	$del_id=$_GET['del'];
				    	$del="DELETE FROM posts WHERE id='$del_id' AND added_by='$username'";
				    	$runDel=$db->query($del);
				    	
				    }
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
				 	// print_r($value);
				$i++;
				    $getposts =$db->query("SELECT * FROM posts WHERE user_posted_to = '$value' OR added_by='$value' ORDER BY date_added DESC ") or die(mysqli_error());
						while ($row = mysqli_fetch_assoc($getposts)):
							$id = $row['id'];
							$body = $row['body'];
							$date_added = $row['date_added'];
							
							$added_by = $row['added_by'];
							$picture=$row['status_pic'];
							$user_posted_to = $row['user_posted_to'];
							?>
							 <?php
				 $friendUsername = $row['username'];
				 $friendfname = $row['fname'];
				 $friendlname = $row['lname'];
				 $friendsProfile = $row['profile_picture'];
				 // var_dump($friendsProfile);

				 //if ($friendsProfile==""):?>
						<div class="media">
				  <div class="media-left">
				 <?php 
				$select_post=" SELECT * FROM users WHERE username='$added_by'";
				$run_post=$db->query($select_post);
				while($rowpic = mysqli_fetch_array($run_post)):
				// extract($rowpic);
				   
				?>

				<?php
				 $friendUsername = $rowpic['username'];
				 $friendfname = $rowpic['fname'];
				 $friendlname = $rowpic['lname'];
				 $friendsProfile = $rowpic['profile_picture'];
				 // var_dump($friendsProfile);

				 //if ($friendsProfile==""):?>
				      <img class="media-object" src="./images/<?=$friendsProfile;?>" alt="..." style="width:30px; height:35px;">
				   <?php endwhile; ?>   
				    
				  </div>
				  <div class="media-body">
				  <?php if ($user_posted_to==$added_by): ?>
				  	<p class="media-heading"><a href="<?=$added_by;?>"><?=$friendfname;?> <?=$friendlname;?></a></p>
					<h6 ><small class="custom-color"><b><?=timeAgo($date_added);?></b></small><a href="profile.php?del=<?=$id;?>" class="pull-right btn btn-xs btn-default">x</a></h6>
				<?php else: ?>
					<p class="media-heading">
						<?php $nm="SELECT * FROM users WHERE username='$user_posted_to'";
					$q=$db->query($nm);
					$n=$q->fetch_object();
					?>
					<a href="<?=$added_by;?>"><?=$friendfname;?> <?=$friendlname;?></a>
					<span class="glyphicon glyphicon-play"></span>
					<a href="<?=$user_posted_to;?>"><?php echo $n->fname." ".$n->lname; ?></a>
						
					</p>
					<h6 ><smal class="custom-color"><b><?=timeAgo($date_added);?></b></smal><a href="profile.php?del=<?=$id;?>" class="pull-right btn btn-xs btn-default">x</a></h6>
				  <?php endif ?>
				    

				    <p style="font-size: 15px; font-family:'Myriad pro'"><?=$body;?></p>
				    <?php if ($picture!=0): ?>
				    	<p><img src="./post_images/<?=$picture;?>" style="height:350px; width:400px;" alt=""></p>
				    <?php endif ?>
				    
				   <div id="comment"></div>
						<span onclick="javascript:toggle<?=$id;?>()" style="color:#F93A72;cursor:pointer;" class="glyphicon glyphicon-comment"> </span>
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
				    <div class="media col-md-6" id="toggleComment<?=$id;?>" style="display: none;">
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
						    </script>	
						    <a href="profile.php?uid=<?=$username;?>"></a>
					<span id="posted_by" data-postedby="<?=$user;?>"></span>
					<span id="posted_to" data-postedto="<?=$viewUser;?>"></span>
					<span id="posted_id" data-postid="<?=$id;?>"></span>
					

					<input type="text" class="form-control" id="inputComment" placeholder="Add your comment" />
					</div>
					
					
				  </div>
				</div>
				<?php endwhile; ?>
			
		<?php endforeach; ?>
		<?php endif; ?>
			</div>
			
		</div>
			
		</div>
		
		<div class="col-md-4">
			<?php include 'chat.php'; ?>
		</div>
	</div>
</div>


<?php include 'includes/footer.php'; ?>