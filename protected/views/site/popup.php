<div class="subContent">
			<section class="subHead">
				<h1 class="tCenter">Access Request</h1>
			</section>
			<form name="frmRequest" method = "post" action = "<?php echo Utilities::createAbsoluteUrl('request','popup') ?>" >
			<input type = "hidden" name="profileId" value = "<?php echo $profileId ; ?>" />
			<input type = "hidden" name="action" value = "<?php echo $action ; ?>" />
			<input type = "hidden" name="module" value = "<?php echo $module ; ?>" />
			<section class="subContnr">
				<ul class="accOverview mTB20">
					<li>

						<p class="tCenter">
						<?php if($action == 'login'){?>
							<?php if($module == 'document'){?>
							The document you are trying to view is protected from public views. To view the details, please log in to you marrydoor.com account.
							<?php }elseif($module == 'album'){?>
							The album you are trying to view is protected from public views. To view the details, please log in to you marrydoor.com account.
							<?php }elseif($module == 'contact'){?>
							The contact you are trying to view is protected from public views. To view the details, please log in to you marrydoor.com account.
							<?php }elseif($module == 'reference'){?>
							The reference you are trying to view is protected from public views. To view the details, please log in to you marrydoor.com account.
							<?php }elseif($module == 'astro'){?>
							The astro you are trying to view is protected from public views. To view the details, please log in to you marrydoor.com account.
							<?php }?>
						<?php }else{?>
						<?php if($module == 'document'){?>
							The document you are trying to view is protected. In order to see the documents, please subscribe.
							<?php }elseif($module == 'album'){?>
							The album you are trying to view is protected. In order to see the albums, please subscribe.
							<?php }elseif($module == 'contact'){?>
							The contact you are trying to view is protected. In order to see the contacts, please subscribe.
							<?php }elseif($module == 'reference'){?>
							The reference you are trying to view is protected. In order to see the references, please subscribe.
							<?php }elseif($module == 'astro'){?>
							The astro you are trying to view is protected. In order to see the astro, please subscribe.
							<?php }?>
						<?php }?>
						</p>
						<div class="unlock"></div>
						<?php if($action == 'login'){ ?>
						<p class="tCenter">
							To get access to view this 
							<?php if($module == 'document'){?>
							documents
							<?php }elseif($module == 'contact'){?>
							contact
							<?php }elseif($module == 'reference'){?>
							reference
							<?php }elseif($module == 'astro'){?>
							astro
							<?php }elseif($module == 'album'){?>
							album
							<?php }?>
							, login now.
						</p>
						<?php }?>
						<div class="visitorBtnC">
						<?php if($action == 'request'){?>
							<input type="submit" name="sendRequest" id="sendRequest" value="Send Request" class="type2b" />
							<?php }elseif($action == 'login'){ ?>
							<a href="<?php echo Utilities::createAbsoluteUrl('site','popuplogin',array()); ?>" class="visitCnt" >Login Now</a>
							<a href="#" class="visitCnt" onclick="javascript:redirectUser('<?php echo Utilities::createAbsoluteUrl('site','index',array()); ?>');">I am not a member yet</a>
							<?php }elseif($action == 'subscribe'){ ?>
							<a href="#" class="visitCnt" onclick="javascript:redirectUser('<?php echo Utilities::createAbsoluteUrl('payment','index') ?>');">Subscribe Now</a>
						<?php }?>
						</div>
				</ul>
			</section>
			</form>
		</div>
		
<script type="text/javascript">
	function redirectUser(url){
		parent.$.fn.colorbox.close();
		parent.window.location.href = url;
	}
</script>