<?php
/*
*
* $Id$
--------------------------------------------------------------------------------------------------------------------------
* Information contained in this file is the intellectual property of Ladbrokes Plc
* Copyright © 2012 MarryDorr. All Rights Reserved.
* ---------------------------------------------------------------------------------------------------------------------------
*
* @author  Dileep Gopalan
* @title sent.php
* @description <Description of this class>
*  @filesource <URL>
*  @version <Revision>
*/
?>
<?php $this->widget('application.widgets.menu.Leftmenu'); ?>
<?php 
$user  = Yii::app()->session->get('user');
$heightArray = Utilities::getHeights(); ?>
   <section class="data-contnr2">
        <h1 class="mB10">Interests</h1>
        <div class="interstTab">
			<div class="edit-option">
				<div class="check">
					<input type="checkbox" onclick="toggleChecked(this.checked)" class="reqCheck" value="0" />
					<span>Sellect All</span>
				</div>
				<div class="check">
					<span><a href="#" onclick="deleteInterests();">Delete</a></span>
				</div>
			</div>
			<form name="frmInterest" id="frmInterest" method="post" action="<?php echo Utilities::createAbsoluteUrl('interest','sent',array()); ?>">
			<input type = "hidden" name="selectedIds" id="selectedIds" value="" />
			<input type = "hidden" name="selectedTab" id="selectedTab" value="" />
			<input type = "hidden" name="action" id="action" value="" />
			</form>
			<ul class="tab-head">
				<li id="tab1" onclick="javascript:setSelectedTab('received');">
					<a id="tab1" href="#" <?php if($tab == 'received'){ ?>class="select" <?php }?>>Received</a>
				</li>
				<li id="tab2" onclick="javascript:setSelectedTab('sent');"> 
					<a id="tab2" href="#" <?php if($tab == 'sent'){ ?>class="select" <?php }?> >Sent</a>
				</li>
				<li id="tab3" onclick="javascript:setSelectedTab('accepted');">
					<a id="tab3" href="#" <?php if($tab == 'accepted'){ ?>class="select" <?php }?> >Accepted</a>
				</li>
				<li id="tab4" onclick="javascript:setSelectedTab('declined');">
					<a id="tab4" href="#" <?php if($tab == 'declined'){ ?>class="select" <?php }?> >Declined</a>
				</li>
			</ul>
			<!-- received starts here -->
			<ul id="tab1_data" class="tab-data" <?php if($tab == 'received'){ ?> style="display: block;"<?php }else{ ?> style="display: none;" <?php }?>>
				<?php if(!empty($received)):?>
				<?php foreach($received as $receive):?>  
				<li>
					<input type="checkbox" class="reqCheck" value="<?php echo $receive['interestId']; ?>" />
					<a href="<?php echo Utilities::createAbsoluteUrl('search','byid',array('id'=>$receive['senderMarryId'])); ?>"><img src="<?php echo Utilities::getProfileImage($receive['senderMarryId'],$receive['senderImageName']); ?>" alt="" /></a>
					<div class="int_head">
						<a href="<?php echo Utilities::createAbsoluteUrl('search','byid',array('id'=>$receive['senderMarryId'])); ?>" ><?php echo $receive['senderName']; ?></a>
						<span>(Expressed interest on <?php echo $receive['sendDate']; ?>)</span>
					</div> 
					<div class="pDetails"><?php if(isset($receive['senderReligion']))echo $receive['senderReligion'] ;?>, <?php if(isset($receive['senderCaste']))echo $receive['senderCaste'] ;?>, <?php echo Utilities::getAgeFromDateofBirth($receive['senderAge']); ?> Years - <?php if(isset($receive['senderHeightId']))echo $heightArray[$receive['senderHeightId']]; ?></div>
					<div class="pDetails"><?php if(isset($receive['senderPlace']))echo $receive['senderPlace'] ;?>, <?php if(isset($receive['senderState']))echo $receive['senderState'] ;?>, <?php if(isset($receive['senderCountry']))echo $receive['senderCountry'] ;?></div>
					<a href="#" class="type6 accept" onclick="doInterestAction(<?php echo $receive['interestId']; ?>,'accept','received');">Accept</a>
					<a href="#" class="type6 decline" onclick="doInterestAction(<?php echo $receive['interestId']; ?>,'decline','received');">Decline</a>
				</li>
				<?php endforeach;?>  
				<?php else:?> 
				<li>
					No requests found!
				</li>
				<?php endif;?>			
			</ul>
			<!-- received ends here -->
			<!-- sent starts here -->
			<ul id="tab2_data" class="tab-data" <?php if($tab == 'sent'){ ?> style="display: block;"<?php }else{ ?> style="display: none;" <?php }?>>
				<?php if(!empty($sent)):?>
				<?php foreach($sent as $send):?>  
				<li>
					<input type="checkbox" class="reqCheck" value="<?php echo $send['interestId']; ?>" />
					<a href="<?php echo Utilities::createAbsoluteUrl('search','byid',array('id'=>$send['receiverMarryId'])); ?>"><img src="<?php echo Utilities::getProfileImage($send['receiverMarryId'],$send['receiverImageName']); ?>" alt="" /></a>
					<div class="int_head">
						<a href="<?php echo Utilities::createAbsoluteUrl('search','byid',array('id'=>$send['receiverMarryId'])); ?>" ><?php echo $send['receiverName']; ?></a>
						<span>(You expressed interest on <?php echo $send['sendDate']; ?>)</span>
					</div> 
					<div class="pDetails"><?php if(isset($send['receiverReligion']))echo $send['receiverReligion'] ;?>, <?php if(isset($send['receiverCaste']))echo $send['receiverCaste'] ;?>, <?php echo Utilities::getAgeFromDateofBirth($send['receiverAge']); ?> Years - <?php if(isset($send['receiverHeightId']))echo $heightArray[$send['receiverHeightId']]; ?></div>
					<div class="pDetails"><?php if(isset($send['receiverPlace']))echo $send['receiverPlace'] ;?>, <?php if(isset($send['receiverState']))echo $send['receiverState'] ;?>, <?php if(isset($send['receiverCountry']))echo $send['receiverCountry'] ;?></div>
					<a href="#" class="type6 decline" onclick="doInterestAction(<?php echo $send['interestId']; ?>,'cancel','sent');">Cancel</a>
				</li>
				<?php endforeach;?>  
				<?php else:?> 
				<li>
					No requests found!
				</li>
				<?php endif;?>				
			</ul>
			<!-- sent end here -->
			<!-- accepted starts here -->
			<ul id="tab3_data" class="tab-data" <?php if($tab == 'accepted'){ ?> style="display: block;"<?php }else{ ?> style="display: none;" <?php }?>>
				<!--  <li>
					<div class="optns">
						<div class="option_cont">
							<a href="#">Accepted by me</a> |
							<a href="#">Accepted you</a> 
						</div>
					</div>
				</li>-->
				<?php if(!empty($accepted)):?>
				<?php foreach($accepted as $accept):?>  
				<?php if($accept['senderId'] == $user->userId){?>
				<li>
					<input type="checkbox" class="reqCheck" value="<?php echo $accept['interestId']; ?>" />
					<a href="<?php echo Utilities::createAbsoluteUrl('search','byid',array('id'=>$accept['receiverMarryId'])); ?>"><img src="<?php echo Utilities::getProfileImage($accept['receiverMarryId'],$accept['receiverImageName']); ?>" alt="" /></a>
					<div class="int_head">
						<a href="<?php echo Utilities::createAbsoluteUrl('search','byid',array('id'=>$accept['receiverMarryId'])); ?>" ><?php echo $accept['receiverName']; ?></a>
						<span>(<?php if($accept['receiverId'] == $user->userId){ echo 'You'; } else{
						 if($accept['receiverGender'] == 'M')
							echo 'He';
							else echo 'She';
						}?>	accepted your interest on <?php echo $accept['sendDate']; ?>)</span>
					</div> 
					<div class="pDetails"><?php if(isset($accept['receiverReligion']))echo $accept['receiverReligion'] ;?>, <?php if(isset($accept['receiverCaste']))echo $accept['receiverCaste'] ;?>, <?php echo Utilities::getAgeFromDateofBirth($accept['receiverAge']); ?> Years - <?php if(isset($accept['receiverHeightId']))echo $heightArray[$accept['receiverHeightId']]; ?></div>
					<div class="pDetails"><?php if(isset($accept['receiverPlace']))echo $accept['receiverPlace'] ;?>, <?php if(isset($accept['receiverState']))echo $accept['receiverState'] ;?>, <?php if(isset($accept['receiverCountry']))echo $accept['receiverCountry'] ;?></div>
					<?php if($accept['receiverId'] == $user->userId){?>
					<a href="#" class="type6 decline" onclick="doInterestAction(<?php echo $accept['interestId']; ?>,'decline','accepted');">Decline</a>
					<?php }else{?>
					<a href="#" class="type6 decline" onclick="doInterestAction(<?php echo $accept['interestId']; ?>,'cancel','accepted');">Cancel my request</a>
					<?php }?>
				</li>
				<?php }else{?>
				<li>
					<input type="checkbox" class="reqCheck" value="<?php echo $accept['interestId']; ?>" />
					<a href="<?php echo Utilities::createAbsoluteUrl('search','byid',array('id'=>$accept['senderMarryId'])); ?>"><img src="<?php echo Utilities::getProfileImage($accept['senderMarryId'],$accept['senderImageName']); ?>" alt="" /></a>
					<div class="int_head">
						<a href="<?php echo Utilities::createAbsoluteUrl('search','byid',array('id'=>$accept['senderMarryId'])); ?>" ><?php echo $accept['senderName']; ?></a>
						<span>(<?php if($accept['receiverId'] == $user->userId){ echo 'You'; } else{
						 if($accept['receiverGender'] == 'M')
							echo 'He';
							else echo 'She';
						}?>	accepted <?php if($accept['senderId'] == $user->userId){ echo 'your'; } else{
							if($accept['receiverGender'] == 'M')
							echo 'his';
							else echo 'her';
						}
						?> interest on <?php echo $accept['sendDate']; ?>)</span>
					</div> 
					<div class="pDetails"><?php if(isset($accept['receiverReligion']))echo $accept['receiverReligion'] ;?>, <?php if(isset($accept['receiverCaste']))echo $accept['receiverCaste'] ;?>, <?php echo Utilities::getAgeFromDateofBirth($accept['receiverAge']); ?> Years - <?php if(isset($accept['receiverHeightId']))echo $heightArray[$accept['receiverHeightId']]; ?></div>
					<div class="pDetails"><?php if(isset($accept['receiverPlace']))echo $accept['receiverPlace'] ;?>, <?php if(isset($accept['receiverState']))echo $accept['receiverState'] ;?>, <?php if(isset($accept['receiverCountry']))echo $accept['receiverCountry'] ;?></div>
					<?php if($accept['receiverId'] == $user->userId){?>
					<a href="#" class="type6 decline" onclick="doInterestAction(<?php echo $accept['interestId']; ?>,'decline','accepted');">Decline</a>
					<?php }else{?>
					<a href="#" class="type6 decline" onclick="doInterestAction(<?php echo $accept['interestId']; ?>,'cancel','accepted');">Cancel my request</a>
					<?php }?>
				</li>
				<?php }?>
				<?php endforeach;?>  
				<?php else:?> 
				<li>
					No requests found!
				</li>
				<?php endif;?>	
			</ul>
			<!-- accepted ends here -->
			<!-- declined starts here -->
			<ul id="tab4_data" class="tab-data" <?php if($tab == 'declined'){ ?> style="display: block;"<?php }else{ ?> style="display: none;" <?php }?>>
				<!--  <li>
					<div class="optns">
						<div class="option_cont">
							<a href="#">By You</a> |
							<a href="#">Sent to You</a> 
						</div>
					</div>
				</li>-->
				<?php if(!empty($declined)):?>
				<?php foreach($declined as $decline):?>  
				<?php if($decline['senderId'] == $user->userId){?>
				<li>
					<input type="checkbox" class="reqCheck" value="<?php echo $decline['interestId']; ?>" />
					<a href="<?php echo Utilities::createAbsoluteUrl('search','byid',array('id'=>$decline['receiverMarryId'])); ?>"><img src="<?php echo Utilities::getProfileImage($decline['receiverMarryId'],$decline['receiverImageName']); ?>" alt="" /></a>
					<div class="int_head">
						<a href="<?php echo Utilities::createAbsoluteUrl('search','byid',array('id'=>$decline['receiverMarryId'])); ?>" ><?php echo $decline['receiverName']; ?></a>
						<span>(<?php if($decline['senderId'] == $user->userId){ echo 'You'; } else{
						 if($decline['receiverGender'] == 'M')
							echo 'He';
							else echo 'She';
						}?> expressed interest on <?php echo $decline['sendDate']; ?>)</span>
					</div> 
					<div class="pDetails"><?php if(isset($decline['receiverReligion']))echo $decline['receiverReligion'] ;?>, <?php if(isset($decline['receiverCaste']))echo $decline['receiverCaste'] ;?>, <?php echo Utilities::getAgeFromDateofBirth($decline['receiverAge']); ?> Years - <?php if(isset($decline['receiverHeightId']))echo $heightArray[$decline['receiverHeightId']]; ?></div>
					<div class="pDetails"><?php if(isset($decline['receiverPlace']))echo $decline['receiverPlace'] ;?>, <?php if(isset($decline['receiverState']))echo $decline['receiverState'] ;?>, <?php if(isset($decline['receiverCountry']))echo $decline['receiverCountry'] ;?></div>
					<?php if($decline['receiverId'] == $user->userId){?>
					<div class="pAction">You declined her interest on<?php echo $decline['sendDate']; ?></div>
					<a href="#" class="type6 decline" onclick="doInterestAction(<?php echo $decline['interestId']; ?>,'accept','declined');">Accept interest</a>
					<?php }else{?>
						<div class="pAction"><?php if($decline['receiverId'] == $user->userId){ echo 'You'; } else{
						 if($decline['receiverGender'] == 'M')
							echo 'He';
							else echo 'She';
						}?> declined <?php if($decline['senderId'] == $user->userId){ echo 'your'; } else{
							if($decline['receiverGender'] == 'M')
							echo 'his';
							else echo 'her';
						}
						?> interest on<?php echo $decline['sendDate']; ?></div>
					<?php }?>
				</li>
				<?php }else{?>
					<li>
					<input type="checkbox" class="reqCheck" value="<?php echo $decline['interestId']; ?>" />
					<a href="<?php echo Utilities::createAbsoluteUrl('search','byid',array('id'=>$decline['senderMarryId'])); ?>"><img src="<?php echo Utilities::getProfileImage($decline['senderMarryId'],$decline['senderImageName']); ?>" alt="" /></a>
					<div class="int_head">
						<a href="<?php echo Utilities::createAbsoluteUrl('search','byid',array('id'=>$decline['senderMarryId'])); ?>" ><?php echo $decline['senderName']; ?></a>
						<span>(<?php if($decline['senderId'] == $user->userId){ echo 'You'; } else{
						 if($decline['senderGender'] == 'M')
							echo 'He';
							else echo 'She';
						}?> expressed interest on <?php echo $decline['sendDate']; ?>)</span>
					</div> 
					<div class="pDetails"><?php if(isset($decline['receiverReligion']))echo $decline['receiverReligion'] ;?>, <?php if(isset($decline['receiverCaste']))echo $decline['receiverCaste'] ;?>, <?php echo Utilities::getAgeFromDateofBirth($decline['receiverAge']); ?> Years - <?php if(isset($decline['receiverHeightId']))echo $heightArray[$decline['receiverHeightId']]; ?></div>
					<div class="pDetails"><?php if(isset($decline['receiverPlace']))echo $decline['receiverPlace'] ;?>, <?php if(isset($decline['receiverState']))echo $decline['receiverState'] ;?>, <?php if(isset($decline['receiverCountry']))echo $decline['receiverCountry'] ;?></div>
					<?php if($decline['receiverId'] == $user->userId){?>
					<div class="pAction">You declined her interest on<?php echo $decline['sendDate']; ?></div>
					<a href="#" class="type6 decline" onclick="doInterestAction(<?php echo $decline['interestId']; ?>,'accept','declined');">Accept interest</a>
					<?php }else{?>
						<div class="pAction"><?php if($decline['receiverId'] == $user->userId){ echo 'You'; } else{
						 if($decline['senderGender'] == 'M')
							echo 'He';
							else echo 'She';
						}?> declined <?php if($decline['receiverId'] == $user->userId){ echo 'your'; } else{
							if($decline['senderGender'] == 'M')
							echo 'his';
							else echo 'her';
						}
						?> interest on<?php echo $decline['sendDate']; ?></div>
					<?php }?>
				</li>
				<?php }?>
				<?php endforeach;?>  
				<?php else:?> 
				<li>
					No requests found!
				</li>
				<?php endif;?>	
			</ul>
			<!-- declined ends here -->
		</div>
		<div class="interstTab">
			<div class="edit-option">
				<div class="check">
					<input type="checkbox" onclick="toggleChecked(this.checked)" class="reqCheck" value="0" />
					<span>Sellect All</span>
				</div>
				<div class="check">
					<span><a href="#" onclick="deleteInterests();">Delete</a></span>
				</div>
			</div>
		</div>
    </section>
	<script type="text/javascript">
    function toggleChecked(status) {
    	$(".reqCheck").each( function() {
	    	$(this).attr("checked",status);
    	})
    	}

	function deleteInterests(){
    	var allVals = [];
	     $('.reqCheck').each(function() {
	    	 if($(this).is(':checked')) {
	       		allVals.push($(this).val());
	    	 }
	     });
	     if(allVals.length === 0){
	    	 alert("Select the interest to delete");
	    	 return false;
	     }else{
		    
		     $('#selectedIds').val(allVals);
		     $('#action').val('delete');
	    	 $('#frmInterest').submit();
	     }
	}

	function doInterestAction(interestId,action,tab){
		$('#selectedIds').val(interestId);
		$('#action').val(action);
		$('#selectedTab').val(tab);
   	 	$('#frmInterest').submit();
	}

	function setSelectedTab(tab){
		$('#selectedTab').val(tab);
	}
    </script>
<?php $this->widget('application.widgets.menu.Rightmenu'); ?>
  