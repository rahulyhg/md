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
 * @title personaledit.php
 * @description <Description of this class>
 *  @filesource <URL>
 *  @version <Revision>
 */
?>
<?php

$user = Yii::app()->session->get('user');
$user = Users::model()->with('horoscopes','userpersonaldetails','familyprofiles','physicaldetails','educations','hobies')->findbyPk($user->userId);
$heightArray = Utilities::getHeights()
?>

<div class="subContent">
	<section class="subHead">
	<h1 class="width100">Edit personal details</h1>
	</section>
	
	<article class="section width100">
	<form id="userContact" name="userContact" method="post" action="/contact/personalupdate">
	<ul>
		<li>
			<div class="title">Country Living In</div>
			<div class="info">
			<?php $records = Country::model()->findAll("active = 1");
		$list = CHtml::listData($records, 'countryId', 'name');
		echo CHtml::dropDownList('country',$user->userpersonaldetails->countryId,$list,array('empty' => 'Country','class'=>'validate[required] wid150','ajax' => array(
                        'type'=>'POST',
                        'url'=>CController::createUrl('Ajax/updateState'), 
                        'dataType'=>'json',
                        'data'=>array('countryId'=>'js:this.value'),  
                        'success'=>'function(data) {
                            $("#state").html(data.dropDownStates);
                        }',
            )
		
		)); ?>
			</div>
		</li>
		<li>
			<div class="title">Residing State</div>
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
			<div class="title">Residing District</div>
			<div class="info">
			<?php
			$records = Districts::model()->findAll("active = 1");
			$list = CHtml::listData($records, 'districtId', 'name');
			echo CHtml::dropDownList('district',$user->userpersonaldetails->districtId,$list,array('empty' => 'District','class'=>'validate[required] wid150','ajax' => array(
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
			<div class="title">Residing Corporation / Panchayath</div>
			<div class="info">
			<?php
			$records = Places::model()->findAll("active = 1");
			$list = CHtml::listData($records, 'placeId', 'name');
			echo CHtml::dropDownList('place',$user->userpersonaldetails->placeId,$list,array('prompt' => 'Places','class'=>'wid150')); ?>
			</div>
		</li>
		<li>
		<?php if(isset($user->physicaldetails->heightId))
				$height = $user->physicaldetails->heightId;
				else 
				$height = null;
		
		?>
			<div class="title">Height in Cm</div>
			<div class="info">
			<?php echo CHtml::dropDownList('height',$height,Utilities::getHeights(),array('empty' => 'Height','class'=>'validate[required] wid200')); ?>
			</div>
		</li>
		<li>
		<?php if(isset($user->physicaldetails->weight))
			$weight = $user->physicaldetails->weight;
			else 
			$weight = null;
		
		?>
			<div class="title">Weight in Kg</div>
			<div class="info">
			<?php echo CHtml::dropDownList('weight',$weight,Utilities::getWeight(),array('empty' => 'Weight in Kg','class'=>'validate[required] wid200')); ?>
			</div>
		</li>
		<li>
			<div class="title">Body Type</div>
			<?php
			if(isset($user->physicaldetails->bodyType)) 
			$body = $user->physicaldetails->bodyType;
			else
			$body = null;
			?>
			<div class="info">
				<div class="radio mR14">
					<input type="radio" name="bodyType" <?php if($body == '0') {?> checked="checked" <?php } ?>
						class="validate[required] radio" value="0"> <span>Average</span>
				</div>
				<div class="radio mR14">
					<input type="radio" name="bodyType" <?php if($body == '1') {?> checked="checked" <?php } ?>
						class="validate[required] radio" value="1"> <span>Athletic </span>
				</div>
				<div class="radio mR14">
					<input type="radio" name="bodyType" <?php if($body == '2') {?> checked="checked" <?php } ?>
						class="validate[required] radio" value="2"> <span>Slim</span>
				</div>
				<div class="radio mR14">
					<input type="radio" name="bodyType" <?php if($body == '3') {?> checked="checked" <?php } ?>
						class="validate[required] radio" value="3"><span>Heavy</span>
				</div>

			</div>
		</li>
		<li>
			<div class="title">Complexion</div>
			<div class="info">
			<?php 
			if(isset($user->physicaldetails->complexion))
			$comp = $user->physicaldetails->complexion ;
			else
			$comp = null;
			
			?>
				<div class="radio mR14">
					<input type="radio" name="complexion" class="validate[required]" <?php if($comp == '0') {?> checked="checked" <?php } ?>
						value="0"><span>Very Fair</span>
				</div>
				<div class="radio mR14">
					<input type="radio" name="complexion" class="validate[required]" <?php if($comp == '1') {?> checked="checked" <?php } ?>
						value="1"> <span>Fair </span>
				</div>
				<div class="radio mR14">
					<input type="radio" name="complexion" class="validate[required]" <?php if($comp == '2') {?> checked="checked" <?php } ?>
						value="2"> <span>Wheatish </span>
				</div>
				<div class="radio mR14">
					<input type="radio" name="complexion" class="validate[required]" <?php if($comp == '3') {?> checked="checked" <?php } ?>
						value="3"> <span>Wheatish brown</span>
				</div>
				<div class="radio mR14">
					<input type="radio" name="complexion" class="validate[required]" <?php if($comp == '4') {?> checked="checked" <?php } ?>
						value="4"> <span>Dark</span>
				</div>
			</div>
		</li>
		<li>
			<div class="title">Physical Status</div>
			<div class="info">
			<?php 
			if(isset($user->physicaldetails->physicalStatus))
			$phy = $user->physicaldetails->physicalStatus;
			else 
			$phy = null;
			
			?>
				<div class="radio mR14">
					<input type="radio" name="physical" class="validate[required]" <?php if($phy == '0') {?> checked="checked" <?php } ?>
						value="0"><span>Normal</span>
				</div>
				<div class="radio mR14">
					<input type="radio" name="physical" class="validate[required]" <?php if($phy == '1') {?> checked="checked" <?php } ?>
						value="1">
				</div>
			</div>
		</li>
		<li>
			<div class="title">Education</div>
			<div class="info">
			<?php
			if(isset($user->educations->education))
			$edu = $user->educations->education;
			else
			$edu = null;
			$records = EducationMaster::model()->findAll("active = 1");
			$list = CHtml::listData($records, 'educationId', 'name');
			echo CHtml::dropDownList('education',$edu ,$list,array('empty' => 'Education','class'=>'validate[required] wid200')); ?>

			</div>
		</li>
		<li>
			<div class="title">Occupation</div>
			<div class="info">
			<?php
			if(isset($user->educations->occupation))
			$occup = $user->educations->occupation;
			else
			$occup = null;
			$records = OccupationMaster::model()->findAll("active = 1");
			$list = CHtml::listData($records, 'occupationId', 'name');
			echo CHtml::dropDownList('occupation',$occup ,$list,array('empty' => 'Occupation','class'=>'validate[required] wid200')); ?>

			</div>
		</li>
		<li>
			<div class="title">Employed In</div>
			<div class="info">
				<?php 
				
				if(isset($user->educations->employedIn))
				$empy = $user->educations->employedIn;
				else 
				$empy = null;				
				?>
				<div class="radio mR14">
					<input type="radio" name="employed" class="validate[required]" <?php if($empy== '0') {?> checked="checked" <?php } ?> 
						value="0" /><span>Government </span>
				</div>
				<div class="radio mR14">
					<input type="radio" name="employed" class="validate[required]" <?php if($empy== '1') {?> checked="checked" <?php } ?>
						value="1" /> <span>Private </span>
				</div>
				<div class="radio mR14">
					<input type="radio" name="employed" class="validate[required]" <?php if($empy== '2') {?> checked="checked" <?php } ?>
						value="2" /> <span>Business</span>
				</div>
				<div class="radio mR14">
					<input type="radio" name="employed" class="validate[required]" <?php if($empy== '3') {?> checked="checked" <?php } ?>
						value="3" /> <span>Defence</span>
				</div>
				<div class="radio mR14">
					<input type="radio" name="employed" class="validate[required]" <?php if($empy== '4') {?> checked="checked" <?php } ?>
						value="4" /><span>Self Employed</span>
				</div>
				<div class="radio mR14">
					<input type="radio" name="employed" class="validate[required]" <?php if($empy== '5') {?> checked="checked" <?php } ?>
						value="5" /><span>NRI</span>
				</div>
			</div>
		</li>
		<li>
			<div class="title">Income</div>
			<div class="info">
			<?php if(isset($user->educations->yearlyIncome))
				$income = $user->educations->yearlyIncome;
				else 
				$income = null;
			
			?>
			<?php echo CHtml::dropDownList('income',$income ,Utilities::getAnnualIncome(),array('empty' => 'Income','class'=>'wid200')); ?>
			</div>
		</li>
		<li>
			<div class="title">Food</div>
			<div class="info">
				<?php 
				if(isset($user->habits->food))
				$food = $user->habits->food;
				else 
				$food = null;
				?>
				<div class="radio mR14">
					<input type="radio" name="food" value="0" <?php if($food  == '0') {?> checked="checked" <?php } ?> /> <span>Vegetarian </span>
				</div>
				<div class="radio mR14">
					<input type="radio" name="food" value="1" <?php if($food  == '1') {?> checked="checked" <?php } ?> /> <span>Non-Vegetarian </span>
				</div>
				<div class="radio mR14">
					<input type="radio" name="food" value="2" <?php if($food  == '2') {?> checked="checked" <?php } ?> /> <span>Eggetarian</span>
				</div>
			</div>
		</li>
		<li>
			<div class="title">Smoking</div>
			<div class="info">
				<?php 
				if(isset($user->habits->smoking))
				$smoke = $user->habits->smoking ;
				else
				$smoke = null;
				
				?>
				<div class="radio mR14">
					<input type="radio" name="smoke" value="0" <?php if($smoke == '0') {?> checked="checked" <?php } ?> /> <span>No </span>
				</div>
				<div class="radio mR14">
					<input type="radio" name="smoke" value="1" <?php if($smoke == '1') {?> checked="checked" <?php } ?> /> <span>Occasionally </span>
				</div>
				<div class="radio mR14">
					<input type="radio" name="smoke" value="2" <?php if($smoke == '2') {?> checked="checked" <?php } ?> /><span>Yes</span>
				</div>
			</div>
		</li>
		<li>
			<div class="title">Drinking</div>
			<div class="info">
			<?php 
			if(isset($user->habits->drinking))
			$drink = $user->habits->drinking;
			else 
			$drink = null;
			
			?>
				<div class="radio mR14">
					<input type="radio" name="drink" value="0" <?php if($drink == '0') {?> checked="checked" <?php } ?> /> <span>No </span>
				</div>
				<div class="radio mR14">
					<input type="radio" name="drink" value="1" <?php if($drink == '1') {?> checked="checked" <?php } ?> /> <span>Occasionally </span>
				</div>
				<div class="radio mR14">
					<input type="radio" name="drink" value="2" <?php if($drink == '2') {?> checked="checked" <?php } ?>  /> <span>Yes</span>
				</div>
			</div>
		</li>
		<li>
			<div class="title">Family Status</div>
			<div class="info">
			<?php 
			if(isset($user->familyprofiles->familyStatus))
			$familySt = $user->familyprofiles->familyStatus;
			else 
			$familySt = null;
			?>
				<div class="radio mR14">
				<input type="radio" name="status" value="0" <?php if($familySt == '0') {?> checked="checked" <?php } ?>   /> <span>Lower middle class
				</span>
			</div>
			<div class="radio mR14">
				<input type="radio" name="status" value="1" <?php if($familySt == '1') {?> checked="checked" <?php } ?>/> <span>Middle class </span>
			</div>
			<div class="radio mR14">
				<input type="radio" name="status" value="2" <?php if($familySt == '2') {?> checked="checked" <?php } ?>/> <span> Upper middle
					class</span>
			</div>
			<div class="radio mR14">
				<input type="radio" name="status" value="3" <?php if($familySt == '3') {?> checked="checked" <?php } ?> /><span>Rich</span>
			</div>
			<div class="radio mR14">
				<input type="radio" name="status" value="4" <?php if($familySt == '4') {?> checked="checked" <?php } ?> /> <span>Affluent </span>
			</div>
			</div>
		</li>
		<li>
			<div class="title">Family Type</div>
			<div class="info">
			<?php 
			if(isset($user->familyprofiles->familyType))
			$familyType = $user->familyprofiles->familyType;
			else
			$familyType = null;
			?>
				<div class="radio mR14">
				<input type="radio" name="type" value="0" <?php if($familyType == '0') {?> checked="checked" <?php } ?> /><span>Joint </span>
			</div>
			<div class="radio mR14">
				<input type="radio" name="type" value="1" <?php if($familyType == '1') {?> checked="checked" <?php } ?> /><span>Nuclear </span>
			</div>
			</div>
		</li>
		<li>
			<div class="title">Family Values</div>
			<div class="info">
			<?php 
			if(isset($user->familyprofiles->familyValues))
			$familVal = $user->familyprofiles->familyValues;
			else 
			$familVal = null;
			?>
				<div class="radio mR14">
				<input type="radio" name="familyValues" value="0" <?php if($familVal == '0') {?> checked="checked" <?php } ?> /> <span>Orthodox </span>
			</div>
			<div class="radio mR14">
				<input type="radio" name="familyValues" value="1" <?php if($familVal == '1') {?> checked="checked" <?php } ?>  />  <span>Traditional </span>
			</div>
			<div class="radio mR14">
				<input type="radio" name="familyValues" value="2" <?php if($familVal == '2') {?> checked="checked" <?php } ?>  />  <span>Moderate </span>
			</div>
			<div class="radio mR14">
				<input type="radio" name="familyValues" value="3" <?php if($familVal == '3') {?> checked="checked" <?php } ?>  />  <span>Liberal </span>
			</div>
			</div>
		</li>
		<li>
			<div class="title">Brothers</div>
			<?php 
			if(isset($user->familyprofiles->brothers))
			$bro = $user->familyprofiles->brothers;
			else
			$bro = null;
			
			if(isset($user->familyprofiles->brotherMarried))
			$broM = $user->familyprofiles->brotherMarried;
			else 
			$broM = null;
			
			?>
			<div class="info">
				<?php echo CHtml::dropDownList('brothers',$bro,Utilities::getBrotherCount(),array('class'=>'wid50')); ?>
				<div class="married">
					<span class="text">Married</span> <?php echo CHtml::dropDownList('brothersMarry',$broM,Utilities::getBrotherCount(),array('class'=>'wid50')); ?>
				</div>
			</div>
		</li>
		<li>
		<?php 
		if(isset($user->familyprofiles->sisters))
		$sis = $user->familyprofiles->sisters;
		else 
		$sis =null;
		
		if(isset($user->familyprofiles->SisterMarried))
		$sisM = $user->familyprofiles->SisterMarried;
		else
		$sisM = null;
		?>
			<div class="title">Sisters</div>
			<div class="info">
				<?php echo CHtml::dropDownList('sisters',$sis ,Utilities::getBrotherCount(),array('class'=>'wid50')); ?>
				<div class="married">
					<span class="text">Married</span>
					<?php echo CHtml::dropDownList('sistersMarry',$sisM,Utilities::getBrotherCount(),array('class'=>'wid50')); ?>
				</div>
			</div>
		</li>

	</ul>
	<ul>
		<li>
			<h3>Hobbies</h3>
		</li>
		<?php 
		$hobbies = array();
		$interest = array();
		$music = array();
		$reading = array();
		$movies = array();
		$activities = array();
		$cuisine = array();
		$language = array();
		
		
		if(isset($user->hobies))
		{
			if(isset($user->hobies->hobies))
			$hobbies = explode(",", $user->hobies->hobies);
			
			
			if(isset($user->hobies->interests))
			$interest = explode(",", $user->hobies->interests);
			
			if(isset($user->hobies->musics))
			$music = explode(",", $user->hobies->musics);
			
			if(isset($user->hobies->reading))
			$reading = explode(",", $user->hobies->reading);
			
			if(isset($user->hobies->movies))
			$movies = explode(",", $user->hobies->movies);
			
			if(isset($user->hobies->activities))
			$activities = explode(",", $user->hobies->activities);
			
			if(isset($user->hobies->cuisine))
			$cuisine = explode(",", $user->hobies->cuisine);
			
			if(isset($user->hobies->languages))
			$language = explode(",", $user->hobies->languages);
			
			
			
		}
		
		
		
		?>
		<li class="">
			<div class="info width100">
				<div class="check checked">
							<input type="checkbox" name="hobby[]" <?php if(in_array('1', $hobbies)) { ?> checked="checked"<?php }?>  value="1" /><span>Acting</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="hobby[]" <?php if(in_array('2', $hobbies)) { ?> checked="checked"<?php }?> value="2" /><span>Astronomy </span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="hobby[]" value="3" <?php if(in_array('3', $hobbies)) { ?> checked="checked"<?php }?> /><span>Astrology</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="hobby[]" value="4" <?php if(in_array('4', $hobbies)) { ?> checked="checked"<?php }?>/><span>Art / handicraft </span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="hobby[]" value="5" <?php if(in_array('5', $hobbies)) { ?> checked="checked"<?php }?>/> <span>Collectibles</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="hobby[]" value="6" <?php if(in_array('6', $hobbies)) { ?> checked="checked"<?php }?>/> <span>Cooking</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="hobby[]" value="7" <?php if(in_array('7', $hobbies)) { ?> checked="checked"<?php }?>/><span>Crosswords </span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="hobby[]" value="8" <?php if(in_array('8', $hobbies)) { ?> checked="checked"<?php }?> /> <span>Dancing</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="hobby[]" value="9" <?php if(in_array('9', $hobbies)) { ?> checked="checked"<?php }?>/> <span>Film-making</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="hobby[]" value="10" <?php if(in_array('10', $hobbies)) { ?> checked="checked"<?php }?>/><span>Fishing</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="hobby[]" value="11" <?php if(in_array('11', $hobbies)) { ?> checked="checked"<?php }?>/><span>Gardening/ landscaping</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="hobby[]" value="12" <?php if(in_array('12', $hobbies)) { ?> checked="checked"<?php }?>/> <span>Graphology </span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="hobby[]" value="13" <?php if(in_array('13', $hobbies)) { ?> checked="checked"<?php }?>/> <span>Nature</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="hobby[]" value="14" <?php if(in_array('14', $hobbies)) { ?> checked="checked"<?php }?> /> <span>Numerology</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="hobby[]" value="15" <?php if(in_array('15', $hobbies)) { ?> checked="checked"<?php }?>/> <span>Painting</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="hobby[]" value="16" <?php if(in_array('16', $hobbies)) { ?> checked="checked"<?php }?> /> <span>Palmistry</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="hobby[]" value="17" <?php if(in_array('17', $hobbies)) { ?> checked="checked"<?php }?> /><span>Pets </span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="hobby[]" value="18" <?php if(in_array('18', $hobbies)) { ?> checked="checked"<?php }?> /> <span>Photography</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="hobby[]" value="19" <?php if(in_array('19', $hobbies)) { ?> checked="checked"<?php }?>/> <span>Playing musical <br />instruments</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="hobby[]" value="20" <?php if(in_array('20', $hobbies)) { ?> checked="checked"<?php }?>/><span>Puzzles</span>
						</div>
			</div>
		</li>
	</ul>
	<ul>
		<li>
			<h3>Interests</h3>
		</li>
		<li class="">
			<div class="info width100">
				<div class="check checked">
							<input type="checkbox" name="interest[]" value="1" <?php if(in_array('1', $interest)) { ?> checked="checked"<?php }?>/><span>Adventure sports</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="interest[]" value="2" <?php if(in_array('2', $interest)) { ?> checked="checked"<?php }?>/> <span>Book clubs </span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="interest[]" value="3" <?php if(in_array('3', $interest)) { ?> checked="checked"<?php }?>/> <span>Computer games</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="interest[]" value="4" <?php if(in_array('4', $interest)) { ?> checked="checked"<?php }?>/> <span>Health & fitness </span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="interest[]" value="5" <?php if(in_array('5', $interest)) { ?> checked="checked"<?php }?>/> <span>Internet</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="interest[]" value="6" <?php if(in_array('6', $interest)) { ?> checked="checked"<?php }?> /> <span>Learning new languages</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="interest[]" value="7" <?php if(in_array('7', $interest)) { ?> checked="checked"<?php }?>/><span>Movies </span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="interest[]" value="8" <?php if(in_array('8', $interest)) { ?> checked="checked"<?php }?>/><span>Music</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="interest[]" value="9" <?php if(in_array('9', $interest)) { ?> checked="checked"<?php }?>/><span>Politics</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="interest[]" value="10" <?php if(in_array('10', $interest)) { ?> checked="checked"<?php }?>/> <span>Reading</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="interest[]" value="11" <?php if(in_array('11', $interest)) { ?> checked="checked"<?php }?>/><span>Social service</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="interest[]" value="12" <?php if(in_array('12', $interest)) { ?> checked="checked"<?php }?>/><span>Sports </span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="interest[]" value="13" <?php if(in_array('13', $interest)) { ?> checked="checked"<?php }?>/><span>Television</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="interest[]" value="14" <?php if(in_array('14', $interest)) { ?> checked="checked"<?php }?>/> <span>Theatre</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="interest[]" value="15" <?php if(in_array('15', $interest)) { ?> checked="checked"<?php }?>/> <span>Travel</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="interest[]" value="16" <?php if(in_array('16', $interest)) { ?> checked="checked"<?php }?> /> <span>Writing</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="interest[]" value="17" <?php if(in_array('17', $interest)) { ?> checked="checked"<?php }?>/> <span>Yoga </span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="interest[]" value="18" <?php if(in_array('18', $interest)) { ?> checked="checked"<?php }?>/> <span>Alternative healing <BR />medicine</span>
						</div>
			</div>
		</li>
	</ul>
	<ul>
		<li>
			<h3>Favourite music</h3>
		</li>
		<li class="">
			<div class="info width100">
				<div class="check checked">
							<input type="checkbox" name="music[]" <?php if(in_array('1', $music)) { ?> checked="checked"<?php }?> value="1" /><span>Blues</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="music[]" <?php if(in_array('2', $music)) { ?> checked="checked"<?php }?> value="2" /> <span>Devotional</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="music[]" <?php if(in_array('3', $music)) { ?> checked="checked"<?php }?> value="3" /><span>Disco</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="music[]" <?php if(in_array('4', $music)) { ?> checked="checked"<?php }?> value="4" /> <span>Film songs</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="music[]" <?php if(in_array('5', $music)) { ?> checked="checked"<?php }?> value="5" /> <span>Ghazals</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="music[]" <?php if(in_array('6', $music)) { ?> checked="checked"<?php }?> value="6" /> <span>Hip-Hop</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="music[]" <?php if(in_array('7', $music)) { ?> checked="checked"<?php }?> value="7" /> <span>Heavy metal </span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="music[]" <?php if(in_array('8', $music)) { ?> checked="checked"<?php }?> value="8" /><span>House music</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="music[]" <?php if(in_array('9', $music)) { ?> checked="checked"<?php }?> value="9" /> <span>Indian classical</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="music[]" <?php if(in_array('10', $music)) { ?> checked="checked"<?php }?> value="10" /> <span>Indipop</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="music[]" <?php if(in_array('11', $music)) { ?> checked="checked"<?php }?> value="11" /> <span>Jazz</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="music[]" <?php if(in_array('12', $music)) { ?> checked="checked"<?php }?> value="12" /> <span>Pop </span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="music[]" <?php if(in_array('13', $music)) { ?> checked="checked"<?php }?> value="13" /> <span>Qawalis</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="music[]" <?php if(in_array('14', $music)) { ?> checked="checked"<?php }?> value="14" /> <span>Rap</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="music[]" <?php if(in_array('15', $music)) { ?> checked="checked"<?php }?> value="15" /> <span>Reggae</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="music[]" <?php if(in_array('16', $music)) { ?> checked="checked"<?php }?> value="16" /><span>Sufi</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="music[]" <?php if(in_array('17', $music)) { ?> checked="checked"<?php }?> value="17" /> <span>Techno </span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="music[]" <?php if(in_array('18', $music)) { ?> checked="checked"<?php }?> value="18" /> <span>Western classical</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="music[]" <?php if(in_array('19', $music)) { ?> checked="checked"<?php }?> value="19" /> <span>I'm not a music fan</span>
						</div>
			</div>
		</li>
	</ul>
	<ul>
		<li>
			<h3>Favourite reads</h3>
		</li>
		<li class="">
			<div class="info width100">
				<div class="check checked">
							<input type="checkbox" name="read[]" value="1" <?php if(in_array('1', $reading)) { ?> checked="checked"<?php }?> /> <span>Actually a bookworm</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="read[]" value="2" <?php if(in_array('2', $reading)) { ?> checked="checked"<?php }?>  /> <span>Biographies</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="read[]" value="3" <?php if(in_array('3', $reading)) { ?> checked="checked"<?php }?> /><span>Business/Occupational</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="read[]" value="4" <?php if(in_array('4', $reading)) { ?> checked="checked"<?php }?> /> <span>Classics</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="read[]" value="5" <?php if(in_array('5', $reading)) { ?> checked="checked"<?php }?> /> <span>Comics</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="read[]" value="6" <?php if(in_array('6', $reading)) { ?> checked="checked"<?php }?> /><span>Fantasy</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="read[]" value="7" <?php if(in_array('7', $reading)) { ?> checked="checked"<?php }?> /> <span>History</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="read[]" value="8" <?php if(in_array('8', $reading)) { ?> checked="checked"<?php }?> /><span>Humor</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="read[]" value="9" <?php if(in_array('9', $reading)) { ?> checked="checked"<?php }?> /> <span>Literature</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="read[]" value="10" <?php if(in_array('10', $reading)) { ?> checked="checked"<?php }?> /><span>Magazines/newspapers</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="read[]" value="11" <?php if(in_array('11', $reading)) { ?> checked="checked"<?php }?> /> <span>Philosophy/spiritual</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="read[]" value="12" <?php if(in_array('12', $reading)) { ?> checked="checked"<?php }?> /> <span>Poetry </span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="read[]" value="13" <?php if(in_array('13', $reading)) { ?> checked="checked"<?php }?> /> <span>Romance</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="read[]" value="14" <?php if(in_array('14', $reading)) { ?> checked="checked"<?php }?> /> <span>Science fiction</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="read[]" value="15" <?php if(in_array('15', $reading)) { ?> checked="checked"<?php }?> /> <span>Self-help</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="read[]" value="16" <?php if(in_array('16', $reading)) { ?> checked="checked"<?php }?> /> <span>Short stories</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="read[]" value="17" <?php if(in_array('17', $reading)) { ?> checked="checked"<?php }?> /> <span>Stay away from books </span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="read[]" value="18" <?php if(in_array('18', $reading)) { ?> checked="checked"<?php }?> /> <span>Thriller/Suspense</span>
						</div>
			</div>
		</li>
	</ul>
	<ul>
		<li>
			<h3>Preferred movies</h3>
		</li>
		<li class="">
			<div class="info width100">
				<div class="check checked">
							<input type="checkbox" name="movies[]" value="1" <?php if(in_array('1', $movies)) { ?> checked="checked"<?php }?>  /> <span>Action/suspense</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="movies[]" value="2" <?php if(in_array('2', $movies)) { ?> checked="checked"<?php }?> /> <span>Comedy</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="movies[]" value="3" <?php if(in_array('3', $movies)) { ?> checked="checked"<?php }?> /> <span>Classics</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="movies[]" value="4" <?php if(in_array('4', $movies)) { ?> checked="checked"<?php }?> /><span>Drama</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="movies[]" value="5" <?php if(in_array('5', $movies)) { ?> checked="checked"<?php }?> /><span>Documentaries</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="movies[]" value="6" <?php if(in_array('6', $movies)) { ?> checked="checked"<?php }?> /> <span>Epics</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="movies[]" value="7" <?php if(in_array('7', $movies)) { ?> checked="checked"<?php }?>  /> <span>Horror</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="movies[]" value="8" <?php if(in_array('8', $movies)) { ?> checked="checked"<?php }?> /><span>Romantic</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="movies[]" value="9" <?php if(in_array('9', $movies)) { ?> checked="checked"<?php }?> /> <span>Short films</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="movies[]" value="10" <?php if(in_array('10', $movies)) { ?> checked="checked"<?php }?> /> <span>Sci-Fi & fantasy</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="movies[]" value="11" <?php if(in_array('11', $movies)) { ?> checked="checked"<?php }?> /> <span>Not into movies</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="movies[]" value="12" <?php if(in_array('12', $movies)) { ?> checked="checked"<?php }?> /> <span>Poetry </span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="movies[]" value="13" <?php if(in_array('13', $movies)) { ?> checked="checked"<?php }?> /> <span>Romance</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="movies[]" value="14" <?php if(in_array('14', $movies)) { ?> checked="checked"<?php }?> /><span>Science fiction</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="movies[]" value="15" <?php if(in_array('15', $movies)) { ?> checked="checked"<?php }?> /> <span>Self-help</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="movies[]" value="16" <?php if(in_array('16', $movies)) { ?> checked="checked"<?php }?> /> <span>Non-commercial/Art</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="movies[]" value="17" <?php if(in_array('17', $movies)) { ?> checked="checked"<?php }?> /> <span>World cinema</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="movies[]" value="18" <?php if(in_array('18', $movies)) { ?> checked="checked"<?php }?> /> <span>Movie fanatic</span>
						</div>
			</div>
		</li>
	</ul>
	<ul>
		<li>
			<h3>Sports/Fitness activities</h3>
		</li>
		<li class="">
			<div class="info width100">
				<div class="check checked">
							<input type="checkbox" name="sports[]" <?php if(in_array('1', $activities)) { ?> checked="checked"<?php }?>  value="1" /> <span>Adventure Sports</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="sports[]" value="2" <?php if(in_array('2', $activities)) { ?> checked="checked"<?php }?>/> <span>Aerobics</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="sports[]" value="3" <?php if(in_array('3', $activities)) { ?> checked="checked"<?php }?>/> <span>Basketball</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="sports[]" value="4" <?php if(in_array('4', $activities)) { ?> checked="checked"<?php }?>/> <span>Badminton</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="sports[]" value="5" <?php if(in_array('5', $activities)) { ?> checked="checked"<?php }?>/> <span>Bowling</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="sports[]" value="6" <?php if(in_array('6', $activities)) { ?> checked="checked"<?php }?>/> <span>Billiards/snooker/pool</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="sports[]" value="7" <?php if(in_array('7', $activities)) { ?> checked="checked"<?php }?>/> <span>Cricket </span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="sports[]" value="8" <?php if(in_array('8', $activities)) { ?> checked="checked"<?php }?>/> <span>Cycling</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="sports[]" value="9" <?php if(in_array('9', $activities)) { ?> checked="checked"<?php }?>/> <span>Card games</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="sports[]" value="10" <?php if(in_array('10', $activities)) { ?> checked="checked"<?php }?>/> <span>Carrom</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="sports[]" value="11" <?php if(in_array('11', $activities)) { ?> checked="checked"<?php }?>/> <span>Chess</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="sports[]" value="12" <?php if(in_array('12', $activities)) { ?> checked="checked"<?php }?>/> <span>Football </span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="sports[]" value="13" <?php if(in_array('13', $activities)) { ?> checked="checked"<?php }?>/> <span>Golf</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="sports[]" value="14" <?php if(in_array('14', $activities)) { ?> checked="checked"<?php }?>/> <span>Hockey</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="sports[]" value="15" <?php if(in_array('15', $activities)) { ?> checked="checked"<?php }?>/> <span>Jogging/walking</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="sports[]" value="16" <?php if(in_array('16', $activities)) { ?> checked="checked"<?php }?>/> <span>Martial arts</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="sports[]" value="17" <?php if(in_array('17', $activities)) { ?> checked="checked"<?php }?>/>  <span>Scrabble</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="sports[]" value="18" <?php if(in_array('18', $activities)) { ?> checked="checked"<?php }?>/>  <span>Squash</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="sports[]" value="19" <?php if(in_array('19', $activities)) { ?> checked="checked"<?php }?>/>  <span>Swimming/water sports</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="sports[]" value="20" <?php if(in_array('20', $activities)) { ?> checked="checked"<?php }?>/>  <span>Table-tennis</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="sports[]" value="21" <?php if(in_array('21', $activities)) { ?> checked="checked"<?php }?>/>  <span>Tennis</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="sports[]" value="22" <?php if(in_array('22', $activities)) { ?> checked="checked"<?php }?> />  <span>Volleyball</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="sports[]" value="23" <?php if(in_array('23', $activities)) { ?> checked="checked"<?php }?>/> <span>Weight lifting</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="sports[]" value="24" <?php if(in_array('24', $activities)) { ?> checked="checked"<?php }?>/>  <span>Yoga/meditation</span>
						</div>
			</div>
		</li>
	</ul>
	<ul>
		<li>
			<h3>Favourite cuisine</h3>
		</li>
		<li class="">
			<div class="info width100">
				<div class="check checked">
							<input type="checkbox" name="cuisine[]" value="1" <?php if(in_array('1', $cuisine)) { ?> checked="checked"<?php }?> /> <span>Arabic</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="cuisine[]" value="2" <?php if(in_array('2', $cuisine)) { ?> checked="checked"<?php }?>/> <span>Bengali</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="cuisine[]" value="3" <?php if(in_array('3', $cuisine)) { ?> checked="checked"<?php }?>/> <span>Chinese</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="cuisine[]" value="4" <?php if(in_array('4', $cuisine)) { ?> checked="checked"<?php }?>/> <span>Continental</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="cuisine[]" value="5" <?php if(in_array('5', $cuisine)) { ?> checked="checked"<?php }?>/> <span>Gujarati</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="cuisine[]" value="6" <?php if(in_array('6', $cuisine)) { ?> checked="checked"<?php }?>/> <span>Italian</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="cuisine[]" value="7" <?php if(in_array('7', $cuisine)) { ?> checked="checked"<?php }?>/> <span>Konkan</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="cuisine[]" value="8" <?php if(in_array('8', $cuisine)) { ?> checked="checked"<?php }?>/> <span>Mexican</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="cuisine[]" value="9" <?php if(in_array('9', $cuisine)) { ?> checked="checked"<?php }?>/><span>Moghlai</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="cuisine[]" value="10" <?php if(in_array('10', $cuisine)) { ?> checked="checked"<?php }?>/><span>Not a foodie!</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="cuisine[]" value="11" <?php if(in_array('11', $cuisine)) { ?> checked="checked"<?php }?>/> <span>Punjabi</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="cuisine[]" value="12" <?php if(in_array('12', $cuisine)) { ?> checked="checked"<?php }?>/> <span>Rajasthani </span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="cuisine[]" value="13" <?php if(in_array('13', $cuisine)) { ?> checked="checked"<?php }?>/> <span>South Indian</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="cuisine[]" value="14" <?php if(in_array('14', $cuisine)) { ?> checked="checked"<?php }?>/> <span>Sushi</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="cuisine[]" value="15" <?php if(in_array('15', $cuisine)) { ?> checked="checked"<?php }?>/> <span>Thai</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="cuisine[]" value="16" <?php if(in_array('16', $cuisine)) { ?> checked="checked"<?php }?>/> <span>I'm a foodie</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="cuisine[]" value="17" <?php if(in_array('17', $cuisine)) { ?> checked="checked"<?php }?>/><span>Traditional</span>
						</div>
			</div>
		</li>
	</ul>
	<ul>
		<li>
			<h3>Spoken languages</h3>
		</li>
		<li class="">
			<div class="info width100">
				<div class="check checked">
							<input type="checkbox" name="language[]" value="1" <?php if(in_array('1', $language)) { ?> checked="checked"<?php }?> /><span>Assamese</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="language[]" value="2" <?php if(in_array('2', $language)) { ?> checked="checked"<?php }?> /> <span>Bengali </span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="language[]" value="3" <?php if(in_array('3', $language)) { ?> checked="checked"<?php }?> /> <span>English</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="language[]" value="4" <?php if(in_array('4', $language)) { ?> checked="checked"<?php }?> /> <span>Gujarati</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="language[]" value="5" <?php if(in_array('5', $language)) { ?> checked="checked"<?php }?> /> <span>Hindi</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="language[]" value="6" <?php if(in_array('6', $language)) { ?> checked="checked"<?php }?> /> <span>Malayalam</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="language[]" value="7" <?php if(in_array('7', $language)) { ?> checked="checked"<?php }?> /><span>Marathi </span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="language[]" value="8" <?php if(in_array('8', $language)) { ?> checked="checked"<?php }?> /> <span>Marwadi</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="language[]" value="9" <?php if(in_array('9', $language)) { ?> checked="checked"<?php }?> /><span>Oriya</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="language[]" value="10" <?php if(in_array('10', $language)) { ?> checked="checked"<?php }?> /> <span>Punjabi</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="language[]" value="11" <?php if(in_array('11', $language)) { ?> checked="checked"<?php }?> /> <span>Sindhi</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="language[]" value="12" <?php if(in_array('12', $language)) { ?> checked="checked"<?php }?> /> <span>Tamil </span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="language[]" value="13" <?php if(in_array('13', $language)) { ?> checked="checked"<?php }?> /> <span>Telugu</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="language[]" value="14" <?php if(in_array('14', $language)) { ?> checked="checked"<?php }?> /> <span>Tulu</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="language[]" value="15" <?php if(in_array('15', $language)) { ?> checked="checked"<?php }?> /> <span>Urdu</span>
						</div>
						<div class="check checked">
							<input type="checkbox" name="language[]" value="16" <?php if(in_array('16', $language)) { ?> checked="checked"<?php }?> /><span>Others</span>
						</div>

			</div>
		</li>
		<li>
			<div class="title">About my Family</div>
			<div class="info">
				<textarea 	name="familyDesc" rows="2" cols="20" 
				placeholder="Please give details about your family, background etc. Limit it to 100 words to get maximum results. Do not write your contact details here. If you do so, your ID will be rejected by our automated system.">
				<?php if(isset($user->familyprofiles->familyDesc))echo $user->familyprofiles->familyDesc ?>
				</textarea>
			</div>
		</li>
		<li>
			<div class="title">About Me</div>
			<div class="info">
				<textarea rows="2" cols="20" name="myDesc" class="validate[required]" 
				placeholder="Enter your personal details, qualification, profession, interests etc. Do not write your contact details here. If you do so, your ID will be rejected by our automated system.">
				<?php if(isset($user->familyprofiles->userDesc))echo $user->familyprofiles->userDesc ?>
				
				</textarea>
			</div>
		</li>
	</ul>
	<ul>
		<li>
			<div class="buttonContnr2">
				<input type="button" name="cancelPhoto" id="cancelPhoto" value="Cancel" class="type2b mL5" onclick="javascript:closeOverlay();" />
				<input type="submit" name="updatePhoto" id="updatePhoto" value="Update" class="type2b mL5" />
			</div>
		</li>
	</ul>
	</form>
	</article>
	
	<script type="text/javascript">
$(document).ready(function(){

	$("#userContact").validationEngine('attach');
    <?php if(isset($update) && $update == true) { ?>
    window.parent.location.reload();
    <?php }?>
    });  

  </script>