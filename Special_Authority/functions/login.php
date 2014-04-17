<?php
require("../classes/SA.php");
?>
<?php
	if(isset($_POST['username']) && isset($_POST['password'])){
		if($_POST['username']!= NULL and $_POST['password']!= NULL){
			$sa	 = new SA();		
			$user_name=	strtolower(htmlentities($_POST['username']));
			$password=htmlentities($_POST['password']);
			$result =$sa->sa_login($user_name,$password);
		}
	}
	if($result==0){
		session_start();		
		$_SESSION['sa_user_id']=$sa->id;
		/*$query="INSERT INTO `loged_users`(`user_id`, `ip_address`) VALUES (".$_SESSION['sa_user_id'].",'".get_client_ip()."')";
		execute_update($query);
		$result=execute_query("SELECT `id` FROM `loged_users` WHERE `user_id`=".$user->id." ORDER BY `id` DESC limit 1");
		$_SESSION['session_id']=$result[0]['id']; */
		$_SESSION['locked']=false;
		header('location: ../home.php');		
	}
	else {
		session_start();
		$_SESSION['msg']=$result; 
		header('location: ../index.php');
	}

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
?>