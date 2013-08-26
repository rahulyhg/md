<?php $user  = Yii::app()->session->get('user');
$heightArray = Utilities::getHeights();
 ?>
<div class="noti_contnr">
			<div class="notifications">
				
				<a href="#" id="tab1" class="like">
				<?php if(count($dInterests) > 0){?>
				<div class="count" style="display: block"  id="tab1_count"><?php echo count($dInterests);?></div>
			<?php }?>
				</a>
				<a href="#" id="tab2" class="noti">
				<?php if(isset($notifications ) && sizeof($notifications ) > 0 ) {?>
					<div class="count" style="display:block"  id="tab2_count" > <?php echo count($notifications)?></div>
				<?php }  ?>
				</a>
				<a href="#" id="tab3" class="people_select">
				<?php if(count($dVisitors) > 0){ ?>
					<div class="count"  id="tab3_count"><?php echo count($dVisitors);?></div>
				<?php }?>
				</a>
				<a href="#" id="tab4" class="message">
				<?php if($dMessagesCount > 0){ ?>
					<div class="count" style="display:block" id="tab4_count"><?php echo $dMessagesCount;?></div>
				<?php }?>
				</a>
				<!--  <a href="#" id="tab5" class="lock">
					<div class="count"></div>
				</a>-->
			</div>
			<ul class="notiTabData" id="tab1_notif">
			<?php if($user->userType != 1){?>
			<li>
					<div class="noti_head">Interests</div>
				</li>
				<li>
					<div class="noti_message">
						Sorry, you are not allowed to enjoy this service. Because this services is only offered to members who are Marrydoor subscibers. Just by paying <span>Rs.200/-</span> you can now subscribe to Marydoor and can enjoy unlimited features and services.
					</div>
				</li>
				<li>
					<div class="noti_sn"><a  href="<?php echo Utilities::createAbsoluteUrl('payment','index') ?>">Subscribe Now</a></div>
				</li>
			<?php }else{?>	
			<?php if(!empty($dInterests)):
				$count = 0;
			?>
				<?php foreach($dInterests as $interest):
				 if($count <= 5) {
				?> 
				<?php if($interest['senderId'] == $user->userId) { ?>
				<li>
					<a href="#"><img alt="" src="<?php echo Utilities::getProfileImage($interest['receiverMarryId'],$interest['receiverImageName']); ?>"></a>
					<div class="int_head">
						<a href="#"><?php echo $interest['receiverName']; ?></a>
						<span>(
						<?php if($interest['status'] == 0){
							$status = "Expressed";
							}elseif($interest['status'] == 1){
								$status = "Accepted";
							}elseif($interest['status'] == 2){
								$status = "Declined";
							}
					  echo $status; ?>&npsp;interest on <?php echo $interest['sendDate']; ?>)</span>
					</div> 
					<div class="pDetails"><?php if(isset($interest['receiverReligion']))echo $interest['receiverReligion'] ;?>, <?php if(isset($interest['receiverCaste']))echo $interest['receiverCaste'] ;?>, <?php echo Utilities::getAgeFromDateofBirth($interest['receiverAge']); ?> Years - <?php if(isset($interest['receiverHeightId']))echo $heightArray[$interest['receiverHeightId']]; ?></div>
					<div class="pDetails"><?php if(isset($interest['receiverPlace']))echo $interest['receiverPlace'] ;?>, <?php if(isset($interest['receiverState']))echo $interest['receiverState'] ;?>, <?php if(isset($interest['receiverCountry']))echo $interest['receiverCountry'] ;?></div>
					<?php if($interest['status'] == 0){ ?>
						<a class="type7 accept" href="#">Accept</a>
						<a class="type7 decline" href="#">Decline</a>				
					<?php }else{ ?>
						<a class="type7 decline" href="#">Add to shortlist</a>
					<?php } ?>
				</li>
				<?php }else{ ?>
					<li>
					<a href="#"><img alt="" src="<?php echo Utilities::getProfileImage($interest['senderMarryId'],$interest['senderImageName']); ?>"></a>
					<div class="int_head">
						<a href="#"><?php echo $interest['senderName']; ?></a>
						<span>(<?php if($interest['status'] == 0){
							$status = "Expressed";
							}elseif($interest['status'] == 1){
								$status = "Accepted";
							}elseif($interest['status'] == 2){
								$status = "Declined";
							}
					  echo $status; ?>&nbsp;interest on <?php echo $interest['sendDate']; ?>)</span>
					</div> 
					<div class="pDetails"><?php if(isset($interest['senderReligion']))echo $interest['senderReligion'] ;?>, <?php if(isset($interest['senderCaste']))echo $interest['senderCaste'] ;?>, <?php echo Utilities::getAgeFromDateofBirth($interest['senderAge']); ?> Years - <?php if(isset($interest['senderHeightId']))echo $heightArray[$interest['senderHeightId']]; ?></div>
					<div class="pDetails"><?php if(isset($interest['senderPlace']))echo $interest['senderPlace'] ;?>, <?php if(isset($interest['senderState']))echo $interest['senderState'] ;?>, <?php if(isset($interest['senderCountry']))echo $interest['senderCountry'] ;?></div>
					<?php if($interest['status'] == 1){ ?>
					<a class="type7 decline" href="#">Add to shortlist</a>
					<?php } ?>
				</li>
				<?php } ?>
				<?php 
				}
				$count ++;
				endforeach;?>  
				<?php else:?> 
				<li>
					No new interests found!
				</li>
				<li>
					<p class="notiFoot"><a href="<?php echo Utilities::createAbsoluteUrl('interest','sent',array('selectedTab'=>'received'))?>">Click to see more</a></p>
				</li>
				<?php endif;?>		
				<?php if(count($dInterests) > 5){ ?>
				<li>
					<p class="notiFoot">You have recieved <?php echo count($dInterests) - 5; ?> more interests. <a href="<?php echo Utilities::createAbsoluteUrl('interest','sent',array('selectedTab'=>'received'))?>">Click to see more</a></p>
				</li>
				<?php } } ?>
				
			</ul>
			<ul class="notiTabData" id="tab2_notif">
			<?php if($user->userType != 1){?>
				<li>
					<div class="noti_head">Notifications</div>
				</li>
				<li>
					<div class="noti_message">
						Sorry, you are not allowed to enjoy this service. Because this services is only offered to members who are Marrydoor subscibers. Just by paying <span>Rs.200/-</span> you can now subscribe to Marydoor and can enjoy unlimited features and services.
					</div>
				</li>
				<li>
					<div class="noti_sn"><a  href="<?php echo Utilities::createAbsoluteUrl('payment','index') ?>">Subscribe Now</a></div>
				</li>
				<?php }else{?>
				<?php
				if(isset($notifications ) && sizeof($notifications ) > 0 ) { 
					$show = true; 
					 $index = 0;
					foreach ($notifications  as $value) {	?>
					
				
				<li>
					<a target="_blank" href="#"><img width="75" height="75" src="<?php echo Utilities::getProfileImageForId($value->userId) ?>" alt="" /></a>
					<input name="userId" type="hidden" value="<?php echo $value->notificationId?>" />
					<a target="_blank" class="user_name" href="<?php echo '/search/byid/id/'.$value->marryId ?>"><?php echo $value->name?></a>
					<div class="user_message"><?php echo $value->notification?>. (<?php echo $value->createdate?>)</div>
				</li>
				
               <?php 
					$index++;
					}?>
					<?php }else{
						?>
						<li class="cDefalt">
							No notifications found
						</li>
					<?php 
					}?>
					<!--<li>
						<p class="notiFoot"><a href="<?php echo Utilities::createAbsoluteUrl('user','notification') ?>">Click here</a> to view all notifications</p>
					</li>-->
					<?php 
					}
					?>
					
				</ul>
			<ul class="notiTabData" id="tab3_notif">
				<?php if($user->userType != 1){?>
				<li>
					<div class="noti_head">Visitors</div>
				</li>
				<li>
					<div class="noti_message">
						Sorry, you are not allowed to enjoy this service. Because this services is only offered to members who are Marrydoor subscibers. Just by paying <span>Rs.200/-</span> you can now subscribe to Marydoor and can enjoy unlimited features and services.
					</div>
				</li>
				<li>
					<div class="noti_sn"><a  href="<?php echo Utilities::createAbsoluteUrl('payment','index') ?>">Subscribe Now</a></div>
				</li>
				<?php }else{?>
					<?php if(count($dVisitors) > 0){ ?>
				<li>
					<p class="notiFoot">You have <?php echo count($dVisitors); ?> new visitors</p>
				</li>
				<?php }?>
				<?php if(!empty($dVisitors)){ ?>
				<li class="cDefalt">
				<?php foreach($dVisitors as $visitor): ?>
					<div class="vistrNot">
						<a href="<?php echo Utilities::createAbsoluteUrl('search','byid',array('id'=>$visitor['marryId'])) ?>" target="_blank"><img alt="" src="<?php echo Utilities::getProfileImage($visitor['marryId'],$visitor['imageName']); ?>"></a>
					</div>
				<?php endforeach; ?>
				</li>
				<?php } else{ 
					if(!empty($dMostVisitors)){?>
					<li class="cDefalt">
					<?php 
						foreach($dMostVisitors as $visitor){ ?>
							<div class="vistrNot">
								<a href="<?php echo Utilities::createAbsoluteUrl('search','byid',array('id'=>$visitor['marryId'])) ?>" target="_blank"><img alt="" src="<?php echo Utilities::getProfileImage($visitor['marryId'],$visitor['imageName']); ?>"></a>
							</div>
					<?php 
						}?>
						</li>
						<?php 
					}else{
					?>
				<li class="cDefalt">
						No visitors found
				</li>
				<?php } } ?>
				<li>
					<p class="notiFoot"><a href="<?php echo Utilities::createAbsoluteUrl('visitor','index') ?>">Click here</a> to view all visitors</p>
				</li>
				<?php }?>
			</ul>
			<ul class="notiTabData" id="tab4_notif">
				<?php if($user->userType != 1){?>
				<li>
					<div class="noti_head">Messages</div>
				</li>
				<li>
					<div class="noti_message">
						Sorry, you are not allowed to enjoy this service. Because this services is only offered to members who are Marrydoor subscibers. Just by paying <span>Rs.200/-</span> you can now subscribe to Marydoor and can enjoy unlimited features and services.
					</div>
				</li>
				<li>
					<div class="noti_sn"><a  href="<?php echo Utilities::createAbsoluteUrl('payment','index') ?>">Subscribe Now</a></div>
				</li>
				<?php }else{?>
				<?php if(!empty($dMessages)): ?>
			<?php foreach($dMessages as $message): ?>
				<li class="unread" id="<?php echo $message['messageId']; ?>">
					<a href="<?php echo Utilities::createAbsoluteUrl('search','byid',array('id'=>$message['senderMarryId']))?>" target="_blank"><img alt="" src="<?php echo Utilities::getProfileImage($message['senderMarryId'],$message['senderImageName']); ?>"></a>
					<a class="user_name" href="<?php echo Utilities::createAbsoluteUrl('message','conversation',array('senderId'=>$message['senderId'])); ?>"><?php echo $message['senderName']; ?></a>
					<div class="user_message"><?php echo $message['message']; ?></div>
					<div class="msge_data">
						<a class="close" href="#" onclick="deleteMessage(<?php echo $message['messageId']; ?>,'inbox');"></a>
						<div class="date"><?php echo $message['sendDate']; ?></div>
					</div>
				</li>
			<?php endforeach; ?>
			<?php else: ?>
			<li>No messages found</li>
			<?php endif; ?>
				<li>
					<p class="notiFoot"><a href="<?php echo Utilities::createAbsoluteUrl('message','index')?>">Click here</a> to read all messages.</p>
				</li>
				
			<?php }?>	
			</ul>
			
		</div>
<script type="text/javascript">
function deleteMessage(messageId){
	//make the ajax call to update the status
    $.ajax({
        url: "/Ajax/deletemessage",  
        type: "POST",
        dataType:'json',
        data:{'messageId':messageId},   
        cache: false,
        success: function (html) {
	        if(html == true)
	        	$("#"+messageId).hide();	         
        }       
    });
}
</script>