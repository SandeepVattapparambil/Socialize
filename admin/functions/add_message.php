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
    require("../classes/Message.php");
    $admin= new Admin();
    session_start();
    if(isset($_SESSION['admin_user_id'])){
            $admin->get_admin($_SESSION['admin_user_id']);
    }else{
            header('location:../index.php?session_ends');
    }

    $title=$_POST['title'];
    $message=$_POST['message'];
   
    
    //uploading image
    $img=upload_msg_and_image('image');
    
    if($img==41)
        header("location: ../messager.php?add_msg=2"); //image size exceeded
    else if($img==42)
        header("location: ../messager.php?add_msg=3"); //image format error
    else if($img==5||$img==6)
        header("location: ../messager.php?add_msg=4"); //image upload failed
    else
        header("location: ../messager.php?add_msg=1"); //success
    
    function upload_msg_and_image($fn){
    $msg=0;
    global $admin;
    global $title;
    global $message;
    if (isset($_FILES[$fn])){
            if($_FILES[$fn]['error']==0){
                    $image= move_msg_image($fn);	
                    if (!empty($image) and $image!=40 and $image!=41 and $image!=42 ){
                            $handle=fopen($image,'r');
                            $image_file=fread($handle,filesize($image));			
                            if(@imagecreatefromstring($image_file)){
                                    $image_file=addslashes($image_file);
                                    Message::addMessage($admin->id, $message, $title, $image_file);
                                    fclose($handle);
                                    unlink($image);
                            }else {$image_file=0; $msg=3;}
                    }else {$image_file=0; $msg=$image;}
            }else {$image_file=0; $msg=5;}
    }else {$image_file=0; $msg=6;}
    return $msg;
    }
            
    //checking file size
    function file_size_check($fn){
            $max_size=1048576;//210 kb//65536;//64kb
            $size=$_FILES[$fn]['size'];
            if($size<=$max_size){
                    return true; 
            }else{
                    return false; 		
            }
    }

    //checking file type
    function file_type_check($fn){
            $extension = strtolower($_FILES[$fn]['name']);
            while(strpos($extension,'.')){
                    $extension = substr ($extension, strpos($extension,'.') + 1);
            }
            $type = strtolower($_FILES[$fn]['type']);
            if (($extension == 'jpg' || $extension == 'jpeg') && $type== 'image/jpeg'){
            return true;
            }else{
                    return false;
            }
    }            
            
            //uploading wall image
    function move_msg_image($fn){
            if(file_size_check($fn)){
                    if(file_type_check($fn)){
                            $dir='';
                            do{		
                            $file_name=$dir.'wall_images/'.rand(100,999).$_FILES[$fn]['name'];
                            $temp_file_name=$_FILES[$fn]['tmp_name'];
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
