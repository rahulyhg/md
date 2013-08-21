<?php
/*
 *
 * $Id$
 --------------------------------------------------------------------------------------------------------------------------
 * Information contained in this file is the intellectual property of MarryDoor Plc
 * Copyright © 2012 MarryDorr. All Rights Reserved.
 * ---------------------------------------------------------------------------------------------------------------------------
 *
 * @author  Ageesh K Gopinath
 * @title contacts.php
 * @description <Description of this class>
 *  @filesource <URL>
 *  @version <Revision>
 */
?>
<form id="userContact" name="userContact" method="post" action="/user/contact">

<section class="data-contnr"> <article class="section">
<h1 class="message">Your life partner is just a click away!</h1>
<h5>
	<span class="sup">*</span>marked fields are mandatory
</h5>
</article> <article class="section">
<ul>
	<li>
		<div class="title">Regional Site</div>
		<div class="info">
			<select class="wid150">
				<option>Kerala</option>
			</select>
		</div>
	</li>
</ul>
<ul>
	<li><h3>Personal Details</h3></li>
	<li>
		<div class="title">
			Profile being created for <span class="sup">*</span>
		</div>
		<div class="info">
			<div class="radio wid90">
				<input type="radio" name="profileFor" class="validate[required]" value="0"> <span>Myself</span>
			</div>
			<div class="radio wid90">
				<input type="radio" name="profileFor" class="validate[required]"
					value="1"> <span>Son</span>
			</div>
			<div class="radio wid90">
				<input type="radio" name="profileFor" value="2"
					class="validate[required]"> <span>Brother</span>
			</div>
			<div class="radio wid90">
				<input type="radio" name="profileFor" value="3"
					class="validate[required]"><span>Relative</span>
			</div>
			<div class="radio wid90">
				<input type="radio" name="profileFor" value="4"
					class="validate[required]"><span>Friend</span>
			</div>
		</div>
	</li>
	<li>
		<div class="title">
			Marital status <span class="sup">*</span>
		</div>
		<div class="info">
			<div class="radio wid90">
				<input type="radio" name="marital" value="0"
					class="validate[required]"><span>Unmarried</span>
			</div>
			<div class="radio wid90">
				<input type="radio" name="marital" value="1"
					class="validate[required]"><span>Widower</span>
			</div>
			<div class="radio wid90">
				<input type="radio" name="marital" value="2"
					class="validate[required]"> <span>Divorced</span>
			</div>
			<div class="radio wid150">
				<input type="radio" name="marital" value="3"
					class="validate[required]"> <span>Awaiting divorce</span>
			</div>
		</div>
	</li>
	<li>
		<div class="title">
			Caste <span class="sup">*</span>
		</div>
		<div class="info">
		<?php
		$userPersonal = $user->userpersonaldetails;
		$religion = Religion::model()->findbyPk($user->userpersonaldetails->religionId);
		$caste = Caste::model()->findbyPk($user->userpersonaldetails->casteId);
		?>
			<div id="caste" class="special width90">
			<?php echo $religion->name ;?>
				-
				<?php if(isset($model->userpersonaldetails->caste))echo $model->userpersonaldetails->caste->name;else echo $caste->name ?>
				<a> edit</a>
			</div>
			<div id="casteList" style="display:none" >
			<?php $records = Religion::model()->findAll("active = 1");
		$list = CHtml::listData($records, 'religionId', 'name');
		echo CHtml::dropDownList('religion',$user->userpersonaldetails->religionId,$list,array('empty' => 'Religion','class'=>'validate[required] wid150','ajax' => array(
                        'type'=>'POST',
                        'url'=>CController::createUrl('Ajax/updateCaste'), 
                        'dataType'=>'json',
                        'data'=>array('religionId'=>'js:this.value'),  
                        'success'=>'function(data) {
                        $("#caste1").html(data.dropDownCastes);
                        }',
            ))); ?>
		<?php $records = Caste::model()->findAll("active = 1");
		$list = CHtml::listData($records, 'casteId', 'name');
		echo CHtml::dropDownList('caste',$user->userpersonaldetails->casteId,$list,array('empty' => 'Caste','id'=>'caste1','class'=>'validate[required] wid150')); ?>
			</div>
			</div>
	</li>
	<li>		
			<div class="title">
			Are you willing to marry from other communities
			</div>
		<div class="info">
			<div class="radio wid60">
				<input type="radio"  name="interCaste"
					value="1"><span>Yes</span>
			</div>
			<div class="radio wid60">
				<input type="radio"  name="interCaste"
					value="0"> <span>No</span>
			</div>
		</div>	
	</li>
	<li>
		<div class="title">
			Country living in <span class="sup">*</span>
		</div>
		 <?php
		$country = Country::model()->findbyPk($user->userpersonaldetails->countryId);
		?>
		<div class="info" id="country" style="display:none">
		<?php $records = Country::model()->findAll("active = 1");
		$list = CHtml::listData($records, 'countryId', 'name');
		echo CHtml::dropDownList('country',$user->userpersonaldetails->countryId,$list,array('empty' => 'Country','class'=>'validate[required] wid150')); ?>
		</div>
		
		<div id="countryEdit" class="info">
		<?php if(isset($user->userpersonaldetails->country))echo $user->userpersonaldetails->country->name;else  echo $country->name?>
			<a> edit</a>
		</div>
	</li>
	<li>
		<div class="title">
			Residing state <span class="sup">*</span>
		</div>
		<div class="info">

		<?php

		$records = States::model()->findAll("active = 1");
		$list = CHtml::listData($records, 'stateId', 'name');
		echo CHtml::dropDownList('state',$user->userpersonaldetails->stateId,$list,array('empty' => 'State','class'=>'validate[required] wid150','ajax' => array(
                        'type'=>'POST',
                        'url'=>CController::createUrl('Ajax/updateDistrict'), 
                        'dataType'=>'json',
                        'data'=>array('stateId'=>'js:this.value'),  
                        'success'=>'function(data) {
                            $("#district").html(data.dropDownDist);
                        }',
            ))); ?>
		</div>
	</li>
	<li>
		<div class="title">
			Residing district <span class="sup">*</span>
		</div>
		<div class="info">
					<?php
			echo CHtml::dropDownList('district',null,array(),array('prompt' => 'District','class'=>'validate[required] wid150','ajax' => array(
                        'type'=>'POST',
                        'url'=>CController::createUrl('Ajax/updatePlaces'), 
                        'dataType'=>'json',
                        'data'=>array('districtId'=>'js:this.value'),  
                        'success'=>'function(data) {
                            $("#place").html(data.dropDownDist);
                        }',
            ))); ?>
		
		</div>
	</li>
	<li>
		<div class="title">
			Residing Municipality <br />Corperation/ Panchayath<span class="sup"></span>
		</div>
		<div class="info">
					<?php
			echo CHtml::dropDownList('place',null,array(),array('prompt' => 'Places','class'=>'wid150')); ?>
		</div>
	</li>
