<?php 

//reading session variable
require("../classes/SA.php");
$sa= new SA();
session_start();
if(isset($_SESSION['sa_user_id'])){
	$sa->get_sa($_SESSION['sa_user_id']);
}else{
	header('location:../index.php?session_ends');
}

//reading form values
if(	isset($_POST['current_password'])  	&& 
	isset($_POST['new_password']))	 {		
	
    $current_password 	= htmlentities($_POST['current_password']);
    $new_password 	= htmlentities($_POST['new_password']);
	      
	if(!empty($current_password)&&!empty($new_password)) {		
		if($sa->update_password($current_password,$new_password))
                {
                    $_SESSION['pass_update']=1;
                    header("location:../profile.php?pass_update=1");
                }
                else
                {
                    $_SESSION['pass_update']=0;
                    header("location:../profile.php?pass_update=0");
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
