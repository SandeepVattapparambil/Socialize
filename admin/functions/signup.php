<?php
	require("../classes/User.php");
	session_start();
	if(isset($_SESSION['admin_user_id'])){
		header('location:home_user.php');
	}

  	
	
	//checking form values are present or not
	if( isset($_POST['fullname']) and
		isset($_POST['email']) and
		isset($_POST['voterid']) and
		isset($_POST['password']) 	 ){
			
			$fullname 	= htmlentities($_POST['fullname']);
			$email 		= htmlentities($_POST['email']);
			$voterid	= htmlentities($_POST['voterid']);
			$password 	= htmlentities($_POST['password']);
		
			
			if( !empty($fullname) and
				!empty($email) and
				!empty($voterid ) and
				!empty($password)  ){
				
									
					$user=new User();
					$result=$user->add_user($email,$fullname,$voterid,$password);
					if($result){	
						$_SESSION['admin_user_id']=$user->id;
						sendmail($email,$first_name.' '.$last_name,$key);					
						sendmsg($mobile_no,$first_name.' '.$last_name,$key);
						header('location: ../index.php?usr='.$email.'&pwd='.$password);						
								
				}else{
					header('location:../index.php#register-btn?error 2 '.$error_code);
				}
				
			}else{
				header('location:../index.php#register-btn?error 3'. $error_code);
			}
		
	}else{
		header('location:../index.php#register-btn?error 4'. $error_code);
	}
	
	/*$file_name="../images/Icon-user.jpg";	
	$user->set_user_image(get_image_from_file($file_name));
	$user->add_user_image();
	header('location: ../index.php');	*/	
	
?>
<?php
//functions
function get_client_ip(){
	if(isset($_SERVER['HTTP_CLIENT_IP']))$http_cliene_ip = $_SERVER['HTTP_CLIENT_IP'];
	else $http_cliene_ip=0;
	if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))$http_x_forwarded_for = $_SERVER['HTTP_X_FORWARDED_FOR'];
	else $http_x_forwarded_for=0;
	if(isset($_SERVER ['REMOTE_ADDR']))$remote_addr = $_SERVER ['REMOTE_ADDR'];
	else $remote_addr=0;
	if (!empty($http_cliene_ip)) {
		$ip_address = $http_cliene_ip;
	}else if (!empty($http_x_forwarded_for)){
		$ip_address = $http_x_forwarded_for;
	}else {
		$ip_address = $remote_addr;
	}
	return $ip_address;
}
function sendmail($email,$name,$key){
	$subject='mla on click | user verification code';
	$text='Hi '.$name."\n".'Your mla on click  user verification key is :'. $key ."\n".
		'this mail is send to '.$name.'  if you are not suppose to receive this mail just discard this mail';
	$header='From : Team  mla-on-click <no-reply@mla-on-click.com>';
	mail($email,$subject,$text,$header); 
	
	
	
}
function sendmsg($mob,$name,$key){
	$subject='mla on click | user verification code';
	$text='Hi '.$name."\n".'Your mla on click  user verification key is :'. $key ."\n".
		'this mail is send to '.$name.'  if you are not suppose to receive this mail just discard this mail';
	$header='From : Team  mla-on-click <no-reply@mla-on-click.com>';
}
?>