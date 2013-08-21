<div class="subContent">
			<section class="subHead">
				<h1 class="width100">Edit Personal Contact Details</h1>
			</section>
			   <?php $user = Yii::app()->session->get('user');?>
			<section class="subContnr">
			<form id="userContact" name="userContact" method="post" action="/contact/detailsedit">
				<article class="section width100">
					<ul>
						<li>
							<div class="title">
								Communication Address 
							</div>
								<?php $address = Address::model()->findAll(array('condition'=> "userId = {$user->userId} and addresType = 0"));
								$caddress = new Address();
								if(isset($address) && isset($address[0]))
								$caddress = $address[0];
					?>
							
							<div class="info">
								<div class="inner-row">
									<div class="inputH">House Name / No.</div>
									<input type="text" value="<?php echo $caddress->houseName ?>" name="house" id="house" class="validate[required,minSize[3],custom[onlyLetterSp]]"
						placeholder="House Name / No." />
								</div>
								<div class="inner-row">
									<div class="inputCl">
										<div class="inputH">Place</div>
										<input type="text" value="<?php echo $caddress->place?>" name="houseplace" id="houseplace" class="validate[required,minSize[3],custom[onlyLetterSp]]"
						placeholder="Place" />
									</div>
								</div>
								<div class="inner-row">
									<div class="inputCl">
										<div class="inputH">City</div>
										<input type="text" name="housecity" id="city" class="validate[required]" value="<?php echo $caddress->city?>"
						placeholder="City" />
									</div>
									<div class="tHolder">
										<div class="inputTx">District</div>
										<input type="text" name="housedistrict" value="<?php echo $caddress->district?>" id="housedistrict" class="validate[required,minSize[3],custom[onlyLetterSp]]"
						placeholder="District" />
									</div>
								</div>
								<div class="inner-row">
									<div class="inputCl">
										<div class="inputH">State</div>
										<input type="text" name="housestate" value="<?php echo $caddress->state?>" id="statec" class="validate[required,minSize[3],custom[onlyLetterSp]]"
						placeholder="State" />
									</div>
									<div class="tHolder">
										<div class="inputTx">Country</div>
										<input type="text" name="housecountry" id="housecountry" value="<?php echo $caddress->country?>" class="validate[required,minSize[3],custom[onlyLetterSp]]"
						placeholder="Country" />
									</div>
								</div>
								<div class="inner-row">
									<div class="inputCl">
										<div class="inputH">Pincode</div>
										<input type="text" name="postcode" id="postcode" value="<?php echo $caddress->pincode?>" class="validate[required,custom[onlyNumberSp],minSize[6],maxSize[6]]"
						placeholder="Post Code" />
									</div>
									
								</div>
							</div>
						</li>
						<li>
							<div class="title">
								Permanent Address
							</div>
							<?php $address = Address::model()->findAll(array('condition'=> "userId = {$user->userId} and addresType = 1"));
							$paddress = new Address();
							if(isset($address) && isset($address[0]))
							$paddress = $address[0];
					?>
							<div class="info">
								<div class="inner-row">
									<div class="inputH">House Name / No.</div>
									<input type="text" name="house1" id="housep" value="<?php echo $paddress->houseName ?>" class="validate[minSize[3],custom[onlyLetterSp]]"
						placeholder="House Name / No." />
								</div>
								<div class="inner-row">
									<div class="inputCl">
										<div class="inputH">Place</div>
										<input type="text" name="houseplace1" id="placep" class="validate[minSize[3],custom[onlyLetterSp]]" value="<?php echo $paddress->place ?>" />
									</div>
								</div>
								<div class="inner-row">
									<div class="inputCl">
										<div class="inputH">City</div>
										<input type="text" name="housecity1" id="cityp" class="validate[minSize[3],custom[onlyLetterSp]]" value="<?php echo $paddress->city ?>"
						placeholder="City" />
									</div>
									<div class="tHolder">
										<div class="inputTx">District</div>
										<input type="text" name="housedistrict1" id="districtp" class="validate[minSize[3],custom[onlyLetterSp]]" value="<?php echo $paddress->district?>"
						placeholder="District" />
									</div>
								</div>
								<div class="inner-row">
									<div class="inputCl">
										<div class="inputH">State</div>
										<input type="text" name="housestate1" id="statep" class="validate[minSize[3],custom[onlyLetterSp]]" value="<?php echo $paddress->state ?>"
						placeholder="State" />
									</div>
									<div class="tHolder">
										<div class="inputTx">Country</div>
										<input type="text" name="housecountry1" id="countryp" class="validate[minSize[3],custom[onlyLetterSp]]" value="<?php echo $paddress->country?>"
						placeholder="Country" />
									</div>
								</div>
								<div class="inner-row">
									<div class="inputCl">
										<div class="inputH">Pincode</div>
										<input type="text" name="postcode1" id="postcodep" class="validate[custom[onlyNumberSp],minSize[6],maxSize[6]]" value="<?php echo $paddress->pincode?>" 
						placeholder="Post Code" />
									</div>
									
								</div>
							</div>
						</li>
						<li>
							<div class="title">
								Mobile No.
							</div>
							<div class="info">
								<input value="<?php if(isset($user->userpersonaldetails)) echo $user->userpersonaldetails->mobilePhone ?>" type="text" name="mobile" id="mobile" class="validate[required,minSize[10]]" /> 
							</div>
						</li>
						<li>
							<div class="title">
								Altranative Mobile No.
							</div>
							<div class="info">
								<input type="text" name="alterMobile" id="alterMobile" value="<?php if(isset($user->usercontactdetails)) echo $user->usercontactdetails->alternativeNo ?>" />

							</div>
						</li>
						<li>
							<div class="title">
								Facebook URL
							</div>
							<div class="info">
											<input type="text" value="<?php if(isset($user->usercontactdetails->facebookUrl)) echo $user->usercontactdetails->facebookUrl?>"
							name="facebook" id="facebook" /> 

							</div>
						</li>
						<li>
							<div class="title">
								Skype
							</div>
							<div class="info">
								<input value="<?php if(isset($user->usercontactdetails->skypeId)) echo $user->usercontactdetails->skypeId ?>"
							type="text" name="skype" id="skype" /> 
							</div>
						</li>
						<li>
							<div class="title">
								Google IM
							</div>
							<div class="info">
								<input value="<?php if(isset($user->usercontactdetails->googleIM)) echo $user->usercontactdetails->googleIM?>"
							type="text" name="google" id="google" /> 
							</div>
						</li>
						<li>
							<div class="title">
								Yahoo IM
							</div>
							<div class="info">
								<input value="<?php  if(isset($user->usercontactdetails->yahooIM))  echo $user->usercontactdetails->yahooIM ?>"
							type="text" name="yahoo" id="yahoo" />
							</div>
						</li>
						<!-- 
						<li>
						<?php $privacy =  $user->privacy(array('condition'=>"items='contact'"));
						$alValues = array();
	if(isset($privacy[0])){
	$alValue = $privacy[0];
	$alValues = explode(',',$alValue->privacy);
	}
	?>
							<div class="title">
								Who can view above detals 
							</div>
							<div class="info">
								<div class="check">
									<input type="checkbox" name="pcontact[]" <?php if(in_array('subscribers', $alValues)) { ?> checked="checked"<?php }?>value="subscribers"><span>Subscribers</span>
								</div>
								<div class="check">
									<input type="checkbox" name="pcontact[]" <?php if(in_array('request', $alValues)) { ?> checked="checked"<?php }?> value="request"> <span>By Request</span>
								</div>
							</div>
						</li>
						 -->
						<li>
							<input type="button" name="cancelPhoto" id="cancelPhoto" value="Cancel" class="type2b mL5" onclick="javascript:closeOverlay();" />
							<input type="submit" name="updatePhoto" id="updatePhoto" value="Update" class="type2b mL5" />	
						</li>
					</ul>
				</article>
				</form>
			</section>
			
<script type="text/javascript">
$(document).ready(function(){
    $("#userContact").validationEngine('attach');
  });


</script>			