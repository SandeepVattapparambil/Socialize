<?php
	require("classes/voter.php");
	require("classes/mla.php");
	/*require("classes/Complaint.php");
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
   <input type="button" value="ADD NEW MLA" id="add_new_mla"/>
   <div id="voter_edit_form" style="display:none">
   <font color="#FF0000">Take extra care while entering information No validation provided</font><br> <br>
        <form id="add_voter_form">
        <input type="hidden" id="type" value="new" />
        <input type="hidden" id="id" value="" />
        <!--<label for="la_id"> LAC Identifier&nbsp; &nbsp;&nbsp; </label>
        <input type="text" id="la_id" name="la_id" value="" required><br>-->
        <label for="la_name">  LAC NAME &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </label>
        <input type="text" id="la_name" name="la_name" required/><br>
        <label for="mla_name">  MLA NAME&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </label>
        <input type="text" id="mla_name" name="mla_name" required/><br>
        <label for="mla_email">MLA E-mail ID &nbsp; &nbsp; </label>
        <input id="mla_email" name="mla_email" required /><br>
        <!--<label for="dob">Date of Birth&nbsp;&nbsp; &nbsp; &nbsp;</label>
        <input type="date" id="dob" name="dob" required/><br>-->
        <label for="gender">Gender&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</label>
        <input type="text" id="gender" name="gender" required/><br>
        <input type="submit" value="ADD VOTER" id="submit_button"/>
        </form>
   </div>
   <br>
   <?php
   $mla=new mla();
   $la_ids=$mla->get_lac_list_from_admin_info();
   ?>
   <br>
   <table id="lac_list" background="assets/img/bg/table_bg.PNG"  border="3" bordercolor="#FF0000">
   <thead>
   <td><strong>
   LAC ID &nbsp;&nbsp;</strong>
   </td>
   <td><strong>
   LAC NAME &nbsp;&nbsp;</strong>
   </td>
   <td><strong>
   MLA NAME &nbsp;&nbsp;</strong>
   </td>
   <td><strong>
   MLA EMAIL ID &nbsp;&nbsp;</strong>
   </td>
   <td><strong>
   GENDER &nbsp;&nbsp;</strong>
   </td><td></td><td></td>
   </thead>
   
   <?php $i=1; foreach($la_ids as $la_id){ $mla->get_mla($la_id);?>
   <tr>
   <td id="tbl_la_id"> 
      <?php echo  $la_id;?> 		
   </td>
   <td id="tbl_la_name"> 
      <?php echo $mla->la_name; ?> 		
   </td>
   <td id="tbl_mla_name">
   		<?php echo $mla->fullname; ?>
   </td>
   <td id="tbl_mla_email">
   		<?php echo $mla->email; ?>
   </td>
   <td id="tbl_gender" align="center">
   		<?php echo $mla->gender; ?>
   </td>
   <td>
   		<input class="edit" type="button" value="EDIT" id="<?php echo $mla->id; ?>"/>
   </td>
   <td>
   		<input class="remove" type="button" value="REMOVE" id="<?php echo $mla->id; ?>"/>
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
    	$('#add_new_mla').click(function(){
			if($('#add_new_mla').attr('value')=="ADD NEW MLA"){
				$('#add_new_mla').attr('value','HIDE THE FORM');
				$('#submit_button').attr('value','ADD MLA');
				$('form#add_voter_form').find('input#type').val('new');
				$('div#voter_edit_form').show();
			}else{
				$('#add_new_mla').attr('value','ADD NEW MLA');
				$('div#voter_edit_form').hide();
			}
    	});
	});
	</script>
    <script type="text/javascript">
	$(document).ready(function(){
    	$('input.edit').click(function(){
			id 			=$(this).attr('id');
			//la_id		=$(this).parent().parent().find('#tbl_la_id').html();
			mla_name	=$(this).parent().parent().find('#tbl_mla_name').html();
			la_name		=$(this).parent().parent().find('#tbl_la_name').html();
			email		=$(this).parent().parent().find('#tbl_mla_email').html();
			//dob		=$(this).parent().parent().find('#tbl_dob').html();
			gender		=$(this).parent().parent().find('#tbl_gender').html();
			//la_id		=$.trim(la_id);
			mla_name	=$.trim(mla_name);
			la_name		=$.trim(la_name);
			email		  =$.trim(email);
			//dob			  =$.trim(dob);
			gender		=$.trim(gender);
			//$('form#add_voter_form').find('input#la_id').val(la_id);
			$('form#add_voter_form').find('input#id').val(id);
			$('form#add_voter_form').find('input#mla_name').val(mla_name);
			$('form#add_voter_form').find('input#la_name').val(la_name);
			//$('form#add_voter_form').find('input#dob').val(dob);
			$('form#add_voter_form').find('input#mla_email').val(email);
			$('form#add_voter_form').find('input#gender').val(gender);
			$('form#add_voter_form').find('input#type').val('edit');
			$(this).parent().parent().hide();        	
			$('#add_new_mla').attr('value','HIDE THE FORM');
			$('#submit_button').attr('value','EDIT MLA');
			$('div#voter_edit_form').show();
		});
	});
   </script>
   <script type="text/javascript">
   //removing one voter
	$(document).ready(function(){
    	$('input.remove').click(function(){
			$row=$(this).parent().parent();
			$id =$(this).attr('id');
			 $.ajax({
				type: "POST",
				url: "functions/remove_mla.php",
				data: { id: $id }
				})
				.done(function( msg ) { 
					if(msg=="Succes"){
						//alert("Succesfully removed");
                      	$row.hide();
					}else
					alert("Error occured please try again later");
                      });
			
			
		});
	});
	</script>
    <script type="text/javascript">
	//ading new voter or editing currently existing voter
	$('#add_voter_form').submit (function(event) { 
       	event.preventDefault();
		$('#add_new_mla').attr('value','ADD NEW MLA');
       	$form		=$(this);
       	$id			=$form.find('input#id').val();
		//$la_id	=$form.find('input#la_id').val();
       	$la_name	=$form.find('input#la_name').val();
		$mla_name	=$form.find('input#mla_name').val();
	   	//$id_card_no	=$form.find('input#id_card_no').val();
	   	$email		=$form.find('input#mla_email').val();
	   	$dob		=$form.find('input#dob').val();
	   	$gender		=$form.find('input#gender').val();
	   	$type		=$form.find('input#type').val();
	   	
		$id			=$.trim(	$id			)	;
	   	$la_name	=$.trim(	$la_name	)	;
		$mla_name	=$.trim(	$mla_name	)	;
	   	$email		=$.trim(	$email		)	;
		$dob		=$.trim(	$dob		)	;
		$gender		=$.trim(	$gender		)	;
		$type		=$.trim(	$type		)	;
	   
	   $.ajax({
				type: "POST",
				url: "functions/add_mla.php",
				data: { id: $id, mla_name:$mla_name ,la_name:$la_name ,email:$email ,dob:$dob ,gender:$gender ,type:$type  }
				})
				.done(function( msg ) { /*alert(msg);*/
					if(msg!=="error"){
						if($type=="new") alert("Successfully added new lac");						 
						else if($type=="edit") alert("Successfully edited lac details");
						else alert("error occured some where");	
					}else alert("error occured some where");	
											
			$('table#lac_list').first('tr').append(msg);
            $('form#add_voter_form').find('input#mla_name').val("");
            $('form#add_voter_form').find('input#la_name').val("");
            $('form#add_voter_form').find('input#mla_email').val("");
            $('form#add_voter_form').find('input#gender').val("");
            $('form#add_voter_form').find('input#type').val('new');
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
                        });
 
       
   });
   </script>
   <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>