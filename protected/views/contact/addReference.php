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
 * @title addReference.php
 * @description <Description of this class>
 *  @filesource <URL>
 *  @version <Revision>
 */
?>
<div class="subContent">
	<section class="subHead">
	<h1 class="width100">Add Referance Contact Details</h1>
	</section>
	<section class="subContnr">
	<form id="userContact" name="userContact" method="post"
		action="/contact/referenceedit">
		<article class="section width100">


		<ul>
			<li>
				<div class="title">Referance Person 1</div>
				<div class="info">
					<div class="inner-row">
						<div class="inputH">Name</div>
						<input type="text" name="name0"
							class="validate[minSize[3],custom[onlyLetterSp]]" id="name0"
							placeholder="Name" />
					</div>
					<div class="inner-row">
						<div class="inputH">House Name / No.</div>
						<input type="text"  name="house0" id="house0"
							class="validate[minSize[3]]" placeholder="House Name / No." />
					</div>
					<div class="inner-row">
						<div class="inputCl">
							<div class="inputH">Place</div>
							<input type="text" name="place0" id="place0"
								class="validate[minSize[3],custom[onlyLetterSp]]"
								placeholder="Place" />
						</div>
						<div class="tHolder">
							<div class="inputTx">Corporation/municipality/panchayath</div>
							<input type="text" name="post0" id="post0"
								placeholder="panchayath/municipality/corparation"
								class="validate[minSize[3],custom[onlyLetterSp]]" />
						</div>
					</div>
					<div class="inner-row">
						<div class="inputCl">
							<div class="inputH">City</div>
							<input type="text" name="city0"  id="city0"
								placeholder="City"
								class="validate[minSize[3],custom[onlyLetterSp]]" />
						</div>
						<div class="tHolder">
							<div class="inputTx">District</div>
							<input type="text" name="district0" id="district0"
								placeholder="District"
								class="validate[minSize[3],custom[onlyLetterSp]]" />
						</div>
					</div>
					<div class="inner-row">
						<div class="inputCl">
							<div class="inputH">State</div>
							<input type="text" name="state0" id="state0"
								placeholder="State"
								class="validate[minSize[3],custom[onlyLetterSp]]" />
						</div>
						<div class="tHolder">
							<div class="inputTx">Country</div>
							<input type="text"  name="country0" id="country0"
								placeholder="Country"
								class="validate[minSize[3],custom[onlyLetterSp]]" />
						</div>
					</div>
					<div class="inner-row">
						<div class="inputCl">
							<div class="inputH">Contact Number</div>
							<input type="text"  name="pin0" id="pin0"
								placeholder="Contact Number"
								class="validate[custom[onlyNumberSp],minSize[10],maxSize[12]]" />
						</div>
					</div>
					<div class="inner-row">
						<div class="inputCl">
							<div class="inputH">Email</div>
							<input type="text"  name="email0"
								id="email0" placeholder="Email"
								class="validate[funcCall[checkEmailValidation]]" />
						</div>
					</div>
					<div class="inner-row">
						<div class="inputCl">
							<div class="inputH">Occupation</div>
							<input type="text"  name="occupation0"
								id="occupation0" placeholder="Occupation"
								class="validate[minSize[3],custom[onlyLetterSp]]" />
						</div>
					</div>
					<div class="inner-row">
						<div class="inputCl">
							<div class="inputH">Time to Call</div>
							<div class="info width100">
											<?php echo CHtml::dropDownList('timeFrom0',null,Utilities::getTime(),array('empty'=>'Time','class'=>'wid60 mR5')); ?>
											<?php echo CHtml::dropDownList('fromA0',null,Utilities::getMeridiem(),array('empty'=>'AM/PM','class'=>'wid50 mR5')); ?>	
										     <?php echo CHtml::dropDownList('timeTo0',null,Utilities::getTime(),array('empty'=>'Time','class'=>'wid60 mR5')); ?>
										     <?php echo CHtml::dropDownList('toA0',null,Utilities::getMeridiem(),array('empty'=>'AM/PM','class'=>'wid50')); ?>
							</div>
						</div>
					</div>
				</div>
			</li>
		</ul>


		<ul>
			<li>
				<div class="title">Referance Person 2</div>
				<div class="info">
					<div class="inner-row">
						<div class="inputH">Name</div>
						<input type="text" name="name1"
							class="validate[minSize[3],custom[onlyLetterSp]]" id="name1"
							placeholder="Name" />
					</div>
					<div class="inner-row">
						<div class="inputH">House Name / No.</div>
						<input type="text"  name="house1" id="house1"
							class="validate[minSize[3]]" placeholder="House Name / No." />
					</div>
					<div class="inner-row">
						<div class="inputCl">
							<div class="inputH">Place</div>
							<input type="text"  name="place1" id="place1"
								class="validate[minSize[3],custom[onlyLetterSp]]"
								placeholder="Place" />
						</div>
						<div class="tHolder">
							<div class="inputTx">Corporation/municipality/panchayath</div>
							<input type="text"  name="post1" id="post1"
								placeholder="panchayath/municipality/corparation"
								class="validate[minSize[3],custom[onlyLetterSp]]" />
						</div>
					</div>
					<div class="inner-row">
						<div class="inputCl">
							<div class="inputH">City</div>
							<input type="text" name="city1"  id="city1"
								placeholder="City"
								class="validate[minSize[3],custom[onlyLetterSp]]" />
						</div>
						<div class="tHolder">
							<div class="inputTx">District</div>
							<input type="text" name="district1" id="district1"
								placeholder="District"
								class="validate[minSize[3],custom[onlyLetterSp]]" />
						</div>
					</div>
					<div class="inner-row">
						<div class="inputCl">
							<div class="inputH">State</div>
							<input type="text"  name="state1" id="state1"
								placeholder="State"
								class="validate[minSize[3],custom[onlyLetterSp]]" />
						</div>
						<div class="tHolder">
							<div class="inputTx">Country</div>
							<input type="text"  name="country1" id="country1"
								placeholder="Country"
								class="validate[minSize[3],custom[onlyLetterSp]]" />
						</div>
					</div>
					<div class="inner-row">
						<div class="inputCl">
							<div class="inputH">Contact Number</div>
							<input type="text"  name="pin1" id="pin1"
								placeholder="Contact Number"
								class="validate[custom[onlyNumberSp],minSize[10],maxSize[12]]" />
						</div>
					</div>
					<div class="inner-row">
						<div class="inputCl">
							<div class="inputH">Email</div>
							<input type="text"  name="email1"
								id="email1" placeholder="Email"
								class="validate[funcCall[checkEmailValidation]]" />
						</div>
					</div>
					<div class="inner-row">
						<div class="inputCl">
							<div class="inputH">Occupation</div>
							<input type="text"  name="occupation1"
								id="occupation1" placeholder="Occupation"
								class="validate[minSize[3],custom[onlyLetterSp]]" />
						</div>
					</div>
					<div class="inner-row">
						<div class="inputCl">
							<div class="inputH">Time to Call</div>
							<div class="info width100">
										<?php echo CHtml::dropDownList('timeFrom1',null,Utilities::getTime(),array('empty'=>'Time','class'=>'wid60 mR5')); ?>
											<?php echo CHtml::dropDownList('fromA1',null,Utilities::getMeridiem(),array('empty'=>'AM/PM','class'=>'wid50 mR5')); ?>	
										     <?php echo CHtml::dropDownList('timeTo1',null,Utilities::getTime(),array('empty'=>'Time','class'=>'wid60 mR5')); ?>
										     <?php echo CHtml::dropDownList('toA1',null,Utilities::getMeridiem(),array('empty'=>'AM/PM','class'=>'wid50')); ?>
							</div>
						</div>
					</div>
				</div>
			</li>
		</ul>


		<ul>
			<li>
				<div class="title">Referance Person 3</div>
				<div class="info">
					<div class="inner-row">
						<div class="inputH">Name</div>
						<input type="text"  name="name2"
							class="validate[minSize[3],custom[onlyLetterSp]]" id="name2"
							placeholder="Name" />
					</div>
					<div class="inner-row">
						<div class="inputH">House Name / No.</div>
						<input type="text"  name="house2" id="house2"
							class="validate[minSize[3]]" placeholder="House Name / No." />
					</div>
					<div class="inner-row">
						<div class="inputCl">
							<div class="inputH">Place</div>
							<input type="text" name="place2" id="place2"
								class="validate[minSize[3],custom[onlyLetterSp]]"
								placeholder="Place" />
						</div>
						<div class="tHolder">
							<div class="inputTx">Corporation/municipality/panchayath</div>
							<input type="text" name="post2" id="post2"
								placeholder="panchayath/municipality/corparation"
								class="validate[minSize[3],custom[onlyLetterSp]]" />
						</div>
					</div>
					<div class="inner-row">
						<div class="inputCl">
							<div class="inputH">City</div>
							<input type="text" name="city2" id="city2"
								placeholder="City"
								class="validate[minSize[3],custom[onlyLetterSp]]" />
						</div>
						<div class="tHolder">
							<div class="inputTx">District</div>
							<input type="text" name="district2" id="district2"
								placeholder="District"
								class="validate[minSize[3],custom[onlyLetterSp]]" />
						</div>
					</div>
					<div class="inner-row">
						<div class="inputCl">
							<div class="inputH">State</div>
							<input type="text"  name="state2" id="state2"
								placeholder="State"
								class="validate[minSize[3],custom[onlyLetterSp]]" />
						</div>
						<div class="tHolder">
							<div class="inputTx">Country</div>
							<input type="text"  name="country2" id="country2"
								placeholder="Country"
								class="validate[minSize[3],custom[onlyLetterSp]]" />
						</div>
					</div>
					<div class="inner-row">
						<div class="inputCl">
							<div class="inputH">Contact Number</div>
							<input type="text" name="pin2" id="pin2"
								placeholder="Contact Number"
								class="validate[custom[onlyNumberSp],minSize[10],maxSize[12]]" />
						</div>
					</div>
					<div class="inner-row">
						<div class="inputCl">
							<div class="inputH">Email</div>
							<input type="text" name="email2"
								id="email2" placeholder="Email"
								class="validate[funcCall[checkEmailValidation]]" />
						</div>
					</div>
					<div class="inner-row">
						<div class="inputCl">
							<div class="inputH">Occupation</div>
							<input type="text" name="occupation2"
								id="occupation2" placeholder="Occupation"
								class="validate[minSize[3],custom[onlyLetterSp]]" />
						</div>
					</div>
					<div class="inner-row">
						<div class="inputCl">
							<div class="inputH">Time to Call</div>
							<div class="info width100">
											<?php echo CHtml::dropDownList('timeFrom2',null,Utilities::getTime(),array('empty'=>'Time','class'=>'wid60 mR5')); ?>
											<?php echo CHtml::dropDownList('fromA2',null,Utilities::getMeridiem(),array('empty'=>'AM/PM','class'=>'wid50 mR5')); ?>	
										     <?php echo CHtml::dropDownList('timeTo2',null,Utilities::getTime(),array('empty'=>'Time','class'=>'wid60 mR5')); ?>
										     <?php echo CHtml::dropDownList('toA2',null,Utilities::getMeridiem(),array('empty'=>'AM/PM','class'=>'wid50')); ?>
							</div>
						</div>
					</div>
				</div>
			</li>
		</ul>
		
		<ul>
		<!--   
			<li>
				<div class="title">Who can view above detals</div>
				<div class="info">
					<div class="check">
						<input type="checkbox" name="reference[]" checked="checked"
							value="subscribers"><span>Subscribers</span>
					</div>
					<div class="check">
						<input type="checkbox" name="reference[]" value="request"><span>By
							Request</span>
					</div>
				</div>
			</li>
			-->
			<li><input type="button" name="cancelPhoto" id="cancelPhoto"
				value="Cancel" class="type2b mL5"
				onclick="javascript:closeOverlay();" /> <input type="submit"
				name="updatePhoto" id="updatePhoto" value="Update"
				class="type2b mL5" />
			</li>
		</ul>
		</article>
	</form>
	</section>
	
				
<script type="text/javascript">
$(document).ready(function(){
	
    $("#userContact").validationEngine('attach');

    $("input:reset").click(function() {       // apply to reset button's click event
        this.form.reset();                    // reset the form
        // clear the form error validations      
    	$("#userContact").validationEngine('hideAll');
         return false;                         // prevent reset button from resetting again
    });
    
  });


</script>						
			