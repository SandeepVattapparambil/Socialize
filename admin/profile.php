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
   <title>Socialize | Profile</title>
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
            <li class="active">
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
         <div class="row"></div>
         <!-- END PAGE HEADER-->
         <!-- BEGIN PAGE CONTENT-->
         <div class="row profile">
            <div class="col-md-12">
               <!--BEGIN TABS-->
               <div class="tabbable tabbable-custom tabbable-full-width">
                  <ul class="nav nav-tabs">
                     <li class="active"><a href="#tab_1_3" data-toggle="tab">Profile Settings</a></li>
                  </ul>
                  <div class="tab-content">
                     
                     <!--tab_1_2-->
                     <div class="tab-pane active" id="tab_1_3">
                        <div class="row profile-account">
                           <div class="col-md-3">
                              <ul class="ver-inline-menu tabbable margin-bottom-10">
                                 <li class="active">
                                    <a data-toggle="tab" href="#tab_1-1">
                                    <i class="icon-cog"></i> 
                                    Personal info
                                    </a> 
                                    <span class="after"></span>                                    
                                 </li>
                                 <li ><a data-toggle="tab" href="#tab_2-2"><i class="icon-picture"></i> Change Profile Picture</a></li>
                                 <li ><a data-toggle="tab" href="#tab_3-3"><i class="icon-lock"></i> Change Password</a></li>
                              </ul>
                           </div>
                           <div class="col-md-9">
                              <div class="tab-content">
                                 <div id="tab_1-1" class="tab-pane active">
                                    <form name="edit_form" role="form" action="functions/profile_edit.php" method="post">
                                       <div class="form-group">
                                          <label class="control-label">Name</label>
                                          <input name="name" type="text" placeholder="Name" class="form-control" value="<?php echo $admin->fullname;?>" />
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label">Mobile Number</label>
                                          <input name="mobile" type="text" placeholder="Mobile Number" class="form-control"  value="<?php echo $admin->mob_no;?>"/>
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label">Email ID</label>
                                          <input name="email" type="text" placeholder="someone@something.com" class="form-control" value="<?php echo $admin->email;?>" />
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label">Address</label>
                                          <textarea name="address" class="form-control" rows="3" placeholder="address"><?php echo $admin->address;?></textarea>
                                       </div>
                                       
                                       <div class="margiv-top-10">
                                             <button type="submit" class="btn green"><i class="icon-ok"></i> Submit</button>
                                             <button type="button" class="btn default">Cancel</button>
                                       </div>
                                    </form>
                                     <br>
                                        <div class="text-danger" id="el" ></div>
                                 </div>
                                 <div id="tab_2-2" class="tab-pane">
                                   
                                    <form action="functions/profile_pic_change.php" method="post" enctype="multipart/form-data"  role="form">
                                     <div class="form-body">
                                       <div class="form-group last">
                              <div class="col-md-9">
                                 <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                   <?php     
                                     //printing image
                                    $blob= $admin->user_image;
                                    @$image = imagecreatefromstring($blob); 
                                    ob_start();
                                    imagejpeg($image, null, 80);
                                    $data = ob_get_contents();
                                    ob_end_clean();
                                    echo '<img alt="" src="data:image/jpg;base64,'.base64_encode($data).'" />';
                                    ?>
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                    <div>
                                       <span class="btn default btn-file">
                                       <span class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
                                       <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
                                       <input type="file" name="image" class="default" />
                                       </span>
                                       <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i> Remove</a>
                                    </div>
                                 </div>
                                 
                                 
                                 <span class="label label-danger">NOTE!</span>
                                 <span>
                                 Attached image thumbnail is
                                 supported in Latest Firefox, Chrome, Opera, 
                                 Safari and Internet Explorer 10 only
                                 </span>
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
                                       </div>

                                     </div>

                                    </form>
                                 </div>
                                 <div id="tab_3-3" class="tab-pane">
                                    <form name="pass_form" action="functions/update_password.php" method="post">
                                       <div class="form-group">
                                          <label class="control-label">Current Password</label>
                                          <input name="current_password" id="current_password" type="password" class="form-control" />
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label">New Password</label>
                                          <input name="new_password" id="new_password" type="password" class="form-control" />
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label">Re-type New Password</label>
                                          <input id="retype_password" type="password" class="form-control" />
                                       </div>
                                       <div class="margin-top-10">
                                          <button type="submit" class="btn green">Change Password</button>
                                          <button class="btn default">Cancel</button>
                                       </div>
                                    </form>
                                     <br>
                                     <div class="text-danger" id="el2" ></div>
                                 </div>
                                 
                              </div>
                           </div>
                           <!--end col-md-9-->                                   
                        </div>
                     </div>
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
   <script src="assets/plugins/validate/validate.min.js" type="text/javascript" ></script>
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
   <script type="text/javascript">toastr.options.positionClass="toast-bottom-full-width";</script>
   <?php
if (isset($_SESSION['profile_update'])){
	        if($_SESSION['profile_update']==1) //Success
                {
                    echo '<script type="text/javascript">
                        toastr.success("Profile has been updated");
                        </script>';
                    unset($_SESSION['profile_update']);
                }                
}  

if (isset($_SESSION['pass_update'])){
	        if($_SESSION['pass_update']==1) //Success
                {
                    echo '<script type="text/javascript">
                        toastr.success("Password has been updated");
                        </script>';
                }
                if($_SESSION['pass_update']==0) //Failed
                {
                    echo '<script type="text/javascript">
                        toastr.error("Password update failed");
                        </script>';
                }
                unset($_SESSION['pass_update']);
}  
?> 
   
 <script type="text/javascript">
           var validator = new FormValidator('edit_form', [{
            name: 'name',   
            rules: 'required'
        }, {
            name: 'mobile',
            rules: 'required|numeric|min_length[10]|max_length[10]'
        }, {
            name: 'email',
            rules: 'required|valid_email'
        }], function(errors, event) {
            if (errors.length > 0) {
                    var errorString = '';

                    for (var i = 0, errorLength = errors.length; i < errorLength; i++) {
                        errorString += errors[i].message + '<br />';
                    }
                    document.getElementById('el').innerHTML = errorString;
                    event.returnValue = false;
    }
            
        });
        
            var validator2 = new FormValidator('pass_form', [{
            name: 'current_password',
            display:'current password',
            rules: 'required'
        }, {
            name: 'new_password',
            display:'new password',
            rules: 'required'
        }, {
            name: 'retype_password',
            display:'retype password',
            rules: 'required|matches[new_password]'
        }], function(errors, event) {
            if (errors.length > 0) {
                    var errorString = '';

                    for (var i = 0, errorLength = errors.length; i < errorLength; i++) {
                        errorString += errors[i].message + '<br />';
                    }
                    document.getElementById('el2').innerHTML = errorString;
                    event.returnValue = false;
    }
            
        });
 </script>
   <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>