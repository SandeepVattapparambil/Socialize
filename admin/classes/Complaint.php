<?php

/**
 *
 * @author Sakkeer Hussain
 */
@include_once("../Constants/connect.inc.php");
@include_once("Constants/connect.inc.php");	
class Complaint {
	public $id;
    public $user_id;//int
    public $text;
    public $date_and_time;//date and time
    public $status;//string
    public $la_id;
	public $position;
	public $private;   
    public function addComplaint($_user_id,$_la_id,$_text,$_private){
        $result=false;       
        $query="INSERT INTO `complaints`( `user_id`, `la_id`, `text`, `private`) VALUES ($_user_id,$_la_id,'$_text',$_private)";   
		if(execute_update($query)){
			$query='SELECT `id` FROM `complaints` WHERE `user_id`= 1 order by `time_stamp` desc  limit 1';
			$result=execute_query($query);
			$cmp_id=$result[0]['id'];
			$query="INSERT INTO `complaint_path`(`complaint_id`,`from`,`from_id`, `to`, `to_id`) VALUES ( $cmp_id ,'user',$_user_id, 'admin',$_la_id )";
			execute_update($query);			
           // print_r($result);die($query);
			$result=true;
		}
        return $result;
    }
	
	public static function addComplaintResponce($_complaint_id,$_owner_type,$_owner_id,$_text){
        $result=false;       
        $query="INSERT INTO `complaint_responce`( `complaint_id`, `owner_type`, `owner_id`, `text`) VALUES ($_complaint_id,'$_owner_type',$_owner_id,'$_text')";   
		if(execute_update($query)){
			$result=true;
		}
        return $result;
    }
	
	public function getComplaintResponceList($_complaint_id){
        $result=false;       
        $query="SELECT * FROM `complaint_responce` WHERE `complaint_id`=$_complaint_id order by `time_stamp` desc";  
		$result=execute_query(($query));
        return $result;
    }
	public static function getComplaintResponceOwnerName($_complaint_responce_id){
        $result=false;
		$query="SELECT `owner_type`,`owner_id` FROM `complaint_responce` WHERE `id`=$_complaint_responce_id";
		$result=execute_query($query);
		if($result[0]['owner_type']=='user')
			{$query="SELECT `fullname` as `name` FROM `users` WHERE `id`=".$result[0]['owner_id'];}
		elseif($result[0]['owner_type']=='admin')
			{$query="SELECT `mla_name` as `name` FROM `admin_info` WHERE `id`=".$result[0]['owner_id'];}
		elseif($result[0]['owner_type']=='sa')
			{$query="SELECT `sa_name` as `name` FROM `special_authority` WHERE `id`=".$result[0]['owner_id'];}
		elseif($result[0]['owner_type']=='ca')
			{$query="SELECT `ca_name` as `name` FROM `central_authority` WHERE `id`=".$result[0]['owner_id'];}
		$result=execute_query($query);	
		return $result[0]['name'];
    }
	
	public static function getComplaintResponceOwnerType($_complaint_responce_id){
        $result=false;
		$query="SELECT `owner_type` ,`owner_id` FROM `complaint_responce` WHERE `id`=$_complaint_responce_id";
		$result=execute_query($query);
		if($result[0]['owner_type']=='user')
			{ $result="USER"; }
		elseif($result[0]['owner_type']=='admin')
			{ $result="MLA"; }
		elseif($result[0]['owner_type']=='sa')
			{ $query="SELECT `sa_designation`  FROM `special_authority` WHERE `id`=".$result[0]['owner_id'];
			  $result=execute_query($query);
			  $result=$result[0]['sa_designation']; }
		elseif($result[0]['owner_type']=='ca')
			{ $query="SELECT `ca_designation` as `name` FROM `central_authority` WHERE `id`=".$result[0]['owner_id'];
			  $result=execute_query($query);
			  $result=$result[0]['ca_designation']; }
		
		return  $result;
    }
	
		public static function getComplaintResponceOwnerImage($_complaint_responce_id){
        $result=false;
		$query="SELECT `owner_type`,`owner_id` FROM `complaint_responce` WHERE `id`=$_complaint_responce_id";
		$result=execute_query($query);
		if($result[0]['owner_type']=='user')
			{$query="SELECT `user_image` FROM `users` WHERE `id`=".$result[0]['owner_id'];}
		elseif($result[0]['owner_type']=='admin')
			{$query="SELECT `user_image` FROM `admin_info` WHERE `id`=".$result[0]['owner_id'];}
		elseif($result[0]['owner_type']=='sa')
			{$query="SELECT `user_image` FROM `special_authority` WHERE `id`=".$result[0]['owner_id'];}
		elseif($result[0]['owner_type']=='ca')
			{$query="SELECT `user_image` FROM `central_authority` WHERE `id`=".$result[0]['owner_id'];}
		$result=execute_query($query);	
		return $result[0]['user_image'];     
    }
	
	public static function getComplaintOwnerName($_complaint_id){
        $result=false;
		$query="SELECT `user_id` FROM `complaints` WHERE `id`=$_complaint_id";
		$result=execute_query($query);		
		$query="SELECT `fullname` as `name` FROM `users` WHERE `id`=".$result[0]['user_id'];
		$result=execute_query($query);
		@$result=$result[0]['name'];
		return  $result;    
    }
	
