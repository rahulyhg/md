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
        <h1 class="mB10">My Album </h1>
        <p class="red">You have not added any photos to 'my album' yet! </p>
        <h3 class="mB10 ">What is my Album ?</h3>
        <p>This  is where you upload your own pictures of different nature. You can upload upto five photos in this section.</p>
		<h3 class="mB10 ">Why upload my album?</h3>
        <p>By adding multiple pictures of yours you can let others have a better picture of you. Better responses is what you get when you have my album in place. </p>
		<h3 class="mB10 ">How to ensure the security of my album?</h3>
        <p>By using  make my photos visible only upon request , you can protect your pictures. This option helps you ensure that other users will not be able to access your details without your permission.</p>
		<a id="albumWindow" href="<?php echo Utilities::createAbsoluteUrl('mypage','photoupload',array()) ?>" class="type5 wid150 mT10">Add Album</a>
		<?php }else{?>
        <h1>My Album</h1>
		<h5 class="width100 mT30">Please mouse hover on a photo to use as your profile picture or to delete.</h5>
        <div class="profPicC">
        	<?php foreach($photosList as $photo):?>
            <div class="picContnr">
				<div class="ppOpt">
					<?php if($photo->profileImage == 1){ ?>
						<p>This is your Profile Picture</p>
					<?php }else{?>
						<a href="<?php echo Utilities::createAbsoluteUrl('mypage','album',array('action'=>'setprofilephoto','pId'=>$photo->photoId,'uId'=>$user->userId)); ?>" title="click to make this ur profile picture">Use as Profile Picture</a>
					<?php }?>
					<a href="<?php echo Utilities::createAbsoluteUrl('mypage','album',array('action'=>'delete','pId'=>$photo->photoId,'uId'=>$user->userId)); ?>" title="click to delete this picture">Delete</a>
				</div>
				<img src="<?php echo Utilities::getProfileImage($user->marryId,$photo->imageName); ?>" alt="" width="88" height="90" />
			</div>
			<?php endforeach; ?>
        </div>
        <?php if(count($photosList) < 5){?>
        	<a id="albumWindow" href="<?php echo Utilities::createAbsoluteUrl('mypage','photoupload',array()) ?>" class="type5">Add More Photos</a>
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