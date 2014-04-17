
<?php /**
 *
 * @author Sachin Thomas
 */ 
 
@include_once("../Constants/connect.inc.php");
@include_once("Constants/connect.inc.php");	 
class Admin {
    public $id;//int
    public $voterid;//string
    public $fullname;//String 
    public $address;//String 
    public $date_of_birth;//date
    public $gender;//char
    public $mob_no;//String 
    public $password;//String 
    public $email;//String
    public $user_image;
    public $la_name;
    public $district_id;
    public $website;
    public function __construct(){
    	//constructor   
    }
	
	public function login($_usr,$_pass){
		$query="SELECT  `id`,`password`,`password_salt` FROM `admin_info` WHERE `mla_email` = '".$_usr."'";
		if($result=execute_query($query)and !empty($result)){
			$password_salt=$result[0]['password_salt'];
			$_pass=md5($_pass.$password_salt);
			if($_pass==$result[0]['password']){	
				$this->id=$result[0]['id'];
				$this->get_admin();
				return 0;		
			}
			else
				return 1;
		}
		else
			return 2;
	} 
	
	public function get_admin($_user_id=0){
		if($_user_id!=0){
			$this->id=$_user_id;
		}
		$query="SELECT * FROM `admin_info` WHERE `id`=".$this->id;
		$result=execute_query($query);
   		$this->voterid		= $result[0]['voterid'];    	
		$this->fullname         = $result[0]['mla_name'];		
		$this->address		= $result[0]['address'];
		$this->date_of_birth    = $result[0]['date_of_birth'];
		$this->gender 		= $result[0]['gender'];
		$this->mob_no 		= $result[0]['mla_mob'];
		$this->email 		= $result[0]['mla_email'];
		$this->password		= $result[0]['password'];
		$this->la_name		= $result[0]['la_name'];
                $this->district_id	= $result[0]['district_id'];
		$this->user_image	= $result[0]['user_image'];
	}
	
	public static function get_admin_name($_user_id){
		$query="SELECT `fullname` FROM `admin_info` WHERE `id`=".$_user_id;
		$result=execute_query($query);
   		return($result[0]['fullname'] );			
	}
	
	public function edit_admin($name,$mobile,$email,$address){
        //$_date_of_birth=date('Y-m-d',$_date_of_birth_time_stamp);
		//$_date_of_registration=date('Y-m-d',$_date);
        $result=false;        
        $query="UPDATE `admin_info` SET `mla_name`='".$name."',`mla_mob`='".$mobile."',`mla_email`='".$email."',`address`='".$address."' WHERE `id`='".$this->id."'";
		$result=execute_update($query); 
		$this->fullname	= $name;		
		$this->address		= $address;
		$this->mob_no 		= $mobile;
		$this->email	= $email;
		return $result;
    }
    
        public function update_password($current_password,$new_password)
        {
            $result=false;
            $query="SELECT `password_salt` FROM `admin_info` WHERE `id`=".$this->id;
            $password_salt =  execute_query($query)[0]['password_salt'];
            $calc_password = md5($current_password.$password_salt);
            if($calc_password==$this->password)
            {
                $new_calc_password=md5($new_password.$password_salt);
                $query="UPDATE `admin_info` SET `password`='".$new_calc_password."' WHERE `id`=".$this->id;
                $result=  execute_update($query);
                if($result) $this->password=$new_calc_password;
            }
            return $result;
        }
        
        public function get_wall_text()
        {
            $result=false;
            $query="SELECT `message` FROM `admin_wall` WHERE `admin_id`=".$this->id;
            $result=  execute_query($query)[0]['message'];
            return $result;
        }
        
        public function set_wall_text($msg)
        {
            $result=false;
            $query="UPDATE `admin_wall` SET `message`='".$msg."' WHERE `admin_id`=".$this->id;
            $result=  execute_update($query);
            return $result;
        }
        
        public function get_wall_images()
        {
            $result=false;
            $query="SELECT `image_1`,`image_2`,`image_3` FROM `admin_wall` WHERE `admin_id`=".$this->id;
            @$result=  execute_query($query)[0];
            return $result;
        }
        
	public function add_admin_image($_image=0){
		if(!$_image==0){
			//$_image=addcslashes($_image);
			$this->user_image=$_image;
		}
		if(execute_update("UPDATE `admin_info` SET `user_image`='".$this->user_image."' WHERE `id`=".$this->id)){
			return true;
		}
		else{
			return false;
		}
	}
        
        public function add_wall_image($_image=0,$img_no){
            $query="UPDATE `admin_wall` SET `".$img_no."`='".$_image."' WHERE `admin_id`=".$this->id;
		if(execute_update($query)){
                        
			return true;
		}
		else{
			return false;
		}
	}
        
        public function create_wall_entry()
        {
            $query="SELECT `id` FROM `admin_wall` WHERE `admin_id`=".$this->id;
            $result=execute_query($query);
            if(count($result)==0)
            {
                $query="INSERT INTO `admin_wall` (`admin_id`,`message`,`image_1`,`image_2`,`image_3`) VALUES ('".$this->id."','','','','')";
                execute_update($query);
            }
        }
        
	public function getSAList(){
        $result = array();        
        $result_id = execute_query("SELECT `id` FROM `special_authority` WHERE `district_id`=".$this->district_id);
		$i=0;
		foreach($result_id as $element){
			$result[$i]=$element['id'];
			$i++;
		}
		return $result;
    }
        
	public function getCAList(){
        $result = array();        
        $result_id = execute_query("SELECT `id` FROM `central_authority`");
		$i=0;
		foreach($result_id as $element){
			$result[$i]=$element['id'];
			$i++;
		}
		return $result;
    }
	
}
?>
