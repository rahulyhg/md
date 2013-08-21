<?php
/*
*
* $Id$
--------------------------------------------------------------------------------------------------------------------------
* Information contained in this file is the intellectual property of Ladbrokes Plc
* Copyright © 2012 MarryDorr. All Rights Reserved.
* ---------------------------------------------------------------------------------------------------------------------------
*
* @author  Dileep Gopalan
* @title profile.php
* @description <Description of this class>
*  @filesource <URL>
*  @version <Revision>
*/
?>
<?php 
$user = Yii::app()->session->get('user');
$user = Users::model()->with('horoscopes','userpersonaldetails','familyprofiles','physicaldetails','educations','hobies')->findbyPk($user->userId);
$heightArray = Utilities::getHeights();
?>
    <section class="data-contnr mT8">
        <div class="mainPro">
			<div class="photoC">
				<!-- load the profile picture -->
				<?php $this->widget('application.widgets.Profilepicture',array('userId'=>$user->userId,'marryId'=>$user->marryId)); ?> 
			</div>
			<ul class="myPd">
				<li>
					<div class="leftCt">Name</div>
					<div class="rightCt">
						<strong>:</strong> <span><?php echo $user->name ?> (<?php echo $user->marryId ?>)</span>
					</div>
				</li>
				<li>
					<div class="leftCt">Religion / Cast </div>
					<div class="rightCt">
						<strong>:</strong> <span><?php if(isset($user->userpersonaldetails->religion))echo $user->userpersonaldetails->religion->name ;?> , <?php if(isset($user->userpersonaldetails->caste))echo $user->userpersonaldetails->caste->name ;?></span>
					</div>
				</li>
				<li>
					<div class="leftCt">Age</div>
					<div class="rightCt">
						<strong>:</strong> <span><?php echo Utilities::getAgeFromDateofBirth($user->dob); ?> Years </span>
					</div>
				</li>
				<li>
					<div class="leftCt">Height</div>
					<div class="rightCt">
						<strong>:</strong> <span><?php if(isset($user->physicaldetails->heightId))echo $heightArray[$user->physicaldetails->heightId]; ?></span>
					</div>
				</li>
				<li>
					<div class="leftCt">District</div>
					<div class="rightCt">
						<strong>:</strong> <span><?php if(isset($user->userpersonaldetails->district))echo $user->userpersonaldetails->district->name ?></span>
					</div>
				</li>
				<li>
					<div class="leftCt">Education</div>
					<div class="rightCt">
						<strong>:</strong> <span><?php if(isset($user->educations->education))echo $user->educations->education->name?></span>
					</div>
				</li>
				<li>
					<div class="leftCt">Occupation</div>
					<div class="rightCt">
						<strong>:</strong> <span><?php if(isset($user->educations->occupation))echo $user->educations->occupation->name ?></span>
					</div>
				</li>
			</ul>
			<ul class="myPd">
				<li>
					<div class="leftCt">Acconut details </div>
					<div class="rightCt">
						<strong>:</strong> <span><?php echo Utilities::getCurrentUserStatus($user)?></span>
					</div>
				</li>
				<li>
					<div class="leftCt">Last Visited</div>
					<div class="rightCt">
						<strong>:</strong> <span><?php echo Utilities::getUserActivityStatus($user);?></span>
					</div>
				</li>
			</ul>
		</div>
		<div class="editOpt">
			<div class="butCo">
				<a href="<?php echo Utilities::createAbsoluteUrl('contact','detailsedit'); ?>" id="contactDetailsEdit">Contact (Edit)</a>
			</div>
			<div class="butCo">
				<a href="<?php echo Utilities::createAbsoluteUrl('mypage','editdocument'); ?>" id="documentUpload">Document (Edit)</a>
			</div>
			<div class="butCo">
				<a href="<?php echo Utilities::createAbsoluteUrl('contact','referenceedit'); ?>" id="referenceEdit">Reference (Edit)</a>
			</div>
			<div class="butCo">
				<a href="<?php echo Utilities::createAbsoluteUrl('mypage','editfamilyphoto'); ?>" id="familyphotoUpload">Family Album (Edit)</a>
			</div>
			<div class="butCo">
				<a href="<?php echo Utilities::createAbsoluteUrl('mypage','editprofilephoto'); ?>" id="photoUpload">Personal Album (Edit)</a>
			</div>
			<div class="butCo">
				<a href="<?php echo Utilities::createAbsoluteUrl('contact','astroedit'); ?>" id="astroEdit">Astro Details (Edit)</a>
			</div>
		</div>
		<div class="editContr">
			<a href="<?php echo Utilities::createAbsoluteUrl('contact','personaledit'); ?>" class="edit" id="personalEdit">Edit</a>
			<div class="hText">Personal Information</div>
			<div class="subText">In my own words</div>
			<p ><?php if(isset($user->familyprofiles)) echo $user->familyprofiles->userDesc; ?></p>
		</div>
		<div class="editContr">
			<a href="<?php echo Utilities::createAbsoluteUrl('contact','personaledit'); ?>" class="edit" id="personalEdit">Edit</a>
			<div class="hText">Basic Details</div>
			<ul class="detSec width50">
				<li>
					<div class="leftCtn">Name</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php echo $user->name; ?></span>
					</div>
				</li>
				<li>
					<div class="leftCtn">Age</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php echo Utilities::getAgeFromDateofBirth($user->dob); ?> Years</span>
					</div>
				</li>
				<li>
					<div class="leftCtn">Height</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($user->physicaldetails->heightId))echo $heightArray[$user->physicaldetails->heightId]; ?> </span>
					</div>
				</li>
				<li>
					<div class="leftCtn">Language</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($user->motherTounge)) echo Utilities::getLanguageForId($user->motherTounge)?></span>
					</div>
				</li>
				<li>
					<div class="leftCtn">Marital Status</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php $marry = Utilities::getMaritalStatus(); if(isset($user->userpersonaldetails->maritalStatus))echo $marry[$user->userpersonaldetails->maritalStatus]?></span>
					</div>
				</li>
			</ul>
			<ul class="detSec width50">
			<?php $bodyType = Utilities::getBodyType(); $bodyColor = Utilities::getBodyColor();$physicalStatus = Utilities::physicalStatus()?>
				
				<li>
					<div class="leftCtn">Body Type / Complexion</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($user->physicaldetails->bodyType))echo $bodyType[$user->physicaldetails->bodyType].'/'?><?php if(isset($user->physicaldetails->complexion))echo $bodyColor[$user->physicaldetails->complexion]?></span>
					</div>
				</li>
				<li>
					<div class="leftCtn">Physical Status</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($user->physicaldetails->physicalStatus))echo $physicalStatus[$user->physicaldetails->physicalStatus]?></span>
					</div>
				</li>
				<li>
					<div class="leftCtn">Weight</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($user->physicaldetails->weight))echo $user->physicaldetails->weight?></span>
					</div>
				</li>
				
				
			</ul>
		</div>
		<div class="editContr">
			<a href="<?php echo Utilities::createAbsoluteUrl('contact','personaledit'); ?>" class="edit" id="personalEdit">Edit</a>
			<div class="hText">Religious Information</div>
			<ul class="detSec width50">
				<li>
					<div class="leftCtn">Religion</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($user->userpersonaldetails->religion))echo $user->userpersonaldetails->religion->name ?></span>
					</div>
				</li>
				<li>
					<div class="leftCtn">Caste / Sub Caste</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($user->userpersonaldetails->caste))echo $user->userpersonaldetails->caste->name ?></span>
					</div>
				</li>
			</ul>
		</div>
		<div class="editContr">
		<?php $food = Utilities::getFood();
