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
				$sql = "SELECT `id` FROM `voters_list` WHERE `id_card_no`='$id_card_no'";
				$res=execute_query($sql);
				$id=$res[0]['id'];
				row($id,$name,$id_card_no,$address,$dob,$gender);
			}else echo $sql;//'error5';
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

function row($id,$name,$id_card_no,$address,$dob,$gender){?>
	<tr>
   
   <td id="tbl_sl_no"> 
      	0 		
   </td>
   <td id="tbl_name"> 
      	<?php echo $name; ?> 		
   </td>
   <td id="tbl_id_card_no">
   		<?php echo $id_card_no; ?>
   </td>
   <td id="tbl_address">
   		<?php echo $address; ?>
   </td>
   <td id="tbl_dob"> 
      	<?php echo $dob;?> 		
   </td>
   <td id="tbl_gender">
   		<?php echo $gender; ?>
   </td>
   <td>
   		<input class="btn btn-info edit" type="button" value="EDIT" id="<?php echo $id; ?>"/>
   </td>
   <td>
   		<input class="btn btn-info remove" type="button" value="REMOVE" id="<?php echo $id; ?>"/>
   </td>
   </tr>
<?php 
}
?>			