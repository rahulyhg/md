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
* @title referencedetails.php
* @description <Description of this class>
*  @filesource <URL>
*  @version <Revision>
*/
?>


		<div class="subContent">
			<section class="subHead">
				<h1 ><?php echo $model->name?> <?php echo $model->marryId?></h1>
				<h5>Viewing persons reference details</h5>
			</section>
			<section class="subContnr">
				<ul class="accOverview pmB10">
					<li>
						<a class="type4" href="#">Print Contact</a>
					</li>
				</ul>
				 <?php 
				 $references = $model->references;
		    if(isset($references) && !empty($references)) {
		    	$index = 1;
		    	foreach($references as $reference){
		    ?>
				
				<ul class="accOverview pmB10">
				<li>	
						<div class="refHead">
							<div class="headT">Referance Person  <?php echo $index; ?></div> 
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
					<strong>:</strong> <?php if(isset($reference->referPostcode)){ ?>
						<span><?php echo $reference->referPostcode; ?></span>
					<?php }?>
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
				</ul>
				<?php 
		    	$index++;
		    	}
		    }
		    else { 
				?>
				<ul class="accOverview pmB10">
				<li>	
						<div class="refHead">
							<div class="headT">Have not added any Referance yet !</div> 
						</div>
						
					</li>		
				</ul>
				<?php }?>
			</section>
		