</ul>
<ul>
	<li><h3>Personal Contact Details</h3></li>
	<li>
		<div class="title">
			Communication Address <span class="sup">*</span>
		</div>
		<div class="info">
			<div class="inner-row">
			<input type="text" name="house" id="house" class="validate[required,minSize[3],custom[onlyLetterSp]]"
						placeholder="House Name / No." />
			</div>
			<div class="inner-row">
			<input type="text" name="houseplace" id="houseplace" class="validate[required,minSize[3],custom[onlyLetterSp]]"
						placeholder="Place" />
			</div>
			<div class="inner-row">
			<input type="text" name="housecity" id="city" class="validate[required]"
						placeholder="City" />
				<input type="text" name="housedistrict" id="housedistrict" class="validate[required,minSize[3],custom[onlyLetterSp]]"
						placeholder="District" />
			</div>
			<div class="inner-row">
				<input type="text" name="housestate" id="statec" class="validate[required,minSize[3],custom[onlyLetterSp]]"
						placeholder="State" />
				<input type="text" name="housecountry" id="housecountry" class="validate[required,minSize[3],custom[onlyLetterSp]]"
						placeholder="Country" />
			</div>
			<div class="inner-row">
				<input type="text" name="postcode" id="postcode" class="validate[required,custom[onlyNumberSp],minSize[6],maxSize[6]]"
						placeholder="Post Code" />
			</div>
		</div>
	</li>
	<li>
		<div class="title">Permanent Address</div>
		<div class="info">
			<div class="inner-row">
			<input type="text" name="house1" id="housep" class="validate[minSize[3],custom[onlyLetterSp]]"
						placeholder="House Name / No." />
			</div>
			<div class="inner-row">
			<input type="text" name="houseplace1" id="placep" class="validate[minSize[3],custom[onlyLetterSp]]"
						placeholder="Place" />
			</div>
			<div class="inner-row">
			<input type="text" name="housecity1" id="cityp" class="validate[minSize[3],custom[onlyLetterSp]]"
						placeholder="City" />
				<input type="text" name="housedistrict1" id="districtp" class="validate[minSize[3],custom[onlyLetterSp]]"
						placeholder="District" />
			</div>
			<div class="inner-row">
				<input type="text" name="housestate1" id="statep" class="validate[minSize[3],custom[onlyLetterSp]]"
						placeholder="State" />
				<input type="text" name="housecountry1" id="countryp" class="validate[minSize[3],custom[onlyLetterSp]]"
						placeholder="Country" />
			</div>
			<div class="inner-row">
				<input type="text" name="postcode1" id="postcodep" class="validate[custom[onlyNumberSp],minSize[6],maxSize[6]]" 
						placeholder="Post Code" />
			</div>
		</div>
	</li>
	<li>
		<div class="title">Mobile No.</div>
		<div id="mobileList" class="info">
			<?php echo $userPersonal->mobilePhone; ?>  <a>Edit</a>
		</div>
		<div id="mobile" style="display:none " class="info">
			<input value="<?php echo $userPersonal->mobilePhone; ?>" type="text" name="mobile" id="mobile" class="validate[required,minSize[10]]" /> 
		</div>
	</li>
	<!-- <li>
		<div class="title">Landline No.</div>
		<div class="info">
			<?php 
						echo $userPersonal->landPhone ?>  <a href="#">Edit</a>
		</div>
	</li> -->
	<li>
		<div class="title">Altranative Mobile No.</div>
		<div class="info">
