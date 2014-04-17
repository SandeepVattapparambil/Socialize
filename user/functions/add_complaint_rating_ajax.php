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

  	
	
	if( isset($_POST['complaint_id']) and 
		isset($_POST['support']) ){
			
		$complaint_id 	 = $_POST['complaint_id'];
		$type		 	 = $_POST['support'];
		
		if( !empty($complaint_id)  /*and	!empty($type) */){
			$complaint=new Complaint();
			$complaint->getComplaint($complaint_id);
			$result=$complaint->addComplaintRating($user->id,$type);
			if($result){	
				$rate=$complaint->checkComplaintRating($user->id);
				if($rate==1) {
					if($complaint->getComplaintRatingCount(1)<=1)
						echo ' You supported ';
					else
						echo 'you ,and '. ($complaint->getComplaintRatingCount(1)-1) .' others supported';
				}
				else {
					if($complaint->getComplaintRatingCount(1)<=0)
						{ echo ' No one Supported '; }
				else
							echo $complaint->getComplaintRatingCount(1) .' others Supported';
			}
							
echo '/';
					
					if($rate==0) {
						if($complaint->getComplaintRatingCount(0)<=1)
							echo ' You Opposed ';
						else
							echo ' You ,and '.($complaint->getComplaintRatingCount(0)-1) .' others Opposed';
					}
					else {
						if($complaint->getComplaintRatingCount(0)<=0)
							{ echo ' No one Opposed '; }
						else
							echo $complaint->getComplaintRatingCount(0) .' others Opposed';
					}
					

	
			}else{
					echo("error");
			}
				
		}else{
			echo("error");
		}
	}else{
		echo("error");
	}
?>