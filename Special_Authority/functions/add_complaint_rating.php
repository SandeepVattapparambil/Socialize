<?php
//print_r($_GET); die();
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

  	if(isset($_GET['from']) and !empty($_GET['from'])){
		$to=$_GET['from'];
	}else{
		$to='index.php';
	}
	
	if( isset($_GET['complaint_id']) and 
		isset($_GET['type']) ){
			
		$complaint_id 	 = $_GET['complaint_id'];
		$type		 	 = $_GET['type'];
		
		if( !empty($complaint_id)  /*and	!empty($type) */){
			$complaint=new Complaint();
			$complaint->getComplaint($complaint_id);
			$result=$complaint->addComplaintRating($user->id,$type);
			if($result){	
				$_SESSION['msg']='cmp-0';
				header("location: ../$to?1");						
			}else{
					$_SESSION['msg']='cmp-1';
					header("location:../$to?2");
			}
				
		}else{
			$_SESSION['msg']='cmp-2';
			header("location:../$to?3");
		}
	}else{
		$_SESSION['msg']='cmp-3';
		header("location:../$to?4");
	}
	
	/*$file_name="../images/Icon-user.jpg";	
	$user->set_user_image(get_image_from_file($file_name));
	$user->add_user_image();
	header("location: ../index.php");	*/	
	
?>