<?php
	require("classes/Admin.php");
	require("classes/User.php");
	require("classes/Complaint.php");
        require("../time_functions.php");
	session_start();
	if (!(	isset($_SESSION['admin_user_id']) and $_SESSION['admin_user_id']!= NULL)){
		header('location: index.php');	
	}	
	
	if (isset($_SESSION['admin_locked']) and $_SESSION['admin_locked']){
		header('location: extra_lock.php');	
	}
	$admin	 = new Admin();
	$admin->id=$_SESSION['admin_user_id'];
	$admin->get_admin();
?>


<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Socialize | Admin </title>
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
   <!-- BEGIN PAGE LEVEL PLUGIN STYLES --> 
   <link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
   <link href="assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
   <link href="assets/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
   <link href="assets/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
   <link href="assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css"/>
   <!-- END PAGE LEVEL PLUGIN STYLES -->
   <!-- BEGIN THEME STYLES --> 
   <link href="assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/plugins.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/pages/tasks.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
   <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/pages/profile.css" rel="stylesheet" type="text/css" />
   <!-- END THEME STYLES -->
   <link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
   <!-- BEGIN HEADER -->   
   <div class="header navbar navbar-inverse navbar-fixed-top">
      <!-- BEGIN TOP NAVIGATION BAR -->
	  <?php include 'navbar.php' ?>
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
               <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
               
               <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>
            <li class="start active ">
               <a href="index.php">
               <i class="icon-home"></i> 
               <span class="title">Home</span>
               <span class="selected"></span>
               </a>
            </li>            <li class="">
               <a href="profile.php">
               <i class="icon-user"></i> 
               <span class="title">Profile Settings</span>
               
               </a>
               
            </li>
            <li class="">
               <a href="wall_info.php">
               <i class="icon-user"></i> 
               <span class="title">Wall Information</span>
               
               </a>
               
            </li>
            <li class="">
               <a href="users.php">
               <i class="icon-group"></i> 
               <span class="title">Users</span>
               </a>
            </li>            <li class="">
               <a href="complaints.php">
               <i class="icon-cogs"></i> 
               <span class="title">Complaints</span>
               
               </a>
               
            </li>
            <li class="">
               <a href="messager.php">
               <i class="icon-cogs"></i> 
               <span class="title">Messager</span>
               
               </a>
               
            </li>
            <li class="">
               <a href="tasks.php">
               <i class="icon-tasks"></i> 
               <span class="title">Tasks</span>
               </a>
               
            </li>
            <li class="">
               <a href="self_actions.php">
               <i class="icon-sitemap"></i> 
               <span class="title">Self Actions</span>
               </a>
               
            </li>
            <li class="">
               <a href="forwarded_action.php">
               <i class="icon-signin"></i> 
               <span class="title">Forwarded Actions</span>
               </a>
               
            </li>
            <li class="">
               <a href="solved.php">
               <i class="icon-ok-sign"></i> 
               <span class="title">Solved Complaints</span>
               </a>
               
            </li>
            <li class="">
               <a href="#portlet-config" data-toggle="modal" class="config">
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
         <div class="row profile">
            <div class="col-md-12">
               <!--BEGIN TABS-->
               <div class="tabbable tabbable-custom tabbable-full-width">
                  <ul class="nav nav-tabs">
                     <li class="active"><a href="#tab_1_1" data-toggle="tab">Overview</a></li>
                     
                 </ul>
                  <div class="tab-content">
                     <div class="tab-pane active" id="tab_1_1">
                        <div class="row">
                           <div class="col-md-2">
                              <ul class="list-unstyled profile-nav">
                              <?php
							  		//printing image
									$blob= $admin->user_image;
									@$image = imagecreatefromstring($blob); 
									ob_start();
									imagejpeg($image, null, 80);
									$data = ob_get_contents();
									ob_end_clean();
									echo '<li><img src="data:image/jpg;base64,'.base64_encode($data).'" alt="" width="200" height="200" class="img-responsive" /> ';
							  ?>
                                    <a href="profile.php#tab_2-2" class="profile-edit">change</a>
                                 </li>
                                 
                             </ul>
                           </div>
                           <div class="col-md-9">
                              <div class="row">
                                 <div class="col-md-8 profile-info">
                                    <h1><?php echo($admin->fullname); ?></h1>
                                    <ul class="list-inline">
                                        <?php
                                       if(!empty($admin->email)) echo '<li><i class="icon-map-marker"></i>'.$admin->email.'</li><br/>';
                                       if(!empty($admin->voterid)) echo '<li><i class="icon-calendar"></i>'.$admin->voterid.'</li><br/>';
                                       if(!empty($admin->la_name)) echo '<li><i class="icon-briefcase"></i>'.$admin->la_name.'</li><br/>';
                                       if(!empty($admin->mob_no)) echo '<li><i class="icon-star"></i>'.$admin->mob_no.'</li><br/>';
                                       if(!empty($admin->gender)) echo '<li><i class="icon-heart"></i>'.$admin->gender.'</li><br/>';
                                       ?>
                                       <a href="profile.php" class="profile-edit">edit</a>
                                    </ul>
                                 </div>
                                 <!--end col-md-8-->
                                 <div class="col-md-4">
                                    <div class="portlet sale-summary">
                                       <div class="portlet-title">
                                          <div class="caption">Admin Summary</div>
                                          <div class="tools">
                                             <a class="reload" href="javascript:;"></a>
                                          </div>
                                       </div>
                                       <div class="portlet-body">
                                          <ul class="list-unstyled">
                                             <li>
                                                <span class="sale-info">New Complaints</span> 
                                                <span class="sale-num"><?php echo Complaint::getNewComplaintCount($admin->id);?></span>
                                             </li>
                                             <li>
                                                <span class="sale-info">New Users</span> 
                                                <span class="sale-num"><?php echo User::getNewUserCount($admin->id);?></span>
                                             </li>
                                             <li>
                                                <span class="sale-info">Complaints Solved</span> 
                                                <span class="sale-num"><?php echo Complaint::getSolvedComplaintCount($admin->id);?></span>
                                             </li>
                                            
                                         </ul>
                                       </div>
                                    </div>
                                 </div>
                                 <!--end col-md-4-->
                              </div>
                              <!--end row-->
                              
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
         <!-- END PAGE HEADER-->
         <!-- BEGIN DASHBOARD STATS -->
         
         <!-- END DASHBOARD STATS -->
     
         <div class="clearfix"></div>
         <div class="row ">
           <div class="col-md-6 col-sm-6">
              <!-- BEGIN PORTLET-->
              <div class="portlet">
                  <div class="portlet-title line">
                     <div class="caption"><i class="icon-group"></i>New Users</div>
                     <div class="tools">
                        <a href="" class="collapse"></a>
                        
                        <a href="" class="reload"></a>
                        <a href="" class="remove"></a>
                     </div>
                  </div>
                  <div class="portlet-body" id="chats">
                     <div class="scroller" style="height: 435px;" data-always-visible="1" data-rail-visible1="1">
                        <ul class="chats">
                        <?php
							$user_ids=User::getnewuserlist($admin->id);
							if ($user_ids == NULL) echo('<li class="in">No new users have registered</li>');
							foreach($user_ids as $element){
								$newuser=new User();
								$newuser->get_user($element);
								//printing image
								$blob= $newuser->user_image;
								@$image = imagecreatefromstring($blob); 
								ob_start();
								imagejpeg($image, null, 80);
								$data = ob_get_contents();
								ob_end_clean();
								echo('<li class="in">
                              <img class="avatar img-responsive" alt="" src="data:image/jpg;base64,'.base64_encode($data).'" />
                              <div class="message">
                                 <span class="arrow"></span>
                                 <span class="name">'.$newuser->fullname.'</span>
                                 <span class="datetime">joined '.time_gap($newuser->registration_time).'</span>
                                 <span class="body">
                                 '.$newuser->voterid.' 
                                 </span>
                              </div>
                           </li>');
							}

						   ?>
                           
                        </ul>
                     </div>
                     
                  </div>
               </div>
               <!-- END PORTLET-->
            </div>
            <div class="col-md-6 col-sm-6">
               <!-- BEGIN PORTLET-->
               <div class="portlet">
                  <div class="portlet-title line">
                     <div class="caption"><i class="icon-comments"></i>New Complaints</div>
                     <div class="tools">
                        <a href="" class="collapse"></a>
                        <a href="" class="reload"></a>
                        <a href="" class="remove"></a>
                     </div>
                  </div>
                  <div class="portlet-body" id="chats">
                     <div class="scroller" style="height: 435px;" data-always-visible="1" data-rail-visible1="1">
                        <ul class="chats">
                           
                           <?php
								$complaint=new Complaint(); 		
								$complaint_ids=$complaint->getNewComplaints();
								if ($complaint_ids == NULL) echo('<li class="in">No new complaints have been received</li>');
								foreach($complaint_ids as $element){
									$complaint->getComplaint($element);
									if($complaint->la_id=$admin->id)
									{
										$user_id=$complaint->user_id;
										$comp_user=new User();
										$comp_user->get_user($user_id);
										//printing image
										$blob= $comp_user->user_image;
										@$image = imagecreatefromstring($blob); 
										ob_start();
										imagejpeg($image, null, 80);
										$data = ob_get_contents();
										ob_end_clean();
										echo('<li class="out">
                              	<img class="avatar img-responsive" alt="" src="data:image/jpg;base64,'.base64_encode($data).'" />
                             	 <div class="message">
                              	   <span class="arrow"></span>
                              	   <span class="name">'.$comp_user->fullname.'</span>
                              	   <span class="datetime">'.time_gap($complaint->date_and_time).'</span>
                               	  <span class="body">
                               	  '.$complaint->text.'
                                 </span>
                             	 </div>
                          	 </li>');
									}
								}
						   ?>
                           
                        </ul>
                     </div>
                     
                  </div>
               </div>
               <!-- END PORTLET-->
            </div>
         </div>
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
   <!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
   <script src="assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
   <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
   <script src="assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
   <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
   <script src="assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
   <script src="assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
   <script src="assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
   <!-- END CORE PLUGINS -->
   <!-- BEGIN PAGE LEVEL PLUGINS -->
   <script src="assets/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>   
   <script src="assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
   <script src="assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
   <script src="assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
   <script src="assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
   <script src="assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
   <script src="assets/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>  
   <script src="assets/plugins/flot/jquery.flot.js" type="text/javascript"></script>
   <script src="assets/plugins/flot/jquery.flot.resize.js" type="text/javascript"></script>
   <script src="assets/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
   <script src="assets/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
   <script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>     
   <!--<script src="assets/plugins/gritter/js/jquery.gritter.js" type="text/javascript"></script>-->
   <!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
   <script src="assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
   <script src="assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js" type="text/javascript"></script>
   <script src="assets/plugins/jquery.sparkline.min.js" type="text/javascript"></script>  
   <!-- END PAGE LEVEL PLUGINS -->
   <!-- BEGIN PAGE LEVEL SCRIPTS -->
   <script src="assets/scripts/app.js" type="text/javascript"></script>
   <script src="assets/scripts/index.js" type="text/javascript"></script>
   <script src="assets/scripts/tasks.js" type="text/javascript"></script>        
   <!-- END PAGE LEVEL SCRIPTS -->  
   <script>
      jQuery(document).ready(function() {    
         App.init(); // initlayout and core plugins
         Index.init();
         Index.initJQVMAP(); // init index page's custom scripts
         Index.initCalendar(); // init index page's custom scripts
         Index.initCharts(); // init index page's custom scripts
         Index.initChat();
         Index.initMiniCharts();
         Index.initDashboardDaterange();
         Index.initIntro();
         Tasks.initDashboardWidget();
      });
   </script>
   <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>