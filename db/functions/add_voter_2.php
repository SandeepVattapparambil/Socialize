<?php

require("../Constants/connect.inc.php");
if(	isset($_POST['name']) 		and
	isset($_POST['la_id']) 		and 
	isset($_POST['id_card_no']) and 
	isset($_POST['address']) 	and 
	isset($_POST['dob']) 		and 
	isset($_POST['gender']) 	and 
	isset($_POST['type']) 		){
if(	!empty($_POST['name']) 		and
	!empty($_POST['la_id'])		and 
	!empty($_POST['id_card_no'])and 
	!empty($_POST['address']) 	and 
	!empty($_POST['dob']) 		and 
	!empty($_POST['gender']) 	and 
	!empty($_POST['type']) 		){
		
	$la_id 		=$_POST['la_id']; 
	$name 		=$_POST['name'] ;	
	$id_card_no =$_POST['id_card_no']; 
	$address 	=$_POST['address'] ;
	$dob 		=$_POST['dob']; 
	$gender 	=$_POST['gender']; 
	$type		=$_POST['type'];
	
		if($type==="new"){
			//add new votet
			$sql = "INSERT INTO `voters_list`( `la_id`, `name`, `id_card_no`, `address`, `date_of_birth`, `sex`) 
					VALUES ($la_id,'$name','$id_card_no','$address','$dob','$gender')";
			if(execute_update($sql)){
				$sql = "SELECT count(*) as count FROM `voters_list` WHERE `la_id`=$la_id";
				$res=execute_query($sql);
				$count =$res[0]['count'];
				echo $count;
			}else 'error5';
		}else{
			if(isset($_POST['id']) and !empty($_POST['id'])){
				//edit voter
				$id 		=$_POST['id'];
				$sql="UPDATE `voters_list` SET `la_id`=$la_id,`name`='$name',`id_card_no`='$id_card_no',`address`='$address',`date_of_birth`='$dob',`sex`='$gender' WHERE `id`=$id";
				if(execute_update($sql)){
					row($id,$name,$id_card_no,$address,$dob,$gender);
				}else echo 'error4';
			}else echo 'error3';
		}
}else echo 'error1';
}else echo 'error2';

?>			