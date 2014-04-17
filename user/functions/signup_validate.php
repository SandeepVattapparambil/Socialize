<?php
@include_once("../Constants/connect.inc.php");

if($_POST['email'] != NULL)
{
	$email = $_POST['email'];
	$emailQuery = "SELECT * FROM `users` WHERE `email`=\"".$email."\"";
	$result1 = mysql_query($emailQuery);
	if(mysql_num_rows($result1) != 0)
		echo "1"; //duplicate email
}
	
if($_POST['voterid'] != NULL)
{	
	$voterid = $_POST['voterid'];
	$voteridQuery="SELECT * FROM `users` WHERE `voterid`=\"".$voterid."\""; 
	$result2 = mysql_query($voteridQuery);	
	if(mysql_num_rows($result2) != 0)
		echo "2"; //duplicate voter id
		
	$validVoteridQuery = "SELECT * FROM `voters_list` WHERE `id_card_no`=\"".$voterid."\"";
	$result3 = mysql_query($validVoteridQuery);	
	if(mysql_num_rows($result3) == 0 || !(preg_match("/[A-Z]{3}[0-9]{7}/",$voterid)))
		echo "3"; //invalid voter id
}
?>
