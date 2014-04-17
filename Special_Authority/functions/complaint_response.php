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
	$sa	 	= new SA();
	$sa->id	=$_SESSION['sa_user_id'];
	$sa->get_sa();
?>
<?php
	if(isset($_POST['complaint_id'])&&isset($_POST['response_text'])){
		if($_POST['complaint_id']!= NULL&&$_POST['response_text']!= NULL){
			$complaint_id=$_POST['complaint_id'];
            $response_text=$_POST['response_text'];
			$complaint=new Complaint();
            $complaint->getComplaint($complaint_id);
			$complaint->addComplaintResponce($complaint_id, 'sa', $sa->id, $response_text);
            //printing image
                        $blob= $sa->user_image;
                        @$image = imagecreatefromstring($blob); 
                        ob_start();
                        imagejpeg($image, null, 80);
                        $data = ob_get_contents();
                        ob_end_clean();                        
                        echo '<li class="out">
                        <img src="data:image/jpg;base64,'.base64_encode($data).'" alt="assets/img/admin.jpg" class="avatar img-responsive">
                        <div class="message">
                        <span class="arrow"></span>
                        <a class="name" href="#">'.$sa->sa_name.'</a>
                        <span class="datetime">just now</span><br>
                        <span class="name"> [&nbsp;'.$sa->sa_designation.'&nbsp;]</span>
                        <span class="body">'.$response_text.'</span>
                        </div>
                        </li>';
		}
		else echo 'error occured';
	}
	else echo 'error occured';
?>