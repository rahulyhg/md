        <section class="top-sec">
			<div class="md-wrap">
				<ul class="welcome-contnr">
				<?php $userName = Yii::app()->session->get('username');?>
                <?php $user = Yii::app()->session->get('user');?>
				<?php if(isset($userName) && Yii::app()->controller->id != 'user') {?>
					<li>
						Welcome <?php echo $userName; echo " ".$user['marryId']?>
						| <a class="logout" href="/site/logout">Logout</a>
					</li>
					<li class="searchID">
						<a class="searchLink" href="javascript:void(0)" >Search By ID</a>
						<div class="sbID" style="display:none">
							<div class="arrow"></div>
							<div class="sbID-contnr">
								<form id="hkeywordSearch"  name="hkeywordSearch" method="get"  action="/search/byid">
									<input name="id" type="text" class="validate[required]"  placeholder="Search By ID" />
									<!--<input type="button" value="Search" />-->
									<?php echo CHtml::submitButton('Search',array('class'=>'type2b')); ?>
								</form>
							</div>
						</div>
					</li>
				<?php } elseif(isset($userName) && Yii::app()->controller->id == 'user' && (Yii::app()->controller->action->id != 'register') && Yii::app()->controller->action->id != 'contact') {?>
					<li class="wUsername">
						Welcome <?php echo $userName; echo " ".$user['marryId']?>
					</li>
				<?php } elseif(isset($userName) && Yii::app()->controller->id == 'user' && (Yii::app()->controller->action->id == 'register') || Yii::app()->controller->action->id == 'contact') {?>
				
				<?php } else {?>
					<li>
						Welcome Guest !
					</li>
					<li class="searchID">
						<a class="searchLink" href="javascript:void(0)" >Search By ID</a>
						<div class="sbID" style="display:none">
							<div class="arrow"></div>
							<div class="sbID-contnr">
								<form id="hkeywordSearch"  name="hkeywordSearch" method="get"  action="/search/byid">
									<input name="id" type="text" class="validate[required]"  placeholder="Search By ID" />
									<!--<input type="button" value="Search" />-->
									<?php echo CHtml::submitButton('Search',array('class'=>'type2b')); ?>
								</form>
							</div>
						</div>
					</li>
				<?php }?>
				</ul>
			</div>
		</section>
		<section class="main-sec">
			<div class="md-wrap">
				<h1 class="logo"></h1>
				<?php if(isset($userName) && Yii::app()->controller->id != 'user') {?>
					<!-- notification drop down -->
					<?php $this->widget('application.widgets.menu.Dropdownmenu'); ?> 
					<!-- drop down end -->
				<?php } elseif(isset($userName) && Yii::app()->controller->id == 'user') {?>
					
					
				<?php } else {?>
					<aside class="login-contnr">
					<?php echo CHtml::beginForm(Yii::app()->createUrl('site/login'),'post',array('name'=>'LoginForm','id'=>'LoginForm'));?>
						<div class="input-contnr">
							<input type="text" class="validate[required]"  tabindex="1"  id="user" name="LoginForm[username]"  placeholder="E-Mail / User ID"/>
						</div>
						<div class="input-contnr">
							<input type="password" class="validate[required]" tabindex="2" id="password" name="LoginForm[password]" placeholder="Password"/>
							<a href="/guest/forget" id="forgotPassword">Forgot Passord?</a>
						</div>
						<div class="input-contnr">
							<?php echo CHtml::submitButton('Login',array('class'=>'type2b','tabindex'=>'3')); ?>
						</div>
						<?php echo CHtml::endForm(); ?>
					</aside>
					<?php   if ( isset(Yii::app()->params['loginError']) && !empty(Yii::app()->params['loginError']) ){ ?>
						<div class="logError" id="logError" style="display:block">
							<div class="tarrow"></div>
							<div class="cont">
								Invalid user credentials
							</div>
						</div>
					<?php }?>
				<?php }?>
			</div>
		</section>
		
		<script type="text/javascript">
		$(document).ready(function(){
			$("#LoginForm").validationEngine('attach');
			//$("#LoginForm").validate();
			
			$("#hkeywordSearch").validationEngine('attach');
			
			$(".user-login").click(function(){
				$("#users-register-form").validationEngine('hide');
				$("#keywordSearch").validationEngine('hide');
				
			});
			$("#forgotPassword").colorbox({iframe:true, width:"850", height:"355"});
		});
		
		$("html").click(function(){ 
			$("#logError").hide();
		});
		
		</script>