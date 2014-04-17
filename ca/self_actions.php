<?php
	require("classes/ca.php");
	require("classes/Complaint.php");
	require("../time_functions.php");
	session_start();
	if (!(	isset($_SESSION['ca_user_id']) and $_SESSION['ca_user_id']!= NULL)){
		header('location: index.php');	
	}	
	
	if (isset($_SESSION['ca_locked']) and $_SESSION['ca_locked']){
		header('location: extra_lock.php');	
	}
	$ca	 = new ca();
	$ca->id=$_SESSION['ca_user_id'];
	$ca->get_ca();
?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Socialize | Central Administrative Agency </title>
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
    <link href="assets/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css"/>
   <!-- END THEME STYLES -->
   <link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
   <!-- BEGIN HEADER -->   
   <?php include ('navbar.php'); ?>
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
               <a href="home.php">
               <i class="icon-home"></i> 
               <span class="title">Home</span>
               <span class="selected"></span>
               </a>
            </li>
            <li class="">
               <a href="profile.php">
               <i class="icon-user"></i> 
               <span class="title">Profile</span>
               
               </a>
               
            </li>
            
            <li class="active">
               <a href="self_actions.php">
               <i class="icon-sitemap"></i> 
               <span class="title">Complaints</span>
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
         <div class="row profile"></div>
         <!-- END PAGE HEADER-->
         <!-- BEGIN DASHBOARD STATS -->
         
         <!-- END DASHBOARD STATS -->
     
        <div class="clearfix"></div>
         <div class="row ">
           <div class="col-md-12 col-sm-12">
              <!-- BEGIN PORTLET-->
              <div class="portlet">
                  <div class="portlet-title line">
                     <div class="caption"><i class="icon-sitemap"></i>Complaints</div>
                     <div class="tools">
                        <a href="" class="collapse"></a>
                        <a href="" class="reload"></a>
                        <a href="" class="remove"></a>
                     </div>
                  </div>
                  <div class="portlet-body" id="chats">
                     <div class="scroller" style="height: 500px;" data-always-visible="1" data-rail-visible1="1">
                        <ul class="chats">
                                                      
                           
