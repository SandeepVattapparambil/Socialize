<?php
require("../Constants/connect.inc.php");
if(isset($_POST['id']) and !empty($_POST['id'])){
	$id=$_POST['id'];
	$sql = "DELETE FROM `special_authority` WHERE `id`=".$id;
	if(execute_update($sql)){
			echo "Succes";
		}
		else{
			echo 'Error';
		}

}else
echo 'Error';

?>