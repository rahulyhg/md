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
* @title index.php
* @description <Description of this class>
*  @filesource <URL>
*  @version <Revision>
*/
?>
<?php $this->widget('application.widgets.menu.Leftmenu'); ?>
<section class="data-contnr2">
        <h1 class="mB10">Messages</h1>
        <div class="interstTab">
			<div class="edit-option">
				<div class="check">
					<input type="checkbox" onclick="toggleChecked(this.checked)" class="msgCheck" value="0" />
					<span>Sellect All</span>
				</div>
				<div class="check">
					<span><a href="#" onclick="deleteMessages();">Delete</a></span>
				</div>
			</div>
			<form name="frmMessage" id="frmMessage" method="post" action="<?php echo Utilities::createAbsoluteUrl('message','index',array()); ?>">
			<input type = "hidden" name="selectedIds" id="selectedIds" value="" />
			<input type = "hidden" name="selectedTab" id="selectedTab" value="" />
			<input type = "hidden" name="action" id="action" value="" />
			</form>
			<ul class="tab-head">
				<li id="tab1" onclick="javascript:setSelectedTab('inbox');">
					<a id="tab1" href="#" <?php if($page == 'inbox'){ ?>class="select " <?php }?>>Inbox</a>
				</li>
				<li id="tab2" onclick="javascript:setSelectedTab('outbox');"> 
					<a id="tab2" href="#" <?php if($page == 'outbox'){ ?>class="select " <?php }?>>Outbox</a>
				</li>
				<!--  <li id="tab3">
					<a id="tab3" href="#" <?php if($page == 'acknowledgement'){ ?>class="select " <?php }?> style="width: 166px;">Delivery acknowledgement</a>
				</li>-->
			</ul>
			<!--  inbox starts here -->
			<ul id="tab1_data" class="tab-data" <?php if($page == 'inbox'){ ?> style="display: block;" <?php }else{ ?> style="display: none;" <?php }?>>
				<?php if(!empty($inbox)):?>
				<?php foreach($inbox as $inmessage):?>     
				<li <?php if($inmessage['status'] == 0){ ?>class="unread" <?php }?>>
					<input type="checkbox" class="msgCheck" value="<?php echo $inmessage['messageId']; ?>" />
					<a href="<?php echo Utilities::createAbsoluteUrl('search','byid',array('id'=>$inmessage['senderMarryId'])); ?>" target="_blank"><img src="<?php echo Utilities::getProfileImage($inmessage['senderMarryId'],$inmessage['senderImageName']); ?>" alt="" /></a>
					<a href="<?php echo Utilities::createAbsoluteUrl('message','conversation',array('senderId'=>$inmessage['senderId'])); ?>" class="user_name"><?php echo $inmessage['senderName']; ?></a>
					<a href="<?php echo Utilities::createAbsoluteUrl('message','conversation',array('senderId'=>$inmessage['senderId'])); ?>"><div class="user_message"><?php echo $inmessage['message']; ?></div></a>
					<div class="msge_data">
						<a href="#" class="close" onclick="deleteMessage(<?php echo $inmessage['messageId']; ?>,'inbox');"></a>
						<div class="date"><?php echo $inmessage['sendDate']; ?></div>
					</div>
					<a href="<?php echo Utilities::createAbsoluteUrl('message','conversation',array('senderId'=>$inmessage['senderId'])); ?>">Replay</a>
				</li>
				<?php endforeach;?>  
				<?php else:?> 
				<li>
					No messages found!
				</li>
				<?php endif;?>
			</ul>
			<!--  inbox ends here -->
			<!--  outbox starts here -->
			<ul id="tab2_data" class="tab-data" <?php if($page == 'outbox'){ ?> style="display: block;" <?php }else{ ?> style="display: none;" <?php }?>>
			<?php if(!empty($outbox)):?>
				<?php foreach($outbox as $outmessage):?>
				<li <?php if($outmessage['status'] == 0){ ?>class="unread" <?php }?>>
					<input type="checkbox" class="msgCheck" value="<?php echo $outmessage['messageId']; ?>" />
					<a href="<?php echo Utilities::createAbsoluteUrl('search','byid',array('id'=>$outmessage['receiverMarryId'])); ?>" target="_blank"><img src="<?php echo Utilities::getProfileImage($outmessage['receiverMarryId'],$outmessage['receiverImageName']); ?>" alt="" /></a>
					<a href="<?php echo Utilities::createAbsoluteUrl('message','conversation',array('senderId'=>$outmessage['receiverId'])); ?>" class="user_name"><?php echo $outmessage['receiverName']; ?></a>
					<a href="<?php echo Utilities::createAbsoluteUrl('message','conversation',array('senderId'=>$outmessage['receiverId'])); ?>"><div class="sent_message"><?php echo $outmessage['message']; ?></div></a>
					<div class="msge_data">
						<a href="#" class="close" onclick="deleteMessage(<?php echo $outmessage['messageId']; ?>,'outbox');"></a>
						<div class="date"><?php echo $outmessage['sendDate']; ?></div>
					</div>
					<a href="<?php echo Utilities::createAbsoluteUrl('message','conversation',array('senderId'=>$outmessage['receiverId'])); ?>">Replay</a>
				</li>
			<?php endforeach;?>
			<?php else:?> 
				<li>
					No messages found!
				</li>  
				<?php endif;?>	
			</ul>
			<!--  outbox ends here -->
			<!--  acknoledge starts here -->
			<ul id="tab3_data" class="tab-data" <?php if($page == 'acknowledgement'){ ?> style="display: block;" <?php }else{ ?> style="display: none;" <?php }?>>
				<?php if(!empty($ackowledge)):?>
				<?php foreach($ackowledge as $ackmessage):?>
				<li  <?php if($ackmessage['status'] == 0){ ?>class="unread" <?php }?>>
					<input type="checkbox" class="msgCheck" value="<?php echo $ackmessage['messageId']; ?>" />
					<a href="#"><img src="<?php echo Utilities::getProfileImage($ackmessage['senderMarryId'],$ackmessage['senderImageName']); ?>" alt="" /></a>
					<a href="<?php echo Utilities::createAbsoluteUrl('message','conversation',array('senderId'=>$ackmessage['senderId'])); ?>" class="user_name"><?php echo $ackmessage['senderName']; ?></a>
					<div class="user_message">She saw your message on <?php echo $ackmessage['sendDate']; ?></div>
					<div class="msge_data">
						<a href="#" class="close" onclick="deleteMessage(<?php echo $ackmessage['messageId']; ?>,'acknowledgement');"></a>
					</div>
				</li>
				<?php endforeach;?> 
				<?php else:?> 
				<li>
					No messages found!
				</li>
				<?php endif;?>
			</ul>
			<!--  acknoledge ends here -->
		</div>
		<div class="interstTab">
			<div class="edit-option">
				<div class="check">
					<input type="checkbox" onclick="toggleChecked(this.checked)" class="msgCheck" value="0" />
					<span>Sellect All</span>
				</div>
				<div class="check">
					<span><a href="#" onclick="deleteMessages();">Delete</a></span>
				</div>
			</div>
		</div>
    </section>
    <script type="text/javascript">
    function toggleChecked(status) {
    	$(".msgCheck").each( function() {
	    	$(this).attr("checked",status);
    	})
    	}

	function deleteMessages(){
    	var allVals = [];
	     $('.msgCheck').each(function() {
	    	 if($(this).is(':checked')) {
	       		allVals.push($(this).val());
	    	 }
	     });
	     if(allVals.length === 0){
	    	 alert("Select the message to delete");
	    	 return false;
	     }else{
		    
		     $('#selectedIds').val(allVals);
		     $('#action').val('delete');
	    	 $('#frmMessage').submit();
	     }
	}

	function deleteMessage(messageId,tab){
		$('#selectedIds').val(messageId);
		$('#selectedTab').val(tab);
		$('#action').val('delete');
   	 	$('#frmMessage').submit();
	}

	function setSelectedTab(tab){
		$('#selectedTab').val(tab);
	}
    </script>
      <?php $this->widget('application.widgets.menu.Rightmenu'); ?>
  