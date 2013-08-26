<?php

class InterestController extends Controller
{
	
	
	  public function beforeAction()
        {
                $user = Yii::app()->session->get('user');
                if(!isset($user)) {
                        $this->redirect(Yii::app()->user->loginUrl);
                        return false;
                }       
                return true;
        }  
	
       public function actionInsert()
       {
       	$heightArray = Utilities::getHeights();
       		if(isset($_POST['userId']))
       		{
       			$user = Yii::app()->session->get('user');
       			$user = Users::model()->findbyPk($user->userId);
       			$isInterest = $user->interestSender(array('condition'=>"receiverId = {$_POST['userId']}"));
       			if(!isset($isInterest) || empty($isInterest)) {
       				$interester = Users::model()->findbyPk($_POST['userId']);
       				$body = '<html><body>
<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" style="font-family:Arial,Helvetica,sans-serif">
    <tbody>
        <tr>
            <td>
                <table width="600" cellspacing="0" cellpadding="0" border="0" bgcolor="#c8bfe7" align="left" style="background:#c8bfe7;padding-top:5px;padding-bottom:5px">
                    <tbody>
                        <tr>
                            <td width="100%" bgcolor="#c8bfe7" align="center" style="background-color:#c8bfe7">
                                <table width="590" cellspacing="0" cellpadding="0" border="0" bgcolor="#7c51a1" align="center" style="background-color:#7c51a1;margin-bottom:5px">
                                    <tbody>
                                        <tr>
                                            <td valign="middle" height="80"><span style="color:#ffffff;font-size:50px;margin-left:20px;float:left">marrydoor</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table width="590" cellspacing="0" cellpadding="0" border="0" bgcolor="#c8bfe7" align="center" style="background-color:#c8bfe7;margin-top:5px;margin-bottom:5px">
                                    <tbody>
                                        <tr>
                                            <td valign="middle" height="35"><span style="color:#ffffff;font-size:24px;margin-left:20px;float:left">Wow..! You got a new interest!</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table width="590" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center" style="background-color:#ffffff;padding-bottom:30px;padding-top:30px"> 
                                    <tbody>
                                        <tr>
                                            <td valign="top" bgcolor="#ffffff">
                                                <font style="font:normal 20px arial;text-align:justify;color:#408ef8;float:left;margin-left:20px;margin-right:20px;margin-bottom:10px">
                                                    <a target="_blank" href="https://google.com" style="text-decoration:none;color:#408ef8">Hi '.$interester->name.' ('.$interester->marryId.'), </a>
                                                    
                                                </font>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top" bgcolor="#ffffff">
                                                <font style="font:normal 16px arial;text-align:justify;color:#666666;float:left;margin-left:20px;margin-right:20px">
                                                     '.$user->name.' '.($user->marryId).' Expressed a interest on you.
                                                </font>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top" bgcolor="#ffffff">
                                                <table width="570" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center" style="background-color:#ffffff;margin-top:5px;margin-bottom:5px;padding-bottom:20px;padding-top:20px">


                                                    <tbody>
                                                        <tr>
                                                            <td width="570" valign="top" bgcolor="#edeaf7" align="center">
                                                                <table width="550" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" style="border:1px solid #3cc3ee;margin-bottom:10px;margin-top:10px">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="100" valign="top" align="center"><img width="64" height="64" border="0" style="border:1px solid #876099;float:left;margin-bottom:10px;margin-left:10px;margin-right:10px;margin-top:10px;background-color:#faf8ff" src="'.Utilities::getProfileImage($user->marryId,'').'" alt=""></td>


                                                                            <td width="250" valign="top" align="left" style="font:normal 11px arial;color:#606060;padding-top:10px;padding-bottom:10px;padding-right:10px">
                                                                                <span style="font:bold 11px arial;color:#606060">
                                                                                    <a target="_blank" href="http://marrydoor.com/search/byid/id/'.$user->marryId.'" style="text-decoration:none;color:#606060">'.$user->name.'('.$user->marryId.')</a><br>
                                                                                </span>'.
                                                                        
        Utilities::getAgeFromDateofBirth($user->dob).' yrs,  '. $heightArray[$user->physicaldetails->heightId].' | '.$user->userpersonaldetails->religion->name.':  '. $user->userpersonaldetails->caste->name.'| 
		'.$user->userpersonaldetails->district->name.','. $user->userpersonaldetails->state->name.','. $user->userpersonaldetails->country->name.' | '.$user->educations->education->name.' |'.$user->educations->occupation->name.'
                                                                        
    </td>
                                                                            <td width="200" valign="top" align="left" style="padding-top:10px;padding-left:15px;padding-right:5px;padding-bottom:5px">
                                                                                <table cellspacing="0" cellpadding="0" border="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td valign="top" style="font:normal 11px arial;color:#646464">
                                                                                                <a target="_blank" href="http://marrydoor.com/search/byid/id/'.$user->marryId.'" style="font:normal 11px arial;color:#408ef8;text-decoration:none;outline:none">View Full Profile »</a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                       
                                    </tbody>
                                </table>
                                <table width="590" cellspacing="0" cellpadding="0" border="0" bgcolor="#c8bfe7" align="center" style="background-color:#c8bfe7"> 
                                    <tbody>
                                        <tr>
                                            <td valign="top">
                                                <font style="font:normal 14px arial;text-align:justify;color:#ffffff;margin-left:20px;margin-right:20px;margin-top:10px;margin-bottom:10px;float:left">
                                                    Wishing You all the very best in Your partner search, <br> Team - MARRYDOOR
                                                </font>
                                            </td>
                                        </tr>  
                                    </tbody>
                                </table>
                                <table width="590" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center" style="background-color:#ffffff"> 
                                    <tbody>
                                        <tr>
                                            <td valign="top" height="50" bgcolor="#ffffff">
                                                <font style="font:normal 12px arial;text-align:justify;color:#939598;float:left;margin-left:20px;margin-right:20px;margin-top:10px;margin-bottom:10px">
                                                    You are a 
MarryDoor.com member. This e-mail comes to you in accordance with 
MarryDoor.com Privacy Policy.MarryDoor.com is not responsible for content other 
than its own and makes no warranties or guaratees about the products or 
services that are advetised.
                                                </font>
                                            </td>
                                        </tr>  
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
</body>
</html>';
       				Utilities::sendClaimEmail($interester->emailId,'Wow..! You got a new interest!',$body);
					$interest = new Interests();
		       		$interest->senderId =  $user->userId;
		       		$interest->receiverId =  $_POST['userId'];
		       		$interest->sendDate = new CDbExpression('NOW()');
		       		$interest->save();
		       		echo json_encode(TRUE);
					Yii::app()->end();	
				}
			}
       }

