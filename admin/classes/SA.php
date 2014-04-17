
<?php /**
 *
 * @author Sakkeer Hussain
 */ 
 
@include_once("../Constants/connect.inc.php");
@include_once("Constants/connect.inc.php");	 
class SA {
    public $id;
    public $sa_name;
    //public $address; 
    //public $sex;
    public $sa_mob_no; 
    public $sa_email;
    public $distrinct_id;
	public $sa_designation;
	public $user_image;
        public $password;
	
	
	public function sa_login($_usr,$_pass){
	$query="SELECT  `id`,`password`,`password_salt` FROM `special_authority` WHERE `sa_mail_id` = '".$_usr."'";
		if($result=execute_query($query)and !empty($result)){
			$password_salt=$result[0]['password_salt'];
			$_pass=md5($_pass.$password_salt);
			if($_pass==$result[0]['password']){	
				$this->id=$result[0]['id'];
				$this->get_sa();
				return 0;		
			}
			else
				return 1;
		}
		else
			return 2;
	}
	
	public function get_sa($_user_id=0){
		if($_user_id!=0){
			$this->id=$_user_id;
		}
		$query="SELECT * FROM `special_authority` WHERE `id`=".$this->id;
		$result=execute_query($query);
   		//$this->voterid		= $result[0]['voterid'];    	
		$this->sa_name			= $result[0]['sa_name'];		
		$this->sa_mob_no		= $result[0]['sa_mob'];
		$this->sa_email			= $result[0]['sa_mail_id'];
		$this->distrinct_id		= $result[0]['district_id'];
		$this->id				= $result[0]['id'];
		$this->sa_designation	= $result[0]['sa_designation'];
		$this->user_image	= $result[0]['user_image'];
                $this->password         = $result[0]['password'];
	}
	
        public function edit_sa($name,$mobile,$email){
        //$_date_of_birth=date('Y-m-d',$_date_of_birth_time_stamp);
		//$_date_of_registration=date('Y-m-d',$_date);
        $result=false;        
        $query="UPDATE `special_authority` SET `sa_name`='".$name."',`sa_mob`='".$mobile."',`sa_mail_id`='".$email."' WHERE `id`='".$this->id."'";
		$result=execute_update($query); 
		$this->sa_name	= $name;
		$this->sa_mob_no = $mobile;
		$this->sa_email	= $email;
		return $result;
    }
    
            public function update_password($current_password,$new_password)
        {
            $result=false;
            $query="SELECT `password_salt` FROM `special_authority` WHERE `id`=".$this->id;
            $password_salt =  execute_query($query)[0]['password_salt'];
            $calc_password = md5($current_password.$password_salt);
            if($calc_password==$this->password)
            {
                $new_calc_password=md5($new_password.$password_salt);
                $query="UPDATE `special_authority` SET `password`='".$new_calc_password."' WHERE `id`=".$this->id;
                $result=  execute_update($query);
                if($result) $this->password=$new_calc_password;
            }
            return $result;
        }
    
	
	public static function clear_complaint($_comp_id){
		$query="UPDATE `complaints` SET `status`=4 WHERE `id`=".$_comp_id;
		$result=execute_update($query);
   		return $result;			
	}
	
	/*
	public function add_user($email,$fullname,$voterid,$password){
		$rand_num=rand(1,5);
		$profile_pic="../assets/img/profile/".$rand_num.".jpg";
		$handle=fopen($profile_pic,'r');
		$image=fread($handle,filesize($profile_pic));		
		$image=addslashes($image);	
        $password_salt=substr(str_shuffle("abcdefghklmnopqrstuvwxyz0123456789"),0,8);
		$password=md5($password.$password_salt);
		$result=false;     
		$query="INSERT INTO `socialize`.`users` (`voterid`, `fullname`, `password`, `password_salt`, `email`, `user_image`) VALUES  ('".$voterid."', '".$fullname."', '".$password."', '".$password_salt."', '".$email."', '".$image."');";  
		$result=execute_update($query);
		$query_run=execute_query("SELECT `id` FROM `users` WHERE `email`='".$email."'");         
		$this->id 		= $query_run[0]['id'];
		$this->fullname	= $fullname;
		$this->voterid 	= $voterid;
		$this->password = $password;
		$this->email 	= $email;
		if(User::verify_user($fullname,$voterid)){
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
	
	public function getMlaName(){
		$query ="SELECT `mla_name` FROM `admin_info` WHERE `id`=$this->la_id";		
		$result = execute_query($query);
		$result = $result[0]['mla_name'];
		return $result;
    }
	public static function verify_user($fullname,$voterid){
		//to do sachin
		$query ="SELECT * FROM `voters_list` WHERE `id_card_no`='$voterid' ";		
		$result 		= execute_query($query);
		$la_id			= $result[0]['la_id'];
		$address		= $result[0]['address'];
		$date_of_birth	= $result[0]['date_of_birth'];
		$sex			= $result[0]['sex'];
		$query ="SELECT `name` FROM `admin_info` WHERE `id`=$la_id ";		
		$la_name = execute_query($query);
		$la_name 		= $la_name[0]['name'];
		$query ="UPDATE `users` SET `la_name`='$la_name',`la_id`=$la_id,
		`address`='$address',	`date_of_birth`='$date_of_birth',`sex`='$sex' 
		WHERE `voterid`='$voterid'";
		if(execute_update($query)){
			
			return true;
		}
		else{
			
			return false;
		}
	}	*/
}




?>
