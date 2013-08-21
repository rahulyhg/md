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
				<h1 >De-Activate Account</h1>
			</section>
			<section class="subContnr">
			<form id="userHoro" name="userHoro" method="post"  action="/mypage/deactivate">
			<input type="hidden" name="deactivate" value="deactivate">
				<ul class="accOverview mTB20">
				<?php if(isset($success)) {?>
					<li>
						<p>
							Your account has been deactivate successfully.
						</p>
						<p>
							You can reactivate your account by logging in with your email and password. <br />Your profile will be restored in its entirety ( photos, my album, etc). 
						</p>
					</li>
				<?php } else { ?>
					<li>
						<p>
							When you deactivate your account, your profile and all information associated with it disappears from the marrydoor immediately. People will not be able view any of your information.
						</p>
						<p>
							You can reactivate your account by logging in with your email and password. <br />Your profile will be restored in its entirety ( photos, my album, etc). 
						</p>
					</li>
					
					<li>
						<div class="deact-cont">
							<span id="submit"><a href="#" class="type5">De-Activate Now</a></span>
							<span id="back"><a href="#" class="type5">Go back to My Page</a></span>
						</div>
					</li>
					<?php }?>
				</ul>
				</form>
			</section>

		

<script type="text/javascript">
$(document).ready(function(){

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