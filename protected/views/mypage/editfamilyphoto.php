<div class="subContent">
			<section class="subHead">
				<h1 class="width100 ">Edit Family Photos</h1>
			</section>
			<section class="subContnr">
				<ul class="accOverview pmB10">
					<li class="mT15 mB0">
					<form action="<?php echo Utilities::createAbsoluteUrl('mypage','editfamilyphoto'); ?>" method="post" enctype="multipart/form-data" id="frmFamilyPhoto">	
						<input type="hidden" name="photoCount" id="photoCount" value="2" />
						<input type="hidden" name="totalCount" id="totalCount" value="<?php echo !empty($photos)? count($photos)+1:1;?>" />
						<input type="hidden" name="updatePhoto" id="updatePhoto" value="" />						
						<?php if(count($photos) < 5){?>
						<div class="urOnly">You can select multiple images</div>
						<div class="uploadCn">
							<input type="file" name="profilePhoto_1" id="profilePhoto_1" />
							<select class="wid200" name="photoRelation_1" id="photoRelation_1">
								<option value="0">Who is this</option>
								<option value="1">Father</option>
								<option value="2">Mother</option>
								<option value="3">Brother</option>
								<option value="4">Sister</option>
							</select>
						</div>
						<!-- dynamic data will populate here -->
						<div id="photoContainer" style="margin-bottom:10px;">
						</div>
						<div class="uploadCn mT5">
							<a href="#" class="type3" name="morephoto" id="morephoto" onclick="addMoreFamilyPhotos()";>Add More</a>
							<input type="button" name="uploadphoto" id="uploadphoto" class="type3" value="Upload" onclick="uploadFamilyPhoto();" />
						</div>
						<?php }?>
						<?php if(!empty($photos)):?>
						<h5 class="width100 mT30">Please mouse hover on a photo to use as profile picture or delete or cancel.</h5>
						<?php endif; ?>
					
					</li>
					<?php if(!empty($photos)):?>
					<li >
						<div class="upUrF">
						<?php foreach($photos as $photo):?>
							<div class="upCn">
								<div class="ppOpts">
									<!--  <p><a title="click to make this ur profile picture" href="<?php echo Yii::app()->params['homeUrl']?>/user/familyphotoupload/r/setimage/pId/<?php echo $photo->albumId?>/uId/<?php echo $user->userId?>">Use as Profile Picture</a></p>-->
									<p><a title="click to delete this picture" href="<?php echo Yii::app()->params['homeUrl']?>/mypage/editfamilyphoto/r/deleteimage/pId/<?php echo $photo->albumId?>/uId/<?php echo $user->userId?>">Delete</a></p>
								</div>
								<img src="<?php echo Utilities::getAlbumImage($user->marryId,$photo->imageName); ?>" alt="" width="135" height="70" />
							</div>
						<?php endforeach;?>
						</div>
					</li>
					<?php endif; ?>
					<!--  
					<li class="mT25">
						<div class="whoCan">Who can view Album</div>
						<div class="check ">
							<input type="checkbox" name="familypictureview" id="familypictureview" <?php  if($settings->privacy == 'all'){ ?> checked="checked" <?php } ?> value="all"> <span>All</span>
						</div>
						<div class="check ">
							<input type="checkbox" name="familypictureview" id="familypictureview" value="subscribers" <?php  if($settings->privacy == 'subscribers'){ ?> checked="checked" <?php } ?>> <span>Subscribers</span>
						</div>
						<div class="check ">
							<input type="checkbox" name="familypictureview" id="familypictureview" value="member" <?php  if($settings->privacy == 'member'){ ?> checked="checked" <?php } ?>> <span>Logged Members</span>
						</div>
						<div class="check ">
							<input type="checkbox" name="familypictureview" id="familypictureview" value="request" <?php  if($settings->privacy == 'request'){ ?> checked="checked" <?php } ?>> <span>By request</span>
						</div>
					</li>
					 -->
					<li>
						<input type="button" name="cancelPhoto" id="cancelPhoto" value="Cancel" class="type2b mL5" onclick="javascript:closeOverlay('<?php echo Utilities::createAbsoluteUrl('ajax','familyphotoclear')?>');" />
						<input type="button" name="submitPhoto" id="submitPhoto" value="Update" class="type2b mL5" onclick="submitFamilyPhoto();" />
					</li>
					</form>
				</ul>
			</section>