<input type="text" name="alterMobile" id="alterMobile"
							 /> 
		</div>
	</li>
	<li>
		<div class="title">Facebook URL</div>
		<div class="info">
			<input type="text"
							name="facebook" id="facebook" /> 
		</div>
	</li>
	<li>
		<div class="title">Skype</div>
		<div class="info">
			<input
							type="text" name="skype" id="skype" /> 
		</div>
	</li>
	<li>
		<div class="title">Google IM</div>
		<div class="info">
			<input
							type="text" name="google" id="google" /> 
		</div>
	</li>
	<li>
		<div class="title">Yahoo IM</div>
		<div class="info">
			<input
							type="text" name="yahoo" id="yahoo" />
		</div>
	</li>
	<!-- 
	<li>
		<div class="title">Who can view above detals</div>
		<div class="info">
		<div class="check">
							<input type="radio" name="pcontact" value="subscribers" checked="checked"><span>Subscribers</span>
						</div>
		
			<div class="check">
				<input type="radio" name="pcontact" value="request"> <span>By Request</span>
			</div>
		</div>
	</li>
	 -->
</ul>
<ul>
	<li><h3>Physical Attributes</h3></li>
	<li>
		<div class="title">
			Height in cm<span class="sup">*</span>
		</div>
		<div class="info">
		<?php echo CHtml::dropDownList('height',null,Utilities::getHeights(),array('empty' => 'Height','class'=>'validate[required] wid150')); ?>
		</div>
	</li>
	<li>
		<div class="title">
			Weight in kg<span class="sup">*</span>
		</div>
		<div class="info">
		<?php echo CHtml::dropDownList('weight',null,Utilities::getWeight(),array('empty' => 'Weight in Kg','class'=>'validate[required] wid150')); ?>
		</div>
	</li>
	<li>
		<div class="title">
			Body type <span class="sup">*</span>
		</div>
		<div class="info">
			<div class="radio wid90">
				<input type="radio" name="bodyType" class="validate[required] radio" value="0"> <span>Average</span>
			</div>
			<div class="radio wid90">
				<input type="radio" name="bodyType" class="validate[required] radio" value="1"> <span>Athletic </span>
			</div>
			<div class="radio wid90">
				<input type="radio" name="bodyType" class="validate[required] radio" value="2"> <span>Slim</span>
			</div>
			<div class="radio wid90">
				<input type="radio" name="bodyType" class="validate[required] radio" value="3"><span>Heavy</span>
			</div>
		</div>
	</li>
	<li>
		<div class="title">
			Complexion <span class="sup">*</span>
		</div>
		<div class="info">
			<div class="radio wid90">
				<input type="radio" name="complexion" class="validate[required]" value="0"><span>Very Fair</span>
			</div>
			<div class="radio wid90">
				<input type="radio" name="complexion" class="validate[required]" value="1"> <span>Fair </span>
			</div>
			<div class="radio wid90">
				<input type="radio" name="complexion" class="validate[required]" value="2"> <span>Wheatish </span>
			</div>
			<div class="radio wid130">
				<input type="radio" name="complexion" class="validate[required]" value="3"> <span>Wheatish brown</span>
			</div>
			<div class="radio wid90">
				<input type="radio" name="complexion" class="validate[required]" value="4"> <span>Dark</span>
			</div>
		</div>
	</li>
	<li>
		<div class="title">
			Physical status <span class="sup">*</span>
		</div>
		<div class="info">
			<div class="inner-row">
				<div class="radio wid90">
					<input type="radio" name="physical" class="validate[required]"  value="0"><span>Normal</span>
				</div>
				<div class="radio">
					<input type="radio" name="physical" class="validate[required]"  value="1">
					<span>Physically	challenged</span>
				</div>
			</div>
			<div id="option_list" subject="Physically challenged options"
				class="inner-row" style="display: none">
				<div class="check">
					<input type="checkbox" /> <span>Option1</span>
				</div>
				<div class="check">
					<input type="checkbox" /> <span>Option2</span>
				</div>
				<div class="check">
					<input type="checkbox" /> <span>Option3</span>
				</div>
				<div class="check">
					<input type="checkbox" /> <span>Option4</span>
				</div>
				<div class="check">
					<input type="checkbox" /> <span>Option5</span>
				</div>	
				<div class="check">
					<input type="checkbox" /> <span>Option6</span>
				</div>
			</div>
		</div>
	</li>
