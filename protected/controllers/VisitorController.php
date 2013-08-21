<?php

class VisitorController extends Controller
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
		//SELECT * FROM view_profile WHERE visitedId = 1 order by visitTime DESC limit 1,25
		$user = Yii::app()->session->get('user');
		$sql = "SELECT * FROM view_profile WHERE visitedId = {$user->userId} group by userID order by visitTime DESC limit 1,25";
		$command=Yii::app()->db->createCommand($sql);
		$users = $command->queryAll();
		
		
		$weekQuery  = "select count(userID) as num from profileviews where visitedId  =  {$user->userId} and DATE_SUB(CURDATE(),INTERVAL 7 DAY) <= visitTime";
		$command=Yii::app()->db->createCommand($weekQuery);
		$weekVisitor = $command->queryAll();
		
		$dailyQuery = "select count(userID) as num from profileviews where visitedId  = {$user->userId} and CURDATE() = DATE(visitTime)";
		$command=Yii::app()->db->createCommand($dailyQuery);
		$todayVisitor = $command->queryAll();
		
		
		$sql1 = "SELECT * FROM view_profile WHERE visitedId = {$user->userId} order by visitTime DESC limit 26,50 ";
		$command=Yii::app()->db->createCommand($sql1);
		$visitors = $command->queryAll();
		
		$sql1 = "SELECT * FROM view_profile WHERE visitedId = {$user->userId}";
		$command=Yii::app()->db->createCommand($sql1);
		$totalVisitors = count($command->queryAll());
		
		$this->render('index',array('users'=>$users,'visitors'=>$visitors,'weekly'=>$weekVisitor[0],'today'=>$todayVisitor[0],'totalVisitors'=>$totalVisitors));
	}
	
}