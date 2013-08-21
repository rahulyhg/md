<?php
/*
*
* $Id$
--------------------------------------------------------------------------------------------------------------------------
* Information contained in this file is the intellectual property of MarryDoor Plc
* Copyright © 2011 MarryDoor. All Rights Reserved.
* ---------------------------------------------------------------------------------------------------------------------------
*
* @author  Dileep G.
* @title AlbumController.php
* @description <Description of this class>
*  @filesource <URL>
*  @version <Revision>
*/
class AlbumController extends Controller
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
	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$marryId = isset($_GET['mId']) ? $_GET['mId']:'';
		$windowType = isset($_GET['wType']) ? $_GET['wType']:'normal';
		if($marryId != ''){
			$userObj = new Users();
			$user = $userObj->find("marryId='".$marryId."'");
			// set user id in session to avoid set in form hidden
			Yii::app()->session->add('profileUserId',$user->userId);
			$album = new Album();
			
			// user action goes here
			$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "";
			$loggedUser = Yii::app()->session->get('user');
			if($action == "expressInterest"){
				$interest = new Interests();
				$interest->senderId = $loggedUser->userId;
				$interest->receiverId = Yii::app()->session->get('profileUserId');
				$interest->sendDate = date('Y-m-d h:i:s');
				$interest->save();
			}elseif($action == "bookmark"){
				$bookmark = new Bookmark();
				$profileIds = $bookmark->find('userId='.$loggedUser->userId);
				//var_dump($profileIds);die;
				$id = $profileIds->profileIDs;
				if(count($profileIds) > 0){
					$ids = $id.",".Yii::app()->session->get('profileUserId');
					$bookmark->updateByPk($profileIds->bookMarkId,array('profileIDs'=>$ids));
				}else{
					$bookmark->userID = $loggedUser->userId;
					$bookmark->profileIDs = Yii::app()->session->get('profileUserId');
					$bookmark->save();
				}
			}
			$photosList = $album->findAll('userId='.$user->userId);
			$this->render('index',array('photosList' => $photosList,'user' => $user));
		}else{
			$message = Yii::t('error','invalidRequest');
			$this->render('index',array('message' => $message));
		}
	}
	
	public function actionAdd()
	{
		$user = Yii::app()->session->get('user');
		$message = "";
		//Upload the profile photo
  		$photoCount = isset($_POST['photoCount']) ? $_POST['photoCount']:1; 
  		for($i = 1; $i < $photoCount; $i++){		  
		if (!empty($_FILES['profilePhoto_'.$i]['tmp_name'])){  
				$file = $_FILES['profilePhoto_'.$i];
				$fileName=basename( $_FILES['profilePhoto_'.$i]['name']);   
				$extension = strtolower(Utilities::getExtension($fileName));  
				if(Utilities::isValidImageExtension($extension)){         
				 	$path = Utilities::getDirectory('images',array('profile',$user->marryId)); 
				 	$fileName = $user->marryId.date("his").".".$extension; 
					$targetPath = Utilities::getFullFilePath($path, $fileName);
					$description = trim($_POST['description_'.$i]);
					if(Utilities::uploadFile($_FILES['profilePhoto_'.$i]['tmp_name'], $targetPath)) {
						//code to insert to db
						$album = new Album();
						$album->userId = $user->userId;
						$album->imageName = $fileName;
						$album->description = $description;
						$album->save();
						
						$notification = new Notifications();
						$notification->userId = $user->userId;
						$notification->name = $user->name;
						$notification->marryId = $user->marryId;
						$notification->notificationType = 'album';
						$notification->notification = Utilities::getNotificationMessage('album');
						$notification->status = 0;
						$notification->createdate = new CDbExpression('NOW()');
						$notification->save();
						
						
						$message = "Photo has been uploaded successfully!";
					}else{
						$message = "There was an error uploading the file, please try again!";
					}				
				}	
					
			}
			sleep(1); // set a time delay to upload
  		}
		$this->render('add',array('message'=>$message));
	}
	
	
	public function actionView(){
		$marryId = isset($_REQUEST['mId']) ? $_REQUEST['mId']:'';
		$windowType = isset($_REQUEST['wType']) ? $_REQUEST['wType']:'normal';
		//load layout depends on the window
		if($windowType == 'popup'){
			$this->layout= '//layouts/popup';
		}
		if($marryId != ''){
			$userObj = new Users();
			$user = $userObj->find("marryId='".$marryId."'");
			$loggedUser = Yii::app()->session->get('user');
			$settings = Utilities::getUserPrivacySettings($user->userId);
			$albumSetting = Utilities::getUserPrivacyStatus($settings,'album');
			$flag = false;
			/*if($albumSetting == 'request'){
				if(Utilities::getUserPrivacyRequestStatus('album',$loggedUser->userId,$user->userId)){
					$flag = true;
				}else{
					$flag = false;
					$url = Utilities::createAbsoluteUrl('request','popup',array('action'=>'request','module'=>'album','profileId'=>$user->userId)); 
				}
			}elseif($albumSetting == 'members'){
				if(isset($loggedUser)){
					$flag = true;
				}else{
					$flag = false;
					$url = Utilities::createAbsoluteUrl('site','index');
				}
			}else*/

				// set user id in session to avoid set in form hidden
				Yii::app()->session->add('profileUserId',$user->userId);
				$photo = new Photos();
				
				// user action goes here
				$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "";
				
				if($action == "expressInterest"){
					
					if(sizeof($loggedUser->interestSender(array('condition'=>'senderId='.$loggedUser->userId.' and receiverId='.$user->userId)))> 0){
						$error = 'Already expressed interest';
					}else{
						$interest = new Interests();
						$interest->senderId = $loggedUser->userId;
						$interest->receiverId = Yii::app()->session->get('profileUserId');
						$interest->sendDate = date('Y-m-d h:i:s');
						$interest->save();
					}
				}elseif($action == "bookmark"){
					$bookmark = new Bookmark();
					$profileIds = $bookmark->find('userId='.$loggedUser->userId);
					$id = $profileIds->profileIDs;
					if(count($profileIds) > 0){
						$ids = $id.",".Yii::app()->session->get('profileUserId');
						$bookmark->updateByPk($profileIds->bookMarkId,array('profileIDs'=>$ids));
					}else{
						$bookmark->userID = $loggedUser->userId;
						$bookmark->profileIDs = Yii::app()->session->get('profileUserId');
						$bookmark->save();
					}
				}
				$photosList = $photo->findAll('userId='.$user->userId);
				$this->render('view',array('photosList' => $photosList,'user' => $user,'windowType'=>$windowType));

		}else{
			$message = Yii::t('error','invalidRequest');
			$this->render('view',array('message' => $message));
		}
	}
	
	public function actionFamily(){
			$marryId = isset($_REQUEST['mId']) ? $_REQUEST['mId']:'';
			$windowType = isset($_REQUEST['wType']) ? $_REQUEST['wType']:'normal';
			//load layout depends on the window
			if($windowType == 'popup'){
				$this->layout= '//layouts/popup';
			}
			if($marryId != ''){
				$userObj = new Users();
				$user = $userObj->find("marryId='".$marryId."'");
				$loggedUser = Yii::app()->session->get('user');
				$photo = new Album();
				$photosList = $photo->findAll('userId='.$user->userId.' and type = 1');
			}
			$this->render('family',array('photosList' => $photosList,'user' => $user,'windowType'=>$windowType));
	}
	
	public function actionDocument(){
			$marryId = isset($_REQUEST['mId']) ? $_REQUEST['mId']:'';
			$windowType = isset($_REQUEST['wType']) ? $_REQUEST['wType']:'normal';
			//load layout depends on the window
			if($windowType == 'popup'){
				$this->layout= '//layouts/popup';
			}
			if($marryId != ''){
				$userObj = new Users();
				$user = $userObj->find("marryId='".$marryId."'");
				$loggedUser = Yii::app()->session->get('user');
				$document = new Documents();
				$documentsList = $document->findAll('userId='.$user->userId);
			}
			$this->render('document',array('documentsList' => $documentsList,'user' => $user,'windowType'=>$windowType));
	}
	
}