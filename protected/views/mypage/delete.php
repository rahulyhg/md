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
* @title delete.php
* @description <Description of this class>
*  @filesource <URL>
*  @version <Revision>
*/
?>

    <div class="subContent">
			<section class="subHead">
				<h1>Delete Account</h1>
			</section>
			<section class="subContnr">
			<form id="userHoro" name="userHoro" method="post"  action="/mypage/delete">
			<input type="hidden" name="delete" value="delete">
				<ul class="accOverview mTB20">
				
					<?php if(isset($success)) {?>
					<li>
						<p>
							Your account has been deleted.Once you delete your account, you won't be able to access it again. Deleting your account will remove all your contacts and other details from our system.
						</p>
						<p>
							Thank  you for using our services. 
						</p>
					</li>
				<?php } else { ?>
					<li>
						<p>
							Once you delete your account, you won't be able to access it again. Deleting your account will remove all your contacts and other details from our system. 
						</p>
						<p>
							If you do not want to lose data, we suggest you deactivate the account for a while. You will be able to access your details at the time of next log in.
						</p>
					</li>
					<li>
						<div class="deactContnr">
							<a href="/mypage/deactivate" class="type5">De-Activate My Account</a>
						</div>
						<p class="tCenter">
							<strong>If you still want to delete your account, please tell us why you want to do so by answering the following questions. We promise it will take only a few minutes.</strong>
						</p>
					</li>
					<li class="mT15">
						<p class="textAc">I am married and does not want this account</p>
						<div class="questAl">
							<div class="radio wid90">
								<input type="radio" name="married"> <span>Yes</span>
							</div>
							<div class="radio wid90">
								<input type="radio" name="married"> <span>No</span>
							</div>
						</div>
					</li>
					<li class="mT15">
						<p class="textAc">I am not happy with your services </p>
						<div class="questAl">
							<div class="radio wid90">
								<input type="radio" name="service"> <span>Yes</span>
							</div>
							<div class="radio wid90">
								<input type="radio" name="service"> <span>No</span>
							</div>
						</div>
					</li>
					<li class="mT15">
						<p class="textAc">I got engaged through marrydoor</p>
						<div class="questAl">
							<div class="radio wid90">
								<input type="radio" name="engaged"> <span>Yes</span>
							</div>
							<div class="radio wid90">
								<input type="radio" name="engaged"> <span>No</span>
							</div>
						</div>
					</li>
					<li class="mT15">
						<p class="textAc">I got engaged through another matrimonial site</p>
						<div class="questAl">
							<div class="radio wid90">
								<input type="radio" name="other"> <span>Yes</span>
							</div>
							<div class="radio wid90">
								<input type="radio" name="other"> <span>No</span>
							</div>
						</div>
					</li>
					<li class="mT15">
						<p class="textAc">I do not find this site useful</p>
						<div class="questAl">
							<div class="radio wid90">
								<input type="radio" name="useful"> <span>Yes</span>
							</div>
							<div class="radio wid90">
								<input type="radio" name="useful"> <span>No</span>
							</div>
						</div>
					</li>
					<li class="mT15">
						<p class="textAc">My account is compromised </p>
						<div class="questAl">
							<div class="radio wid90">
								<input type="radio" name="compromised"> <span>Yes</span>
							</div>
							<div class="radio wid90">
								<input type="radio" name="compromised"> <span>No</span>
							</div>
						</div>
					</li>
					<li>
						<div class="deact-cont">
							<span id="submit"><a href="#" class="type5">Delete Now</a></span>
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
		