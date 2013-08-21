<?php

class HighlightController extends Controller
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

		//get user from session
		$users = $user = Yii::app()->session->get('user');
		if($users->highlighted == 1	)
		{
			$this->render('index',array('isHighLighted'=>true));
		}
		else
		$this->render('index');
	}
	
	public function actionUpdate()
	{
		
		$users = $user = Yii::app()->session->get('user');
		$isHighLighted = false;
		if($users->highlighted == 1	)
		{
			$isHighLighted = true;
		}
		else if(isset($_POST['coupon']))
		{
			//get user from session
			Yii::app()->getDb()->createCommand("SET time_zone='+05:30'")->execute();
			$coupon = Coupon::model()->findByAttributes(array('couponCode'=>$_POST['coupon']),'isUsed=0');
			if(isset($coupon) && !empty($coupon)){
				
			$coupon->isUsed = 1;
			$coupon->save();
			
			$users->highlighted = 1 ;
			$users->save();
			$isHighLighted = true;
				
			$payment = new Payment();
			$payment->userID = $users->userId;
			$payment->couponcode = $_POST['coupon'];
			$payment->startdate = new CDbExpression('NOW()');
			$payment->actionItem = 'highlight';
			$payment->createdate =  new CDbExpression('NOW()');
			$payment->save();
			}
			
		}
		$this->render('index',array('isHighLighted'=> $isHighLighted));
	}
	
	public function actionShow()
	{
		$user = $user = Yii::app()->session->get('user');
		$condition = "highlighted = 1";
		$users = Users::model()->findAll(array('condition'=>$condition,'order'=> 'createdOn DESC' ),'active=1');
		
		if(sizeof($users) > 0)
		{
			
		$totalUser = sizeof($users);
		$totalPage = ceil($totalUser/10);	
		$this->render('highlights',array('users'=>$users,'totalUser'=>$totalUser,'totalPage' => $totalPage));
		}
		else
		{
			$this->render('highlights');
		}
	}

}