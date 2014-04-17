<?php
	require("../classes/User.php");
	require("../classes/Complaint.php");
	session_start();
	if (!(	isset($_SESSION['user_id']) and $_SESSION['user_id']!= NULL)){
		header('location: index.php');	
	}	
	
	if (isset($_SESSION['locked']) and $_SESSION['locked']){
		header('location: extra_lock.php');	
	}
	$user	 = new User();
	$user->id=$_SESSION['user_id'];
	$user->get_user();
	
	if(isset($_POST['from']) and !empty($_POST['from'])){
		$to=$_POST['from'];
	}else{
		$to='index.php';
	}
  	
	
	//checking form values are present or not
	if( isset($_POST['response']) and isset($_POST['complaint_id']) ){			
		$text 	 	= $_POST['response'];
		$cmp_id		= $_POST['complaint_id'];
		if( !empty($text) and !empty($cmp_id) ){			
			$result = Complaint::addComplaintResponce($cmp_id,'user',$user->id,$text);
			
			if($result){	
				$_SESSION['msg']='cmp-0';
				header('location: ../'.$to);						
			}else{
					$_SESSION['msg']='cmp-1';
					header('location:../'.$to.'?error 2 '.$error_code);
			}
				
		}else{
			$_SESSION['msg']='cmp-2';
			header('location:../'.$to.'?error 3'. $error_code);
		}
	}else{
		$_SESSION['msg']='cmp-3';
		header('location:../'.$to.'?error 4'. $error_code);
	}
	
	/*$file_name="../images/Icon-user.jpg";	
	$user->set_user_image(get_image_from_file($file_name));
	$user->add_user_image();
	header('location: ../index.php');	*/	
	
?>