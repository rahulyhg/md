<?php
/*
*
* $Id$
--------------------------------------------------------------------------------------------------------------------------
* Information contained in this file is the intellectual property of Ladbrokes Plc
* Copyright © 2012 MarryDorr. All Rights Reserved.
* ---------------------------------------------------------------------------------------------------------------------------
*
* @author  Dileep Gopalan
* @title reference.php
* @description <Description of this class>
*  @filesource <URL>
*  @version <Revision>
*/
?>
    <?php $this->widget('application.widgets.menu.Leftmenu'); ?>

    <section class="data-contnr2">
        <ul class="accOverview pmB10">
			<li class="mT8">
				<a href="#" class="type4">Add New Referance</a>
			</li>
			    <?php 
		    if(isset($references)) {
		    	$index = 1;
		    	foreach($references as $reference){
		    ?>
			<li>
				<div class="refHead">
					<div class="headT">Referance Person <?php echo $index; ?></div> <a href="#">Edit</a> | <a href="#">Delete</a>
				</div>
			</li>
			<li>
				<div class="leftC">Contact Persons Name</div>
				<div class="rightC">
					<strong>:</strong> <span><?php echo $reference->referName; ?></span>
				</div>
			</li>
			<li>
				<div class="leftC">Convenient Time to call</div>
				<div class="rightC">
					<strong>:</strong> <span><?php echo $reference->referCallFrom; ?> to <?php echo $reference->referCallTo; ?></span>
				</div>
			</li>
			<li>
				<div class="leftC">Mobile No.</div>
				<div class="rightC">
					<strong>:</strong> <span>+91 98471 87600 </span>
				</div>
			</li>
			<li>
				<div class="leftC">Communication address</div>
				<div class="rightC">
					<strong>:</strong>
					<div class="addrs">
					<?php if(isset($reference->referHouseName)){ ?>
						<span><?php echo $reference->referHouseName; ?></span>
					<?php }?>
					<?php if(isset($reference->referPlace)){ ?>
						<span><?php echo $reference->referPlace; ?></span>
					<?php }?>
					<?php if(isset($reference->referCity)){ ?>
						<span><?php echo $reference->referCity; ?></span>
					<?php }?>
					<?php if(isset($reference->referDistrict)){ ?>
						<span><?php echo $reference->referDistrict; ?></span>
					<?php }?>
					<?php if(isset($reference->referState)){ ?>
						<span><?php echo $reference->referState; ?></span>
					<?php }?>
					<?php if(isset($reference->referPostcode)){ ?>
						<span><?php echo $reference->referPostcode; ?></span>
					<?php }?>
					<?php if(isset($reference->referPostOffice)){ ?>
						<span><?php echo $reference->referPostOffice; ?></span>
					<?php }?>
					<?php if(isset($reference->referCountry)){ ?>
						<span><?php echo $reference->referCountry; ?></span>
					<?php }?>
					</div>
				</div>
			</li>
			<li>
				<div class="leftC">Email ID.</div>
				<div class="rightC">
					<strong>:</strong> <span><?php echo $reference->referEmail; ?></span>
				</div>
			</li>
			<li>
				<div class="leftC">Occupation</div>
				<div class="rightC">
					<strong>:</strong> <span><?php echo $reference->referOccupation; ?></span>
				</div>
			</li>
			
			<?php
				$index++;
		    	} 
		    }
			?>
		</ul>
    </section>
      <?php $this->widget('application.widgets.menu.Rightmenu'); ?>
  