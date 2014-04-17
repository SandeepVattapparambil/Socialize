<?php
	require("../time_functions.php");
	require("classes/User.php");
	require("classes/Complaint.php");
	require("classes/Message.php");
	session_start();
	if (!(	isset($_SESSION['user_id']) and $_SESSION['user_id']!= NULL)){
		header('location: index.php');	
	}	
	
	if (isset($_SESSION['locked']) and $_SESSION['locked']){
		header('location: extra_lock.php');	
	}
	$user	 = new User();
	$user->id=$_SESSION['user_id'];
	$user->get_user();
?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Socialize | Complaints</title>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
   <meta name="MobileOptimized" content="320">
   <!-- BEGIN GLOBAL MANDATORY STYLES -->          
   <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
   <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
   <link href="assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
   <!-- END GLOBAL MANDATORY STYLES -->
   <!-- BEGIN PAGE LEVEL STYLES -->
   <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-fileupload/bootstrap-fileupload.css" />
   <link rel="stylesheet" type="text/css" href="assets/plugins/gritter/css/jquery.gritter.css" />
   <link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2_metro.css" />
   <link rel="stylesheet" type="text/css" href="assets/plugins/clockface/css/clockface.css" />
   <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
   <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-datepicker/css/datepicker.css" />
   <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-timepicker/compiled/timepicker.css" />
   <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-colorpicker/css/colorpicker.css" />
   <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" />
   <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css" />
   <link rel="stylesheet" type="text/css" href="assets/plugins/jquery-multi-select/css/multi-select.css" />
   <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch-metro.css"/>
   <link rel="stylesheet" type="text/css" href="assets/plugins/jquery-tags-input/jquery.tagsinput.css" />
   <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">
   <!-- END PAGE LEVEL STYLES -->
   <!-- BEGIN THEME STYLES --> 
   <link href="assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/plugins.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
   <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
   <!-- END THEME STYLES -->
   <link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
   <!-- BEGIN HEADER -->   
   <div class="header navbar navbar-inverse navbar-fixed-top">
      <!-- BEGIN TOP NAVIGATION BAR -->
      <div class="header-inner">
         <!-- BEGIN LOGO -->  
         <a class="navbar-brand" href="index.html">
<img src="assets/img/logo4.png" alt="logo" width="148" height="53" class="img-responsive" />         </a>
         </a>
         <!-- END LOGO -->
         <!-- BEGIN RESPONSIVE MENU TOGGLER --> 
         <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
         <img src="assets/img/menu-toggler.png" alt="" />
         </a> 
         <!-- END RESPONSIVE MENU TOGGLER -->
         <!-- BEGIN TOP NAVIGATION MENU -->
         <ul class="nav navbar-nav pull-right">
            <!-- BEGIN NOTIFICATION DROPDOWN -->
            
            <!-- END NOTIFICATION DROPDOWN -->
            <!-- BEGIN INBOX DROPDOWN -->
            <li class="dropdown" id="header_inbox_bar">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                  data-close-others="true">
               <i class="icon-envelope"></i>
               <?php 
			   $NewMessageCount=Message::getNewMessageCount($user->id,$user->la_id);
			   if($NewMessageCount > 0)
			   echo '<span class="badge"> '.$NewMessageCount.' </span>'; 
			   else $NewMessageCount = 'no';
			   ?>
               </a>
               <ul class="dropdown-menu extended inbox">
                  <li>
                     <p>You have <?php echo  $NewMessageCount; ?> new messages</p>
                  </li>
                  <li>
                     <ul class="dropdown-menu-list scroller" style="height: 250px;">
                        <?php            
				$message= new Message();
				$messages=Message::getLatestMessageList($user->id,$user->la_id);
				//print_r($messages); 
				
				if(Message::getNewMessageCount($user->id,$user->la_id)!=0){
				foreach($messages as $message_id){    
					$message->getMessage($message_id);
					$blob= $message->image;
					@$image = imagecreatefromstring($blob); 
					ob_start(); 
					imagejpeg($image, null, 80);
					$data = ob_get_contents();
					ob_end_clean();	
					 
					//print_r($message); 
					 				       
               		echo'  <li>  
                           <a href="message.php?a=view">
                           <span class="photo"><img src="data:image/jpg;base64,'.base64_encode($data). '" alt="assets/img/avatar1.jpg"/></span>
                           <span class="subject">
                           <span class="from"> '.$user->getMlaName().'</span>
                           <span class="time">'.$message->date_and_time.'</span>
                           </span>
                           <span class="message"><br>'.
                           $message->head
                           .'</span>  
                           </a>
                        </li>';
				}}
