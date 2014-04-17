
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
   <title>Socialize | Home</title>
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
   <!-- END PAGE LEVEL STYLES -->
   <!-- BEGIN THEME STYLES --> 
   <link href="assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/plugins.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
   <link href="assets/css/pages/profile.css" rel="stylesheet" type="text/css" />
   <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/pages/news.css" rel="stylesheet" type="text/css"/>
   <link href="assets/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css"/>

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
                           <span class="time">'.time_gap( $message->date_and_time).'  </span>
                           </span>
                           <span class="message"><br>'.
                           $message->head
                           .'</span>  
                           </a>
                        </li>';
				}
				}
?>                        
                        
                     </ul>
                  </li>
                  <li class="external">   
                     <a href="message.php">See all messages <i class="m-icon-swapright"></i></a>
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
@$image = imagecreatefromstring($blob); 
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
            <li class="start active">
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
            <li class=" ">
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
         <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->               
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
 <?php      
if (isset($_SESSION['msg']) and !empty($_SESSION['msg'])){
			
		if($_SESSION['msg']==3)	{echo ' <div class="alert alert-warning">
                        <strong>Warning!</strong> invalid image </div>';}
		if($_SESSION['msg']==40){echo '<div class="alert alert-warning">
                        <strong>Warning!</strong>  upload faild </div>';}
		if($_SESSION['msg']==41){echo ' <div class="alert alert-warning">
                        <strong>Warning!</strong> image size should be less than 200kb </div>';}
		if($_SESSION['msg']==42){echo ' <div class="alert alert-warning">
                        <strong>Warning!</strong> image format should be jpg / jpeg </div>';}
		if($_SESSION['msg']==5)	{echo ' <div class="alert alert-warning">
                        <strong>Warning!</strong> error in image upload </div>';}
		if($_SESSION['msg']==6)	{echo ' <div class="alert alert-warning">
                        <strong>Warning!</strong> image file missing </div>';}
		
		unset($_SESSION['msg']);
}     
		 
                         
      
?>       
                           
         <!-- BEGIN PAGE CONTENT-->
         <!-- BEGIN ADMIN INFORMATION CONTENT-->
 <?php
 $query="SELECT * FROM `admin_wall` WHERE `admin_id`=$user->la_id order by `time _stamp` DESC limit 1";
 $wall=execute_query($query);
 if($wall){
 $wall=$wall[0];
 ?>
         <div class="row">
         <div class="col-md-5">
                     <div id="myCarousel" class="carousel image-carousel slide">
                        <div class="carousel-inner">
                           <?php 
						   if(isset($wall['image_1']) and !empty($wall['image_1'])){
						   $blob= $wall['image_1'];
						   $image = imagecreatefromstring($blob); 
						   ob_start(); 
						   imagejpeg($image, null, 80);
						   $data = ob_get_contents();
						   ob_end_clean();
						   echo '<div class="active item">
                              <img src="data:image/jpg;base64,' .  base64_encode($data)  . '" class="img-responsive" height="100" alt="">
                              <div class="carousel-caption">
                                 <h4 style="color:#0CC">'.$wall["image1_des"].'</h4>
                              </div>
                           </div>';}?>
                           
                           <?php 
						   if(isset($wall['image_2']) and !empty($wall['image_2'])){
						   $blob= $wall['image_2'];
						   $image = imagecreatefromstring($blob); 
						   ob_start(); 
						   imagejpeg($image, null, 80);
						   $data = ob_get_contents();
						   ob_end_clean();
						   echo '<div class="item">
                              <img src="data:image/jpg;base64,' .  base64_encode($data)  . '" class="img-responsive" alt="">
                              <div class="carousel-caption">
                                 <h4 style="color:#0CC">'.$wall["image2_des"].'</h4>                                
                              </div>
                           </div>';}?>
                           
                           <?php 
						   if(isset($wall['image_3']) and !empty($wall['image_3'])){
						   $blob= $wall['image_3'];
						   $image = imagecreatefromstring($blob); 
						   ob_start(); 
						   imagejpeg($image, null, 80);
						   $data = ob_get_contents();
						   ob_end_clean();
						   echo '<div class="item">
                              <img src="data:image/jpg;base64,' .  base64_encode($data)  . '" class="img-responsive" alt="">
                              <div class="carousel-caption">
                                 <h4 style="color:#0CC">'.$wall["image3_des"].'</h4>
                              </div>
                           </div>';}?>
                        </div>
                        <!-- Carousel nav -->
                        <a class="carousel-control left" href="#myCarousel" data-slide="prev">
                        <i class="m-icon-big-swapleft m-icon-white"></i>
                        </a>
                        <a class="carousel-control right" href="#myCarousel" data-slide="next">
                        <i class="m-icon-big-swapright m-icon-white"></i>
                        </a>
                        <ol class="carousel-indicators">
                           <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                           <li data-target="#myCarousel" data-slide-to="1"></li>
                           <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>
                     </div>
                   
                  </div>
                  <div class="col-md-7">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="news-blocks">
                              <h3><a>Welcome to Socialize.</a></h3>
                              <div class="news-block-tags">
                              <ul class="chats">
                           <li class="in">
                           <?php
                           $blob= $user->getMlaImage();
						   $image = imagecreatefromstring($blob); 
						   ob_start(); 
						   imagejpeg($image, null, 80);
						   $data = ob_get_contents();
						   ob_end_clean();
						   echo '<img class="avatar img-responsive" style="margin-top:10px;" alt="" src="data:image/jpg;base64,' .  base64_encode($data)  . '" /> ';?>
                           
                              
                              </li>
                              </ul>
                                 <strong>
								 <?php echo '<b>'.$user->getMlaName()."</b> Welcomes you to Socialize.";?></strong>
                                 <p>(mla of <b> <?php echo $user->get_la_name($user->la_id);?></b> legislative assembly)</p>
                              </div>
                              
                              <p><?php echo $wall['message'];?> </p>
                              <!--<a href="#" class="btn btn-lg default">
                                <i class="icon-thumbs-up">&nbsp;Support</i>
                            </a>-->
                            <!--<a href="#" class="btn btn-lg default">
                                <i class="icon-thumbs-down">&nbsp;Oppose</i>
                            </a>-->
                           </div>
                        </div>
                     </div>
                     
                  </div>
         </div>
         
         <br>
         <?php }?>
          <!-- END ADMIN INFORMATION CONTENT-->
         <div class="row profile">
            <div class="col-md-12">
               <!--BEGIN TABS-->
               <div class="tabbable tabbable-custom tabbable-full-width">
                  
                  <div class="tab-content">
                     <div class="tab-pane active" id="tab_1_1">
                        <div class="row">
                           <div class="col-md-2">
                              <ul class="list-unstyled profile-nav">
                                 <li>
                                 
                                 <?php
                                  
//printing image
$blob= $user->user_image;
@$image = imagecreatefromstring($blob); 
ob_start(); 
imagejpeg($image, null, 80);
$data = ob_get_contents();
ob_end_clean();
echo '<img class="img-responsive" src="data:image/jpg;base64,'.base64_encode($data). '" alt="assets/img/profile/profile.jpg" height="200" width="200"/>';
								?>
                                 
                                 <!--<img src="assets/img/profile/profile-img.png" class="img-responsive" alt="" />--> 
                                 
                                 
                                 
                                    <a href="account_settings.php#img" class="profile-edit">edit</a>
                                 </li>
                                 
                              </ul>
                           </div>
                           <div class="col-md-9">
                              <div class="row">
                                 <div class="col-md-4 profile-info">
                                    <h1><?php echo $user->fullname; ?></h1>
                                    
                                    <ul class="list-inline">
                                       <li><i class="icon-envelope"></i> <?php echo $user->email; ?></li><br>
                                       <li><i class="icon-user"></i> <?php echo $user->voterid; ?></li><br>
                                       <li><i class="icon-map-marker"></i> <?php echo $user->la_name; ?></li><br>
                                       <li><i class="icon-bullhorn"></i> <?php echo $user->mob_no; ?></li><br>
                                       <li><i class="icon-group"></i> <?php echo $user->sex; ?></li><br>
                                    </ul>
                                 </div>
                                 <!--end col-md-8-->
                                 <div class="col-md-4">
                                    <div class="portlet sale-summary">
                                       <div class="portlet-title">
                                          <div class="caption">User Summary</div>
                                          <div class="tools">
                                             <a class="reload" href="javascript:;"></a>
                                          </div>
                                       </div>
                                       <div class="portlet-body">
                                          <ul class="list-unstyled">
                                             <li>
                                                <span class="sale-info">Complaints <i class="icon-img-up"></i></span> 
                                                <span class="sale-num">
                                                <?php echo $user->get_complaint_count(); ?>
                                                </span>
                                             </li>
                                             <li>
                                                <span class="sale-info">feeds recieved <i class="icon-img-down"></i></span> 
                                                <span class="sale-num">
                                                <?php echo $user->get_responce_count(); ?>
                                                </span>
                                             </li>
                                             
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                                 <!--end col-md-4-->
                              </div>
                              <!--end row-->
                              
                           </div>
                           
                           
                           
                           
                           
                           
                           
                          
         <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->               
         
         <!-- /.modal -->
         <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
         <!-- BEGIN STYLE CUSTOMIZER --><!-- END BEGIN STYLE CUSTOMIZER -->  
         <!-- BEGIN PAGE HEADER-->
         
         <!-- END PAGE HEADER-->
         <!-- BEGIN DASHBOARD STATS -->
         
         <!-- END DASHBOARD STATS -->
     
        <div class="clearfix"></div>
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
                     </div>
                     <!--tab_1_2-->
                     
                     <!--end tab-pane-->
                     
                     <!--end tab-pane-->
                     
                     <!--end tab-pane-->
                  </div>
               </div>
               <!--END TABS-->
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
         2013 &copy; Socialize
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
   <script src="assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
   <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
   <script src="assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
   <script src="assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
   <script src="assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
   <script src="assets/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript" ></script>
   <!-- END CORE PLUGINS -->
   <!-- BEGIN PAGE LEVEL PLUGINS -->
   <script type="text/javascript" src="assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>
   <!-- END PAGE LEVEL PLUGINS -->
   <!-- BEGIN PAGE LEVEL SCRIPTS -->
   <script src="assets/scripts/app.js"></script>      
   <!-- END PAGE LEVEL SCRIPTS -->
   <script>
      jQuery(document).ready(function() {       
         // initiate layout and plugins
         App.init();
      });
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
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>