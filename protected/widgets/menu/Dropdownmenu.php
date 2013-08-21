<?php
/*
 * Author 	: Dileep G
 * Email	: dileepgm@gmail.com
 * File   	: Dropdownmenu.php
 * Created on :  02-Jul-2012
 * Description : TODO
 *
 */
class Dropdownmenu extends CWidget
{
    public $dInterests = array(); 
	public $dSubscriptions = array();
	public $dVisitors = array();
	public $dMessages = array();
	public $dRequests = array();
	public $notifications = array();
	public $dMessagesCount;
	public $dMostVisitors = array();
	
	
	
	public function init()
    {
        // this method is called by CController::beginWidget()
    }
 
    public function run()
    {
        $user  = Yii::app()->session->get('user');
		
        $user = Users::model()->with('shortlist')->findbyPk($user->userId);
		$shortList = 0;
		$notifiyShort = array();
		/*
		if(isset($nUser->shortlist))
		{
		$condition = "status =0 AND userId IN ({$shortList}) AND notificationType ('album', 'family', 'documents','astro','reference','contact')";
		$shortList = $nUser->shortlist->profileID;
		$notifiyShort = Notifications::model()->findAll(array('condition'=>$condition,'order'=> 'createdate DESC' ));
		}
		*/
		//'album', 'family', 'documents','astro','reference','contact','password','subscribe','recharge','system'
		
		$usercondition = "status = 0 AND notificationType in ('password','subscribe','recharge','system')";
		$userNotification = $user->notification(array('condition'=>$usercondition,'order'=> 'createdate DESC' ));
		
		if(sizeof($userNotification))
		$this->notifications = $userNotification;

        
        
		$sql = "SELECT * FROM view_interests WHERE receiverId = {$user->userId}  and viewStatus = 0 order by interestId desc";
		$command=Yii::app()->db->createCommand($sql);
		$this->dInterests = $command->queryAll();
		
		$sql = "SELECT * FROM view_profile WHERE visitedId = {$user->userId} and counter = 1 and status = 0 order by profileViewId desc";
		$command=Yii::app()->db->createCommand($sql);
		$this->dVisitors = $command->queryAll();
		
		$sql = "SELECT * FROM view_messages WHERE receiverId = {$user->userId} and receiverStatus = 0 order by messageId desc limit 5";
		$command=Yii::app()->db->createCommand($sql);
		$this->dMessages = $command->queryAll();
		
		// message count
		$sql = "SELECT * FROM view_messages WHERE receiverId = {$user->userId} and status = 0 and receiverStatus = 0 order by messageId desc limit 5";
		$command=Yii::app()->db->createCommand($sql);
		$this->dMessagesCount = count($command->queryAll());
		
		$sql = "SELECT * FROM view_profile WHERE visitedId = {$user->userId} order by counter desc limit 10";
		$command=Yii::app()->db->createCommand($sql);
		$this->dMostVisitors = $command->queryAll();
		
		$this->renderFile(dirname(__FILE__)  . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR .'Dropdownmenu.php', array('dInterests'=>$this->dInterests,'dVisitors'=>$this->dVisitors,'dMessages'=>$this->dMessages,'notifications'=>$this->notifications,'dMessagesCount'=>$this->dMessagesCount,'dMostVisitors'=>$this->dMostVisitors));
    }
}

