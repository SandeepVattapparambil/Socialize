<?php
/**
 *
 * @author Sakkeer Hussain
 */
require("../Constants/connect.inc.php"); 
class Admin {
    
    public function __construct() {
        //constructor
    }
   
    public function countTotalAppointments()
    {
		$result=-1;
		$result=execute_query("SELECT COUNT(`id`) FROM `appointment` WHERE `trashed`=0");
        return $result[0]['COUNT(`id`)'];
    }
    
    public function countTotalFeedbacks()
    {
        $result=-1;
		$result=execute_query("SELECT COUNT(`id`) FROM `feedback` WHERE `trashed`=0");
        return $result[0]['COUNT(`id`)'];        
    }
   
    public function countTotalComplaints()
    {
        $result=-1;
		$result=execute_query("SELECT COUNT(`id`) FROM `complaints` WHERE `trashed`=0");
        return $result[0]['COUNT(`id`)'];
    }
   
    public function countNewComplaints()
    {
        $result=-1;
		$result=execute_query("SELECT COUNT(`id`) FROM `complaints` WHERE `status`='New' AND `trashed`=0 AND `priority`=0");
        return $result[0]['COUNT(`id`)'];
    }
    
    public function countNewFeedbacks()
    {
        $result=-1;
		$result=execute_query("SELECT COUNT(`id`) FROM `feedback` WHERE `status`='New' AND `trashed`=0 AND `priority`=0");
        return $result[0]['COUNT(`id`)'];
    }
    
    public function countNewAppointments()
    {
        $result=-1;
		$result=execute_query("SELECT COUNT(`id`) FROM `appointment` WHERE `status`='New' AND `trashed`=0 AND `priority`=0");
        return $result[0]['COUNT(`id`)'];
    }
    
    public function countTotalUsers()
    {
        $result=-1;
		$result=execute_query("SELECT COUNT(`id`) FROM `users`");
        return $result[0]['COUNT(`id`)'];
    }
    
    public function countNewRegistrants()
    {
        $result=-1;
		$result=execute_query("SELECT COUNT(`id`) FROM `users` WHERE `status`=4");
        return $result[0]['COUNT(`id`)'];
    }  
    
    public function statusToString($_status)
    {
        if($_status==1)
            return "Active";
        else if($_status==2)
            return "Blocked";
        else if($_status==3)
            return "Rejected";   
        else if($_status==4)
            return "Waiting";  
        else return "Invalid";
            
    }
    
    public function getNewRegistrants()
    {	
		$result=NULL;
        $result=execute_query("SELECT `id`,`user_name`,`first_name`,`last_name`,`pncmuncicor` FROM `users` WHERE `status`=4 ORDER BY `id` DESC LIMIT 0,10");
        return $result;
    }
    
    public function getNewMessageList()
    {
        $result=NULL;
        $result=execute_query("SELECT `id`,`user_name`,`first_name`,`last_name`,`pncmuncicor` FROM `users` WHERE `status`=4 ORDER BY id DESC LIMIT 0,15");
        return $result;
    }
    
    public function getAccountsList($_filter)
    {
        if($_filter==NULL||strcmp($_filter,"")==0)
        {
            $result=execute_query("SELECT `id`,`user_name`,`category`,`status` FROM `users`");
            return $result;
        }
        else if(strcmp($_filter,"Active")==0)
        {
            $result=execute_query("SELECT `id`,`user_name`,`category`,`status` FROM `users` WHERE `status`=1");
            return $result;            
        }
        else if(strcmp($_filter,"Blocked")==0)
        {
            $result=execute_query("SELECT `id`,`user_name`,`category`,`status` FROM `users` WHERE `status`=2");
            return $result;
        }
        else if(strcmp($_filter,"Rejected")==0)
        {
            $result=execute_query("SELECT `id`,`user_name`,`category`,`status` FROM `users` WHERE `status`=3");
            return $result;
        }
        else if(strcmp($_filter,"Waiting")==0)
        {
            $result=execute_query("SELECT `id`,`user_name`,`category`,`status` FROM `users` WHERE `status`=4");
            return $result;
        }
        return NULL;
    }
    
