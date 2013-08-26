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
				$body = '
				<html><body>
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
                                            <td valign="middle" height="35"><span style="color:#ffffff;font-size:24px;margin-left:20px;float:left">Your password...!</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table width="590" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center" style="background-color:#ffffff;padding-bottom:40px;padding-top:30px"> 
                                    <tbody>
                                        <tr>
                                            <td valign="top" bgcolor="#ffffff">
                                                <font style="font:normal 20px arial;text-align:justify;color:#408ef8;float:left;margin-left:20px;margin-right:20px;margin-bottom:10px">
                                                    <a target="_blank" href="https://google.com" style="text-decoration:none;color:#408ef8"> Hi '.$user->name.' '.($user->marryId).', </a>
                                                </font>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top" bgcolor="#ffffff">
                                                <font style="font:normal 16px arial;text-align:justify;color:#666666;float:left;margin:0 20px 30px">
                                                    Your password has been reset successfully.Your new password is '.$paswd.' 
                                                </font>
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
MarryDoor.com Privacy Policy. MarryDoor.com is not responsible for content other 
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
</body></html>
' ;
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