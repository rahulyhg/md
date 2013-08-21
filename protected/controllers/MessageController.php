<?php
class MessageController extends Controller
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
	
	public function actionIndex()
	{
		$user = Yii::app()->session->get('user');
		$action = (isset($_REQUEST['action'])) ? $_REQUEST['action'] : "";
		$selectedIds = (isset($_REQUEST['selectedIds'])) ? $_REQUEST['selectedIds'] : "";
		$selectedTab = (isset($_REQUEST['selectedTab'])) ? $_REQUEST['selectedTab'] : "inbox";
			if($action != "" and $selectedIds != ""){
			/*
				interest status
				0 - new message
				1 - read message
				2 - acknowledge
			*/
			if($selectedTab == '')$selectedTab = 'inbox';
			switch($action){
				case  'delete':
						if($selectedTab == 'inbox'){
							$query = "update messages set receiverStatus = 1  where messageId in({$selectedIds}) and receiverId={$user->userId}";
						}elseif($selectedTab == 'outbox'){
							$query = "update messages set senderStatus = 1  where messageId in({$selectedIds}) and senderId={$user->userId}";
						}
					   break;
				default:
					   break;
			}
			Utilities::executeRawQuery($query);
		}
		
		// update the message status
		$query = "update messages set status = 1  where receiverId={$user->userId}";
		Utilities::executeRawQuery($query);
		
		$sql = "SELECT * FROM view_messages WHERE receiverId = {$user->userId} and (status = 0 or status =1) and receiverStatus = 0 order by messageId desc";
		$command=Yii::app()->db->createCommand($sql);
		$inbox = $command->queryAll();
		
		$sql = "SELECT * FROM view_messages WHERE senderId = {$user->userId} and senderStatus = 0 order by messageId desc";
		$command=Yii::app()->db->createCommand($sql);
		$outbox = $command->queryAll();
		
		$sql = "SELECT * FROM view_messages WHERE receiverId = {$user->userId} and status = 2 order by messageId desc";
		$command=Yii::app()->db->createCommand($sql);
		$ackowledge = $command->queryAll();
		$this->render('index',array('inbox'=>$inbox,'outbox'=>$outbox,'ackowledge'=>$ackowledge,'page'=>$selectedTab));
	}
	
	public function actionConversation()
	{
		$user = Yii::app()->session->get('user');
		$senderId = isset($_REQUEST['senderId']) ? $_REQUEST['senderId']:0;
		if(isset($_POST['selectedIds']) and $_POST['selectedIds'] != ''){
			$selectedIds = $_POST['selectedIds'];
			$query = "delete from messages where messageId in($selectedIds)";
			Utilities::executeRawQuery($query);
			$this->redirect(Utilities::createAbsoluteUrl('message','conversation',array('senderId'=>$senderId)));
			Yii::app()->end();
		}
		
		if(isset($_POST['message']) && $_POST['message'] != ""){
			$msg = trim($_POST['message']);
			$senderId = isset($_REQUEST['senderId']) ? $_REQUEST['senderId']:0;
			if($msg != ""){
				$message = new Messages();
				$message->senderId = $user->userId;
				$message->receiverId = $senderId;
				$message->message = $msg;
				//$message->status = 1;
				$message->sendDate = date('Y-m-d h:i:s');
				$message->save();
				$this->redirect(Utilities::createAbsoluteUrl('message','conversation',array('senderId'=>$senderId)));
				Yii::app()->end();
			}
		}
		
		$sql = "SELECT * FROM view_messages WHERE (receiverId = {$user->userId} and senderId = {$senderId}) or (receiverId = {$senderId} and senderId = {$user->userId}) and receiverStatus = 0 and senderStatus = 0 order by messageId desc";
		$command=Yii::app()->db->createCommand($sql);
		$messages = $command->queryAll();
		$this->render('conversation',array('messages'=>$messages,'user'=>$user,'senderId'=>$senderId));
	}
	
	public function actionCompose()
	{
		$user = Yii::app()->session->get('user');
		$receiverId = isset($_REQUEST['receiverId']) ? $_REQUEST['receiverId']:0;
		$userObj = new Users();
		$receiver = $userObj->find("userId=".$receiverId);
		if(isset($_POST['message']) && $_POST['message'] != ""){
			$msg = trim($_POST['message']);
			$receiverId = isset($_REQUEST['receiverId']) ? $_REQUEST['receiverId']:0;
			if($msg != ""){
				$message = new Messages();
				$message->senderId = $user->userId;
				$message->receiverId = $receiverId;
				$message->message = $msg;
				//$message->status = 1;
				$message->sendDate = date('Y-m-d h:i:s');
				$message->save();
				$this->redirect(Utilities::createAbsoluteUrl('message','compose',array('receiverId'=>$receiverId,'success'=>true)));
				Yii::app()->end();
			}
		}
		$this->layout= '//layouts/popup';
		$this->render('compose',array('message'=>$success,'receiverId'=>$receiverId,'receiver'=>$receiver));
	}		
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}