</ul>
<ul>
	<li><h3>Education & Occupation</h3></li>
	<li>
		<div class="title">
			Education <span class="sup">*</span>
		</div>
		<div class="info">
		<?php

					$records = EducationMaster::model()->findAll("active = 1");
					$list = CHtml::listData($records, 'educationId', 'name');
					echo CHtml::dropDownList('education',null,$list,array('empty' => 'Education','class'=>'validate[required] wid150')); ?>
			
		</div>
	</li>
	<li>
		<div class="title">
			Occupation <span class="sup">*</span>
		</div>
		<div class="info">
		<?php

					$records = OccupationMaster::model()->findAll("active = 1");
					$list = CHtml::listData($records, 'occupationId', 'name');
					echo CHtml::dropDownList('occupation',null,$list,array('empty' => 'Occupation','class'=>'validate[required] wid150')); ?>
		</div>
	</li>
	<li>
		<div class="title">
			Employed in <span class="sup">*</span>
		</div>
		<div class="info">
			<div class="radio wid100">
				<input type="radio" name="employed" class="validate[required]"  value="0"/><span>Government </span>
			</div>
			<div class="radio mR14">
				<input type="radio" name="employed" class="validate[required]"  value="1"/> <span>Private </span>
			</div>
			<div class="radio mR14">
				<input type="radio" name="employed" class="validate[required]"  value="2"/> <span>Business</span>
			</div>
			<div class="radio mR14">
				<input type="radio" name="employed" class="validate[required]"  value="3"/> <span>Defence</span>
			</div>
			<div class="radio mR14">
				<input type="radio" name="employed" class="validate[required]"  value="4"/><span>Self Employed</span>
			</div>
			<div class="radio ">
				<input type="radio" name="employed" class="validate[required]"  value="5"/><span>NRI</span>
			</div>
		</div>
	</li>
	<li>
		<div class="title">Income</div>
		<div class="info">
		<?php echo CHtml::dropDownList('income',null,Utilities::getAnnualIncome(),array('empty' => 'Income','class'=>'wid150')); ?>
		</div>
	</li>
