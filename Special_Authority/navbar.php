<div class="header navbar navbar-inverse navbar-fixed-top">
      <!-- BEGIN TOP NAVIGATION BAR -->
      <div class="header-inner">
         <!-- BEGIN LOGO -->  
         <a class="navbar-brand" href="home.php"><img src="assets/img/logo4.png" alt="logo" width="148" height="53" class="img-responsive" />         </a>

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
            
            <!-- END INBOX DROPDOWN -->
            <!-- BEGIN TODO DROPDOWN -->
            
            <!-- END TODO DROPDOWN -->
            <!-- BEGIN USER LOGIN DROPDOWN -->
            <li class="dropdown user">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
               <?php
                                  
//printing image
$blob= $sa->user_image;
@$image = imagecreatefromstring($blob); 
ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
imagejpeg($image, null, 80);
$data = ob_get_contents();
ob_end_clean();
echo '<img  src="data:image/jpg;base64,'.base64_encode($data). '" height="29" width="29" class="img-rounded" alt="assets/img/photo.jpg"/>';
								?>
               
               
               <span class="username"><?php echo $sa->sa_name; ?></span>
               <i class="icon-angle-down"></i>
               </a>
               <ul class="dropdown-menu">
                  <li><a href="profile.php"><i class="icon-user"></i> My Profile</a>
                  </li>
                  
                  <li class="divider"></li>
                  <li><a href="javascript:;" id="trigger_fullscreen"><i class="icon-move"></i> Full Screen</a>
                  </li>
                  <li><a href="extra_lock.php"><i class="icon-lock"></i> Lock Screen</a>
                  </li>
                  <li><a href="#portlet-config" data-toggle="modal" class="config"><i class="icon-power-off"></i> Log Out</a>
                  </li>
               </ul>
            </li>
            <!-- END USER LOGIN DROPDOWN -->
         </ul>
         <!-- END TOP NAVIGATION MENU -->
      </div>
      <!-- END TOP NAVIGATION BAR -->
   </div>