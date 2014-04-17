<?php 
require("../Constants/connect.inc.php");
if(	//isset($_POST['id']) 		and   
	isset($_POST['name'])           and
	isset($_POST['district_id']) 	and
	isset($_POST['mail_id']) 	and 
	isset($_POST['designation']) 	and 
	isset($_POST['type']) 		){
if(	//!empty($_POST['id'])		and 
	!empty($_POST['name'])          and
	!empty($_POST['district_id'])   and 
	!empty($_POST['mail_id']) 	and 
	!empty($_POST['designation']) 	and 
	!empty($_POST['type']) 		){
		
	//$id 		=$_POST['id']			; 
	$name           =$_POST['name'] 	;
	$district_id 	=$_POST['district_id'] 		;	
	$email	 	=$_POST['mail_id'] 		;
	$designation	=$_POST['designation']			; 
	$type		=$_POST['type']			;
	
		if($type==="new"){
			//add new sa
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
			$sql = "INSERT INTO `special_authority`(`district_id`, `sa_name`, `sa_designation`, `sa_mail_id`, `user_image`, `password`, `password_salt`)"
                                . " VALUES ($district_id,'$name','$designation','$email','$image','$password','$password_salt')";
			if(execute_update($sql)){
				$sql = "SELECT `id` FROM `special_authority` WHERE `sa_mail_id`='$email'";
				$res=execute_query($sql);
				$id=$res[0]['id'];
				row($id,$name,$designation,$email);
			}else echo 'error';
		}else{
			//edit voter
			if(	isset($_POST['id']) and !empty($_POST['id'])){
				$id 		=$_POST['id'];
				$sql="UPDATE `special_authority` SET `sa_name`='$name',`sa_designation`='$designation' WHERE `id`=$id";
				if(execute_update($sql)){
					row($id,$name,$designation,$email);
				}else 'error';
			}else 'error';
		}
}else echo 'error';
}else echo 'error';

function row($id,$name,$designation,$email){?>
	<tr>
   
   <td id="tbl_sl_no"> 
      	<?php echo $id;?> 		
   </td>
   <td id="tbl_name"> 
      	<?php echo $name; ?> 		
   </td>
   <td id="tbl_designation">
   		<?php echo $designation; ?>
   </td>
   <td id="tbl_mail_id">
   		<?php echo $email; ?>
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
function pass($email,$pass){
$h=fopen("sa_password.txt",'a');
$text=$email."	\t".$pass."\n";
fwrite($h,$text);
}
?>			