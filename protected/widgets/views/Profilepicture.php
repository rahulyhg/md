<?php 
$user = Yii::app()->session->get('user');
if(!empty($photosList)){ ?>
<script language="javascript">
var myImg_<?php echo $userId ?> = new Array()
<?php 
$j=0;
foreach($photosList as $photo){ ?>
  myImg_<?php echo $userId; ?>[<?php echo $j; ?>]= "<?php echo Utilities::getProfileImage($marryId,$photo->imageName);?>";
<?php $j++;
 } ?>

var i_<?php echo $userId; ?> = 0;
var count_<?php echo $userId; ?> = <?php echo count($photosList); ?>
// Create function to load image
function loadImg_<?php echo $userId; ?>(){
  document.imgSrc_<?php echo $userId; ?>.src =  myImg_<?php echo $userId; ?>[i_<?php echo $userId; ?>];
}

// Create link function to switch image backward
function prev_<?php echo $userId ?>(){
	if(i_<?php echo $userId; ?><1){
	     i_<?php echo $userId; ?> = 0;
	  } else {
	     i_<?php echo $userId; ?> = i_<?php echo $userId; ?>-1;
	  }
  document.imgSrc_<?php echo $userId ?>.src =  myImg_<?php echo $userId ?>[i_<?php echo $userId; ?>];
  document.getElementById("slideCount_<?php echo $userId ?>").innerHTML = i_<?php echo $userId; ?>+1;
}

// Create link function to switch image forward
function next_<?php echo $userId ?>(){
	if(i_<?php echo $userId; ?>>count_<?php echo $userId; ?>-2){
	     i_<?php echo $userId; ?> = count_<?php echo $userId; ?>-1;
	  } else {
	     i_<?php echo $userId; ?> = i_<?php echo $userId; ?>+1;
	  }
  document.imgSrc_<?php echo $userId ?>.src =  myImg_<?php echo $userId ?>[i_<?php echo $userId; ?>];
  document.getElementById("slideCount_<?php echo $userId ?>").innerHTML = i_<?php echo $userId; ?>+1;
}

// Load function after page loads
window.onload=loadImg_<?php echo $userId; ?>;

</script>
<?php if($user->userId == $userId){ ?>
	<a class="ppC" href="<?php echo Utilities::createAbsoluteUrl('mypage','editprofilephoto'); ?>" id="editProfilePicture">
		<span class="ppCinn">Change profile picture</span>
		<img id="imgSrc_<?php echo $userId ?>" width="180" height="230" name="imgSrc_<?php echo $userId ?>" alt="" src="">
	</a>
<?php }else{
	if(isset($user)) {?>
	<a id="requestWindow" href="<?php echo Utilities::createAbsoluteUrl('album','view',array('mId'=>$marryId,'wType'=>'popup')); ?>"><img id="imgSrc_<?php echo $userId ?>" width="180" height="230" name="imgSrc_<?php echo $userId ?>" alt="" src=""></a>
	<?php }else{?>
		<a id="requestWindow" href="<?php echo Utilities::createAbsoluteUrl('site','popup',array('action'=>'login','module'=>'album','profileId'=>$userId)); ?>"><img id="imgSrc_<?php echo $userId ?>" width="180" height="230" name="imgSrc_<?php echo $userId ?>" alt="" src=""> </a>
	<?php }?>
<?php }?>	
	<ul class="noC">
		<li><a href="javascript:void(0);" class="prevs" onClick="prev_<?php echo $userId ?>();" ></a></li>
		<li><span id="slideCount_<?php echo $userId ?>">1</span> of <span><?php echo count($photosList); ?></span></li>
		<li><a href="javascript:void(0);" class="nexts" onClick="next_<?php echo $userId ?>();" ></a></li>
	</ul>
				
<?php }else{?>
<div class="image-contnrs">
	<img id="imgSrc" width="180" height="230" name="imgSrc" alt="" src="<?php echo Utilities::getProfileImage($marryId,'');?>">
</div>
<?php }?>