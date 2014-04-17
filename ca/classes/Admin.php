<?php
/**
 *
 * @author Sakkeer Hussain
 */
@include_once("../Constants/connect.inc.php");
@include_once("Constants/connect.inc.php");
class Admin {
    public $id;
    public $voterid;
    public $name;
    public $address;
    public $date_of_birth;
    public $sex;
    public $mob_no;
    public $email;
    private $status;
	public $user_image;
	public $la_name;
	public $la_id;
    public function __construct() {
        //constructor
    }
	public function get_admin($_user_id=0){
		if($_user_id!=0){
			$this->id=$_user_id;
		}
		$query="SELECT * FROM `admin_info` WHERE `id`=".$this->id;
		$result=execute_query($query);
   		$this->voterid		= $result[0]['voterid'];    	
		$this->name			= $result[0]['mla_name'];
		$this->la_name		= $result[0]['la_name'];		
		$this->date_of_birth= $result[0]['date_of_birth'];
		$this->sex 			= $result[0]['gender'];
		$this->mob_no 		= $result[0]['mla_mob'];
		$this->email 		= $result[0]['mla_email'];
		$this->address		= $result[0]['address'];
		$this->user_image	= $result[0]['user_image'];
	}
	public function getMlaFromDistrict($_district_id){
        $result = array(); 
		$query="SELECT `id` FROM `admin_info` WHERE `district_id`=".$_district_id." ORDER BY `id` ";
		$result_id = execute_query($query);
		$i=0;
		foreach($result_id as $element){
			$result[$i]=$element['id'];
			$i++;
		}
		return $result;
    }
}

?>