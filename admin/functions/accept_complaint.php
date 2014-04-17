<?php
require("../classes/Complaint.php");
?>
<?php
	if(isset($_POST['accept']) && isset($_POST['id'])){
		if($_POST['accept']!= NULL and $_POST['id']!= NULL){
			$accept=$_POST['accept'];
			$comp_id=$_POST['id'];
			$complaint=new Complaint();
			$complaint->getComplaint($comp_id);
			if($accept==1)
				$complaint->setComplaintStatus(1);
			else if($accept==0)
				$complaint->setComplaintStatus(2);
		}
	}
?>