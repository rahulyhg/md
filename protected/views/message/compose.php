<div class="subContent">
			<section class="subHead">
				<h1 class="width100">Message to <?php echo $receiver->name; ?></h1>
			</section>
			<section class="subContnr">
		<ul>
		<?php if(isset($_GET['success']) && $_GET['success'] == true) { ?>
			<li>Message sent successfully</li>
			<input type="button" name="btnCancel"  value="Close" class="type2b mL5" onclick="javascript:closeOverlay();" />
		<?php 
               }else{?>
		<form name="frmMessage" id="frmMessage" method="post" action="<?php echo Utilities::createAbsoluteUrl('message','compose',array()); ?>">
			<input type = "hidden" name="receiverId" id="receiverId" value="<?php echo $receiver->userId; ?>" />
			<li>
				<textarea type="text" placeholder="Type your message here.." name="message" id="message" ></textarea>
			</li>
			<li>
				<div class="buttonContnr">
					<input type="reset" name="btnReset"  value="Reset" class="type2b mL5" />
					<input type="button" name="btnSend" id="btnSend" value="Send" class="type2b mL5" onclick="send();" />
					<input type="button" name="btnCancel"  value="Cancel" class="type2b mL5" onclick="javascript:closeOverlay();" />	
					
				</div>
			</li>
		</form>
		</ul>
		<?php }?>
	</section>
</div>

<script type="text/javascript">
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