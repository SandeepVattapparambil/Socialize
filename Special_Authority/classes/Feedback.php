<?php
/**
 *
 * @author Sakkeer Hussain
 */
include_once("../Constants/connect.inc.php");
class Feedback {
	private $id;
    private $user_id;//int
    private $name;
    private $email;
    private $subject;
    private $message;
    private $priority;
    private $status;
    private $trashed;
	function __construct() {
        //constructor
		//$this->count++;
    } 
	function __destruct(){
		//destructor
	}
    public function getUser_id() {
	return $user_id;
    }

    public function setUser_id($_user_id) {
	$this->user_id = $_user_id;
    }
	public function getName() {
	return $this->name;
    }

    public function setName($_name) {
	$this->name = $_name;
    }
	public function getEmail() {
	return $this->emai;
    }

    public function setEmail($_email) {
	$this->email = $_email;
    }
    public function getSubject() {
	return $this->subject;
    }
    public function setSubject($_subject) {
	$this->subject = $_subject;
    }
    public function getMessage() {
	return $this->message;
    }
    public function setMessage($_message) {
	$this->message = $_message;
    }
    public function getPriority() {
    	return $this->priority;;
    }
    public function setPriority($_priority) {
	$this->priority = $_priority;
    }
    public function getStatus() {
	return $this->status;
    }
    public function setStatus($_status) {
	$this->status = $_status;
    }
    public function getTrashed() {
	return $this->trashed;
    }
    public function setTrashed($_trashed) {
	$this->trashed = $_trashed;
    }
	public function addFeedback($_user_id,$_subject,$_complaint){
        /*copied from complaint
		$result=false;
        $date=time();
        $_date_and_time=date('Y-m-d H:i:s',$date);   
		$query='INSERT INTO `complaints`(`user_id`,`subject`,`complaint`,`date_and_time`) VALUES (`'.$_user_id.'`,`'.$_subject.'`,`'.$_complaint.'`,`'.$_date_and_time.'`)';     
        execute_update($query);
        return $result;*/
    }
    public function getFeedbackList($_user_name){
        /*copied from complaint
		$result = array();
        $_user_id=execute_query("SELECT `id`  FROM `users` WHERE `user_name` LIKE '".$_user_name."'");        
        $result_id = execute_query("SELECT `id` FROM `complaints` WHERE `user_id`=".$_user_id[0]['id']." ORDER BY `date_and_time`");
		$i=0;
		foreach($result_id as $element){
			$result[$i]=$element['id'];
			$i++;
		}
		return $result;*/
    }
    public function getFeedback($feedback_id) {
		//copied from complaint
        $result=execute_query("SELECT * FROM `feedback` WHERE `id`=".$feedback_id);
        $this->id			=	$feedback_id;
        $this->user_id 		= 	$result[0]['user_id'];
        $this->subject 		= 	$result[0]['subject'];
        $this->name 		=	$result[0]['name'];
        $this->email		= 	$result[0]['email'];
		$this->message 		=	$result[0]['message'];
		$this->priority		=	$result[0]['priority'];
		$this->trashed		=	$result[0]['trashed'];
        $this->status 		=	$result[0]['status'];
	}
}

/*$obj=new Feedback(); 
echo 'obj created. <hr>';
$obj->getFeedback(2);
echo $obj->getMessage().'<hr>';*/
?>