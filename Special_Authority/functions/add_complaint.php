<?php

	require("../classes/SA.php");
	require("../classes/Complaint.php");
	session_start();
	if (!(	isset($_SESSION['sa_user_id']) and $_SESSION['sa_user_id']!= NULL)){
		header('location: index.php');	
	}	
	
	if (isset($_SESSION['sa_locked']) and $_SESSION['sa_locked']){
		header('location: extra_lock.php');	
	}
	$user	 = new User();
	$user->id=$_SESSION['sa_user_id'];
	$user->get_user();

  	
	
	//checking form values are present or not
	if( isset($_POST['editor']) ){
			
		//$text 	 = htmlentities($_POST['editor']);
		$text 	 = $_POST['editor'];
		
		if( !empty($text) ){
			if(isset($_POST['private'])) $private=1;
			else $private = 0;
			$complaint=new Complaint();
			$result=$complaint->addComplaint($user->id,$user->la_id,$text,$private);
			if($result){	
				$_SESSION['msg']='cmp-0';
				header('location: ../complaints.php');						
			}else{
					$_SESSION['msg']='cmp-1';
					header('location:../complaints.php?error 2 '.$error_code);
			}
				
		}else{
			$_SESSION['msg']='cmp-2';
			header('location:../complaints.php?error 3'. $error_code);
		}
	}else{
		$_SESSION['msg']='cmp-3';
		header('location:../complaints.php?error 4'. $error_code);
	}
	
	/*$file_name="../images/Icon-user.jpg";	
	$user->set_user_image(get_image_from_file($file_name));
	$user->add_user_image();
	header('location: ../index.php');	*/	
	
?>