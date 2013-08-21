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
* @title album.php
* @description <Description of this class>
*  @filesource <URL>
*  @version <Revision>
*/
?>
    <?php $this->widget('application.widgets.menu.Leftmenu'); ?>
    <?php $user = Yii::app()->session->get('user'); ?>
    <section class="data-contnr2">
    <?php if(empty($photosList)){?>
    <h1 class="mB10">My Family Album </h1>
        <p class="red">Your have not added any photos in your Family Album yet !</p>
        <h3 class="mB10 ">What is my Family Album ?</h3>
        <p>My family album is an option where you can upload pictures of your family members and your home. Since family plays an important role in weddings in India, it is important that potential candidates get to know a picture of your family. </p>
		<h3 class="mB10 ">Why add my family's pictures?</h3>
        <p>By uploading pictures to my family album section, you can let others know about your family. You can also see the family of the potential candidate, if they have utilized the option and added pictures. </p>
		<h3 class="mB10 ">How can I protect the photos I add?</h3>
        <p>By using  make my photos visible only upon request , you can protect your pictures. By making use of this option, you can be sure that other users will not be able to access your details without your permission. </p>
		<a id="albumWindow" href="<?php echo Utilities::createAbsoluteUrl('mypage','familyphotoupload',array()) ?>" class="type5 wid150 mT10">Add Family Album</a>
		<?php }else{?>
        <h1>My Family Album</h1>
		<h5 class="width100 mT30">Please mouse hover on a photo to delete.</h5>
        <div class="profPicC">
        <?php foreach($photosList as $photo):?>
            <div class="picContnr">
				<div class="ppOpt">
					<span title="Passport"><?php echo Utilities::getFamilyRelationType($photo->photorelation); ?></span><br />
					<a href="<?php echo Utilities::createAbsoluteUrl('mypage','familyalbum',array('action'=>'delete','pId'=>$photo->albumId,'uId'=>$user->userId)); ?>" title="click to delete this picture">Delete</a>
				</div>
				<img src="<?php echo Utilities::getAlbumImage($user->marryId,$photo->imageName); ?>" alt="" width="88" height="90" />
			</div>
		<?php endforeach; ?>	
        </div>
         <?php if(count($photosList) < 5){?>
        	<a id="albumWindow" href="<?php echo Utilities::createAbsoluteUrl('mypage','familyphotoupload',array()) ?>" class="type5">Add More Photos</a>
        <?php }?>
        <?php }?>
    </section>
    <script type="text/javascript">
$(document).ready(function() {

	$("#albumWindow").colorbox({iframe:true, width:"860", height:"900",overlayClose: false});
});

</script>
    	<!-- right menu -->
	<?php $this->widget('application.widgets.menu.Rightmenu'); ?> 
	<!-- right menu ends -->