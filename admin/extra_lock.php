<?php 
	session_start();
	require("classes/Admin.php");
	$_SESSION['admin_locked']=true;
	$admin	 = new Admin();
	$admin->id=$_SESSION['admin_user_id'];
	$admin->get_admin();
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
  <title>Socilize | Extra - Lock Screen</title>
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
  <link href="assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
  <link href="assets/css/pages/lock.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
  <!-- END THEME STYLES -->
  <link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body>
  <div class="page-lock">
    <div class="page-logo">
      <a class="brand" href="home_user.php">
      <img src="assets/img/logo4.png" alt="logo" width="128" />
      </a>
    </div>
    <div class="page-body">
<?php  
//printing image
$blob= $admin->user_image;
$image = imagecreatefromstring($blob); 
ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
imagejpeg($image, null, 80);
$data = ob_get_contents();
ob_end_clean();
echo '<img class="page-lock-img" src="data:image/jpg;base64,'.base64_encode($data). '" alt="assets/img/profile/profile.jpg" />';
?>
    
    
      <!--<img class="page-lock-img" src="assets/img/profile/profile.jpg" alt="profile pic">-->
      <div class="page-lock-info">
        <h1><?php echo $admin->fullname; ?></h1>
        <span class="email"><?php echo $admin->email; ?></span>
        <span class="locked">Locked</span>
        <form action="functions/extra_lock.php" method="post" class="form-inline">
          <div class="input-group input-medium">
            <input type="password" autocomplete="off" class="form-control" placeholder="Password" name="password">
            <span class="input-group-btn">        
            <button type="submit" class="btn blue icn-only"><i class="m-icon-swapright m-icon-white"></i></button>
            </span>
          </div>
          
          <!-- error messages starts-->
           <?php 
		 if(isset($_SESSION['msg']) and !empty($_SESSION['msg'])){
			 if($_SESSION['msg']==1){$msg='Invalid username.';}
			 elseif($_SESSION['msg']==2){$msg='Login attempt fails !';}
			 elseif($_SESSION['msg']==3){$msg='Please login again';}
			 else{$msg='Oops error !';}
			 echo '<div >
				<font color=#b94a48 size="+1" >
				   '.$msg.'
				</font>
			 </div>';
			 unset($_SESSION['msg']);
		 }
		 ?>
          
          <!-- error messages end-->
          <!-- /input-group -->
          <div class="relogin">
            <a href="functions/logout.php">Not <?php echo $admin->fullname; ?> ?</a>
          </div>
        </form>
      </div>
    </div>
    <div class="page-footer">
      2013 &copy; Socialize.
    </div>
  </div>
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
  <!-- BEGIN PAGE LEVEL PLUGINS -->
  <script src="assets/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
  <!-- END PAGE LEVEL PLUGINS -->   
  <script src="assets/scripts/app.js"></script>  
  <script src="assets/scripts/lock.js"></script>      
  <script>
    jQuery(document).ready(function() {    
       App.init();
       Lock.init();
    });
  </script>
  <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>