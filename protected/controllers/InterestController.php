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
       		if(isset($_POST['userId']))
       		{
       			$user = Yii::app()->session->get('user');
       			$isInterest = $user->interestSender(array('condition'=>"receiverId = {$_POST['userId']}"));
       			if(!isset($isInterest) || empty($isInterest)) {
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