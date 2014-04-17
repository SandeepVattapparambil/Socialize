<?php
require("connect.inc.php");
$res=execute_query("SELECT `user_name` ,`id` FROM `users`");
$flag=1;
$c=0;
foreach($res as $element){
	$usr_name=strtolower($element['user_name']);
	$usr_name=str_replace(' ','',$usr_name);
	if(execute_update("UPDATE `users` SET `user_name`='".$usr_name."' WHERE `id`=".$element['id']))$c++;
	else $flag=0;
}
echo "$c   ..... $flag ";
/*$file_name='G:\images\403823_140853336027214_100003076462427_206332_229703008_n.jpg';
$handle=fopen($file_name,'r');
$image_file=fread($handle,filesize($file_name));
execute_update("UPDATE `news_and_events` SET `image`='".addslashes($image_file)."' WHERE `id`=3");
	
$i=5;
$image_db=execute_query("SELECT * FROM `news_and_events` where `id`=$i");
$i=0;
while($blob= @$image_db[$i]['image']){
	$i++;
	$image = imagecreatefromstring($blob); 
	ob_start(); 
	imagejpeg($image, null, 80);
	$data = ob_get_contents();
	ob_end_clean();
	echo '<img width="100%" src="data:image/jpg;base64,' .  base64_encode($data)  . '" />';
}
*/?>


<?php 
//tacking image and first name and last name


/*require("connect.inc.php");
$result=execute_query("SELECT `first_name`,`last_name`,`user_image` FROM `users`");
echo '<table>';
foreach($result as $user){
	echo '<tr><td>';
	echo $user['first_name'] .' '.$user['last_name'];
	echo '</td><td>';
	$blob= $user['user_image'];
	$image = imagecreatefromstring($blob); 
	ob_start(); 
	imagejpeg($image, null, 80);
	$data = ob_get_contents();
	ob_end_clean();
	echo '<img src="data:image/jpg;base64,' .  base64_encode($data)  . '" />';
	echo'</td></tr>';
}
echo '</table>';*/
?>
<?php //password hashing
/*$password='123456';
$dummy='password';
echo md5(md5($password.$dummy).$password.$dummy);*/
?>
<?php
//time printing
//echo date('D,d/M/Y  h:i:s  a'  ,time()+19800);
?>
<?php
//printing image from db
/*require("connect.inc.php");

echo "<hr>";
echo $_COOKIE['user_name'];
echo "<hr>";
setcookie('user_name','sakkeer_hussain',time()+3600);
if($result=mysql_query('SELECT `user_image` FROM `users` WHERE `id`=1')){
	$array=mysql_fetch_assoc($result);
	$blob= $array['user_image'];
	$image = imagecreatefromstring($blob); 
	ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
	imagejpeg($image, null, 80);
	$data = ob_get_contents();
	ob_end_clean();
	echo '<img src="data:image/jpg;base64,' .  base64_encode($data)  . '" />';
}*/
?>

<?php
//uploading image
/*
echo'<br>';
print_r ($_FILES);
echo '<hr>';
$name='rafeeque.jpg';
if(isset($_FILES['file'])){
	$name =$_FILES['file'] ['name'] ;
	$tmp =$_FILES['file']['tmp_name'];
	echo '<hr>';
	if(move_uploaded_file($tmp,$name)) echo 'uploaded';
	else echo 'upload failed';
}
$extenslon=strtolower($name);
while(strpos($extenslon,'.')){
	$extenslon = substr ($extenslon, strpos($extenslon,'.') + 1);
}
echo '<br>'.$extenslon;*/
?>
<!--<form action="abc.php" method="POST" enctype="multipart/form-data">
<input type="file" multiple="multiple" name = "file" /><br /><br />
<input type="submit" value="Submit">
</form>-->
<?php //echo '<hr>'; ?>
<!--<img src="<?php echo $name ?>" draggable="true" height="60" width="80" onclick="on_click()"/>-->
