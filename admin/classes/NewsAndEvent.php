<?php 

/**
 *
 * @author Sakkeer Hussain
 */?>
 
 
 
<?php

@include_once("../Constants/connect.inc.php");
class NewsAndEvent{
	private $id;
    private $name;
    private $description;
	private $image;
    public function __construct() {		
        //echo( 'one instance of NewsSndEvent class is created <br>');		
    }
	
    public function setDetails($name,$image,$descripton) {
        $this->name = $name;
        $this->image=$image;
        $this->description = $descripton;
    }
    public function toString() {
        return "NewsAndEvent{ name=".$this->name.", date=".date('d-M-Y,D ',$this->date_and_time).", descripton=".$this->description.", news or event=".$this->news_or_event . "}";
    }

    public function setDescription($descripton) {
        $this->description = $descripton;
    }

    public function setName($name) {
        $this->name = $name;
    }
	
	public function setId($_id) {
        $this->id = $_id;
    }
    
	public function setImagee($image) {
        $this->image = $image;
    }

    
	
	public function  getId() {
        return $this->id;
    }

    public function  getDescription() {
        return $this->description;
    }

    public function getName() {
        return $this->name;
    }

    public function  getImage() {
        return $this->image;
    }
	
    public function getLastFour(){
        $query_run=execute_query("SELECT * FROM `news_and_events` where `trashed`=0 ORDER BY `id` DESC LIMIT 4");
		$result=array();
		$count=count($query_run);
		for($i=0;$i<4 and $i<$count;$i++){
			$result[$i]=new NewsAndEvent();
			$result[$i]->id=$query_run[$i]['id'];
			$result[$i]->name=$query_run[$i]['name'];
			$result[$i]->descripton=$query_run[$i]['description'];
			$result[$i]->image=$query_run[$i]['image'];
			
		}
		while($i<4){
			$result[$i]=new NewsAndEvent();
			$result[$i]->id			=' ';
			$result[$i]->name		=' ';
			$result[$i]->descripton	=' ';
			$result[$i]->image		=' ';
			$i++;
		}
		return $result;
    }
	public function get_news_and_evnts(){
        $query_run=execute_query("SELECT * FROM `news_and_events` where `trashed`=0 ORDER BY `id` DESC");
		$result=array();
		$count=count($query_run);
		for($i=0;$i<$count;$i++){
			$result[$i]=new NewsAndEvent();
			$result[$i]->id=$query_run[$i]['id'];
			$result[$i]->name=$query_run[$i]['name'];
			$result[$i]->description=$query_run[$i]['description'];
			$result[$i]->image=$query_run[$i]['image'];
			
		}
		return $result;
    } 
	
}
/*$obj= new NewsAndEvent();
$result=$obj->get_news_and_evnts();
echo '<hr>';
foreach($result as $e){
	echo $e->getid().'.  . '.$e->getDescription().'.'.' <br><hr>';
}*/
?>