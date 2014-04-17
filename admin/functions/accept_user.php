<?php
require("../classes/User.php");
?>
<?php
	if(isset($_POST['accept']) && isset($_POST['id'])){
		if($_POST['accept']!= NULL and $_POST['id']!= NULL){
			$accept=$_POST['accept'];
			$usr_id=$_POST['id'];
			$user=new User();
			$user->get_user($usr_id);
			if($accept==1)
                        {
				$user->setuserstatus(1);
                               //printing image
                                $blob= $user->user_image;
                                @$image = imagecreatefromstring($blob); 
                                ob_start();
                                imagejpeg($image, null, 80);
                                $data = ob_get_contents();
                                ob_end_clean();
                               echo '<div class="col-md-2">
								<div class="meet-our-team">
                  				<h4>'.$user->fullname.'</h4>
                  				<img src="data:image/jpg;base64,'.base64_encode($data).'" alt="" class="img-responsive" width="200" height="200"/>
                  				<div class="team-info">
                    			<p>'.$user->fullname.'<br>'.$user->voterid.'<br>'.$user->email.'<br><br><i>'.$user->address.'</i><br><br>'.($user->sex=='M'?'Male':'Female').'<br></p>
                  				</div>
               					</div>
						</div>';
                        }
			else if($accept==0)
				$user->setuserstatus(2);
		}
	}
?>