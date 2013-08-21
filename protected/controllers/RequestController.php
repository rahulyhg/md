<?php

class RequestController extends Controller
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
       		$interest = new Interests();
       		$interest->senderId =  $user->userId;
       		$interest->receiverId =  $_POST['userId'];
       		$interest->sendDate = new CDbExpression('NOW()');
       		$interest->save();
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
		
		/*$user  = Yii::app()->session->get('user');
		$sendInterest = $user->interestSender(array('condition'=>'status != 3'));
		if(sizeof($sendInterest) > 0){
		$userId = array();
		$userInterest = array();
		foreach ($sendInterest as $value) {
			$userId[] = $value->receiverId;
			$userInterest[$value->receiverId] = $value->sendDate;
		}
		$userIds = implode(",", $userId);
		$condition = "userId in ($userIds)";
		$users = ViewUsers::model()->findAll(array('condition'=>$condition,'order'=> 'createdOn DESC' ));
		$this->render('sent',array('user'=>$users,'interest'=>$userInterest));
		}
		else
		{
			$this->render('sent');
		}*/
		
		$user  = Yii::app()->session->get('user');
		$action = (isset($_REQUEST['action'])) ? $_REQUEST['action'] : "";
		$selectedIds = (isset($_REQUEST['selectedIds'])) ? $_REQUEST['selectedIds'] : "";
		$selectedTab = (isset($_REQUEST['selectedTab'])) ? $_REQUEST['selectedTab'] : "received";
		//var_dump($_REQUEST);die;
		if($action != "" and $selectedIds != ""){
			/*
				request status
				0 - new request received
				1 - accepted the request
				2 - declined the request
				
			*/
			switch($action){
				case  'accept':
					   $query = "update requests set status = 1 where requestId = {$selectedIds}";
					   break;
				case  'decline':
					   $query = "update requests set status = 2 where requestId = {$selectedIds}";
					   break;
				case  'delete':
					   $query = "delete from requests  where requestId = {$selectedIds}";
					   break;
				case  'cancel':
					   $query = "delete from requests  where senderId = {$user->userId} and requestId = {$selectedIds}";
					   break;
				default:
					  $query = "update requests set status = 2 where requestId = {$selectedIds}";
					   break;
			}
			Utilities::executeRawQuery($query);
		}
		//received interests
		$sql = "SELECT * FROM view_requests WHERE receiverId = {$user->userId} and status = 0";
		$command=Yii::app()->db->createCommand($sql);
		$received = $command->queryAll();
		
		// express interest
		$sql = "SELECT * FROM view_requests WHERE senderId = {$user->userId}";
		$command=Yii::app()->db->createCommand($sql);
		$sent = $command->queryAll();
		
		// accepted interest
		$sql = "SELECT * FROM view_requests WHERE (receiverId = {$user->userId} or senderId = {$user->userId}) and status = 1";
		$command=Yii::app()->db->createCommand($sql);
		$accepted = $command->queryAll();
		
		// declined intrests
		$sql = "SELECT * FROM view_requests WHERE (receiverId = {$user->userId} or senderId = {$user->userId}) and status = 2";
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
		
		
		$userIds = implode(",", $userId);
		$condition = "userId in ($userIds)";
		$users = ViewUsers::model()->findAll(array('condition'=>$condition,'order'=> 'createdOn DESC' ),'active=1');
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
	
	// this function will be used in next phase to use request funcationality
	public function actionRequested()
	{
		$profileId = isset($_REQUEST['profileId']) ? $_REQUEST['profileId'] : 0;
		$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
		$module = isset($_REQUEST['module']) ? $_REQUEST['module'] : '';
		$user  = Yii::app()->session->get('user');
		$type = Utilities::getRequestType($module);
		$message = '';
		if(isset($_REQUEST['sendRequest']) and $_REQUEST['sendRequest'] !=""){
			if(sizeof($user->requestSender(array('condition'=>'senderId='.$user->userId.' and receiverId='.$profileId.' and requestType='.$type)))> 0){
				$message = 'error';
			}else{ 
				$request = new Requests();
				$request->senderId = $user->userId;
				$request->receiverId = $profileId;
				$request->requestType = $type;
				$request->sendDate = date('Y-m-d h:i:s');
				$request->save();
				$message = 'success';
			}
		}
		
		$this->layout= '//layouts/popup';
		$this->render('popup',array('profileId'=>$profileId,'action'=>$action,'module'=>$module,'message'=>$message));
	}
	

	
}