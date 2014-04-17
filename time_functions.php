<?php
function time_gap($time_stamp){
	$difference_string='';
	$diff=time()+19800-strtotime($time_stamp);
	$diff_years   = floor($diff / (365*60*60*24));
	$diff_monthes  = floor(($diff - $diff_years * 365*60*60*24) / (30*60*60*24));
	$diff_days    = floor(($diff - $diff_years * 365*60*60*24 - $diff_monthes*30*60*60*24)/ (60*60*24));
	$diff_hours   = floor(($diff - $diff_years * 365*60*60*24 - $diff_monthes*30*60*60*24 - $diff_days*60*60*24)/ (60*60));
	$diff_minutes  = floor(($diff - $diff_years * 365*60*60*24 - $diff_monthes*30*60*60*24 - $diff_days*60*60*24 - $diff_hours*60*60)/ 60);
	if($diff_years!=0)	 	  { 
			if($diff_years==1)$difference_string = $diff_years .'year ';
			else $difference_string = $diff_years .'years ';	}
	else if($diff_monthes!=0) { 
			if($diff_monthes==1) $difference_string = $diff_monthes .'month ';
			else $difference_string = $diff_monthes. ' months '; }
	else if($diff_days!=0)	  { 
			if($diff_days==1) $difference_string = $diff_days. ' day ';
			else $difference_string = $diff_days. ' days '; }
	else if($diff_hours!=0)	  { 
			if($diff_hours==1) $difference_string = $diff_hours. ' hour ';
			else $difference_string = $diff_hours. ' hours '; }
	else if($diff_minutes!=0) { 
			if($diff_minutes==1) $difference_string = $diff_minutes. ' minute '; 
			else $difference_string = $diff_minutes. ' minutes'; }
	if($diff_years==0 and $diff_monthes==0 and $diff_days==0 and $diff_hours==0 and $diff_minutes==0) 
	{ $difference_string='just now'; }
	else $difference_string=$difference_string. '  &nbsp;ago';
	return $difference_string;
}

//echo time_gap(time()-3000);
?>