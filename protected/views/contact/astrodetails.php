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
* @title astrodetails.php
* @description <Description of this class>
*  @filesource <URL>
*  @version <Revision>
*/
?>


		<div class="subContent">
			<section class="subHead">
				<h1 ><?php echo $model->name?> <?php echo $model->marryId?></h1>
					<?php $astro = $model->horoscopes;
					$partner = $model->partnerpreferences; ?>
				<h5>Viewing Grahanila</h5>
			</section>
			<section class="subContnr">
				<ul class="accOverview pmB10">
					<li class="mT15">
						<?php if(isset($astro->horoscopeFile)) {?>
							<div>
							<img id="imgSrc" name="imgSrc" alt="" src="<?php echo Utilities::getHoroscope($user->marryId, $astro->horoscopeFile);?>">
							</div>
							<?php } ?>
					</li>
					<li class="mT15">
						<div class="leftC">Zodiac sign</div>
						<div class="rightC">
							<strong>:</strong> <span><?php
					if(isset($astro->sign) && !empty($astro->sign))
					echo Utilities::getValueForIds(new SignsMaster(),$astro->sign,'signId');
					?></span>
						</div>
					</li>
					<li>
				<div class="leftC">Date </div>
				<div class="rightC">
					<strong>:</strong> <span><?php 
					if(isset($astro->dob))
					{
						echo $astro->dob; 
					}
					?></span>
				</div>
			</li>
					<li>
						<div class="leftC">Birth sign</div>
						<div class="rightC">
							<strong>:</strong> <span><?php if(isset($astro->astrodate) && !empty($astro->astrodate))
					{
						$ast = AstrodateMaster::model()->findbyPk($astro->astrodate);
						echo $ast->name; 
					}?></span>
						</div>
					</li>
					<li>
						<div class="leftC">Chovvadosham</div>
						<div class="rightC">
						<?php $chova = Utilities::getChova() ?>
							<strong>:</strong> <span><?php  if(isset($astro->dosham)) echo $chova[$astro->dosham]; ?></span>
						</div>
					</li>
						<li>
				<div class="leftC">Country of birth</div>
				<div class="rightC">
					<strong>:</strong> <span><?php 
					if(isset($astro->country))
					{
						$country = Country::model()->findbyPk($astro->country);
						echo $country->name; 
					}
					?></span>
				</div>
			</li>
			<li>
				<div class="leftC">State of birth</div>
				<div class="rightC">
					<strong>:</strong> <span><?php 
					if(isset($astro->state))
					{
						$state = States::model()->findbyPk($astro->state);
						echo $state->name; 
					}
					?></span>
				</div>
			</li>
			<li>
				<div class="leftC">City of birth</div>
				<div class="rightC">
					<strong>:</strong> <span><?php 
					if(isset($astro->city))
					{
						echo $astro->city; 
					}
					?></span>
				</div>
			</li>
			<li>
				<div class="leftC">Time</div>
				<div class="rightC">
					<strong>:</strong> <span><?php 
					if(isset($astro->time))
					{
						echo $astro->time; 
					}
					?></span>
				</div>
			</li>
			<li>
				<div class="leftC">Language</div>
				<div class="rightC">
					<strong>:</strong> <span><?php 
					if(isset($astro->motherTounge))
					{
						$lang = Languages::model()->findbyPk($astro->motherTounge);
						if(isset($lang))
						echo $lang->name; 
					}
					?></span>
				</div>
			</li>
			<li>
				<div class="leftC">Chovvadosham</div>
				<div class="rightC">
				<?php $chova = Utilities::getChova() ?>
					<strong>:</strong> <span><?php  if(isset($astro->dosham)) echo $chova[$astro->dosham]; ?></span>
				</div>
			</li>
			<li>
				<div class="leftC">Sudha</div>
				<div class="rightC">
				<?php $sudha = Utilities::getSudham() ?>
					<strong>:</strong> <span><?php  if(isset($astro->sudham)) echo $sudha[$astro->sudham]; ?></span>
				</div>
			</li>
				</ul>
				
			</section>
	