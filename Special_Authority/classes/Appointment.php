<?php

/**
 *
 * @author Sakkeer Hussain
 */
include_once("../Constants/connect.inc.php");

class Appointment {  
	private $id;
    private $user_id;
    private $subject;
    private $text;
    private $date_and_time;
    private $status;
    private $reply_text;
	private $date_of_appointment;
	public function __construct() {
		//constructor
	}
    /*public function __construct($_user_id,$_subject,$_complaint,$_date_and_time,$_status,$_reply_text) {
		parent::__construct();                
		$this->user_id 			= $_user_id;
		$this->subject 			= $_subject;
		$this->complaint 		= $_complaint;
		$this->date_and_time 	= $_date_and_time;
		$this->status 			= $_status;
		$this->reply_text 		= $_reply_text;
    }*/
      
    public function getUser_id() {
		return $this->user_id;
    }
    
    public function setUser_id($_user_id) {
		$this->user_id = $_user_id;
    }
    public function getSubject() {
		return $this->subject;
    }
    public function setSubject($_subject) {
		$this->subject = $_subject;
    }
    public function getText() {
		return $this->text;
    }
    public function setComplaint($_complaint) {
		$this->text = $_complaint;
    }
    public function getDate_and_time() {
		return $this->date_and_time;
    }
    public function setDate_and_time($_date_and_time) {
		$this->date_and_time =$_date_and_time;
    }
    public function getStatus() {
		return status;
    }
    public function setStatus($_status) {
		$this->status = status;
    }
    public function getReply_text() {
		return $this->reply_text;
    }
    public function setReply_text($_reply_text) {
		$this->reply_text = reply_text;
    }
	public function getDateofappointment() {
		return $this->date_of_appointment;
    }
    public function setDateofappointment($_date) {
		$this->date_of_appointment = $_date;
    }
    public function addAppointment($_user_id, $_subject, $_text, $_date_of_appointment , $_duration ){
            $result=false;
            $date=time();                  
            if(execute_update("INSERT INTO `mla_on_click`.`appointment` (`user_id`, `subject`, `text`, `date_and_time`, `date_of_appointment`, `duration`) VALUES ( '".$_user_id."', '".$_subject."', '".$_text."', '".date('Y-m-d H:i:s',$date)."','".$_date_of_appointment."', '".$_duration."')"))
                $result=true;
            return $result;
	}
	public function getAppointmentList($_user_name){
        $result = array();
        $_user_id=execute_query("SELECT `id`  FROM `users` WHERE `user_name` LIKE '".$_user_name."'");        
        $result_id = execute_query("SELECT `id` FROM `appointment` WHERE `user_id`=".$_user_id[0]['id']." ORDER BY `date_and_time`");
		$i=0;
		foreach($result_id as $element){
			$result[$i]=$element['id'];
			$i++;
		}
		return $result;
    }
    public function getAppointment($appointment_id) {
        $result=execute_query("SELECT * FROM `appointment` WHERE `id`=".$appointment_id);
        $this->id				  = $appointment_id;
        $this->user_id 			  = $result[0]['user_id'];
        $this->subject 			  = $result[0]['subject'];
        $this->text 			  = $result[0]['text'];
        $this->date_and_time 	  = $result[0]['date_and_time'];
		$this->date_of_appointment= $result[0]['date_of_appointment'];
        $this->status 			  = $result[0]['status'];
	}
	   

}
/*$obj=new Appointment;
$anum=$obj->getAppointmentList('arjun');
print_r($anum);
echo'<hr>';
foreach($anum as $element){
	$obj->getAppointment($element);
	echo $obj->getSubject().'<hr>';
}*/

?>