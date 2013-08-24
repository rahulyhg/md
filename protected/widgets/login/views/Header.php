        
        <a href="http://marrydoor.com" class="logo" ></a>
                <?php $userName = Yii::app()->session->get('username');?>
                <?php $user = Yii::app()->session->get('user');?>
 <?php if(isset($userName)) {?>
 			<!-- notification drop down -->
 			<?php $this->widget('application.widgets.menu.Dropdownmenu'); ?> 
 			<!-- drop down end -->
  			<div class="welcome-message">
  			<span class="color">
  			<?php echo $userName; echo " ".$user['marryId']?> 
  			</span>
  			|
  			<a class="logout" href="/site/logout">Logout</a></div>
  			<!-- search box -->
  			<div class="search-container">
			<form id="hkeywordSearch"  name="hkeywordSearch" method="get"  action="/search/byid">
            <input name="id" type="text" class="validate[required]"  placeholder="Search By ID" />
            <?php echo CHtml::submitButton('Search',array('class'=>'type2b')); ?>
			</form>	
            </div>
            <!-- search box end -->
  			<?php } else {?>
  			   <div class="welcome-message">Welcome Guest!</div>
			  			
        <div class="user-login">
        
<?php echo CHtml::beginForm(Yii::app()->createUrl('site/login'),'post',array('name'=>'LoginForm','id'=>'LoginForm'));?>
			<div class="login-contnr">
				<p>Email / User ID</p>
					<input type="text" class="validate[required]"  tabindex="1"  id="user" name="LoginForm[username]"/>
				
				<a href="/guest/user">New User?</a>
			</div>
			<div class="login-contnr">
				<p>Password</p>
				<input type="password" class="validate[required]" tabindex="2" id="password" name="LoginForm[password]" />
				<a href="/guest/forget" id="forgotPassword">Forgot Password?</a>
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
		<?php }?>

		
		
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