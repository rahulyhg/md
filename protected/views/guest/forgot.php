
		<div class="subContent">
			<section class="subHead">
				<h1 class="tCenter">Forgot Your Password?</h1>
			</section>
			<section class="subContnr">
					
				<ul class="accOverview mT40">
				<?php if(isset($sent) && $sent == true) {?>
					<li>
						<p class="tCenter">
							We have mailed your password to your registered E-mail Id.
						</p>
						<p class="tCenter">
							Please login with new password. 
						</p>
						
					</li>
				
				<?php } 
				else if(isset($sent) && $sent == false) {
				?>
					<li>
						<p class="tCenter">
							The email id you provided doesn't match our records,please call us +91 9400 005 005. 
						</p>
						<form id="forget" name="forget" method="post" action="/guest/forget">
						<div class="visitorBtnC">
							<input class="floatN" type="text" name="email"/> <span id="submit"> <a href="#" class="visitCnt">Submit</a></span>
						</div>
						</form>
						
					</li>
									
				<?php } else {?>
					<li>
						<p class="tCenter">
							Submit your registered E-mail Id.
						</p>
						<p class="tCenter">
							We will mail your password to your registered E-mail Id. 
						</p>
						<form id="forget" name="forget" method="post" action="/guest/forget">
						<div class="visitorBtnC">
							<input class="floatN" type="text" name="email"/> <span id="submit"> <a href="#" class="visitCnt">Submit</a></span>
						</div>
						</form>
					</li>
					<?php }?>
				</ul>
			</section>
		</div>
		
		<script type="text/javascript">
		$('#submit').click(function() {
			
		$("#forget").submit();
		
		});
		</script>