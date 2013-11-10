<div class="md-wrap">
	<article class="home-contnr">
		<section class="graphix">
			<div class="malayalam"></div>
			<div class="birds"></div>
		</section>
		<section class="register-contnr">
			<hgroup>
				<h2>Register now, Its Free !</h2>
			</hgroup>
			<ul class="reg-form">
				<ul id="tab1_data" class="tab-data">
					<?php
						$form=$this->beginWidget('CActiveForm', array(
							'id'=>'users-register-form',
							'action' => Yii::app()->createUrl('user/register'),
							'enableAjaxValidation'=>false,
						));
					?>
					<?php echo $form->errorSummary($model); ?>
					<li>
						<div class="form-texts">
							Name
						</div>
						<div class="form-inputs">
							<input class="form-name" type="text" name="fName" placeholder="First Name" />
							<input class="form-name" type="text"name="lName" placeholder="Last Name" />
						</div>
					</li>
					<li>
						<div class="form-texts">
							Gender
						</div>
						<div class="form-inputs">
							<div class="gender-sec">
								<input class="validate[required] wid50" type="radio" name="gender" value="M" />
								<span class="gender-text">Male</span>
							</div>
							<div class="gender-sec">
								<input class="validate[required] wid50" type="radio" name="gender" value="F"/>
								<span class="gender-text">Female</span>
							</div>
						</div>
					</li>
					<li>
						<div class="form-texts">
							Date Of Birth
						</div>
						<div class="form-inputs">
							<span class="date">
								<select class="chosen-select" id="date" name="date">
									<option value="">Date</option>
								<?php
									foreach(Utilities::getRegDays() as $value){
										echo '<option value="'.$value.'">'.$value.'</option>';
									}
								?>
								</select>
							</span>
							<span class="month">
								<select class="chosen-select" id="month" name="month">
								<option value="">Month</option>
								<?php
									foreach(Utilities::getRegMonths() as $key => $value){
										echo '<option value="'.$key.'">'.$value.'</option>';
									}
								?>
								</select>
							</span>
							<span class="year">
								<select class="chosen-select" id="year" name="year">
								<option value="">Year</option>
								<?php
									foreach(Utilities::getRegYears() as $value){
										echo '<option value="'.$value.'">'.$value.'</option>';
									}
								?>
								</select>
							</span>
							<?php echo $form->error($model,'date'); ?>
						</div>
					</li>
					<li>
						<div class="form-texts">
							Religion
						</div>
						<div class="form-inputs">
							<?php
								$records = Religion::model()->findAll("active = 1");
								$list = CHtml::listData($records, 'religionId', 'name');
							?>
							<select id="sReligion" name="religion">
								<option value="">Religion</option>
							<?php
								foreach($list as $key=>$value){
									echo '<option value="'.$key.'">'.$value.'</option>';
								}
							?>
							</select>
						</div>
						<?php echo $form->error($model,'religion'); ?>
					</li>
					<li>
						<div class="form-texts">
							Caste
						</div>
						<div class="form-inputs">
							<select id="uCaste" name="caste">
								
							</select>
						</div>
					</li>
					<li>
						<div class="form-texts">
							State
						</div>
						<div class="form-inputs">
							<select id="sstate" name="state">
								<option value="">State</option>
								<option value="1">Kerala</option>
								<option value="2">Karnataka</option>
								<option value="3">Tamil Nadu</option>
								<option value="4">Andhra Pradesh</option>
								<option value="5">Delhi</option>
								<option value="6">Punjab</option>
								<option value="7">Haryana</option>
								<option value="8">Uttar Pradesh</option>
								<option value="9">Himachal Pradesh</option>
								<option value="10">Uttrakhand</option>
								<option value="11">Jammu &amp; Kashmir</option>
								<option value="12">Bihar</option>
								<option value="13">Maharashtra</option>
								<option value="14">Arunachal Pradesh</option>
								<option value="15">Madhya Pradesh</option>
							</select>
						</div>
					</li>
					<li>
						<div class="form-texts">
							District
						</div>
						<div class="form-inputs">
							<select id="district" name="district">
								
							</select>
						</div>
					</li>
					<li>
						<div class="form-texts">
							Mobile Number
						</div>
						<div class="form-inputs">
							<input class="wid300" name="mobileNo" id="UserForm_mobileNo" type="text" placeholder="Enter 10 digits number" />
						</div>
					</li>
					<li>
						<div class="form-texts">
							Email ID
						</div>
						<div class="form-inputs">
							<input class="wid300" type="text" name="emailId" id="UserForm_emailId" placeholder="Enter a valid Email ID" />
						</div>
					</li>
					<li>
						<div class="form-texts">
							Password
						</div>
						<div class="form-inputs">
							<input class="wid300" type="password" name="password" id="UserForm_password" placeholder="Password" />
						</div>
					</li>
					<li>
						<div class="form-texts form-capt">
							<?php
								$captcha = mt_rand(100000,999999);
								$captcha = Utilities::generateCaptcha()
							?>
							<input type=hidden  name="captcha1" id="captchaValidate" value="<?php echo $captcha['code']; ?>">
							<span class="copy-text copy-capt"><img id="captcha_img" src="<?php echo $captcha['image_src'];?>" /></span>
						</div>
						<div class="form-inputs">
							<input class="form-name" type="text" name="captcha" placeholder="Type the Digits here" />
							<input type="submit" class="submitRegistration" value="Submit">
						</div>
					</li>
					<?php $this->endWidget(); ?>
				</ul>
				<script>
					jQuery.validator.setDefaults({ ignore: ":hidden:not(select,input:radio)" });
					function checkStateStatus() {
						return ($('select[name="state"]').val() == 1)? true : false;
					};
					jQuery(function($) {
						$('input[type="radio"]').prettyCheckable();
						var config = {
							'select'           : {},
							'.chosen-select-deselect'  : {allow_single_deselect:true},
							'.chosen-select-no-single' : {disable_search_threshold:10},
							'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
							'.chosen-select-width'     : {width:"95%"}
						}
						for (var selector in config) {
							$(selector).chosen(config[selector]);
						}
						$('select').chosen().change(function(event, data) {
							$sel = $(this).attr('id');
							if($sel == 'sstate'){$('label[for="district"]').hide();}
							$('label[for="'+$sel+'"]').hide();
						});
						$("#users-register-form").validate({
							
							onfocusout: false,
							rules: {
								fName:{
									required: true,
									minlength: 3
								},
								religion:{
									required: true
								},
								caste:{
									required: true
								},
								date:{
									required: true
								},
								month:{
									required: true
								},
								year:{
									required: true
								},
								emailId: {
									required: true,
									email: true,
									checkEmail:true
								},
								mobileNo:{
									required: true,
									minlength:10,
									maxlength:10,
									checkMobile:true
								},
								password:{
									required: true
								},
								state:{
									required: true,
								},
								district: {
									required: {depends:checkStateStatus}
								},
								captcha:{
									equalTo:"#captchaValidate",
								}
							},
							submitHandler: function(form) {	
								form.submit();
							}		
						});
						
						$('body').on('change','#sReligion',function(){
							jQuery.ajax({
								'type':'POST',
								'url':'/Ajax/updateCaste',
								'dataType':'json',
								'data':{'religionId':this.value},
								'beforeSend':function(){
									$(".ajax-progress").show();
								},
								'complete':function(){
									$(".ajax-progress").hide();
								},
								'success':function(data) {
									$("#uCaste").html(data.dropDownCastes);
									$("#uCaste").chosen().trigger("chosen:updated");
								},
								'cache':false
							});
							return false;
						});
						$('body').on('change','#sstate',function(){
							jQuery.ajax({
								'type':'POST',
								'url':'/Ajax/updateDistrict',
								'dataType':'json',
								'data':{'stateId':this.value},
								'success':function(data) {
									$("#district").html(data.dropDownDist);
									$("#district").chosen().trigger("chosen:updated");
								},
								'cache':false
							});
							return false;
						});
					});
					jQuery.validator.addMethod("checkEmail", function(value, element) {
						var isSuccess = false;
						$.ajax({
							url: "/ajax/useremail",
							type: "GET",
							dataType: 'json',
							cache: false,
							data: {email : $('#UserForm_emailId').val()}, 
							async: false, 
							success: function(msg) {
								console.log(msg);
								isSuccess = msg === false ? true : false
							}
						});
						return isSuccess;
					}, "* This email is already used. Please try another.");
					
					jQuery.validator.addMethod("checkMobile", function(value, element) {
						var isSuccess = false;
						$.ajax({
							url: "/ajax/usermobile",
							type: "GET",
							dataType: 'json',
							cache: false,
							data: {mobile : $('#UserForm_mobileNo').val()}, 
							async: false, 
							success: function(msg) {
								console.log(msg);
								isSuccess = msg === false ? true : false
							}
						});
						return isSuccess;
					}, "* This mobile number is already used. Please try another.");
				</script>
			</ul>
		</section>
	</article>
</div>