<div class="subContent">
			<section class="subHead">
				<h1 class="width100">Edit Referance Contact Details</h1>
			</section><?php 
			$user = Yii::app()->session->get('user');
		$referenceList = $user->references;
		?>
			<section class="subContnr">
			<form id="userContact" name="userContact" method="post" action="/contact/referenceedit">
				<article class="section width100">
					
					<?php if(isset($referenceList))
			{
				$index = 0;
				if(is_array($referenceList))
		{
			foreach ($referenceList as $value) {
				?>
					
					<ul>
						<li>
							<div class="title">
								Referance Person <?php echo $index+1?>
							</div>
							<div class="info">
								<div class="inner-row">
									<div class="inputH">Name </div>
									<input type="text" value="<?php if(isset($value->referName)) echo $value->referName?>" name="<?php echo 'name'.$index?>" class="validate[minSize[3],custom[onlyLetterSp]]" id="<?php echo 'name'.$index?>" placeholder="Name" />
								</div>
								<div class="inner-row">
									<div class="inputH">House Name / No.</div>
									<input type="text" value="<?php if(isset($value->referHouseName)) echo $value->referHouseName?>" name="<?php echo 'house'.$index?>" id="<?php echo 'house'.$index?>" class="validate[minSize[3]]" placeholder="House Name / No." />
								</div>
								<div class="inner-row">
									<div class="inputCl">
										<div class="inputH">Place</div>
										<input type="text" value="<?php if(isset($value->referPlace)) echo $value->referPlace?>" name="<?php echo 'place'.$index?>" id="<?php echo 'place'.$index?>" class="validate[minSize[3],custom[onlyLetterSp]]"  placeholder="Place" />
									</div>
									<div class="tHolder">
										<div class="inputTx">Corporation/municipality/panchayath</div>
										<input type="text" value="<?php if(isset($value->referPostOffice))echo $value->referPostOffice?>" name="<?php echo 'post'.$index ?>"  id="<?php echo 'post'.$index ?>"  placeholder="panchayath/municipality/corparation" class="validate[minSize[3],custom[onlyLetterSp]]"   />
									</div>
								</div>
								<div class="inner-row">
									<div class="inputCl">
										<div class="inputH">City</div>
										<input type="text" name="<?php echo 'city'.$index?>" value="<?php if(isset($value->referCity)) echo $value->referCity?>" id="<?php echo 'city'.$index?>" placeholder="City" class="validate[minSize[3],custom[onlyLetterSp]]"/>
									</div>
									<div class="tHolder">
										<div class="inputTx">District</div>
										<input type="text" value="<?php if(isset($value->referDistrict))echo $value->referDistrict?>" name="<?php echo 'district'.$index?>" id="<?php echo 'district'.$index?>"  placeholder="District" class="validate[minSize[3],custom[onlyLetterSp]]"  />
									</div>
								</div>
								<div class="inner-row">
									<div class="inputCl">
										<div class="inputH">State</div>
										<input type="text" value="<?php if(isset($value->referState))echo $value->referState?>" name="<?php echo 'state'.$index?>" id="<?php echo 'state'.$index?>" placeholder="State" class="validate[minSize[3],custom[onlyLetterSp]]"   />
									</div>
									<div class="tHolder">
										<div class="inputTx">Country</div>
										<input type="text" value="<?php if(isset($value->referCountry))echo $value->referCountry?>" name="<?php echo 'country'.$index?>" id="<?php echo 'country'.$index?>" placeholder="Country" class="validate[minSize[3],custom[onlyLetterSp]]"   />
									</div>
								</div>
								<div class="inner-row">
									<div class="inputCl">
										<div class="inputH">Contact Number</div>
										<input type="text" value="<?php if(isset($value->referPostcode))echo $value->referPostcode?>" name="<?php echo 'pin'.$index?>" id="<?php echo 'pin'.$index?>" placeholder="Contact Number" class="validate[custom[onlyNumberSp],minSize[10],maxSize[12]]"  />
									</div>
								</div>
								<div class="inner-row">
									<div class="inputCl">
										<div class="inputH">Email</div>
										<input type="text" value="<?php if(isset($value->referEmail))echo $value->referEmail?>" name="<?php echo 'email'.$index?>" id="<?php echo 'email'.$index?>"  placeholder="Email" class="validate[funcCall[checkEmailValidation]]"/>
									</div>
								</div>
								<div class="inner-row">
									<div class="inputCl">
										<div class="inputH">Occupation</div>
										<input type="text" value="<?php if(isset($value->referOccupation))echo $value->referOccupation?>" name="<?php echo 'occupation'.$index?>" id="<?php echo 'occupation'.$index?>" placeholder="Occupation" class="validate[minSize[3],custom[onlyLetterSp]]"  />
									</div>
								</div>
								<div class="inner-row">
								<?php 
								
								$tme1 = 0;
								$am1 = 0;
								$tme2 = 0;
								$am2 = 0;
								if(isset($value->referCallFrom) && !empty($value->referCallFrom)){		
											$times = explode("-", $value->referCallFrom);
											if(isset($times[0]))
											{
												$time1 = explode(":", $times[0]);
												if(isset($time1))
												{
													$tme1 = $time1[0];
													$am1 = $time1[1];
												}
											}
											if(isset($times[1]))
											{
												$time2 = explode(":", $times[1]);
												if(isset($time2))
												{
													$tme2 = $time2[0];
													$am2 = $time2[1];
												}
											}
								}
										?>
									<div class="inputCl">
										<div class="inputH">Time to Call</div>
										<div class="info width100">
										<?php echo CHtml::dropDownList('timeFrom'.$index,null,Utilities::getTime(),array('empty'=>'Time','class'=>'wid60 mR5','options' => array($tme1 =>array('selected'=>true)))); ?>
											<?php echo CHtml::dropDownList('fromA'.$index,null,Utilities::getMeridiem(),array('empty'=>'AM/PM','class'=>'wid50 mR5','options' => array($am1 =>array('selected'=>true)))); ?>	
										     <?php echo CHtml::dropDownList('timeTo'.$index,null,Utilities::getTime(),array('empty'=>'Time','class'=>'wid60 mR5','options' => array($tme2 =>array('selected'=>true)))); ?>
										     <?php echo CHtml::dropDownList('toA'.$index,null,Utilities::getMeridiem(),array('empty'=>'AM/PM','class'=>'wid50','options' => array($am2 =>array('selected'=>true)))); ?>
										</div>
									</div>
								</div>
							</div>
						</li>
					</ul>
					
					<?php
					$index++;
					
			}
				}
				
				else if($referenceList instanceof Reference)
		{
			$index = 0;
			$value = $referenceList;

			?>
				
					<ul>
						<li>
							<div class="title">
								Referance Person <?php echo $index+1?>
							</div>
							<div class="info">
								<div class="inner-row">
									<div class="inputH">Name </div>
									<input type="text" value="<?php if(isset($value->referName)) echo $value->referName?>" name="<?php echo 'name'.$index?>" class="validate[minSize[3],custom[onlyLetterSp]]" id="<?php echo 'name'.$index?>" placeholder="Name" />
								</div>
								<div class="inner-row">
									<div class="inputH">House Name / No.</div>
									<input type="text" value="<?php if(isset($value->referHouseName)) echo $value->referHouseName?>" name="<?php echo 'house'.$index?>" id="<?php echo 'house'.$index?>" class="validate[minSize[3]]" placeholder="House Name / No." />
								</div>
								<div class="inner-row">
									<div class="inputCl">
										<div class="inputH">Place</div>
										<input type="text" value="<?php if(isset($value->referPlace)) echo $value->referPlace?>" name="<?php echo 'place'.$index?>" id="<?php echo 'place'.$index?>" class="validate[minSize[3],custom[onlyLetterSp]]"  placeholder="Place" />
									</div>
									<div class="tHolder">
										<div class="inputTx">Corporation/municipality/panchayath</div>
										<input type="text" value="<?php if(isset($value->referPostOffice))echo $value->referPostOffice?>" name="<?php echo 'post'.$index ?>"  id="<?php echo 'post'.$index ?>"  placeholder="panchayath/municipality/corparation" class="validate[minSize[3],custom[onlyLetterSp]]"   />
									</div>
								</div>
								<div class="inner-row">
									<div class="inputCl">
										<div class="inputH">City</div>
										<input type="text" name="<?php echo 'city'.$index?>" value="<?php if(isset($value->referCity)) echo $value->referCity?>" id="<?php echo 'city'.$index?>" placeholder="City" class="validate[minSize[3],custom[onlyLetterSp]]"/>
									</div>
									<div class="tHolder">
										<div class="inputTx">District</div>
										<input type="text" value="<?php if(isset($value->referDistrict))echo $value->referDistrict?>" name="<?php echo 'district'.$index?>" id="<?php echo 'district'.$index?>"  placeholder="District" class="validate[minSize[3],custom[onlyLetterSp]]"  />
									</div>
								</div>
								<div class="inner-row">
									<div class="inputCl">
										<div class="inputH">State</div>
										<input type="text" value="<?php if(isset($value->referState))echo $value->referState?>" name="<?php echo 'state'.$index?>" id="<?php echo 'state'.$index?>" placeholder="State" class="validate[minSize[3],custom[onlyLetterSp]]"   />
									</div>
									<div class="tHolder">
										<div class="inputTx">Country</div>
										<input type="text" value="<?php if(isset($value->referCountry))echo $value->referCountry?>" name="<?php echo 'country'.$index?>" id="<?php echo 'country'.$index?>" placeholder="Country" class="validate[minSize[3],custom[onlyLetterSp]]"   />
									</div>
								</div>
								<div class="inner-row">
									<div class="inputCl">
										<div class="inputH">Contact Number</div>
										<input type="text" value="<?php if(isset($value->referPostcode))echo $value->referPostcode?>" name="<?php echo 'pin'.$index?>" id="<?php echo 'pin'.$index?>" placeholder="Contact Number" class="validate[custom[onlyNumberSp],minSize[10],maxSize[12]]"  />
									</div>
								</div>
								<div class="inner-row">
									<div class="inputCl">
										<div class="inputH">Email</div>
										<input type="text" value="<?php if(isset($value->referEmail))echo $value->referEmail?>" name="<?php echo 'email'.$index?>" id="<?php echo 'email'.$index?>"  placeholder="Email" class="validate[funcCall[checkEmailValidation]]"/>
									</div>
								</div>
								<div class="inner-row">
									<div class="inputCl">
										<div class="inputH">Occupation</div>
										<input type="text" value="<?php if(isset($value->referOccupation))echo $value->referOccupation?>" name="<?php echo 'occupation'.$index?>" id="<?php echo 'occupation'.$index?>" placeholder="Occupation" class="validate[minSize[3],custom[onlyLetterSp]]"  />
									</div>
								</div>
								<div class="inner-row">
								<?php 
								
								$tme1 = 0;
								$am1 = 0;
								$tme2 = 0;
								$am2 = 0;
								if(isset($value->referCallFrom) && !empty($value->referCallFrom)){		
											$times = explode("-", $value->referCallFrom);
											if(isset($times[0]))
											{
												$time1 = explode(":", $times[0]);
												if(isset($time1))
												{
													$tme1 = $time1[0];
													$am1 = $time1[1];
												}
											}
											if(isset($times[1]))
											{
												$time2 = explode(":", $times[1]);
												if(isset($time2))
												{
													$tme2 = $time2[0];
													$am2 = $time2[1];
												}
											}
								}
										?>
									<div class="inputCl">
										<div class="inputH">Time to Call</div>
										<div class="info width100">
										<?php echo CHtml::dropDownList('timeFrom'.$index,null,Utilities::getTime(),array('empty'=>'Time','class'=>'wid60 mR5','options' => array($tme1 =>array('selected'=>true)))); ?>
											<?php echo CHtml::dropDownList('fromA'.$index,null,Utilities::getMeridiem(),array('empty'=>'AM/PM','class'=>'wid50 mR5','options' => array($am1 =>array('selected'=>true)))); ?>	
										     <?php echo CHtml::dropDownList('timeTo'.$index,null,Utilities::getTime(),array('empty'=>'Time','class'=>'wid60 mR5','options' => array($tme2 =>array('selected'=>true)))); ?>
										     <?php echo CHtml::dropDownList('toA'.$index,null,Utilities::getMeridiem(),array('empty'=>'AM/PM','class'=>'wid50','options' => array($am2 =>array('selected'=>true)))); ?>
										</div>
									</div>
								</div>
							</div>
						</li>
					</ul>
				<?php }?>
					<ul>
					<?php $privacy =  $user->privacy(array('condition'=>"items='reference'"));
						$alValues = array();
						if(isset($privacy[0]))
						{
							$alValue = $privacy[0];
							$alValues = $alValue->privacy;
						}
	?>
						<!-- 
						<li>
							<div class="title">
								Who can view above detals 
							</div>
							<div class="info">
								<div class="check">
								<input type="radio" name="reference" <?php if($alValues== 'subscribers') { ?> checked="checked"<?php }?> value="subscribers"><span>Subscribers</span>
								</div>
								<div class="check">
									<input type="radio" name="reference" <?php if($alValues == 'request') { ?> checked="checked"<?php }?> value="request"><span>By Request</span>
								</div>
							</div>
						</li>
						 -->
						<li>
						<input type="button" name="cancelPhoto" id="cancelPhoto" value="Cancel" class="type2b mL5" onclick="javascript:closeOverlay();" />
						<input type="submit" name="updatePhoto" id="updatePhoto" value="Update" class="type2b mL5" />
						</li>
					</ul>
					<?php }?>
				</article>
				</form>
			</section>

			
			
<script type="text/javascript">
$(document).ready(function(){
	<?php if($success) { ?>
	window.parent.location.reload();
<?php }?>
	
    $("#userContact").validationEngine('attach');

    $("input:reset").click(function() {       // apply to reset button's click event
        this.form.reset();                    // reset the form
        // clear the form error validations      
    	$("#userContact").validationEngine('hideAll');
         return false;                         // prevent reset button from resetting again
    });
    
  });


</script>						
			
			