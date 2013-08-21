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
* @title payment.php
* @description <Description of this class>
*  @filesource <URL>
*  @version <Revision>
*/
?>
      <?php $this->widget('application.widgets.menu.Leftmenu'); ?>
              <section class="data-contnr2">
        <h1 class="mB10">My Priviacy Settings</h1>
        <p>You can choose your privacy settings by clicking any of the following options. If you choose all the profile will be visible to everyone who logs in subscribers and request limit viewership. You can also edit the settings any time. </p>
        <ul class="accOverview mT12">
			<li>
				<div class="psLeft">My Album </div>
				<form id="updateAlbum"  name="updateAlbum" method="post"  action="/privacy/update">
				<div class="psRight">
				<?php echo CHtml::checkBoxList('album',$album,array('all'=>'All','subscribers'=>'Subscribers','member'=> 'Logged Members','request' => 'By Request'),array('class'=>'checkb')); ?>
					<a href="javascript:updateAlbum.submit();" >Update</a>
				</div>
				</form>
			</li>
			<li>
				<div class="psLeft">My Family Album</div>
				<form id="updateFamily"  name="updateFamily" method="post"  action="/privacy/update">
				<div class="psRight">
				<?php echo CHtml::checkBoxList('family',$family,array('all'=>'All','subscribers'=>'Subscribers','member'=> 'Logged Members','request' => 'By Request'),array('class'=>'checkb')); ?>
					<a href="javascript:updateFamily.submit();" >Update</a>
					
				</div>
				</form>
			</li>
			<li>
				<div class="psLeft">My Documents</div>
				<form id="updateDoc"  name="updateDoc" method="post"  action="/privacy/update">
				<div class="psRight">
				<?php echo CHtml::radioButtonList('documents',$documents,array('subscribers'=>'Subscribers','request' => 'By Request'),array('class'=>'checkb')); ?>
					<a href="javascript:updateDoc.submit();" class="srch-sub-bottom">Update</a>
				</div>
				</form>
			</li>
			<li>
				<div class="psLeft">My Astro Details</div>
				<form id="updateAstro"  name="updateAstro" method="post"  action="/privacy/update">
				<div class="psRight">
				<?php echo CHtml::checkBoxList('astro',$astro,array('all'=>'All','subscribers'=>'Subscribers','member'=> 'Logged Members','request' => 'By Request'),array('class'=>'checkb')); ?>
					<a href="javascript:updateAstro.submit();" >Update</a>
				</div>
				</form>
			</li>
			<li>
				<div class="psLeft">My Reference </div>
				<form id="updateReference"  name="updateReference" method="post"  action="/privacy/update">
				<div class="psRight">
				<?php echo CHtml::radioButtonList('reference',$reference,array('subscribers'=>'Subscribers','request' => 'By Request'),array('class'=>'checkb')); ?>
					<a href="javascript:updateReference.submit();" >Update</a>
					
				</div>
				</form>
			</li>
			<li>
				<div class="psLeft">My Contact</div>
				<form id="updateContact"  name="updateContact" method="post"  action="/privacy/update">
				<div class="psRight">
				<?php echo CHtml::radioButtonList('contact',$contact,array('subscribers'=>'Subscribers','request' => 'By Request'),array('class'=>'checkb')); ?>
					<a href="javascript:updateContact.submit();" class="srch-sub-bottom">Update</a>
					
				</div>
				</form>
			</li>
		</ul>
		<h1 class="mTB12 ">My Account Settings</h1>
        <p>You can change your account setting, delete or deactivate the account any time you want.</p>
		<ul class="accOverview mT12">
			<li>
				<div class="btnC">
					<a href="<?php echo Utilities::createAbsoluteUrl('mypage','delete'); ?>" id="footerPops" class="actAct">Change Password</a>
					<a href="<?php echo Utilities::createAbsoluteUrl('mypage','deactivate'); ?>" id="footerPops" class="actAct">Deactivate account</a>
					<a href="<?php echo Utilities::createAbsoluteUrl('mypage','delete'); ?>" class="actAct">Delete my account</a>
				</div>
			</li>
		</ul>
    </section>
      <?php $this->widget('application.widgets.menu.Rightmenu'); ?>
  
  <script type="text/javascript">
$(document).ready(function(){
    $('[id^=footerPops]').colorbox({iframe:true, width:"860", height:"900",overlayClose: false});
    
  });


</script>