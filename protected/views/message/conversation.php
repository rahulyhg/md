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
* @title conversation.php
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
					<input type="checkbox" onclick="toggleChecked(this.checked)" />
					<span>Sellect All</span>
				</div>
				<div class="check">
					<span><a href="#" onclick="deleteMessages();">Delete</a></span>
				</div>
			</div>
			<form name="frmMessage" id="frmMessage" method="post" action="<?php echo Utilities::createAbsoluteUrl('message','conversation',array()); ?>">
			<input type = "hidden" name="selectedIds" id="selectedIds" value="" />
			<input type = "hidden" name="senderId" id="senderId" value="<?php echo $senderId; ?>" />
			
			<ul class="msgHead">
				<li>
					<a href="<?php echo Utilities::createAbsoluteUrl('message','index',array()); ?>" class="wid120">Back to messages</a>
				</li>
			</ul>
			<ul class="tab-data" >
			<?php if(!empty($messages)):?>
				<?php foreach($messages as $message):?> 
				<li>
					<input type="checkbox" class="msgCheck" value="<?php echo $message['messageId']; ?>" />
					<a href="<?php echo Utilities::createAbsoluteUrl('search','byid',array('id'=>$message['senderMarryId'])); ?>" target="_blank"><img src="<?php echo Utilities::getProfileImage($message['senderMarryId'],$message['senderImageName']); ?>" alt="" /></a>
					<a href="<?php echo Utilities::createAbsoluteUrl('search','byid',array('id'=>$message['senderMarryId'])); ?>" target="_blank" class="user_name"><?php echo $message['senderName']; ?></a>
					<div class="<?php if($user->userId == $message['senderId']) {?>sent_message<?php } else { ?>recvd_message <?php }?>"><?php echo $message['message']; ?></div>
					<div class="msge_data">
						<a href="#" class="close" onclick="deleteMessage(<?php echo $message['messageId']; ?>);"></a>
						<div class="date"><?php echo $message['sendDate']; ?></div>
					</div>
				</li>
			<?php endforeach;
			 else:?> 
				<li>
					No messages found!
				</li>
				<?php endif;?>
				<li>
					<div class="message_reply">
						<textarea type="text" placeholder="Type your message here.." name="message" id="message" ></textarea>
						<a href="#" class="type6" onclick="send();">Send</a>
					</div>
					
				</li>
			</ul>
			</form>
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
	    	 $('#frmMessage').submit();
	     }
	}

	function deleteMessage(messageId){
		$('#selectedIds').val(messageId);
   	 	$('#frmMessage').submit();
	}

	function send(){
		var message = $('#message').val();
		if(message.length === 0){
			alert("Enter the message to send");
	    	return false;
		}else{
			$('#frmMessage').submit();
		}
		
	}
    </script>
      <?php $this->widget('application.widgets.menu.Rightmenu'); ?>
  