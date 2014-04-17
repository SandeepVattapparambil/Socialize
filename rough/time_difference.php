<?php
require ("connect.inc.php");
$result=execute_query("SELECT * FROM `complaints` WHERE `id`=30");
print_r($result);
echo '<hr>'.$result[0]['time_stamp'];
echo '<hr>current time stamp :'.time()."   ".date('h:m:s  a',time()+19800);
echo '<hr>str to time stamp  :'.strtotime($result[0]['time_stamp'])."   ".date('h:m:s  a',strtotime($result[0]['time_stamp']));
$diff=time()+19800-strtotime($result[0]['time_stamp']);
echo '<hr>diff. time stamp   :'.$diff."   ".date('h:m:s  a',$diff);
$min=floor($diff/60);
$sec =floor(($diff-60*$min));
echo $min .' mins ' .($diff-60*$min).' sec';
?>