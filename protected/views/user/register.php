
<section class="membership-contnr">
		<ul class="tab-head">
			<li id="tab1"><a id="tab1" class="select" href="#">Free membership</a></li>
			<li id="tab2"><a id="tab2" href="#">Paid membership</a></li>
		</ul>
		
		<ul id="tab1_data" class="tab-data">
		<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-register-form',
	'action' => Yii::app()->createUrl('user/register'),
	'enableAjaxValidation'=>false,
)); ?>
		<?php echo $form->errorSummary($model); ?>
		
			<li>All fields are mandatory</li>
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
				<?php echo CHtml::dropDownList('gender',null,array('F'=>'Female','M'=>'Male'),array('empty' =>'Gender','class'=>'validate[required] width35')); ?>
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
		echo CHtml::dropDownList('religion',null,$list,array('empty' => 'Religion','class'=>'validate[required] width90','id'=>'sReligion','ajax' => array(
                        'type'=>'POST',
                        'url'=>CController::createUrl('Ajax/updateCaste'), 
                        'dataType'=>'json',
                        'data'=>array('religionId'=>'js:this.value'),
								'beforeSend' => 'function(){
						      $(".ajax-progress").show();}',  
						  'complete'=> 'function(){
      $(".ajax-progress").hide();}',
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
			'beforeSend' => 'function(){
						      $(".ajax-progress").show();}',  
						  'complete'=> 'function(){
      $(".ajax-progress").hide();}', 
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
				<div class="right left-m40">
					<div class="button-contnr">
						<?php echo CHtml::resetButton('Reset',array('class' =>'type1b')); ?>
						<?php echo CHtml::submitButton('Submit',array('class'=>'type1b')); ?>
					</div>
				</div>
			</li> 	
		</ul>
		<?php $this->endWidget(); ?>
		<ul id="tab2_data" class="tab-data" style="display: none;">
			<li>
				<div class="subscribe-box noBord width95">
					<div class="sub-now">Subscribe Now! <br /><span>Only for</span></div>
					<div class="digitCont">
						<div class="digits">
							<span class="WebRupee">Rs.</span>200 
						</div>
						<div class="forTM">For 3 Months</div>
					</div>
					<div class="benefits">Benefits For Subsciribed Users</div>
					<div class="divider"> </div>
					<p>Contact members directly <br /> Send personalised messaages <br /> View Album, Documents, and contact details <br /> View horoscope of members <br /> Express Unlimited interest Plus other exclusive paid membership benefits</p>
					<a class="type6" href="/guest/paiduser" >Continue to Registration</a>
				</div>
			</li>
		</ul>
	</section>
	<section class="basic-search">
		<h2>BASIC SEARCH</h2>
		<ul class="search-data">
			
			<?php $searchForm=$this->beginWidget('CActiveForm', array(
	'id'=>'users-search-searchForm',
	'action' => Yii::app()->createUrl('search/basic'),
)); ?>	


	<?php echo $searchForm->errorSummary($searchModel); ?>
			
			<li>
				<div class="left">Looking for</div>
				<div class="right">
					<div class="check-contnr">
						<input id="SearchForm_bride" class="validate[required]" type="radio" name="SearchForm[bride]" value="F"><span>Ms</span>
					</div>
					<div class="check-contnr">
						<input id="SearchForm_bride" class="validate[required]" type="radio" name="SearchForm[bride]" value="M"><span>Mr</span>
					</div>
				</div>
			</li>
			<li>
				<div class="left"><?php echo $searchForm->labelEx($searchModel,'startAge'); ?></div>
				<div class="right">
				<?php echo CHtml::dropDownList('startAge',null,Utilities::getAge(),array('prompt' => 'Age','class'=>'validate[groupRequired[search1],funcCall[hidePromp]] width28')); ?>
					<span>To</span>
    	<?php echo CHtml::dropDownList('endAge',null,  Utilities::getAge(),array('prompt' => 'Age','class'=>'validate[groupRequired[search1],funcCall[checkAgeLimit]] width28')); ?>
					</div>
			</li>
			<li>
				<div class="left"><?php echo $searchForm->labelEx($searchModel,'motherTounge'); ?></div>
				<div class="right">
				<?php $records = Languages::model()->findAll("active = 1");
		$list = CHtml::listData($records, 'languageId', 'name');
		echo CHtml::dropDownList('motherTounge',null,$list,array('empty' => 'Language','class'=>'validate[groupRequired[search1]] width90')); ?>
		<?php echo $searchForm->error($searchModel,'motherTounge'); ?>
				</div>
			</li>
			<li>
				<div class="left"><?php echo $searchForm->labelEx($searchModel,'religion'); ?></div>
				<div class="right">
				<?php $records = Religion::model()->findAll("active = 1");
		$list = CHtml::listData($records, 'religionId', 'name');
		echo CHtml::dropDownList('religion',null,$list,array('empty' => 'Religion','class'=>'validate[groupRequired[search1]] width90','ajax' => array(
                        'type'=>'POST',
                        'url'=>CController::createUrl('Ajax/updateCaste'), 
                        'dataType'=>'json',
                        'data'=>array('religionId'=>'js:this.value'),  
                        'success'=>'function(data) {
                            $("#sCaste").html(data.dropDownCastes);
                        }',
            ))); ?>
		<?php echo $searchForm->error($searchModel,'religion'); ?>
				</div>
			</li>
			<li>
				<div class="left"><?php echo $searchForm->labelEx($searchModel,'caste'); ?></div>
				<div class="right">
				
		<?php 
		echo CHtml::dropDownList('caste','',array(),array('prompt' => 'Caste','id'=>'sCaste','class'=>'validate[groupRequired[search1]] width90')); ?>
		<?php echo $searchForm->error($searchModel,'caste'); ?>
				</div>
			</li>
			<li>
				<div class="left"><?php echo $searchForm->labelEx($searchModel,'state'); ?></div>
				<div class="right">
				<?php $records = States::model()->findAll("active = 1");
		$list = CHtml::listData($records, 'stateId', 'name');
		echo CHtml::dropDownList('state',null,$list,array('empty' => 'State','id'=>'sstate','class'=>'validate[groupRequired[search1]] width90','ajax' => array(
                        'type'=>'POST',
                        'url'=>CController::createUrl('Ajax/updateDistrict'), 
                        'dataType'=>'json',
                        'data'=>array('stateId'=>'js:this.value'),  
                        'success'=>'function(data) {
                            $("#district").html(data.dropDownDist);
                        }',
            ))); ?>
		<?php echo $searchForm->error($searchModel,'state'); ?>
				</div>
			</li>
			<li>
				<div class="left"><?php echo $searchForm->labelEx($searchModel,'district'); ?></div>
				<div class="right">
				<?php 
					
					echo CHtml::dropDownList('district',null,array(),array('prompt' => 'District','class'=>'validate[groupRequired[search1]] width90')); ?>
					<?php echo $searchForm->error($searchModel,'district'); ?>
				</div>
			</li>
			<li>
				<div class="left"><?php echo $searchForm->labelEx($searchModel,'heightStart'); ?></div>
				<div class="right">
				<?php echo CHtml::dropDownList('heightStart',null,Utilities::getHeights(),array('prompt' => 'Height','class'=>'validate[groupRequired[search1],funcCall[hidePromp]] width90')); ?>
				</div>
			</li>
			<li>
				<div class="left"></div>
				<div class="right">to</div>
			</li>
			<li>
				<div class="left"></div>
				<div class="right">
				<?php echo CHtml::dropDownList('heightLimit',null,Utilities::getHeights(),array('prompt' => 'Height','class'=>'validate[groupRequired[search1],condRequired[heightStart],funcCall[checkHeightLimit]] width90')); ?>	
				</div>
			</li>
			<li>
				<div class="left"><?php echo $searchForm->labelEx($searchModel,'bodyType'); ?></div>
				<div class="right">
				<?php echo CHtml::dropDownList('bodyType',null,Utilities::getBodyType(),array('empty' => 'Body Type','class'=>'validate[groupRequired[search1]] width90')); ?>
				</div>
			</li>
			<li>
				<div class="left"><?php echo $searchForm->labelEx($searchModel,'bodyColor'); ?></div>
				<div class="right">
				<?php echo CHtml::dropDownList('bodyColor',null,Utilities::getBodyColor(),array('empty' => 'Body Color','class'=>'validate[groupRequired[search1]] width90')); ?>
				</div>
			</li>
			<li>
				<div class="left"><?php echo $searchForm->labelEx($searchModel,'photo'); ?></div>
				<div class="right">
						<input type="checkbox" id="SearchForm_photo" name="SearchForm[photo]" value="1">
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
	<aside class="rightbar-contnr">
		<div class="searchID">
		<form id="keywordSearch"  name="keywordSearch" method="get"  action="/search/byid">
			<input name="id" type="text" class="validate[required]"  placeholder="Search By ID / Keyword" />
			<?php echo CHtml::submitButton('Search',array('class'=>'type2b')); ?>
		</form>	
			
		</div>
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
			</p>
			<div class="divider"> </div>
			<div class="subNow">Subscribe Now</div>
		</div>
	</aside>


