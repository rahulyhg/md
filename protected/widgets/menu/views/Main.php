<ul class="nav-bar">
<?php if(Yii::app()->session->itemAt('user')) {?>
			<li class="menu">
                <a class="link" href="javascript:void(0)">my account  </a>
				<div class="sub" style="display:none">
					<div class="arrow"></div>
					<div class="data wid140">
						<a class="width100" href="<?php echo Utilities::createAbsoluteUrl('mypage','contact')?>">Contact Details</a>
						<a class="width100" href="<?php echo Utilities::createAbsoluteUrl('mypage','reference')?>">My Reference</a>
						<a class="width100" href="<?php echo Utilities::createAbsoluteUrl('mypage','document')?>">My Documents</a>
						<a class="width100" href="<?php echo Utilities::createAbsoluteUrl('shortlist','index')?>">Shortlist</a>
						<a class="width100" href="<?php echo Utilities::createAbsoluteUrl('bookmark','index')?>">Bookmarks</a>
						<a class="width100" href="<?php echo Utilities::createAbsoluteUrl('addressbook','index')?>">My Address Book</a>
						<a class="width100" href="<?php echo Utilities::createAbsoluteUrl('mypage','partnerpreference')?>">Partner preference</a>
						<a class="width100" href="<?php echo Utilities::createAbsoluteUrl('payment','summary')?>">My Payment summury</a>
						<a class="width100" href="<?php echo Utilities::createAbsoluteUrl('mypage','account')?>">My Account</a>
						<!-- <a class="width100" href="<?php echo Utilities::createAbsoluteUrl('mypage','settings')?>">Privacy settings</a> -->
						
					</div>
				</div>
            </li>
			<li class="menu">
                <a class="link" href="javascript:void(0)">my profile</a>
				<div class="sub" style="display:none">
					<div class="arrow"></div>
					<div class="data wid140">
						<a class="width100" href="<?php echo Utilities::createAbsoluteUrl('mypage','profile')?>">View Profile</a>
						<a class="width100" href="<?php echo Utilities::createAbsoluteUrl('mypage','profile')?>">Edit Profile</a>
						<a class="width100" href="<?php echo Utilities::createAbsoluteUrl('mypage','album')?>">Change Profile picture</a>
						<a class="width100" href="<?php echo Utilities::createAbsoluteUrl('mypage','album')?>">Add New Picture</a>
					</div>
				</div>
            </li>
			<li class="menu">
                <a class="link" href="javascript:void(0)">communicate</a>
				<div class="sub" style="display:none">
					<div class="arrow"></div>
					<div class="data wid140">
						<a class="width100" href="<?php echo Utilities::createAbsoluteUrl('message','index',array('selectedTab'=>'inbox'))?>">Received Message</a>
						<a class="width100" href="<?php echo Utilities::createAbsoluteUrl('message','index',array('selectedTab'=>'outbox'))?>">Sent Message</a>
						<div class="dividr"></div>
						<a class="width100" href="<?php echo Utilities::createAbsoluteUrl('interest','sent',array('selectedTab'=>'received'))?>">Received Interest</a>
						<a class="width100" href="<?php echo Utilities::createAbsoluteUrl('interest','sent',array('selectedTab'=>'sent'))?>">Sent Interest</a>
						<a class="width100" href="<?php echo Utilities::createAbsoluteUrl('interest','sent',array('selectedTab'=>'declined'))?>">Declined Interest</a>
						<div class="dividr"></div>
						<!-- 
						<a class="width100" href="<?php echo Utilities::createAbsoluteUrl('request','sent')?>">Received Request</a>
						<a class="width100" href="<?php echo Utilities::createAbsoluteUrl('request','sent')?>">Sent Request</a>
						<a class="width100" href="<?php echo Utilities::createAbsoluteUrl('request','sent')?>">Declined Request</a>
						 -->
					</div>
				</div>
            </li>
      <?php } ?>
            <li class="menu">
                <a class="link" href="javascript:void(0)">search</a>
				<?php if(Yii::app()->session->itemAt('user')) {?>
				<div class="sub wid270" style="display:none">
					<div class="arrow"></div>
					<?php $user = Yii::app()->session->get('user');
					$user = Users::model()->findbyPk($user->userId);
					Yii::app()->session->add('user',$user);
					if(isset($user->saveSearch)) {
					?>
					<div class="data wid140">
						<div class="saved">Saved Search</div>
						<div class="searchby"><?php echo $user->saveSearch->searchName?></div>
						<div class="options">
							<a href="/search/show?searchName=<?php echo $user->saveSearch->searchName?>">Edit</a>
							<a href="/search/delete?searchName=<?php echo $user->saveSearch->searchName?>">Delete</a>
						</div>
					</div>
					<?php }?>
					<div class="data wid120">
						<a class="width100" href="<?php echo Utilities::createAbsoluteUrl('search','index')?>">Basic Search </a>
						<a class="width100" href="<?php echo Utilities::createAbsoluteUrl('search','advance')?>">Advanced Search</a>
						<a class="width100" href="<?php echo Utilities::createAbsoluteUrl('search','byid')?>">Search by ID</a>
						<a class="width100" href="<?php echo Utilities::createAbsoluteUrl('search','keyword')?>">Search by Keyword</a>
					</div>
				</div>
				<?php }else{?>
					<div class="sub" style="display:none">
					<div class="arrow"></div>
					<div class="data wid140">
						<a class="width100" href="<?php echo Utilities::createAbsoluteUrl('search','index')?>">Basic Search </a>
						<a class="width100" href="<?php echo Utilities::createAbsoluteUrl('search','advance')?>">Advanced Search</a>
						<a class="width100" href="<?php echo Utilities::createAbsoluteUrl('search','byid')?>">Search by ID</a>
						<a class="width100" href="<?php echo Utilities::createAbsoluteUrl('search','keyword')?>">Search by Keyword</a>
					</div>
				</div>
				<?php }?>
            </li>
            <li class="menu">
                <a class="link" href="javascript:void(0)">payment options</a>
                <?php if(Yii::app()->session->itemAt('user')) {?>
                <div class="sub" style="display:none">
					<div class="arrow"></div>
					<div class="data wid140">
						<a class="width100" href="<?php echo Utilities::createAbsoluteUrl('payment','index')?>">Subscribe Now</a>
						<a class="width100" href="<?php echo Utilities::createAbsoluteUrl('payment','recharge')?>">Recharge Now</a>
						<a class="width100" href="<?php echo Utilities::createAbsoluteUrl('payment','summary')?>">My Payment Summury</a>
					</div>
				</div>
                <?php } else {?>
                
				<div class="sub" style="display:none">
					<div class="arrow"></div>
					<div class="data wid140">
						<span>For payment details</span>
						<p>Please contact our help desk at <br/> +91 9400 005 005</p>
					</div>
				</div>
				<?php } ?>
            </li>
            <li class="menu">
                <a class="link" href="javascript:void(0)">contact us</a>
				<div class="sub" style="display:none">
					<div class="arrow"></div>
					<div class="data wid160">
						<!--  <span>Postal Address</span>-->
						<p>Marrydoor <br />Loloos Technolab Pvt.  Ltd. <br />Near Kochin International <br />Airport <br />Vappalassery P.O., <br />Pin 680 572</p>
						<span>Helpline Number</span>
						<p>940 000 5005</p>
						<span>Fax</span>
						<p>0481 234 1203</p>
						<span>E-Mail</span>
						<a class="mailto" href="mailto:mail@marrydoor.com">mail@marrydoor.com</a>
					</div>
				</div>
            </li>
        </ul>