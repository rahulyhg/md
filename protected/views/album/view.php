<?php if(!empty($photosList)){ ?>
<script language="javascript">
var myImg_<?php echo $user->userId ?> = new Array()
<?php 
$j=0;
foreach($photosList as $photo){
	if($j ==0 ){ 
		$profileImage = $photo->imageName;
	}
	?>
  myImg_<?php echo $user->userId; ?>[<?php echo $j; ?>]= "<?php echo Utilities::getProfileImage($user->marryId,$photo->imageName);?>";
<?php $j++;
 } ?>

var i = 0;
var count = <?php echo count($photosList); ?>
// Create function to load image
function loadImg_<?php echo $user->userId; ?>(){
  document.imgSrc_<?php echo $user->userId; ?>.src =  myImg_<?php echo $user->userId; ?>[i];
}

// Create link function to switch image backward
function prev_<?php echo $user->userId ?>(){
	if(i<1){
	     i = 0;
	  } else {
	     i = i-1;
	  }
  document.imgSrc_<?php echo $user->userId ?>.src =  myImg_<?php echo $user->userId ?>[i];
}

// Create link function to switch image forward
function next_<?php echo $user->userId ?>(){
	if(i>count-2){
	     i = count-1;
	  } else {
	     i = i+1;
	  }
  document.imgSrc_<?php echo $user->userId ?>.src =  myImg_<?php echo $user->userId ?>[i];
}

function set_<?php echo $user->userId ?>(url){
	document.imgSrc_<?php echo $user->userId ?>.src = url;
}

function expressInterest()
{
	  document.getElementById('action').value = 'expressInterest';
	  document.frmMyAlbum.submit();
}

function bookmark()
{
	  document.getElementById('action').value = 'bookmark';
	  document.frmMyAlbum.submit();
}

// Load function after page loads
window.onload=loadImg_<?php echo $user->userId; ?>;

</script>
		<form name="frmMyAlbum" id="frmMyAlbum" method="post" action="" >
          <input type="hidden" id="action" name="action" value="" />
          <input type="hidden" id="mId" name="mId" value="<?php echo $user->marryId?>" />
          <input type="hidden" id="wType" name="wType" value="<?php echo $windowType; ?>" />
        </form>
		<div class="subContent">
			<section class="subHead">
				<h1 ><?php echo $user->name;?> <?php echo $user->marryId?></h1>
				<h5>Viewing album</h5>
			</section>
			<section class="subContnr">
				<div class="photoRoll">
				<?php
					reset($photosList); 
					$j=0;
					foreach($photosList as $photo){ 
				?>
					<a href="#"><img src="<?php echo Utilities::getProfileImage($user->marryId,$photo->imageName);?>" alt="" onclick="set_<?php echo $user->userId ?>(this.src);" /></a>
				<?php }?>
				</div>
				<!-- 
				<div class="btns">
					<a href="javascript:void(0);" class="type5" onclick="javascript:expressInterest();">Express Interest</a>
					<a href="javascript:void(0);" class="type5" onclick="javascript:bookmark();">Bookmark</a>
					<a href="<?php echo Utilities::createAbsoluteUrl('message','compose',array('wType'=>'popup')) ?>" class="type5">Send Message</a>
				</div>
				 -->
				<div class="photoCont">
					<div class="photoWrap">
						<a class="prevs" href="javascript:void(0);" onclick="prev_<?php echo $user->userId ?>();"></a>
						<a class="nex" href="javascript:void(0);" onclick="next_<?php echo $user->userId ?>();"></a>
						<img width="450" height="480" id="imgSrc_<?php echo $user->userId ?>" name="imgSrc_<?php echo $user->userId ?> src="<?php echo Utilities::getProfileImage($user->marryId,$profileImage);?>" alt="<?php echo $user->name;?>" />
					</div>
				</div>
			</section>
		</div>
<?php }else{?>
	<div class="subContent">
			<section class="subHead">
				<h1 ><?php echo $user->name;?> <?php echo $user->marryId?></h1>
				<h5>Viewing album</h5>
			</section>
			<section class="subContnr">
				No albums available at the moment.
			</section>
		</div>
<?php }?>