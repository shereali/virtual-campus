<?php function display_errors($errors){

	$display='<br>'.'<ul class="bg-danger">';
	foreach($errors as $error){
		$display .='<li class="text-danger">'.$error.'</li>';
	}

	$display .='</ul>';

	return $display;
}



function sanitize($dirty){
	return htmlentities($dirty,ENT_QUOTES,"UTF-8");
}


function money($number){
return '$'.number_format($number,2);
}

function login($user_id){
	$_SESSION['username'] = $user_id;
	global $db;
	$date= date("Y-m-d H:i:s");
	$db->query("UPDATE users SET last_login='$date' WHERE id = '$user_id' ");
	$_SESSION['success_flash'] = 'Your are now logged in!';
	echo "<script>window.open('index.php','_self');</script>";
}


function is_logged_in(){
	if (isset($_SESSION['username']) && $_SESSION['username'] > 0) {
		return true;
		
	}

	return false;
}

function login_error_redirect($url='sign_in.php'){
	$_SESSION['error_flash']='You must to be logged in to access that page';
	header('location:'.$url);
}

function permission_error_redirect($url='sign_in.php'){
	$_SESSION['error_flash']='You do not have permission to access that page';
	header('location:'.$url);
}

function has_permission($permission='admin'){
global $user_data;
$permissions=explode(',', $user_data['permissions']);
if (in_array($permission, $permissions, true)) {
	
	return true;
}

return false;
}


function pretty_date($date){
	return date("M d, Y h:i A", strtotime($date));
}


date_default_timezone_set('Asia/Dhaka');
$time_elapsed = timeAgo($time_ago); //The argument $time_ago is in timestamp (Y-m-d H:i:s)format.

//Function definition

function timeAgo($time_ago) {
    $time_ago =  strtotime($time_ago) ? strtotime($time_ago) : $time_ago;
    $time  = time() - $time_ago;

switch($time):
// seconds
case $time <= 60;
return  $time++ . 'Seconds ago';
// minutes
case $time >= 60 && $time < 3600;
return (round($time/60) == 1) ? 'a minute' : round($time/60).' minutes ago';
// hours
case $time >= 3600 && $time < 86400;
return (round($time/3600) == 1) ? 'a hour ago' : round($time/3600).' hours ago';
// days
case $time >= 86400 && $time < 604800;
return (round($time/86400) == 1) ? 'a day ago' : round($time/86400).' days ago';
// weeks
case $time >= 604800 && $time < 2600640;
return (round($time/604800) == 1) ? 'a week ago' : round($time/604800).' weeks ago';
// months
case $time >= 2600640 && $time < 31207680;
return (round($time/2600640) == 1) ? 'a month ago' : round($time/2600640).' months ago';
// years
case $time >= 31207680;
return (round($time/31207680) == 1) ? 'a year ago' : round($time/31207680).' years ago' ;

endswitch;
}

 ?>