<?php
	require("../classes/ca.php");
	require("../classes/Complaint.php");
	session_start();
	if (!(	isset($_SESSION['ca_user_id']) and $_SESSION['ca_user_id']!= NULL)){
		header('location: index.php');	
	}	
	
	if (isset($_SESSION['ca_locked']) and $_SESSION['ca_locked']){
		header('location: extra_lock.php');	
	}
	$ca	 = new ca();
	$ca->id=$_SESSION['ca_user_id'];
	$ca->get_ca();
?>
<?php
	if(isset($_POST['complaint_id'])&&isset($_POST['response_text'])){
		if($_POST['complaint_id']!= NULL&&$_POST['response_text']!= NULL){
			$complaint_id=$_POST['complaint_id'];
            $response_text=$_POST['response_text'];
			$complaint=new Complaint();
            $complaint->getComplaint($complaint_id);
			$complaint->addComplaintResponce($complaint_id, 'ca', $ca->id, $response_text);
            //printing image
                        $blob= $ca->user_image;
                        @$image = imagecreatefromstring($blob); 
                        ob_start();
                        imagejpeg($image, null, 80);
                        $data = ob_get_contents();
                        ob_end_clean();                        
                        echo '<li class="out">
                        <img src="data:image/jpg;base64,'.base64_encode($data).'" alt="assets/img/admin.jpg" class="avatar img-responsive">
                        <div class="message">
                        <span class="arrow"></span>
                        <a class="name" href="#">'.$ca->ca_name.'</a>
                        <span class="datetime">Just Now</span>
                        <span class="body">'.$response_text.'</span>
                        </div>
                        </li>';
		}
		else echo 'error occured';
	}
	else echo 'error occured';
?>