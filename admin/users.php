<?php
	require("classes/User.php");
	require("classes/Admin.php");
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
   <title>Socialize | Users</title>
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
   <link href="assets/css/pages/about-us.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
   <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
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
            <li class="start">
               <a href="home_user.php">
               <i class="icon-home"></i> 
               <span class="title">Home</span>
               <span class="selected"></span>
               </a>
            </li>
            <li class="">
               <a href="profile.php">
               <i class="icon-user"></i> 
               <span class="title">Profile Settings</span>
               
               </a>
            <li class="">
               <a href="wall_info.php">
               <i class="icon-user"></i> 
               <span class="title">Wall Information</span>
               
               </a>
               
            </li>       
            </li>
            <li class="active">
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
         <div class="row"></div>
         <!-- END PAGE HEADER-->
         <!-- BEGIN PAGE CONTENT-->
         <div class="row margin-bottom-30"></div>
         <!--/row-->   
         <!-- Meer Our Team -->
          <hr><div class="headline">
            <h3><i class="glyphicon glyphicon-user">&nbsp;</i>New Users</h3>
         </div><hr>
        <div class="row thumbnails">

            	<?php
							$user_ids=User::getnewuserlist($admin->id);
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
								echo '<div class="col-md-2">
								<div class="meet-our-team">
                  				<h4>'.$newuser->fullname.'</h4>
                  				<img src="data:image/jpg;base64,'.base64_encode($data).'" alt="" class="img-responsive" width="200" height="200"/>
                  				<div class="team-info">
                    			<p>'.$newuser->fullname.'<br>'.$newuser->voterid.'<br>'.$newuser->email.'<br><br><i>'.$newuser->address.'</i><br><br>'.($newuser->sex=='M'?'Male':'Female').'<br></p>
								<input type="hidden" id="usr_id" value="'.$newuser->id.'"/>
                    			<a class="btn btn-xs green">Accept <i class="icon-plus"></i></a>
                    			<a class="btn btn-xs red">Reject <i class="icon-minus"></i></a>
                  				</div>
               					</div>
								</div>';
								}
				?>
            </div>
            <hr>
            <div class="headline">
            <h3><i class="glyphicon glyphicon-user">&nbsp;</i>Users</h3>
         </div> <hr>
         <div id="existing_users" class="row thumbnails">
         <?php
		 $user_ids=User::getuserlist($admin->id);
							foreach($user_ids as $element){
								$existinguser=new User();
								$existinguser->get_user($element);
								if($existinguser->status==0) continue; //skip new users
								//printing image
								$blob= $existinguser->user_image;
								@$image = imagecreatefromstring($blob); 
								ob_start();
								imagejpeg($image, null, 80);
								$data = ob_get_contents();
								ob_end_clean();
		 	echo '<div class="col-md-2">
               <div class="meet-our-team">
                  <h4>'.$existinguser->fullname.'</h4>
                  <img src="data:image/jpg;base64,'.base64_encode($data).'" alt="" class="img-responsive" width="200" height="200"/>
                  <div class="team-info">
                    <p>'.$existinguser->fullname.'<br>'.$existinguser->voterid.'<br><br><i>'.$existinguser->email.'<br>'.$existinguser->address.'</i></br><br>'.($existinguser->sex=='M'?'Male':'Female').'<br></p>
                    
                  </div>
               </div>
            </div>';
			}
			?>
            </div>
         <!--/thumbnails-->
         <!-- //End Meer Our Team -->        
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
   <script src="assets/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript" ></script>
   <!-- END CORE PLUGINS -->
   <script src="assets/scripts/app.js"></script>      
   <script>
      jQuery(document).ready(function() {    
         App.init();
         toastr.options.positionClass='toast-bottom-full-width';
      });
   </script>
   <script type="text/javascript">
   $('.btn').click(function () { 
   		$btn=$(this);
		$id=$btn.closest('div.col-md-2').find('#usr_id').val();
   		if($btn.attr('class')=='btn btn-xs green') //Accept button
   		{
				$.ajax({
				type: "POST",
				url: "functions/accept_user.php",
				data: { accept: "1", id: $id }
				})
				.done(function( msg ) { 
                                    $btn.closest('div.col-md-2').hide('fast');
                                    $('#existing_users').prepend(msg);  
                                    toastr.success('User has been accepted');
                        });
   		} 
		if($btn.attr('class')=='btn btn-xs red') //Reject button
   		{
				$.ajax({
				type: "POST",
				url: "functions/accept_user.php",
				data: { accept: "0", id: $id }
				})
				.done(function( msg ) { 
                                    $btn.closest('div.col-md-2').hide('fast');
                                    toastr.success('User has been rejected');
                        });
   		} 
   });
   </script>
   <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>