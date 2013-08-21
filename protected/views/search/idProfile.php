<?php
/*
*
* $Id$
--------------------------------------------------------------------------------------------------------------------------
* Information contained in this file is the intellectual property of Marrydoor
* Copyright © 2012 MarryDorr. All Rights Reserved.
* ---------------------------------------------------------------------------------------------------------------------------
*
* @author  Ageesh K Gopinath
* @title idProfile.php
* @description <Description of this class>
*  @filesource <URL>
*  @version <Revision>
*/
?>
<?php 
$bookMarked = array();
$blocked = array();
$user = Yii::app()->session->get('user');
  	if(isset($user)) {
 if(isset($user->bookmark))
 {
 	if(strlen($user->bookmark->profileIDs) > 2)
 	$bookMarked = explode(",",$user->bookmark->profileIDs);
 	else
 	$bookMarked[] =  $user->bookmark->profileIDs;
 }
  	if(isset($user->profileBlock))
 {
 	if(strlen($user->profileBlock->profileIDs) > 2)
 	$blocked = explode(",",$user->profileBlock->profileIDs);
 	else
 	$blocked[] =  $user->profileBlock->profileIDs;
 }
 
	 $isInterest = $user->interestSender(array('condition'=>"receiverId = {$model->userId}"));
	 $isMessage = $user->messageSender(array('condition'=>"receiverId = {$model->userId}"));
 
  	}
 ?>


    <section class="data-contnr mT8">
        <div class="mainPro">
			<div class="photoC">
				<?php $this->widget('application.widgets.Profilepicture',array('userId'=>$model->userId,'marryId'=>$model->marryId)); ?>
			</div>
			<?php $heightArray = Utilities::getHeights()?>
			<ul class="myPd">
				<li>
					<div class="leftCt">Name</div>
					<div class="rightCt">
						<strong>:</strong> <span><?php echo $model->name?>(<?php echo $model->marryId ?>)</span>
					</div>
				</li>
				<li>
					<div class="leftCt">Religion / Cast </div>
					<div class="rightCt">
						<strong>:</strong> <span><?php if(isset($model->userpersonaldetails->religion))echo $model->userpersonaldetails->religion->name ?>/ <?php if(isset($model->userpersonaldetails->caste))echo $model->userpersonaldetails->caste->name ?></span>
					</div>
				</li>
				<li>
					<div class="leftCt">Age</div>
					<div class="rightCt">
						<strong>:</strong> <span><?php echo Utilities::getAgeFromDateofBirth($model->dob)?> Years </span>
					</div>
				</li>
				<li>
					<div class="leftCt">Height</div>
					<div class="rightCt">
						<strong>:</strong> <span><?php if(isset($model->physicaldetails->heightId))echo $heightArray[$model->physicaldetails->heightId]; ?></span>
					</div>
				</li>
				<li>
					<div class="leftCt">District</div>
					<div class="rightCt">
						<strong>:</strong> <span><?php if(isset($model->userpersonaldetails->district))echo $model->userpersonaldetails->district->name ?></span>
					</div>
				</li>
				<li>
					<div class="leftCt">Education</div>
					<div class="rightCt">
						<strong>:</strong> <span><?php if(isset($model->educations->education))echo $model->educations->education->name ?></span>
					</div>
				</li>
				<li>
					<div class="leftCt">Occupation</div>
					<div class="rightCt">
						<strong>:</strong> <span><?php if(isset($model->educations->occupation))echo $model->educations->occupation->name ?></span>
					</div>
				</li>
				
			</ul>
			
			<ul class="myPd">
				<li>
					<div class="leftCt">Account details </div>
					<div class="rightCt">
						<strong>:</strong> <span><?php echo Utilities::getCurrentUserStatus($model)?></span>
					</div>
				</li>
				<li>
					<div class="leftCt">Last Visited</div>
					<div class="rightCt">
						<strong>:</strong> <span><?php echo Utilities::getUserActivityStatus($model);?></span>
					</div>
				</li>
			</ul>
			<?php 
			if(isset($user)) {
			?>
			<ul class="myPd">
				<li>
					<?php 
						/*$settings = Utilities::getUserPrivacySettings($model->userId);
						$contactSetting = Utilities::getUserPrivacyStatus($settings,'contact');
						$docSetting = Utilities::getUserPrivacyStatus($settings,'documents');
						$astroSetting = Utilities::getUserPrivacyStatus($settings,'astro');
						$albumSetting = Utilities::getUserPrivacyStatus($settings,'album');
						$familySetting = Utilities::getUserPrivacyStatus($settings,'family');
						$referenceSetting = Utilities::getUserPrivacyStatus($settings,'reference');*/
					?>
					<div class="butCo mL0">
							<?php 
							if($user->userType == 1){  ?>
									<a href="/contact/details/id/<?php echo $model->marryId ?>" id="requestWindow" >Contact</a>
							<?php }else{?>
								<a id="requestWindow" href="<?php echo Utilities::createAbsoluteUrl('site','popup',array('action'=>'subscribe','module'=>'contact','profileId'=>$model->userId)); ?>">Contact</a>
							<?php }?>
					</div>
					<div class="butCo">
						<?php 
						if($user->userType == 1){  ?>
							<a href="<?php echo Utilities::createAbsoluteUrl('album','document',array('mId'=>$model->marryId,'wType'=>'popup')); ?>" id="requestWindow" >Document </a>
						<?php }else{?>
							<a id="requestWindow" href="<?php echo Utilities::createAbsoluteUrl('site','popup',array('action'=>'subscribe','module'=>'document','profileId'=>$model->userId)); ?>">Document</a>
						<?php }
						?>
					</div>
					<div class="butCo">
						<?php 
						if($user->userType == 1){  ?>
							<a href="/contact/referencedetails/id/<?php echo $model->marryId ?>" id="requestWindow" >Reference </a>
						<?php }else{?>
							<a id="requestWindow" href="<?php echo Utilities::createAbsoluteUrl('site','popup',array('action'=>'subscribe','module'=>'reference','profileId'=>$model->userId)); ?>">Reference</a>
						<?php }
						?>
					</div>
					<div class="butCo">
						<a id="requestWindow" href="<?php echo Utilities::createAbsoluteUrl('album','family',array('mId'=>$model->marryId,'wType'=>'popup')); ?>">Family album</a>
					</div>
					<div class="butCo">
						<a id="requestWindow" href="<?php echo Utilities::createAbsoluteUrl('album','view',array('mId'=>$model->marryId,'wType'=>'popup')); ?>">Personal album</a>
					</div>
					<div class="butCo">
								<a href="/contact/astrodetails/id/<?php echo $model->marryId ?>" id="astroDetails" >Astro Details</a>
					</div>
				</li>
			</ul>
			<?php }else{?>
				<ul class="myPd">
				<li>
					<div class="butCo mL0">
						<a id="requestWindow" href="<?php echo Utilities::createAbsoluteUrl('site','popup',array('action'=>'login','module'=>'contact','profileId'=>$model->userId)); ?>">Contact</a>
					</div>
					<div class="butCo">
						<a id="requestWindow" href="<?php echo Utilities::createAbsoluteUrl('site','popup',array('action'=>'login','module'=>'document','profileId'=>$model->userId)); ?>">Document</a>
					</div>
					<div class="butCo">
						<a id="requestWindow" href="<?php echo Utilities::createAbsoluteUrl('site','popup',array('action'=>'login','module'=>'reference','profileId'=>$model->userId)); ?>">Reference</a>
					</div>
					<div class="butCo">
						<a id="requestWindow" href="<?php echo Utilities::createAbsoluteUrl('site','popup',array('action'=>'login','module'=>'album','profileId'=>$model->userId)); ?>">Family album</a>
					</div>
					<div class="butCo">
						<a id="requestWindow" href="<?php echo Utilities::createAbsoluteUrl('site','popup',array('action'=>'login','module'=>'album','profileId'=>$model->userId)); ?>">Personal album</a>
					</div>
					<div class="butCo">
						<a id="requestWindow" href="<?php echo Utilities::createAbsoluteUrl('site','popup',array('action'=>'login','module'=>'astro','profileId'=>$model->userId)); ?>">Astro Details</a>	
					</div>
				</li>
			</ul>
			<?php }?>
		</div>
		<?php  
		if(isset($user)){
			
 
		?>	
		<div class="optBtnC">
			<?php if(!isset($isInterest) || empty($isInterest)) {?>
			<span id="expressInterest" class="expressInterest"><a href="#" id="<?php echo $model->userId ?>"  class="global">Express Interest</a></span>
			<?php }?>
			<?php 
			// if(!isset($isMessage) || empty($isMessage)) {
				 if($user->userType == 1){  ?>
					<a id="<?php echo $model->userId ?>"  href="<?php echo Utilities::createAbsoluteUrl('message','compose',array('receiverId'=>$model->userId)); ?>" class="composeMessage">Send Message</a>
					<?php }else{?>
					<a id="requestWindow" href="<?php echo Utilities::createAbsoluteUrl('site','popup',array('action'=>'subscribe','module'=>'message','profileId'=>$model->userId)); ?>">Send Message</a>
				<?php 
				}
			//}
			?>
			<?php if(!in_array($model->userId, $bookMarked)) {?>
	                    <span id="bookmark"><a href="#" id="<?php echo $model->userId ?>"  class="global">Bookmark</a></span>
                    <?php }?>
            <?php if(!in_array($model->userId, $blocked)) {?>
	                    <span id="blocked"><a href="#" id="<?php echo $model->userId ?>"  class="global">Block this user</a></span>
                    <?php }?>        
			
		</div>
		<?php }?>
		<div class="editContr pT10">
			<div class="hText">Personal Information</div>
			<div class="subText">In my own words</div>
			<p ><?php if(isset($model->familyprofiles->userDesc))echo $model->familyprofiles->userDesc  ?></p>
		</div>
		<div class="editContr pT10">
			
			<div class="hText">Basic Details</div>
			<ul class="detSec width50">
				<li>
					<div class="leftCtn">Name</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php echo $model->name ?></span>
					</div>
				</li>
				<li>
					<div class="leftCtn">Age</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($model->dob))echo Utilities::getAgeFromDateofBirth($model->dob)?> Years</span>
					</div>
				</li>
				<li>
					<div class="leftCtn">Height</div>
					<div class="rightCtn">
						<strong>:</strong> <span> <?php if(isset($model->physicaldetails->heightId))echo $heightArray[$model->physicaldetails->heightId]; ?></span>
					</div>
				</li>
				<li>
				<?php 
				$model->motherTounge
				
				?>
					<div class="leftCtn">Language</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($model->motherTounge)) echo Utilities::getLanguageForId($model->motherTounge)?></span>
					</div>
				</li>
				<li>
					<div class="leftCtn">Marital Status</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php $marry = Utilities::getMaritalStatus(); if(isset($model->userpersonaldetails->maritalStatus))echo $marry[$model->userpersonaldetails->maritalStatus]?></span>
					</div>
				</li>
			</ul>
			<?php $bodyType = Utilities::getBodyType(); $bodyColor = Utilities::getBodyColor();$physicalStatus = Utilities::physicalStatus()?>
			<ul class="detSec width50">
				<li>
					<div class="leftCtn">Body Type / Complexion</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($model->physicaldetails->bodyType))echo $bodyType[$model->physicaldetails->bodyType].'/'?><?php if(isset($model->physicaldetails->complexion))echo $bodyColor[$model->physicaldetails->complexion]?></span>
					</div>
				</li>
				<li>
					<div class="leftCtn">Physical Status</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($model->physicaldetails->physicalStatus))echo $physicalStatus[$model->physicaldetails->physicalStatus]?></span>
					</div>
				</li>
				<li>
					<div class="leftCtn">Weight</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($model->physicaldetails->weight))echo $model->physicaldetails->weight?></span>
					</div>
				</li>
			</ul>
		</div>
		<div class="editContr pT10">
			
			<div class="hText">Religious Information</div>
			<ul class="detSec width50">
				<li>
					<div class="leftCtn">Religion</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($model->userpersonaldetails->religion))echo $model->userpersonaldetails->religion->name ?></span>
					</div>
				</li>
				<li>
					<div class="leftCtn">Caste / Sub Caste</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($model->userpersonaldetails->caste))echo $model->userpersonaldetails->caste->name ?></span>
					</div>
				</li>
			</ul>
		</div>
		<div class="editContr pT10">
		<?php $food = Utilities::getFood();