?>
                        
                        
                        
                     </ul>
                  </li>
                  <li class="external">   
                     <a href="inbox.html">See all messages <i class="m-icon-swapright"></i></a>
                  </li>
               </ul>
            </li>
            <!-- END INBOX DROPDOWN -->
            <!-- BEGIN TODO DROPDOWN -->
            
            <!-- END TODO DROPDOWN -->
            <!-- BEGIN USER LOGIN DROPDOWN -->
            <li class="dropdown user">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                             <?php
                                  
//printing image
$blob= $user->user_image;
$image = imagecreatefromstring($blob); 
ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
imagejpeg($image, null, 80);
$data = ob_get_contents();
ob_end_clean();
echo '<img  src="data:image/jpg;base64,'.base64_encode($data). '" height="29" width="29" class="img-rounded" />';
								?>
               <!--<img alt="" src="assets/img/avatar1_small.jpg"/>-->
               <span class="username"><?php echo $user->fullname; ?></span>
               <i class="icon-angle-down"></i>
               </a>
               <ul class="dropdown-menu">
                                    <li><a href="account_settings.php"><i class="icon-user"></i> My Profile</a>

                  </li>
                  <li class="divider"></li>
                  <li><a href="javascript:;" id="trigger_fullscreen"><i class="icon-move"></i> Full Screen</a>
                  </li>
                  <li><a href="extra_lock.php"><i class="icon-lock"></i> Lock Screen</a>
                  </li>
                  <li><a href="#portlet-config" data-toggle="modal" ><i class="icon-power-off"></i>  Log Out</a>
                  </li>
               </ul>
            </li>
            <!-- END USER LOGIN DROPDOWN -->
         </ul>
         <!-- END TOP NAVIGATION MENU -->
      </div>
      <!-- END TOP NAVIGATION BAR -->
   </div>
   <!-- END HEADER -->
   <div class="clearfix"></div>
   <!-- BEGIN CONTAINER -->
   <div class="page-container">
      <!-- BEGIN SIDEBAR -->
      <div class="page-sidebar navbar-collapse collapse">
         <!-- BEGIN SIDEBAR MENU -->        
         <ul class="page-sidebar-menu">
            <li>
               <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
               <div class="sidebar-toggler hidden-phone"></div>
               <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            </li>
            <li>
               <!-- BEGIN RESPONSIVE QUICK SEARCH FORM --><!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>
            <li class="start">
               <a href="home_user.php">
               <i class="icon-home"></i> 
               <span class="title">Dashboard</span>
               </a>
            </li>
            <li class="">
               <a href="account_settings.php">
               <i class="icon-user"></i> 
               <span class="title">Account</span>
               </a>
               
            </li>
            <li class="active">
               <a href="complaints.php">
               <i class="icon-cogs"></i> 
               <span class="title">Complaints</span>
               </a>
            </li>
            <li class="">
               <a href="message.php">
               <i class="icon-envelope"></i> 
               <span class="title">Messages</span>
               </a>
              </li>
              <li class="">
               <a href="#portlet-config" data-toggle="modal">
               <i class="icon-power-off"></i> 
               <span class="title">Log Out</span>
               </a>
              </li>
         </ul>
         <!-- END SIDEBAR MENU -->
      </div>
      <!-- END SIDEBAR -->
      <!-- BEGIN PAGE -->
      
      <div class="page-content">
 <?php      
