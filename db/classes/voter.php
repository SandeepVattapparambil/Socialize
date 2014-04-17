
<?php /**
 *
 * @author Sakkeer Hussain
 */ 
 
@include_once("../Constants/connect.inc.php");
@include_once("Constants/connect.inc.php");	 
class voter {
    public $id;
    public $voterid;
    public $fullname;
    public $address; 
    public $date_of_birth;
    public $sex;
	public $la_id;

    public function __construct(){
    	//constructor   
    }
	
	public function get_votes_list($_la_id){
		$ids=NULL;$i=0;
		$query="SELECT `id` FROM `voters_list` WHERE `la_id`=".$la_id;
		$result=execute_query($query);
   		foreach($result as $id){
			$ids[$i]=$result[$i]['id'];
			$i++;
		}
		return $ids;
		
	}
	
	public function get_lac_list(){
		$la_ids=NULL;$i=0;
		$sql = "SELECT `la_id` FROM `voters_list` group by `la_id`  order by `la_id`";
		$result=execute_query($sql);
   		foreach($result as $id){
			$la_ids[$i]=$result[$i]['la_id'];
			$i++;
		}
		return $la_ids;
		
	}
	
	public function get_voter($_id=0){
		if($_id!=0){
			$this->id=$_id;
		}
		$query="SELECT * FROM `voters_list` WHERE `id`=".$this->id;
		$result=execute_query($query);
   		$this->voterid		= $result[0]['id_card_no'];    	
		$this->fullname		= $result[0]['name'];		
		$this->address		= $result[0]['address'];
		$this->date_of_birth= $result[0]['date_of_birth'];
		$this->sex 			= $result[0]['sex'];
		$this->la_id		= $result[0]['la_id'];
	}
	
		
	public function change_voter_id_number(){
		$query="";
		if(execute_update($query)){
			return true;
		}
		else{
			return false;
		}
	}
	 
    public  static function get_la_name($_la_id){
		$query="SELECT `la_name` FROM `admin_info` WHERE `id`=".$_la_id;
		$result=execute_query($query);
		if(!empty($result[0]['la_name']))
   			return($result[0]['la_name'] );	
		else return 'undefined';		
	}
	public  static function get_voter_count_in_an_la($_la_id){
		$query="SELECT count(*) FROM `voters_list` WHERE `la_id`=".$_la_id;
		$result=execute_query($query);
   		return($result[0]['count(*)'] );			
	}
	
	public function get_votrer_list($la_id){
		$voter_list=NULL;$i=0;
		$sql = "SELECT `id` FROM `voters_list` WHERE `la_id`= ".$la_id;
		$result=execute_query($sql);
   		foreach($result as $id){
			$voter_list[$i]=$result[$i]['id'];
			$i++;
		}
		return $voter_list;
		
	}
}
	
?>
