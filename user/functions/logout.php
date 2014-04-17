<?php
require("../Constants/connect.inc.php");
session_start();
if(isset($_SESSION['session_id'])){
	$session_id=$_SESSION['session_id'];
}else{
	session_destroy();
	header('location:../index.php');
}



$query="UPDATE `loged_users` SET `logout`=1 WHERE `id`=".$session_id;
execute_update($query);
session_destroy();
header('location:../index.php');
?>