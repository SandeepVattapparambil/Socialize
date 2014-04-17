<?php
require("../classes/ca.php");
?>
<?php
	if( isset($_POST['id']) and $_POST['id']!= NULL){
			$comp_id=$_POST['id'];
			ca::clear_complaint($comp_id);
	}
?>