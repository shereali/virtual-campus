<?php include 'core/dbc.php';?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navigation.php'; ?>
<?php if (!isset($_SESSION["username"])) {
	header('location:sign_in.php','_self');
} ?>
<div class="container-fluid">
		<div class="row">
		<div class="col-md-12 c-success">
			<span class="glyphicon glyphicon-book" style="color:#fff !important;"></span><strong> JOURNAL ~</strong> <span>Welcome to virtual campus !</span><strong> ~</strong>
		</div>
		<div class="col-md-12" style="background: url(img/Alienate-a-Toxic-Friend-from-Your-Friend-Group-Step-7.jpg); background-size:100%; min-height: 850px;"><br>

		
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
				 $getFriendQuery = $db->query("SELECT * FROM users WHERE username='$value'");
				 while($getFriendRow = mysqli_fetch_assoc($getFriendQuery)):
				 	?>
				 <div class="col-md-4">
					<div class="media custom-shadow">
					  <div class="media-left">

				 <?php
				 $friendUsername = $getFriendRow['username'];
				 $friendfname = $getFriendRow['fname'];
				 $friendlname = $getFriendRow['lname'];
				 $friendsProfile = $getFriendRow['profile_picture'];
				 // var_dump($friendsProfile);

				 //if ($friendsProfile==""):?>
				 <?php if (empty($friendsProfile)): ?>
				 	<?php else: ?>
				 		<a href='<?=$friendUsername;?>'><img style='width:100px; height:100px;' src='./images/<?=$friendsProfile;?>'  alt='<?=$friendUsername."'s Profile!;"?> title='<?=$friendUsername."'s Profile!";?>'> 
				 	</a>
				 <?php endif ?>
					
				 	</div>
				 	<div class="media-body">
					    <strong class="media-heading" ><a href="<?=$friendUsername;?>"><?=$friendfname;?> <?=$friendlname; ?></a></strong>
				 	

				 <?php //endif;?>
				 <?php 
				 $getposts =$db->query("SELECT * FROM posts WHERE user_posted_to = '$value' AND importance=1 ORDER BY id DESC ") or die(mysqli_error());
						while ($row = mysqli_fetch_assoc($getposts)):
							$id = $row['id'];
							$body = $row['body'];
							$date_added = $row['date_added'];
							
							$added_by = $row['added_by'];
							$user_posted_to = $row['user_posted_to'];
							$importance=$row['importance'];
							?>

							<hr><p><small>~<?=pretty_date($date_added);?></small></p>
							<div class="collapse" id="<?=$id;?>">
							  <div class="well">

							    
														<p><?php echo $body; ?></p>
							  </div>
							</div>
							
						<p><a class="SeeMore2" role="button" data-toggle="collapse" href="#<?=$id;?>" aria-expanded="false" aria-controls="<?=$id;?>">Show More</a>	
						<?php endwhile; ?></p><hr>
					 </div>
					</div>
			</div>
			<?php endwhile; ?>	
				 <?php 	endforeach; ?>
				

				<?php else:?>
					
				<?php endif;?>
		</div>
		</div>
	</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('.SeeMore2').click(function(){
    var $this = $(this);
    $this.toggleClass('SeeMore2');
    if($this.hasClass('SeeMore2')){
        $this.text('Show More');
    } else {
        $this.text('Show Less');
    }
});
	})
</script>
<?php include 'includes/footer.php'; ?>


    