       public function actionInsertall()
       {
       		if(isset($_POST['userIds']))
       		{
       			$user = Yii::app()->session->get('user');
       			$userIds = $_POST['userIds'];
       			if(!isset($user->interests))
				{
					if(!empty($userIds)){
						foreach($userIds as $userId){
							$isInterest = $user->interestSender(array('condition'=>"receiverId = {$userId}"));
							if(!isset($isInterest) || empty($isInterest)) {
								$interest = new Interests();
					       		$interest->senderId =  $user->userId;
					       		$interest->receiverId =  $userId;
					       		$interest->sendDate = new CDbExpression('NOW()');
					       		$interest->save();
							}
						}
					}
		       		echo json_encode(TRUE);
					Yii::app()->end();	
				}
			}
       } 
        
	       
	public function actionIndex()
	{
		
		if(isset($_POST['key']) && isset($_POST['userId']))
		{										  		
			if($_POST['key'] == 'sent')
			{
				$users  = Yii::app()->session->get('user');
				$user = $users->userId;
				$userIds =  $_POST['userId'];
				$sql = "UPDATE interests SET status = 3,statusChange= now() WHERE senderId = {$user} and receiverId in ({$userIds})";
				$command=Yii::app()->db->createCommand($sql);
				$results=$command->query();
				
				
				//$sendI
				$this->forward('sent');	
			}
			if($_POST['key'] == 'accept')
			{
				
				$users  = Yii::app()->session->get('user');
				$user = $users->userId;
				$userIds =  $_POST['userId'];
				$sql = "UPDATE interests SET status = 3,statusChange= now() WHERE senderId  in ({$userIds}) and receiverId = {$user}";
				$command=Yii::app()->db->createCommand($sql);
				$results=$command->query();
				
				
				//$sendI
				$this->forward('accept');	
				
			}
			
			if($_POST['key'] == 'decline')
			{
				$users  = Yii::app()->session->get('user');
				$user = $users->userId;
				$userIds =  $_POST['userId'];
				$sql = "UPDATE interests SET status = 2,statusChange= now() WHERE senderId  in ({$userIds}) and receiverId = {$user}";
				$command=Yii::app()->db->createCommand($sql);
				$results=$command->query();
				
				
				//$sendI
				$this->forward('decline');	
			}
		}
		
		
		
		$this->render('index');
	}
	
