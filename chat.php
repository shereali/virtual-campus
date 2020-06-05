<?php 
if(!isset($_SESSION["username"])){

	// $user = $_SESSION["user_login"];
$username="";

}

else{

	$username = $_SESSION["username"];
	// var_dump($username);
}
 ?>
<div class="chat_box">
	<div class="chat_head"> Chat Box</div>
	<div class="chat_body"> 
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
				 $getFriendRow = mysqli_fetch_assoc($getFriendQuery);
				 $friendUsername = $getFriendRow['username'];
				 // var_dump($friendUsername);
				 $friendfname = $getFriendRow['fname'];
				 $friendlname = $getFriendRow['lname'];
				 $friendsProfile = $getFriendRow['profile_picture'];
				 // var_dump($friendsProfile);

				 if ($friendUsername):?>
				 <div class="user">
				 	<a href='#' data-id="<?=$friendUsername;?> " style="text-decoration: none;" data-user="<?=$username;?>" data-name="<?=$friendfname;?> <?=$friendlname; ?>" class="chatUserName">
						<?php if (empty($friendsProfile)): ?>
								<?php else: ?>
				 	<img style='width:30px; height:30px;' src='./images/<?=$friendsProfile;?>'  alt='<?=$friendUsername."'s Profile!;"?> title='<?=$friendUsername."'s Profile!";?>'/> 
										 		
							<?php endif ?>	


				 	<span><?=$friendfname;?> <?=$friendlname; ?></span></a>
				 	</div>
				 <?php endif;?>
				 <?php 	endforeach; ?>
				

				<?php else:?>
					<h5 class="text-center"><?//=$fname;?> <?//=$lname; ?> Friend is not available!</h5></br></br>
				<?php endif;?>
	 
	</div>
  </div>

<div class="msg_box" id="" style="right:290px">
<span class="myusername" id=""></span>
	<div class="msg_head">
	<span class="chatName"></span>
	<div class="close">x</div>
	</div>
	<div class="msg_wrap">
		<div class="msg_body">
			
			<div class="msg_b">Start Convirsation</div>
			<div class="msg_push"></div>
		</div>
	<div class="msg_footer"><textarea class="msg_input" rows="4"></textarea></div>
</div>
</div>

<script type="text/javascript">
$(".chatUserName").on('click',function(){
var dName=$(this).data('name');
$('.chatName').html(dName);
$('.msg_box').attr("id", $(this).data('id'));
$('.myusername').attr("id", $(this).data('user'));

setInterval(function(){
$.ajax({
	url: "loadChat.php",
	type: "POST",
	data: {
		chatto: $('.msg_box').attr('id'),
		chatfrom: $('.myusername').attr('id')
	},
	success: function(response){
		// console.log(response);
		$('.msg_body').html(response);
	}

});
}, 1000);

	});


	$('.msg_input').keypress(function(e) {
    if(e.which == 13) {

        $.ajax({
        	url: 'send_msg.php',
        	type: 'POST',
        	data: {
        		chatmsg: $(this).val(),
        		chatfrom: $('.myusername').attr('id'),
        		chatto: $('.msg_box').attr('id')
        	},
        	success: function(response){
        		console.log(response);
        		$('.msg_body').append(response);

        	}
        });

        $(this).val('');
    }
});

		// $('textarea').keypress(
 //    function(e){
 //        if (e.keyCode == 13) {
 //            e.preventDefault();
 //            var msg = $(this).val();
	// 		$(this).val('');
	// 		if(msg!='')
	// 		$('<div class="msg_b">'+msg+'</div>').insertBefore('.msg_push');
	// 		$('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
 //        }
 //    });

	
</script>