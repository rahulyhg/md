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
        <h1 class="mB10">Requests</h1>
        <div class="interstTab">
			<div class="edit-option">
				<div class="check">
					<input type="checkbox" onclick="toggleChecked(this.checked)" />
					<span>Sellect All</span>
				</div>
				<div class="check">
					<span><a href="#" onclick="deleteRequests();">Delete</a></span>
				</div>
			</div>
			<form name="frmInterest" id="frmInterest" method="post" action="<?php echo Utilities::createAbsoluteUrl('request','sent',array()); ?>">
			<input type = "hidden" name="selectedIds" id="selectedIds" value="" />
			<input type = "hidden" name="selectedTab" id="selectedTab" value="" />
			<input type = "hidden" name="action" id="action" value="" />
			</form>
			<ul class="tab-head">
				<li id="tab1">
					<a id="tab1" href="#" <?php if($tab == 'received'){ ?>class="select" <?php }?>>Received</a>
				</li>
				<li id="tab2"> 
					<a id="tab2" href="#" <?php if($tab == 'sent'){ ?>class="select" <?php }?> >Sent</a>
				</li>
				<li id="tab3">
					<a id="tab3" href="#" <?php if($tab == 'accepted'){ ?>class="select" <?php }?> >Accepted</a>
				</li>
				<li id="tab4">
					<a id="tab4" href="#" <?php if($tab == 'declined'){ ?>class="select" <?php }?> >Declined</a>
				</li>
			</ul>
			<!-- received starts here -->
			<ul id="tab1_data" class="tab-data" <?php if($tab == 'received'){ ?> style="display: block;"<?php }else{ ?> style="display: none;" <?php }?>>
				<li>
					<div class="optns">
						<div class="option_cont">
							Filter
							<a href="#">My album</a> |
							<a href="#">Family Album</a> |
							<a href="#">Documents</a> |
							<a href="#">Reference</a> |
							<a href="#">Astro</a> |
							<a href="#">Contact</a>
						</div>
					</div>
				</li>
				<?php if(!empty($received)):?>
				<?php foreach($received as $receive):?>  
				<li>
					<input type="checkbox" class="reqCheck" value="<?php echo $receive['requestId']; ?>" />
					<a href="#"><img src="<?php echo Utilities::getProfileImage($receive['senderMarryId'],$receive['senderImageName']); ?>" alt="" /></a>
					<div class="int_head">
						<a href="#" ><?php echo $receive['senderName']; ?></a>
						<span>(You received request on <?php echo $receive['sendDate']; ?>)</span>
					</div> 
					<div class="pDetails"><?php if(isset($receive['senderReligion']))echo $receive['senderReligion'] ;?>, <?php if(isset($receive['senderCaste']))echo $receive['senderCaste'] ;?>, <?php echo Utilities::getAgeFromDateofBirth($receive['senderAge']); ?> Years - <?php if(isset($receive['senderHeightId']))echo $heightArray[$receive['senderHeightId']]; ?></div>
					<div class="pDetails"><?php if(isset($receive['senderPlace']))echo $receive['senderPlace'] ;?>, <?php if(isset($receive['senderState']))echo $receive['senderState'] ;?>, <?php if(isset($receive['senderCountry']))echo $receive['senderCountry'] ;?></div>
					<div class="pAction">A request for viewing your <?php echo Utilities::getRequestTypeText($receive['requestType'])?></div>
					<a href="#" class="type6 accept" onclick="doRequestAction(<?php echo $receive['interestId']; ?>,'accept','received');">Accept</a>
					<a href="#" class="type6 decline" onclick="doRequestAction(<?php echo $receive['interestId']; ?>,'decline','received');">Decline</a>
				</li>
				<?php endforeach;?>  
				<?php else:?> 
				<li>
					No requests found!
				</li>
				<?php endif;?>	
			</ul>
			<!-- received end here -->
			<!-- sent starts here -->
			<ul id="tab2_data" class="tab-data" <?php if($tab == 'sent'){ ?> style="display: block;"<?php }else{ ?> style="display: none;" <?php }?>>
				<li>
					<div class="optns">
						<div class="option_cont">
							Filter
							<a href="#">My album</a> |
							<a href="#">Family Album</a> |
							<a href="#">Documents</a> |
							<a href="#">Reference</a> |
							<a href="#">Astro</a> |
							<a href="#">Contact</a> 
						</div>
					</div>
					<div class="optns">
						<div class="option_cont">
							<a class="color" href="#">By You</a> |
							<a class="color" href="#">Sent to You</a> 
						</div>
					</div>
				</li>
				<?php if(!empty($sent)):?>
				<?php foreach($sent as $send):?>  
				<li>
					<input type="checkbox" class="reqCheck" value="<?php echo $send['requestId']; ?>" />
					<a href="#"><img src="<?php echo Utilities::getProfileImage($send['receiverMarryId'],$send['receiverImageName']); ?>" alt="" /></a>
					<div class="int_head">
						<a href="#" ><?php echo $send['receiverName']; ?></a>
						<span>(You sent request on <?php echo $send['sendDate']; ?>)</span>
					</div> 
					<div class="pDetails"><?php if(isset($send['receiverReligion']))echo $send['receiverReligion'] ;?>, <?php if(isset($send['receiverCaste']))echo $send['receiverCaste'] ;?>, <?php echo Utilities::getAgeFromDateofBirth($send['receiverAge']); ?> Years - <?php if(isset($send['receiverHeightId']))echo $heightArray[$send['receiverHeightId']]; ?></div>
					<div class="pDetails"><?php if(isset($send['receiverPlace']))echo $send['receiverPlace'] ;?>, <?php if(isset($send['receiverState']))echo $send['receiverState'] ;?>, <?php if(isset($send['receiverCountry']))echo $send['receiverCountry'] ;?></div>
						<div class="pAction">Sent a request for viewing <?php if($send['receiverGender'] == 'F'){ ?>her<?php }else{ ?>his <?php }?> <?php echo Utilities::getRequestTypeText($send['requestType'])?></div>
					<a href="#" class="type6 decline" onclick="doRequestAction(<?php echo $send['requestId']; ?>,'cancel','sent');">Cancel</a>
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
				<li>
					<div class="optns">
						<div class="option_cont">
							Filter
							<a href="#">My album</a> |
							<a href="#">Family Album</a> |
							<a href="#">Documents</a> |
							<a href="#">Reference</a> |
							<a href="#">Astro</a> |
							<a href="#">Contact</a> 
						</div>
					</div>
					<div class="optns">
						<div class="option_cont">
							<a class="color" href="#">By You</a> |
							<a class="color" href="#">Sent to You</a> 
						</div>
					</div>
				</li>
				<?php if(!empty($accepted)):?>
				<?php foreach($accepted as $accept):?>  
				<li>
					<input type="checkbox" class="reqCheck" value="<?php echo $accept['requestId']; ?>" />
					<a href="#"><img src="<?php echo Utilities::getProfileImage($accept['receiverMarryId'],$accept['receiverImageName']); ?>" alt="" /></a>
					<div class="int_head">
						<a href="#" ><?php echo $accept['receiverName']; ?></a>
						<span>(<?php if($accept['senderGender'] == 'M')
							echo 'He';
							else echo 'She';
						?> sent an <?php echo Utilities::getRequestTypeText($accept['requestType'])?> request on <?php echo $accept['sendDate']; ?>)</span>
					</div> 
					<div class="pDetails"><?php if(isset($accept['receiverReligion']))echo $accept['receiverReligion'] ;?>, <?php if(isset($accept['receiverCaste']))echo $accept['receiverCaste'] ;?>, <?php echo Utilities::getAgeFromDateofBirth($accept['receiverAge']); ?> Years - <?php if(isset($accept['receiverHeightId']))echo $heightArray[$accept['receiverHeightId']]; ?></div>
					<div class="pDetails"><?php if(isset($accept['receiverPlace']))echo $accept['receiverPlace'] ;?>, <?php if(isset($accept['receiverState']))echo $accept['receiverState'] ;?>, <?php if(isset($accept['receiverCountry']))echo $accept['receiverCountry'] ;?></div>
					<div class="pAction">You accepted <?php if($accept['senderGender'] == 'M')
							echo 'his';
							else echo 'her';
						?> <?php echo Utilities::getRequestTypeText($accept['requestType'])?> request on <?php echo $accept['sendDate']; ?></div>
					<div class="pDetails"><?php if(isset($accept['receiverReligion']))echo $accept['receiverReligion'] ;?>, <?php if(isset($accept['receiverCaste']))echo $accept['receiverCaste'] ;?>, <?php echo Utilities::getAgeFromDateofBirth($accept['receiverAge']); ?> Years - <?php if(isset($accept['receiverHeightId']))echo $heightArray[$accept['receiverHeightId']]; ?></div>
					<div class="pDetails"><?php if(isset($accept['receiverPlace']))echo $accept['receiverPlace'] ;?>, <?php if(isset($accept['receiverState']))echo $accept['receiverState'] ;?>, <?php if(isset($accept['receiverCountry']))echo $accept['receiverCountry'] ;?></div>
					<?php if($accept['receiverId'] == $user->userId){?>
					<a href="#" class="type6 decline" onclick="doRequestAction(<?php echo $accept['requestId']; ?>,'decline','accepted');">Decline</a>
					<?php }else{?>
					<a href="#" class="type6 decline" onclick="doRequestAction(<?php echo $accept['requestId']; ?>,'cancel','accepted');">Cancel my request</a>
					<?php }?>
				</li>
				<?php endforeach;?>  
				<?php else:?> 
				<li>
					No requests found!
				</li>
				<?php endif;?>
			</ul>
			<!-- accepted end here -->
			<!-- declined starts here -->
			<ul id="tab4_data" class="tab-data" <?php if($tab == 'declined'){ ?> style="display: block;"<?php }else{ ?> style="display: none;" <?php }?>>
				<li>
					<div class="optns">
						<div class="option_cont">
							Filter
							<a href="#">My album</a> |
							<a href="#">Family Album</a> |
							<a href="#">Documents</a> |
							<a href="#">Reference</a> |
							<a href="#">Astro</a> |
							<a href="#">Contact</a> 
						</div>
					</div>
					<div class="optns">
						<div class="option_cont">
							<a class="color" href="#">By You</a> |
							<a class="color" href="#">Sent to You</a> 
						</div>
					</div>
				</li>
				<?php if(!empty($declined)):?>
				<?php foreach($declined as $decline):?>  
				<li>
					<input type="checkbox" class="reqCheck" value="<?php echo $decline['requestId']; ?>" />
					<a href="#"><img src="<?php echo Utilities::getProfileImage($decline['receiverMarryId'],$decline['receiverImageName']); ?>" alt="" /></a>

					<div class="int_head">
						<a href="#" ><?php echo $decline['receiverName']; ?></a>
						<span>(<?php 
						 if($decline['receiverGender'] == 'M')
							echo 'He';
							else echo 'She';
						?> sent an <?php echo Utilities::getRequestTypeText($decline['requestType'])?> request on <?php echo $decline['sendDate']; ?>)</span>
					</div> 
					<div class="pDetails"><?php if(isset($decline['receiverReligion']))echo $decline['receiverReligion'] ;?>, <?php if(isset($decline['receiverCaste']))echo $decline['receiverCaste'] ;?>, <?php echo Utilities::getAgeFromDateofBirth($decline['receiverAge']); ?> Years - <?php if(isset($decline['receiverHeightId']))echo $heightArray[$decline['receiverHeightId']]; ?></div>
					<div class="pDetails"><?php if(isset($decline['receiverPlace']))echo $decline['receiverPlace'] ;?>, <?php if(isset($decline['receiverState']))echo $decline['receiverState'] ;?>, <?php if(isset($decline['receiverCountry']))echo $decline['receiverCountry'] ;?></div>
					<div class="pAction">You declined <?php if($decline['senderGender'] == 'M')
							echo 'his';
							else echo 'her';
						?> <?php echo Utilities::getRequestTypeText($decline['requestType'])?> request on <?php echo $decline['sendDate']; ?></div>
					<a href="#" class="type6 decline" onclick="doRequestAction(<?php echo $decline['requestId']; ?>,'accept','declined');">Accept interest</a>
				</li>
				<?php endforeach;?>  
				<?php else:?> 
				<li>
					No requests found!
				</li>
				<?php endif;?>	
			</ul>
			<!-- declined end here -->
		</div>
		<div class="interstTab">
			<div class="edit-option">
				<div class="check">
					<input type="checkbox" onclick="toggleChecked(this.checked)" />
					<span>Sellect All</span>
				</div>
				<div class="check">
					<span><a href="#" onclick="deleteRequests();">Delete</a></span>
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

	function deleteRequests(){
    	var allVals = [];
	     $('.reqCheck').each(function() {
	    	 if($(this).is(':checked')) {
	       		allVals.push($(this).val());
	    	 }
	     });
	     if(allVals.length === 0){
	    	 alert("Select the request to delete");
	    	 return false;
	     }else{
		    
		     $('#selectedIds').val(allVals);
		     $('#action').val('delete');
	    	 $('#frmInterest').submit();
	     }
	}

	function doRequestAction(interestId,action,tab){
		$('#selectedIds').val(interestId);
		$('#action').val(action);
		$('#selectedTab').val(tab);
   	 	$('#frmInterest').submit();
	}
    </script>
      <?php $this->widget('application.widgets.menu.Rightmenu'); ?>
  