<?php
	$complaint=new Complaint();
	$complaints=$complaint->getComplaintList($ca->id);
	       $sl_no=0;
		   foreach($complaints as $complaint_id){
						$complaint->getComplaint($complaint_id);  
						$sl_no++;
						$blob= Complaint::getComplaintOwnerImage($complaint_id);
						$image = imagecreatefromstring($blob); 
						ob_start();
						imagejpeg($image, null, 80);
						$data = ob_get_contents();
						ob_end_clean();
						echo '<span class="complaint">';
						echo '<input id="complaint_id" type="hidden" value="'.$complaint->id.'"/>';
					  echo '<!--chat in strts here-->
                           <li class="in">
                              <img class="avatar img-responsive" alt="" src="data:image/jpg;base64,' .  base64_encode($data)  . '" />
                              <div class="message">
                                 <span class="arrow"></span>
                                 <a href="#" class="name">'.complaint::getComplaintOwnerName($complaint->id).'</a>
                                 <span class="datetime">   &nbsp;&nbsp; '.time_gap( $complaint->date_and_time).'</span>
                                 <span class="body">'.
                                 $complaint->text
                                 .'</span>
								 <button id="'.$complaint->id.'" class="btn btn-xs tooltips default" data-placement="bottom" data-original-title="Solve this Complaint"><i class=" icon-ok"></i>Clear</button>&nbsp;
								 <button  id="responce-form-btn-'.$sl_no.'" class="btn btn-xs default tooltips" data-placement="bottom" data-original-title="Click to show text box"><i class=" icon-edit"></i></button>&nbsp;
                                 <button  id="responce-btn-'.$sl_no.'" class="btn btn-xs default tooltips" data-placement="bottom" data-original-title="Click to show Comments"><i class=" icon-adjust"></i></button>&nbsp;
                                  
                              </div>
                           </li>
                           <!--chat in ends  here--> 
						   <!--chat form strts here-->
                           <div id=responce-form-'.$sl_no.' style="display:none">
                           <div id="panel" class="remark-panel">
                           <form class="remark-form" action="#" method="post"> 
                        <div class="input-cont"> 
                         
                           <input id="response_text" class="form-control" type="text" placeholder="Type your remarks here..." />
                           
                        </div>
                        <div class="btn-cont"> 
                           <span class="arrow"></span>
                           <button type="submit" class="btn blue icn-only"><i class="icon-ok icon-white"></i></button>
                        </div>
                        </form>
                     </div></div>
                     <!--chat form ends here-->
               		 <!--chat out strts here--> ';
			   
			$responces=$complaint->getComplaintResponceList($complaint->id);
			if(!empty($responces)){
			echo '<div id="responce-'.$sl_no.'" style="display:none"> <ul>';
			for($a=0;!empty($responces[$a]);$a++){
            $blob= Complaint::getComplaintResponceOwnerImage($responces[$a]['id']);
			@$image = imagecreatefromstring($blob); 
			ob_start(); 
			imagejpeg($image, null, 80);
			$data = ob_get_contents();
			ob_end_clean();
						
						echo '       
                           <li class="out">
                              <img class="avatar img-responsive" alt="" src="data:image/jpg;base64,'.base64_encode($data). '" />
                              <div class="message">
                                 <span class="arrow"></span>
                                 <a href="#" class="name">'.Complaint::getComplaintResponceOwnerName($responces[$a]['id']).'</a>
                                 <span class="datetime">'.time_gap( $responces[$a]['time_stamp']).'</span>
								 <br>
								 <span class="name"> [&nbsp;'.Complaint::getComplaintResponceOwnerType($responces[$a]['id']).'&nbsp;]</span>
                                 <span class="body">'
								 .$responces[$a]['text'].
								 '</span>
                              </div>
                           </li>';
						
						}
						
						echo '</ul></div>
                       <!--chat out ends here-->';
						
						}
						echo '</span>';
              
	}
  ?>                           
                           
                          
                           
                           
                           
                               
                          
                        </ul>  <!-- chat ends here -->
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
   <!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
   <script src="assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
   <script src="assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js" type="text/javascript"></script>
   <script src="assets/plugins/jquery.sparkline.min.js" type="text/javascript"></script>  
   <!-- END PAGE LEVEL PLUGINS -->
   <!-- BEGIN PAGE LEVEL SCRIPTS -->
   <script src="assets/scripts/app.js" type="text/javascript"></script>
   <script src="assets/scripts/index.js" type="text/javascript"></script>
   <script src="assets/scripts/tasks.js" type="text/javascript"></script>      
   <script src="assets/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript" ></script>
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
         toastr.options.positionClass='toast-bottom-full-width';
      });
   </script>
<script>
$('.remark-form').submit (function(event) { 
       event.preventDefault();
       $form=$(this);
       $complaint_id=$form.closest('span.complaint').find('#complaint_id').val();
       $response_text=$form.closest('span.complaint').find('#response_text').val();
       $.ajax({
				type: "POST",
				url: "functions/complaint_response.php",
				data: { complaint_id: $complaint_id, response_text:$response_text }
				})
				.done(function( msg ) { 
                                    $form.closest('span.complaint').find('#response_text').val('');
                                    $form.closest('span.complaint').find('li.out').first('li').prepend(msg);
                                    //$form.closest('span.complaint').find('#panel').slideUp('fast');
                                });
 
       
   });
</script>
<script type="text/javascript">
   $('.btn').click(function () { 
   		$btn=$(this);
		$id=$btn.attr('id');
   		if($btn.attr('class')=='btn btn-xs tooltips default') //Clear button
   		{
				$.ajax({
				type: "POST",
				url: "functions/clear_complaint.php",
				data: { id: $id }
				})
				.done(function( msg ) { 
                                    $btn.closest('span.complaint').hide('fast');
                                    toastr.success('Complaint has been cleared');
                        });
   		} 
	});
   </script>
<?php   
while($sl_no>0){
echo '<script> 
$(document).ready(function(){
  $("#responce-btn-'.$sl_no.'").click(function(){
    $("#responce-'.$sl_no.'").slideToggle("slow");
  });
});
</script>
<script> 
$(document).ready(function(){
  $("#responce-form-btn-'.$sl_no.'").click(function(){
    $("#responce-form-'.$sl_no.'").slideToggle("slow");
  });
});
</script>';
$sl_no--;
}
?>
   <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>