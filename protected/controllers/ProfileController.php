<?php

class ProfileController extends Controller
{
	public function actionProfile()
	{
		$this->render('profile');
	}

	public function actionAdd()
	{
		if(isset($_POST['userId']) && !empty($_POST['userId']))
		{
		$usersList = Yii::app()->session->get('user');	
			if(isset($usersList->profileBlock))
			{
				if(isset($usersList->profileBlock->profileIDs))
				{
					$profileIds = explode(",", $usersList->profileBlock->profileIDs);
					$arr = array_merge($profileIds, array($_POST['userId']));
					$usersList->profileBlock->profileIDs = implode(",", $arr);
					$usersList->profileBlock->save();
					echo json_encode(TRUE);
					Yii::app()->end();	
				}
			}
			else {
				$block = new Profileblock();
				$block->userId = $usersList->userId;
				$block->profileIDs = $_POST['userId'];
				$usersList->profileBlock  = $block;
				$usersList->profileBlock->save();
			}
			echo json_encode(TRUE);
					Yii::app()->end();
		}
	}
	
}