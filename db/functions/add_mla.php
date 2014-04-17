<?php 
require("../Constants/connect.inc.php");
if(	//isset($_POST['id']) 		and 
	isset($_POST['mla_name'])	and
	isset($_POST['la_name']) 	and
	isset($_POST['email']) 		and 
	//isset($_POST['dob']) 		and 
	isset($_POST['gender']) 	and 
	isset($_POST['type']) 		){
if(	//!empty($_POST['id'])		and 
	!empty($_POST['mla_name']) 	and
	!empty($_POST['la_name'])and 
	!empty($_POST['email']) 	and 
	//!empty($_POST['dob']) 		and 
	!empty($_POST['gender']) 	and 
	!empty($_POST['type']) 		){
		
	//$id 		=$_POST['id']			; 
	$mla_name 	=$_POST['mla_name'] 	;
	$la_name 	=$_POST['la_name'] 		;	
	$email	 	=$_POST['email'] 		;
	//$dob 		=$_POST['dob']			; 
	$gender 	=$_POST['gender']		; 
	$type		=$_POST['type']			;
	
		if($type==="new"){
			//add new mla
		$rand_num=rand(1,5);
		$profile_pic="../assets/img/profile/".$rand_num.".jpg";
		$handle=fopen($profile_pic,'r');
		$image=fread($handle,filesize($profile_pic));		
		$image=addslashes($image);
			$password=substr(str_shuffle("abcdefghklmnpqrstuvwxyz0123456789"),0,10);
                        pass($email,$password);
                        @mail($email,"User credentials","password:  $password","");
			$password_salt=substr(str_shuffle("abcdefghklmnopqrstuvwxyz0123456789"),0,8);
			$password=md5($password.$password_salt);			
			$sql = "INSERT INTO `admin_info`(  `la_name`, `gender`, `mla_name`, `mla_email`, `password`, `password_salt`,`user_image`) VALUES ('$la_name','$gender','$mla_name','$email','$password','$password_salt','$image')";
			if(execute_update($sql)){
				$sql = "SELECT `id` FROM `admin_info` WHERE `mla_email`='$email'";
				$res=execute_query($sql);
				$id=$res[0]['id'];
				row($id,$la_name,$mla_name,$email,$gender);
			}else echo 'error';
		}else{
			//edit voter
			if(	isset($_POST['id']) and !empty($_POST['id'])){
				$id 		=$_POST['id'];
				$sql="UPDATE `admin_info` SET `la_name`='$la_name',`gender`='$gender',`mla_name`='$mla_name',`mla_email`='$email',`la_id`=$id WHERE `id`=$id";
				if(execute_update($sql)){
					row($id,$la_name,$mla_name,$email,$gender);
				}else 'error';
			}else 'error';
		}
}else echo 'error';
}else echo 'error';

function row($id,$la_name,$mla_name,$email,$gender){?>
	<tr>
   <td id="tbl_la_id"> 
      <?php echo  $id;?> 		
   </td>
   <td id="tbl_la_name"> 
      <?php echo $la_name; ?> 		
   </td>
   <td id="tbl_mla_name">
   		<?php echo $mla_name; ?>
   </td>
   <td id="tbl_mla_email">
   		<?php echo $email; ?>
   </td>
   <td id="tbl_gender" align="center">
   		<?php echo $gender; ?>
   </td>
   <td>
   		<input class="edit" type="button" value="EDIT" id="<?php echo $id; ?>"/>
   </td>
   <td>
   		<input class="remove" type="button" value="REMOVE" id="<?php echo $id; ?>"/>
   </td>
   </tr>
<?php 
}
function pass($email,$pass){
$h=fopen("password.txt",'a');
$text=$email."	\t".$pass."\n";
fwrite($h,$text);
}
?>			