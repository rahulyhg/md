<?php
/*
*
* $Id$
--------------------------------------------------------------------------------------------------------------------------
* Information contained in this file is the intellectual property of MarryDoor
* Copyright © 2012 MarryDoor. All Rights Reserved.
* ---------------------------------------------------------------------------------------------------------------------------
*
* @author  Ageesh K Gopinath
* @title shortlist.php
* @description <Description of this class>
*  @filesource <URL>
*  @version <Revision>
*/
?>

          
    	  <?php $this->widget('application.widgets.menu.Leftmenu'); ?>
    <section class="data-contnr3">
		<h1 class="mB10">Recent Profile visitors </h1>
        <p>Find a list of your resent profile viewers. Kindly remember that profile viewing doesn't mean that the person is interested in you. </p>
		<ul class="tab-head">
			<li id="tab1">
				<a id="tab1" href="#" class="select ">Recent Visitors</a>
			</li>
			<li id="tab2"> 
				<a id="tab2" href="#" class="type3 ">More Visited</a>
			</li>
		</ul>
		<div id="tab1_data" class="tab-data vTD" style="display: block;">
			 <?php foreach ($users as $value) { ?>
			<div class="profile">
			<?php $this->widget('application.widgets.Profilepicturelist',array('userId'=>$value['userID'],'marryId'=>$value['marryId'])); ?>
                
                <div class="profile-details">
                    <ul class="details-contnr">
                        <li>
                            <a href="<?php echo 'byid?id='.$value['marryId'] ?>" class="color" ><?php echo $value['name']; echo '( '.$value['marryId'].' )' ;?></a>
                        </li>
                        <li>
                            <div class="p-info"> <?php echo Utilities::getAgeFromDateofBirth($value['dob']); ?>,<?php echo $value['religion'];?> , <?php echo $value['caste'];?> </div>
                        </li>
                        <li>
                            <div class="p-info"><?php echo $value['place'] ?>, <?php echo $value['state']?> </div>
                        </li>
                        <li>
                            <div class="viewed">viewed <?php echo $value['counter']?> times</div>
                        </li>
                        <li>
                            <div class="last-view">Last viewed at: <?php echo date("jS \of F Y , h:i A", strtotime($value['visitTime']));?></div>
                        </li>
                    </ul>
                    <a class="view-full" target="_blank"  href="<?php echo '/search/byid/id/'.$value['marryId'] ?>">View Full Profile</a>
                </div>
            </div>
            <?php } ?>
			
			<div class="visitorBtnC">
				<span class="visitCnt">Total Visitors: <?php echo $totalVisitors; ?></span>
				<span class="visitCnt">Previous Week Visitors: <?php echo $weekly['num']; ?></span>
				<span class="visitCnt">Todays Visitors: <?php echo $today['num']; ?></span>
			</div>
        </div>
		<div id="tab2_data" class="tab-data vTD" style="display: none;">
			 <?php foreach ($visitors as $value) { ?>
			<div class="profile">
			<?php $this->widget('application.widgets.Profilepicturelist',array('userId'=>$value['userID'],'marryId'=>$value['marryId'])); ?>
                
                <div class="profile-details">
                    <ul class="details-contnr">
                        <li>
                            <a href="<?php echo 'byid?id='.$value['marryId'] ?>" class="color" ><?php echo $value['name']; echo '( '.$value['marryId'].' )' ;?></a>
                        </li>
                        <li>
                            <div class="p-info"> <?php echo Utilities::getAgeFromDateofBirth($value['dob']); ?>,<?php echo $value['religion'];?> , <?php echo $value['caste'];?> </div>
                        </li>
                        <li>
                            <div class="p-info"><?php echo $value['place'] ?>, <?php echo $value['state']?> </div>
                        </li>
                        <li>
                            <div class="viewed">viewed <?php echo $value['counter']?> times</div>
                        </li>
                        <li>
                            <div class="last-view">Last viewed at: <?php echo date("jS \of F Y , h:i A", strtotime($value['visitTime']));?></div>
                        </li>
                    </ul>
                    <a class="view-full" target="_blank"  href="<?php echo '/search/byid/id/'.$value['marryId'] ?>">View Full Profile</a>
                </div>
            </div>
            <?php } ?>
			
		</div>
		
    </section>

