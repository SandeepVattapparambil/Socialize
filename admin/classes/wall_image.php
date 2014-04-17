<?php
@include_once("../Constants/connect.inc.php");
class wall_image {
	 	public $id;
	 	public $text;
	 	public $image;
	    public function getText() {
			return $this->text;
		}
		public function  setText($_text) {
			$this->text = text;
		}
		public function getImage() {
			return $this->image;
		}
		public function  setImage($_image) {
			$this->image = image;
		}
		public function getId() {
			return $this->id;
		}
		public function  setId($_id) {
			$this->id = id;
		}
		public function add_wall_image($_text,$_image){
			$query="INSERT INTO `wall_images`(`text`, `image`) VALUES ('".$_text."','".$_image."')";
			execute_update($query);
		}
		public function get_wall_image($_id=0){
			if($_id==0){
				$_id=$this->id;
			}
			$query="SELECT * FROM `wall_images` where `id`=".$_id;	
			$result=execute_query($query);
			$this->id	= $result[0]['id'];
			$this->text	= $result[0]['text'];
			$this->image= $result[0]['image'];
		}
		public function get_last_four(){
			$result= array();
			$query="SELECT * FROM `wall_images` order by `id` desc limit 4";
			$res=execute_query($query);
			$i=0;
			while($i<4){
				$img= new wall_image();
				$img->id	= $res[$i]['id'];
				$img->text	= $res[$i]['text'];
				$img->image	= $res[$i]['image'];
				$result[$i]=$img;
				$i++;
			}
			return($result);
		} 
}
/*$obj =new wall_image();
$wall=$obj->get_last_four();
$i=0;
while($i<4){
	echo '<hr>';
	$blob= $wall[$i]->getImage();
	@$image = imagecreatefromstring($blob); 
	ob_start(); 
	imagejpeg($image, null, 80);
	$data = ob_get_contents();
	ob_end_clean();
	echo '<img height="500" width="650" src="data:image/jpg;base64,' .  base64_encode($data)  . '" />';
	$i++;
}*/
?>