    public function getUserDetails($_user_id)
    {
        $result=execute_query("SELECT `user_name`,`first_name`,`last_name`,`id_card_no`,`p_address`,`sex`,`pncmuncicor`,`ward`,`phone_no`,`email`,`category`,`status` FROM `users` WHERE `id`=".$_user_id);
        return $result;
    }
    
    public function publishNewsOrEvent($_title,$_e_date,$_description,$_type)
    {
        if(execute_update("INSERT INTO `news_and_events`(`name`,`date`,`description`,`type`) VALUES ('".$_title."','".$_e_date."','".$_description."','".$_type."')"))
			return true;
		else
			return false;
    }
    
    public function getNews()
    {
        $result=execute_query("SELECT `id`,`name`,`date`,`description` FROM `news_and_events` WHERE `news_and_events`.`type`=0 ORDER BY `id` DESC");
        return $result;
    }
    
    public function getEvents()
    {
        $result=execute_query("SELECT `id`,`name`,`date`,`description` FROM `news_and_events` WHERE `news_and_events`.`type`=1 ORDER BY `id` DESC");
        return $result;
    }
    
    public function countNews()
    {
		$result=-1;
        $result=execute_query("SELECT COUNT(`id`) FROM `news_and_events` WHERE `news_and_events`.`type`=0");
        return $result;
	}
    
    public function countEvents()
    {
        $result=-1;
        $result=execute_query("SELECT COUNT(`id`) FROM `news_and_events` WHERE `news_and_events`.`type`=1");
        return $result;
    }
    
    public function getComplaints()
    {
        $result=execute_query("SELECT `id`,`user_id`,`subject`,`date_and_time` FROM `complaints` WHERE `trashed`=0 AND `priority`=0");
        return $result;
    }
    
    public function getAppointments()
    {
        $result=execute_query("SELECT `id`,`user_id`,`subject`,`date_and_time` FROM `appointment` WHERE `trashed`=0 AND `priority`=0");
        return $result;
    }
    
    public function getFeedbacks()
    {
        $result=execute_query("SELECT `id`,`user_id`,`name`,`email`,`subject` FROM `feedback` WHERE `trashed`=0 AND `priority`=0");
        return $result;
    }
    
    public function getComplaintText($_id)
    {
        $result=execute_query("SELECT `complaint` FROM `complaints` WHERE `id`=".$_id);
        return $result;
        
    }
    
    public function getAppointmentText($_id)
    {
        $result=execute_query("SELECT `date_of_appointment`,`duration`,`text` FROM `appointment` WHERE `id`=".$_id);
        return $result;
    }
    
    public function getFeedbackText($_id)
    {
        $result=execute_query("SELECT `message` FROM `feedback` WHERE `id`=".$_id);
        return $result;
    }
    
    public function trashComplaint($_id)
    {
        if(execute_update("UPDATE `complaints` SET `trashed`=1 WHERE `id`=".$_id))
			return true;
		else
			return false;
    }            
    
    public function trashAppointment($_id)
    {
        if(execute_update("UPDATE `appointment` SET `trashed`=1 WHERE `id`=".$_id))
			return true;
		else
			return false;
    }   
    
    public function trashFeedback($_id)
    {
        if(execute_update("UPDATE `feedback` SET `trashed`=1 WHERE `id`=".$_id))
			return true;
		else
			return false;
    }      
    
    public function setComplaintPriority($_id,$_priority)
    {
        if(execute_update("UPDATE `complaints` SET `priority`=".$_priority." WHERE `id`=".$_id))
			return true;
		else
			return false;
    }      
    
    public function setAppointmentPriority($_id,$_priority)
    {
        if(execute_update("UPDATE `appointment` SET `priority`=".$_priority." WHERE `id`=".$_id))
			return true;
		else
			return false;
    }    
    
    public function setFeedbackPriority($_id,$_priority)
    {
        if(execute_update("UPDATE `feedback` SET `priority`=".$_priority." WHERE `id`=".$_id))
			return true;
		else
			return false;
    }    
    
    public function setComplaintStatus($_id,$_status)
    {
        if(execute_update("UPDATE `complaints` SET `status`='".$_status."' WHERE `id`=".$_id))
			return true;
		else
			return false;
    }    
    
    public function setAppointmentStatus($_id,$_status)
    {
        if(execute_update("UPDATE `appointment` SET `status`='".$_status."' WHERE `id`=".$_id))
			return true;
		else
			return false;
    }    
    
