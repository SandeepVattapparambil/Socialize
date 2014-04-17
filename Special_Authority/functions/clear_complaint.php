<?php
require("../classes/sa.php");
?>
<?php
	if( isset($_POST['id']) and $_POST['id']!= NULL){
			$comp_id=$_POST['id'];
			sa::clear_complaint($comp_id);
	}
?>