	/**
	 *  Interest sent
	 * Enter description here ...
	 */
	public function actionSent()
	{
		
		$user  = Yii::app()->session->get('user');
		$action = (isset($_REQUEST['action'])) ? $_REQUEST['action'] : "";
		$selectedIds = (isset($_REQUEST['selectedIds'])) ? $_REQUEST['selectedIds'] : "";
		$selectedTab = (isset($_REQUEST['selectedTab'])) ? $_REQUEST['selectedTab'] : "received";
		if($action != "" and $selectedIds != ""){
			/*
				interest status
				0 - new interest received
				1 - accepted the interest
				2 - declined the interest
				
			*/
			if($selectedTab == '')$selectedTab = 'received';
			switch($action){
				case  'accept':
					   $query = "update interests set status = 1 where interestId = {$selectedIds} and receiverId={$user->userId}";
					   break;
				case  'decline':
					   $query = "update interests set status = 2 where interestId = {$selectedIds} and receiverId={$user->userId}";
					   break;
				case  'delete':
						if($selectedTab == 'sent'){
							$query = "update interests set senderStatus = 1  where interestId in({$selectedIds}) and senderId={$user->userId}";
						}elseif($selectedTab == 'received'){
							$query = "update interests set receiverStatus = 1  where interestId in({$selectedIds}) and receiverId={$user->userId}";
						}elseif($selectedTab == 'accepted'){
							$query = "update interests set receiverStatus = 1  where interestId in({$selectedIds}) and receiverId={$user->userId}";
						}elseif($selectedTab == 'declined'){
							$query = "update interests set receiverStatus = 1  where interestId in({$selectedIds}) and receiverId={$user->userId}";
						}
					   break;
				case  'cancel':
					   $query = "delete from interests  where senderId = {$user->userId} and interestId = {$selectedIds}";
					   break;
				default:
					  $query = "update interests set status = 2 where interestId = {$selectedIds} and receiverId={$user->userId}";
					   break;
			}
			Utilities::executeRawQuery($query);
			
			
			
			if($action == 'accept')
			{
				
				$interest = Interests::model()->findByPk($selectedIds);
				//short list, mutual acceptance

				
				//add sender id to receiver short list
				if(isset($user->shortlist))
				{
					if(isset($user->shortlist->profileID ))
					{
						$profileIds = explode(",", $user->shortlist->profileID);
						$arr = array_merge($profileIds,array($interest->senderId));
						if(sizeof($arr) > 0 ){
							$user->shortlist->profileID = implode(",", $arr);
							$user->shortlist->save();
						}
						else
						{
							$short = new Shortlist();
							$short->userID = $user->userId;
							$short->profileID = $interest->senderId;
							$short->save();
						}
					}

				}else
				{
					$short = new Shortlist();
					$short->userID = $user->userId;;
					$short->profileID = $interest->senderId;
					$short->save();
				}

				$shortusers = Users::model()->findByPk($interest->senderId);
				//make shortlist -- add receiver id in senders short list	
				if(isset($shortusers->shortlist))
				{
					if(isset($shortusers->shortlist->profileID ))
					{
						$profileIds = explode(",", $shortusers->shortlist->profileID);
						$arr = array_merge($profileIds,array($user->userId));
						if(sizeof($arr) > 0 ){
							$shortusers->shortlist->profileID = implode(",", $arr);
							$shortusers->shortlist->save();
						}
						else
						{
							$short = new Shortlist();
							$short->userID = $shortusers->userId;
							$short->profileID = $user->userId;
							$short->save();
						}
					}

				}else
				{
					$short = new Shortlist();
					$short->userID = $shortusers->userId;
					$short->profileID = $user->userId;
					$short->save();
				}
					

			}

		}
			
		//received interests
		$sql = "SELECT * FROM view_interests WHERE receiverId = {$user->userId} and status = 0 and receiverStatus = 0";
		$command=Yii::app()->db->createCommand($sql);
		$received = $command->queryAll();
		
		// express interest
		$sql = "SELECT * FROM view_interests WHERE senderId = {$user->userId} and status = 0 and senderStatus = 0";
		$command=Yii::app()->db->createCommand($sql);
		$sent = $command->queryAll();
		
		// accepted interest
		$sql = "SELECT * FROM view_interests WHERE (receiverId = {$user->userId} or senderId = {$user->userId}) and status = 1 and receiverStatus = 0";
		$command=Yii::app()->db->createCommand($sql);
		$accepted = $command->queryAll();
		
		// declined intrests
		$sql = "SELECT * FROM view_interests WHERE (receiverId = {$user->userId} or senderId = {$user->userId}) and status = 2 and receiverStatus = 0";
		$command=Yii::app()->db->createCommand($sql);
		$declined = $command->queryAll();
		
		$this->render('sent',array('received'=>$received,'sent'=>$sent,'accepted'=>$accepted,'declined'=>$declined,'tab'=>$selectedTab));

	}

	
	/**
	 * Interest accepted by you
	 * Enter description here ...
	 */
	public function actionAccept()
	{
		$user  = Yii::app()->session->get('user');
		$userID = $user->userId;
		$sendInterest = $user->interestReceiver(array('condition'=>'status = 1'));
		if(sizeof($sendInterest) > 0 ){
		$userId = array();
		$userInterest = array();
		$receiveInt = array();
		foreach ($sendInterest as $value) {
			$userId[] = $value->senderId;
			$userInterest[$value->senderId] = $value->sendDate;
		}
		
		
		
		$users = ViewUsers::model()->findAll(array('condition'=>$condition,'order'=> 'createdOn DESC' ));
		$this->render('accept',array('user'=>$users,'interest'=>$userInterest));
		}
		else
		{
			$this->render('accept');
		}
		
		
	}
	
