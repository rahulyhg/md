<div class="subContent">
			<section class="subHead">
				<h1 class="width100">Edit my astro details</h1>
			</section>
			<?php 
			$user = Yii::app()->session->get('user');
			if(isset($user->horoscopes))
			$astro = $user->horoscopes;
			else
			$astro = new Horoscopes();
		?>
			<section class="subContnr">
			<form id="userHoro" enctype="multipart/form-data" name="userHoro" method="post"  action="/contact/astroedit">
				<ul class="accOverview pmB10">
					<li class="mT15">
						<div class="leftC">
							
							<div class="uCan">You can upload Image file only</div>
							<div class="uploadCn">
							<input type="file" name="horoscopeFile" id="horoscopeFile" />
							</div>
						</div>
						<div class="rightC">
						<?php if(isset($astro->horoscopeFile)) {?>
							<div>
							<img id="imgSrc" name="imgSrc" alt="" src="<?php echo Utilities::getHoroscope($user->marryId, $astro->horoscopeFile);?>">
							</div>
							<?php } ?>
						</div>
					</li>
				</ul>
				<article class="section width100 no-padd">
					<ul>
						<li>
							<div class="title">
								Date of Birth
							</div>
							<?php 
							$user = Yii::app()->session->get('user');
							if(isset($astro->dob))
							$date = new DateTime($astro->dob);
							else
							$date = new DateTime($user->dob);
							?>
				
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
								echo CHtml::dropDownList('country',null,$list,array('empty' => 'Country','class'=>'wid220','options' => array($astro->country =>array('selected'=>true)))); ?>
					
								
							</div>
						</li>
						<li>
							<div class="title">
								State of Birth
							</div>
							<div class="info">
								<?php $records = States::model()->findAll("active = 1");
		$list = CHtml::listData($records, 'stateId', 'name');
		echo CHtml::dropDownList('state',null,$list,array('empty' => 'State','class'=>'wid220','options' => array($astro->state =>array('selected'=>true)))); ?>	
							</div>
						</li>
						<li>
							<div class="title">
								City of Birth
							</div>
							<div class="info">
								<input type="text" name="city" value="<?php echo $astro->city?>"id="city" placeholder="Place of Birth" />
								
							</div>
						</li>
						<li>
							<div class="title">
								Language
							</div>
							<div class="info">
								<?php $records = Languages::model()->findAll("active = 1");
		$list = CHtml::listData($records, 'languageId', 'name');
		echo CHtml::dropDownList('motherTounge',null,$list,array('empty' => 'Language','class'=>'wid220','options' => array($astro->motherTounge =>array('selected'=>true)))); ?>
							</div>
						</li>
						<li>
							<div class="title">
								Time Correction  
							</div>
							<?php 
							if(isset($astro->time) && !empty($astro->time))
							{
								$am = explode(",", $astro->time);
								$time = explode("-", trim($am[0]));
							?>	
							<div class="info">
								<?php echo CHtml::dropDownList('hours',null,Utilities::getTime(),array('empty'=>'Hour','class'=>'wid70 mR5','options' => array($time[0] =>array('selected'=>true)))); ?>
								<?php echo CHtml::dropDownList('minutes',null,Utilities::getMinutes(),array('empty'=>'Minutes','class'=>'wid70 mR5','options' => array($time[1] =>array('selected'=>true)))); ?>
								<?php echo CHtml::dropDownList('seconds',null,Utilities::getMinutes(),array('empty'=>'Seconds','class'=>'wid70 mR5','options' => array($time[2] =>array('selected'=>true)))); ?>
								<?php echo CHtml::dropDownList('am',null,Utilities::getMeridiem(),array('empty'=>'AM/PM','class'=>'wid50 mR5','options' => array($am[1] =>array('selected'=>true)))); ?>	
							</div>
							<?php 	
							}		
							else {				
							?>
							
							<div class="info">
								<?php echo CHtml::dropDownList('hours',null,Utilities::getTime(),array('empty'=>'Hour','class'=>'wid70 mR5')); ?>
								<?php echo CHtml::dropDownList('minutes',null,Utilities::getMinutes(),array('empty'=>'Minutes','class'=>'wid70 mR5')); ?>
								<?php echo CHtml::dropDownList('seconds',null,Utilities::getMinutes(),array('empty'=>'Seconds','class'=>'wid70 mR5')); ?>
								<?php echo CHtml::dropDownList('am',null,Utilities::getMeridiem(),array('empty'=>'AM/PM','class'=>'wid50 mR5')); ?>	
							</div>
							<?php } ?>
						</li>
						<li>
							<div class="title">
								Your Sign
							</div>
							<div class="info">
								 <?php $records = SignsMaster::model()->findAll("active = 1");
					$list = CHtml::listData($records, 'signId', 'name');
					echo CHtml::dropDownList('sign',null,$list,array('empty' => 'Sign','class'=>'wid220','options' => array($astro->sign =>array('selected'=>true)))); ?>
					
								
							</div>
						</li>
						<li>
							<div class="title">
								Your Astrodate
							</div>
							<div class="info">
								<?php $records = AstrodateMaster::model()->findAll("active = 1");
					$list = CHtml::listData($records, 'astrodateId', 'name');
					echo CHtml::dropDownList('astrodate',null,$list,array('empty' => 'Astrodate','class'=>'wid220','options' => array($astro->astrodate =>array('selected'=>true)))); ?>		
						
								
							</div>
						</li>
						<li>
							<div class="title">
								Chovva Dosham
							</div>
							<div class="info">
								<div class="radio wid90">
							<input name="chova" type="radio" <?php if($astro->dosham == '1') {?> checked="checked" <?php } ?> value="1"> <span>Yes</span>
						</div>
						<div class="radio wid90">
							<input name="chova" type="radio" <?php if($astro->dosham == '0') {?> checked="checked" <?php } ?>  value="0"> <span>No</span>
						</div>
						<div class="radio wid90">
							<input name="chova" type="radio" <?php if($astro->dosham == '2') {?> checked="checked" <?php } ?>   value="2"><span>Don't Know</span>
						</div>
							</div>
						</li>
						<li>
							<div class="title">
								Sudha Jathakam
							</div>
							<div class="info">
								<div class="radio wid90"> 
							 <input name="sudha" type="radio" <?php if($astro->sudham == '1') {?> checked="checked" <?php } ?> value="1"> <span>Yes</span>
						</div>
						<div class="radio wid90">
							 <input name="sudha" type="radio" <?php if($astro->sudham == '0') {?> checked="checked" <?php } ?>  value="0"> <span>No</span>
						</div>
						<div class="radio wid90">
							 <input name="sudha" type="radio" <?php if($astro->sudham == '2') {?> checked="checked" <?php } ?>  value="2"> <span>Don't Know</span>
						</div>
							</div>
						</li>
						<!-- 
						<li>
						<?php  $privacy =  $user->privacy(array('condition'=>"items='astro'"));
						$alValues = array();
						if(isset($privacy[0]))
						{
							$alValue = $privacy[0];
							$alValues = explode(',',$alValue->privacy);
						}
						
						?>
							<div class="title">
								Who can view my astro details
							</div>
							<div class="info">
								<div class="check">
							<input type="checkbox" name="astro[]" checked="checked"  <?php if(in_array('all', $alValues)) { ?> checked="checked"<?php }?> id="astro_0" value="all"><span>All</span>
						</div>
						<div class="check">
							<input type="checkbox" name="astro[]" <?php if(in_array('subscribers', $alValues)) { ?> checked="checked"<?php }?> id="astro_0" value="subscribers"> <span>Subscribers</span>
						</div>
						<div class="check">
							<input type="checkbox" name="astro[]" <?php if(in_array('member', $alValues)) { ?> checked="checked"<?php }?> id="astro_0" value="member"> <span>Loged Members</span>
						</div>
						<div class="check">
							<input type="checkbox" name="astro[]" <?php if(in_array('request', $alValues)) { ?> checked="checked"<?php }?> id="astro_0" value="request"> <span>By Request</span>
						</div>
							</div>
						</li>
						 -->
						<li>
							<input type="button" name="cancelPhoto" id="cancelPhoto" value="Cancel" class="type2b mL5" onclick="javascript:closeOverlay();" />
							<input type="submit" name="updatePhoto" id="updatePhoto" value="Update" class="type2b mL5" />
						</li>
					</ul>
				</article>
				</form>
			</section>
			
			<script type="text/javascript">
$(document).ready(function(){
	<?php if($edit) { ?>
	window.parent.location.reload();
	
<?php }?>
});  

</script>		