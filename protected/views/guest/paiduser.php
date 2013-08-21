<?php
/*
*
* $Id$
--------------------------------------------------------------------------------------------------------------------------
* Information contained in this file is the intellectual property of Ladbrokes Plc
* Copyright © 2012 MarryDorr. All Rights Reserved.
* ---------------------------------------------------------------------------------------------------------------------------
*
* @author  Ageesh K Gopinath
* @title paiduser.php
* @description <Description of this class>
*  @filesource <URL>
*  @version <Revision>
*/
?>

<section class="membership-contnr paidMembC ">
		<ul class="tab-data mT0 inner">
		<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-register-form',
	'action' => Yii::app()->createUrl('user/register'),
 	'focus'=>array($model,'name'),
)); ?>					
		
			<li><h1>Paid Registration</h1></li>
			<li><span class="sup">*</span>All Fields are mandatory</li>
			<li>
				<div class="left"><?php echo $form->labelEx($model,'name'); ?></div>
				<div class="right">
					<?php echo $form->textField($model,'name',array('class' =>'validate[required,minSize[3],custom[onlyLetterSp],funcCall[checkUser]]')); ?>
					<?php echo $form->error($model,'name'); ?>
				</div>
			</li>
			<li>
				<div class="left"><?php echo $form->labelEx($model,'date'); ?></div>
				<div class="right">
				<?php echo CHtml::dropDownList('date',null,Utilities::getRegDays(),array('prompt'=>'Date','class'=>'validate[required] width28')); ?>
				<?php echo CHtml::dropDownList('month',null,Utilities::getRegMonths(),array('prompt'=>'Month','class'=>'validate[required] width37')); ?>		    
		    	<?php echo CHtml::dropDownList('year',null,  Utilities::getRegYears(),array('prompt'=>'Year','class'=>'validate[required] width28')); ?>
				<?php echo $form->error($model,'date'); ?>
				</div>
			</li>
			<li>
				<div class="left"><?php echo $form->labelEx($model,'gender'); ?></div>
				<div class="right">
				<?php echo CHtml::dropDownList('gender',null,array('' =>'Gender','F'=>'Female','M'=>'Male'),array('prompt'=>'Gender','class'=>'validate[required] width35')); ?>
				</div>
			</li>
			<li>
				<div class="left"><?php echo $form->labelEx($model,'motherTounge'); ?></div>
				<div class="right">
				<?php $records = Languages::model()->findAll("active = 1");
		$list = CHtml::listData($records, 'languageId', 'name');
		echo CHtml::dropDownList('motherTounge',null,$list,array('empty' => 'Language','class'=>'validate[required] width60')); ?>
		<?php echo $form->error($model,'motherTounge'); ?>
				</div>
			</li>
			<li>
					<div class="left"><?php echo $form->labelEx($model,'religion'); ?></div>
				<div class="right">
				<?php $records = Religion::model()->findAll("active = 1");
		$list = CHtml::listData($records, 'religionId', 'name');
		echo CHtml::dropDownList('religion',null,$list,array('empty' => 'Religion','class'=>'validate[required] width60','id'=>'sReligion','ajax' => array(
                        'type'=>'POST',
                        'url'=>CController::createUrl('Ajax/updateCaste'), 
                        'dataType'=>'json',
                        'data'=>array('religionId'=>'js:this.value'),  
                        'success'=>'function(data) {
                            $("#uCaste").html(data.dropDownCastes);
                        }',
            ))); ?>
		<?php echo $form->error($model,'religion'); ?>
				</div>
			</li>
			<li>
				<div class="left"><?php echo $form->labelEx($model,'caste'); ?></div>
				<div class="right">
		<?php echo CHtml::dropDownList('caste','',array(),array('prompt' => 'Caste','id'=>'uCaste','class'=>'validate[required] width60')); ?>
		<?php echo $form->error($model,'caste'); ?>
				</div>
			</li>
			<li>
				<div class="left"><?php echo $form->labelEx($model,'country'); ?></div>
				<div class="right">
				<?php $records = Country::model()->findAll("active = 1");
		$list = CHtml::listData($records, 'countryId', 'name');
		echo CHtml::dropDownList('country',null,$list,array('empty' => 'Country','class'=>'validate[required] width60','ajax' => array(
                        'type'=>'POST',
                        'url'=>CController::createUrl('Ajax/updateState'), 
                        'dataType'=>'json',
                        'data'=>array('countryId'=>'js:this.value'),  
                        'success'=>'function(data) {
                            $("#state").html(data.dropDownStates);
                        }',
            )
		
		)); ?>
		<?php echo $form->error($model,'country'); ?>
				</div>
			</li>
			<li>
				<div class="left"><?php echo $form->labelEx($model,'state'); ?></div>
				<div class="right">
				<?php echo CHtml::dropDownList('state','',array(),array('prompt' => 'State','class'=>'validate[required] width60')); ?>
		<?php echo $form->error($model,'state'); ?>
				</div>
			</li>
			<li>
				<div class="left"><?php echo $form->labelEx($model,'mobileNo'); ?></div>
				<div class="right">
					<?php echo $form->textField($model,'mobileNo',array('class'=>'validate[required,minSize[10],maxSize[10],custom[onlyNumberSp],funcCall[checkMobile]]')); ?>
					<?php echo $form->error($model,'mobileNo'); ?>
				</div>

			</li>
			
			<li>
					<div class="left"><?php echo $form->labelEx($model,'emailId'); ?></div>
				<div class="right">
					<?php echo $form->textField($model,'emailId',array('class'=>'validate[required,funcCall[checkEmailValidation], funcCall[checkEmail]]')); ?>
		<?php echo $form->error($model,'emailId'); ?>
				</div>
			</li>
			<li>
				<div class="left"><?php echo $form->labelEx($model,'password'); ?></div>
				<div class="right">
					<?php echo $form->passwordField($model,'password',array('class'=>'validate[required]')); ?>
					<?php echo $form->error($model,'password'); ?>
				</div>
			</li>
			<li>
				<div class="left"> </div>
				<div class="right">
					<h4>Enter Your Pin Number Here</h4>
					<?php echo $form->textField($model,'coupon',array('class'=>'validate[required,minSize[15],maxSize[15],funcCall[checkCoupon]]')); ?>
					<h4>or Call us +91 9400 005 005</h4>
				</div>
			</li>
			<li>
				<div class="right left-m40">
					<div class="button-contnr">
						<?php echo CHtml::resetButton('Reset',array('class' =>'type1b')); ?>
						<?php echo CHtml::submitButton('Submit',array('class'=>'type1b')); ?>
					</div>
				</div>
			</li> 	
			<?php $this->endWidget(); ?>
			
		</ul>
	</section>
	<aside class="rightbar-contnr mR70">
		<div class="subscribe-box">
			<div class="sub-now">Subscribe Now!<br /><span>Only for</span></div>
			<div class="digit"><span class="WebRupee">Rs.</span>200</div>
			<div class="for">For 3 Months</div>
			<div class="divider"> </div>
			<div class="benefit">Benefits of Subscribing </div>
			<p>
				Real time update about profile visitors <br />
				Access key details of other users<br />
				Contact candidates directly  <br />
				View horoscope of members <br />
				Message candidates directly
			</p>
			<div class="divider"> </div>
			<a class="subNow" href="#">Subscribe Now</a>
		</div>
	</aside>

 
 <script type="text/javascript">
