<div class="subContent">
			<section class="subHead">
				<h1 class="tCenter">Access Request</h1>
			</section>
			<section class="subContnr">
			<div class="welcome-message">Welcome Guest!</div>
        <div class="user-login">
		<?php echo CHtml::beginForm(Utilities::createAbsoluteUrl('site','popuplogin'),'post',array('name'=>'LoginForm','id'=>'LoginForm'));?>
			<div class="login-contnr">
				<p>E-Mail / User ID</p>
					<input type="text" class="validate[required]"  tabindex="1"  id="user" name="LoginForm[username]"/>
				
			</div>
			<div class="login-contnr">
				<p>Password</p>
				<input type="password" class="validate[required]" tabindex="2" id="password" name="LoginForm[password]" />
			</div>
			<?php echo CHtml::submitButton('Login',array('class'=>'type2b','tabindex'=>'3')); ?>
		<?php echo CHtml::endForm(); ?>
		<?php   if ( isset(Yii::app()->params['loginError']) && !empty(Yii::app()->params['loginError']) ){ ?>
		<div class="logError" id="logError" style="display:block">
        <div class="tarrow"></div>
				<div class="cont">
					Invalid user credentials
				</div>
        </div>
        <?php }?>
				</div>
			</section>
			</form>
		</div>
		
<script type="text/javascript">
	function redirectUser(){
		parent.$.fn.colorbox.close();
		parent.window.location.href = "<?php echo Utilities::createAbsoluteUrl('site','index') ?>";
	}
	function loadPage()
	{
		window.parent.location.reload();
	}
$(document).ready(function(){
    $("#LoginForm").validationEngine('attach');
	 $(".user-login").click(function(){
    	$("#users-register-form").validationEngine('hide');
    	$("#keywordSearch").validationEngine('hide');
    });

	 <?php if(isset($success) and $success == true) {?>
		loadPage();
	<?php }?>
			
  });

$("html").click(function(){ 
    
	$("#logError").hide();
});

</script>