$smoke = Utilities::getSmoke();
$drink= Utilities::getDrink();

?>	
			<div class="hText">Lifestyle</div>
			<ul class="detSec width50">
				<li>
					<div class="leftCtn">Eating Habits</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($model->habits->food))echo $food[$model->habits->food]?></span>
					</div>
				</li>
				<li>
					<div class="leftCtn">Smoking habits</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($model->habits->smoking))echo $smoke[$model->habits->smoking]?></span>
					</div>
				</li>
				
			</ul>
			<ul class="detSec width50">
				<li>
					<div class="leftCtn">Drinking habits</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($model->habits->drinking))echo $drink[$model->habits->drinking]?></span>
					</div>
				</li>
			</ul>
		</div>
		<div class="editContr pT10">
			
			<div class="hText">Location</div>
			<ul class="detSec width50">
				<li>
					<div class="leftCtn">Country</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($model->userpersonaldetails->country))echo $model->userpersonaldetails->country->name ?> </span>
					</div>
				</li>
				<li>
					<div class="leftCtn">State</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($model->userpersonaldetails->state))echo $model->userpersonaldetails->state->name ?></span>
					</div>
				</li>
				
			</ul>
			<ul class="detSec width50">
				<li>
					<div class="leftCtn">District</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($model->userpersonaldetails->district))echo $model->userpersonaldetails->district->name ?></span>
					</div>
				</li>
				<?php 
				if(isset($model->userpersonaldetails->placeId))
					$place = Places::model()->findbyPk($model->userpersonaldetails->placeId);
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
		<div class="editContr pT10">
			<?php $job = Utilities::getJob()?>
			<div class="hText">Professional Information</div>
			<ul class="detSec width50">
				<li>
					<div class="leftCtn">Education Category</div>
					<div class="rightCtn">
						<strong>:</strong> <span> <?php if(isset($model->educations->education))echo $model->educations->education->name ?></span>
					</div>
				</li>
				<li>
					<div class="leftCtn">Occupation</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($model->educations->occupation))echo $model->educations->occupation->name ?></span>
					</div>
				</li>
				
				<li>
					<div class="leftCtn">Employed in</div>
					<div class="rightCtn">
						<strong>:</strong> <span> <?php if(isset($model->educations->employedIn))echo $job[$model->educations->employedIn]?></span>
					</div>
				</li>
				<li>
					<div class="leftCtn">Annual Income</div>
					<?php $ann = Utilities::getAnnualIncome();?>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($model->educations->yearlyIncome) && $model->educations->yearlyIncome > 0 )echo $ann[$model->educations->yearlyIncome];?></span>
					</div>
				</li>
			</ul>
		</div>
		<div class="editContr pT10">
			<?php $familyValues = Utilities::getFamilyValues();$familyType = Utilities::getFamilyType();$familyStatus = Utilities::getFamilyStatus();?>
			<div class="hText">Family Details</div>
			<ul class="detSec width50">
				<li>
					<div class="leftCtn">Family Values</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($model->familyprofiles->familyValues))echo $familyValues[$model->familyprofiles->familyValues]?> </span>
					</div>
				</li>
				<li>
					<div class="leftCtn">Family Type</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($model->familyprofiles->familyType))echo $familyType[$model->familyprofiles->familyType]?></span>
					</div>
				</li>
				<li>
					<div class="leftCtn">Family Status</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($model->familyprofiles->familyValues))echo $familyStatus[$model->familyprofiles->familyValues]?></span>
					</div>
				</li>
			<!-- 	
				<li class="mT10">
					<div class="leftCtn">Family album</div>
					<div class="rightCtn">
						<strong>:</strong> <span><a href="#">View my family album (5 Photos)</a></span>
					</div>
				</li>
				 -->
			</ul>
			<ul class="detSec width50">
				
				<li>
					<div class="leftCtn">No of Brother(s)</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($model->familyprofiles->brothers))echo $model->familyprofiles->brothers.'/'?> <?php if(isset($model->familyprofiles->brotherMarried))echo $model->familyprofiles->brotherMarried.' Married' ?>  </span>
					</div>
				</li>
				<li>
					<div class="leftCtn">No of Sister(s)</div>
					<div class="rightCtn">
						<strong>:</strong> <span><?php if(isset($model->familyprofiles->sisters))echo $model->familyprofiles->sisters.'/'?> <?php if(isset($model->familyprofiles->SisterMarried))echo $model->familyprofiles->SisterMarried.' Married'?> </span>
					</div>
				</li>
			</ul>
		</div>
		<div class="editContr pT10">
			
			<div class="hText">About my family</div>
			<p ><?php if(isset($model->familyprofiles->familyDesc))echo $model->familyprofiles->familyDesc?>.</p>
		</div>
		<div class="editContr pT10">
			<?php $partner = $model->partnerpreferences; ?>
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
						<strong>:</strong> <span> <?php if(isset($religion ))echo $religion->name?></span>
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
		<div class="editContr pT10">
			
			<div class="hText">About my partner</div>
			<p><?php if(isset($partner->partnerDescription))echo $partner->partnerDescription; ?></p>
		</div>
	<?php  $user = Yii::app()->session->get('user');
		if(isset($user)){
 
		?>	
		<div class="optBtnC">
			
			<?php if(!isset($isInterest) || empty($isInterest)) {?>
			<span id="expressInterest" class="expressInterest"><a href="#" id="<?php echo $model->userId ?>"  class="global">Express Interest</a></span>
			<?php }?>
			<?php 
			 //if(!isset($isMessage) || empty($isMessage)) {
				 if($user->userType == 1){  ?>
					<a id="<?php echo $model->userId ?>"  href="<?php echo Utilities::createAbsoluteUrl('message','compose',array('receiverId'=>$model->userId)); ?>" class="composeMessage">Send Message</a>
					<?php }else{?>
					<a id="requestWindow" href="<?php echo Utilities::createAbsoluteUrl('site','popup',array('action'=>'subscribe','module'=>'message','profileId'=>$model->userId)); ?>">Send Message</a>
				<?php 
				}
			//}
			?>
			<?php if(!in_array($model->userId, $bookMarked)) {?>  
                    <span id="bookmark1"><a href="#" id="<?php echo $model->userId ?>"  class="global">Bookmark</a></span>
                    <?php }?>
			
			<?php if(!in_array($model->userId, $blocked)) {?>
	                    <span id="blocked1"><a href="#" id="<?php echo $model->userId ?>"  class="global">Block this user</a></span>
                    <?php }?>        
			
		</div>
		<?php }?>

    </section>
	<?php $this->widget('application.widgets.menu.Rightmenu'); ?>

            
 <script type="text/javascript">
