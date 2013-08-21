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
* @title regular.php
* @description <Description of this class>
*  @filesource <URL>
*  @version <Revision>
*/
?>
  
		  <?php $this->widget('application.widgets.menu.Leftmenu'); ?>
  



  <section class="data-contnr3">
        <h1 class="mB10">Quick Search</h1>
        <form id="quickSearch"  name="quickSearch" method="post"  action="/search/quick">
        <ul class="accOverview mT12">
			<li class="mB10">
				<div class="radC">
				<input type="radio" class="validate[required]"  value="M" name="gender" />
					<span>Male</span>
				</div>
				<div class="radC">
					<input type="radio" value="F" name="gender" class="validate[required]"  />
					<span>Female</span>
				</div>
				<div class="selC">
					<span>Age</span>
					<?php echo CHtml::dropDownList('ageFrom',null,Utilities::getAge(),array('prompt'=>'Age','class'=>'validate[gfuncCall[hidePromp]]  wid50')); ?>
				</div>
				<div class="selC">
					<span>to</span>
					<?php echo CHtml::dropDownList('ageTo',null,Utilities::getAge(),array('prompt'=>'Age','class'=>'validate[gfuncCall[checkAgeLimit]] wid50')); ?>
				</div>
				<div class="selC">
					<span>Religion</span>
					<?php $records = Religion::model()->findAll("active = 1");
		$list = CHtml::listData($records, 'religionId', 'name');
		echo CHtml::dropDownList('religion',null,$list,array('empty' => 'Religion','class'=>'width120','id'=>'qReligion','ajax' => array(
                        'type'=>'POST',
                        'url'=>CController::createUrl('Ajax/updateCaste'), 
                        'dataType'=>'json',
                        'data'=>array('religionId'=>'js:this.value'),  
                        'success'=>'function(data) {
                            $("#qCaste").html(data.dropDownCastes);
                        }',
            ))); ?>
					
				</div>
				<div class="selC">
					<span>Cast</span>
					<?php $records = Caste::model()->findAll("active = 1");
		$list = CHtml::listData($records, 'casteId', 'name');
		echo CHtml::dropDownList('caste',null,$list,array('empty' => 'Caste','id'=>'qCaste','class'=>'wid120')); ?>
				</div>
				<input type="submit" value="Search" class="type5 no-marg" />
			</li>
		</ul>
		</form>
		<h1 class="mTB12">Search your life partner</h1>
                <p>An easy way to find out your life partner. By choosing the right options you can easily find out the profiles that matches you. </p>
		<ul class="tab-head">
			<li id="tab1">
				<a id="tab1" href="#" class="select ">Basic Search</a>
			</li>
			<li id="tab2"> 
				<a id="tab2" href="#" class="type3 ">Advanced Search</a>
			</li>
			<li id="tab3">
				<a id="tab3" href="#" class="type3 ">Keyword Search</a>
			</li>
			<li id="tab4">
				<a id="tab4" href="#" class="type3">Search by ID</a>
			</li>
		</ul>
		
		<div id="tab1_data" class="tab-data" style="display: block;">
		
			<article class="section width100 no-padd">
			<form id="regularSearch"  name="regularSearch" method="post"  action="/search/regular">
				<ul>
					<li>
						<div class="title">
							Gender
						</div>
						<div class="info">
							<div class="radio mR14 wid80">
								<input type="radio" value="M" class="validate[required]"  <?php if($searchItem->gender == 'M'){?> checked="checked" <?php }?> name="gender"> <span>Male</span>
							</div>
							<div class="radio">
								<input type="radio" value="F" class="validate[required]"  <?php if($searchItem->gender == 'F'){?> checked="checked" <?php }?> name="gender"><span>Female</span>
							</div>
						</div>
					</li>
					<li>
						<div class="title">
							Age 
						</div>
						<div class="info">
						
						<?php echo CHtml::dropDownList('ageFrom',null,Utilities::getAge(),array('prompt'=>'Age','class'=>'validate[gfuncCall[hidePromp]] wid50','options' => array($searchItem->ageFrom =>array('selected'=>true)))); ?>
							<div class="married">
								<span class="text">to</span>
							<?php echo CHtml::dropDownList('ageTo',null,Utilities::getAge(),array('prompt'=>'Age','class'=>'validate[gfuncCall[checkAgeLimit]] wid50','options' => array($searchItem->ageTo =>array('selected'=>true)))); ?>
								<span class="text">years</span>
							</div>
						</div>
					</li>
					<li>
						<div class="title">
							Height 
						</div>
						<div class="info">
						<?php echo CHtml::dropDownList('heightFrom',null,Utilities::getHeights(),array('prompt'=>'Height','class'=>'validate[gfuncCall[hidePromp]] wid120','options' => array($searchItem->heightFrom =>array('selected'=>true)))); ?>
							
							<div class="married">
								<span class="text">to</span>
								<?php echo CHtml::dropDownList('heightTo',null,Utilities::getHeights(),array('prompt'=>'Height','class'=>'validate[gcondRequired[heightStart],funcCall[checkHeightLimit]] wid120','options' => array($searchItem->heightTo =>array('selected'=>true)))); ?>
							</div>
						</div>
					</li>
					<li>
						<div class="title">
							Marital status 
						</div>
						<?php 
						$unMarry = false;
							$widower = false;
							$divorce = false;
							$adivorce = false;
						if(isset($searchItem->maritalStatus))
						{
							
							$maritalStatus = explode(",", $searchItem->maritalStatus);
							
							$unMarry = in_array(0,$maritalStatus);
							$widower = in_array(1,$maritalStatus);
							$divorce = in_array(2,$maritalStatus);
							$adivorce = in_array(3,$maritalStatus);
						}
						?>
						<div class="info">
							<div class="check">
								
								<input type="checkbox" value="0" <?php if($unMarry != false ) {?> checked="checked" <?php } ?> name="status[]"><span>Unmarried </span>
							</div>
							<div class="check">
							<input type="checkbox" value="1" <?php if($widower != false ) {?> checked="checked" <?php } ?> name="status[]">	
								<span>Widower </span>
							</div>
							<div class="check">
								<input type="checkbox" <?php if($divorce != false ) {?> checked="checked" <?php } ?>  value="2" name="status[]"><span>Divorced </span>
							</div>
							<div class="check">
								<input type="checkbox" value="3" <?php if($adivorce != false ) {?> checked="checked" <?php } ?>   name="status[]"><span>Awaiting divorce </span>
							</div>
						</div>
					</li>
					<li>
						<div class="title">
							Religion
						</div>
						<div class="info">
						<?php $records = Religion::model()->findAll("active = 1");
		$list = CHtml::listData($records, 'religionId', 'name');
		echo CHtml::dropDownList('religion',null,$list,array('empty' => 'Religion','class'=>'width120','id'=>'rReligion','ajax' => array(
                        'type'=>'POST',
                        'url'=>CController::createUrl('Ajax/updateCastes'), 
                        'dataType'=>'json',
                        'data'=>array('religionId'=>'js:this.value'),  
                        'success'=>'function(data) {
                            $("#rcaste").html(data.dropDownCastes);
                        }',
            ))); ?>
						</div>
					</li>
					<li>
						<div class="title">
							Cast
						</div>
						<div class="info">
							<?php 
							if(isset($searchItem->caste))
							$records = Caste::model()->findAll(array('condition'=> "casteId NOT IN({$searchItem->caste})"));
							else
							$records = Caste::model()->findAll("active=1");
							
							$list = CHtml::listData($records, 'casteId', 'name');
						    echo CHtml::dropDownList('rcaste',null,$list,array('class'=>'left ar','multiple'=>'multiple')); ?>
							<div class="ar-btn">
							<input class="add type2" value="Add" onclick="return add('rcaste','rcaste1')" type="button">
							<input class="remove type2" value="Remove" onclick="return add('rcaste1','rcaste')" type="button">
							</div>
							<?php
							if(isset($searchItem->caste)) 
							$recordsf = Caste::model()->findAll(array('condition'=> "casteId IN({$searchItem->caste})"));
							else
							$recordsf = array();
							
							$list = CHtml::listData($recordsf, 'casteId', 'name');
						    echo CHtml::dropDownList('caste1[]',null,$list,array('class'=>'right ar','id'=>'rcaste1','multiple'=>'multiple')); ?>
						</div>
					</li>
					<li>
						<div class="title">
							Mother Tongue
						</div>
						<div class="info">
							<?php 
							
							if(isset($searchItem->motherTounge))
							$records = Languages::model()->findAll(array('condition'=> "languageId NOT IN({$searchItem->motherTounge})"));
							else 
							$records = Languages::model()->findAll("active=1");
							
							$list = CHtml::listData($records, 'languageId', 'name');
						    echo CHtml::dropDownList('rlanguage',null,$list,array('class'=>'left ar','multiple'=>'multiple')); ?>
						
						<div class="ar-btn">
							<input class="add type2" value="Add" onclick="return add('rlanguage','rlanguage1')" type="button">
							<input class="remove type2" value="Remove" onclick="return add('rlanguage1','rlanguage')" type="button">
						</div>
						<?php 
							if(isset($searchItem->motherTounge))
							$frecords = Languages::model()->findAll(array('condition'=> "languageId IN({$searchItem->motherTounge})"));
							else
							$frecords = array();
							$list = CHtml::listData($frecords, 'languageId', 'name');
						    echo CHtml::dropDownList('language1[]',null,$list,array('class'=>'right ar','id'=>'rlanguage1','multiple'=>'multiple')); ?>
							
						</div>
					</li>
					<li>
						<div class="title">
							Country
						</div>
						<div class="info">
							
							<?php 
							if(isset($searchItem->countries))
							$records = Country::model()->findAll(array('condition'=> "countryId NOT IN({$searchItem->countries})"));
							else
							$records = Country::model()->findAll("active=1");
							
							$list = CHtml::listData($records, 'countryId', 'name');
						    echo CHtml::dropDownList('rcountry',null,$list,array('class'=>'left ar','multiple'=>'multiple')); ?>
						
						<div class="ar-btn">
							<input class="add type2" value="Add" onclick="return add('rcountry','rcountry1')" type="button">
							<input class="remove type2" value="Remove" onclick="return add('rcountry1','rcountry')" type="button">
						</div>
							<?php 
							if(isset($searchItem->countries))
							$frecords = Country::model()->findAll(array('condition'=> "countryId IN({$searchItem->countries})"));
							else
							$frecords = array();
							
							$list = CHtml::listData($frecords, 'countryId', 'name');
						    echo CHtml::dropDownList('country1[]',null,$list,array('class'=>'right ar','id'=>'rcountry1','multiple'=>'multiple')); ?>
						</div>
					</li>
					<li>
						<div class="title">
							Education
						</div>
						<div class="info">
							
						    <?php 
						    if(isset($searchItem->education))
						    $records = EducationMaster::model()->findAll(array('condition'=> "educationId NOT IN({$searchItem->education})"));
						    else
						    $records = EducationMaster::model()->findAll("active=1");
						    
							$list = CHtml::listData($records, 'educationId', 'name');
						    echo CHtml::dropDownList('reducation',null,$list,array('class'=>'left ar','multiple'=>'multiple')); ?>
						<div class="ar-btn">
							<input class="add type2" value="Add" onclick="return add('reducation','reducation1')" type="button">
							<input class="remove type2" value="Remove" onclick="return add('reducation1','reducation')"type="button">
						</div>
						<?php 
						if(isset($searchItem->education))
						    $records = EducationMaster::model()->findAll(array('condition'=> "educationId IN({$searchItem->education})"));
						    else
						    $records = array();
						    
							$list = CHtml::listData($records, 'educationId', 'name');
						    echo CHtml::dropDownList('education1[]',null,$list,array('class'=>'right ar','id'=>'reducation1','multiple'=>'multiple')); ?>
						</div>
					</li>
					<li>
						<div class="title">
							Show profile
						</div>
						
						<div class="info">
							<div class="check wid220">
								<input type="checkbox" <?php if($searchItem->photo == 1) {?> checked="checked" <?php } ?>   value="P" name="profile[]"><span>Only With Photo</span>
							</div>
							<div class="check ">
								<input type="checkbox" <?php if($searchItem->horoscope == 1) {?> checked="checked" <?php } ?> value="h" name="profile[]"><span>Only With horoscope</span>
							</div>
						</div>
					</li>
					<!-- 
					<li>
						<div class="title">
							Don't show
						</div>
						<?php
							$ignore = false;
							$contacted = false;
							$view = false;
							$shortlisted = false;
						if(isset($searchItem->showTo))
						{
							$maritalStatus = explode(",", $searchItem->showTo);
							$ignore = in_array(0,$maritalStatus);
							$contacted = in_array(1,$maritalStatus);
							$view = in_array(2,$maritalStatus);
							$maritalStatus = in_array(3,$maritalStatus);
						}
						?>
						<div class="info">
							<div class="check wid220">
								<input type="checkbox" value="0" <?php if($ignore != false) {?> checked="checked" <?php } ?>   name="show[]"><span>Ignored Profiles</span>
							</div>
							<div class="check wid220">
								<input type="checkbox" value="1" <?php if($contacted != false) {?> checked="checked" <?php } ?> name="show[]"><span>Profiles already contacted</span>
							</div>
							<div class="check wid220">
								<input type="checkbox" value="2" <?php if($view != false) {?> checked="checked" <?php } ?> name="show[]"><span>Viewed Profiles</span>
							</div>
							<div class="check ">
								<input type="checkbox" value="3" <?php if($shortlisted != false) {?> checked="checked" <?php } ?>  name="show[]"><span>Shortlisted Profiles</span>
							</div>
						</div>
					</li>
					 -->
					<li>
						<div class="buttonContnr2 mT20">
							<a class="type4" id="rsearchButton">Save Search</a>
							<input type="submit" value="Search" class="type4" />
							<div class="saveSbox" id="rsaveBox" style="display:none">
							<div class="tarrow"></div>
							<div class="cont wid140">
								<div class="head">
									<span>Save Your Search</span>
								</div>
								<div class="row">
									<input type="text" id="rsearchName" <?php if(isset($searchItem->searchName)) {?> value="<?php echo $searchItem->searchName?>" <?php } ?>  name="searchName" placeholder="Mysearch1" />
								</div>
								<div class="row" id="rsearchSubmit" >
									<a class="type5" href="#">Save </a>
								</div>
							</div>
						</div>
						</div>
						
					</li>
				</ul>
			</form>	
			</article>
		</div>
		<div id="tab2_data" class="tab-data" style="display: none;">
			<article class="section width100 no-padd">
			<form id="advanceSearch"  name="advanceSearch" method="post"  action="/search/advance">        
				<ul>
					<li>
						<div class="title">
							Gender
						</div>
						<div class="info">
							<div class="radio mR14 wid80">
								<input type="radio" name="gender" class="validate[required]" <?php if($searchItem->gender == 'M'){?> checked="checked" <?php }?> value="M"><span>Male</span>
							</div>
							<div class="radio">
								<input type="radio" name="gender" class="validate[required]" <?php if($searchItem->gender == 'F'){?> checked="checked" <?php }?>  value="F"><span>Female</span>
							</div>
						</div>
					</li>
					<li>
						<div class="title">
							Age 
						</div>
						<div class="info">
						<?php echo CHtml::dropDownList('ageFrom',null,Utilities::getAge(),array('prompt'=>'Age','class'=>'validate[gfuncCall[hidePromp]] wid50','options' => array($searchItem->ageFrom =>array('selected'=>true)))); ?>
							<div class="married">
								<span class="text">to</span>
							<?php echo CHtml::dropDownList('ageTo',null,Utilities::getAge(),array('prompt'=>'Age','class'=>'validate[gfuncCall[checkAgeLimit]]  wid50','options' => array($searchItem->ageTo =>array('selected'=>true)))); ?>
								<span class="text">years</span>
							</div>
						</div>
					</li>
					<li>
						<div class="title">
							Height 
						</div>
						<div class="info">
						<?php echo CHtml::dropDownList('heightFrom',null,Utilities::getHeights(),array('prompt'=>'Height','id'=>'heightFrom1','class'=>'validate[gfuncCall[hidePromp]] wid120','options' =>array($searchItem->heightFrom =>array('selected'=>true)))); ?>
							
							<div class="married">
								<span class="text">to</span>
							<?php echo CHtml::dropDownList('heightTo',null,Utilities::getHeights(),array('prompt'=>'Height','class'=>'validate[funcCall[checkAHeightLimit]]  wid120','options' =>array($searchItem->heightTo =>array('selected'=>true)))); ?>
							</div>
						</div>
					</li>
					<li>
						<div class="title">
							Physical status 
						</div>
						
						<div class="info">
							<div class="radio wid110">
								<input type="radio" <?php if($searchItem->physicalStatus == 'N'){?> checked="checked" <?php }?> name="pstatus" value="N"><span>Doesn't matter</span>
							</div>
							<div class="radio wid110">
								<input type="radio" name="pstatus" <?php if($searchItem->physicalStatus == '0'){?> checked="checked" <?php }?> value="0"><span>Normal</span>
							</div>
							<div class="radio ">
								<input type="radio" name="pstatus" <?php if($searchItem->physicalStatus == '1'){?> checked="checked" <?php }?> value="1"><span>Physically challenged </span>
							</div>
						</div>
					</li>
					<li>
						<div class="title">
							Marital status 
						</div>
						<?php 
							$unMarry = false;
							$widower = false;
							$divorce = false;
							$adivorce = false;
						if(isset($searchItem->maritalStatus))
						{
							
							$maritalStatus = explode(",", $searchItem->maritalStatus);
							
							$unMarry = in_array(0,$maritalStatus);
							$widower = in_array(1,$maritalStatus);
							$divorce = in_array(2,$maritalStatus);
							$adivorce = in_array(3,$maritalStatus);
						}
						?>
						<div class="info">
							<div class="check">
								
								<input type="checkbox" value="0" <?php if($unMarry != false ) {?> checked="checked" <?php } ?> name="status[]"><span>Unmarried </span>
							</div>
							<div class="check">
							<input type="checkbox" value="1" <?php if($widower != false ) {?> checked="checked" <?php } ?> name="status[]">	
								<span>Widower </span>
							</div>
							<div class="check">
								<input type="checkbox" <?php if($divorce != false ) {?> checked="checked" <?php } ?>  value="2" name="status[]"><span>Divorced </span>
							</div>
							<div class="check">
								<input type="checkbox" value="3" <?php if($adivorce != false ) {?> checked="checked" <?php } ?>   name="status[]"><span>Awaiting divorce </span>
							</div>
						</div>
					</li>
				</ul>
				<ul>
					<li>
						<h3>Location</h3>
					</li>
					<li>
						<div class="title">
							Mother Tongue
						</div>
						<div class="info">
							<?php 
							if(isset($searchItem->motherTounge))
							$records = Languages::model()->findAll(array('condition'=> "languageId NOT IN({$searchItem->motherTounge})"));
							else
							$records = Languages::model()->findAll("active = 1");
							
							$list = CHtml::listData($records, 'languageId', 'name');
						    echo CHtml::dropDownList('alanguage',null,$list,array('class'=>'left ar','multiple'=>'multiple')); ?>
						
						<div class="ar-btn">
							<input class="add type2" value="Add" onclick="return add('alanguage','alanguage1')" type="button">
							<input class="remove type2" value="Remove" onclick="return add('alanguage1','alanguage')" type="button">
						</div>
						<?php 
							if(isset($searchItem->motherTounge))
							$records = Languages::model()->findAll(array('condition'=> "languageId IN({$searchItem->motherTounge})"));
							else
							$records = array();
							$list = CHtml::listData($records, 'languageId', 'name');
						    echo CHtml::dropDownList('language1[]',null,$list,array('class'=>'right ar','id'=>'alanguage1','multiple'=>'multiple')); ?>
						
						</div>
					</li>
					<li>
						<div class="title">
							Country Living In 
						</div>
						<div class="info">
								<?php 
								
							if(isset($searchItem->countries))
							$records = Country::model()->findAll(array('condition'=> "countryId NOT IN({$searchItem->countries})"));
							else
							$records = Country::model()->findAll("active=1");
							$list = CHtml::listData($records, 'countryId', 'name');
						    echo CHtml::dropDownList('acountry',null,$list,array('class'=>'left ar','multiple'=>'multiple')); ?>
						
						<div class="ar-btn">
							<input class="add type2" value="Add" onclick="return add('acountry','acountry1')" type="button">
							<input class="remove type2" value="Remove" onclick="return add('acountry1','acountry')" type="button">
						</div>
						<?php 
							if(isset($searchItem->countries))
							$records = Country::model()->findAll(array('condition'=> "countryId IN({$searchItem->countries})"));
							else
							$records = array();
							$list = CHtml::listData($records, 'countryId', 'name');
						    echo CHtml::dropDownList('country1[]',null,$list,array('class'=>'right ar','id'=>'acountry1','multiple'=>'multiple')); 
						    
						    ?>
						</div>
					</li>
					<li>
						<div class="title">
							Residing state 
						</div>
						<div class="info">
						
						<?php

		$records = States::model()->findAll("active = 1");
		$list = CHtml::listData($records, 'stateId', 'name');
		echo CHtml::dropDownList('state',$searchItem->state,$list,array('empty' => 'State','class'=>'wid150','ajax' => array(
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
							Residing district
						</div>
						<div class="info">
<?php $records = Districts::model()->findAll("active = 1");
		$list = CHtml::listData($records, 'districtId', 'name');
		echo CHtml::dropDownList('district',null,$list,array('empty' => 'District','class'=>'wid150','options' => array($searchItem->state =>array('selected'=>true)))); ?>						</div>
					</li>
					<!-- 
					<li>
						<div class="title">
							Resident status
						</div>
						<div class="info">
							<div class="radio mR14">
								<input type="radio"  name="created"> <span>Any </span>
							</div>
							<div class="radio mR14">
								<input type="radio" name="created"> <span>Citizen </span>
							</div>
							<div class="radio mR14">
								<input type="radio" name="created"> <span>Permanent Resident </span>
							</div>
							<div class="radio mR14">
								<input type="radio" name="created"> <span>Student Visa</span>
							</div>
							<div class="radio mR14">
								<input type="radio" name="created"> <span>Temporary Visa</span>
							</div>
							<div class="radio ">
								<input type="radio" name="created"> <span>Work Permit</span>
							</div>
						</div>
					</li>
					 -->
				</ul>
				<ul>
					<li>
						<h3>Cast and religion</h3>
					</li>
					<li>
						<div class="title">
							Religion
						</div>
						<div class="info">
						<?php $records = Religion::model()->findAll("active = 1");
		$list = CHtml::listData($records, 'religionId', 'name');
		echo CHtml::dropDownList('religion',null,$list,array('empty' => 'Religion','class'=>'width120','id'=>'aReligion','ajax' => array(
                        'type'=>'POST',
                        'url'=>CController::createUrl('Ajax/updateCastes'), 
                        'dataType'=>'json',
                        'data'=>array('religionId'=>'js:this.value'),  
                        'success'=>'function(data) {
                            $("#acaste").html(data.dropDownCastes);
                        }',
            ))); ?>
						</div>
					</li>
					<li>
						<div class="title">
							Cast
						</div>
						<div class="info">
							<?php 
							if(isset($searchItem->caste))
							$records = Caste::model()->findAll(array('condition'=> "casteId NOT IN({$searchItem->caste})"));
							else
							$records = Caste::model()->findAll("active=1");
							
							$list = CHtml::listData($records, 'casteId', 'name');
							echo CHtml::dropDownList('acaste',null,$list,array('class'=>'left ar','multiple'=>'multiple')); ?>
							<div class="ar-btn">
							<input class="add type2" value="Add" onclick="return add('acaste','acaste1')" type="button">
							<input class="remove type2" value="Remove" onclick="return add('acaste1','acaste')" type="button">
							</div>
							<?php 
							if(isset($searchItem->caste)) 
							$recordsf = Caste::model()->findAll(array('condition'=> "casteId IN({$searchItem->caste})"));
							else
							$recordsf = array();
							
							$list = CHtml::listData($recordsf, 'casteId', 'name');
						    echo CHtml::dropDownList('caste1[]',null,$list,array('class'=>'right ar','id'=>'acaste1','multiple'=>'multiple')); ?>
							
						</div>
					</li>
				</ul>
				<ul>
					<li>
						<h3>Education and Occupation</h3>
					</li>
					<li>
						<div class="title">
							Education
						</div>
						<div class="info">
						     <?php 
   						     if(isset($searchItem->education))
						    $records = EducationMaster::model()->findAll(array('condition'=> "educationId NOT IN({$searchItem->education})"));
						    else
						    $records = EducationMaster::model()->findAll("active=1");
							$list = CHtml::listData($records, 'educationId', 'name');
						    echo CHtml::dropDownList('education',null,$list,array('class'=>'left ar','multiple'=>'multiple')); ?>
						<div class="ar-btn">
							<input class="add type2" value="Add" onclick="return add('education','aeducation1')" type="button">
							<input class="remove type2" value="Remove" onclick="return add('aeducation1','education')"type="button">
						</div>
						<?php 
   						     if(isset($searchItem->education))
						    $records = EducationMaster::model()->findAll(array('condition'=> "educationId IN({$searchItem->education})"));
						    else
						    $records = array();
							$list = CHtml::listData($records, 'educationId', 'name');
						    echo CHtml::dropDownList('education1[]',null,$list,array('class'=>'right ar','id'=>'aeducation1','multiple'=>'multiple')); 
						    ?>
						</div>
					</li>
					<li>
						<div class="title">
							Occupation
						</div>
						<div class="info">
						<?php 
							if(isset($searchItem->occupation))
							$records = OccupationMaster::model()->findAll(array('condition'=> "occupationId NOT IN({$searchItem->occupation})"));
						    else
						    $records = OccupationMaster::model()->findAll("active = 1");
							$list = CHtml::listData($records, 'occupationId', 'name');
						    echo CHtml::dropDownList('occupation',null,$list,array('class'=>'left ar','multiple'=>'multiple')); ?>
									
							<div class="ar-btn">
							<input class="add type2" value="Add"  onclick="return add('occupation','occupation1')" type="button">
							<input class="remove type2" value="Remove" onclick="return add('occupation1','occupation')"type="button">
							</div>
							
							<?php 
							if(isset($searchItem->occupation))
							$records = OccupationMaster::model()->findAll(array('condition'=> "occupationId NOT IN({$searchItem->occupation})"));
						    else
						    $records = array();
							$list = CHtml::listData($records, 'occupationId', 'name');
						    echo CHtml::dropDownList('occupation1[]',null,$list,array('class'=>'right ar','multiple'=>'multiple')); ?>
						</div>
					</li>
					<li>
						<div class="title">
							Annual Income is Rs:
						</div>
						<div class="info">
							<?php echo CHtml::dropDownList('incomeFrom',null,Utilities::getAnnualIncome(),array('empty' => 'Income','class'=>'wid120')); ?>
							<div class="married">
								<span class="text">to</span>
								<?php echo CHtml::dropDownList('incomeTo',null,Utilities::getAnnualIncome(),array('empty' => 'Income','class'=>'wid120')); ?>
							</div>
						</div>
					</li>
				</ul>
				<ul>
					<li>
						<h3>Astro Details</h3>
					</li>
					<li>
						<div class="title">
							Star
						</div>
						<div class="info">
						<?php 
							if(isset($searchItem->star))
							$records = SignsMaster::model()->findAll(array('condition'=> "signId NOT IN({$searchItem->star})"));
						    else
						   $records = SignsMaster::model()->findAll("active = 1");
						
							$list = CHtml::listData($records, 'signId', 'name');
						    echo CHtml::dropDownList('star',null,$list,array('class'=>'left ar','multiple'=>'multiple')); ?>
									
							<div class="ar-btn">
							<input class="add type2" value="Add"  onclick="return add('star','star1')" type="button">
							<input class="remove type2" value="Remove" onclick="return add('star1','star')" "type="button">
							</div>
							<?php 
							if(isset($searchItem->star))
							$records = SignsMaster::model()->findAll(array('condition'=> "signId NOT IN({$searchItem->star})"));
						    else
						   $records = array();
							$list = CHtml::listData($records, 'signId', 'name');
						    echo CHtml::dropDownList('star1[]',null,$list,array('class'=>'right ar','id'=>'star1','multiple'=>'multiple')); ?>
							
						</div>
					</li>
					<li>
						<div class="title">
							Sudha Jathakam
						</div>
						<div class="info">
							<div class="radio mR14">
								<input type="radio" name="sudha" <?php if($searchItem->sudham == 1) {?> checked="checked" <?php } ?> value="1"> <span>Yes</span>
							</div>
							<div class="radio mR14">
								<input type="radio" name="sudha" <?php if($searchItem->sudham != false && $searchItem->sudham == 0) {?> checked="checked" <?php } ?> value="0"> <span>No</span>
							</div>
							<div class="radio mR14">
								<input type="radio" name="sudha" <?php if($searchItem->sudham == 2) {?> checked="checked" <?php } ?> value="2"> <span>Don't Know</span>
							</div>
						</div>
					</li>
					<li>
						<div class="title">
							Chovva Dosham
						</div>
						<div class="info">
							<div class="radio mR14">
								<input type="radio" name="chova" <?php if($searchItem->dosham == 1) {?> checked="checked" <?php } ?> value="1"> <span>Yes</span>
							</div>
							<div class="radio mR14">
								<input type="radio" name="chova" <?php if($searchItem->dosham != false && $searchItem->dosham == 0) {?> checked="checked" <?php } ?> value="0"> <span>No</span>
							</div>
							<div class="radio mR14">
								<input type="radio" name="chova" <?php if($searchItem->dosham == 2) {?> checked="checked" <?php } ?>value="2"> <span>Don't Know</span>
							</div>
						</div>
					</li>
				</ul>
				<ul>
					<li>
						<h3>Favourite Cuisine</h3>
					</li>
					<li>
						<div class="title">
							Eating habits
						</div>
						<?php
							$all = false;
							$veg = false;
							$non = false;
							$egg = false;
						if(isset($searchItem->eating))
						{
							$maritalStatus = explode(",", $searchItem->eating);
							$veg = in_array(0,$maritalStatus);
							$non = in_array(1,$maritalStatus);
							$egg = in_array(2,$maritalStatus);
							$all = in_array(3,$maritalStatus);
						}
						?>
						<div class="info">
							<div class="check ">
								<input type="checkbox" name="eat[]" <?php if($all != false) {?> checked="checked" <?php } ?> value="3" /><span>Any</span>
							</div>
							<div class="check ">
								<input type="checkbox" name="eat[]" <?php if($veg != false) {?> checked="checked" <?php } ?> value="0" /> <span>Vegitarian </span>
							</div>
							<div class="check ">
								<input type="checkbox" name="eat[]" <?php if($non != false) {?> checked="checked" <?php } ?> value="1" /><span>Non Vegitarian</span>
							</div>
							<div class="check ">
								<input type="checkbox" name="eat[]" <?php if($egg != false) {?> checked="checked" <?php } ?> value="2" /><span>Eggetarian </span>
							</div>
						</div>
					</li>
					<li>
						<div class="title">
							Drinking
						</div>
						<?php
							$any = false;
							$light = false;
							$non = false;
							$reg = false;
						if(isset($searchItem->drinking))
						{
							$maritalStatus = explode(",", $searchItem->drinking);
							$non = in_array(0,$maritalStatus);
							$reg = in_array(1,$maritalStatus);
							$light = in_array(2,$maritalStatus);
							$any = in_array(3,$maritalStatus);
						}
						?>
						<div class="info">
							<div class="check ">
								<input type="checkbox" name="drink[]" <?php if($any != false) {?> checked="checked" <?php } ?> value="3" /><span>Any</span>
							</div>
							<div class="check ">
								<input type="checkbox" name="drink[]" <?php if($non != false) {?> checked="checked" <?php } ?> value="0" /><span>Non-drinker </span>
							</div>
							<div class="check ">
								<input type="checkbox" name="drink[]" <?php if($light != false) {?> checked="checked" <?php } ?> value="2" /><span>Light / Social drinker</span>
							</div>
							<div class="check ">
								<input type="checkbox" name="drink[]" <?php if($reg != false) {?> checked="checked" <?php } ?> value="1" /><span>Regular drinker </span>
							</div>
						</div>
					</li>
					<li>
						<div class="title">
							Smoking
						</div>
						<?php
							$any = false;
							$light = false;
							$non = false;
							$reg = false;
						if(isset($searchItem->smoking))
						{
							$maritalStatus = explode(",", $searchItem->smoking);
							$non = in_array(0,$maritalStatus);
							$reg = in_array(1,$maritalStatus);
							$light = in_array(2,$maritalStatus);
							$any = in_array(3,$maritalStatus);
						}
						?>
						<div class="info">
							<div class="check ">
								<input type="checkbox" name="smoke[]" <?php if($any != false) {?> checked="checked" <?php } ?>  value="3" /><span>Any</span>
							</div>
							<div class="check ">
								<input type="checkbox" name="smoke[]" <?php if($non != false) {?> checked="checked" <?php } ?>  value="0" /><span>Non-smoker</span>
							</div>
							<div class="check ">
								<input type="checkbox" name="smoke[]" <?php if($light != false) {?> checked="checked" <?php } ?>  value="2" /><span>Light / Social smoker</span>
							</div>
							<div class="check ">
								<input type="checkbox" name="smoke[]" <?php if($reg != false) {?> checked="checked" <?php } ?>  value="1" /><span>Regular smoker </span>
							</div>
						</div>
					</li>
				</ul>
				<ul>
				<!-- 
					<li>
						<h3>Keywords</h3>
					</li>
					<li>
						<p>Enter keywords within quotes and for more than one keyword use a comma separator between words. Example: "Good looking", "Well settled", etc. Keywords are searched against the profile description of a member.</p>
					</li>
					<li>
						<div class="title">
							Keyword
						</div>
						<div class="info">
							<input type="text" name="keyword" value="<?php echo $searchItem->horoscope?>"class="wid180" />
						</div>
					</li>
				 -->	
					<li>
						<div class="title">
							Show profile
						</div>
						<div class="info">
							<div class="check wid220">
								<input type="checkbox" name="profile[]" value="p" <?php if($searchItem->photo == 1) {?> checked="checked" <?php } ?> /> <span>Only With Photo</span>
							</div>
							<div class="check ">
								<input type="checkbox" name="profile[]" value="h" <?php if($searchItem->horoscope == 1) {?> checked="checked" <?php } ?>/><span>Only With horoscope</span>
							</div>
						</div>
					</li>
					<!--  
					<li>
						<div class="title">
							Don't show
						</div>
						<?php
							$ignore = false;
							$contacted = false;
							$view = false;
							$shortlisted = false;
						if(isset($searchItem->showTo))
						{
							$maritalStatus = explode(",", $searchItem->showTo);
							$ignore = in_array(0,$maritalStatus);
							$contacted = in_array(1,$maritalStatus);
							$view = in_array(2,$maritalStatus);
							$maritalStatus = in_array(3,$maritalStatus);
						}
						?>
						
						<div class="info">
							<div class="check wid220">
								<input type="checkbox" value="0" <?php if($ignore != false) {?> checked="checked" <?php } ?>   name="show[]"><span>Ignored Profiles</span>
							</div>
							<div class="check wid220">
								<input type="checkbox" value="1" <?php if($contacted != false) {?> checked="checked" <?php } ?> name="show[]"><span>Profiles already contacted</span>
							</div>
							<div class="check wid220">
								<input type="checkbox" value="2" <?php if($view != false) {?> checked="checked" <?php } ?> name="show[]"><span>Viewed Profiles</span>
							</div>
							<div class="check ">
								<input type="checkbox" value="3" <?php if($shortlisted != false) {?> checked="checked" <?php } ?>  name="show[]"><span>Shortlisted Profiles</span>
							</div>
						</div>
					</li>
					 -->
					<li>
						<div class="buttonContnr2 mT20">
							<a class="type4" id="searchButtons">Save Search</a>
								<input type="submit" value="Search" class="type4" />	
							<div class="saveSbox" id="advsave" style="display:none">
							<div class="tarrow"></div>
							<div class="cont wid140">
								<div class="head">
									<span>Save Your Search</span>
								</div>
								<div class="row">
									<input type="text"  id="searchName" <?php if(isset($searchItem->searchName)) {?> value="<?php echo $searchItem->searchName?>" <?php } ?> name="searchName" placeholder="Mysearch1" />
								</div>
								<div class="row" id="advSearch">
									<a class="type5" href="#">Save </a>
								</div>
							</div>
						</div>
						</div>
					</li>
				</ul>
				</form>
			</article>
		</div>
		<div id="tab3_data" class="tab-data" style="display: none;">
			<div class="sId">
				<p>Enter a Keyword of the member whose profile you would like to see.</p>
				<div class="sec">
				<form id="keywordSearch"  name="keywordSearch" method="post"  action="/search/keyword">
					<div class="text"> Enter a Keyword</div>
					<input type="text" name="keyword" id="keyword" placeholder="Eg: f,24 or male,28 or name" />
					<a href="javascript:keywordSearch.submit();" class="type3 wid100">Search</a>
					<a  href="javascript:keywordSearch.reset();" class="type3">Reset</a>
				</form>	
				</div>
			</div>
			
		</div>
		<div id="tab4_data" class="tab-data" style="display: none;">
			<div class="sId">
				<p>Enter the Matrimony ID of the member whose profile you would like to see.</p>
				<div class="sec">
				<form id="idSearch"  name="idSearch" method="get"  action="/search/byid">
					<div class="text"> Matrimony ID </div>
					<input type="text" name="id" id="id" />
					<a href="javascript:idSearch.submit();" class="type3 wid100">View Profile</a>
					<a href="javascript:idSearch.reset();" class="type3">Reset</a>
				</form>	
				</div>
			</div>
		</div>
    </section>


      
 <script type="text/javascript">
$(document).ready(function() {


	$("#advanceSearch").validationEngine('attach');
	$("#regularSearch").validationEngine('attach');
	$("#quickSearch").validationEngine('attach');
	
	$('#rsearchButton').click(function() {	
	  	$('#rsaveBox').show();
	  	$('#rsearchButton').hide();
	  	$('#rsearchName').focus();
	  	
	});

	$('#rsearchSubmit').click(function() {
		$("#regularSearch").attr("action","/search/save");
		if($('#rsearchName').val().length == 0)
		{
		$('#rsearchName').validationEngine('showPrompt', 'Please enter name to save search', 'error', true);
		return false;
		}
		$('<input>').attr({
		    type: 'hidden',
		    name: 'searchName',
		    value: $('#rsearchName').val(),
		}).appendTo('#regularSearch');
		$("#regularSearch").submit();
		$('#rsaveBox').hide();
	});

	$('#advSearch').click(function() {
	$("#advanceSearch").attr("action","/search/save");
	if($('#searchName').val().length == 0)
	{
	$('#searchName').validationEngine('showPrompt', 'Please enter name to save search', 'error', true);
	return false;
	}
	$('<input>').attr({
	    type: 'hidden',
	    name: 'searchName',
	    value: $('#searchName').val(),
	}).appendTo('#advanceSearch');
    $("#advanceSearch").submit();
    $('#advsave').hide();
	});
	
	$('#searchButtons').click(function() {	
		$('#advsave').show();
		$('#searchButtons').hide();
		$('#searchName').focus();
			
	});
	
});

function checkAgeLimit(field, rules, i, options){
	if (field.val()) {

		if(!$('#ageFrom').val())
			return "Select proper age limit";

		var start = parseInt($('#ageFrom').val());
		
		if( parseInt(field.val()) <= start)
		return "Select proper age limit";
	}
}

function hidePromp(field, rules, i, options){
	if (field.val()) {
		$("#advanceSearch").validationEngine('hide');
		$("#regularSearch").validationEngine('hide');
		$("#quickSearch").validationEngine('hide');
		
	}
}
function checkHeightLimit(field, rules, i, options){
	if (field.val()) {

		if(!$('#heightFrom').val())
			return "Select proper height limit";

		var start = parseInt($('#heightFrom').val());
		
		if( parseInt(field.val()) <= start)
		return "Select proper height limit";
	}
}

function checkAHeightLimit(field, rules, i, options){
	if (field.val()) {

		if(!$('#heightFrom1').val())
			return "Select proper height limit";

		var start = parseInt($('#heightFrom1').val());
		
		if( parseInt(field.val()) <= start)
		return "Select proper height limit";
	}
}


</script>      
      