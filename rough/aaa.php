<?php
$cho =trim("dff    
		vvvgdg dgdgdgdv",'\n  ');
$cho=str_replace(" ","",$cho);
$cho=str_replace("
","",$cho);
$cho=str_replace("	","",$cho);
$handle=fopen("file_name.txt","w");
$user_image=fwrite($handle,$cho,strlen($cho));





/*$file_name="Icon-user.jpg";
?>
<a href="abc.txt">
<strong>
download
</strong>
</a>
<?php 
echo '<br/>';
$handle=fopen($file_name,"r");
$user_image=fread($handle,filesize($file_name));
echo filesize($file_name).'<br/>';
if(imagecreatefromstring($user_image)){
	echo  'sdnslagn;alglak;';
}else{
	echo 'false';
}
*/
?>