<?php
require("../classes/Complaint.php");
require("../classes/Admin.php");
	session_start();
	if ((isset($_SESSION['admin_user_id']) and $_SESSION['admin_user_id']!= NULL)){
		$admin	 = new Admin();
                $admin->id=$_SESSION['admin_user_id'];
                $admin->get_admin();	
	}	
?>
<?php
	if(isset($_POST['complaint_id']) && isset($_POST['fw_pos']) && isset($_POST['fw_id'])){
		if($_POST['complaint_id']!= NULL and $_POST['fw_pos']!= NULL and $_POST['fw_id']!= NULL){
			$comp_id=$_POST['complaint_id'];
                        $fw_pos=$_POST['fw_pos'];
                        $fw_id=$_POST['fw_id'];
			$complaint=new Complaint();
			$complaint->getComplaint($comp_id);
			$complaint->forwardComplaint($admin->id, $fw_pos, $fw_id);
		}
	}
?>