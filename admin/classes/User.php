
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
    public $registration_time;
	private $category; 
	public $user_image;
	public $la_id;
	public $status;
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
		$this->fullname	= $result[0]['fullname'];		
		$this->address		= $result[0]['address'];
		$this->date_of_birth= $result[0]['date_of_birth'];
		$this->sex 			= $result[0]['sex'];
		$this->mob_no 		= $result[0]['mob_no'];
		$this->email 		= $result[0]['email'];
		$this->password		= $result[0]['password'];
		$this->la_id		= $result[0]['la_id'];
		$this->registration_time = $result[0]['RegistrationTime'];
		$this->user_image	= $result[0]['user_image'];
		$this->status		= $result[0]['status'];
	}
	
	public static function get_user_name($_user_id){
		$query="SELECT `fullname` FROM `users` WHERE `id`=".$_user_id;
		$result=execute_query($query);
   		return($result[0]['fullname'] );			
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
		if(veryfy_user($fullname,$voterid)){  
			$query="INSERT INTO `socialize`.`users` (`voterid`, `fullname`, `password`, `password_salt`, `email`, `user_image`) VALUES  ('".$voterid."', '".$fullname."', '".$password."', '".$password_salt."', '".$email."', '".$image."');";  
			$result=execute_update($query); 
			$query_run=execute_query("SELECT `id` FROM `users` WHERE `email`='".$email."'");         
			$this->id 		= $query_run[0]['id'];
			$this->fullname	= $fullname;
			$this->voterid 	= $voterid;
			$this->password = $password;
			$this->email 	= $email;
			return $result;
		}else{
			return false;
		}
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
			//$_image=addcslashes($_image);
			$this->user_image=$_image;
		}
		if(execute_update("UPDATE `users` SET `user_image`='".$this->user_image."' WHERE `id`=".$this->id)){
			return true;
		}
		else{
			return false;
		}
	}
	public function validate_user($_user_name,$_first_name,$_last_name,$_mob_no,$_password,$_email,$_date_of_registration){
        $_date=time();
		//$_date_of_registration=date('Y-m-d H:i:s',$_date);
        $result=false;     
		$dummy='password';
		$_password=md5(md5($_password.$dummy).$_password.$dummy);   
		
		$file_name='../assets/img/Icon-user.jpg';
		$handle=fopen($file_name,'r');
		$profile_pic=fread($handle,filesize($file_name));
		$profile_pic=addslashes($profile_pic);
        $query="INSERT INTO `users`( `user_name`, `first_name`, `last_name`, `mob_no`, `password`, `email`,`dateOfRegistration`, `user_image`) VALUES ('".$_user_name."','".$_first_name."','".$_last_name."','".$_mob_no."','".$_password."','".$_email."','".$_date_of_registration."','".$profile_pic."')";   
	 	$result=execute_update($query);
		$query_run=execute_query("SELECT `id` FROM `users` WHERE `user_name`='".$_user_name."'");         
        $this->id = $query_run[0]['id'];
		$this->user_name 	= $_user_name;
		$this->first_name	= $_first_name;
		$this->last_name 	= $_last_name;
		$this->mob_no 		= $_mob_no;
		$this->password 	= $_password;
		$this->email 		= $_email;
		$this->status 		= 1;
        return $result;
    }
    
    	public  static function get_la_name($_la_id){
		$query="SELECT `name` FROM `admin_info` WHERE `id`=".$_la_id;
		$result=execute_query($query);
   		return($result[0]['name'] );			
	}
	
		public static function getuserlist($la_id){
	 $result = array(); 
		$query="SELECT `id` FROM `users` WHERE `la_id`=".$la_id." AND `status`<>2 ORDER BY `RegistrationTime` DESC";
		$result_id = execute_query($query);
		$i=0;
		foreach($result_id as $element){
			$result[$i]=$element['id'];
			$i++;
		}
		return $result;
	}

		public static function getnewuserlist($la_id){
	 $result = array(); 
		$query="SELECT `id` FROM `users` WHERE `la_id`=".$la_id." AND `status`=0 ORDER BY `RegistrationTime` DESC";
		$result_id = execute_query($query);
		$i=0;
		foreach($result_id as $element){
			$result[$i]=$element['id'];
			$i++;
		}
		return $result;
	}
	
		public function setuserstatus($status){
	 $result = array(); 
		$this->status=$status;
		$query="UPDATE `users` SET `status`=".$status." WHERE `id`=".$this->id;
		$result = execute_update($query);
		return $result;
	}
        
        public static function getNewUserCount($la_id)
        {
            $result=false;
            $query="SELECT COUNT(*) FROM `users` WHERE `status`=0 AND `la_id`=".$la_id;
            $result=  execute_query($query)[0]['COUNT(*)'];
            return $result;
        }
}


function veryfy_user($fullname,$voterid){
	//to do sachin
	return(true);
}
?>
