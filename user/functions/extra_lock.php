<?php
	session_start();
	require("../Constants/connect.inc.php");
	if(	isset($_SESSION['user_id']) and $_SESSION['user_id']!= NULL){
		if( isset($_POST['password']) and $_POST['password']!= NULL ){
			$password=htmlentities($_POST['password']);
			$query="SELECT  `password`,`password_salt` FROM `users` WHERE `id` = '".$_SESSION['user_id']."'";
			if($result=execute_query($query)and !empty($result)){
				$password_salt=$result[0]['password_salt'];
				$password=md5($password.$password_salt);
				if($password==$result[0]['password']){	
					$_SESSION['locked']=false;
					header('location: ../home_user.php');					
				}
				else  {
					$_SESSION['msg']=2; 
					header('location: ../extra_lock.php');
				}
			}
			else  {
				$_SESSION['msg']=2; 
				header('location: ../extra_lock.php');
			}
		}
		else  {
			$_SESSION['msg']=2; 
			header('location: ../extra_lock.php');
		}
	}
	else  {
		$_SESSION['msg']=3;
		header('location: ../index.php');
	}
?>
		