    public function setFeedbackStatus($_id,$_status)
    {
        if(execute_update("UPDATE `feedback` SET `status`='".$_status."' WHERE `id`=".$_id))
			return true;
		else
			return false;
    }
    
    public function getHighPriorityTasks()
    {
        $result=execute_query("SELECT `id`,`message_id`,`type` FROM tasks WHERE `priority`=2 ORDER BY `id` DESC");
        return $result;
    } 
        
    public function getLowPriorityTasks()
    {
        $result=execute_query("SELECT `id`,`message_id`,`type` FROM tasks WHERE `priority`=1 ORDER BY `id` DESC");
        return $result;
    } 
    
    public function trashTask($_id)
    {
        if(execute_update("UPDATE `tasks` SET `priority`=-1 WHERE `id`=".$_id))
			return true;
		else
			return false;
    }
    
    public function taskDone($_id)
    {
        if(execute_update("UPDATE `tasks` SET `priority`=0 WHERE `id`=".$_id))
			return true;
		else
			return false;
    }
    
    public function setUserStatus($_user_id,$_status)
    {
        if(execute_update("UPDATE `users` SET `status`=".$_status." WHERE `id`=".$_user_id))
			return true;
		else
			return false;
    }
    
    public function addRejectedUser($_user_id,$_reason)
    {
        if(execute_update("INSERT INTO `reject_reason`(`user_id`,`reason`) VALUES(".$_user_id.",'".$_reason."')"))
			return true;
		else
			return false;
    }
    
    public function getCompletedTasks()
    {
        $result=execute_query("SELECT `id`,`message_id`,`type` FROM tasks WHERE `priority`=0 ORDER BY `id` DESC");
        return $result;
    }
    
}
/*$obj =new Admin();
$a=$obj->addRejectedUser(35,'dfghdehsherh');
echo '<hr>';
$obj->countEvents();
echo '<hr>';
$obj->countNewAppointments();
echo '<hr>';
$obj->countNewComplaints();
echo '<hr>';
$obj->countNewFeedbacks();
echo '<hr>';
$obj->countNewRegistrants();
echo '<hr>';
$obj->countNews();
echo '<hr>';
$obj->countTotalAppointments();
echo '<hr>';
$obj->countTotalComplaints();
echo '<hr>';
$obj->countTotalFeedbacks();
echo '<hr>';
$obj->countTotalUsers();
echo '<hr>';
$obj->getAccountsList(1);
echo '<hr>';
$obj->getAppointments();
echo '<hr>';
$obj->getAppointmentText(5);
echo '<hr>';
$obj->getComplaints();
echo '<hr>';
$obj->getComplaintText(35);
echo '<hr>';
$obj->getCompletedTasks();
echo '<hr>';
$obj->getEvents();
echo '<hr>';
$obj->getFeedbacks();
echo '<hr>';
$obj->getFeedbackText(5);
echo '<hr>';
$obj->getHighPriorityTasks();
echo '<hr>';
$obj->getNewRegistrants();
echo '<hr>';
$obj->getNews();
echo '<hr>';
$obj->getUserDetails(5);
echo '<hr>';
$obj->publishNewsOrEvent('DFTGSDG',date('Y-m-d H:i:s',time()),'fgdkjfgjdjd',1);
echo '<hr>';
$obj->setAppointmentPriority(3,2);
echo '<hr>';
$obj->setAppointmentStatus(3,2);
echo '<hr>';

$obj->setComplaintPriority(3,2);
echo '<hr>';

$obj->setComplaintStatus(3,2);
echo '<hr>';

$obj->setFeedbackPriority(3,2);
echo '<hr>';

$obj->setFeedbackStatus(3,2);
echo '<hr>';

$obj->setUserStatus(35,2);
echo '<hr>';

echo $obj->statusToString(2);
echo '<hr>';

$obj->taskDone(3,2);
echo '<hr>';

$obj->getLowPriorityTasks();
echo '<hr>';

$obj->getNewMessageList();
echo '<hr>';

$obj->trashAppointment(3);
echo '<hr>';
$obj->trashComplaint(3);
echo '<hr>';
$obj->trashFeedback(3);
echo '<hr>';
*/

?>