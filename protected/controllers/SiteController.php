<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	
	public function beforeAction(CAction $action)
        {
        		if($action->id == 'logout')
        		return true;
        		if($action->id == 'error')
        		return true;
        		if($action->id == 'popup')
        		return true;
                $user = Yii::app()->session->get('user');
                if(isset($user)) {
                        $this->redirect(array('/mypage'));
                        return true;
                }       
                return true;
        }  
	
	

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		Yii::app()->params['loginError'] = NULL;
		$searchModel = new SearchForm();
		$model = new UserForm();
		$this->render('//user/register',array('model'=>$model,'searchModel' =>$searchModel));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;
		Yii::app()->params['loginError'] = NULL;
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->login())
			{
				Yii::app()->params['loginError'] = NULL;
				$user = Yii::app()->session->get('user');
				if($user->active == 2)
				{
					$user->active = 1;
					$user->save();
				}
				Yii::app()->getDb()->createCommand("SET time_zone='+05:30'")->execute();
				$userloggeddetails = new Userloggeddetails();
				$userloggeddetails->userId = $user->userId;
				$userloggeddetails->loggedIn = new CDbExpression('NOW()');
				$userloggeddetails->loggedOut = new CDbExpression('NOW()');
				$userloggeddetails->save();
				$this->redirect(array('/mypage/complete'));
			}
			else
			{	
				Yii::app()->params['loginError'] = true;
				$searchModel = new SearchForm();
				$model = new UserForm();
				$this->render('//user/register',array('model'=>$model,'searchModel' =>$searchModel,'loginError'=>UserIdentity::ERROR_USERNAME_INVALID));
				
			}
		}
		else
		{
		// display the login form
		$this->forward('index');
		}
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		$user = Yii::app()->session->get('user');
		if(!isset($user))
		$this->forward('index');
		 $user = Users::model()->findbyPk($user->userId);
		Yii::app()->getDb()->createCommand("SET time_zone='+05:30'")->execute();
		if(isset($user))
		$userLogged = $user->userloggeddetails(array('order'=>'loggedIn DESC','limit'=>1));
		if(isset($userLogged) && sizeof($userLogged) > 0)
		{		
			$userLogged[0]->loggedOut = new CDbExpression('NOW()');
			$userLogged[0]->save();
		}
		Yii::app()->user->logout();
		Yii::app()->session->clear();
		Yii::app()->session->destroy();
		$this->forward('index');
		
	}
	
// function to show popup when click on album, contact etc
	public function actionPopup()
	{
		$profileId = isset($_REQUEST['profileId']) ? $_REQUEST['profileId'] : 0;
		$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
		$module = isset($_REQUEST['module']) ? $_REQUEST['module'] : '';
		$this->layout= '//layouts/popup';
		$this->render('popup',array('profileId'=>$profileId,'action'=>$action,'module'=>$module));
	}
	
	public function actionPopuplogin()
	{
		if(isset($_POST) && !empty($_POST))
		{
			$form = new LoginForm();
			$form->attributes=$_POST['LoginForm'];
			$success = null;
			if($form->login())
			{
				Yii::app()->params['loginError'] = NULL;
				$success = true;
			}else{
				Yii::app()->params['loginError'] = true;
				$success = false;
			}
		}else{
			$success = null;
		}
		$this->layout= '//layouts/popup';
		$this->render('popuplogin',array('success'=>$success));
	}
}