$(document).ready(function() {

	$("#contactDetailsEdit").colorbox({iframe:true, width:"860", height:"900",overlayClose: false});
	$("#referenceDetails").colorbox({iframe:true, width:"860", height:"900",overlayClose: false});
	$("#astroDetails").colorbox({iframe:true, width:"860", height:"900",overlayClose: false});
	
	//$(".albumWindow").colorbox({iframe:true, width:"860", height:"900",overlayClose: false});
	$('[id^=requestWindow]').colorbox({iframe:true, width:"860", height:"900",overlayClose: false});
	$(".composeMessage").colorbox({iframe:true, width:"860", height:"620",overlayClose: false});
		
});


$("span[id^='bookmark']").click(function (){
	 var userId = $(this).find('a').attr('id');

	 $.ajax({
	        url: "/bookmark/add",  
	        type: "POST",
	        dataType:'json',
	        data:{'userId':userId},   
	        cache: false,
	        success: function (html) {
		        if(html == true)  
		        	$("span[id^='bookmark']").hide();	         
	        }       
	    });

});

$("span[id^='blocked']").click(function (){
	 var userId = $(this).find('a').attr('id');

	 $.ajax({
	        url: "/profile/add",  
	        type: "POST",
	        dataType:'json',
	        data:{'userId':userId},   
	        cache: false,
	        success: function (html) {
		        if(html == true)  
		        	$("span[id^='blocked']").hide();	         
	        }       
	    });

}); 
  
//express interest individually

$('.expressInterest').click(function (e){
	  e.preventDefault();
	 var userId = $(this).find('a').attr('id');
	 $.ajax({
	        url: "/interest/insert",  
	        type: "POST",
	        dataType:'json',
	        data:{'userId':userId},   
	        cache: false,
	        success: function (html) {
		        if(html == true)
		        	$("span[id^='expressInterest']").hide();	         
	        }       
	    });

});
</script> 
 
   