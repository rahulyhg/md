<footer>
	<div class="md-wrap">
		<p class="footer-link">
			<a class="iframe" href="<?php echo Utilities::createAbsoluteUrl('guest','about'); ?>" id="footerPops">About us</a> |
			<a class="iframe" href="<?php echo Utilities::createAbsoluteUrl('guest','contact'); ?>" id="footerPops">Contact Us</a> |
			<a class="iframe" href="<?php echo Utilities::createAbsoluteUrl('guest','faq'); ?>" id="footerPops">FAQ's</a> |
			<a class="iframe" href="<?php echo Utilities::createAbsoluteUrl('guest','feedback'); ?>" id="footerPops">Feedback</a> |
			<a class="iframe" href="<?php echo Utilities::createAbsoluteUrl('guest','privacy'); ?>" id="footerPops">Privacy Policy</a> |
			<a class="iframe" href="<?php echo Utilities::createAbsoluteUrl('guest','terms'); ?>" id="footerPops">Terms &amp; Conditions</a>
		</p>
	</div>
</footer>

<script type="text/javascript">
	$(document).ready(function(){
		$('[id^=footerPops]').colorbox({iframe:true, width:"860", height:"900",overlayClose: false});
	});
</script>