</ul>
<ul>
	<li><h3>Habits</h3></li>
	<li>
		<div class="title">Food</div>
		<div class="info">
			<div class="radio wid100">
				<input type="radio" name="food" value="0" /> <span>Vegetarian </span>
			</div>
			<div class="radio wid130">
				<input type="radio" name="food" value="1" />  <span>Non-Vegetarian </span>
			</div>
			<div class="radio ">
				<input type="radio" name="food" value="2" /> <span>Eggetarian</span>
			</div>
		</div>
	</li>
	<li>
		<div class="title">Smoking</div>
		<div class="info">
			<div class="radio wid100">
				<input type="radio" name="smoke" value="0" /> <span>No </span>
			</div>
			<div class="radio wid130">
				<input type="radio" name="smoke" value="1" /> <span>Occasionally </span>
			</div>
			<div class="radio ">
				<input type="radio" name="smoke" value="2" /><span>Yes</span>
			</div>
		</div>
	</li>
	<li>
		<div class="title">Drinking</div>
		<div class="info">
			<div class="radio wid100">
				<input type="radio" name="drink" value="0" /> <span>No </span>
			</div>
			<div class="radio wid130">
				<input type="radio" name="drink" value="1" /> <span>Occasionally </span>
			</div>
			<div class="radio ">
				<input type="radio" name="drink" value="2" /> <span>Yes</span>
			</div>
		</div>
	</li>
