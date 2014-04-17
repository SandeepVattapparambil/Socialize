
<?php /**
 *
 * @author Sachin Thomas
 */ 
 
@include_once("../Constants/connect.inc.php");
@include_once("Constants/connect.inc.php");	 
class mla {
    public $id;
    public $fullname; 
    public $date_of_birth;
    public $gender;
    public $mob_no;
    public $email;
    public $user_image;
    public $la_name;
    public function __construct(){
    	//constructor   
    }
	
	
	public function get_mla($_id=0){
		$query="SELECT * FROM `admin_info` WHERE `id`=".$_id;
		$result=execute_query($query);
   		$this->id			= $_id;    	
		$this->fullname		= $result[0]['mla_name'];		
		$this->address		= $result[0]['address'];
		$this->date_of_birth= $result[0]['date_of_birth'];
		$this->gender 		= $result[0]['gender'];
		$this->mob_no 		= $result[0]['mla_mob'];
		$this->email 		= $result[0]['mla_email'];
		$this->password		= $result[0]['password'];
		$this->la_name		= $result[0]['la_name'];
		$this->user_image	= $result[0]['user_image'];
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
    
    public function change_password($current_password,$new_password)
    {
        $result=false;
        $query="SELECT `password_salt` FROM `admin_info` WHERE `id`=".$this->id;
        $password_salt =  execute_query($query);
		$password_salt=$password_salt[0]['password_salt'];
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
        
	public function edit_admin_image($_image=0){
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
	
	
	public function get_lac_list_from_admin_info(){
		$la_ids=NULL;$i=0;
		$sql = "SELECT `id` FROM `admin_info` ";
		$result=execute_query($sql);
   		foreach($result as $id){
			$la_ids[$i]=$result[$i]['id'];
			$i++;
		}
		return $la_ids;
		
	}
}
?>
