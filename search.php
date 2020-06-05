
<?php
include 'core/dbc.php';

  $search=$_POST['search'];
 $searchSql="SELECT * FROM users WHERE username LIKE '%$serach%' OR fname LIKE '%$search%' OR lname LIKE '%$search%' OR  email LIKE '%$search%' ";
 $searchQ=$db->query($searchSql);
 while($searchR=mysqli_fetch_assoc($searchQ)):
  extract($searchR);
?>
<?php $name=strtolower($fname); ?>
<?php if ($search==$name||$search==$fname): ?>
<div id="searchfriendbox" class="custom-search-width custom-shadow" style="z-index: 1;position: absolute;">
<p><a class="custom-color" href="<?=$username?>"><img style="width:50px;height:50px;" src="./images/<?=$profile_picture;?>" alt=""> <?=$fname; ?> <?=$lname; ?></a></p>
</div>
<?php endif ?>

<?php endwhile; ?>


