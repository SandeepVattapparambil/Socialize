<?php

$profile_pic='aa.jpg';
$handle=fopen($profile_pic,'r');
$image_file=fread($handle,filesize($profile_pic));		
$image_file1=addslashes($image_file);	
$image_file2=base64_encode($image_file);
$handle=fopen($profile_pic.'1.txt','w');	
fwrite($handle,$image_file,strlen($image_file));
$handle=fopen($profile_pic.'2.txt','w');	
fwrite($handle,$image_file2,strlen($image_file2));
?>
	
<?php /*?><?    
header("Content-type: image/jpeg");
echo base64_decode($image_file);	

?><?php */?>




 <?php 
     
/*  	//$blob=base64_decode($image_file2);
	$blob=$image_file;
	$image = imagecreatefromstring($blob); 
	ob_start(); 
	imagejpeg($image, null, 80);
	$data = ob_get_contents();
	ob_end_clean();
	//echo '<img  src="data:image/jpg;base64,' .  base64_encode($data)  . '" />';
  	
  
     
              echo '<li data-thumb="data:image/jpg;base64,' .  base64_encode($data)  . '""> <img height="460" width="958" src="data:image/jpg;base64,' .  base64_encode($data)  . '"">
                     </li>';

  */
  
  
  
  
  
  
  
require("../Constants/connect.inc.php");

echo "<hr>";

execute_update("UPDATE `users` SET `user_image`= '".$image_file1."' WHERE `id`=1");
if($result=execute_query('SELECT `user_image` FROM `users` WHERE `id`=2')){
	$blob= $result[0]['user_image'];
	$image = imagecreatefromstring($blob); 
	ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
	imagejpeg($image, null, 80);
	$data = ob_get_contents();
	ob_end_clean();
	echo '<img src="data:image/jpg;base64,' .  base64_encode($data)  . '" />';
}
 ?>    