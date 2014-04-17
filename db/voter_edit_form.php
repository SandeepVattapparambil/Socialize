<?php
if(isset($_GET['type']) and !empty($_GET['typpe'])) $type=$_GET['typpe'];
else $type="new";
?>
<div id="voter_edit_form">
<form id="add_voter_form">
<input type="hidden" id="type" value="<?php $type ?>" />
<label for="la_id"> LAC Identifier&nbsp; &nbsp; </label><input type="text" id="la_id" name="la_id" /><br>
<label for="name">  Name of voter&nbsp; &nbsp; </label><input type="text" id="name" name="name" /><br>
<label for="id_card_no">ID card number &nbsp;</label><input type="text" id="id_card_no" name="id_card_no" /><br>
<label for="address">address of voter </label><input type="text" id="address" name="address" /><br>
<label for="dob">Date of Birth&nbsp; &nbsp; &nbsp; &nbsp;</label><input type="text" id="dob" name="dob" /><br>
<label for="gender">Gender&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</label><input type="text" id="gender" name="gender" /><br>
<input type="submit" value="hgchgc"/>
</form>
</div>
<script type="text/javascript">
 $('#add_voter_form').submit (function(event) { 
 alert("");
       event.preventDefault();
       /*$form=$(this);
       $complaint_id=$form.find('#complaint_id').val();
       $response_text=$form.find('#response_text').val();
	   
	   $.ajax({
				type: "POST",
				url: "functions/complaint_response.php",
				data: { complaint_id: $complaint_id, response_text:$response_text }
				})
				.done(function( msg ) { 
                                    $form.closest('span.complaint').find('#response_text').val('');
                                    $form.closest('span.complaint').find('li.out').first('li').prepend(msg);
                                    });
 */
       
   });
</script>