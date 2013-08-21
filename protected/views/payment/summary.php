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
* @title payment.php
* @description <Description of this class>
*  @filesource <URL>
*  @version <Revision>
*/
?>
      <?php $this->widget('application.widgets.menu.Leftmenu'); ?>
          <section class="data-contnr2">
		<ul class="accOverview pmB10">
			<li>
				<h1>Payment Summery</h1>
			</li>
		</ul>
		
		<?php 
		if(isset($payment)){
			$currentDate = new DateTime('now');
			$index = 1;
		foreach ($payment as $value) {
			
			$date = new DateTime($value->createdate);
			$endDate = new DateTime($value->startdate);
			$endDate->modify('90 days'); 
		?>
        <ul class="accOverview pmB10">
			<li>
				<?php echo $date->format('Y-m-d');
				if($value->actionItem == 'highlight')
				{
				echo  ' Highlighted at ';
				}
				else
				{
					if($index == 1)
					echo ' Subscribed at ';
					else
					echo ' Recharged at ';
					++$index; 
				}	
				echo $date->format('H:i a');?>
			</li>
			<li>
				<div class="leftC">Type of Payment</div>
				<div class="rightC">
					<strong>:</strong> <span>Marrydoor Pin</span>
				</div>
			</li>
			<li>
				<div class="leftC">Marrydoor PIN</div>
				<div class="rightC">
					<strong>:</strong> <span><?php echo $value->couponcode; ?> </span>
				</div>
			</li>
			<?php if($endDate > $currentDate) {
			$balance = $currentDate->diff($endDate);
			$interval = $date->diff($currentDate);
				
				?>
			<li>
				<div class="leftC">Remaining Days</div>
				<div class="rightC">
					<strong>:</strong> <span><?php echo $balance->format('%a more days');?> 
					<?php 
					
					if(sizeof($payment) == $index) {?>
					<a href="/payment/recharge" >Recharge Now</a>
					<?php }	?>
					
					</span>
				</div>
			</li>
			<li>
				<div class="leftC">Using for Last</div>
				<div class="rightC">
					<strong>:</strong> <span><?php echo $interval->format('%a days');?></span>
				</div>
			</li>
			<li>
				<div class="leftC">Expiry Date</div>
				<div class="rightC">
					<strong>:</strong> <span><?php echo $endDate->format('Y-m-d');?></span>
				</div>
			</li>
			
			<?php } else {?>
			<li>
				<div class="leftC">Expired on</div>
				<div class="rightC">
					<strong>:</strong> <span><?php  echo $endDate->format('Y-m-d');?> </span>
				</div>
			</li>
			<?php }?>
		</ul>
		<?php
		
		}
		} 
		?>
		
	
    </section>
      <?php $this->widget('application.widgets.menu.Rightmenu'); ?>
  