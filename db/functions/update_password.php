<?php 

//reading session variable
require("../classes/mla.php");
$admin= new Admin();
session_start();
if(isset($_SESSION['database_admin'])){
	$admin->get_admin($_SESSION['database_admin']);
}else{
	header('location:../index.php?session_ends');
}

//reading form values
if(	isset($_POST['current_password'])  	&& 
	isset($_POST['new_password']))	 {		
	
    $current_password 	= htmlentities($_POST['current_password']);
    $new_password 	= htmlentities($_POST['new_password']);
	      
	if(!empty($current_password)&&!empty($new_password)) {		
		if($admin->update_password($current_password,$new_password))
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
