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
* @title document.php
* @description <Description of this class>
*  @filesource <URL>
*  @version <Revision>
*/
?>
    <?php $this->widget('application.widgets.menu.Leftmenu'); ?>
    <?php $user = Yii::app()->session->get('user'); ?>
	<section class="data-contnr2">
	<?php if(empty($documents)){?>
	<h1 class="mB10">My Documents </h1>
        <p class="red">Your have not added any Documents yet !</p>
        <h3 class="mB10 ">What is my Documents ?</h3>
        <p>Documents such as passport, ration card, voters ID, pan card, bank passbook, school certificate, university certificate are considered as my documents .</p>
		<h3 class="mB10 ">Why should I my document?</h3>
        <p>Job, age, educational qualification etc play a major role in making that big decision. When you add proof to you claims a potential bride/groom will know that the facts you put up in your profile is true.</p>
		<h3 class="mB10 ">How can I protect my documents?</h3>
        <p>By using  make my document visible only upon request , you can protect your document. </p>
		<a id="albumWindow" href="<?php echo Utilities::createAbsoluteUrl('mypage','documentupload',array()) ?>" class="type5 wid150 mT10">Add Documents</a>
		<?php }else{?>
        <h1>My Documents</h1>
		<h5 class="width100 mT30">Please mouse hover on a Document to delete.</h5>
        <div class="profPicC">
        <?php foreach($documents as $document):?>
            <div class="picContnr">
				<div class="ppOpt">
					<span title="Passport"><?php echo Utilities::getDocumentType($document->documentType)?></span>
					<a href="<?php echo Utilities::createAbsoluteUrl('mypage','document',array('action'=>'delete','dId'=>$document->documentId,'uId'=>$user->userId)); ?>" title="click to delete this picture">Delete</a>
				</div>
				<img src="<?php echo Utilities::getDocumentImage($user->marryId,$document->documentName); ?>" alt="" width="88" height="90" />
			</div>
			<?php endforeach;?>
        </div>
        <?php if(count($documents) < 5){?>
        	<a id="albumWindow" href="<?php echo Utilities::createAbsoluteUrl('mypage','documentupload',array()) ?>" class="type5">Add More Documents</a>
        <?php }?>
        <?php }?>
    </section>
    <script type="text/javascript">
$(document).ready(function() {

	$("#albumWindow").colorbox({iframe:true, width:"860", height:"900",overlayClose: false});
});

</script>
	<?php $this->widget('application.widgets.menu.Rightmenu'); ?>