
<?php
//print_r($_POST);
include_once("../user/Constants/connect.inc.php");
if( isset($_POST['file']) and
		isset($_POST['table']) and
		isset($_POST['feild'])  and
		isset($_POST['id']) 	 ){
			
			$file 	= $_POST['file'];
			$table 	= $_POST['table'];
			$feild	= $_POST['feild'];
			$id		= $_POST['id'];
		
			
			if( !empty($file) and
				!empty($table) and
				!empty($feild ) and
				!empty($id ) ){
						$handle=fopen($file,'r');
						$image_file=fread($handle,filesize($file));
						execute_update("UPDATE `$table` SET `$feild`='".addslashes($image_file)."' WHERE `id`=$id");			
					echo'image inserted<br/>';
				
			}
		
	}
	
?>	

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Socialize | rough</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="image_upload.php">
  <p>
    <label>file   :  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <input type="text" name="file" id="file" tabindex="1">
    </label>
  </p>
  <p>
    <label>tabe name
      <input type="text" name="table" id="table">
    </label>
  </p>
  <p>
    <label>feild name
      <input type="text" name="feild" id="feild">
    </label>
  </p>
  <p>
    <label>id &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="text" name="id" id="id">
    </label>
  </p>
  <p>
    <label for="password">Password</label>
    <input type="password" name="password" id="password">
    <br>
  </p>
  <p>
    <input type="reset" name="cancel" id="cancel" value="cancel">
    <input type="submit" name="submit" id="submit" value="Submit">
  </p>
</form>
</body>
</html>