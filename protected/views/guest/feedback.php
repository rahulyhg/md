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
* @title feedback.php
* @description <Description of this class>
*  @filesource <URL>
*  @version <Revision>
*/
?>

		<div class="subContent">
			<section class="subHead">
				<h1>Feedback</h1>
			</section>
			
			<?php if(isset($submit))
			{ ?>
				<section class="subContnr">
				<ul class="accOverview pTB15">
					<li class="mT15">
					Thanks for sharing your feedback , we will keep on trying to incorporate you valuable suggestions/feedback.
					</li>
				</ul>
				</section>
				
		<?php }
			else{
			?>
			
			
			<section class="subContnr">
			<form id="feedback" name="feedback" method="post"  action="/guest/feedback">
				<ul class="accOverview pTB15">
					<li class="mT15">
						<p>1. How do you rate the user friendliness of the site?</p>
						<div class="radio wid120">
							<input type="radio" value="1" name="friendliness" > <span>Poor</span>
						</div>
						<div class="radio wid120">
							<input type="radio" value="2" name="friendliness" > <span>Bad</span>
						</div>
						<div class="radio wid120">
							<input type="radio" value="3" name="friendliness" > <span>Average</span>
						</div>
						<div class="radio wid120">
							<input type="radio" value="4" name="friendliness" > <span>Good</span>
						</div>
						<div class="radio wid120">
							<input type="radio" value="5" name="friendliness" > <span>Excellent</span>
						</div>
					</li>
					<li class="mT15">
						<p>2. How would you describe marrydoor services in one word?</p>
						<div class="radio wid120">
							<input type="radio" value="1" name="service"  > <span>Poor</span>
						</div>
						<div class="radio wid120">
							<input type="radio" value="2" name="service"> <span>Bad</span>
						</div>
						<div class="radio wid120">
							<input type="radio" value="3" name="service"> <span>Average</span>
						</div>
						<div class="radio wid120">
							<input type="radio" value="4" name="service"> <span>Good</span>
						</div>
						<div class="radio wid120">
							<input type="radio" value="5" name="service"> <span>Excellent</span>
						</div>
					</li>
					<li class="mT15">
						<p>3. How do you rate our privacy measures?</p>
						<div class="radio wid120">
							<input type="radio" value="1" name="privacy" > <span>Poor</span>
						</div>
						<div class="radio wid120">
							<input type="radio" value="2" name="privacy"> <span>Bad</span>
						</div>
						<div class="radio wid120">
							<input type="radio" value="3" name="privacy"> <span>Average</span>
						</div>
						<div class="radio wid120">
							<input type="radio" value="4" name="privacy"> <span>Good</span>
						</div>
						<div class="radio wid120">
							<input type="radio" value="5" name="privacy"> <span>Excellent</span>
						</div>
					</li>
					<li class="mT15">
						<p>4. How good is our payment method?  </p>
						<div class="radio wid120">
							<input type="radio" value="1" name="payment"> <span>Poor</span>
						</div>
						<div class="radio wid120">
							<input type="radio" value="2" name="payment"> <span>Bad</span>
						</div>
						<div class="radio wid120">
							<input type="radio" value="3" name="payment"> <span>Average</span>
						</div>
						<div class="radio wid120">
							<input type="radio" value="4" name="payment"> <span>Good</span>
						</div>
						<div class="radio wid120">
							<input type="radio" value="5" name="payment"> <span>Excellent</span>
						</div>
					</li>
					<li class="mT15">
						<p>5. How good is our resellers?  </p>
						<div class="radio wid120">
							<input type="radio" value="1" name="reseller"> <span>Poor</span>
						</div>
						<div class="radio wid120">
							<input type="radio" value="2" name="reseller"> <span>Bad</span>
						</div>
						<div class="radio wid120">
							<input type="radio" value="3" name="reseller"> <span>Average</span>
						</div>
						<div class="radio wid120">
							<input type="radio" value="4" name="reseller"> <span>Good</span>
						</div>
						<div class="radio wid120">
							<input type="radio" value="5" name="reseller"> <span>Excellent</span>
						</div>
					</li>
					
				</ul>
				<ul class="accOverview pTB15">
					<li class="mT15">
						<div class="feedQ">Name</div>
						<div class="feedA"><input type="text" name="name"/></div>
					</li>
					<li>
						<div class="feedQ">Email</div>
						<div class="feedA"><input type="text" name="email"/></div>
					</li>
					<li>
						<div class="feedQ">Feedback</div>
						<div class="feedA">
							<select name="feedType">
								<option>Sugestion</option>
								<option>Complaint</option>
							</select>
						</div>
					</li>
					<li>
						<div class="feedQ">Message</div>
						<div class="feedA">
							<textarea name="message"></textarea>
						</div>
					</li>
					<li>
						<input type="reset" value="Reset" class="type1b mR5"> 
						<input type="submit" value="Submit" class="type1b mL5">
					</li>
				</ul>
				</form>
			</section>
			<?php }?>
		