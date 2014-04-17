
<?php /**
 *
 * @author Sakkeer Hussain
 */ 
 
@include_once("../Constants/connect.inc.php");
@include_once("Constants/connect.inc.php");	 
class sa {
    public $id;
    public $said;
    public $fullname;
    public $address; 
    public $designation;
    public $mail_id;
	public $district_id;

    public function __construct(){
    	//constructor   
    }
	
	public function get_sa_list($_district_id){
		$ids=NULL;$i=0;
		$query="SELECT `id` FROM `special_authority` WHERE `district_id`=".$_district_id;
		$result=execute_query($query);
   		foreach($result as $id){
			$ids[$i]=$result[$i]['id'];
			$i++;
		}
		return $ids;
		
	}
	
	public function get_lac_list(){
		$district_ids=NULL;$i=0;
		$sql = "SELECT `district_id` FROM `special_authority` group by `district_id`  order by `district_id`";
		$result=execute_query($sql);
   		foreach($result as $id){
			$district_ids[$i]=$result[$i]['district_id'];
			$i++;
		}
		return $district_ids;
		
	}
	
	public function get_sa($_id=0){
		if($_id!=0){
			$this->id=$_id;
		}
		$query="SELECT * FROM `special_authority` WHERE `id`=".$this->id;
		$result=execute_query($query);
   		$this->id			= $result[0]['id'];    	
		$this->fullname		= $result[0]['sa_name'];		
		$this->designation	= $result[0]['sa_designation'];
		//$this->date_of_birth= $result[0]['date_of_birth'];
		$this->mail_id		= $result[0]['sa_mail_id'];
		$this->district_id	= $result[0]['district_id'];
	}
	
		
	public function change_sa_id_number(){
		$query="";
		if(execute_update($query)){
			return true;
		}
		else{
			return false;
		}
	}
	 
    public  static function get_district_name($_district_id){
		$query="SELECT `name` FROM `districts` WHERE `id`=".$_district_id;
		$result=execute_query($query);
		if(!empty($result[0]['name']))
   			return($result[0]['name'] );	
		else return 'undefined';		
	}
	public  static function get_sa_count_in_an_la($_district_id){
		$query="SELECT count(*) FROM `special_authority` WHERE `district_id`=".$_district_id;
		$result=execute_query($query);
   		return($result[0]['count(*)'] );			
	}
	
	public function get_votrer_list($district_id){
		$sa_list=NULL;$i=0;
		$sql = "SELECT `id` FROM `special_authority` WHERE `district_id`= ".$district_id;
		$result=execute_query($sql);
   		foreach($result as $id){
			$sa_list[$i]=$result[$i]['id'];
			$i++;
		}
		return $sa_list;
		
	}
}
	
?>