if (isset($_SESSION['msg']) and !empty($_SESSION['msg'])){
			
		if($_SESSION['msg']=='cmp-0')	{
			echo '<div class="alert alert-success">
                        <strong>Success!</strong> The complaint has been submitted successfully.
                     </div>';
		}
		if($_SESSION['msg']=='cmp-1'){echo '<div class="alert alert-danger">
                        <strong>Error!</strong>  Sorry some system error occured, Complaint not registered.
                     </div>';}
		if($_SESSION['msg']=='cmp-2'){echo ' <div class="alert alert-danger">
                        <strong>Error!</strong> Text feild empty , Complaint not registered.
                     </div>';}
		if($_SESSION['msg']=='cmp-3'){echo '<div class="alert alert-danger">
                        <strong>Error!</strong> The Text field missing, Complaint not registered.
                     </div> ';}
		
		unset($_SESSION['msg']);
}     
		 
                         
      
?>        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->               
         <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                     <h4 class="modal-title">Log Out</h4>
                  </div>
                  <div class="modal-body">
                   Are you Sure , You want to Log out !
                  </div>
                  <div class="modal-footer">
                     <a href="functions/logout.php" type="button" class="btn green">Yes</a>
                     <a href="#" type="button" class="btn red" data-dismiss="modal">Cancel</a>
                  </div>
               </div>
               <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
         </div>
         <!-- /.modal -->
         <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
         <!-- BEGIN STYLE CUSTOMIZER --><!-- END BEGIN STYLE CUSTOMIZER -->            
         <!-- BEGIN PAGE HEADER-->   
         <div class="row"></div>
         <!-- END PAGE HEADER-->
         <!-- BEGIN PAGE CONTENT-->
         
            <div class="col-md-12">
               <!-- BEGIN EXTRAS PORTLET-->
               <div class="portlet box green">
                  <div class="portlet-title">
                     <div class="caption"><i class="icon-reorder"></i>Complaint box</div>
                     <div class="tools">
                        <a href="javascript:;" class="reload"></a>
                        <a href="javascript:;" class="remove"></a>
                     </div>
                  </div>
                  <div class="portlet-body form">
                     <!-- BEGIN FORM-->
                     <form action="functions/add_complaint.php" class="form-horizontal form-bordered" method="post">
                        <div class="form-body">
                           <div class="form-group"></div>
                           <div class="form-group"></div>
                           <div class="form-group last">
                             <div class="col-md-11">
                                <textarea class="ckeditor form-control" name="editor" rows="6"></textarea>
                                <input type="checkbox" id="private" value="0" name="private" >
                                <a href="#"><label for="private"> private </label></a>
                              </div>
                           </div>
                        </div>
                        <div class="form-actions fluid">
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green"><i class="icon-ok"></i> Submit</button>
                                    <button type="button" class="btn default">Cancel</button>                              
                                 </div>
                              </div>
                           </div>
                        </div>
                     </form>
                     <!-- END FORM-->
                  </div>
               </div><br>
               
                      <div class="clearfix"></div>
         <div class="row ">
         
         <div class="row col-md-12">
         
         
<?php         
         $complaint=new Complaint(); 		
		 $complaint_ids=$complaint->getComplaintList($user->id);
		 if(!empty($complaint_ids)){
		   echo '<div class="col-md-6 col-sm-6">
              <!-- BEGIN PORTLET-->
              <div class="portlet">
                  <div class="portlet-title line">
                     <div class="caption"><i class="icon-thumbs-up"></i>Your Complaints</div>
                     <div class="tools">
                        <a href="" class="collapse"></a>
                        <a href="" class="reload"></a>
                        <a href="" class="remove"></a>
                     </div>
                  </div>
                  <div class="portlet-body" id="chats">
                     <div class="scroller" style="height: 500px;" data-always-visible="1" data-rail-visible1="1">
                        <ul class="chats">';
                           
                           
                       
               $cmp_sl=0;     
					foreach($complaint_ids as $element){
                  		$cmp_sl++;
						$complaint->getComplaint($element);
	//printing image
$blob= $user->user_image;
@$image = imagecreatefromstring($blob); 
ob_start(); 
imagejpeg($image, null, 80);
$data = ob_get_contents();
ob_end_clean();				     
                  echo '<span class="complaint"> <li class="in">
		  &nbsp;&nbsp;&nbsp;&nbsp;'.$complaint->getFormattedComplaintStatus().'		  
					  		<img class="avatar img-responsive" src="data:image/jpg;base64,'.base64_encode($data). '" alt="assets/img/photo.jpg" />
                              <div class="message">
                                 <span class="arrow"></span>
                                 <!--<a href="#" class="name">-->'.$user->fullname.'<!--</a>-->
                                 <span class="datetime">   &nbsp;&nbsp; '.time_gap( $complaint->date_and_time).'  </span>
                                 <span class="body">
                                 '.$complaint->text.'
                                 </span>
								 <span class="text-left text-success">'.$complaint->getComplaintRatingCount(1).' Supported </span>
								 <span class="text-left text-warning">&nbsp;'.$complaint->getComplaintRatingCount(0).' Opposed </span>
                                 <button  id="flip'.$complaint->id.'" class="btn btn-xs default tooltips" data-placement="bottom" data-original-title="'.$complaint->getComplaintResponceCount().' Comments"><i class=" icon-edit"></i></button>&nbsp;
								 </div>
                           </li>';
                           
						   echo '     <div id="panel'.$complaint->id.'" style="display:none;" class="chat-form">
                           <form  class="remark-form" action="functions/add_complaint_responce.php" method="post" > 
                                <div class="input-cont"> 
                                   <input type="hidden" id="complaint_id" name="complaint_id" value="'.$complaint->id.'" />
								   <input type="hidden" name="from" value="home_user.php" />
                                   <input class="form-control" id="response_text" name="response" type="text" placeholder="Type your remarks here..." />
                                   
                                </div>
                                <div class="btn-cont"> 
                                   <span class="arrow"></span>
                                   <button type="submit" class="btn blue icn-only"><i class="icon-ok icon-white"></i></button>
                                </div>
                           </form>
                           </div>
						   ';
						   
						 echo '<div id="responce-'.$complaint->id.'" style="display:none">';  
						$responces=$complaint->getComplaintResponceList($complaint->id);
						if(!empty($responces)){
							for($a=0;!empty($responces[$a]);$a++){
						   
                     echo '    <li class="out">';
//printing image
$blob= Complaint::getComplaintResponceOwnerImage($responces[$a]['id']);
@$image = imagecreatefromstring($blob); 
ob_start(); 
imagejpeg($image, null, 80);
$data = ob_get_contents();
ob_end_clean();
echo '<img  src="data:image/jpg;base64,'.base64_encode($data). '"  class="avatar img-responsive"  alt="assets/img/admin.jpg"/>';					 
					 
					 
					 
					 
					 
                    echo '  
                              <div class="message">
                                 <span class="arrow"></span>
                                 <!--<a href="#" class="name">-->'.Complaint::getComplaintResponceOwnerName($responces[$a]['id']).'<!--</a>-->
                                 <span class="datetime">   &nbsp;&nbsp; '.time_gap( $responces[$a]['time_stamp']).'     </span>
								 <br>
								 <span class="name"> [&nbsp;'.Complaint::getComplaintResponceOwnerType($responces[$a]['id']).'&nbsp;]</span>
                                 <span class="body">'
								 .$responces[$a]['text'].
								 '</span>
                              </div>
                           </li>';
						   
						   }
                  }else
				  echo '<li class="out"></li>';
                  echo '</div></span>';

                  
					}
                      echo '  </ul>
                     </div>
                     
                  </div>
               </div>
               <!-- END PORTLET-->
            </div>';
		 }
?>            
            
            
            
            
            
            
            
            
<?php 
$complaint_ids_in_an_la=$complaint->getComplaintListPublicInAnla($user->la_id,$user->id);
if(!empty($complaint_ids_in_an_la)){
echo '			<div class="col-md-6 col-sm-6">
              <!-- BEGIN PORTLET-->
              <div class="portlet">
                  <div class="portlet-title line">
                     <div class="caption"><i class="icon-bookmark"></i>Complaints in Legislative Assembly</div>
                     <div class="tools">
                        <a href="" class="collapse"></a>
                        <a href="" class="reload"></a>
                        <a href="" class="remove"></a>
                     </div>
                  </div>
                  <div class="portlet-body" id="chats">
                     <div class="scroller" style="height: 500px;" data-always-visible="1" data-rail-visible1="1">
                        <ul class="chats">';	
						$public_cmp_sl=0;					
						foreach($complaint_ids_in_an_la as $element){
						$public_cmp_sl++;
						$complaint->getComplaint($element);
						$rate=$complaint->checkComplaintRating($user->id);
							//printing image
$blob= Complaint::getComplaintOwnerImage($complaint->id);
@$image = imagecreatefromstring($blob); 
ob_start(); 
imagejpeg($image, null, 80);
$data = ob_get_contents();
ob_end_clean();				     
                  echo ' <span class="complaint">
				  <li class="in">
				  &nbsp;&nbsp;&nbsp;&nbsp;'.$complaint->getFormattedComplaintStatus().'
					  		<img class="avatar img-responsive" src="data:image/jpg;base64,'.base64_encode($data). '" alt="assets/img/photo.jpg" />
                          
                              
                              <div class="message" id="flip3">
                                 <span class="arrow"></span>
                                 <!--<a href="#" class="name">-->'.Complaint::getComplaintOwnerName($complaint->id).'<!--</a>-->
                                 <span class="datetime">   &nbsp;&nbsp; '.time_gap( $complaint->date_and_time).'  </span>
                                 <span class="body">
                                 '.$complaint->text.' 
                                 </span>
								 <span>
								 <span class="text-left text-success" id="support_count">';
					if($rate==1) {
						if($complaint->getComplaintRatingCount(1)<=1)
							echo ' You supported ';
						else
							echo 'you ,and '. ($complaint->getComplaintRatingCount(1)-1) .' others supported';
					}
					else {
						if($complaint->getComplaintRatingCount(1)<=0)
							{ echo ' No one Supported '; }
						else
							echo $complaint->getComplaintRatingCount(1) .' others Supported';
					}
					echo '</span>&nbsp;';		
echo '  <button class="btn btn-xs default tooltips"  id="'.$complaint->id.'"  data-placement="bottom" data-original-title="Support"><i class=" icon-thumbs-up"></i></button>&nbsp;';
					echo '<span class="text-left text-warning" id="oppose_count">';
					if($rate==0) {
						if($complaint->getComplaintRatingCount(0)<=1)
							echo ' You Opposed ';
						else
							echo ' You ,and '.($complaint->getComplaintRatingCount(0)-1) .' others Opposed';
					}
					else {
						if($complaint->getComplaintRatingCount(0)<=0)
							{ echo ' No one Opposed '; }
						else
							echo $complaint->getComplaintRatingCount(0) .' others Opposed';
					}
					
					echo '</span>';
 
	echo '  <button class="btn btn-xs default tooltips"  id="'.$complaint->id.'"  data-placement="bottom" data-original-title="Oppose"><i class=" icon-thumbs-down"></i></button>&nbsp;';							
					echo '</span>';
	echo '     <button  id="flip'.$complaint->id.'" class="btn btn-xs default tooltips" data-placement="bottom" data-original-title="'.$complaint->getComplaintResponceCount().' Comments"><i class=" icon-edit"></i></button>&nbsp
					</div>
                           </li>';
						   
						   echo ' <div id="panel'.$complaint->id.'" style="display:none;" class="chat-form">
                           <form  class="remark-form" action="functions/add_complaint_responce.php" method="post"> 
                                <div class="input-cont"> 
                                   <input type="hidden" name="complaint_id" id="complaint_id" value="'.$complaint->id.'" />
								   <input type="hidden" name="from" value="home_user.php" />
                         		   <input type="text" id="response_text"   name="response" class="form-control" placeholder="Type your remarks here..." />
							  	</div>
							<div class="btn-cont"> 
							   <span class="arrow"></span>
							   <button type="submit" class="btn blue icn-only"><i class="icon-ok icon-white"></i></button>
							</div>
							</form>
                     </div>';
						     echo '<div id="responce-'.$complaint->id.'" style="display:none">';
					 		 $responces=$complaint->getComplaintResponceList($complaint->id);
						     if(!empty($responces)){
							 for($a=0;!empty($responces[$a]);$a++){
                      echo '<li class="out">';
					  //printing image
$blob= Complaint::getComplaintResponceOwnerImage($responces[$a]['id']);
@$image = imagecreatefromstring($blob); 
ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
imagejpeg($image, null, 80);
$data = ob_get_contents();
ob_end_clean();
echo '<img  src="data:image/jpg;base64,'.base64_encode($data). '"  class="avatar img-responsive"  alt="assets/img/admin.jpg"/>';					 
					 
					 
					 
                              
                              echo '<div class="message">
                                 <span class="arrow"></span>
                                 <!--<a href="#" class="name">-->'.Complaint::getComplaintResponceOwnerName($responces[$a]['id']).'<!--</a>-->
                                 <span class="datetime">   &nbsp;&nbsp; '.time_gap( $responces[$a]['time_stamp']).'    </span>
								 <br>
								 <span class="name"> [&nbsp;'.Complaint::getComplaintResponceOwnerType($responces[$a]['id']).'&nbsp;]</span>
                                 <span class="body">'
								 .$responces[$a]['text'].
								 '</span>
                              </div>
                           </li>';
						}
						}else
				  echo '<li class="out"></li>';
                    echo '</div> </span>';
						}
              echo '   </ul>
                     </div>
                     
                  </div>
               </div>
               <!-- END PORTLET-->
            </div>';
}
			
            ?>
            
            
            
            
            
         </div>
      </div>
                            
                        
                            
               <!-- END EXTRAS PORTLET-->
            </div>
            
         </div>
         
         <!-- END PAGE CONTENT-->   
      </div>
      <!-- END PAGE -->  
   </div>
   <!-- END CONTAINER -->
   <!-- BEGIN FOOTER -->
   <div class="footer">
      <div class="footer-inner">
         2013 &copy; Socialize.
      </div>
      <div class="footer-tools">
         <span class="go-top">
         <i class="icon-angle-up"></i>
         </span>
      </div>
   </div>
   <!-- END FOOTER -->
   <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
   <!-- BEGIN CORE PLUGINS -->   
   <!--[if lt IE 9]>
   <script src="assets/plugins/respond.min.js"></script>
   <script src="assets/plugins/excanvas.min.js"></script> 
   <![endif]-->   
   <script src="assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
   <script src="assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>     
   <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
   <script src="assets/plugins/bootstrap/js/bootstrap2-typeahead.min.js" type="text/javascript"></script>
   <script src="assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
   <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
   <script src="assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
   <script src="assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
   <script src="assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
   <!-- END CORE PLUGINS -->
   <!-- BEGIN PAGE LEVEL PLUGINS -->
   <script type="text/javascript" src="assets/plugins/fuelux/js/spinner.min.js"></script>
   <script type="text/javascript" src="assets/plugins/ckeditor/ckeditor.js"></script>  
   <script type="text/javascript" src="assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>
   <script type="text/javascript" src="assets/plugins/select2/select2.min.js"></script>
   <script type="text/javascript" src="assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script> 
   <script type="text/javascript" src="assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
   <script type="text/javascript" src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   <script type="text/javascript" src="assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
   <script type="text/javascript" src="assets/plugins/clockface/js/clockface.js"></script>
   <script type="text/javascript" src="assets/plugins/bootstrap-daterangepicker/moment.min.js"></script>
   <script type="text/javascript" src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script> 
   <script type="text/javascript" src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>  
   <script type="text/javascript" src="assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
   <script type="text/javascript" src="assets/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>   
   <script type="text/javascript" src="assets/plugins/jquery.input-ip-address-control-1.0.min.js"></script>
   <script type="text/javascript" src="assets/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
   <script type="text/javascript" src="assets/plugins/jquery-multi-select/js/jquery.quicksearch.js"></script>   
   <script src="assets/plugins/jquery.pwstrength.bootstrap/src/pwstrength.js" type="text/javascript" ></script>
   <script src="assets/plugins/bootstrap-switch/static/js/bootstrap-switch.min.js" type="text/javascript" ></script>
   <script src="assets/plugins/jquery-tags-input/jquery.tagsinput.min.js" type="text/javascript" ></script>
   <script src="assets/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript" ></script>
   <script src="assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript" ></script>
   <!-- END PAGE LEVEL PLUGINS -->
   <!-- BEGIN PAGE LEVEL SCRIPTS -->
   <script src="assets/scripts/app.js"></script>
   <script src="assets/scripts/form-components.js"></script>     
    <script type="text/javascript" src="assets/plugins/holder.js"></script>
   <!-- END PAGE LEVEL SCRIPTS -->
   <script>
      jQuery(document).ready(function() {       
         // initiate layout and plugins
         App.init();
         FormComponents.init();
      });
   </script>

   <!-- BEGIN GOOGLE RECAPTCHA -->
   <script type="text/javascript">
      var RecaptchaOptions = {
         theme : 'custom',
         custom_theme_widget: 'recaptcha_widget'
      };
   </script>
 <?php
 	if(isset($complaint_ids)){
      foreach($complaint_ids as $cmp_id){
      echo '<script> 
                  $(document).ready(function(){
                    $("#flip'.$cmp_id.'").click(function(){
                      $("#panel'.$cmp_id.'").slideToggle("fast");
					  $("#responce-'.$cmp_id.'").slideToggle("slow");
                    });
                  });
                  </script>';
	   
      }
	 }
 ?> 
 <?php
 	if(isset($complaint_ids_in_an_la)){
      foreach($complaint_ids_in_an_la as $cmp_id){
      	echo '<script> 
                  $(document).ready(function(){
                    $("#flip'.$cmp_id.'").click(function(){
                      $("#panel'.$cmp_id.'").slideToggle("fast");
					  $("#responce-'.$cmp_id.'").slideToggle("slow");
                    });
                  });
                  </script>';
        
      }
	}
 ?>  
 <script >
 $('.btn').click(function () {//alert('ggg');
		$btn=$(this); 
   		if($btn.html().match('icon-thumbs-down')) //vote down button
   		{
   			$complaint_id=$btn.attr('id');
   			$.ajax({
			type: "POST",
			url: "functions/add_complaint_rating_ajax.php",
			data: { complaint_id: $complaint_id , support : 0}
			})
			.done(function( msg ) { 
				if(msg=="error"){}
				else{
					var arr = msg.split('/');
					$btn.parent().find('#oppose_count.text-left').html(arr[1]); 
					$btn.parent().find('#support_count.text-left').html(arr[0]);	
				}				
				});
   		}
        if($btn.html().match('icon-thumbs-up')) //vote up button
   		{
   			$complaint_id=$btn.attr('id');
   			$.ajax({
			type: "POST",
			url: "functions/add_complaint_rating_ajax.php",
			data: { complaint_id: $complaint_id ,support : 1}
			})
			.done(function( msg ) { 
				if(msg=="error"){}
				else{
					var arr = msg.split('/');
					$btn.parent().find('#oppose_count.text-left').html(arr[1]); 
					$btn.parent().find('#support_count.text-left').html(arr[0]);	
				}
				});
   		}               
   });
 $('.remark-form').submit (function(event) { 
       event.preventDefault();
       $form=$(this);
       $complaint_id=$form.find('#complaint_id').val();
       $response_text=$form.find('#response_text').val();
	   
	   $.ajax({
				type: "POST",
				url: "functions/complaint_response.php",
				data: { complaint_id: $complaint_id, response_text:$response_text }
				})
				.done(function( msg ) { 
                                    $form.closest('span.complaint').find('#response_text').val('');
                                    $form.closest('span.complaint').find('li.out').first('li').prepend(msg);
                                    });
 
       
   });
</script> 
   <script type="text/javascript" src="https://www.google.com/recaptcha/api/challenge?k=6LcrK9cSAAAAALEcjG9gTRPbeA0yAVsKd8sBpFpR"></script>
   <!-- END GOOGLE RECAPTCHA -->

   <!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
</html>