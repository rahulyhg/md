<?php

class AddressbookController extends Controller
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
		
		$usersList = Yii::app()->session->get('user');
		$userBook = Addressbook::model()->findByAttributes(array('userID' => $usersList->userId));
		if(isset($userBook) && isset($userBook->visitedId)){
		$condition = "userId in ($userBook->visitedId)";
		$users = Users::model()->findAll(array('condition'=>$condition,'order'=> 'createdOn DESC' ),'active=1');
		
		if(sizeof($users) > 0)
		{
			
		$totalUser = sizeof($users);
		$totalPage = ceil($totalUser/10);	
		$this->render('index',array('users'=>$users,'totalUser'=>$totalUser,'totalPage' => $totalPage));
		}
		else
		{
			$this->render('noaddress');
		}
		
		}
		else 
		{
			$this->render('noaddress');
		}
	}
	
	
	public function actionRemove()
	{
		if(isset($_POST['userId']) && !empty($_POST['userId']))
		{
			//change this from session
			$usersList = Yii::app()->session->get('user');
			
			if(isset($usersList->addressBook))
			{
				if(isset($usersList->addressBook->visitedId ))
				{
					$profileIds = explode(",", $usersList->addressBook->visitedId);
					$arr = array_diff($profileIds, array($_POST['userId']));
					
					if(sizeof($arr) > 0 ){
					$usersList->addressBook->visitedId = implode(",", $arr);
					$usersList->addressBook->save();
					}
					else
					{
						$usersList->addressBook->delete();
						$usersList->addressBook = null;
					}
					echo json_encode(TRUE);
					Yii::app()->end();
				}
			}
			
			
		}
	}
	
	public function actionRemoveAll()
	{
		
	if(isset($_POST['userId']) && !empty($_POST['userId']))
		{
			$usersList = Yii::app()->session->get('user');	
			if(isset($usersList->addressBook))
			{
				if(isset($usersList->addressBook->visitedId))
				{
					$profileIds = explode(",", $usersList->addressBook->visitedId);
					$arr = array_diff($profileIds, $_POST['userId']);
					if(sizeof($arr) > 0 ){
					$usersList->addressBook->visitedId = implode(",", $arr);
					$usersList->addressBook->save();
					}
					else
					{
						$usersList->addressBook->delete();
						$usersList->addressBook = null;
					}
					echo json_encode(TRUE);
					Yii::app()->end();
				}
			}
			
		}
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