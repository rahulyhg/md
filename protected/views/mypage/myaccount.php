<?php
/*
*
* $Id$
--------------------------------------------------------------------------------------------------------------------------
* Information contained in this file is the intellectual property of Ladbrokes Plc
* Copyright © 2012 MarryDorr. All Rights Reserved.
* ---------------------------------------------------------------------------------------------------------------------------
*
* @author  Ageesh K Gopinath
* @title myaccount.php
* @description <Description of this class>
*  @filesource <URL>
*  @version <Revision>
*/
?>
    <?php $this->widget('application.widgets.menu.Leftmenu'); ?>
 <section class="data-contnr2">
        <h1 class="mB10">My account </h1>
        <p>My account is where you get a snap shot of your account settings and other details you have furnished while registering. You can change your setting any time you want.</p>
        <ul class="accOverview">
			<li>
				<div class="leftC">Account status </div>
				<div class="rightC">
					<strong>:</strong> <span><?php echo Utilities::getCurrentUserStatus($user)?> </span>
				</div>
			</li>
			<li>
				<div class="leftC">Profile Created on</div>
				<div class="rightC">
					<strong>:</strong> <span><?php if(isset($user->createdOn))
						echo $user->createdOn;
					?></span>
				</div>
			</li>
			<li>
				<div class="leftC">Registerd Contact No.</div>
				<div class="rightC">
					<strong>:</strong> <span><?php if(isset($user->userpersonaldetails)) echo $user->userpersonaldetails->mobilePhone ?>   </span>
				</div>
			</li>
			<li>
				<div class="leftC">Registered Email</div>
				<div class="rightC">
					<strong>:</strong> <span><?php if(isset($user->emailId)) echo $user->emailId ?>  </span>
				</div>
			</li>
			<li>
				<div class="leftC">Profile visited by you</div>
				<div class="rightC">
					<strong>:</strong> <?php if(isset($user->profileUser)) 
				echo count($user->profileUser);
		?>
				</div>
			</li>
			<li>
				<div class="leftC">Your profile visitors</div>
				<div class="rightC">
					<strong>:</strong> <?php 
 				if(isset($profileCount))
 				echo $profileCount;
 		?> 
				</div>
			</li>
			<li>
				<div class="leftC">Interest received </div>
				<div class="rightC">
					<strong>:</strong> <?php
			$receiveInterest = $user->interestReceiver(array('condition'=>'status = 0 and receiverStatus = 0'));
				if(isset($receiveInterest))
				echo count($receiveInterest);
		?>
				</div>
			</li>
			<li>
				<div class="leftC">Interest sent</div>
				<div class="rightC">
					<strong>:</strong> <?php 
			$sent = $user->interestSender(array('condition'=>'status != 3 and senderStatus = 0'));
		if(isset($sent)) echo count($sent);?>
				</div>
			</li>
			<li>
				<div class="leftC">Interest Declined by you</div>
				<div class="rightC">
					<strong>:</strong> <?php 
			
			$sendInterest = $user->interestReceiver(array('condition'=>'status= 2 and receiverStatus = 0'));
			if(isset($sendInterest))
			echo count($sendInterest);
		
		?>
				</div>
			</li>
			<li>
				<div class="leftC">Interest Declined your</div>
				<div class="rightC">
					<strong>:</strong> <?php 
				$decline = $user->interestReceiver(array('condition'=>'status = 1 and senderStatus'));
				if(isset($decline))
				echo count($decline);
		?>
				</div>
			</li>
				<?php 
					$inbox = $user->messageReceiver(array('condition'=>'receiverStatus = 0'));
					$outbox = $user->messageSender(array('condition'=>'senderId = '.$user->userId.' and senderStatus = 0'));
				?>
				
			<li>
				<div class="leftC">Message sent	</div>
				<div class="rightC">
					<strong>:</strong> <?php echo count($outbox); ?>
				</div>
			</li>
			<li>
				<div class="leftC">Message received </div>
				<div class="rightC">
					<strong>:</strong> <?php echo count($inbox); ?>
				</div>
			</li>
			<!-- 
			<li>
				<div class="leftC">Request received </div>
				<div class="rightC">
					<strong>:</strong> 
				</div>
			</li>
			<li>
				<div class="leftC">Request sent</div>
				<div class="rightC">
					<strong>:</strong> 
				</div>
			</li>
			<li>
				<div class="leftC">Request Decliened by you</div>
				<div class="rightC">
					<strong>:</strong> 
				</div>
			</li>
			<li>
				<div class="leftC">Request Decliened your </div>
				<div class="rightC">
					<strong>:</strong> 
				</div>
			</li>
			 -->
			<?php $shorlist = $user->shortlist();
			$shorts = 0;
			$shortListed = Shortlist::model()->findAll(array('condition'=>"FIND_IN_SET('{$user->userId}',profileID)"));
			if(isset($shortListed))
			$shorts = sizeof($shortListed);
			$visitIds = array();
			if(isset($shorlist))
			$visitIds = explode(",",$shorlist->profileID);
			
			
			?>
			<li>
				<div class="leftC">Shortlisted you</div>
				<div class="rightC">
					<strong>:</strong> <?php echo $shorts?>
				</div>
			</li>
			<li>
				<div class="leftC">Shortlisted by you</div>
				<div class="rightC">
					<strong>:</strong> <?php echo sizeof($visitIds);?>
				</div>
			</li>
			<?php $bookmarked = $user->bookmark;
			$idcount = array();
			
			if(isset($bookmarked))
			$idcount = explode(",",$bookmarked->profileIDs)			
			?>
			<li>
				<div class="leftC">Your Book Mark</div>
				<div class="rightC">
					<strong>:</strong> <?php echo sizeof($idcount)?>
				</div>
			</li>
			<?php 
			$blockCount = 0;
			$blocked = Profileblock::model()->findAll(array('condition'=>"FIND_IN_SET('{$user->userId}',profileIDs)"));
			if(isset($blocked))
			$blockCount = sizeof($blocked);
			
			?>
			<li>
				<div class="leftC">Persons who blocked by me </div>
				<div class="rightC">
					<strong>:</strong> <?php echo $blockCount?>
				</div>
			</li>
			
			<h1 class="mTB12 ">My Account Settings</h1>
        <p>You can change your account setting, delete or deactivate the account any time you want.</p>
		<ul class="accOverview mT12">
			<li>
				<div class="btnC">
					<a href="<?php echo Utilities::createAbsoluteUrl('mypage','change'); ?>" id="footerPops" class="actAct">Change Password</a>
					<a href="<?php echo Utilities::createAbsoluteUrl('mypage','deactivate'); ?>" id="footerPops" class="actAct">Deactivate account</a>
					<a href="<?php echo Utilities::createAbsoluteUrl('mypage','delete'); ?>" id="footerPops" class="actAct">Delete my account</a>
				</div>
			</li>
		</ul>
		<!-- 
			<li>
				<a href="<?php echo Utilities::createAbsoluteUrl('mypage','deactivate'); ?>" class="edit" id="footerPops">Click here</a> to Deactivate account
				
			</li>
			<li>
				<a href="<?php echo Utilities::createAbsoluteUrl('mypage','delete'); ?>" class="edit" id="footerPops">Click here</a> to Delete account
			</li>
		 -->	
		</ul>
    </section>
        	<!-- right menu -->
	<?php $this->widget('application.widgets.menu.Rightmenu'); ?> 
	<!-- right menu ends -->
	
	<script type="text/javascript">
$(document).ready(function(){
    $('[id^=footerPops]').colorbox({iframe:true, width:"860", height:"900",overlayClose: false});
    
  });


</script>