</ul>
<ul>
	<li><h3>Family Profile</h3></li>
	<li>
		<div class="title">Family status</div>
		<div class="info">
			<div class="radio wid140">
				<input type="radio" name="status" value="0" /> <span>Lower middle class
				</span>
			</div>
			<div class="radio mR10">
				<input type="radio" name="status" value="1" /> <span>Middle class </span>
			</div>
			<div class="radio mR10">
				<input type="radio" name="status" value="2" /> <span> Upper middle
					class</span>
			</div>
			<div class="radio mR10">
				<input type="radio" name="status" value="3" /><span>Rich</span>
			</div>
			<div class="radio">
				<input type="radio" name="status" value="4" /> <span>Affluent </span>
			</div>
		</div>
	</li>
	<li>
		<div class="title">Family type</div>
		<div class="info">
			<div class="radio wid140">
				<input type="radio" name="type" value="0" /><span>Joint </span>
			</div>
			<div class="radio ">
				<input type="radio" name="type" value="1" /><span>Nuclear </span>
			</div>
		</div>
	</li>
	<li>
		<div class="title">Family values</div>
		<div class="info">
			<div class="radio wid140">
				<input type="radio" name="familyValues" value="0" /> <span>Orthodox </span>
			</div>
			<div class="radio wid100">
				<input type="radio" name="familyValues" value="1" />  <span>Traditional </span>
			</div>
			<div class="radio wid140">
				<input type="radio" name="familyValues" value="2" />  <span>Moderate </span>
			</div>
			<div class="radio ">
				<input type="radio" name="familyValues" value="3" />  <span>Liberal </span>
			</div>
		</div>
	</li>
	<li>
		<div class="title">Brothers</div>
		<div class="info">
		<?php echo CHtml::dropDownList('brothers',null,Utilities::getBrotherCount(),array('class'=>'wid50')); ?>
			<div class="married">
			<span class="text">Married</span>
				<?php echo CHtml::dropDownList('brothersMarry',null,Utilities::getBrotherCount(),array('class'=>'wid50')); ?>
			</div>
		</div>
	</li>
	<li>
		<div class="title">Sisters</div>
		<div class="info">
		<?php echo CHtml::dropDownList('sisters',null,Utilities::getBrotherCount(),array('class'=>'wid50')); ?>
			<div class="married">
			<span class="text">Married</span>
			<?php echo CHtml::dropDownList('sistersMarry',null,Utilities::getBrotherCount(),array('class'=>'wid50')); ?>
			</div>
		</div>
	</li>
	
	<li>
		<div class="title">About My family</div>
		<div class="info">
			<textarea 	name="familyDesc" rows="2" cols="20" 
				placeholder="Please give details about your family, background etc. Limit it to 100 words to get maximum results. Do not write your contact details here. If you do so, your ID will be rejected by our automated system."></textarea>
		</div>
	</li>
</ul>
<ul>
	<li>
		<h3>Discription*</h3>
	</li>
	<li>
		<div class="title"></div>
		<div class="info">
			<textarea rows="2" cols="20" name="myDesc" class="validate[required]"
				placeholder="Enter your personal details, qualification, profession, interests etc. Do not write your contact details here. If you do so, your ID will be rejected by our automated system."></textarea>
		</div>
	</li>
	<li>
		<div class="buttonContnr3">
			<?php echo CHtml::resetButton('Reset',array('class' =>'type1b mR5')); ?>
			<?php echo CHtml::submitButton('Submit',array('class'=>'type1b mL5')); ?>
		</div>
	</li>
</ul>
</article> 

</section>
</form>
<aside class="rightbar-contnr">
<div class="subscribe-box">
	<div class="sub-now">
		Subscribe Now!<br /> <span>Only for</span>
	</div>
	<div class="digit">
		<span class="WebRupee">Rs.</span>200
	</div>
	<div class="for">For 3 Months</div>
	<div class="divider"></div>
	<div class="benefit">Benefits of Subscribing</div>
	<p>
		Real time update about profile visitors <br /> Access key details of
		other users<br /> Contact candidates directly <br /> View horoscope of
		members <br /> Message candidates directly
	</p>
	<div class="divider"></div>
	<div class="subNow" >Subscribe Now</div>
</div>
</aside>


<script type="text/javascript">
$(document).ready(function(){
    $("#userContact").validationEngine('attach');

        $.ajax({
            type: "POST",
            url: "/Ajax/updateDistrict",
            'data':{'stateId':<?php echo $user->userpersonaldetails->stateId?>},
            'dataType':'json',
            dataType: "json",
            success: function(data) {
            	 $("#district").html(data.dropDownDist);
            }
        });
        return false;
    
    
  });

$("#mobileList a").click(function() {
	  $("#mobile").show();
	  $("#mobileList").hide();
	});

$("#caste a").click(function() {
	  $("#casteList").show();
	  $("#caste").hide();
	});
$("#countryEdit a").click(function() {
	  $("#country").show();
	  $("#countryEdit").hide();
	});


$("input:reset").click(function() {       // apply to reset button's click event
    this.form.reset();                    // reset the form
    // clear the form error validations      
	$("#userContact").validationEngine('hideAll');
     return false;                         // prevent reset button from resetting again
});

</script>
