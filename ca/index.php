<?php
	session_start();
	if (isset($_SESSION['ca_user_id']) and $_SESSION['ca_user_id']!= NULL)
	{
		header('location: home.php');	
	}	
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Socialize | Login</title>
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
   <link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2_metro.css" />
   <!-- END PAGE LEVEL SCRIPTS -->
   <!-- BEGIN THEME STYLES --> 
   <link href="assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/plugins.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
   <link href="assets/css/pages/login-soft.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
   <!-- END THEME STYLES -->
   <link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
   <!-- BEGIN LOGO -->
   <div class="logo">
      <img src="assets/img/logo4.png" alt="" /> 
   </div>
   <!-- END LOGO -->
   <!-- BEGIN LOGIN -->
   <div class="content">
      <!-- BEGIN LOGIN FORM -->
      <form class="login-form" action="functions/login.php" method="post" id="login">
         <h3 class="form-title">Login to your account</h3>
         <div class="alert alert-error hide">
            <button class="close" data-dismiss="alert"></button>
            <span>Enter any username and password.</span>
         </div>
         <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Username</label>
            <div class="input-icon">
               <i class="icon-user"></i>
               <input class="form-control placeholder-no-fix" type="text" autocomplete="on" placeholder="Username" id="username_login" name="username" <?php if(isset($_GET['usr'])) echo 'value="'.$_GET['usr'].'"';?>/>
            </div>
         </div>
         <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <div class="input-icon">
               <i class="icon-lock"></i>
               <input class="form-control placeholder-no-fix" type="password" autocomplete="on" placeholder="Password" name="password" id="password_login" <?php if(isset($_GET['pwd'])) echo 'value="'.$_GET['pwd'].'"';?>/>
            </div>            
         </div>
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
        <div class="form-actions">
            <label for="rememberme"><input name="rememberme" id="rememberme" class="rememberme" type="checkbox" checked="checked" value="forever" />
            Remember me
            </label>
            <!--<label class="checkbox" for="rememberme">
            <input type="checkbox" name="rememberme" value="forever" checked="checked"/> Remember me
            </label>-->
            <button type="submit" class="btn blue pull-right">
            Login <i class="m-icon-swapright m-icon-white"></i>
            </button>            
         </div>
         <div class="forget-password">
            <h4>Forgot your password ?</h4>
            <p>
               no worries, click <a href="javascript:;"  id="forget-password">here</a>
               to reset your password.
            </p>
         </div>
      </form>
      <!-- END LOGIN FORM -->        
      <!-- BEGIN FORGOT PASSWORD FORM -->
      <form class="forget-form" action="#" method="post">
         <h3 >Forget Password ?</h3>
         <p>Enter your e-mail address below to reset your password.</p>
         <div class="form-group">
            <div class="input-icon">
               <i class="icon-envelope"></i>
               <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" />
            </div>
         </div>
         <div class="form-actions">
            <button type="button" id="back-btn" class="btn">
            <i class="m-icon-swapleft"></i> Back
            </button>
            <button type="submit" class="btn blue pull-right">
            Submit <i class="m-icon-swapright m-icon-white"></i>
            </button>            
         </div>
      </form>
      <!-- END FORGOT PASSWORD FORM -->
      <!-- BEGIN REGISTRATION FORM -->
      <form class="register-form" action="functions/signup.php" method="post" id="signup">
         <h3 >Sign Up</h3>
         <p>Enter your personal details below:</p>
         <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Full Name</label>
            <div class="input-icon">
               <i class="icon-font"></i>
               <input class="form-control placeholder-no-fix" type="text" placeholder="Full Name" name="fullname"/>
            </div>
         </div>
         <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <div class="input-icon">
               <i class="icon-envelope"></i>
               <input class="form-control placeholder-no-fix" type="text" placeholder="Email"  name="email" id ="email" onkeyup="copyTextValue();" onChange ="copyTextValue();" />
            </div>
  
         </div>
         <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Voter ID number</label>
            <div class="input-icon">
               <i class="icon-ok"></i>
               <input class="form-control placeholder-no-fix" type="text" placeholder="Voter ID number" name="voterid"/>
            </div>
         </div>
         
         
         <p>Enter your account details below:</p>
         <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9" >Username</label>
            <div class="input-icon">
               <i class="icon-user"></i>
               <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" id="username"  readonly="true"/>
            </div>
         </div>
         <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <div class="input-icon">
               <i class="icon-lock"></i>
               <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password"/>
            </div>
         </div>
         <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
            <div class="controls">
               <div class="input-icon">
                  <i class="icon-ok"></i>
                  <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="rpassword"/>
               </div>
            </div>
         </div>
         <div class="form-group">
            <label>
            <input type="checkbox" name="tnc"/> I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
            </label>  
            <div id="register_tnc_error"></div>
         </div>
         <div class="form-actions">
            <button id="register-back-btn" type="button" class="btn">
            <i class="m-icon-swapleft"></i>  Back
            </button>
            <button type="submit" id="register-submit-btn" class="btn blue pull-right">
            Sign Up <i class="m-icon-swapright m-icon-white"></i>
            </button>            
         </div>        
      </form>
      <!-- END REGISTRATION FORM -->
   </div>
   <!-- END LOGIN -->
   <!-- BEGIN COPYRIGHT -->
   <div class="copyright">
      2013 &copy; Socialize.
   </div>
   <!-- END COPYRIGHT -->
   <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
   <!-- BEGIN CORE PLUGINS -->   
   <!--[if lt IE 9]>
   <script src="assets/plugins/respond.min.js"></script>
   <script src="assets/plugins/excanvas.min.js"></script> 
   <![endif]-->   
   
<script type="text/javascript"> 
	if (document.getElementById("username_login").value !== "" && 
		document.getElementById("password_login").value !== "")
	{
         <!--alert("all fields are empty");-->
         submitform();
    }
	function submitform() 
	{ 
	  document.forms["login"].submit();  
	} 
</script>

<script type="text/livescript">    
	function copyTextValue() {
		var text1 = document.getElementById("email").value;
		document.getElementById("username").value = text1;    
	}

</script>

<script type="text/javascript">   
	var text1 = document.getElementById("email").value;
    document.getElementById("username").value = text1;
</script>  
   
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
   <script src="assets/plugins/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
   <script src="assets/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
   <script type="text/javascript" src="assets/plugins/select2/select2.min.js"></script>
   <!-- END PAGE LEVEL PLUGINS -->
   <!-- BEGIN PAGE LEVEL SCRIPTS -->
   <script src="assets/scripts/app.js" type="text/javascript"></script>
   <script src="assets/scripts/login-soft.js" type="text/javascript"></script>      
   <!-- END PAGE LEVEL SCRIPTS --> 
   <script>
      jQuery(document).ready(function() {     
        App.init();
        Login.init();
      });
   </script>
   <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>