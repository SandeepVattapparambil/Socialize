<?php
function send_e_mail($from,$to,$subject,$body){
	if (!empty ($subject) && !empty ($from) &&  !empty ($body) &&  !empty ($to)) {
		if (strlen ($subject)>50 || strlen($from)>50 || strlen($to)>50 || strlen($body)>1000) {
			//re direct
			echo 'Sorry, max length for some field has been exceeded.';
		}else {
			$header = 'From: ' . $from;
			if (mail($to, $subject, $body, $header)) {
				//redirect 
				echo 'Thank you! for contacting us. We\'ll be in touch soon.';
			}else {
				//redirect
				echo 'Sorry, an error occurred. Pleaae try again later.';
			}
		}
	} else {
		//redirect
		echo 'empty values';
	}
}
?>