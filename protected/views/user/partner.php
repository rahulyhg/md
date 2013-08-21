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
* @title partner.php
* @description <Description of this class>
*  @filesource <URL>
*  @version <Revision>
*/
?>

	<section class="data-contnr">
 <form id="userPartner"  name="userPartner" method="post"  action="/user/partner">
		<article class="section">
			<ul class="no-padd">
				<li>
					<h1 class="message">Let Us Know Your Partner Preference </h1>
				</li>
			</ul>
			<ul>
				<li>
					<p class="width100">Set your expectations about your partner. We will send you profiles based on this partner preference. This way we can be sure that you get the right match. </p>
				</li>
				<li>
					<div class="title">
						Prefered Age <span class="sup">*</span>
					</div>
					<div class="info">
					<?php echo CHtml::dropDownList('ageFrom',null,Utilities::getAge(),array('empty' => 'Age','class'=>'validate[required] wid120')); ?>
						
						<div class="married">
							<span class="text">to</span>
							<?php echo CHtml::dropDownList('ageTo',null,Utilities::getAge(),array('empty' => 'Age','class'=>'validate[required] wid120')); ?>
							<span class="text">years</span>
						</div>
					</div>
				</li>
				<li>
					<div class="title">
						Marital Status <span class="sup">*</span>
					</div>
					<div class="info">
						<div class="check ">
							<INPUT type="checkbox" class="validate[required] checkbox" value="4" name="maritial[]"> <span>Any</span>
						</div>
						<div class="check ">
							<INPUT type="checkbox" class="validate[required] checkbox" value="0" name="maritial[]"> <span>Unmarried </span>
						</div>
						<div class="check ">
							<INPUT type="checkbox" class="validate[required] checkbox" value="1" name="maritial[]"> <span>Widow/Widower</span>
						</div>
						<div class="check ">
							<INPUT type="checkbox" class="validate[required] checkbox" value="2" name="maritial[]"> <span>Divorced </span>
						</div>
						<div class="check ">
							<INPUT type="checkbox" class="validate[required] checkbox" value="3" name="maritial[]"> <span>Awaiting divorce</span>
						</div>
					</div>
				</li>
				<li>
					<div class="title">
						Have Children <span class="sup">*</span>
					</div>
					<div class="info">
						<div class="radio mR14">
							<input type="radio" name="child" class="validate[required] radio" value="0"> <span>Doesn't matter</span>
						</div>
						<div class="radio mR14">
							<input type="radio" name="child" class="validate[required] radio" value="1"> <span>Yes. living together </span>
						</div>
						<div class="radio mR14">
							<input type="radio" name="child" class="validate[required] radio" value="2"> <span>Yes. not living together</span>
						</div>
						<div class="radio mR14">
							<input type="radio" name="child" class="validate[required] radio" value="3"> <span>No </span>
						</div>
					</div>
				</li>
				<li>
					<div class="title">
						Height <span class="sup">*</span>
					</div>
					<div class="info">
					 <?php echo CHtml::dropDownList('heightFrom',null,Utilities::getHeights(),array('empty' => 'Height','class'=>'validate[required] wid120')); ?>
						
						<div class="married">
							<span class="text">to</span>
						<?php echo CHtml::dropDownList('heightTo',null,Utilities::getHeights(),array('empty' => 'Height','class'=>'validate[required] wid120')); ?>
						</div>
					</div>
				</li>
				<li>
					<div class="title">
						Physical Status <span class="sup">*</span>
					</div>
					<div class="info">
						<div class="radio mR14">
							<input type="radio" class="validate[required] checkbox" name="status" value="0"> <span>Normal</span>
						</div>
						<div class="radio mR14">
							<input type="radio" name="status" class="validate[required] checkbox" value="1"><span>Disabled </span>
						</div>
						<div class="radio mR14">
							<input type="radio" name="status" class="validate[required] checkbox" value="2"><span>Doesn't matter </span>
						</div>
					</div>
				</li>
				<li>
					<div class="title">
						Religion <span class="sup">*</span>
					</div>
					<div class="info">
					<?php $records = Religion::model()->findAll("active = 1");
  
		$list = CHtml::listData($records, 'religionId', 'name');
		echo CHtml::dropDownList('religion',null,$list,array('empty' => 'Religion','class'=>'validate[required] wid160','ajax' => array(
                        'type'=>'POST',
                        'url'=>CController::createUrl('Ajax/updateCastes'), 
                        'dataType'=>'json',
                        'data'=>array('religionId'=>'js:this.value'),  
                        'success'=>'function(data) {
                            $("#caste").html(data.dropDownCastes);
                        }',
            ))); ?>
					</div>
				</li>
				<li>
					<div class="title">
						Cast
					</div>
					<div class="info" id="letters">
					<?php 
						echo CHtml::dropDownList('caste',null,array(),array('class'=>'left ar','multiple'=>'multiple')); ?>
						<div class="ar-btn">
							<input class="add type2" value="Add" onclick="return add('caste','caste1')" type="button">
							<input class="remove type2" value="Remove" onclick="return add('caste1','caste')" type="button">
						</div>
						 <select class="right ar" id="caste1" name="caste1[]" multiple="multiple">
                        </select>
					</div>
				</li>
				<li>
					<div class="title">
						Manglik (chovvaadhosham)
					</div>
					<div class="info">
						<div class="radio mR14">
							<input name="dhosham" type="radio" value="1" /> <span>Yes</span>
						</div>
						<div class="radio">
							<input name="dhosham"  type="radio" value="0"  /> <span>No </span>
						</div>
					</div>
				</li>
				<li>
					<div class="title">
						Star
					</div>
					<div class="info" id="letters">
					<?php $records = AstrodateMaster::model()->findAll("active = 1");
							$list = CHtml::listData($records, 'astrodateId', 'name');
						    echo CHtml::dropDownList('star',null,$list,array('class'=>'left ar','multiple'=>'multiple')); ?>
						
						<div class="ar-btn">
							<input class="add type2" value="Add" onclick="return add('star','star1')" type="button">
							<input class="remove type2" value="Remove" onclick="return add('star1','star')" type="button">
						</div>
						<select class="right ar" id="star1" name="star1[]" multiple="multiple">
						</select>
					</div>
				</li>
				<li>
					<div class="title">
						Eating Habits
					</div>
					<div class="info">
						<div class="check ">
							<input type="checkbox" name="eat[]" value="0"  /><span>Vegetarian </span>
						</div>
						<div class="check ">
							<input type="checkbox" name="eat[]" value="1"  /> <span>Non vegetarian  </span>
						</div>
						<div class="check ">
							<input type="checkbox" name="eat[]" value="2"  /> <span>Eggetarian</span>
						</div>
						<div class="check ">
							<input type="checkbox" name="eat[]" value="3"  /> <span>Doesn't matter</span>
						</div>
					</div>
				</li>
				<li>
					<div class="title">
						Drinking Habits
					</div>
					<div class="info">
						<div class="check ">
							<input type="checkbox" name="drink[]" value="3" /><span>Doesn't matter  </span>
						</div>
						<div class="check ">
							<input type="checkbox" name="drink[]" value="0" /><span>Non-drinker</span>
						</div>
						<div class="check ">
							<input type="checkbox" name="drink[]" value="1" /> <span>Light/Social drinker</span>
						</div>
						<div class="check ">
							<input type="checkbox" name="drink[]" value="2" /> <span>Regular drinker</span>
						</div>
					</div>
				</li>
				<li>
					<div class="title">
						Smoking Habits
					</div>
					<div class="info">
						<div class="check ">
							  <input type="checkbox" name="smoke[]" value="3" /> <span>Doesn't matter  </span>
						</div>
						<div class="check ">
							  <input type="checkbox" name="smoke[]" value="0" /><span>Non-smoker</span>
						</div>
						<div class="check ">
							  <input type="checkbox" name="smoke[]" value="1" /> <span>Light/Social smoker</span>
						</div>
						<div class="check ">
							  <input type="checkbox" name="smoke[]" value="2" /> <span>Regular smoker </span>
						</div>
					</div>
				</li>
				<li>
					<div class="title">
						Mother Tongue
					</div>
					<div class="info" id="letters">
					<?php $records = Languages::model()->findAll("active = 1");
							$list = CHtml::listData($records, 'languageId', 'name');
						    echo CHtml::dropDownList('language',null,$list,array('class'=>'left ar','multiple'=>'multiple')); ?>
						
						<div class="ar-btn">
							<input class="add type2" value="Add" onclick="return add('language','language1')" type="button">
							<input class="remove type2" value="Remove" onclick="return add('language1','language')" type="button">
						</div>
						<select class="right ar" id="language1" name="language1[]" multiple="multiple">
						</select>
					</div>
				</li>
				<li>
					<div class="title">
						Country Living In <span class="sup">*</span>
					</div>
					<div class="info" id="letters">
					 <?php $records = Country::model()->findAll("active = 1");
							$list = CHtml::listData($records, 'countryId', 'name');
						    echo CHtml::dropDownList('country',null,$list,array('class'=>'left ar','multiple'=>'multiple')); ?>
						
						<div class="ar-btn">
							<input class="add type2" value="Add" onclick="return add('country','country1')" type="button">
							<input class="remove type2" value="Remove" onclick="return add('country1','country')" type="button">
						</div>
						<select class="validate[required] right ar" id="country1" name="country1[]" multiple="multiple">
						</select>
					</div>
				</li>
				<li>
					<div class="title">
						Citizenship <span class="sup">*</span>
					</div>
					<div class="info" id="letters">
					<?php $records = Country::model()->findAll("active = 1");
							$list = CHtml::listData($records, 'countryId', 'name');
						    echo CHtml::dropDownList('citizen',null,$list,array('class'=>'left ar','multiple'=>'multiple')); ?>
						
						<div class="ar-btn">
							<input class="add type2" value="Add" onclick="return add('citizen','citizen1')" type="button">
							<input class="remove type2" value="Remove" onclick="return add('citizen1','citizen')" type="button">
						</div>
						<select class="validate[required] right ar" id="citizen1" name="citizen1[]" multiple="multiple">
                        </select>
						
					</div>
				</li>
				<li>
					<div class="title">
						Residing State In India <span class="sup">*</span>
					</div>
					<div class="info" id="letters">
					<?php $records = States::model()->findAll("active = 1");
							$list = CHtml::listData($records, 'stateId', 'name');
						    echo CHtml::dropDownList('state',null,$list,array('class'=>'left ar','multiple'=>'multiple')); ?>
						
						<div class="ar-btn">
							<input class="add type2" value="Add" onclick="return add('state','state1')" type="button">
							<input class="remove type2" value="Remove" onclick="return add('state1','state')" type="button">
						</div>
						<select class="validate[required] right ar" id="state1" name="state1[]" multiple="multiple">
						</select>
					</div>
				</li>
				<li>
					<div class="title">
						District
					</div>
					<div class="info" id="letters">
					 <?php $records = Districts::model()->findAll("active = 1");
							$list = CHtml::listData($records, 'districtId', 'name');
						    echo CHtml::dropDownList('district',null,$list,array('class'=>'left ar','multiple'=>'multiple')); ?>
						
						<div class="ar-btn">
							<input class="add type2" value="Add" onclick="return add('district','district1')" type="button">
							<input class="remove type2" value="Remove" onclick="return add('district1','district')" type="button">
						</div>
						<select class="right ar" id="district1" name="district1[]" multiple="multiple">
						</select>
					</div>
				</li>
				<!-- 
				<li>
					<div class="title">
						Panchayath/Municipality/ <br />Corperation
					</div>
					<div class="info" id="letters">
					<?php $records = Places::model()->findAll("active = 1");
							$list = CHtml::listData($records, 'placeId', 'name');
						    echo CHtml::dropDownList('place',null,array(),array('class'=>'left ar','multiple'=>'multiple')); ?>
						
						<div class="ar-btn">
							<input class="add type2" value="Add" onclick="return add('place','place1')" type="button">
							<input class="remove type2" value="Remove" onclick="return add('place','place1')" type="button">
						</div>
						<select class="right ar" id="place1" name="place1[]" multiple="multiple">
						</select>
					</div>
				</li>
				 -->
				<li>
					<div class="title">
						Occupation
					</div>
					<div class="info" id="letters">
					<?php $records = OccupationMaster::model()->findAll("active = 1");
							$list = CHtml::listData($records, 'occupationId', 'name');
						    echo CHtml::dropDownList('occupation',null,$list,array('class'=>'left ar','multiple'=>'multiple')); ?>
						
						<div class="ar-btn">
							<input class="add type2" value="Add" onclick="return add('occupation','occupation1')" type="button">
							<input class="remove type2" value="Remove" onclick="return add('occupation1','occupation')" type="button">
						</div>
						<select class="right ar" id="occupation1" name="occupation1[]" multiple="multiple">
						</select>
					</div>
				</li>
				<li>
					<div class="title">
						Annual Income
					</div>
					<div class="info">
					<?php echo CHtml::dropDownList('income',null,Utilities::getAnnualIncome(),array('empty' => 'Income','class'=>'wid150')); ?>
					</div>
				</li>
				<li>
					<div class="title">
						Partner Description
					</div>
					<div class="info">
					<textarea name="partnerDesc" placeholder="Describe your expectations and what you're looking for in a partner.">
	</textarea>   
					</div>
				</li>
				<li>
					<div class="buttonContnr3">
						<input type="reset" value="Reset" name="yt1" class="type1b mR5"> 
						<input type="submit" value="Submit" name="yt0" class="type1b mL5">
					</div>
				</li>
			</ul>
		</article>
		</form>
	</section>
	
	<aside class="rightbar-contnr">
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
			<div class="subNow">Subscribe Now</div>
		</div>
	</aside>
	
	<script type="text/javascript">
$(document).ready(function(){
	$("#userPartner").validationEngine('attach');
    
    $("input:reset").click(function() {       // apply to reset button's click event
        this.form.reset();                    // reset the form
        // clear the form error validations      
		$("#userPartner").validationEngine('hideAll');
         return false;                         // prevent reset button from resetting again
    });

  });

</script>
	