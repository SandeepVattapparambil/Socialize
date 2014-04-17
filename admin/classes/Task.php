<?php

/**
 *
 * @author Sakkeer Hussain
 */
include_once("../Constants/connect.inc.php"); 
include_once("Complaint.php");
include_once("Appointment.php");
include_once("Feedback.php");
class Task
{
    private $id;
    private $message_id;
    private $type;
    private $priority;
    private $user_id;
    private $subject;
    private $date;    
    public function __construct($_taskId,$_message_id,$_type,$_priority)
    {
        echo 'one instance of Task created';
        $this->id = $_taskId;
        $this->message_id =$_message_id;
        $this->type = $_type;
        if(strcmp($this->type,"Complaint")==0)
        {
		   $c=new Complaint();	
           $result = $c->getComplaint($this->message_id);
           $this->user_id = $c->getUser_id();
           $this->subject = $c->getSubject();
           $this->date    = $c->getDate_and_time();
        }
        else if(strcmp($this->type,"Appointment")==0)
        {
		   $a=new Appointment();
           $result=$a->getAppointment($this->message_id);
           $this->user_id = $a->getUser_id();
           $this->subject = $a->getSubject();
           $this->date	  = $a->getDateofappointment();
           
        }
        else if(strcmp($this->type,"Feedback")==0)
        {
		   $f=new Feedback();
           $result = $f->getFeedback($this->message_id);
           $this->userId = $f->getUser_id();
           $this->subject = $f->getSubject();
           
           
        }
    }
    
    public function insertTask($_message_id,$_type,$_priority)
    {
        return execute_update("INSERT INTO `tasks`(`message_id`,`type`,`priority`) VALUES(".$_message_id.",'".$_type."',".$_priority.")");
    }
 
}
