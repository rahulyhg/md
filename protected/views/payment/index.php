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
* @title index.php
* @description <Description of this class>
*  @filesource <URL>
*  @version <Revision>
*/
?>
    <?php $this->widget('application.widgets.menu.Leftmenu'); ?>
 <section class="data-contnr2">
        <h1 class="mB10">Subscribe now</h1>
		<p>If you have not subscribed yet, this is the right time to make use of this key feature. Subscribing brings to you a host of advantages.</p>
		<ul class="accOverview ">
			<li>
				<h3>Benefits of Subscribing </h3>
			</li>
			<li>
				<p>Real time update about profile visitors </p>
				<p>Access key details of other users</p>
				<p>Contact candidates directly </p>
				<p>Message candidates directly </p>
			</li>
		</ul>
		<ul class="accOverview mT12">
			<li>
				<div class="highYn">Subscribe your account now!</div>
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
				<h1>How to subscribe</h1>
			</li>
			<li>
				<p>
					Enter your 15 digit PIN number below to subscribe. If you have not got your 15 digit PIN number contact the <a href="#" >nearest reseller</a> <br />or <strong> Call us +91 9400 005 005.</strong>
				</p>
			</li>
			<li>
				<h4>Enter Your Pin Number Here </h4>
			</li>
			<li>
				<input type="text" name="coupon" class="validate[required,minSize[15],maxSize[15],funcCall[checkCoupon]]"/> 
				<?php echo CHtml::submitButton('Submit',array('class'=>'type3')); ?>
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
	url: '/ajax/coupon',
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