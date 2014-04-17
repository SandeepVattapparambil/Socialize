
<?php 
/*
msg 1  => missing fields
msg 2  => empty fields
msg 3  => invalid image
msg 40 => upload faild
msg 41 => file size limit exeeded
msg 42 => unsupported format
msg 5  => error in file upload
msg 6  => image file missing

*/
//reading sessinon variable
require("../classes/User.php");
$user= new User();
session_start();
if(isset($_SESSION['user_id'])){
	$user->get_user($_SESSION['user_id']);
}else{
	header('location:../index.php?session_ends');
}

//uploading image
if (isset($_FILES['profile_pic'])){
	if($_FILES['profile_pic']['error']==0){
		$profile_pic= move_profile_pic();	
		if (!empty($profile_pic) and $profile_pic!=40 and $profile_pic!=41 and $profile_pic!=42 ){
			$handle=fopen($profile_pic,'r');
			$image_file=fread($handle,filesize($profile_pic));			
			if(@imagecreatefromstring($image_file)){
				$image_file=addslashes($image_file);
			}else {$image_file=0; $msg=3;}
		}else {$image_file=0; $msg=$profile_pic;}
	}else {$image_file=0; $msg=5;}
}else {$image_file=0; $msg=6;}
if($image_file==0){
	$error="msg=".$msg; 
}else{
	$error="";
	}
//reading other form values
if(	isset($_POST['name'])		&&
	isset($_POST['gender'])		&&
	isset($_POST['address']) 	&& 
	isset($_POST['mobile']))	 {		
	
    $name = htmlentities($_POST['name']);
    $address 	= htmlentities($_POST['address']);
    $mob_no 	= htmlentities($_POST['mobile']);
    $gender 	= htmlentities($_POST['gender']);
	      
	if(!empty($name)&&!empty($address)&&!empty($mob_no)&&!empty($gender)) {		
		$user->edit_user($name,$address,$gender,$mob_no,$image_file);
		if(!$image_file==0)unlink($profile_pic);
		if($msg!=6 and $msg!=5)$_SESSION['msg']=$msg;
		header("location:../home_user.php?$error");
	}else {//missing form values
		$_SESSION['msg']=1;
		header("location:../account_settings.php?msg = 1");           
    }
} else {//missing form fields
	$_SESSION['msg']=2;
	header("location:../account_settings.php?msg = 2");
}

//checking file size
function file_size_check(){
	$max_size=215040;//210 kb//65536;//64kb
	$size=$_FILES['profile_pic']['size'];
	if($size<=$max_size){
		return true; 
	}else{
		return false; 		
	}
}

//checking file type
function file_type_check(){
	$extension = strtolower($_FILES['profile_pic']['name']);
	while(strpos($extension,'.')){
		$extension = substr ($extension, strpos($extension,'.') + 1);
	}
	$type = strtolower($_FILES['profile_pic']['type']);
	if (($extension == 'jpg' || $extension == 'jpeg') && $type== 'image/jpeg'){
	return true;
	}else{
		return false;
	}
}

//uploading profile picture
function move_profile_pic(){
	if(file_size_check()){
		if(file_type_check()){
			$dir='';
			do{		
			$file_name=$dir.'profile_pics/'.rand(100,999).$_FILES['profile_pic']['name'];
			$temp_file_name=$_FILES['profile_pic']['tmp_name'];
			}while(file_exists($file_name));
			if(@!move_uploaded_file($temp_file_name,$file_name)){
				$file_name=40;
				//header('location:../account_settings.php?msg = 3');
			}
			return $file_name;
		}else{
			return 42;
			//header('location:../account_settings.php?msg = 4 &image type should be jpg/jpeg ');
		}
	}else{
		return 41;
		//header('location:../account_settings.php?msg = 4 &image size should be leass than 64k');die("gfgjfj");
	}
}
?>