<script type="text/javascript">
$(document).ready(function(){
	$("#users-register-form").validationEngine('attach');
	$("#keywordSearch").validationEngine('attach');
	$("#users-search-searchForm").validationEngine('attach');
	
    
    $("input:reset").click(function() {       // apply to reset button's click event
        this.form.reset();                    // reset the form
        // clear the form error validations      
		$("#users-register-form").validationEngine('hideAll');
         return false;                         // prevent reset button from resetting again
    });
    
    $(".membership-contnr").click(function(){
    	$("#keywordSearch").validationEngine('hide');
    	$("#LoginForm").validationEngine('hide');
    	
    });  
    $(".rightbar-contnr").click(function(){
    	$("#users-register-form").validationEngine('hide');
    	$("#LoginForm").validationEngine('hide');
    	
    });

    $(".basic-search").click(function(){
    	$("#users-register-form").validationEngine('hide');
    	$("#keywordSearch").validationEngine('hide');
    	$("#LoginForm").validationEngine('hide');
    	
    });

    $(".footer").click(function(){
    	$("#users-register-form").validationEngine('hideAll');
    	$("#keywordSearch").validationEngine('hideAll');
    	$("#LoginForm").validationEngine('hideAll');
    	
    });
    
    
    $('input').on("keyup", function(e) {
    	   var code = e.charCode || e.keyCode; // use charCode for firefox
    	  if (code == 13) {               
    	    e.preventDefault();
    	  }
    	});
    
    
  });


function checkAgeLimit(field, rules, i, options){
	if (field.val()) {

		if(!$('#startAge').val())
			return "Select proper age limit";

		var start = parseInt($('#startAge').val());
		
		if( parseInt(field.val()) <= start)
		return "Select proper age limit";
	}
}

function hidePromp(field, rules, i, options){
	if (field.val()) {
		$("#users-search-searchForm").validationEngine('hide');
	}
}
function checkHeightLimit(field, rules, i, options){
	if (field.val()) {

		if(!$('#heightStart').val())
			return "Select proper height limit";

		var start = parseInt($('#heightStart').val());
		
		if( parseInt(field.val()) <= start)
		return "Select proper height limit";
	}
}

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



</script>