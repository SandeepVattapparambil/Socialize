<?Php
require("connection.php");
$conn_error = 'Could not connect.';
$mysql_host = HOST;// 'localhost';
$mysql_user = USERNAME;//,'root';
$mysql_pass = PASSWORD;//,'';
$mysql_db   = DATABASENAME;//'mla_on_click';
if(!@mysql_connect ($mysql_host, $mysql_user, $mysql_pass )||!@mysql_select_db($mysql_db)){
	die($conn_error);
}
else{
  	//echo 'connected successfully<hr>';
}
	


function execute_query($query){
	$result=array();
	if ($query_run = mysql_query ($query)) {
		$i=0;
		while ($query_row = mysql_fetch_assoc($query_run)) {
			$result[$i++]=$query_row;
		}
	} else {
	return false;
	//echo die(mysql_error());
	}
	return($result);
}	
function execute_update($query){
	if ($query_run = mysql_query ($query)) {
		return true;
	} else {
		return false;
	}	
}	

	
	
	
	
/*$echo=execute_query('SELECT `id`, `user_id`, `type`, `subject`, `complaint`, `visibility`, `date_and_time`, `image_link`, `status`, `reply_text`, `reply_imagelink`, `priority`, `trashed` FROM `complaints`');
foreach($echo as $element){
	echo '<br>';
	print_r($element);
	echo '<br>';
}*/




?>