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
* @title editpartner.php
* @description <Description of this class>
*  @filesource <URL>
*  @version <Revision>
*/
?>

  <?php $this->widget('application.widgets.menu.Leftmenu'); 
  $user = Yii::app()->session->get('user');
  
  $partner = $user->partnerpreferences
  ?>
	<section class="data-contnr3">
	<form id="userPartner"  name="userPartner" method="post"  action="/mypage/editpartner">
		<article class="section">
			<ul class="no-padd">
				<li class="mT5">
					<h1 class="message">Edit my Partner Preference</h1>
				</li>
			</ul>
			<ul>
				<li>
					<div class="title">
						Prefered Age <span class="sup">*</span>
					</div>
					<div class="info">
					<?php if(isset($partner->ageFrom))
					$ageFrom = $partner->ageFrom; 
					else
					$ageFrom = null
					?>
					<?php echo CHtml::dropDownList('ageFrom',null,Utilities::getAge(),array('empty' => 'Age','class'=>'validate[required] wid120','options' => array($ageFrom =>array('selected'=>true)))); ?>
						
						<div class="married">
							<span class="text">to</span>
							<?php if(isset($partner->ageTo))
					$ageTo = $partner->ageTo; 
					else
					$ageTo = null
					?>
							<?php echo CHtml::dropDownList('ageTo',null,Utilities::getAge(),array('empty' => 'Age','class'=>'validate[required] wid120','options' => array($ageTo =>array('selected'=>true)))); ?>
							<span class="text">years</span>
						</div>
					</div>
				</li>
				<li>
					<div class="title">
						Marital Status <span class="sup">*</span>
					</div>
					<?php 
						$unMarry = false;
							$widower = false;
							$divorce = false;
							$adivorce = false;
							$any = false;
						if(isset($partner->maritalStatus))
						{
							
							$maritalStatus = explode(",", $partner->maritalStatus);
							
							$unMarry = in_array(0,$maritalStatus);
							$widower = in_array(1,$maritalStatus);
							$divorce = in_array(2,$maritalStatus);
							$adivorce = in_array(3,$maritalStatus);
							$any = in_array(4,$maritalStatus);
						}
						?>
					<div class="info">
						<div class="check ">
							<INPUT type="checkbox" class="validate[required] checkbox" <?php if($any != false ) {?> checked="checked" <?php } ?>    value="4" name="maritial[]"> <span>Any</span>
						</div>
						<div class="check ">
							<INPUT type="checkbox" class="validate[required] checkbox"  <?php if($unMarry != false ) {?> checked="checked" <?php } ?> value="0" name="maritial[]"> <span>Unmarried </span>
						</div>
						<div class="check ">
							<INPUT type="checkbox" class="validate[required] checkbox" value="1" <?php if($widower != false ) {?> checked="checked" <?php } ?> name="maritial[]"> <span>Widow/Widower</span>
						</div>
						<div class="check ">
							<INPUT type="checkbox" class="validate[required] checkbox" value="2" <?php if($divorce != false ) {?> checked="checked" <?php } ?>   name="maritial[]"> <span>Divorced </span>
						</div>
						<div class="check ">
							<INPUT type="checkbox" class="validate[required] checkbox" value="3" <?php if($adivorce != false ) {?> checked="checked" <?php } ?>   name="maritial[]"> <span>Awaiting divorce</span>
						</div>
					</div>
				</li>
				<li>
					<div class="title">
						Have Children <span class="sup">*</span>
					</div>
					<?php if(isset($partner->haveChildren))
						$child = $partner->haveChildren;
						else 
						$child = null;
					?>
					<div class="info">
						<div class="radio mR14">
							<input type="radio" name="child" class="validate[required] radio" <?php if($child == 0) {?> checked="checked" <?php } ?> value="0"> <span>Doesn't matter</span>
						</div>
						<div class="radio mR14">
							<input type="radio" name="child" class="validate[required] radio" <?php if($child == 1) {?> checked="checked" <?php } ?>  value="1"> <span>Yes. living together </span>
						</div>
						<div class="radio mR14">
							<input type="radio" name="child" class="validate[required] radio" <?php if($child == 2) {?> checked="checked" <?php } ?>  value="2"> <span>Yes. not living together</span>
						</div>
						<div class="radio mR14">
							<input type="radio" name="child" class="validate[required] <?php if($child == 3) {?> checked="checked" <?php } ?>  radio" value="3"> <span>No </span>
						</div>
					</div>
				</li>
				<li>
					<div class="title">
						Height <span class="sup">*</span>
					</div>
					<div class="info">
					<?php
					if(isset($partner->heightFrom ))
					$hF = $partner->heightFrom;
					else  
					$hF = null
					?>
					 <?php echo CHtml::dropDownList('heightFrom',null,Utilities::getHeights(),array('empty' => 'Height','class'=>'validate[required] wid120','options' => array($hF=>array('selected'=>true)))); ?>
						
						<div class="married">
							<span class="text">to</span>
							<?php
					if(isset($partner->heightTo))
					$hT = $partner->heightTo;
					else  
					$hT = null
					?>
						<?php echo CHtml::dropDownList('heightTo',null,Utilities::getHeights(),array('empty' => 'Height','class'=>'validate[required] wid120','options' => array($hT =>array('selected'=>true)))); ?>
						</div>
					</div>
				</li>
				<li>
					<div class="title">
						Physical Status <span class="sup">*</span>
					</div>
					<?php 
					if(isset($partner->physicalStatus))
					$phy = $partner->physicalStatus;
					else
					$phy = null;
					?>
					<div class="info">
						<div class="radio mR14">
							<input type="radio" class="validate[required] checkbox" name="status" <?php if($phy == '0'){?> checked="checked" <?php }?>  value="0"> <span>Normal</span>
						</div>
						<div class="radio mR14">
							<input type="radio" name="status" class="validate[required] checkbox" <?php if($phy == '1'){?> checked="checked" <?php }?>  value="1"><span>Disabled </span>
						</div>
						<div class="radio mR14">
							<input type="radio" name="status" <?php if($phy == '2'){?> checked="checked" <?php }?> class="validate[required] checkbox" value="2"><span>Doesn't matter </span>
						</div>
					</div>
				</li>
				<li>
					<div class="title">
						Religion 
					</div>
					<div class="info">
					<?php if(isset($partner->religion))
					$rel = $partner->religion;
					else
					$rel = null;
					?>
					<?php $records = Religion::model()->findAll("active = 1");
  
					$list = CHtml::listData($records, 'religionId', 'name');
					echo CHtml::dropDownList('religion',$rel,$list,array('empty' => 'Religion','class'=>'validate[required] wid160','ajax' => array(
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
					$condition ="";
					if(isset($partner->religion))
					$condition .= "religionId = {$partner->religion} AND ";
					if(isset($partner->caste))
					$records = Caste::model()->findAll(array('condition'=> $condition."casteId NOT IN({$partner->caste})"));
					else
					$records = Caste::model()->findAll(array('condition'=> $condition." active = 1"));
							$list = CHtml::listData($records, 'casteId', 'name');
							echo CHtml::dropDownList('caste',null,$list,array('class'=>'left ar','multiple'=>'multiple')); ?>
							<div class="ar-btn">
							<input class="add type2" value="Add" onclick="return add('caste','caste1')" type="button">
							<input class="remove type2" value="Remove" onclick="return add('caste1','caste')" type="button">
						</div>
						<?php if(isset($partner->caste))
							$records = Caste::model()->findAll(array('condition'=> "casteId IN({$partner->caste})"));
							else
							$records = array();
							
							$list = CHtml::listData($records, 'casteId', 'name');
							echo CHtml::dropDownList('caste1[]',null,$list,array('class'=>'left ar','id'=>'caste1','multiple'=>'multiple')); ?>
					</div>
				</li>
				<li>
					<div class="title">
						Manglik
					</div>
					<?php 
					if(isset($partner->dosham))
					$dos = $partner->dosham;
					else 
					$dos = null;
					
					?>
					<div class="info">
						<div class="radio mR14">
							<input name="dhosham"  <?php if($dos == 1) {?> checked="checked" <?php } ?> type="radio" value="1" /> <span>Yes</span>
						</div>
						<div class="radio">
							<input name="dhosham" <?php if($dos == 0) {?> checked="checked" <?php } ?>  type="radio" value="0"  /> <span>No </span>
						</div>
					</div>
				</li>
				<li>
					<div class="title">
						Star
					</div>
					
					<div class="info">
						<?php 
							if(isset($partner->star))
							$records = AstrodateMaster::model()->findAll(array('condition'=> "astrodateId NOT IN({$partner->star})"));
						    else
						   $records = AstrodateMaster::model()->findAll("active = 1");
						
							$list = CHtml::listData($records, 'astrodateId', 'name');
						    echo CHtml::dropDownList('star',null,$list,array('class'=>'left ar','multiple'=>'multiple')); ?>
									
							<div class="ar-btn">
							<input class="add type2" value="Add"  onclick="return add('star','star1')" type="button">
							<input class="remove type2" value="Remove" onclick="return add('star1','star')" "type="button">
							</div>
							<?php 
							if(isset($partner->star))
							$records = AstrodateMaster::model()->findAll(array('condition'=> "astrodateId IN({$partner->star})"));
						    else
						   $records = array();
							$list = CHtml::listData($records, 'astrodateId', 'name');
						    echo CHtml::dropDownList('star1[]',null,$list,array('class'=>'right ar','id'=>'star1','multiple'=>'multiple')); ?>
							
						</div>
				</li>
				<li>
					<div class="title">
						Eating Habits
					</div>
					<?php
							$all = false;
							$veg = false;
							$non = false;
							$egg = false;
						if(isset($partner->eatingHabits))
						{
							$eat = explode(",", $partner->eatingHabits);
							$veg = in_array(0,$eat);
							$non = in_array(1,$eat);
							$egg = in_array(2,$eat);
							$all = in_array(3,$eat);
						}
						?>
						
					<div class="info">
						<div class="check ">
							<input type="checkbox" name="eat[]" value="0" <?php if($veg != false) {?> checked="checked" <?php } ?>  /><span>Vegetarian </span>
						</div>
						<div class="check ">
							<input type="checkbox" name="eat[]" value="1" <?php if($non != false) {?> checked="checked" <?php } ?> /> <span>Non vegetarian  </span>
						</div>
						<div class="check ">
							<input type="checkbox" name="eat[]" value="2"  <?php if($egg != false) {?> checked="checked" <?php } ?> /> <span>Eggetarian</span>
						</div>
						<div class="check ">
							<input type="checkbox" name="eat[]" value="3" <?php if($all != false) {?> checked="checked" <?php } ?>   /> <span>Doesn't matter</span>
						</div>
					</div>
				</li>
				<li>
					<div class="title">
						Drinking Habits
					</div>
					<?php
							$any = false;
							$light = false;
							$non = false;
							$reg = false;
						if(isset($partner->drinkingHabits))
						{
							$drink = explode(",", $partner->drinkingHabits);
							$non = in_array(0,$drink);
							$reg = in_array(1,$drink);
							$light = in_array(2,$drink);
							$any = in_array(3,$drink);
						}
						?>
					<div class="info">
						<div class="check ">
							<input type="checkbox" name="drink[]"  <?php if($any != false) {?> checked="checked" <?php } ?> value="3" /><span>Doesn't matter  </span>
						</div>
						<div class="check ">
							<input type="checkbox" name="drink[]" <?php if($non != false) {?> checked="checked" <?php } ?> value="0" /><span>Non-drinker</span>
						</div>
						<div class="check ">
							<input type="checkbox" name="drink[]" <?php if($reg != false) {?> checked="checked" <?php } ?> value="1" /> <span>Light/Social drinker</span>
						</div>
						<div class="check ">
							<input type="checkbox" name="drink[]" <?php if($light != false) {?> checked="checked" <?php } ?> value="2" /> <span>Regular drinker</span>
						</div>
					</div>
				</li>
				<li>
					<div class="title">
						Smoking Habits
					</div>
					<?php
							$any = false;
							$light = false;
							$non = false;
							$reg = false;
						if(isset($partner->smokingHabits))
						{
							$smoke = explode(",", $partner->smokingHabits);
							$non = in_array(0,$smoke);
							$reg = in_array(1,$smoke);
							$light = in_array(2,$smoke);
							$any = in_array(3,$smoke);
						}
						?>
					<div class="info">
						<div class="check ">
							  <input type="checkbox" name="smoke[]"  <?php if($any != false) {?> checked="checked" <?php } ?>  value="3" /> <span>Doesn't matter  </span>
						</div>
						<div class="check ">
							  <input type="checkbox" name="smoke[]" <?php if($non != false) {?> checked="checked" <?php } ?>  value="0" /><span>Non-smoker</span>
						</div>
						<div class="check ">
							  <input type="checkbox" name="smoke[]" <?php if($reg != false) {?> checked="checked" <?php } ?>  value="1" /> <span>Light/Social smoker</span>
						</div>
						<div class="check ">
							  <input type="checkbox" name="smoke[]" value="2" <?php if($light != false) {?> checked="checked" <?php } ?>  /> <span>Regular smoker </span>
						</div>
					</div>
				</li>
				<li>
					<div class="title">
						Mother Tongue
					</div>
					<div class="info" id="letters">
					
					<?php 
							if(isset($partner->languages))
							$records = Languages::model()->findAll(array('condition'=> "languageId NOT IN({$partner->languages})"));
							else
							$records = Languages::model()->findAll("active = 1");
							
							$list = CHtml::listData($records, 'languageId', 'name');
						    echo CHtml::dropDownList('language',null,$list,array('class'=>'left ar','multiple'=>'multiple')); ?>
						
						<div class="ar-btn">
							<input class="add type2" value="Add" onclick="return add('language','language1')" type="button">
							<input class="remove type2" value="Remove" onclick="return add('language1','language')" type="button">
						</div>
						<?php 
							if(isset($partner->languages))
							$records = Languages::model()->findAll(array('condition'=> "languageId IN({$partner->languages})"));
							else
							$records = array();
							$list = CHtml::listData($records, 'languageId', 'name');
						    echo CHtml::dropDownList('language1[]',null,$list,array('class'=>'right ar','id'=>'language1','multiple'=>'multiple')); ?>
					</div>
				</li>
				<li>
					<div class="title">
						Country Living In <span class="sup">*</span>
					</div>
					<div class="info" id="letters">
					 <?php 
					 		if(isset($partner->countries))
							$records = Country::model()->findAll(array('condition'=> "countryId NOT IN({$partner->countries})"));
							else
							$records = Country::model()->findAll("active=1");
					 
							$list = CHtml::listData($records, 'countryId', 'name');
						    echo CHtml::dropDownList('country',null,$list,array('class'=>'left ar','multiple'=>'multiple')); ?>
						
						<div class="ar-btn">
							<input class="add type2" value="Add" onclick="return add('country','country1')" type="button">
							<input class="remove type2" value="Remove" onclick="return add('country1','country')" type="button">
						</div>
						<?php 
							if(isset($partner->countries))
							$records = Country::model()->findAll(array('condition'=> "countryId IN({$partner->countries})"));
							else
							$records = array();
							$list = CHtml::listData($records, 'countryId', 'name');
							
						    echo CHtml::dropDownList('country1[]',null,$list,array('class'=>'right ar','id'=>'country1','multiple'=>'multiple')); 
						    
						    ?>
					</div>
				</li>
				<li>
					<div class="title">
						Citizenship <span class="sup">*</span>
					</div>
					<div class="info" id="letters">
					<?php
							if(isset($partner->citizenship))
							$records = Country::model()->findAll(array('condition'=> "countryId NOT IN({$partner->citizenship})"));
							else
							$records = Country::model()->findAll("active=1");
							
							$list = CHtml::listData($records, 'countryId', 'name');
						    echo CHtml::dropDownList('citizen',null,$list,array('class'=>'left ar','multiple'=>'multiple')); ?>
						
						<div class="ar-btn">
							<input class="add type2" value="Add" onclick="return add('citizen','citizen1')" type="button">
							<input class="remove type2" value="Remove" onclick="return add('citizen1','citizen')" type="button">
						</div>
							<?php
							if(isset($partner->citizenship))
							$records = Country::model()->findAll(array('condition'=> "countryId IN({$partner->citizenship})"));
							else
							$records = array();
							
							$list = CHtml::listData($records, 'countryId', 'name');
						    echo CHtml::dropDownList('citizen1[]',null,$list,array('class'=>'right ar','id'=>'citizen1','multiple'=>'multiple')); ?>
						
					</div>
				</li>
				<li>
					<div class="title">
						Residing State In India <span class="sup">*</span>
					</div>
					<div class="info" id="letters">
					<?php 
					 	
					 	if(isset($partner->states))
					 	$records = States::model()->findAll(array('condition'=> "stateId NOT IN({$partner->states})"));
							else
							$records = States::model()->findAll("active = 1");
					
							$list = CHtml::listData($records, 'stateId', 'name');
						    echo CHtml::dropDownList('state',null,$list,array('class'=>'left ar','multiple'=>'multiple')); ?>
						
						<div class="ar-btn">
							<input class="add type2" value="Add" onclick="return add('state','state1')" type="button">
							<input class="remove type2" value="Remove" onclick="return add('state1','state')" type="button">
						</div>
							<?php 
					 	
					 	if(isset($partner->states))
					 	$records = States::model()->findAll(array('condition'=> "stateId IN({$partner->states})"));
							else
							$records = array();
					
							$list = CHtml::listData($records, 'stateId', 'name');
						    echo CHtml::dropDownList('state1[]',null,$list,array('class'=>'right ar','id'=>'state1','multiple'=>'multiple')); ?>
						
					</div>
				</li>
				<li>
					<div class="title">
						District
					</div>
					<div class="info" id="letters">
					 <?php 
					 if(isset($partner->districts))
					 $records = Districts::model()->findAll(array('condition'=> "districtId NOT IN({$partner->districts})"));
					 else
					 $records = Districts::model()->findAll("active = 1");
					 
							$list = CHtml::listData($records, 'districtId', 'name');
						    echo CHtml::dropDownList('district',null,$list,array('class'=>'left ar','multiple'=>'multiple')); ?>
						
						<div class="ar-btn">
							<input class="add type2" value="Add" onclick="return add('district','district1')" type="button">
							<input class="remove type2" value="Remove" onclick="return add('district1','district')" type="button">
						</div>
						<?php 
					 if(isset($partner->districts))
					 $records = Districts::model()->findAll(array('condition'=> "districtId IN({$partner->districts})"));
					 else
					 $records = array();
					 
							$list = CHtml::listData($records, 'districtId', 'name');
						    echo CHtml::dropDownList('district1[]',null,$list,array('class'=>'right ar','id'=>'district1','multiple'=>'multiple')); ?>
					
					</div>
				</li>
				<!-- 
				<li>
					<div class="title">
						Panchayath/Municipality/ <br />Corperation
					</div>
					<div class="info" id="letters">
					
					<?php 
					
					if(isset($partner->places))
					$records = Places::model()->findAll(array('condition'=> "placeId NOT IN({$partner->places})"));
					else 					
					$records = Places::model()->findAll("active = 1");
					
							$list = CHtml::listData($records, 'placeId', 'name');
						    echo CHtml::dropDownList('place',null,$list,array('class'=>'left ar','multiple'=>'multiple')); ?>
						
						<div class="ar-btn">
							<input class="add type2" value="Add" onclick="return add('place','place1')" type="button">
							<input class="remove type2" value="Remove" onclick="return add('place','place1')" type="button">
						</div>
						<?php 
					
					if(isset($partner->places))
					$records = Places::model()->findAll(array('condition'=> "placeId IN({$partner->places})"));
					else 					
					$records = array();
					
							$list = CHtml::listData($records, 'placeId', 'name');
						    echo CHtml::dropDownList('place1[]',null,$list,array('class'=>'right ar','id'=>'place1','multiple'=>'multiple')); ?>
					</div>
				</li>
				 -->
				<li>
					<div class="title">
						Occupation
					</div>
					<div class="info" id="letters">
					<?php 
					if(isset($partner->occupation))
					$records = OccupationMaster::model()->findAll(array('condition'=> "occupationId NOT IN({$partner->occupation})"));
					else
					$records = OccupationMaster::model()->findAll("active = 1");
					
							$list = CHtml::listData($records, 'occupationId', 'name');
						    echo CHtml::dropDownList('occupation',null,$list,array('class'=>'left ar','multiple'=>'multiple')); ?>
						
						<div class="ar-btn">
							<input class="add type2" value="Add" onclick="return add('occupation','occupation1')" type="button">
							<input class="remove type2" value="Remove" onclick="return add('occupation1','occupation')" type="button">
						</div>
						<?php 
					if(isset($partner->occupation))
					$records = OccupationMaster::model()->findAll(array('condition'=> "occupationId IN({$partner->occupation})"));
					else
					$records = array();
					
							$list = CHtml::listData($records, 'occupationId', 'name');
						    echo CHtml::dropDownList('occupation1[]',null,$list,array('class'=>'right ar','id'=>'occupation1','multiple'=>'multiple')); ?>
					</div>
				</li>
				<li>
					<div class="title">
						Annual Income
					</div>
					<?php 
					if(isset($partner->annualIncome))
					$ann = $partner->annualIncome;
					else
					$ann = null;
					?>
					<div class="info">
						<?php echo CHtml::dropDownList('income',null,Utilities::getAnnualIncome(),array('empty' => 'Income','class'=>'wid150','options' => array($ann =>array('selected'=>true)))); ?>
					</div>
				</li>
				<li>
					<div class="title">
						Partner Description
					</div>
					<div class="info">
						<textarea class="validate[maxSize[250]]" name="partnerDesc"  placeholder="Describe your expectations and what you're looking for in a partner.">
						<?php if(isset($partner->partnerDescription)) echo trim($partner->partnerDescription);?>
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