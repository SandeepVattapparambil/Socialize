<?php
	require("classes/User.php");
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
   <title>Socialize | Messages</title>
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
   <!-- BEGIN THEME STYLES --> 
   <link href="assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/plugins.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/pages/blog.css" rel="stylesheet" type="text/css"/>
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
            <li class=" ">
               <a href="complaints.php">
               <i class="icon-cogs"></i> 
               <span class="title">Complaints</span>
               </a>
            </li>
            <li class="active">
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
         <!-- BEGIN PAGE CONTENT-->
         <div class="row">
            <div class="col-md-12 blog-page">
               <div class="row">
                  <div class="col-md-9 col-sm-8 article-block">
                  
                  <?php if(Message::getMessageCount($user->la_id)==0)
				  		echo  '<h1 align="left"><font color="#FF0000" >Sorry No Messages Found ...</font></h1><hr>';
                        else echo  '<h1 align="left">Recent Messages</h1><hr>';?>
                     
                     
                     
<?php        
		$message= new  Message();
		$message_list=$message->getMessageList($user->la_id);
		foreach($message_list as $message_id){
			$message->getMessage($message_id);
			echo  ' <div class="row">
                        <div class="col-md-4 blog-img blog-tag-data">';
                                 
//printing image
$blob= $message->image;
@$image = imagecreatefromstring($blob); 
ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
imagejpeg($image, null, 80);
$data = ob_get_contents();
ob_end_clean();
echo '<img  src="data:image/jpg;base64,'.base64_encode($data). '" height="800" width="600" alt="image" class="img-responsive" />';
								
 
             echo  '  <ul class="list-inline">
                              <li><i class="icon-calendar"></i> <a href="#">'.$message->date_and_time.'</a></li>
                             
                           </ul>
                           
                        </div>
                        <div class="col-md-8 blog-article">
                           <h3>'.$message->head.'</h3>
                           <p>'.$message->text.'</p>
                           
                        </div>
                     </div>
                     <hr>';
		}
					 ?>
                     
                  </div>
                  <!--end col-md-9--><!--end col-md-3-->
               </div>
               
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
   <script src="assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
   <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
   <script src="assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
   <script src="assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
   <script src="assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
   <!-- END CORE PLUGINS -->
   <script src="assets/scripts/app.js"></script>      
   <script>
      jQuery(document).ready(function() {    
         App.init();
      });
   </script>
   <!-- END JAVASCRIPTS -->
</body>