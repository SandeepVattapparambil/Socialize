<?php
	require("classes/ca.php");
	/*require("classes/User.php");
	require("classes/Complaint.php");
        require("../time_functions.php");
	session_start();
	if (!(	isset($_SESSION['database_admin']) and $_SESSION['database_admin']!= NULL)){
		header('location: index.php');	
	}	
	
	if (isset($_SESSION['locked']) and $_SESSION['locked']){
		header('location: extra_lock.php');	
	}
	$admin	 = new Admin();
	$admin->id=$_SESSION['database_admin'];
	$admin->get_admin();*/
	
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
   <!-- BEGIN CONTAINER --><br/><br/>
   
   
   
   <div><h2><center><strong>Socialize Database Manager</strong></center></h2></div>
   <div style="margin-left:100 !important"><center>
   <input class="btn btn-success" type="button" value="ADD NEW CA" id="add_new_ca"/>
   <div id="ca_edit_form" style="display:none">
   <font color="#FF0000">Take extra care while entering information No validation provided</font><br> <br>
        <form id="add_ca_form"><table>
        <tr><td>
        <input type="hidden" id="type" value="new" />
        <input type="hidden" id="id" value="" /><br/>
        </td></tr>
        <tr><td><label for="name">  Name of CA </label></td><td>
        <input type="text" id="name" name="name" required/><br/>
        </td></tr>
        <tr><td><label for="designation">CA Designation</label></td><td>
        <select id="designation" name="designation" required  >
        	<option value="Chief Minister">Chief Minister &nbsp; &nbsp; </option>
            <option value="Home Minister">Home Minister</option>
            <option value="Finance Minister">Finance Minister</option> 
            <option value="Education Minister">Education Minister</option>
            
        </select><br/>
        </td></tr>
       <tr><td><label for="ca_email">CA E-mail ID &nbsp; &nbsp; </label></td><td>
        <input id="ca_email" name="ca_email" required /><br/>
        </td></tr>
        <tr><td></td><td><input type="submit" value="ADD CA" id="submit_button"/></td></tr>
        </table>
        </form>
   </div>
   <br>
   <?php
   $ca=new ca();
   $ca_ids=$ca->get_ca_list();
   ?>
   <br>
   <table background="assets/img/bg/table_bg.PNG" border="3" width="80%" id="ca_list">
   <thead>
   <td><strong>
   ID &nbsp;&nbsp;</strong>
   </td>
   <td><strong>
   NAME &nbsp;&nbsp;</strong>
   </td>
   <td><strong>
   DESIGNATION
   </td>
   <td><strong>
   CA EMAIL ID
   </td>
   <td></td><td></td>
   </thead>
   
   <?php $i=1;
   if(!empty($ca_ids))
   foreach($ca_ids as $ca_id){
	$ca->get_ca($ca_id);   
   ?>
   
   <tr>
   
   <td id="tbl_sl_no"> 
      	<?php echo $ca->id;//$i++;?> 		
   </td>
   <td id="tbl_name"> 
      	<?php echo $ca->fullname; ?> 		
   </td>
   <td id="tbl_designation">
   		<?php echo $ca->designation; ?>
   </td>
   <td id="tbl_mail_id">
   		<?php echo $ca->mail_id; ?>
   </td>   
   <td>
   		<input class="btn btn-info edit" type="button" value="EDIT" id="<?php echo $ca->id; ?>"/>
   </td>
   <td>
   		<input class="btn btn-info remove" type="button" value="REMOVE" id="<?php echo $ca->id; ?>"/>
   </td>
   </tr>
   <?php } ?>
   </table>
   </center>
   </div>
   
   
   

   <!-- END CONTAINER -->
   <!-- BEGIN FOOTER -->
   <div class="footer">
      <div class="footer-inner">
         2013 &copy; Socialize.
      </div>
      <div class="footer-tools">
         <!--<span class="go-top">
         <i class="icon-angle-up"></i>
         </span>-->
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
   <script type="text/javascript">
  	$(document).ready(function(){
    	$('#add_new_ca').click(function(){
			$('div#ca_edit_form').toggle();
			if($('#add_new_ca').attr('value')=="ADD NEW CA"){
				$('#add_new_ca').attr('value','HIDE THE FORM');
				$('#submit_button').attr('value','ADD CA');
				reset_form();
				$('form#add_ca_form').find('input#type').val('new');
			}else{
				$('#add_new_ca').attr('value','ADD NEW CA');
				$('form#add_ca_form').find('input#type').val('new');
			}
    	});
	});
	</script>
    <script type="text/javascript">
	$(document).ready(function(){
    	$('input.edit').click(function(){
			id			=$(this).attr('id');
			name		=$(this).parent().parent().find('#tbl_name').html();
			designation	=$(this).parent().parent().find('#tbl_designation').html();
			mail_id		=$(this).parent().parent().find('#tbl_mail_id').html();
			//dob			=$(this).parent().parent().find('#tbl_dob').html();
			//gender		=$(this).parent().parent().find('#tbl_gender').html();
			id			=$.trim(id);
			name		=$.trim(name);
			designation =$.trim(designation);
			mail_id		=$.trim(mail_id);
			
			$('form#add_ca_form').find('input#id').val(id);
			$('form#add_ca_form').find('input#name').val(name);
			$('form#add_ca_form').find('select#designation').attr('value',designation);
			$('form#add_ca_form').find('input#ca_email').val(mail_id);
			$('form#add_ca_form').find('input#type').val('edit');
			
			$(this).parent().parent().hide();
			
        	$('div#ca_edit_form').show();
			$('#add_new_ca').attr('value','HIDE THE FORM');
			$('#submit_button').attr('value','EDIT CA');
		});
	});
   </script>
   <script type="text/javascript">
   //removing one ca
	$(document).ready(function(){
    	$('input.remove').click(function(){
			$row=$(this).parent().parent();
			$id =$(this).attr('id');
			 $.ajax({
				type: "POST",
				url: "functions/remove_ca.php",
				data: { id: $id }
				})
				.done(function( msg ) { 
					if(msg=="Succes"){
						alert("Succesfully removed");
                      	$row.hide();
					}else
					alert("Error occured please try again later");
                      });
			
			
		});
	});
	</script>
    <script type="text/javascript">
	//ading new ca or editing currently existing ca
	$('#add_ca_form').submit (function(event) { 
        event.preventDefault();
        $('#add_new_ca').attr('value','ADD NEW CA');
        $form       = $(this);
      	$id         = $form.find('input#id').val()         ;
	$district_id= $form.find('input#district_id').val()      ;
        $designation= $form.find('select#designation').val();
      	$name       = $form.find('input#name').val()       ;
	$mail_id    = $form.find('input#ca_email').val();
	$type	    = $form.find('input#type').val();
	   	
		$.ajax({
				type: "POST",
				url: "functions/add_ca.php",
				data: { id: $id, name:$name ,district_id:$district_id  ,type:$type ,
                                    designation:$designation, mail_id:$mail_id  }
				})
				.done(function( msg ) { 
					if(msg!=="error"){
						if($type=="new") alert("Successfully added new ca");						 
						else if($type=="edit") alert("Successfully edited ca details");
						else alert("error occured some where");	
					}else alert("error occured some where");
				
				
						$('table#ca_list').first('tr').append(msg);
						$('div#ca_edit_form').hide();
            reset_form();
			
                        });
 
       
   });
   function reset_form(){
   		$('form#add_ca_form').find('input#id').val("");
            $('form#add_ca_form').find('input#name').val("");
            $('form#add_ca_form').find('input#ca_email').val("");
            $('form#add_ca_form').find('select#designation').attr('value',"");
            $('form#add_ca_form').find('input#type').val('new');
   }
   
   </script>
   <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>