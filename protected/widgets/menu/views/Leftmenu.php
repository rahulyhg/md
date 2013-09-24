 <?php
 	// get the user details from session value
 	$user = Yii::app()->session->get('user'); 
 	$profileImage = $user->photos(array('condition'=>'profileImage = 1'));
 	if(count($profileImage) > 0){
 		$image = $profileImage[0]->imageName;
 	}else{
 		$image = '';
 	}
 ?>
    <aside class="left-bar-container">
		<ul class="left-bar-data">
            <li>
				<a href="<?php echo Utilities::createAbsoluteUrl('mypage','album',array()); ?>"><img width="75" height="75" src="<?php echo Utilities::getProfileImage($user->marryId,$image) ?>" alt="" /></a>
				<a href="<?php echo Utilities::createAbsoluteUrl('mypage','',array()); ?>" class="pName"><?php echo $user->name?></a>
			</li>
        </ul>
        <?php 
        if(false){
        if($user->userType == 1) { 
        $payments = $user->payment(array('condition'=>"actionItem = 'membership'",'order'=> 'startdate DESC limit 0,1'));
        if(isset($payments) && isset($payments[0]))
        {
        	$payment = $payments[0]
		?>
		<ul class="left-bar-data">
			<li>
			<?php 
        	$currentDate = new DateTime('now');
        	$date = new DateTime($payment->startdate);
        	$endDate = new DateTime($payment->startdate);
			$endDate->modify('+90 days');
			if($endDate > $currentDate) {
			$balance = $currentDate->diff($endDate);
			?>
			<div class="moreDay"><span><?php echo $balance->format('%a');?></span> More Days</div>
				<div class="remain">Remaining. <a href="/payment/recharge" >Re-Charge Now</a></div>
			<?php 
			
			}
			 ?>
			
			</li>
        </ul>
       <?php 	
        }	
        } else {?>
        <ul class="left-bar-data">
			<li>
				<div class="uNot">You Have Not Subscribed Yet!!</div>
				<a href="/payment" class="subNow">Subscribe NOW!</a>
				<div class="subOnly">Only for <span class="WebRupee">Rs.</span><span class="forAmt">200!</span></div>
			</li>
        </ul>
        <?php }
        }?>
        
        <ul class="left-bar-data">
            <li><a href="<?php echo Utilities::createAbsoluteUrl('mypage','index',array()); ?>" class="select headLink">My Page</a></li>
            <li><a target="_blank" href="<?php echo Utilities::createAbsoluteUrl('mypage','profile',array()); ?>" class="headLink">My Profile</a></li>
            <li><a href="<?php echo Utilities::createAbsoluteUrl('mypage','account',array()); ?>" class="headLink">My Account</a></li>
            <li>
				<a href="<?php echo Utilities::createAbsoluteUrl('mypage','document',array()); ?>" class="headLink">My Documents</a>
				<a class="infoB" href="javascript:void(0)">?</a>
				<div class="infoBox">
					<div class="iArrow"></div>
					<div class="iHead">What is My Document</div>
					<p>Documents such as passport, ration card, voters ID, pan card, bank passbook, school certificate, university certificate are considered as my documents.</p>
				</div>
			</li>
			<li><a href="<?php echo Utilities::createAbsoluteUrl('mypage','album',array()); ?>" class="headLink">My Album</a></li>
            <li><a href="<?php echo Utilities::createAbsoluteUrl('mypage','familyalbum',array()); ?>" class="headLink">My Family Album</a></li>
            <li><a href="<?php echo Utilities::createAbsoluteUrl('mypage','astro',array()); ?>" class="headLink">My Astro Details</a></li>
            <li><a href="<?php echo Utilities::createAbsoluteUrl('mypage','partnerpreference')?>" class="headLink">My Partner Preference</a></li>
			<li>
				<a href="<?php echo Utilities::createAbsoluteUrl('mypage','reference',array()); ?>" class="headLink">My Reference</a>
				<a class="infoB" href="javascript:void(0)">?</a>
				<div class="infoBox">
					<div class="iArrow"></div>
					<div class="iHead">What is My Reference</div>
					<p>My reference is where you can add the references of people who can vouch for your character. You can add teachers and important people in your locality as your references. </p>
				</div>
			</li>
            <li><a href="<?php echo Utilities::createAbsoluteUrl('mypage','contact',array()); ?>" class="headLink">My Contact Details</a></li>
            <li>
				<a href="<?php echo Utilities::createAbsoluteUrl('mypage','shortlist',array()); ?>" class="headLink">My Shortlists</a>
				<a class="infoB" href="javascript:void(0)">?</a>
				<div class="infoBox">
					<div class="iArrow"></div>
					<div class="iHead">What is My Shortlists</div>
					<p>You might get interested in many profiles and many people might show interest in your profile. If the interest is mutually accepted, you can short list the profiles you want to contact later. </p>
				</div>
			</li>
			<li>
				<a href="<?php echo Utilities::createAbsoluteUrl('mypage','bookmark',array()); ?>" class="headLink">My Bookmarks</a>
				<a class="infoB" href="javascript:void(0)">?</a>
				<div class="infoBox">
					<div class="iArrow"></div>
					<div class="iHead">What is My Bookmarks</div>
					<p>Bookmark is a way to keep the profiles of your interest aside and check them in detail later. You can see the bookmarks when you long on next time.</p>
				</div>
			</li>
            <li>
				<a href="<?php echo Utilities::createAbsoluteUrl('addressbook','index',array()); ?>" class="headLink">My Address book</a>
				<a class="infoB" href="javascript:void(0)">?</a>
				<div class="infoBox">
					<div class="iArrow"></div>
					<div class="iHead">What is My Addressbook</div>
					<p>Address book is a place to where you can import the address to my address book. This way you can access the details later without visiting a particular profile again. </p>
				</div>
			</li>
			<!--<li><a href="<?php echo Utilities::createAbsoluteUrl('payment','summary',array()); ?>" class="headLink">My Payment summery</a></li>
			  <li><a href="<?php echo Utilities::createAbsoluteUrl('mypage','settings',array()); ?>" class="headLink">My Settings</a></li> -->
        </ul>
        <ul class="left-bar-data">
            <li>
				<a href="<?php echo Utilities::createAbsoluteUrl('message','',array()); ?>" class="headLink ">Message </a>
				<div class="dataCont">
				<?php 
					$inbox = $user->messageReceiver(array('condition'=>'receiverStatus = 0'));
					$outbox = $user->messageSender(array('condition'=>'senderId = '.$user->userId.' and senderStatus = 0'));
					$acknowledge = $user->messageReceiver(array('condition'=>'status = 2'));
				?>
					<div class="row"><a href="<?php echo Utilities::createAbsoluteUrl('message','index',array('selectedTab'=>'inbox')); ?>" class="innLink">Inbox <?php echo count($inbox); ?></a></div>
					<div class="row"><a href="<?php echo Utilities::createAbsoluteUrl('message','index',array('selectedTab'=>'outbox')); ?>" class="innLink">Outbox <?php echo count($outbox); ?></a></div>
					<!--  <div class="row"><a href="<?php echo Utilities::createAbsoluteUrl('message','acknowledgement',array('selectedTab'=>'ack')); ?>" class="innLink">Delivery aknowledgement <?php echo count($acknowledge); ?></a></div>-->
				</div>
			</li>
        </ul>
        <!-- 
		<ul class="left-bar-data">
            <li>
				<a href="<?php echo Utilities::createAbsoluteUrl('request','sent',array()); ?>" class="headLink ">Request </a>
				<div class="dataCont">
					<?php 
					$receive = $user->requestReceiver(array('condition'=>'status = 0 or status = 1'));
					$sent = $user->requestSender(array('condition'=>'senderId = '.$user->userId));
					$decline = $user->requestReceiver(array('condition'=>'senderId = '.$user->userId.' or receiverId='.$user->userId.' and status = 1'));
					?>
					<div class="row"><a href="<?php echo Utilities::createAbsoluteUrl('request','sent',array('selectedTab'=>'sent')); ?>" class="innLink">Sent <?php echo count($sent)?></a></div>
					<div class="row"><a href="<?php echo Utilities::createAbsoluteUrl('request','sent',array('selectedTab'=>'received')); ?>" class="innLink">Recieved <?php echo count($receive)?></a></div>
					<div class="row"><a href="<?php echo Utilities::createAbsoluteUrl('request','sent',array('selectedTab'=>'declined')); ?>" class="innLink">Declined <?php echo count($decline);?></a></div>
				</div>
			</li>
        </ul>
         -->
		<ul class="left-bar-data">
            <li>
				<a href="<?php echo Utilities::createAbsoluteUrl('interest','sent',array()); ?>" class="headLink ">Interest </a>
				<div class="dataCont">
				<?php 
					$sendInterest = $user->interestSender(array('condition'=>'status = 0 and senderStatus = 0'));
					$receiveInterest = $user->interestReceiver(array('condition'=>'status = 0 and receiverStatus = 0'));
					$declinedInterest = $user->interestReceiver(array('condition'=>'senderId = '.$user->userId.' or receiverId='.$user->userId.' and status = 2 and receiverStatus = 0'));
				?>
					<div class="row"><a href="<?php echo Utilities::createAbsoluteUrl('interest','sent',array('selectedTab'=>'sent'))?>" class="innLink">Sent <?php echo count($sendInterest); ?></a></div>
					<div class="row"><a href="<?php echo Utilities::createAbsoluteUrl('interest','sent',array('selectedTab'=>'received'))?>" class="innLink">Recieved <?php echo count($receiveInterest); ?></a></div>
					<div class="row"><a href="<?php echo Utilities::createAbsoluteUrl('interest','sent',array('selectedTab'=>'declined'))?>" class="innLink">Declined <?php echo count($declinedInterest); ?></a></div>
				</div>
			</li>
        </ul>
		<ul class="left-bar-data">
            <li>
				<div class="mdAddT1 mT12">Want to invite a friend to </div>
				<div class="mdAddT2">marrydoor ?</div>
				<h5>Please enter email</h5>
				<input type="text" name="emails" id="emails" placeholder="Friends Email ID" />
				<div id="inviitation"> <a href="#" class="type2 no-marg">Invite</a></div>
			</li>
        </ul>
    </aside>

    
    <script type="text/javascript">
   
	$("#inviitation").click(function(){
		if($("#emails").val()) {

			var regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+(@[a-zA-Z0-9-]{3,})+(\.[a-zA-Z0-9-]{2,})/; 
			if(!regex.test($("#emails").val())){
			  alert("You must enter a valid e-mail address");
			  return false;
			}

			 $.ajax({
		            type: "POST",
		            url: "/Ajax/updateInvitation",
		            'data':{'email': $("#emails").val()},
		            'dataType':'json',
		            dataType: "json",
		            success: function(data) {
		            	if(data)
		            		$("#emails").val('');
		            }
		        });
			
		}
		return false;
	});
   

</script>
    