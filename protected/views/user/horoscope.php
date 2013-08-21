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
* @title horoscope.php
* @description <Description of this class>
*  @filesource <URL>
*  @version <Revision>
*/
?>

<section class="data-contnr">
<form id="userHoro" enctype="multipart/form-data" name="userHoro" method="post"  action="/user/horo">
		<article class="section">
			<ul>
				<li>
					<h1 class="message">My Astro Details</h1>
					<h5 class="color">Fill it for a better match  </h5>
				</li>
			</ul>
			<ul>
				<li>
					<p class="width100">By filling in your astro details, you can be sure that you get a match that is in line with your Grahanila. You can also avoid getting contacted people who doesn't match your Grahanila.</p>
				</li>
				<li>
				<?php 
				$user = Yii::app()->session->get('user');
				$date = new DateTime($user->dob);?>
				
					<div class="title">
						Date of Birth
					</div>
					<div class="info">
					<?php echo CHtml::dropDownList('date',$date->format('d'),Utilities::getRegDays(),array('class'=>'wid50 mR5')); ?>
					<?php echo CHtml::dropDownList('month',$date->format('m'),Utilities::getRegMonths(),array('class'=>'validate[condRequired[date]] wid100 mR5')); ?>		    
    				<?php echo CHtml::dropDownList('year',$date->format('Y'),  Utilities::getRegYears(),array('class'=>'validate[condRequired[date]] wid60')); ?>
						
					</div>
				</li>
				<li>
					<div class="title">
						Country of Birth
					</div>
					<div class="info">
					<?php $records = Country::model()->findAll("active = 1");
		$list = CHtml::listData($records, 'countryId', 'name');
		echo CHtml::dropDownList('country',null,$list,array('empty' => 'Country','class'=>'wid220')); ?>
						
					</div>
				</li>
				<li>
					<div class="title">
						State of Birth
					</div>
					<div class="info">
					<?php $records = States::model()->findAll("active = 1");
		$list = CHtml::listData($records, 'stateId', 'name');
		echo CHtml::dropDownList('state',null,$list,array('empty' => 'State','class'=>'wid220')); ?>
					</div>
				</li>
				<li>
					<div class="title">
						City of Birth
					</div>
					<div class="info">
						<input type="text" name="city" id="city" placeholder="Place of Birth" />
						
					</div>
				</li>
				<li>
					<div class="title">
						Language
					</div>
					<div class="info">
					<?php $records = Languages::model()->findAll("active = 1");
		$list = CHtml::listData($records, 'languageId', 'name');
		echo CHtml::dropDownList('motherTounge',null,$list,array('empty' => 'Language','class'=>'wid220')); ?>
					</div>
				</li>
				<li>
					<div class="title">
						Time of birth  
					</div>
					<div class="info">
					
					<?php echo CHtml::dropDownList('hours',null,Utilities::getTime(),array('empty'=>'Hour','class'=>'wid70 mR5')); ?>
					<?php echo CHtml::dropDownList('minutes',null,Utilities::getMinutes(),array('empty'=>'Minutes','class'=>'wid70 mR5')); ?>
					<?php echo CHtml::dropDownList('seconds',null,Utilities::getMinutes(),array('empty'=>'Seconds','class'=>'wid70 mR5')); ?>
					<?php echo CHtml::dropDownList('am',null,Utilities::getMeridiem(),array('empty'=>'AM/PM','class'=>'wid70 mR5')); ?>	
     										
					</div>
				</li>
				<li>
					<div class="title">
						Your Sign
					</div>
					<div class="info">
					 <?php $records = SignsMaster::model()->findAll("active = 1");
					$list = CHtml::listData($records, 'signId', 'name');
					echo CHtml::dropDownList('sign',null,$list,array('empty' => 'Sign','class'=>'wid220')); ?>
						
					</div>
				</li>
				<li>
					<div class="title">
						Your Astrodate
					</div>
					<div class="info">
					<?php $records = AstrodateMaster::model()->findAll("active = 1");
					$list = CHtml::listData($records, 'astrodateId', 'name');
					echo CHtml::dropDownList('astrodate',null,$list,array('empty' => 'Astrodate','class'=>'wid220')); ?>		
						
					</div>
				</li>
				<li>
					<div class="title">Upload Grahanila </div>
					
					
					<div id='file_browse_wrapper'>
					<input type="file" name="horoscopeFile" id="horoscopeFile" />
					</div>
				</li>
				<li>
					<div class="title">
						Chovva Dosham
					</div>
					<div class="info">
						<div class="radio wid90">
							<input name="chova" type="radio" value="1"> <span>Yes</span>
						</div>
						<div class="radio wid90">
							<input name="chova" type="radio" value="0"> <span>No</span>
						</div>
						<div class="radio wid90">
							<input name="chova" type="radio" value="2"><span>Don't Know</span>
						</div>
					</div>
				</li>
				<li>
					<div class="title">
						Sudha Jathakam
					</div>
					<div class="info">
						<div class="radio wid90">
							 <input name="sudha" type="radio" value="1"> <span>Yes</span>
						</div>
						<div class="radio wid90">
							 <input name="sudha" type="radio" value="0"> <span>No</span>
						</div>
						<div class="radio wid90">
							 <input name="sudha" type="radio" value="2"> <span>Don't Know</span>
						</div>
					</div>
				</li>
				<!-- 
				<li>
					<div class="title">
						Who can view my astro details
					</div>
					<div class="info">
						<div class="check">
							<input type="checkbox" name="astro[]" checked="checked" id="astro_0" value="all"><span>All</span>
						</div>
						<div class="check">
							<input type="checkbox" name="astro[]" id="astro_0" value="subscribers"> <span>Subscribers</span>
						</div>
						<div class="check">
							<input type="checkbox" name="astro[]" id="astro_0" value="member"> <span>Loged Members</span>
						</div>
						<div class="check">
							<input type="checkbox" name="astro[]" id="astro_0" value="request"> <span>By Request</span>
						</div>
					</div>
				</li>
				 -->
			</ul>
			<ul>
				<li><h3>Reference Contact Details</h3></li>
				<li>
					<p class="width100">Adding reference details ensure credibility to your profile and also ensure that you have someone to validate your claims. Add the contacts details of an important personality in your locality such as school teachers, Panchayath/council members etc. </p>
				</li>
				<li>
					<div class="title">
						Referance 1
					</div>
					<div class="info">
						<div class="inner-row">
							<input type="text" name="name0" class="validate[minSize[3],custom[onlyLetterSp]]" id="name0" placeholder="Name" />
						</div>
						<div class="inner-row">
							<input type="text" name="house0" id="house0" class="validate[minSize[3]]" placeholder="House Name / No." />
						</div>
						<div class="inner-row">
							<input type="text" name="place0" id="place0" class="validate[minSize[3],custom[onlyLetterSp]]"  placeholder="Place" />
							<input type="text" name="post0" id="post0"  placeholder="panchayath/municipality/corparation" class="validate[minSize[3],custom[onlyLetterSp]]"   />
						</div>
						<div class="inner-row">
							<input type="text" name="city0" id="city0" placeholder="City" class="validate[minSize[3],custom[onlyLetterSp]]"/>
							<input type="text" name="district0" id="district0"  placeholder="District" class="validate[minSize[3],custom[onlyLetterSp]]"  />
						</div>
						<div class="inner-row">
							<input type="text" name="state0" id="state0" placeholder="State" class="validate[minSize[3],custom[onlyLetterSp]]"   />
							   <input type="text" name="country0" id="country0" placeholder="Country" class="validate[minSize[3],custom[onlyLetterSp]]"   />
						</div>
						<div class="inner-row">
							<input type="text" name="pin0" id="pin0" placeholder="Contact Number" class="validate[custom[onlyNumberSp],minSize[10],maxSize[12]]"  />
						</div>
						<div class="inner-row">
							<input type="text" name="email0" id="email0"  placeholder="Email" class="validate[funcCall[checkEmailValidation]]"/>
						</div>
					</div>
				</li>
				<li class="mTnone">
					<div class="title">
						Occupation
					</div>
					<div class="info">
						<input type="text" name="occupation0" id="occupation0" placeholder="Occupation" class="validate[minSize[3],custom[onlyLetterSp]]"  />
					</div>
				</li>
				<li>
					<div class="title">
						Time to call
					</div>
					<div class="info">
					<?php echo CHtml::dropDownList('timeFrom0',null,Utilities::getTime(),array('empty'=>'Time','class'=>'wid70 mR5')); ?>
					<?php echo CHtml::dropDownList('fromA0',null,Utilities::getMeridiem(),array('empty'=>'AM/PM','class'=>'wid50 mR5')); ?>	
     				<?php echo CHtml::dropDownList('timeTo0',null,Utilities::getTime(),array('empty'=>'Time','class'=>'wid70 mR5')); ?>
     				<?php echo CHtml::dropDownList('toA0',null,Utilities::getMeridiem(),array('empty'=>'AM/PM','class'=>'wid70 mR5')); ?>
					</div>
				</li>
			</ul>
			<ul>
				<li>
					<div class="title">
						Referance 2
					</div>
					<div class="info">
						
						<div class="inner-row">
							<input type="text" name="name1" class="validate[minSize[3],custom[onlyLetterSp]]"  id="name1" placeholder="Name" />
						</div>
						<div class="inner-row">
							<input type="text" name="house1" id="house1" placeholder="House Name / No." class="validate[minSize[3]]"  />
						</div>
						<div class="inner-row">
							<input type="text" name="place1" id="place1"  placeholder="Place" class="validate[minSize[3],custom[onlyLetterSp]]" />
							<input type="text" name="post1" id="post1"  placeholder="Post office" class="validate[minSize[3],custom[onlyLetterSp]]" />
						</div>
						<div class="inner-row">
							<input type="text" name="city1" id="city1" placeholder="City" class="validate[minSize[3],custom[onlyLetterSp]]" />
							<input type="text" name="district1" id="district1"  placeholder="District" class="validate[minSize[3],custom[onlyLetterSp]]" />
						</div>
						<div class="inner-row">
							<input type="text" name="state1" id="state1" placeholder="State" class="validate[minSize[3],custom[onlyLetterSp]]" />
							   <input type="text" name="country1" id="country1" placeholder="Country" class="validate[minSize[3],custom[onlyLetterSp]]" />
						</div>
						<div class="inner-row">
							<input type="text" name="pin1" id="pin1" placeholder="Contact Number" class="validate[custom[onlyNumberSp],minSize[10],maxSize[12]]"/>
						</div>
						<div class="inner-row">
							<input type="text" name="email1" id="email1"  placeholder="Email" class="validate[funcCall[checkEmailValidation]]"/>
						</div>
					</div>
				</li>
				<li class="mTnone">
					<div class="title">
						Occupation
					</div>
					<div class="info">
						<input type="text" name="occupation1" id="occupation1" placeholder="Occupation" class="validate[minSize[3],custom[onlyLetterSp]]" />
					</div>
				</li>
				<li>
					<div class="title">
						Time to call
					</div>
					<div class="info">
						<?php echo CHtml::dropDownList('timeFrom1',null,Utilities::getTime(),array('empty'=>'Time','class'=>'wid70 mR5')); ?>
						<?php echo CHtml::dropDownList('fromA1',null,Utilities::getMeridiem(),array('empty'=>'AM/PM','class'=>'wid50 mR5')); ?>	
     					<?php echo CHtml::dropDownList('timeTo1',null,Utilities::getTime(),array('empty'=>'Time','class'=>'wid70 mR5')); ?>
     					<?php echo CHtml::dropDownList('toA1',null,Utilities::getMeridiem(),array('empty'=>'AM/PM','class'=>'wid70 mR5')); ?>
					</div>
				</li>
			</ul>
			<ul>
				<li>
					<div class="title">
						Referance 3
					</div>
					<div class="info">
						
						<div class="inner-row">
							<input type="text" name="name2" class="validate[minSize[3],custom[onlyLetterSp]]"  id="name2" placeholder="Name" />
						</div>
						<div class="inner-row">
							<input type="text" name="house2" id="house2" placeholder="House Name / No." class="validate[minSize[3]]" />
						</div>
						<div class="inner-row">
							<input type="text" name="place2" id="place2"  placeholder="Place"  class="validate[minSize[3],custom[onlyLetterSp]]" />
							<input type="text" name="post2" id="post2"  placeholder="Post office" class="validate[minSize[3],custom[onlyLetterSp]]" />
						</div>
						<div class="inner-row">
							<input type="text" name="city2" id="city2" placeholder="City" class="validate[minSize[3],custom[onlyLetterSp]]" />
							<input type="text" name="district2" id="district2"  placeholder="District" class="validate[minSize[3],custom[onlyLetterSp]]" />
						</div>
						<div class="inner-row">
							<input type="text" name="state2" id="state2" placeholder="State" class="validate[minSize[3],custom[onlyLetterSp]]" />
							   <input type="text" name="country2" id="country2" placeholder="Country" class="validate[minSize[3],custom[onlyLetterSp]]" />
						</div>
						<div class="inner-row">
							<input type="text" name="pin2" id="pin2" placeholder="Contact Number" class="validate[custom[onlyNumberSp],minSize[10],maxSize[12]]"/>
						</div>
						<div class="inner-row">
							<input type="text" name="email2" id="email2" class="validate[funcCall[checkEmailValidation]]" placeholder="Email" />
							
						</div>
					</div>
				</li>
				<li class="mTnone">
					<div class="title">
						Occupation
					</div>
					<div class="info">
						<input type="text" name="occupation2" id="occupation2" placeholder="Occupation" class="validate[minSize[3],custom[onlyLetterSp]]" />
					</div>
				</li>
				<li>
					<div class="title">
						Time to call
					</div>
					<div class="info">
						<?php echo CHtml::dropDownList('timeFrom2',null,Utilities::getTime(),array('empty'=>'Time','class'=>'wid70 mR5')); ?>
					<?php echo CHtml::dropDownList('fromA2',null,Utilities::getMeridiem(),array('empty'=>'AM/PM','class'=>'wid50 mR5')); ?>	
				     <?php echo CHtml::dropDownList('timeTo2',null,Utilities::getTime(),array('empty'=>'Time','class'=>'wid70 mR5')); ?>
				     <?php echo CHtml::dropDownList('toA2',null,Utilities::getMeridiem(),array('empty'=>'AM/PM','class'=>'wid70 mR5')); ?>
									</div>
				</li>
				<!--  
				<li>
					<div class="title">
						Who can view contact details
					</div>
					<div class="info">
						<div class="check">
							<input type="radio" name="reference" checked="checked" value="subscribers"> <span>Subscribers</span>
						</div>
						<div class="check">
							<input type="radio" name="reference" value="request"> <span>By Request</span>
						</div>
					</div>
				</li>
				-->
				<li>
					<div class="buttonContnr no-marg">
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
	$('<a href="/user/horoupload">Skip this page|</a> ').insertBefore('.logout');
    $("#userHoro").validationEngine('attach');	
});





</script>