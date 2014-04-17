
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
//reading session variable
require("../classes/Admin.php");
$admin= new Admin();
session_start();
if(isset($_SESSION['admin_user_id'])){
	$admin->get_admin($_SESSION['admin_user_id']);
}else{
	header('location:../index.php?session_ends');
}

//reading form values
if(	isset($_POST['name'])		&&
	isset($_POST['mobile'])		&&
	isset($_POST['email'])  	&& 
	isset($_POST['address']))	 {		
	
    $name = htmlentities($_POST['name']);
    $mobile 	= htmlentities($_POST['mobile']);
    $email 	= htmlentities($_POST['email']);
    $address 	= htmlentities($_POST['address']);
	      
	if(!empty($name)&&!empty($mobile)&&!empty($email)) {		
		if($admin->edit_admin($name,$mobile,$email,$address))
                {
                    $_SESSION['profile_update']=1;
                    header("location:../profile.php?profile_update=1");
                }
	}else {//missing form values
		$_SESSION['msg']=1;
		header("location:../profile.php?msg = 1");           
    }
} else {//missing form fields
	$_SESSION['msg']=2;
	header("location:../profile.php?msg = 2");
}
?>
