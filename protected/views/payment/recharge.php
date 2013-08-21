<?php
/*
*
* $Id$
--------------------------------------------------------------------------------------------------------------------------
* Information contained in this file is the intellectual property of Ladbrokes Plc
* Copyright © 2012 MarryDorr. All Rights Reserved.
* ---------------------------------------------------------------------------------------------------------------------------
*
* @author  Dileep G
* @title recharge.php
* @description <Description of this class>
*  @filesource <URL>
*  @version <Revision>
*/
?>
    <?php $this->widget('application.widgets.menu.Leftmenu'); ?>
 <section class="data-contnr2">
        <h1 class="mB10">Recharge Now</h1>
		<p>
			Your account's validity is getting exhausted. To enjoy the exclusive benefits of and features of the site, please recharge now with Rs. 200. With this recharge you can use uninterrupted services for next three months. 
		</p>
        <ul class="accOverview mT12">
			<li>
				<div class="highYn">Recharge your account now!</div>
			</li>
			<li>
				<div class="onlyF">Only for </div>
				<div class="offerC">
					<span class="webRupee">Rs.</span>
					<div class="digH">200</div>
					<div class="forMh">For 3 Months</div>
				</div>
			</li>
		</ul>
		<form id="payment"  name="payment" method="post"  action="/payment/update">
		<ul class="accOverview mT10">
			<li>
				<h1>Activation Coupon</h1>
			</li>
			<li>
				<p>
					You can recharge your account with activation coupon and 15 digit PIN number. Contact the nearest <a href="#" >re-seller</a> to grab your activation coupon today.
				</p>
			</li>
			<li>
				<h4>Enter Your Pin Number Here </h4>
			</li>
			<li>
				<input type="text" name="coupon" class="validate[required,minSize[15],maxSize[15],funcCall[checkCoupon]]"/> 
				<?php echo CHtml::submitButton('Submit',array('class'=>'type3')); ?>
			</li>
			<li>
				<h4>or Call us +91 9400 005 005</h4>
			</li>
		</ul>
		</form>
    </section>
        	<!-- right menu -->
	<?php $this->widget('application.widgets.menu.Rightmenu'); ?> 
	<!-- right menu ends -->
	
	<script type="text/javascript">
$(document).ready(function(){
    $("#payment").validationEngine('attach');
});


function checkCoupon(field, rules, i, options){

	
	var sUnavailable = 'Coupon is not valid,please call us +91 9400 005 005.';
	var email = false;		
	$.ajax({
	type: 'POST',
	url: '/ajax/recoupon',
	dataType: 'json',
	cache: false,
	success: function(availability) {
	email = availability;
	
},
data: {coupon : field.val()},
async: false
});

			// return success status
		
	
		if (email == false) {
		return sUnavailable;
		}else{ 
			return true;
		}

}


</script>