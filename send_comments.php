<?php include 'core/dbc.php'; 

$post_id=$_POST['posted_id'];
$posted_by=$_POST['posted_by'];
$posted_to=$_POST['posted_to'];
$comment=$_POST['comment'];

$postComment="INSERT INTO post_comments SET post_body='$comment', posted_by='$posted_by', posted_to='$posted_to', post_id='$post_id' ";
$commentQ=$db->query($postComment);





 ?>


  <?php

						$getCommetns="SELECT * FROM post_comments WHERE post_id='$post_id' ORDER BY comment_id ASC";
				    $runcomments=$db->query($getCommetns);
				    $count=mysqli_num_rows($runcomments);
				   while($rowC=mysqli_fetch_assoc($runcomments)):
				   		extract($rowC);
				   		 // echo "(". $count++.")";
				   		
				    	?>
				    	
				    	<?php if ($count!=0): ?>
				    		<?php $commenterProfile="SELECT * FROM users WHERE username='$posted_by' LIMIT 100";
				    		$runCp=$db->query($commenterProfile);
				    		$rowCp=mysqli_fetch_assoc($runCp); ?>

				    		<br>
				    		<div class="media-left">
						    
						      <img class="media-object" style="width:25px;height:25px;" src="./images/<?php echo $rowCp['profile_picture'];?>" alt="image">
						   
						  </div>
						  <div class="media-body">
						    <p class="media-heading"><a href="<?=$posted_by;?>"><?=$rowCp['fname']." ".$rowCp['lname']; ?></a></p>
						    
						    <p>
						    
						    <?=$post_body; ?>
						    <?php $posted_by; ?>
						    <?php $posted_to; ?>
						    <?php $post_remove; ?>
						    	
						    </p>

							</div>
						<?php else: ?>
							<p class="text-danger">There is no comment here</p>
				    	<?php endif; ?>
				    	
						<?php endwhile; ?>

					  
						    
						

<!--  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
 tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
 quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
 consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
 cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
 proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> -->
