<?php

class PaymentController extends Controller
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
		$this->render('index');
		
	}
	
	
	public function actionUpdate()
	{
		
		$user = Yii::app()->session->get('user');
		$isHighLighted = false;
		
		
		
		if(isset($_POST['coupon']))
		{
			//get user from session
			Yii::app()->getDb()->createCommand("SET time_zone='+05:30'")->execute();
			$coupon = Coupon::model()->findByAttributes(array('couponCode'=>$_POST['coupon']),'status=1');
			$newStart = false;
			$endDate = null;
			$user->payment = Payment::model()->findAll(array('condition'=>"userId = {$user->userId}"));
			if(isset($user->payment) && sizeof($user->payment)>0  )
			{
				
				$payments = $user->payment(array('order'=> 'startdate DESC limit 0,1'));
				$payment = $payments[0];
				$currentDate = new DateTime('now');
				$endDate = new DateTime($payment->startdate);
				$endDate->modify('90 days');
				if($endDate > $currentDate) 
				{
					$newStart = true;
				}
					$notification = new Notifications();
					$notification->userId = $user->userId;
					$notification->name = $user->name;
					$notification->marryId = $user->marryId;
					$notification->notificationType = 'recharge';
					$notification->notification = Utilities::getNotificationMessage('recharge');
					$notification->status = 0;
					$notification->createdate = new CDbExpression('NOW()');
					$notification->save();
							
			}
			else
			{
						$notification = new Notifications();
						$notification->userId = $user->userId;
						$notification->name = $user->name;
						$notification->marryId = $user->marryId;
						$notification->notificationType = 'subscribe';
						$notification->notification = Utilities::getNotificationMessage('subscribe');
						$notification->status = 0;
						$notification->createdate = new CDbExpression('NOW()');
						$notification->save();
								
			}
			
			$isValid = false;
			if(isset($coupon) && !empty($coupon)){
				if($coupon->couponType == 'promo')
					{
						$isValid = true;
					}
				else if($coupon->isUsed == 0){
					$isValid = true;
				}	
				
				if($isValid) {
				$coupon->isUsed = 1;
				$coupon->save();
				$user->userType = 1; 
				$user->save();
				$payment = new Payment();
				$payment->userID = $user->userId;
				$payment->couponcode = $_POST['coupon'];
				if($newStart)
				$payment->startdate = $endDate->format('Y-m-d H:i:s');
				else
				$payment->startdate = new CDbExpression('NOW()');
				$payment->actionItem = 'membership'; 
				$payment->createdate = new CDbExpression('NOW()');
				$payment->save();
				}
			}
			
		}
		$this->forward('summary');
	}
	
	public function actionRecharge()
	{
		$this->render('recharge');
	}
	
public function actionSubscribe()
	{
		$this->render('subscribe');
	}
	
	public function actionSummary()
	{
		$loggedUser = Yii::app()->session->get('user');
		$payments = $loggedUser->payment(array('order'=> 'actionItem,createdate ASC'));
		if(isset($payments ) && sizeof($payments) > 0)
		{
			$this->render('summary',array('payment' =>$payments));
		}
		else
		{
			$this->render('nopayment');
		}
	}
	
}