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
	public $time_stamp;
	public $private;   
    
	
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
			{$query="SELECT `ca_name` as `name` FROM `central_authority` WHERE `id`=".$result[0]['owner_id'];}
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
			{ $query="SELECT `ca_designation` FROM `central_authority` WHERE `id`=".$result[0]['owner_id'];
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
			{$query="SELECT `user_image` FROM `central_authority` WHERE `id`=".$result[0]['owner_id'];}
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
	
	public static function getComplaintOwnerImage($_complaint_id){
        $result=false;
		$query="SELECT `user_id` FROM `complaints` WHERE `id`=$_complaint_id";
		$result=execute_query($query);		
		$query="SELECT `user_image`  FROM `users` WHERE `id`=".$result[0]['user_id'];
		$result=execute_query($query);
		@$result=$result[0]['user_image'];
		return  $result;    
    }
	
    public function getComplaintList($_ca_id){
        $result = array(); 
		$query="SELECT `id` FROM `complaints` WHERE `position`='ca' and `position_id`=$_ca_id and `status` !=4 ORDER BY `time_stamp` DESC";
		$result_id = execute_query($query);
		$i=0;
		foreach($result_id as $element){
			$result[$i]=$element['id'];
			$i++;
		}
		return $result;
    }
	
	public function getClearedComplaintList($_ca_id){
        $result = array(); 
		$query="SELECT `id` FROM `complaints` WHERE `position`='ca' and `position_id`=$_ca_id and `status` =4 ORDER BY `time_stamp` DESC";
		$result_id = execute_query($query);
		$i=0;
		foreach($result_id as $element){
			$result[$i]=$element['id'];
			$i++;
		}
		return $result;
    }
	
	public function getLatestComplaintList($_ca_id){
        $result = array(); 
		$query="SELECT `id` FROM `complaints` WHERE `position`='ca' and `position_id`=$_ca_id and `status` !=4 ORDER BY `time_stamp` DESC Limit 10";
		$result_id = execute_query($query);
		$i=0;
		foreach($result_id as $element){
			$result[$i]=$element['id'];
			$i++;
		}
		return $result;
    }
	
		
	public function getComplaintRatingCount($_type){
        $query="SELECT count(*) as `count` FROM `complaint_rating` WHERE `complaint_id`=$this->id and `type`=$_type ";
		$result=execute_query($query);
		$result = $result[0]['count'];
		return $result;
    }
	
	public function addComplaintRating($_user_id,$_type){
		$result=false;
		$query="DELETE FROM `complaint_rating` WHERE `complaint_id`=$this->id and `user_id` =$_user_id";
		if(execute_update($query)){     			
			$query="INSERT INTO `complaint_rating`( `complaint_id`, `user_id`, `type`) VALUES ($this->id,$_user_id,$_type)";     
			if(execute_update($query)){
				$result=true;
			}	
			
		}
        return $result;
    }
	
	public function checkComplaintRating($_user_id){   
        $query="SELECT count(*) as `count`,`type` FROM `complaint_rating` WHERE `complaint_id`=$this->id and `user_id` =$_user_id";
		$result=execute_query($query);
		if($result[0]['count']==0)
			return 2;
		return $result[0]['type'];
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
		$this->time_stamp		=	$result[0]['time_stamp'];
	}
}
/*
$obj=new Complaint();
echo $obj->addComplaintResponce(5,"admin",34,"onn poda .....");addComplaint(4,34,'high maast light at areacode town is no working',0); 
$cnum=$obj->getComplaintList(1);
	foreach($cnum as $element){
	$obj->getComplaint($element);
	echo $obj->text.'<hr>';
	print_r($obj);
}*/
?>