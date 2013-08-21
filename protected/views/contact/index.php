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
* @title index.php
* @description <Description of this class>
*  @filesource <URL>
*  @version <Revision>
*/
?>
    <?php $this->widget('application.widgets.menu.Leftmenu'); ?>
    <?php 
    if(isset($model)) {
    ?>
    <section class="data-contnr2">
        <h1 class="mB10">Personal Contact Details</h1>
        <ul class="accOverview">
			<li>
				<div class="leftC">Mobile No.</div>
				<div class="rightC">
					<strong>:</strong> <span><?php if(isset($model->userpersonaldetails->mobilePhone))echo $model->userpersonaldetails->mobilePhone?><a href="#">Edit</a></span>
				</div>
			</li>
			<li>
				<div class="leftC">Landline No.</div>
				<div class="rightC">
					<strong>:</strong> <span><?php if(isset($model->userpersonaldetails->landPhone))echo $model->userpersonaldetails->landPhone?><a href="#">Edit</a></span>
				</div>
			</li>
			<li>
				<div class="leftC">Altranative Mobile No.</div>
				<div class="rightC">
					<strong>:</strong> <span><?php if(isset($model->usercontactdetails->alternativeNo))echo $model->usercontactdetails->alternativeNo?><a href="#">Add Now</a></span>
				</div>
			</li>
			<li>
				<?php 
				$conAddress =  $model->addresses(array('condition'=>'addresType = 0'));
				if(isset($conAddress) && !empty($conAddress))
				{ 
				?>
				<div class="leftC">Communication address</div>
				<div class="rightC">
					<strong>:</strong>
					<div class="addrs">
					<?php if(isset($conAddress->houseName)){ ?>
						<span><?php echo $conAddress->houseName;?></span>
						<?php } ?>
					<?php if(isset($conAddress->place)){ ?>
						<span><?php echo $conAddress->place; ?></span>
					<?php } ?>
					<?php if(isset($conAddress->city)){ ?>
						<span><?php echo $conAddress->city; ?></span>
					<?php } ?>
					<?php if(isset($conAddress->postoffice)){ ?>
						<span><?php echo $conAddress->postoffice; ?></span>
					<?php } ?>
					<?php if(isset($conAddress->district)){ ?>
						<span><?php echo $conAddress->district; ?></span>
					<?php } ?>
					<?php if(isset($conAddress->state)){ ?>
						<span><?php echo $conAddress->state; ?></span>
					<?php } ?>
					<?php if(isset($conAddress->country)){ ?>
						<span><?php echo $conAddress->country; ?></span>
					<?php } ?>
					<?php if(isset($conAddress->pincode)){ ?>
						<span><?php echo $conAddress->pincode; ?></span>
					<?php } ?>
					</div>
					<a href="#">Edit</a>
				</div>
				<?php } ?>
			</li>
			<li>
			<?php 
			$perAddress =  $model->addresses(array('condition'=>'addresType = 1'));
			if(isset($perAddress))
			{
				?>
				<div class="leftC">Permenent address</div>
				<div class="rightC">
					<strong>:</strong>
					<div class="addrs">
					<?php if(isset($perAddress->houseName)){ ?>
						<span><?php echo $perAddress->houseName; ?></span>
					<?php }?>
					<?php if(isset($perAddress->place)){ ?>
						<span><?php echo $perAddress->place; ?></span>
					<?php }?>
					<?php if(isset($perAddress->city)){ ?>
						<span><?php echo $perAddress->city; ?></span>
					<?php }?>
					<?php if(isset($perAddress->postoffice)){ ?>
						<span><?php echo $perAddress->postoffice; ?></span>
					<?php }?>
					<?php if(isset($perAddress->district)){ ?>
						<span><?php echo $perAddress->district; ?></span>
					<?php }?>
					<?php if(isset($perAddress->state)){ ?>
						<span><?php echo $perAddress->state; ?></span>
					<?php }?>
					<?php if(isset($perAddress->country)){ ?>
						<span><?php echo $perAddress->country; ?></span>
					<?php }?>
					<?php if(isset($perAddress->pincode)){ ?>
						<span><?php echo $perAddress->pincode; ?></span>
					<?php }?>
					</div>
					<a href="#">Edit</a>
				</div>
			<?php }?>
			</li>
			<?php if(isset($model->usercontactdetails->facebookUrl)){ ?>
			<li>
				<div class="leftC">Facebook URL</div>
				<div class="rightC">
					<strong>:</strong> <span><a href="<?php echo $model->usercontactdetails->facebookUrl ?>" class="color mR10"><?php echo $model->usercontactdetails->facebookUrl ?></a>   <a href="#">Edit</a></span>
				</div>
			</li>
			<?php }?>
			<?php if(isset($model->usercontactdetails->skypeId)){ ?>
			<li>
				<div class="leftC">Skype</div>
				<div class="rightC">
					<strong>:</strong> <span><a href="<?php echo $model->usercontactdetails->skypeId ?>" class="color mR10"><?php echo $model->usercontactdetails->skypeId ?></a>   <a href="#">Edit</a></span>
				</div>
			</li>
			<?php }?>
			<?php if(isset($model->usercontactdetails->googleIM)){ ?>
			<li>
				<div class="leftC">Google IM</div>
				<div class="rightC">
					<strong>:</strong> <span><a href="<?php echo $model->usercontactdetails->googleIM ?>" class="color mR10"><?php echo $model->usercontactdetails->googleIM ?></a>   <a href="#">Edit</a></span>
				</div>
			</li>
			<?php } ?>
			<?php if(isset($model->usercontactdetails->yahooIM)){ ?>
			<li>
				<div class="leftC">Yahoo IM</div>
				<div class="rightC">
					<strong>:</strong> <span><a href="<?php echo $model->usercontactdetails->yahooIM ?>" class="color mR10"><?php echo $model->usercontactdetails->yahooIM ?></a>   <a href="#">Edit</a></span>
				</div>
			</li>
			<?php }?>
		</ul>
    </section>
    <?php 
    	}
    ?>
      <?php $this->widget('application.widgets.menu.Rightmenu'); ?>
  