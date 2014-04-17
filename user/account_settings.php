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
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.0
Version: 1.5.2
Author: KeenThemes
Website: http://www.keenthemes.com/
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Socialize | Accounts</title>
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

   <link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2_metro.css" />
   <!-- END PAGE LEVEL SCRIPTS -->
   <!-- BEGIN THEME STYLES --> 
   <link href="assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-datepicker/css/datepicker.css" />
   <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-timepicker/compiled/timepicker.css" />
   <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-colorpicker/css/colorpicker.css" />
   <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" />
   <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css" />   <link href="assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
   <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
   <!-- END THEME STYLES -->
   <link rel="shortcut icon" href="favicon.ico" />
   <link href="SpryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
   <link href="SpryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
   <link href="SpryAssets/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">
<script src="SpryAssets/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="SpryAssets/jquery-ui-1.9.2.datepicker.custom.min.js" type="text/javascript"></script>
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
            <li class="start">
               <a href="home_user.php">
               <i class="icon-home"></i> 
               <span class="title">Dashboard</span>
               </a>
            </li>
            <li class="active">
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
<?php      
if (isset($_SESSION['msg']) and !empty($_SESSION['msg'])){
		echo ('<div class="alert alert-danger">
                        <strong>Error!</strong>');	
		if($_SESSION['msg']==1){echo 'missing fields';}
		if($_SESSION['msg']==2){echo 'empty fields';}
		echo ('</div>');
		unset($_SESSION['msg']);
}     
      
  					 
                         
      
?>     
      
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
         <div class="row ">
         <div class="tab-pane col-md-10"  id="tab_7">
                        <div class="portlet box blue ">
                           <div class="portlet-title">
                              <div class="caption"><i class="icon-reorder"></i>User Account - Settings</div>
                              <div class="tools">
                                <a href="javascript:;" class="reload"></a>
                                 <a href="javascript:;" class="remove"></a>
                              </div>
                           </div>
                           <div class="portlet-body form">
                              <!-- BEGIN FORM-->
                              <form name="edit_form" action="functions/profile_edit.php" class="form-horizontal form-bordered form-label-stripped" method="post" enctype="multipart/form-data">
                                 <div class="form-body">
                                    <div class="form-group">
                                       <label class="control-label col-md-3">Name</label>
                                       <div class="col-md-9">
                                          <input type="text" placeholder="user's name" name="name"  class="form-control" value="<?php echo $user->fullname; ?>"/>
                                          <span class="help-block"></span>
                                       </div>
                                    </div>
                                    
                                    <div class="form-group">
                                       <label class="control-label col-md-3">Gender</label>
                                       <div class="col-md-9">
                                          <select name="gender"  class="form-control">
                                             <?php if($user->sex=='N'){echo '<option selected value="N">Select</option>';} ?> 
                                             <option <?php if($user->sex=='M'){echo 'selected';} ?> value="M">Male</option>
                                             <option <?php if($user->sex=='F'){echo 'selected';} ?> value="F">Female</option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <label class="control-label col-md-3">Date of Birth</label>
                                       <div class="col-md-9">
           
            <input type="text" class="form-control form-control-inline" id="Datepicker1" placeholder="dd/mm/yyyy" value="<?php if($user->date_of_birth!='1900-01-01')echo $user->date_of_birth;else echo 'UNDEFINED';?>">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                       <label class="control-label col-md-3">Legislative Aassembly</label>
                                       <div class="col-md-9">
                                          <input type="text" placeholder="user's Legislative Assembly" readonly class="form-control" value="<?php echo $user->get_la_name($user->la_id); ?>" />
                                          <span class="help-block"></span>
                                       </div>
                                    </div>
                                    
                                    <div class="form-group">
                                       <label class="control-label col-md-3">Voters ID</label>
                                       <div class="col-md-9">
                                          <input type="text" placeholder="user's Voters ID" readonly class="form-control" value="<?php echo $user->voterid; ?>" />
                                          <span class="help-block"></span>
                                       </div>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                       <label class="control-label col-md-3">Mobile Number</label>
                                       <div class="col-md-9">
                                         <?php if($user->mob_no!=0)
										 echo  '<input type="text" class="form-control" name="mobile" value="'.$user->mob_no.'">';
										 else echo '<input type="text" class="form-control" name="mobile" placeholder="UNDEFINED">';							  										 ?>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <label class="control-label col-md-3">Address</label>
                                       <div class="col-md-9">
                                          <input type="textarea" name="address" class="form-control" value="<?php if($user->address!='address')
										  														echo $user->address;
										  														else echo 'UNDEFINED'; 
										  
										  
										  ?>"> 
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <label class="control-label col-md-3">E-Mail ID</label>
                                       <div class="col-md-9">
                                          <input type="text"  class="form-control" readonly value="<?php echo $user->email; ?>"> 
                                       </div>
                                    </div>
                                    
                                    <div id="img" class="form-group last">
                                       <label class="control-label col-md-3">Profile Picture </label>
                                       <div class="col-md-9">
                                 <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 150px; height: 150px;">
                                       <?php
                                  
//printing image
$blob= $user->user_image;
@$image = imagecreatefromstring($blob); ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
imagejpeg($image, null, 80);
$data = ob_get_contents();
ob_end_clean();
echo '<img  src="data:image/jpg;base64,'.base64_encode($data). '" height="200" width="200" class="img-rounded" />';
								?>
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 150px; max-height: 150px; line-height: 20px;"></div>
                                    <div>
                                       <span class="btn default btn-file">
                                       <span class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
                                       <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
                                       <input type="file" class="default" name="profile_pic" id="profile_pic" />
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
                              <br>
                                <div class="text-danger" id="el" ></div>
                              <!-- END FORM-->  
                           </div>
                        </div>
                     </div>
         </div>
         <!-- END PAGE HEADER-->
         <!-- BEGIN PAGE CONTENT-->
         
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
   <script type="text/javascript" src="assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>
   <script type="text/javascript" src="assets/plugins/select2/select2.min.js"></script>
   <script type="text/javascript" src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   <script type="text/javascript" src="assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
   <script type="text/javascript" src="assets/plugins/clockface/js/clockface.js"></script>
   <script type="text/javascript" src="assets/plugins/bootstrap-daterangepicker/moment.min.js"></script>
   <script type="text/javascript" src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script> 
   <script type="text/javascript" src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>  
   <script type="text/javascript" src="assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
   <script src="assets/plugins/validate/validate.min.js" type="text/javascript" ></script>

   <!-- END PAGE LEVEL PLUGINS -->
   <!-- BEGIN PAGE LEVEL SCRIPTS -->
   <script src="assets/scripts/app.js"></script>
   <script src="assets/scripts/form-samples.js"></script>   
   <!-- END PAGE LEVEL SCRIPTS -->
   <script>
      jQuery(document).ready(function() {    
         // initiate layout and plugins
         App.init();
         FormSamples.init();
      });
$(function() {
	$( "#Datepicker1" ).datepicker(); 
});
   </script>
   
   <script type="text/javascript">
           var validator = new FormValidator('edit_form', [{
            name: 'name',   
            rules: 'required'
        }, {
            name: 'gender',
            rules: 'required|callback_check_gender'
        }, {
            name: 'Datepicker1',
            display: 'date of birth',
            rules: 'required|callback_check_dob'
        }, {
            name: 'mobile',
            rules: 'required|numeric|min_length[10]|max_length[10]'
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
        validator.registerCallback('check_gender', function(value) {
        if(value=='M'||value=='F')
            return true;
        else
            return false;
        })
        .setMessage('check_gender', 'Please choose a value for gender');

        validator.registerCallback('check_dob', function(value) {
        if (/\d{2}\/\d{2}\/\d{4}/.test(value)||value=="UNDEFINED") {
            return true;
        } else {
            return false;
        }

        })
        .setMessage('check_dob', 'Please choose a valid date');
 </script>
   <!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
</html>