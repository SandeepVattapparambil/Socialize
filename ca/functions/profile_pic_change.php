<?php 


//reading sessinon variable
require("../classes/ca.php");
$user= new User();
session_start();
if(isset($_SESSION['ca_user_id'])){
	$user->get_user($_SESSION['ca_user_id']);
}else{
	header('location:index.php?session_ends');
}

//uploading image
if (isset($_FILES['profile_pic'])){
	if($_FILES['profile_pic']['error']==0){
		$profile_pic= move_profile_pic();	
		if (!empty($profile_pic) and $profile_pic){
			$handle=fopen($profile_pic,'r');
			$image_file=fread($handle,filesize($profile_pic));			
			if(@imagecreatefromstring($image_file)){
				$image_file=addslashes($image_file);
				$user->user_image=$image_file;
				if ($user->add_user_image()){
					header("location:../home_user.php");
				}else{
					$_SESSION['msg']='error1';
				}							
			}else{
				$_SESSION['msg']='error2';
			}
			unlink($profile_pic);
		}else{
			//$_SESSION['msg']='error3';
		}
	}else{
		$_SESSION['msg']='error4';
	}
}else{
	$_SESSION['msg']='error5';
}

header("location:../home_user.php");



//checking file size
function file_size_check(){
	$max_size=131072;//128k//65536;//64kb
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
		if(!move_uploaded_file($temp_file_name,$file_name)){
			$_SESSION['msg']='error3_1';
			return false;
		}
		return $file_name;
	}else{
		$_SESSION['msg']='error3_2';
		return false;
	}
	}else{
		$_SESSION['msg']='error3_3';
		return false;
	}
}
?>
