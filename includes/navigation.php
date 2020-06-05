<!-- this is navigation area start	 -->
<script type="text/javascript">
$(document).ready(function(){
  $('#search_text').keyup(function(){
    var search_text=document.getElementById('search_text');
    var txt=$(this).val();
    
    if (txt=='' ) {
      $('#result').html('');
    }
    else{
      $('#result').html('');
      $.ajax({
        url:'search.php',
        method:'post',
        data:{search:txt},
        success:function(data){
          $('#result').html(data);
        }
      })

    }
  })

})
  
</script>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand text-center" href="index.php" style="font-family: 'Patrick Hand', cursive;">VIRTUAL CAMPUS</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        
      </ul>
      <?php if (isset($_SESSION['username'])): ?>
       <div class="col-lg-6 form-fix">
          <div class="input-group">
            <input type="text" id="search_text" name="search" class="form-control custom-primary-bg custom-form-border" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default custom-primary-bg custom-form-border" type="button"><span class="glyphicon-glyphicon-search">Search</span></button>
            </span>
           
          </div><!-- /input-group -->   
        </div><!-- /.col-lg-6 -->
      <?php endif; ?>
      <ul class="nav navbar-nav navbar-right">
      <?php if (isset($_SESSION['username'])): ?>
        <?php 
        $select_post=" SELECT profile_picture FROM users WHERE username='$username'  ";
        $run_post=$db->query($select_post);
        while($row = mysqli_fetch_array($run_post)):
        extract($row);
           $post_image=$row['profile_picture'];
        ?>
        <li class="active"><a href="<?=$user;?>" style="padding:4.5px !important;"><img src="./images/<?php echo $row['profile_picture'];?>" style="width:40px;height:40px;" alt=""> <span class="sr-only">(current)</span></a></li>
      <?php endwhile; ?>
        <li><a href="<?=$user;?>"><span style="color:#fff !important;" class="glyphicon glyphicon-"></span> <?=$fname;?> <?=$lname;?></a></li>
        <li><a href="friend_request.php"><span style="color:#fff !important;" class="glyphicon glyphicon-user"></span></a></li>
        <li><a href="home.php"><span style="color:#fff !important;" class="glyphicon glyphicon-home"></span></a></li>
       <!--  <li><a href="#"><span style="color:#fff !important;" class="glyphicon glyphicon-envelope"></span><?php //if (isset($message)): ?>
          <span style="color:red;">1</span>
        <?php //endif ?></a></li> -->
        <li><a href="virtual_box.php"><span style="color:#fff !important;" class="glyphicon glyphicon-cloud-upload"></span></a></li>
        
        <li class="dropdown">

          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=$username;?>" style="margin:10px;"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
            <li><a href="settings.php"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
            <li><a href="friend_request.php"><span class="glyphicon glyphicon-book"></span> Friend Request</a></li>
            <!-- <li><a href="customer/index.php?myorder"><span class="glyphicon glyphicon-question-sign"></span> FQA</a></li>
            <li><a href="customer/index.php?myorder"><span class="glyphicon glyphicon-send"></span> Submit Query</a></li>
            <li><a href="customer/index.php?myorder"><span class="glyphicon glyphicon-exclamation-sign"></span> Help</a></li> -->
            <li role="separator" class="divider"></li>
            <li><a href="sign_out.php"><span class="glyphicon glyphicon-off"></span> Sign Out</a></li>
          </ul>
        </li>

        
        
      <?php else: ?>
        <li><a href="sign_up.php"><span style="color:#fff !important;"></span></a></li>
        <li><a href="sign_in.php"><span style="color:#fff !important;"></span></a></li>
      <?php endif; ?>
      </ul>
      
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!-- Navigation end here -->
 <div id="result" style="z-index: 1;position: absolute;" class="col-md-5 col-md-offset-2"></div>
