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
* @title document.php
* @description <Description of this class>
*  @filesource <URL>
*  @version <Revision>
*/
?>
    <?php $this->widget('application.widgets.menu.Leftmenu'); ?>
	<section class="data-contnr2">
	<?php 
		$user = Yii::app()->session->get('user');
		$astro = $user->horoscopes;
		$partner = $user->partnerpreferences;
		?>
		<h1 class="mB10">Add your Grahanila </h1>
        <p>Take some time to fill up your Grahanila/astro details as it will help you get a life partner who matches you better. </p>
		<ul class="accOverview pmB10">
			<li>
				<h3 class="">Grahanila</h3>
			</li>
			<li class="">
					<?php if(isset($astro->horoscopeFile)) {?>
					<div class="grahanila">
					<img src="<?php echo Utilities::getHoroscope($user->marryId,$astro->horoscopeFile); ?>" alt="" width="500" height="500" />
					</div>
					<?php }?>
			</li>
			<li class="mT15">
				<div class="leftC">Zodiac sign</div>
				<div class="rightC">
					<strong>:</strong> <span><?php
					if(isset($astro->sign) && !empty($astro->sign))
					echo Utilities::getValueForIds(new SignsMaster(),$astro->sign,'signId');
					?>
					</span>
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
					<strong>:</strong> <span><?php 
					if(isset($astro->astrodate) && !empty($astro->astrodate))
					{
						$ast = AstrodateMaster::model()->findbyPk($astro->astrodate);
						echo $ast->name; 
					}
					?></span>
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
				
			<li class="mT8"><a class="type4"
		href="<?php echo Utilities::createAbsoluteUrl('contact','astroedit'); ?>"
		id="referenceEdit1">Edit Astro</a>
	</li>
		
		</ul>
    </section>
	<?php $this->widget('application.widgets.menu.Rightmenu'); ?>
	
	<script type="text/javascript">
$(document).ready(function(){
    $("#referenceEdit1").colorbox({iframe:true, width:"860", height:"900",overlayClose: false});
  });

</script>