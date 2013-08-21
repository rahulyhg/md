    <?php $this->widget('application.widgets.menu.Leftmenu'); ?>
  <section class="data-contnr2">
        <h1 class="mB10">My Referance </h1>
        <p class="red">Your have not added any Referance yet !</p>
        <h3 class="mB10 ">What is my Referance ?</h3>
        <p>My reference is where you can add the references of people who can vouch for your character. You can add teachers and important people in your locality as your references. </p>
		<h3 class="mB10 ">Why should I add my reference?</h3>
        <p>References are the best way to ensure that the potential candidate is a person of good conduct and is a respected person in the society. </p>		
		
		<a class="type5 wid150 mT10" href="<?php echo Utilities::createAbsoluteUrl('contact','referenceadd'); ?>" id="referenceEdit">Add Referance</a>
    </section>
	<?php $this->widget('application.widgets.menu.Rightmenu'); ?>
	
	<script type="text/javascript">
$(document).ready(function(){
    $("#referenceEdit").colorbox({iframe:true, width:"860", height:"900",overlayClose: false});
  });


</script>