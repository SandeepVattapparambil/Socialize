
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
require("../classes/ca.php");
$ca	 = new ca();
session_start();
if(isset($_SESSION['ca_user_id'])){
	$ca->get_ca($_SESSION['ca_user_id']);
}else{
	header('location:../index.php?session_ends');
}

//reading form values
if(	isset($_POST['name'])		&&
	isset($_POST['mobile'])		&&
	isset($_POST['email']))	 {		
	
    $name = htmlentities($_POST['name']);
    $mobile 	= htmlentities($_POST['mobile']);
    $email 	= htmlentities($_POST['email']);
	      
	if(!empty($name)&&!empty($mobile)&&!empty($email)) {		
		if($ca->edit_ca($name,$mobile,$email))
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
