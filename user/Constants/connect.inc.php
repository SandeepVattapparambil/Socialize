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

	
	
	





?>