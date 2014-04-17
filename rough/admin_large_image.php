<?php
require("connect.inc.php");
$xml = simplexml_load_file('members.xml');
$c=1;
echo '<table>';
foreach( $xml->admin as $admin){
	if($admin->limg){
		$file_name=trim($admin->limg);
	}else{
		$file_name=trim($admin->img);
	}
	$file_name=str_replace('%2520','%20',$file_name);
	$handle=fopen($file_name,'r');
	$image_file=fread($handle,filesize($file_name));
	execute_update("UPDATE `admin_info` SET `user_image`='".addslashes($image_file)."' WHERE `id`=$c)");
 	echo "<tr><td>$c  $admin->name </td>";
	$blob=$image_file;
	$image = imagecreatefromstring($blob); 
	ob_start(); 
	imagejpeg($image, null, 80);
	$data = ob_get_contents();
	ob_end_clean();
	echo '<td><img width="50" height="50" src="data:image/jpg;base64,' .  base64_encode($data)  . '" /><br></td></tr>';
	$c++;
}
echo"</table>";


function trym($query){
	$result=str_replace(" ","",$query);
	$result=str_replace("
","",$result);
	$result=str_replace("	","",$result);
	return($result);
}	
?>