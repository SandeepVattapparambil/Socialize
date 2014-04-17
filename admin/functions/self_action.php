<?php
require("../classes/Complaint.php");
?>
<?php
	if(isset($_POST['complaint_id'])){
		if($_POST['complaint_id']!= NULL){
			$complaint_id=$_POST['complaint_id'];
			$complaint=new Complaint();
                        $complaint->getComplaint($complaint_id);
			$complaint->setComplaintPosition("admin");
		}
	}
?>