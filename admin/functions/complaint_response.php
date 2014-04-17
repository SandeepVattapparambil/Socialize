<?php
session_start();
require("../classes/Complaint.php");
require("../classes/Admin.php");
$admin	 = new Admin();
$admin->id=$_SESSION['admin_user_id'];
$admin->get_admin();
?>
<?php
	if(isset($_POST['complaint_id'])&&isset($_POST['response_text'])){
		if($_POST['complaint_id']!= NULL&&$_POST['response_text']!= NULL){
			$complaint_id=$_POST['complaint_id'];
                        $response_text=$_POST['response_text'];
			$complaint=new Complaint();
                        $complaint->getComplaint($complaint_id);
			$complaint->addComplaintResponce($complaint_id, 'admin', $admin->id, $response_text);
                        //printing image
                        $blob= $admin->user_image;
                        @$image = imagecreatefromstring($blob); 
                        ob_start();
                        imagejpeg($image, null, 80);
                        $data = ob_get_contents();
                        ob_end_clean();                        
                        echo '<li class="out">
                        <img src="data:image/jpg;base64,'.base64_encode($data).'" alt="assets/img/admin.jpg" class="avatar img-responsive">
                        <div class="message">
                        <span class="arrow"></span>
                        <span class="name">'.$admin->fullname.'</span>
                        <span class="datetime">just now</span>
                        <span class="body">'.$response_text.'</span>
                        </div>
                        </li>';
		}
	}
?>