	/**
	 * 
	 * Declined interest details
	 * Enter description here ...
	 */
	public function actionDecline()
	{
		$user = Yii::app()->session->get('user');
		$sendInterest = $user->interestReceiver(array('condition'=>'status= 2'));
		
		if(sizeof($sendInterest) > 0){
		$userId = array();
		$userInterest = array();
		foreach ($sendInterest as $value) {
			$userId[] = $value->senderId;
			$userInterest[$value->senderId] = $value->sendDate;
		}
		$userIds = implode(",", $userId);
		$condition = "userId in ($userIds)";
		$users = ViewUsers::model()->findAll(array('condition'=>$condition,'order'=> 'createdOn DESC' ),'active=1');
		$this->render('decline',array('user'=>$users,'interest'=>$userInterest));
		}
		else
		{
			$this->render('decline');
		}
	}
	/**
	 * Interest received
	 * Enter description here ...
	 */
	public function actionReceive()
	{
		
    	$user  = Yii::app()->session->get('user');
		$receiveInterest = $user->interestReceiver(array('condition'=>'status = 0'));
		if(sizeof($receiveInterest) > 0){
		$userId = array();
		$userInterest = array();
		foreach ($receiveInterest as $value) {
			$userId[] = $value->senderId;
			$userInterest[$value->senderId] = $value->sendDate;
		}
		$userIds = implode(",", $userId);
		$condition = "userId in ($userIds)";
		$users = ViewUsers::model()->findAll(array('condition'=>$condition,'order'=> 'createdOn DESC' ),'active=1');
		$this->render('receive',array('user'=>$users,'interest'=>$userInterest));
		}
		else
		{
			$this->render('receive');
		}
		
		
	}
	
}