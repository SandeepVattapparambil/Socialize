<?php

/**
 *
 * @author Sakkeer Hussain
 */
@include_once("../Constants/connect.inc.php");
@include_once("Constants/connect.inc.php");	
class Message {
	public $id;
    public $la_id;//int
    public $text;
	public $head;
    public $date_and_time;
	public $image;
	public function addMessage($_la_id,$_text,$_head,$_image){
        $result=false;     
        $query="INSERT INTO ";     
		if(execute_update($query)){
			$result=true;
		}
        return $result;
    }
	
	
	
    public function getMessageList($_la_id){
        $result = array(); 
		$query="SELECT `id` FROM `messages` WHERE `la_id`=$_la_id  and `delete`=0 ORDER BY `time_stamp` DESC";  
		$result_id = execute_query($query);
		$i=0;
		foreach($result_id as $element){
			$result[$i]=$element['id'];
			$i++;
		}
		return $result;
    }
	
	public static function getLatestMessageList($_user_id,$_la_id){
        $result = array(); 
		$query="SELECT `time` FROM `loged_users` WHERE `user_id`=$_user_id order by `time` desc limit 1";  
		$result = execute_query($query);
		$last_accessed_time=$result[0]['time'];
		$query="SELECT `id` FROM `messages` WHERE `la_id`=$_la_id and `delete`=0 and `time_stamp`>'$last_accessed_time' ORDER BY `time_stamp` DESC limit 4";  
		$result_id = execute_query($query);
		$i=0;
		foreach($result_id as $element){
			$result[$i]=$element['id'];
			$i++;
		}
		return $result;
    }
	
	public static function getNewMessageCount($_user_id,$_la_id){
        $query="SELECT `time` FROM `loged_users` WHERE `user_id`=$_user_id order by `time` desc limit 1";  
		$result = execute_query($query);
		if(isset($result[0])){
			$query ="SELECT count(*) as `count` FROM `messages` WHERE `time_stamp` > '".$result[0]['time']."' and `la_id`=$_la_id and `delete`=0 ";		
			$result = execute_query($query);
			$result = $result[0]['count'];  }
		else{  $result=0;	}
		return $result;
    }
	
	public static function getMessageCount($_la_id){
        $query ="SELECT count(*) as `count` FROM `messages` WHERE `la_id`=$_la_id and `delete`=0 ";		
		$result = execute_query($query);
		$result = $result[0]['count'];
		return $result;
    }
	
    public function getMessage($message_id) {
		$query="SELECT * FROM `messages` WHERE `id`=".$message_id;
        $result=execute_query($query);
        $this->id				=	$message_id;
        $this->la_id 			= 	$result[0]['la_id'];
		$this->text				= 	$result[0]['text'];
        $this->head 			=	$result[0]['head'];
        $this->date_and_time 	= 	$result[0]['time_stamp'];
        $this->image 			= 	$result[0]['image'];
	}
}

?>