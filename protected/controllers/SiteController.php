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
				if($action->id == 'captcha')
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
	 *
	 *generateCaptcha
	 *
	 */
	
	public function actionCaptcha(){
		if( isset($_GET['_CAPTCHA']) && isset($_GET['ccT']) ) {
			
			$code = base64_decode($_GET['ccT']);
			//characters ABCDEFGHJKLMNPRSTUVWXYZabcdefghjkmnprstuvwxyz
			$bg_path = Yii::app()->params['mediaUrl'].'/captchaBackgrounds/';
			$font_path = Yii::app()->params['ftpPath'].'/font/';
			// Default values
			$captcha_config = array(
			   'code' => $code,
			   'min_length' => 5,
			   'max_length' => 5,
			   'backgrounds' => array(
				  $bg_path . '45-degree-fabric.png',
				  $bg_path . 'cloth-alike.png',
				  $bg_path . 'grey-sandbag.png',
				  $bg_path . 'kinda-jean.png',
				  $bg_path . 'polyester-lite.png',
				  $bg_path . 'stitched-wool.png',
				  $bg_path . 'white-carbon.png',
				  $bg_path . 'white-wave.png'
			   ),
			   'fonts' => array(
				  $font_path . 'times_new_yorker.ttf'
			   ),
			   'characters' => '1234567890',
			   'min_font_size' => 28,
			   'max_font_size' => 28,
			   'color' => '#666',
			   'angle_min' => 0,
			   'angle_max' => 10,
			   'shadow' => true,
			   'shadow_color' => '#fff',
			   'shadow_offset_x' => -1,
			   'shadow_offset_y' => 1
			);
			
			// Restrict certain values
			if( $captcha_config['min_length'] < 1 ) $captcha_config['min_length'] = 1;
			if( $captcha_config['angle_min'] < 0 ) $captcha_config['angle_min'] = 0;
			if( $captcha_config['angle_max'] > 10 ) $captcha_config['angle_max'] = 10;
			if( $captcha_config['angle_max'] < $captcha_config['angle_min'] ) $captcha_config['angle_max'] = $captcha_config['angle_min'];
			if( $captcha_config['min_font_size'] < 10 ) $captcha_config['min_font_size'] = 10;
			if( $captcha_config['max_font_size'] < $captcha_config['min_font_size'] ) $captcha_config['max_font_size'] = $captcha_config['min_font_size'];
			
			// Pick random background, get info, and start captcha
			$background = $captcha_config['backgrounds'][rand(0, count($captcha_config['backgrounds']) -1)];
			list($bg_width, $bg_height, $bg_type, $bg_attr) = getimagesize($background);
			
			$captcha = imagecreatefrompng($background);
			
			//$color = self::hex2rgb($captcha_config['color']);
			$color = array("r" => 102,"g" => 102,"b" => 102); 
			$color = imagecolorallocate($captcha, $color['r'], $color['g'], $color['b']);
			
			// Determine text angle
			$angle = rand( $captcha_config['angle_min'], $captcha_config['angle_max'] ) * (rand(0, 1) == 1 ? -1 : 1);
			
			// Select font randomly
			$font = $captcha_config['fonts'][rand(0, count($captcha_config['fonts']) - 1)];
			
			// Verify font file exists
			if( !file_exists($font) ) throw new Exception('Font file not found: ' . $font);
			
			//Set the font size.
			$font_size = rand($captcha_config['min_font_size'], $captcha_config['max_font_size']);
			$text_box_size = imagettfbbox($font_size, $angle, $font, $captcha_config['code']);
			
			// Determine text position
			$box_width = abs($text_box_size[6] - $text_box_size[2]);
			$box_height = abs($text_box_size[5] - $text_box_size[1]);
			$text_pos_x_min = 0;
			$text_pos_x_max = ($bg_width) - ($box_width);
			$text_pos_x = rand($text_pos_x_min, $text_pos_x_max);			
			$text_pos_y_min = $box_height;
			$text_pos_y_max = ($bg_height) - ($box_height / 2);
			$text_pos_y = rand($text_pos_y_min, $text_pos_y_max);
			
			// Draw shadow
			if( $captcha_config['shadow'] ){
				$shadow_color = array('r'=>255,'g'=>255,'b'=>255);
				$shadow_color = imagecolorallocate($captcha, $shadow_color['r'], $shadow_color['g'], $shadow_color['b']);
				imagettftext($captcha, $font_size, $angle, $text_pos_x + $captcha_config['shadow_offset_x'], $text_pos_y + $captcha_config['shadow_offset_y'], $shadow_color, $font, $captcha_config['code']);	
			}
			
			// Draw text
			imagettftext($captcha, $font_size, $angle, $text_pos_x, $text_pos_y, $color, $font, $captcha_config['code']);	
			
			// Output image
			header("Content-type: image/png");
			imagepng($captcha);
			exit;
		}
		else{
			echo json_encode(array('msg'=>'invalid request'));
			exit;
		}
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