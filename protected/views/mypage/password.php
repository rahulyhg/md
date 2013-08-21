<?php
/*
*
* $Id$
--------------------------------------------------------------------------------------------------------------------------
* Information contained in this file is the intellectual property of MarryDoor Plc
* Copyright © 2012 MarryDorr. All Rights Reserved.
* ---------------------------------------------------------------------------------------------------------------------------
*
* @author  Ageesh K Gopinath
* @title deactivate.php
* @description <Description of this class>
*  @filesource <URL>
*  @version <Revision>
*/
?>
  <div class="subContent" id="deactivate">
			<section class="subHead">
				<h1 >Change Password</h1>
			</section>
			<section class="subContnr">
			<form id="userHoro" name="userHoro" method="post"  action="/mypage/change">
			<input type="hidden" name="deactivate" value="deactivate">
				<ul class="accOverview mTB20">
				<?php if(isset($success)&& $success == true) {?>
					<li>
						<p>
							Your password has been changed successfully.Please login again with the new password.
						</p>
						<p>
							Please call us +91 9400 005 005 for any queries.
						</p>
					</li>
				<?php }

				if(isset($success) && $success == false) {?>
					<li>
						<p>
							You have entered wrong information, please try with forgot password option to reset password.
						</p>
						<p>
							Please call us +91 9400 005 005 for any queries.
						</p>
					</li>
				<?php }
				
				if(!isset($success)) { ?>
					<li>
						<p>
							Please provide the below details
						</p>
						<div class="visitorBtnC">
						
						<input class="validate[required] floatN" type="password" name="oldPassword" placeholder="Old Password"/>
						</div>
						<div class="visitorBtnC">
							<input class="validate[required] floatN" type="password" id="newpassword" name="newpassword" placeholder="New Password"/>
						</div>
						<div class="visitorBtnC">
							 <input class="validate[required,equals[newpassword]] floatN" type="password" name="confirmPassword" placeholder="Confirm Password:"/>
						</div>
					</li>
					
					<li>
						<div class="deact-cont">
							<span id="submit"><a href="#" class="type5">Change Password</a></span>
							<span id="back"><a href="#" class="type5">Go back to My Page</a></span>
						</div>
					</li>
					<?php }?>
				</ul>
				</form>
			</section>

		

<script type="text/javascript">
$(document).ready(function(){
	  $("#userHoro").validationEngine('attach');
	<?php if(isset($success)) {?>
	setTimeout(loadPage,5000);
	<?php }?>
	$("#submit").click(function() {
		$("#userHoro").submit();
       
	});  
    
  });	

function loadPage()
{
	window.parent.location.reload();
}

$("#back").click(function() {
	closeOverlay();
});
	

 </script> 