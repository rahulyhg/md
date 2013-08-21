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
* @title editcontact.php
* @description <Description of this class>
*  @filesource <URL>
*  @version <Revision>
*/
?>
<?php $this->widget('application.widgets.menu.Leftmenu'); ?>
    <section class="data-contnr3">
    <?php $user = Yii::app()->session->get('user');?>
    <form id="userContact" name="userContact" method="post" action="/mypage/editcontact">
		<article class="section">
			<ul class="no-padd">
				<li class="mT5">
					<h1 class="message">Edit my Contact details</h1>
				</li>
			</ul>
		<ul>		
	<li>
	<?php $address = Address::model()->findAll(array('condition'=> "userId = {$user->userId} and addresType = 0"));
	$caddress = null;	
	if(isset($address) && isset($address[0]))				
	$caddress = $address[0];
					?>
						
		<div class="title">
			Communication Address <span class="sup">*</span>
		</div>
		<div class="info">
			<div class="inner-row">
			<input type="text" value="<?php if(isset($caddress->houseName))echo $caddress->houseName ?>" name="house" id="house" class="validate[required,minSize[3],custom[onlyLetterSp]]"
						placeholder="House Name / No." />
			</div>
			<div class="inner-row">
			<input type="text" value="<?php if(isset($caddress->place))echo $caddress->place?>" name="houseplace" id="houseplace" class="validate[required,minSize[3],custom[onlyLetterSp]]"
						placeholder="Place" />
			</div>
			<div class="inner-row">
			<input type="text" name="housecity" id="city" class="validate[required]" value="<?php if(isset($caddress->city))echo $caddress->city?>"
						placeholder="City" />
				<input type="text" name="housedistrict" value="<?php if(isset($caddress->district)) echo $caddress->district?>" id="housedistrict" class="validate[required,minSize[3],custom[onlyLetterSp]]"
						placeholder="District" />
			</div>
			<div class="inner-row">
				<input type="text" name="housestate" value="<?php if(isset($caddress->state)) echo $caddress->state?>" id="statec" class="validate[required,minSize[3],custom[onlyLetterSp]]"
						placeholder="State" />
				<input type="text" name="housecountry" id="housecountry" value="<?php if(isset($caddress->country)) echo $caddress->country?>" class="validate[required,minSize[3],custom[onlyLetterSp]]"
						placeholder="Country" />
			</div>
			<div class="inner-row">
				<input type="text" name="postcode" id="postcode" value="<?php if(isset($caddress->pincode)) echo $caddress->pincode?>" class="validate[required,custom[onlyNumberSp],minSize[6],maxSize[6]]"
						placeholder="Post Code" />
			</div>
		</div>
	</li>
	<?php $address = Address::model()->findAll(array('condition'=> "userId = {$user->userId} and addresType = 1"));
	$paddress = null;
	if(isset($address) && isset($address[0]))				
	$paddress = $address[0];
					?>
	<li>
		<div class="title">Permanent Address</div>
		<div class="info">
			<div class="inner-row">
			<input type="text" name="house1" id="housep" value="<?php if(isset($paddress->houseName))echo $paddress->houseName ?>" class="validate[minSize[3],custom[onlyLetterSp]]"
						placeholder="House Name / No." />
			</div>
			<div class="inner-row">
			<input type="text" name="houseplace1" id="placep" class="validate[minSize[3],custom[onlyLetterSp]]" value="<?php if(isset($paddress->place)) echo $paddress->place ?>"
						placeholder="Place" />
			</div>
			<div class="inner-row">
			<input type="text" name="housecity1" id="cityp" class="validate[minSize[3],custom[onlyLetterSp]]" value="<?php if(isset($paddress->city)) echo $paddress->city ?>"
						placeholder="City" />
				<input type="text" name="housedistrict1" id="districtp" class="validate[minSize[3],custom[onlyLetterSp]]" value="<?php if(isset($paddress->district))echo $paddress->district?>"
						placeholder="District" />
			</div>
			<div class="inner-row">
				<input type="text" name="housestate1" id="statep" class="validate[minSize[3],custom[onlyLetterSp]]" value="<?php if(isset($paddress->state))echo $paddress->state ?>"
						placeholder="State" />
				<input type="text" name="housecountry1" id="countryp" class="validate[minSize[3],custom[onlyLetterSp]]" value="<?php if(isset($paddress->country)) echo $paddress->country?>"
						placeholder="Country" />
			</div>
			<div class="inner-row">
				<input type="text" name="postcode1" id="postcodep" class="validate[custom[onlyNumberSp],minSize[6],maxSize[6]]" value="<?php if(isset($paddress->pincode)) echo $paddress->pincode?>" 
						placeholder="Post Code" />
			</div>
		</div>
	</li>
	<li>
		<div class="title">Mobile No.</div>
		
		<div class="info">
			<input value="<?php if(isset($user->userpersonaldetails)) echo $user->userpersonaldetails->mobilePhone ?>" type="text" name="mobile" id="mobile" class="validate[required,minSize[10]]" /> 
		</div>
	</li>
	
	<li>
		<div class="title">Altranative Mobile No.</div>
		<div class="info">
<input type="text" name="alterMobile" id="alterMobile" value="<?php if(isset($user->usercontactdetails)) echo $user->usercontactdetails->alternativeNo ?>"
							 /> 
		</div>
	</li>
	<li>
		<div class="title">Facebook URL</div>
		<div class="info">
			<input type="text" value="<?php echo $user->usercontactdetails->facebookUrl?>"
							name="facebook" id="facebook" /> 
		</div>
	</li>
	<li>
		<div class="title">Skype</div>
		<div class="info">
			<input value="<?php echo $user->usercontactdetails->skypeId ?>"
							type="text" name="skype" id="skype" /> 
		</div>
	</li>
	<li>
		<div class="title">Google IM</div>
		<div class="info">
			<input value="<?php echo $user->usercontactdetails->googleIM?>"
							type="text" name="google" id="google" /> 
		</div>
	</li>
	<li>
		<div class="title">Yahoo IM</div>
		<div class="info">
			<input value="<?php echo $user->usercontactdetails->yahooIM ?>"
							type="text" name="yahoo" id="yahoo" />
		</div>
	</li>
	<!-- 
	<li>
	<?php $privacy =  $user->privacy(array('condition'=>"items='contact'"));
	$alValues = array();
	if(isset($privacy[0])){
	$alValue = $privacy[0];
	$alValues = $alValue->privacy;
	}
	?>
		<div class="title">Who can view above detals</div>
		<div class="info">
		<div class="check">
							<input type="radio" name="pcontact" <?php if($alValues== 'subscribers') { ?> checked="checked"<?php }?>value="subscribers"><span>Subscribers</span>
						</div>
		
			<div class="check">
				<input type="radio" name="pcontact" <?php if($alValues == 'request') { ?> checked="checked"<?php }?> value="request"> <span>By Request</span>
			</div>
		</div>
	</li>
	 -->
	<li>
					<div class="buttonContnr3">
						<input type="submit" value="Submit" name="yt0" class="type1b mL5">
					</div>
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