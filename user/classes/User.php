
<?php /**
 *
 * @author Sakkeer Hussain
 */ 
 
@include_once("../Constants/connect.inc.php");
@include_once("Constants/connect.inc.php");	 
class User {
    public $id;//int
    public $voterid;//string
    public $fullname;//String 
    public $address;//String 
    public $date_of_birth;//date
    public $sex;//char
    private $phone_no;//String 
    public $mob_no;//String 
    public $password;//String 
    public $email;//String 
    private $status;
	private $category; 
	public $user_image;
	public $la_name;
	public $la_id;
    public function __construct(){
    	//constructor   
    }
	
	public function login($_usr,$_pass){
		$query="SELECT  `id`,`password`,`password_salt` FROM `users` WHERE `email` = '".$_usr."'";
		if($result=execute_query($query)and !empty($result)){
			$password_salt=$result[0]['password_salt'];
			$_pass=md5($_pass.$password_salt);
			if($_pass==$result[0]['password']){	
				$this->id=$result[0]['id'];
				$this->get_user();
				return 0;		
			}
			else
				return 1;
		}
		else
			return 2;
	} 
	
	public function get_user($_user_id=0){
		if($_user_id!=0){
			$this->id=$_user_id;
		}
		$query="SELECT * FROM `users` WHERE `id`=".$this->id;
		$result=execute_query($query);
   		$this->voterid		= $result[0]['voterid'];    	
		$this->fullname		= $result[0]['fullname'];		
		$this->address		= $result[0]['address'];
		$this->date_of_birth= $result[0]['date_of_birth'];
		$this->sex 			= $result[0]['sex'];
		$this->mob_no 		= $result[0]['mob_no'];
		$this->email 		= $result[0]['email'];
		$this->password		= $result[0]['password'];
		$this->la_name		= '';
		$this->la_id		= $result[0]['la_id'];
		//$this->status		= 'active';//$result[0]['status'];
		//$this->category		= $result[0]['category'];
		$this->user_image	= $result[0]['user_image'];
	}
	
	public static function get_user_name($_user_id){
		$query="SELECT `fullname` FROM `users` WHERE `id`=".$_user_id;
		$result=execute_query($query);
   		return($result[0]['fullname'] );			
	}
	
	public  function get_la_name($_la_id){
		$query="SELECT `la_name` FROM `admin_info` WHERE `id`=".$_la_id;
		$result=execute_query($query);
   		return($result[0]['la_name'] );			
	}
	
	
	public function add_user($email,$fullname,$voterid,$password){
		$rand_num=rand(1,5);
		$profile_pic="../assets/img/profile/".$rand_num.".jpg";
		$handle=fopen($profile_pic,'r');
		$image=fread($handle,filesize($profile_pic));		
		$image=addslashes($image);	
        $password_salt=substr(str_shuffle("abcdefghklmnopqrstuvwxyz0123456789"),0,8);
		$password=md5($password.$password_salt);
		$result=false;
		$user_info_from_vl=$this->get_user_details($voterid);
		$name_at_vl 	= $user_info_from_vl['name'];
		$la_id			= $user_info_from_vl['la_id'];
		$address		= $user_info_from_vl['address'];
		$date_of_birth	= $user_info_from_vl['date_of_birth'];
		$sex			= $user_info_from_vl['sex'];     
		if($fullname!=$name_at_vl){
			$_SESSION['msg']='Name miss mathed in our record';
			return false;
		}
		$query="INSERT INTO `socialize`.`users` (`la_id`,`voterid`, `fullname`, `address`, `date_of_birth`, `sex`, `password`, `password_salt`, `email`, `user_image`) VALUES  ('".$la_id."','".$voterid."', '".$fullname."','".$address."','".$date_of_birth."','".$sex."', '".$password."', '".$password_salt."', '".$email."', '".$image."')";  
		
		$result=execute_update($query);
		$query_run=execute_query("SELECT `id` FROM `users` WHERE `email`='".$email."'");         
		$this->id 		= $query_run[0]['id'];
		$this->fullname	= $fullname;
		$this->voterid 	= $voterid;
		$this->password = $password;
		$this->email 	= $email;
		return $result;
	}
	
	public function edit_user($_full_name,$_address,$_sex,$_mob_no,$_image=0){
        //$_date_of_birth=date('Y-m-d',$_date_of_birth_time_stamp);
		//$_date_of_registration=date('Y-m-d',$_date);
        $result=false;        
        $query="UPDATE `users` SET `fullname`='".$_full_name."',`address`='".$_address."',`sex`='".$_sex."',`mob_no`='".$_mob_no."' WHERE `id`='".$this->id."'";    
		if(!$_image==0)$this->add_user_image($_image);
		$result=execute_update($query); 
		$this->full_name	= $_full_name;		
		$this->address		= $_address;
		$this->sex 			= $_sex;
		$this->mob_no 		= $_mob_no;
		return $result;
    }
	public function add_user_image($_image=0){
		if(!$_image==0){
			$this->user_image=$_image;
		}
		if(execute_update("UPDATE `users` SET `user_image`='".$this->user_image."' WHERE `id`=".$this->id)){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function get_complaint_count(){
		$query="SELECT count(*) FROM `complaints` WHERE `user_id`=".$this->id;
		$result=execute_query($query);
		$result=$result[0]['count(*)'];
		return $result;
	}
	
	public function get_responce_count(){
		$count=0;
		$query="SELECT `id` FROM `complaints` WHERE `user_id`=".$this->id;
		$result=execute_query($query);
		foreach($result as $id){			
			$query="SELECT count(*) FROM `complaint_responce` WHERE `complaint_id`=".$id['id']." and not(`owner_type`='user' and `owner_id` =$this->id)";
			$count_for_one_cmp=execute_query($query);
			$count_for_one_cmp=$count_for_one_cmp[0]['count(*)'];
			$count+=$count_for_one_cmp;
		}
		return $count;
	}
	
	public function getMlaName(){
		$query ="SELECT `mla_name` FROM `admin_info` WHERE `id`=$this->la_id";		
		$result = execute_query($query);
		$result = $result[0]['mla_name'];
		return $result;
    }
	
	public function getMlaImage(){
		$query ="SELECT `user_image` FROM `admin_info` WHERE `id`=$this->la_id";		
		$result = execute_query($query);
		$result = $result[0]['user_image'];
		return $result;
    }
	
	public function get_user_details($voterid){
		$query ="SELECT * FROM `voters_list` WHERE `id_card_no`='$voterid' ";		
		$result 		= execute_query($query);
		if($result)
			return $result[0];
		
		else
			return false;
		
	}
}

?>
