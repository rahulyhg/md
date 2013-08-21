<div class="subContent">
			<section class="subHead">
				<h1 class="width100 ">Edit Photos</h1>
			</section>
			<section class="subContnr">
				<ul class="accOverview pmB10">
					<form action="<?php echo Utilities::createAbsoluteUrl('mypage','editprofilephoto'); ?>" method="post" enctype="multipart/form-data">
					<li class="mT15 mB0">
						<?php if(count($photos) < 5){?>
						<input type="hidden" name="photoCount" id="photoCount" value="2" />
						<input type="hidden" name="totalCount" id="totalCount" value="<?php echo !empty($photos)? count($photos)+1:1;?>" />
						<div class="urOnly">You can select multiple images</div>
						<div class="uploadCn">
							<input type="file" name="profilePhoto_1" id="profilePhoto_1" />
						</div>
						<div id="photoContainer" style="margin-bottom:10px;"></div>
						<div class="uploadCn mT5">
							<a href="#" class="type3" name="morephoto" id="morephoto" onClick="addMoreFiles()";>Add More</a>
							<input type="submit" name="uploadphoto" id="uploadphoto" class="type3" value="Upload" />
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
									<?php if($photo->profileImage == 1){ ?>
									<p>This is your Profile Picture</p>
									<?php }else{?>
									<p><a title="click to make this ur profile picture" href="<?php echo Yii::app()->params['homeUrl']?>/mypage/editprofilephoto/r/setimage/pId/<?php echo $photo->photoId?>/uId/<?php echo $user->userId?>">Use as Profile Picture</a></p>
									<?php }?>
									<p><a title="click to delete this picture" href="<?php echo Yii::app()->params['homeUrl']?>/mypage/editprofilephoto/r/deleteimage/pId/<?php echo $photo->photoId?>/uId/<?php echo $user->userId?>">Delete</a></p>
								</div>
								<img src="<?php echo Utilities::getProfileImage($user->marryId,$photo->imageName); ?>" alt="" width="135" height="70" />
							</div>
						<?php endforeach;?>
						</div>
					</li>
					<?php endif; ?>
					<!-- 
					<li class="mT25">
						<div class="whoCan">Who can view Album</div>
						<div class="check ">
							<input type="checkbox" name="profilepictureview" id="profilepictureview" <?php  if($settings->privacy == 'all'){ ?> checked="checked" <?php } ?> value="all"> <span>All</span>
						</div>
						<div class="check ">
							<input type="checkbox" name="profilepictureview" id="profilepictureview" value="subscribers" <?php  if($settings->privacy == 'subscribers'){ ?> checked="checked" <?php } ?>> <span>Subscribers</span>
						</div>
						<div class="check ">
							<input type="checkbox" name="profilepictureview" id="profilepictureview" value="member" <?php  if($settings->privacy == 'member'){ ?> checked="checked" <?php } ?>> <span>Logged Members</span>
						</div>
						<div class="check ">
							<input type="checkbox" name="profilepictureview" id="profilepictureview" value="request" <?php  if($settings->privacy == 'request'){ ?> checked="checked" <?php } ?>> <span>By request</span>
						</div>
					</li>
					 -->
					<li>
						<input type="button" name="cancelPhoto" id="cancelPhoto" value="Cancel" class="type2b mL5" onclick="javascript:closeOverlay('<?php echo Utilities::createAbsoluteUrl('ajax','photoclear')?>');" />
						<input type="submit" name="updatePhoto" id="updatePhoto" value="Update" class="type2b mL5" />
					</li>
				</form>
				</ul>
			</section>