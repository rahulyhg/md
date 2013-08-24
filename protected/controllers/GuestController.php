<?php

class GuestController extends Controller
{
	public function actionIndex()
	{
		$this->layout= '//layouts/single';
		$this->render('guest');
	}
	
	public function actionForget()
	{
		$this->layout= '//layouts/popup';
		if(isset($_POST['email']))
		{
			$user = Users::model()->findByAttributes(array('emailId'=>$_POST['email']),'active=1');
			if(isset($user))
			{
				$emailSent = true;
				$paswd = $this->generateRandomString();
				$user->password = new CDbExpression("MD5('{$paswd}')");
				$user->save();
				$body = "Your password has been reset successfully.Your new password is ".$paswd;
				Utilities::sendClaimEmail($user->emailId,'Password Reset',$body);
				$this->render('forgot',array('sent'=>$emailSent));
			}
			else
			{
				$emailSent = false;
				$this->render('forgot',array('sent'=>$emailSent));
			}
		}
		else
		{
			
			$this->render('forgot');
		}
	}
	
	public function actionPrivacy()
	{
		$this->layout= '//layouts/popup';
		$this->render('privacy');
	}
	public function actionFaq()
	{
		$this->layout= '//layouts/popup';
		$this->render('faq');
	}
	
	public function actionAbout()
	{
		$this->layout= '//layouts/popup';
		$this->render('about');
	}
	public function actionTerms()
	{
		$this->layout= '//layouts/popup';
		$this->render('terms');
	}
	public function actionContact()
	{
		$this->layout= '//layouts/popup';
		$this->render('contact');
	}
	
	public function actionFeedback()
	{
		$this->layout= '//layouts/popup';
		
		if(!empty($_POST))
		{
			$feedback = new Feedback();
			if(isset($_POST['friendliness']))
			$feedback->friendliness = $_POST['friendliness'];
			if(isset($_POST['service']))
			$feedback->service = $_POST['service'];
			if(isset($_POST['privacy']))
			$feedback->privacy = $_POST['privacy']; 
			if(isset($_POST['payment']))
			$feedback->payment = $_POST['payment']; 
			if(isset($_POST['reseller']))
			$feedback->reseller = $_POST['reseller'];
			if(isset($_POST['name']))
			$feedback->name = $_POST['name']; 
			if(isset($_POST['email']))
			$feedback->email = $_POST['email'];
			if(isset($_POST['message']))
			$feedback->message = $_POST['message'];
			if(isset($_POST['feedType']) && !empty($_POST['feedType']))
			$feedback->feedType = $_POST['feedType'];
			$feedback->save();
			$this->render('feedback',array('submit'=>true));
		}
		else
		$this->render('feedback');
	}
	
	
	public function actionTest()
	{
		
			$feedback = new Feedback();
			$feedback->friendliness = 1;
			$feedback->service = 2;
			$feedback->privacy = 3;
			$feedback->payment = 5; 
			//$feedback->reseller = "fried4";
			//$feedback->name = "fried5"; 
			//$feedback->email = "fried6";
			//$feedback->message = "fried7";
			//$feedback->feedType = "fried8";
			$feedback->save();
	}
	
	
	public function actionUser()
	{
		$searchModel = new SearchForm();
		$model = new UserForm();
		//$this->layout= '//layouts/single';
		$this->render('newuser',array('model'=>$model,'searchModel' =>$searchModel));
	}
	
	function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, strlen($characters) - 1)];
	    }
	    return $randomString;
	}
	
	public function actionPaiduser()
	{
		$searchModel = new SearchForm();
		$model = new UserForm();
		//$this->layout= '//layouts/single';
		$this->render('paiduser',array('model'=>$model,'searchModel' =>$searchModel));
	}
}