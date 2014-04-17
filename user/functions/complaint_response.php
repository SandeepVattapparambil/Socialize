<?php
session_start();
require("../classes/Complaint.php");
require("../classes/user.php");
$user	 = new user();
$user->id=$_SESSION['user_id'];
$user->get_user();
?>
<?php
	if(isset($_POST['complaint_id'])&&isset($_POST['response_text'])){
		if($_POST['complaint_id']!= NULL&&$_POST['response_text']!= NULL){
			$complaint_id=$_POST['complaint_id'];
            $response_text=$_POST['response_text'];
			$complaint=new Complaint();
                        $complaint->getComplaint($complaint_id);
			$complaint->addComplaintResponce($complaint_id, 'user', $user->id, $response_text);
                        //printing image
                        $blob= $user->user_image;
                        @$image = imagecreatefromstring($blob); 
                        ob_start();
                        imagejpeg($image, null, 80);
                        $data = ob_get_contents();
                        ob_end_clean();                        
                        echo '<li class="out">
                        <img src="data:image/jpg;base64,'.base64_encode($data).'" alt="assets/img/admin.jpg" class="avatar img-responsive">
                        <div class="message">
                        <span class="arrow"></span>
                        <a class="name" href="#">'.$user->fullname.'</a>
                        <span class="datetime">Just Now</span>
                        <span class="body">'.$response_text.'</span>
                        </div>
                        </li>';
		}
	}
?>