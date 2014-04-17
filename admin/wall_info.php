<?php
	require("classes/User.php");
	require("classes/Complaint.php");
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
   <title>Socialize | Wall Information</title>
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
               <a href="index.php">
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
               
            </li>
            <li class="active">
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
            </li>
            <li class="">
               <a href="complaints.php">
               <i class="icon-cogs"></i> 
               <span class="title">Complaints</span>
               
               </a>
               
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
         
         <!-- END PAGE HEADER-->
         <!-- BEGIN PAGE CONTENT-->
         <div class="row">
            <div class="col-md-12">
            <div class="tabbable tabbable-custom tabbable-full-width">
            <ul class="nav nav-tabs">
                     <li class="active"><a>Wall Information Settings</a></li>
                     
                 </ul>
                 <div class="tab-content">
               <!-- BEGIN EXTRAS PORTLET-->
               <div class="portlet ">
                  
                  <div class="portlet-body form">
                     <!-- BEGIN FORM-->
                     <form class="form-horizontal form-bordered" action="functions/update_wall_info.php" method="post" enctype="multipart/form-data">
                        <div class="form-body">
                           <div class="form-group">
                              <label class="control-label col-md-3">Enter you Wall Information here !</label>
                              <div class="col-md-9">
                                  <textarea class="wysihtml5 form-control" name="message" rows="15"><?php 
                                  @$wall_text = $admin->get_wall_text();
                                  if($wall_text)
                                    echo $wall_text;
                                  ?>
                                  </textarea>
                              </div>
                           </div>
                        </div>
                         <?php
                            $wall_images=$admin->get_wall_images();
                         ?>
                        <div class="form-group last">
                              <label class="control-label col-md-3">Upload three Wall images for your profile.</label>
                              <div class="col-md-9">
                                 <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                        <?php
                                        //printing image
                                                @$image = imagecreatefromstring($wall_images['image_1']); 
                                                ob_start();
                                                imagejpeg($image, null, 80);
                                                $data = ob_get_contents();
                                                ob_end_clean();
                                                echo '<img src="data:image/jpg;base64,'.base64_encode($data).'" alt="" /> ';
                                          ?>
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                    <div>
                                       <span class="btn default btn-file">
                                       <span class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
                                       <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
                                       <input type="file" name="image_1" class="default" />
                                       </span>
                                       <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i> Remove</a>
                                    </div>
                                 </div>
                                 <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                         <?php
                                        //printing image
                                                @$image = imagecreatefromstring($wall_images['image_2']); 
                                                ob_start();
                                                imagejpeg($image, null, 80);
                                                $data = ob_get_contents();
                                                ob_end_clean();
                                                echo '<img src="data:image/jpg;base64,'.base64_encode($data).'" alt="" /> ';
                                          ?>
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                    <div>
                                       <span class="btn default btn-file">
                                       <span class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
                                       <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
                                       <input type="file" name="image_2" class="default" />
                                       </span>
                                       <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i> Remove</a>
                                    </div>
                                 </div>
                                 <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                         <?php
                                        //printing image
                                                @$image = imagecreatefromstring($wall_images['image_3']); 
                                                ob_start();
                                                imagejpeg($image, null, 80);
                                                $data = ob_get_contents();
                                                ob_end_clean();
                                                echo '<img src="data:image/jpg;base64,'.base64_encode($data).'" alt="" /> ';
                                          ?>
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                    <div>
                                       <span class="btn default btn-file">
                                       <span class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
                                       <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
                                       <input type="file" name="image_3" class="default" />
                                       </span>
                                       <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i> Remove</a>
                                    </div>
                                 </div>
                                 <span class="label label-danger">NOTE!</span>
                                 <span>
                                 Attached image thumbnail is
                                 supported in Latest Firefox, Chrome, Opera, 
                                 Safari and Internet Explorer 10 only.
                                 All images must be in JPG format and
                                 should not exceed 1 MB
                                 </span>
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
   <script src="assets/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript" ></script>
   <!-- END PAGE LEVEL PLUGINS -->
   <!-- BEGIN PAGE LEVEL SCRIPTS -->
   <script src="assets/scripts/app.js"></script>
   <script src="assets/scripts/form-components.js"></script> 
   <!-- END PAGE LEVEL SCRIPTS -->
   <script>
      jQuery(document).ready(function() {       
         // initiate layout and plugins
         App.init();
         FormComponents.init();
      });
   </script>
   <script type="text/javascript">toastr.options.positionClass="toast-bottom-full-width";</script>
   <?php
    if (isset($_GET['wall_update'])){
	        if($_GET['wall_update']==1) //Success
                {
                    echo '<script type="text/javascript">
                        toastr.success("Wall information has been updated");
                        </script>';
                }   
                else if($_GET['wall_update']==2) //Image size exceeded
                {
                    echo '<script type="text/javascript">
                        toastr.error("Image size should not exceed 1 MB");
                        </script>';
                } 
                else if($_GET['wall_update']==3) //Image format error
                {
                    echo '<script type="text/javascript">
                        toastr.error("Image format must be JPG");
                        </script>';
                }     
    }
    ?>
   <!-- BEGIN GOOGLE RECAPTCHA -->
   <script type="text/javascript">
      var RecaptchaOptions = {
         theme : 'custom',
         custom_theme_widget: 'recaptcha_widget'
      };
   </script>
   <script type="text/javascript" src="https://www.google.com/recaptcha/api/challenge?k=6LcrK9cSAAAAALEcjG9gTRPbeA0yAVsKd8sBpFpR"></script>
   <!-- END GOOGLE RECAPTCHA -->

   <!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
</html>