$(document).ready(function(){
    $("#users-register-form").validationEngine('attach');
 

$("input:reset").click(function() {       // apply to reset button's click event
    this.form.reset();                    // reset the form
    // clear the form error validations      
	$("#users-register-form").validationEngine('hideAll');
     return false;                         // prevent reset button from resetting again
});

$('input').on("keyup", function(e) {
	   var code = e.charCode || e.keyCode; // use charCode for firefox
	  if (code == 13) {               
	    e.preventDefault();
	  }
	});

});
function checkEmail(field, rules, i, options){

	
	var sAvailable = 'This email is available.';
	var sUnavailable = 'This email is already used. Please try another.';
	var email = false;		
	$.ajax({
	type: 'GET',
	url: '/ajax/useremail',
	dataType: 'json',
	cache: false,
	success: function(availability) {
	email = availability;
	
},
data: {email : $('#UserForm_emailId').val()},
async: false
});

			// return success status
		
	
		if (email == true) {
		return sUnavailable;
		}else{ 
			return true;
		}

}


function checkMobile(field, rules, i, options){

	 if ($('#UserForm_mobileNo').val() == 0) {
			return true;
		}
	var sAvailable = 'This mobile number is available.';
	var sUnavailable = 'This mobile number is already used. Please try another.';
	var mobile = false;		
	$.ajax({
	type: 'GET',
	url: '/ajax/usermobile',
	dataType: 'json',
	cache: false,
	success: function(availability) {
	mobile = availability;
	
},
data: {mobile : $('#UserForm_mobileNo').val()},
async: false
});

		if (mobile == true) {
			return sUnavailable;
		}else{
			return true; 
		}

}

function checkEmailValidation(field, rules, i, options) {
	var pattern = new RegExp(options.allrules.email.regex);
    if (field.val().length && !pattern.test(field.val())) {
		return options.allrules.email.alertText;
	}
}


function checkUser(field, rules, i, options){

	
	var sUnavailable = 'This user name cannot be used, please try another.';
	var email = false;		
	$.ajax({
	type: 'GET',
	url: '/ajax/username',
	dataType: 'json',
	cache: false,
	success: function(availability) {
	email = availability;
	
},
data: {name : $('#UserForm_name').val()},
async: false
});

			// return success status
		
	
		if (email == true) {
		return sUnavailable;
		}else{ 
			return true;
		}

}

function checkCoupon(field, rules, i, options){

	
	var sUnavailable = 'Coupon is not valid,please call us +91 9400 005 005.';
	var email = false;		
	$.ajax({
	type: 'POST',
	url: '/ajax/coupon',
	dataType: 'json',
	cache: false,
	success: function(availability) {
	email = availability;
	
},
data: {coupon : field.val()},
async: false
});

			// return success status
		
	
		if (email == false) {
		return sUnavailable;
		}else{ 
			return true;
		}

}


</script>	
 