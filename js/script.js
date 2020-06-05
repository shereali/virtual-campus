$(document).ready(function(){

	$('.chat_head').click(function(){
		$('.chat_body').slideToggle('slow');
	});
	$('.msg_head').click(function(){
		$('.msg_wrap').slideToggle('slow');
	});
	
	$('.close').click(function(){
		$('.msg_box').hide();
	});
	
	$('.user').click(function(){

		$('.msg_wrap').show();
		$('.msg_box').show();
		
	});
	




    // function ajax(){
    //   var req=new XMLHttpRequest();
    //   req.onreadystatechange=function(){
    //     if (req.readyState==4 && req.status==200) {
    //       document.getElementById('chat').innerHTML=req.responseText;
    //     }
    //   }
    //   req.open('GET','send_msg.php',true);
    //   req.send();
    // }

    // setInterval(function(){ajax();},10);
  


	
});




// $(document).ready(function(){
// 	var cId=$('.coms_id').attr('id', $(this).data('cid'));
// 	var pId=$('.pos_id').attr('id', $(this).data('pid')); 
// 	$('.cms').attr('id',$(this).data('id'));
// $.ajax({
// 	type: 'POST',
// 	url: 'send_comments.php',
// 	data:{
// 		pid: $('.cms').attr('id'),
// 		c_id: $('.coms_id').attr('id'),
// 		p_id: $('.pos_id').attr('id')

// 	},
// 	success: function(response){
// 		console.log(response);
// 		if (c_id==p_id) {
// 			$('#comments').html(response);
// 		}
		
// 	}
// })	
// })