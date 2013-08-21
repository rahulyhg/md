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
* @title noastro.php
* @description <Description of this class>
*  @filesource <URL>
*  @version <Revision>
*/
?>
<?php $this->widget('application.widgets.menu.Leftmenu'); ?>
 <section class="data-contnr2">
        <h1 class="mB10">My Astro Details </h1>
        <p class="red">Your have not added any Astro Details yet !</p>
        <h3 class="mB10 ">What is my Astro Details ?</h3>
        <p>Astro details is where you can include your birth star, dates, rasi, grahanila etc. </p>
		<h3 class="mB10 ">Why should I add my astro details?</h3>
        <p>Your astro details will help a potential candidate easily assess the compatibility between you both based on the details. </p>
		<h3 class="mB10 ">How can to protect my astro details ?</h3>
        <p>Choose make your astro details visible only upon request. This way your information is protected and will be not available for misuse. </p>
		<a id="referenceEdit1" href="<?php echo Utilities::createAbsoluteUrl('contact','astroadd'); ?>" class="type5 wid150 mT10">Add Astro Details</a>
    </section>

<?php $this->widget('application.widgets.menu.Rightmenu'); ?>

	<script type="text/javascript">
$(document).ready(function(){
    $("#referenceEdit1").colorbox({iframe:true, width:"860", height:"900",overlayClose: false});
  });

</script>