    public function getComplaintList($_user_id){
        $result = array(); 
		$query="SELECT `id` FROM `complaints` WHERE `user_id`=".$_user_id." ORDER BY `time_stamp` DESC";
		$result_id = execute_query($query);
		$i=0;
		foreach($result_id as $element){
			$result[$i]=$element['id'];
			$i++;
		}
		return $result;
    }
	public function getComplaintListPublicInAnla($_la_id,$_user_id){
        $result = array(); 
		$query="SELECT `id`,`user_id` FROM `complaints` WHERE `la_id`=".$_la_id." and `private`=0  ORDER BY `time_stamp`";
		$result_id = execute_query($query);
		$i=0;
		foreach($result_id as $element){
			if($element['user_id'] != $_user_id ){
				$result[$i]=$element['id'];
				$i++;
			}
		}
		return $result;
    }
    public function getComplaint($complaint_id) {
		$query="SELECT * FROM `complaints` WHERE `id`=".$complaint_id;
        $result=execute_query($query);
        $this->id=$complaint_id;
        $this->user_id 			= 	$result[0]['user_id'];
        $this->la_id 			= 	$result[0]['la_id'];
		$this->text				= 	$result[0]['text'];
        $this->position 		=	$result[0]['position'];
        $this->date_and_time 	= 	$result[0]['time_stamp'];
        $this->status 			=	$result[0]['status'];
		$this->private 			= 	$result[0]['private'];
	}
	
		public function getComplaintRatingCount($_type){
        $query="SELECT count(*) as `count` FROM `complaint_rating` WHERE `complaint_id`=$this->id and `type`=$_type ";
		$result=execute_query($query);
		$result = $result[0]['count'];
		return $result;
    }
	
	public function getNewComplaints(){
        $result = array();        
        $result_id = execute_query("SELECT `id` FROM `complaints` WHERE `status`=0 ORDER BY `time_stamp` DESC");
		$i=0;
		foreach($result_id as $element){
			$result[$i]=$element['id'];
			$i++;
		}
		return $result;
    }
	
	public function getAcceptedComplaints(){
        $result = array();        
        $result_id = execute_query("SELECT `id` FROM `complaints` WHERE `status`=1 AND `position`<>'admin' ORDER BY `time_stamp` DESC");
		$i=0;
		foreach($result_id as $element){
			$result[$i]=$element['id'];
			$i++;
		}
		return $result;
    }
	
	public function getSolvedComplaints(){
        $result = array();        
        $result_id = execute_query("SELECT `id` FROM `complaints` WHERE `status`=4 ORDER BY `time_stamp` DESC");
		$i=0;
		foreach($result_id as $element){
			$result[$i]=$element['id'];
			$i++;
		}
		return $result;
    }
    
	public function getRejectedComplaints(){
        $result = array();        
        $result_id = execute_query("SELECT `id` FROM `complaints` WHERE `status`=2 ORDER BY `time_stamp` DESC");
		$i=0;
		foreach($result_id as $element){
			$result[$i]=$element['id'];
			$i++;
		}
		return $result;
    }
    
	public function getSelfActions(){
        $result = array();        
        $result_id = execute_query("SELECT `id` FROM `complaints` WHERE `status`=1 AND `position`='admin' ORDER BY `time_stamp` DESC");
		$i=0;
		foreach($result_id as $element){
			$result[$i]=$element['id'];
			$i++;
		}
		return $result;
    }
    
	public function getComplaintsForwadedToSA(){
        $result = array();        
        $result_id = execute_query("SELECT `id` FROM `complaints` WHERE `status`=5 AND `position`='sa' ORDER BY `time_stamp` DESC");
		$i=0;
		foreach($result_id as $element){
			$result[$i]=$element['id'];
			$i++;
		}
		return $result;
    }

	public function getComplaintsForwadedToCA(){
        $result = array();        
        $result_id = execute_query("SELECT `id` FROM `complaints` WHERE `status`=5 AND `position`='ca' ORDER BY `time_stamp` DESC");
		$i=0;
		foreach($result_id as $element){
			$result[$i]=$element['id'];
			$i++;
		}
		return $result;
    }
    
	public function setComplaintStatus($status){
	 $result = array(); 
		$this->status=$status;
		$query="UPDATE `complaints` SET `status`=".$status." WHERE `id`=".$this->id;
		$result = execute_update($query);
		return $result;
	}
        
        public function setComplaintPosition($position){
	 $result = array(); 
		$this->position=$position;
		$query="UPDATE `complaints` SET `position`='".$position."' WHERE `id`=".$this->id;
		$result = execute_update($query);
		return $result;
	}
        
         public function forwardComplaint($from_id,$fw_pos,$fw_id){
                $this->setComplaintPosition($fw_pos);
		$query="UPDATE `complaints` SET `position_id`='".$fw_id."' WHERE `id`=".$this->id;
		execute_update($query);
		$query="INSERT INTO `complaint_path`(`complaint_id`,`from`,`from_id`, `to`, `to_id`) VALUES ( $this->id ,'admin',$from_id, '$fw_pos', $fw_id )";
		execute_update($query);   
                $this->setComplaintStatus(5);
	}
        
        public static function getNewComplaintCount($la_id)
        {
            $result=false;
            $query="SELECT COUNT(*) FROM `complaints` WHERE `status`=0 AND `la_id`=".$la_id;
            $result=  execute_query($query)[0]['COUNT(*)'];
            return $result;
        }
        
        public static function getSolvedComplaintCount($la_id)
        {
            $result=false;
            $query="SELECT COUNT(*) FROM `complaints` WHERE `status`=4 AND `la_id`=".$la_id;
            $result=  execute_query($query)[0]['COUNT(*)'];
            return $result;
        }
}

?>