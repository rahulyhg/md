
<?php $this->widget('application.widgets.menu.Leftmenu'); ?>


<?php if(isset($isHighLighted) && $isHighLighted == true ){?>
 <section class="data-contnr2">
					<h1 class="mB10">Highlight Your Profile</h1>
					<p>Your profile has been highlighted</p>	
</section>					
	<?php } else {?>
            <section class="data-contnr2">
        <h1 class="mB10">Highlight Your Profile</h1>
        <p>Highlighting your profile is the best way to attract more potential brides and grooms to your profile by increasing your visibility.  </p>
		<ul class="accOverview mT10">
			<li>
				<h3>Benefits of Highlighting</h3>
			</li>
			<li>
				<p>Increased visibility </p>
				<p>Better responses from the right candidates </p>
				<p>Chances of getting better match</p>
			</li>
		</ul>
		<form id="highlight"  name="highlight" method="post"  action="/highlight/update">
		<ul class="accOverview mT10">
			<li>
				<h1>Highlight</h1>
			</li>
			<li>
				<h4>Enter Your 15 digit PIN number to highlight profile </h4>
			</li>
			<li>
				<input type="text" name="coupon" class="validate[required,minSize[15],maxSize[15],funcCall[checkCoupon]]" /> <a  href="javascript:highlight.submit();" class="type3" >Submit</a>
			</li>
			<li>
				<h4>Activation Coupon </h4>
			</li>
			<li>
				<p>
					If you still have not got your activation coupon, talk to your 
					<a href="#" >nearest reseller</a> today, or call us at 5436876898
				</p>
			</li>
		</ul>
			</form>
    </section>
        <?php }?>
        
        	<?php $this->widget('application.widgets.menu.Rightmenu'); ?> 
	<script type="text/javascript">
$(document).ready(function(){
    $("#highlight").validationEngine('attach');
});
$("html").click(function(){ 
	$("#highlight").validationEngine('hide');    
	
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

	