$smoke = Utilities::getSmoke();
$drink= Utilities::getDrink();

?>	
			<a href="<?php echo Utilities::createAbsoluteUrl('contact','personaledit'); ?>" class="edit" id="personalEdit">Edit</a>
			<div class="hText">Lifestyle</div>
			<ul class="detSec width50">
				<li>
					<div class="leftCtn">Eating Habits</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($user->habits->food))echo $food[$user->habits->food]?></span>
					</div>
				</li>
				<li>
					<div class="leftCtn">Smoking habits</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($user->habits->smoking))echo $smoke[$user->habits->smoking]?></span>
					</div>
				</li>
				
			</ul>
			<ul class="detSec width50">
				<li>
					<div class="leftCtn">Drinking habits</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($user->habits->drinking))echo $drink[$user->habits->drinking]?></span>
					</div>
				</li>
			</ul>
		</div>
		<div class="editContr">
			<a href="<?php echo Utilities::createAbsoluteUrl('contact','personaledit'); ?>" class="edit" id="personalEdit">Edit</a>
			<div class="hText">Location</div>
			<ul class="detSec width50">
				<li>
					<div class="leftCtn">Country</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($user->userpersonaldetails->country))echo $user->userpersonaldetails->country->name ?> </span>
					</div>
				</li>
				<li>
					<div class="leftCtn">State</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($user->userpersonaldetails->state))echo $user->userpersonaldetails->state->name ?></span>
					</div>
				</li>
			</ul>
			<ul class="detSec width50">
				<li>
					<div class="leftCtn">District</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($user->userpersonaldetails->district))echo $user->userpersonaldetails->district->name ?></span>
					</div>
				</li>
				<?php 
				if(isset($user->userpersonaldetails->placeId))
					$place = Places::model()->findbyPk($user->userpersonaldetails->placeId);
				else
				$place = new Places();	
					
					?>
				<li>
					<div class="leftCtn">Place</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php echo $place->name ?></span>
					</div>
				</li>
				
			</ul>
		</div>
		<div class="editContr">
		<?php $job = Utilities::getJob()?>
			<a href="<?php echo Utilities::createAbsoluteUrl('contact','personaledit'); ?>" class="edit" id="personalEdit">Edit</a>
			<div class="hText">Professional Information</div>
			<ul class="detSec width50">
				<li>
					<div class="leftCtn">Education Category</div>
					<div class="rightCtn">
						<strong>:</strong> <span> <?php if(isset($user->educations->education))echo $user->educations->education->name ?></span>
					</div>
				</li>
				<li>
					<div class="leftCtn">Occupation</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($user->educations->occupation))echo $user->educations->occupation->name ?></span>
					</div>
				</li>
				
				<li>
					<div class="leftCtn">Employed in</div>
					<div class="rightCtn">
						<strong>:</strong> <span> <?php if(isset($user->educations->employedIn))echo $job[$user->educations->employedIn]?></span>
					</div>
				</li>
				<li>
					<div class="leftCtn">Annual Income</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($user->educations->yearlyIncome))echo $user->educations->yearlyIncome.'000'?></span>
					</div>
				</li>
			</ul>
		</div>
		<div class="editContr">
		<?php $familyValues = Utilities::getFamilyValues();$familyType = Utilities::getFamilyType();$familyStatus = Utilities::getFamilyStatus();?>
			<a href="<?php echo Utilities::createAbsoluteUrl('contact','personaledit'); ?>" class="edit" id="personalEdit">Edit</a>
			<div class="hText">Family Details</div>
			<ul class="detSec width50">
				<li>
					<div class="leftCtn">Family Values</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($user->familyprofiles->familyValues))echo $familyValues[$user->familyprofiles->familyValues]?> </span>
					</div>
				</li>
				<li>
					<div class="leftCtn">Family Type</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($user->familyprofiles->familyType))echo $familyType[$user->familyprofiles->familyType]?></span>
					</div>
				</li>
				<li>
					<div class="leftCtn">Family Status</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($user->familyprofiles->familyValues))echo $familyStatus[$user->familyprofiles->familyValues]?></span>
					</div>
				</li>
				<!-- 
				<li class="mT10">
					<div class="leftCtn">Family album</div>
					<div class="rightCtn">
						<strong>:</strong> <span><a href="<?php echo Utilities::createAbsoluteUrl('mypage','familyalbum',array()); ?>">View my family album (<?php echo count($photosList); ?> Photos)</a></span>
					</div>
				</li>
				 -->
			</ul>
			<ul class="detSec width50">
				<li>
					<div class="leftCtn">No of Brother(s)</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($user->familyprofiles->brothers))echo $user->familyprofiles->brothers.'/'?>  <?php if(isset($user->familyprofiles->brotherMarried))echo $user->familyprofiles->brotherMarried.' Married' ?>  </span>
					</div>
				</li>
				<li>
					<div class="leftCtn">No of Sister(s)</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($user->familyprofiles->sisters))echo $user->familyprofiles->sisters.'/'?> <?php if(isset($user->familyprofiles->SisterMarried))echo $user->familyprofiles->SisterMarried.' Married'?> </span>
					</div>
				</li>
			</ul>
		</div>
		<div class="editContr">
			<a href="<?php echo Utilities::createAbsoluteUrl('contact','personaledit'); ?>" class="edit" id="personalEdit">Edit</a>
			<div class="hText">About My Family</div>
			<p ><?php if(isset($user->familyprofiles->familyDesc))echo $user->familyprofiles->familyDesc?>.</p>
		</div>
		<?php $partner = $user->partnerpreferences; ?>
		<div class="editContr">
			<a href="<?php echo Utilities::createAbsoluteUrl('contact','personaledit'); ?>" class="edit" id="personalEdit">Edit</a>
			<div class="hText">My Partner Preference</div>
			<ul class="detSec width100">
				<li>
					<div class="leftCtn">Groom's Age</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($partner->ageFrom))echo $partner->ageFrom.'-'; if(isset($partner->ageTo))echo $partner->ageTo.' Years'; ?></span>
					</div>
				</li>
				<li>
					<div class="leftCtn">Height</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($partner->heightTo))echo $heightArray[$partner->heightTo].'/'; ?>  <?php if(isset($partner->heightFrom))echo $heightArray[$partner->heightFrom]; ?></span>
					</div>
				</li>
				<li>
					<div class="leftCtn">Marital status</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($partner->maritalStatus))echo $marry[$partner->maritalStatus];?></span>
					</div>
				</li>
				<li>
					<div class="leftCtn">Physical Status</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($partner->physicalStatus))echo $physicalStatus[$partner->physicalStatus]?></span>
					</div>
				</li>
				<li class="mT10">
					<div class="leftCtn">Mother Tongue</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($partner->languages))echo Utilities::getValueForIds(new Languages(), $partner->languages, 'languageId')?></span>
					</div>
				</li>
				<?php 
				if(isset($partner->religion))
				$religion = Religion::model()->findbyPk($partner->religion);
				?>
				<li>
					<div class="leftCtn">Religion</div>
					<div class="rightCtn">
						<strong>:</strong> <span> <?php if(isset($religion)) echo $religion->name?></span>
					</div>
				</li>
				<li>
					<div class="leftCtn">Caste</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($partner->caste))echo Utilities::getValueForIds(new Caste(), $partner->caste, 'casteId')?></span>
					</div>
				</li>
				
				<li>
					<div class="leftCtn">Eating Habit</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($partner->eatingHabits))echo Utilities::getArrayValues(Utilities::getFood(), $partner->eatingHabits)?></span>
					</div>
				</li>
				<li class="mT10">
					<div class="leftCtn">Smoking Habits</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($partner->smokingHabits))echo Utilities::getArrayValues(Utilities::getSmoke(), $partner->smokingHabits)?></span>
					</div>
				</li>
				<li>
					<div class="leftCtn">Drinking Habits</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($partner->drinkingHabits))echo Utilities::getArrayValues(Utilities::getDrink(), $partner->drinkingHabits)?></span>
					</div>
				</li>
				<!-- 
				<li>
					<div class="leftCtn">Education</div>
					<div class="rightCtn">
						<strong>:</strong> <span>Bachelors - Engineering / Computers, Medicine - General / Dental / Surgeon /...</span>
					</div>
				</li>
				 -->
				<li>
					<div class="leftCtn">Occupation</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($partner->occupation))echo Utilities::getValueForIds(new OccupationMaster(), $partner->occupation, 'occupationId')?></span>
					</div>
				</li>
				<li>
					<div class="leftCtn">Annual Income</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($partner->annualIncome))echo $partner->annualIncome.'000'; ?></span>
					</div>
				</li>
				<li>
					<div class="leftCtn">Country</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($partner->countries)) echo Utilities::getValueForIds(new Country(), $partner->countries, 'countryId')?></span>
					</div>
				</li>
				<li>
					<div class="leftCtn">Residing State</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($partner->states))echo Utilities::getValueForIds(new States(), $partner->states, 'stateId')?></span>
					</div>
				</li>
				<li>
					<div class="leftCtn">Citizenship</div>
					<div class="rightCtn">
						<strong>:</strong> <span> <?php if(isset($partner->citizenship))echo Utilities::getValueForIds(new Country(), $partner->citizenship, 'countryId')?></span>
					</div>
				</li>
				
			</ul>
		</div>
		<div class="editContr">
			<a href="<?php echo Utilities::createAbsoluteUrl('contact','personaledit'); ?>" class="edit" id="personalEdit">Edit</a>
			<div class="hText">About My Partner</div>
			<p><?php if(isset($partner->partnerDescription))echo $partner->partnerDescription; ?></p>
		</div>
    </section>
    	<script type="text/javascript">
$(document).ready(function(){
    $("#photoUpload").colorbox({iframe:true, width:"860", height:"620",overlayClose: false});
    $("#familyphotoUpload").colorbox({iframe:true, width:"860", height:"640",overlayClose: false});
    $("#documentUpload").colorbox({iframe:true, width:"860", height:"620",overlayClose: false});
    $("#contactDetailsEdit").colorbox({iframe:true, width:"860", height:"900",overlayClose: false});
    $("#referenceEdit").colorbox({iframe:true, width:"860", height:"900",overlayClose: false});
    $("#astroEdit").colorbox({iframe:true, width:"860", height:"900",overlayClose: false});
    $("#editProfilePicture").colorbox({iframe:true, width:"860", height:"620",overlayClose: false});
    $('[id^=personal]').colorbox({iframe:true, width:"860", height:"900",overlayClose: false});
    
  });


</script>
      <?php $this->widget('application.widgets.menu.Rightmenu'); ?>
  