	<section class="data-contnr">

		<article class="section">

		<?php if(count($photos) == 5):?>

			<ul class="no-padd">

				<li class="mTnone">

					<h1 class="message">How to ensure the security of my album?</h1>

					<!--  <h5 class="color">To make your profile stand out</h5>-->

				</li>

			</ul>

			<ul class="no-padd">

				<li>

					<p class="width100">By using make my photos visible only upon request , you can protect your pictures. This option helps you ensure that other users will not be able to access your details without your permission.</h5>

				</li>

			</ul>

			<?php else:?>

			<ul class="no-padd">

				<li class="mTnone">

					<h1 class="message">Add Your Photos</h1>

					<h5 class="color">A picture is worth thousand words!</h5>

				</li>

			</ul>

			<ul>

				<li>

					<p class="width100">By adding your picture you increase the credibility of your profile and can get better responses. Photos plays a major role in getting a better match, so go ahead adding one.</p>

				</li>

				<?php if(!count($photos) > 0):?>

				<li class="mTnone">

					<a href="<?php echo Utilities::createAbsoluteUrl('user','photoupload'); ?>" class="upload" id="photoUpload">UPLOAD YOUR PHOTOS</a>

				</li>

				<?php endif;?>

			</ul>

			<?php endif;?>

			<?php if(!empty($photos)):?>

			<ul class="no-padd">

				<li>

				<?php foreach($photos as $photo):?>

					<div class="photoOpt">

						<div class="ppOpts">

							<?php if($photo->profileImage == 1){ ?>

							<p>This is your Profile Picture</p>

							<?php }else{?>

							<p><a href="<?php echo Yii::app()->params['homeUrl']?>/user/horoupload/r/setimage/pId/<?php echo $photo->photoId?>/uId/<?php echo $user->userId?>" title="click to make this ur profile picture">Use as Profile Picture</a></p>

							<?php }?>

							<p><a href="<?php echo Yii::app()->params['homeUrl']?>/user/horoupload/r/deleteimage/pId/<?php echo $photo->photoId?>/uId/<?php echo $user->userId?>" title="click to delete this picture">Delete</a></p>

						</div>

						<img src="<?php echo Utilities::getProfileImage($user->marryId,$photo->imageName); ?>" alt="" />

					</div>

				<?php endforeach;?>	

				</li>

			</ul>

			<ul class="no-padd">

				<?php if(count($photos) < 5) {?>

				<li>

					<p class="width100">You can add <?php echo 5-count($photos);?> more photo in this album</p>

				</li>

				<li>

					<a href="<?php echo Utilities::createAbsoluteUrl('user','photoupload'); ?>" class="upload" id="photoUpload">UPLOAD YOUR PHOTOS</a>

				</li>

				<?php }?>

				<!-- 

				<li>

					<div class="title">

						Who can view above details

					</div>

					<div class="info">

						<div class="check">

							<input type="checkbox" name="profilepictureview" id="profilepictureview" <?php  if($settings->privacy == 'all'){ ?> checked="checked" <?php } ?> value="all"> <span>All</span>

						</div>

						<div class="check">

							<input type="checkbox" name="profilepictureview" id="profilepictureview" value="subscribers" <?php  if($settings->privacy == 'subscribers'){ ?> checked="checked" <?php } ?>> <span>Subscribers</span>

						</div>

						<div class="check">

							<input type="checkbox" name="profilepictureview" id="profilepictureview" value="member" <?php  if($settings->privacy == 'member'){ ?> checked="checked" <?php } ?>> <span>Logged Members</span>

						</div>

						<div class="check">

							<input type="checkbox" name="profilepictureview" id="profilepictureview" value="request" <?php  if($settings->privacy == 'request'){ ?> checked="checked" <?php } ?>> <span>By request</span>

						</div>

					</div>

				</li>

				 -->

			</ul>

			<?php endif;?>

			<?php if(count($familyPhotos) == 5):?>

			<ul class="no-padd">

				<li class="mTnone">

					<h1 class="message">How can I protect the photos I add?</h1>

					<!--  <h5 class="color">To make your profile stand out</h5>-->

				</li>

			</ul>

			<ul class="no-padd">

				<li>

					<p class="width100">By using make my photos visible only upon request , you can protect your pictures. By making use of this option, you can be sure that other users will not be able to access your details without your permission.</h5>

				</li>

			</ul>

			<?php else:?>

			<ul class="no-padd">

				<li class="mTnone">

					<h1 class="message">Add Family Photos</h1>

					<h5 class="color">A picture is worth thousand words!</h5>

				</li>

			</ul>

			<ul>

				<li>

					<p class="width100">By uploading pictures to my family album section, you can let others know about your family. You can also see the family of the potential candidate, if they have utilized the option and added pictures.</p>

				</li>

				<?php if(!count($familyPhotos) > 0):?>

				<li class="mTnone">

					<a href="<?php echo Utilities::createAbsoluteUrl('user','familyphotoupload'); ?>" class="upload" id="familyphotoUpload">UPLOAD YOUR PHOTOS</a>

				</li>

				<?php endif;?>

			</ul>

			<?php endif;?>

			<?php if(!empty($familyPhotos)):?>

			<ul class="no-padd">

				<li>

				<?php foreach($familyPhotos as $photo):?>

					<div class="photoOpt">

						<div class="ppOpts">

							<!--  <p><a href="<?php echo Yii::app()->params['homeUrl']?>/user/horoupload/r/setimage/pId/<?php echo $photo->albumId?>/uId/<?php echo $user->userId?>" title="click to make this ur profile picture">Use as Profile Picture</a></p>-->

							<p><a href="<?php echo Yii::app()->params['homeUrl']?>/user/horoupload/r/deletealbumimage/pId/<?php echo $photo->albumId?>/uId/<?php echo $user->userId?>" title="click to delete this picture">Delete</a></p>

						</div>

						<img src="<?php echo Utilities::getAlbumImage($user->marryId,$photo->imageName); ?>" alt="" />

					</div>

				<?php endforeach;?>	

				</li>

			</ul>

			<ul class="no-padd">

				<?php if(count($familyPhotos) < 5){?>

				<li>

					<p class="width100">You can add <?php echo 5-count($familyPhotos);?> more photo in this album</p>

				</li>

				<li>

					<a href="<?php echo Utilities::createAbsoluteUrl('user','familyphotoupload'); ?>" class="upload" id="familyphotoUpload">UPLOAD YOUR PHOTOS</a>

				</li>

				<?php } ?>

				<!-- 

				<li>

					<div class="title">

						Who can view above details

					</div>

					<div class="info">

						<div class="check">

							<input type="checkbox" name="familypictureview" id="familypictureview" <?php  if($familysettings->privacy == 'all'){ ?> checked="checked" <?php } ?> value="all"> <span>All</span>

						</div>

						<div class="check">

							<input type="checkbox" name="familypictureview" id="familypictureview" value="subscribers" <?php  if($familysettings->privacy == 'subscribers'){ ?> checked="checked" <?php } ?>> <span>Subscribers</span>

						</div>

						<div class="check">

							<input type="checkbox" name="familypictureview" id="familypictureview" value="member" <?php  if($familysettings->privacy == 'member'){ ?> checked="checked" <?php } ?>> <span>Logged Members</span>

						</div>

						<div class="check">

							<input type="checkbox" name="familypictureview" id="familypictureview" value="request" <?php  if($familysettings->privacy == 'request'){ ?> checked="checked" <?php } ?>> <span>By request</span>

						</div>

					</div>

				</li>

				 -->

			</ul>

			<?php endif;?>

			<?php if(count($documents) == 5):?>

			<ul class="no-padd">

				<li class="mTnone">

					<h1 class="message">How can I protect my documents?</h1>

					<!--  <h5 class="color">To make your profile stand out</h5>-->

				</li>

			</ul>

			<ul class="no-padd">

				<li>

					<p class="width100">By using make my document visible only upon request , you can protect your document.</h5>

				</li>

			</ul>

			<?php else:?>

			<ul class="no-padd">

				<li>

					<h1 class="message">Add Documents </h1>

					<h5 class="color">Documents are proof to your claims!</h5>

				</li>

			</ul>

			<ul class="no-padd">

				<li>

					<p class="width100">Let the documents validate your claims about job, salary, age etc. By adding valid documents you are telling yours is trust worthy profile.</p>

				</li>

				<?php if(!count($documents) > 0):?>

				<li class="mTnone">

					<a href="<?php echo Utilities::createAbsoluteUrl('user','documentupload'); ?>" class="upload" id="documentUpload">UPLOAD YOUR DOCUMENTS</a>

				</li>

				<?php endif;?>

			</ul>

			<?php endif;?>

			<?php if(!empty($documents)):?>

			<ul class="no-padd">

				<li>

				<?php foreach($documents as $document):?>

					<div class="docOpt">

						<div class="ppOpts">

							<p><?php echo Utilities::getDocumentType($document->documentType)?></p>

							<p><a href="<?php echo Yii::app()->params['homeUrl']?>/user/horoupload/r/deletedocument/dId/<?php echo $document->documentId?>/uId/<?php echo $user->userId?>" title="click to delete this picture">Delete</a></p>

						</div>

						<img src="<?php echo Utilities::getDocumentImage($user->marryId,$document->documentName); ?>" alt=""  />

					</div>

				<?php endforeach; ?>	

				</li>

			</ul>

			<ul class="no-padd">

				<?php if(count($documents) < 5) {?>

				<li>

					<p class="width100 no-marg">You can add <?php echo 5-count($documents);?> more document in this album</p>

				</li>

				<li>

					<a href="<?php echo Utilities::createAbsoluteUrl('user','documentupload'); ?>" class="upload" id="documentUpload">UPLOAD YOUR Documents</a>

				</li>

				<?php }?>

				<!-- 

				<li>

					<div class="title">

						Who can view above detals

					</div>

					<div class="info">

						<div class="check ">

						<input type="checkbox" name="documentview" id="documentview" value="subscribers" <?php  if($documentsettings->privacy == 'subscribers'){ ?> checked="checked" <?php } ?>> <span>Subscribers</span>

						</div>

						<div class="check ">

							<input type="checkbox" name="documentview" id="documentview" value="request" <?php  if($documentsettings->privacy == 'request'){ ?> checked="checked" <?php } ?>> <span>By request</span>

						</div>

					</div>

				</li>

				 -->

			</ul>

			<?php endif;?>

			<ul class="no-padd">

			<li>

				<a href="/user/success" class="type2">Next</a>

				</li>

			</ul>

		</article>

	</section>

	

	<section class="rightbar-contnr">

		<div class="photo-spec-contnr">

			<div class="lArrow"></div>

			<div class="head-text">Specifications for Photo Upload</div>

			<div class="leftC">

				<div class="can">You can add</div>

				<div class="pCont">

					<img src="<?php echo Utilities::getMediaUrl(); ?>/user/passport.png" alt="" />

					<span>Passport size</span>

				</div>

				<div class="pCont">

					<img src="<?php echo Utilities::getMediaUrl(); ?>/user/front.png" alt="" />

					<span>Front view</span>

				</div>

				<div class="pCont">

					<img src="<?php echo Utilities::getMediaUrl(); ?>/user/full-size.png" alt="" />

					<span>Full view</span>

				</div>

			</div>

			<div class="rightC">

				<div class="cant">You can't add</div>

				<div class="pCont mL24">

					<img src="<?php echo Utilities::getMediaUrl(); ?>/user/not-clear.png" alt="" />

					<span>Face not clear</span>

				</div>

				<div class="pCont mL24">

					<img src="<?php echo Utilities::getMediaUrl(); ?>/user/blured.png" alt="" />

					<span>Blured</span>

				</div>

				<div class="pCont mL24">

					<img src="<?php echo Utilities::getMediaUrl(); ?>/user/group.png" alt="" />

					<span>Group photo</span>

				</div>

			</div>	

		</div>

	</section>



	<script type="text/javascript">

$(document).ready(function(){

    $("#photoUpload").colorbox({iframe:true, width:"860", height:"620",overlayClose: false});

    $("#familyphotoUpload").colorbox({iframe:true, width:"860", height:"640",overlayClose: false});

    $("#documentUpload").colorbox({iframe:true, width:"860", height:"620",overlayClose: false});

  });

	$('.wUsername').append('<a href="/user/success">| Skip this page</a>');



</script>