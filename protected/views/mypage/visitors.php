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
* @title complete.php
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
		<?php if(count($recentVisitors) > 0){?>
			<?php foreach($recentVisitors as $visitor){  ?>
			<div class="profile">
                <!--  <div class="check-contnr"><input type="checkbox" /> Select</div>-->

                <?php $this->widget('application.widgets.Profilepicturelist',array('userId'=>$visitor['userID'],'marryId'=>$visitor['marryId'])); ?>
                <div class="profile-details">
                    <ul class="details-contnr">
                        <li>
                            <a class="color" href="<?php echo Utilities::createAbsoluteUrl('search','byid',array('id'=>$visitor['marryId'])); ?>" target="_blank"><?php echo $visitor['name'] ?> (<?php echo $visitor['marryId'] ?>)</a>
                        </li>
                        <li>
                            <div class="p-info"><?php echo $visitor['gender'] ?>, <?php echo $visitor['age'] ?>, <?php echo $visitor['caste'] ?>, <?php echo $visitor['religion'] ?> </div>
                        </li>
                        <li>
                            <div class="p-info"><?php echo $visitor['place'] ?>, <?php echo $visitor['stage'] ?></div>
                        </li>
                        <li>
                            <div class="viewed">viewed 250 times</div>
                        </li>
                        <li>
                            <div class="last-view">Last viewed at: 27th July, 7:45pm</div>
                        </li>
                    </ul>
                    <a class="view-full" href="<?php echo Utilities::createAbsoluteUrl('search','byid',array('id'=>$visitor['marryId'])); ?>" target="_blank">View Full Profile</a>
                </div>
            </div>
            <?php }?>
			<?php }else{?>
			<div class="profile">
				No recent visitors found!
			</div>
			<?php }?>
			<div class="visitorBtnC">
				<span class="visitCnt">Total Visitors: 1725</span>
				<span class="visitCnt">Previous Week Visitors: 125</span>
				<span class="visitCnt">Todays Visitors: 25</span>
			</div>
        </div>
		<div id="tab2_data" class="tab-data vTD" style="display: none;">
		<?php if(count($moreVisited) > 0){?>
			<div class="profile">
                <div class="check-contnr"><input type="checkbox" /> Select</div>
                <div class="image-contnr">
                    <a href="#"><img src="./images/user/thumbnail.jpg" alt="" /></a>
                    <div class="img-controls">
                        <a href="#" class="prev"></a>
                        <div class="numbers">
                            <span>1</span> of <span>6</span>
                        </div>
                        <a href="#" class="next"></a>
                    </div>
                </div>
                <div class="profile-details">
                    <ul class="details-contnr">
                        <li>
                            <a href="#" class="color">Lilly Joseph (E204235)</a>
                        </li>
                        <li>
                            <div class="p-info">female, 23, hindu, varma </div>
                        </li>
                        <li>
                            <div class="p-info">Cochin, Kerala</div>
                        </li>
                        <li>
                            <div class="viewed">viewed 250 times</div>
                        </li>
                        <li>
                            <div class="last-view">Last viewed at: 27th July, 7:45pm</div>
                        </li>
                    </ul>
                    <a class="view-full" href="#">View Full Profile</a>
                </div>
            </div>
            <?php }else{ ?>
            	<div class="profile">
				No visitors found!
			</div>
            <?php }?>
    </section>