<div class="subContent">
			<section class="subHead">
				<h1 ><?php echo $model->name?> <?php echo $model->marryId?></h1>
				<h5>Viewing persons contact details</h5>
			</section>
			<section class="subContnr">
				<ul class="accOverview pmB10">
					<!--  <li class="mT15">
						<div class="leftC">Contact Persons Name</div>
						<div class="rightC">
							<strong>:</strong> <span>Biju George</span>
						</div>
					</li>
					<li>
						<div class="leftC">Convineance Time to call</div>
						<div class="rightC">
							<strong>:</strong> <span>7.00 p.m. to 9.30 p.m.</span>
						</div>
					</li>
					 -->
					<li>
						<div class="leftC">Mobile No.</div>
						<div class="rightC">
							<strong>:</strong> <span><?php if(isset($model->userpersonaldetails)) echo $model->userpersonaldetails->mobilePhone ?></span>
						</div>
					</li>
					
					<li>
						<div class="leftC">Alternative Mobile No.</div>
						<div class="rightC">
							<strong>:</strong> <span><?php if(isset($model->usercontactdetails)) echo $model->usercontactdetails->alternativeNo; else echo "Not provided" ?>"</span>
						</div>
					</li>
					
				</ul>
				<ul class="accOverview pmB10">
					<li>
						<div class="leftC">Communication address</div>
						<div class="rightC">
							<strong>:</strong>
							<div class="addrs">
								<?php $address = Address::model()->findAll(array('condition'=> "userId = {$model->userId} and addresType = 1"));
								
								if(isset($address) && isset($address[0]))
								{
								$caddress = $address[0];
					?>
						<span><?php echo $caddress->houseName ?></span>
						<span><?php echo $caddress->postoffice?></span>
						<span><?php echo $caddress->city?></span>
						<span><?php echo $caddress->state.','.$caddress->country?></span>
						<span><?php echo $caddress->pincode?></span>
							</div>
						<?php } ?>
						</div>
					</li>
					<li>
						<div class="leftC">Permanent address</div>
						<div class="rightC">
							<strong>:</strong>
							<?php $address = Address::model()->findAll(array('condition'=> "userId = {$model->userId} and addresType = 0"));
					
							if(isset($address) && isset($address[0]))
								{
							$paddress = $address[0];
					?>
					<div class="addrs">
						<span><?php echo $paddress->houseName ?></span>
						<span><?php echo $paddress->postoffice?></span>
						<span><?php echo $paddress->city?></span>
						<span><?php echo $paddress->state.','.$paddress->country?></span>
						<span><?php echo $paddress->pincode?></span>
					</div>
					<?php }?>
						</div>
					</li>
					<li>
						<div class="leftC">Email ID.</div>
						<div class="rightC">
							<strong>:</strong> <span><?php echo $model->emailId ?></span>
						</div>
					</li>
					<li>
						<div class="leftC">Facebook Url</div>
						<div class="rightC">
							<strong>:</strong> <span><?php if(isset($model->usercontactdetails)) echo $model->usercontactdetails->facebookUrl?></span>
						</div>
					</li>
					<li>
						<div class="leftC">Skype</div>
						<div class="rightC">
							<strong>:</strong> <span><?php if(isset($model->usercontactdetails)) echo $model->usercontactdetails->skypeId ?></span>
						</div>
					</li>
					<li>
						<div class="leftC">Google IM</div>
						<div class="rightC">
							<strong>:</strong> <span><?php if(isset($model->usercontactdetails)) echo $model->usercontactdetails->googleIM?></span>
						</div>
					</li>
					<li>
						<div class="leftC">Yahoo IM</div>
						<div class="rightC">
							<strong>:</strong> <span><?php if(isset($model->usercontactdetails)) echo $model->usercontactdetails->yahooIM ?></span>
						</div>
					</li>
				</ul>
			</section>
