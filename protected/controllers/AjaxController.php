<?php

class AjaxController extends Controller
{
	
      
	 public function beforeAction(CAction $action)
        {
                $user = Yii::app()->session->get('user');
                
                if( $action->id == 'updateplaces' || $action->id == 'coupon'  || $action->id == 'useremail' || $action->id == 'username'  || $action->id == 'usermobile' || $action->id == 'updateCaste' || $action->id == 'updateCastes'  || $action->id == 'updateState' || $action->id == 'updateDistrict' )
        		return true;
                if(!isset($user)) {
                        $this->redirect(Yii::app()->user->loginUrl);
                        return false;
                }       
                return true;
        }
		
	public function actionIndex()
	{

	}

	public function actionPhotoclear()
	{
		$user = Yii::app()->session->get('user');
		// remove the unwanted records from table
		$query = 'delete from photos where userId ='.$user->userId.' and active = 2';
		Utilities::executeRawQuery($query);
	}
	
	public function actionFamilyphotoclear()
	{
		$user = Yii::app()->session->get('user');
		// remove the unwanted records from table
		$query = 'delete from album where userId ='.$user->userId.' and type=1 and active = 2';
		Utilities::executeRawQuery($query);
	}
	
	public function actionDocumentclear()
	{
		$user = Yii::app()->session->get('user');
		// remove the unwanted records from table
		$query = 'delete from documents where userId ='.$user->userId.' and active = 2';
		Utilities::executeRawQuery($query);
	}
	
	public function actionUseremail()
	{
			$condition = "emailId = '{$_GET['email']}' ";
			$record = Users::model()->find(array('condition' => $condition));
			if(isset($record) && $record['emailId'] != null){
				echo json_encode(TRUE);	
			}
			else
			echo json_encode(FALSE);
			Yii::app()->end();
	}
	
	public function actionUsername()
	{
			$bannedNames = array('sex','fuck','suck','hot','bloody','basterd','marrydoor','doormarry','bloodymary','bloodymarry','fucker','idiot','raskal');
			if(in_array($_GET['name'], $bannedNames))
				echo json_encode(TRUE);	
			else
				echo json_encode(FALSE);
			Yii::app()->end();
	}
	
	public function actionUsermobile()
	{
			$condition = "mobilePhone = '{$_GET['mobile']}' ";
			$record = Userpersonaldetails::model()->find(array('condition' => $condition));
			if(isset($record) && $record['mobilePhone'] != null){
				echo json_encode(TRUE);	
			}
			else
			echo json_encode(FALSE);
			Yii::app()->end();
	}
	
	public function actionUpdateDistrict()
	{
		//States
            $records = Districts::model()->findAll('stateId=:stateId and active=1', array(':stateId'=>(int) $_POST['stateId']));
            $list = CHtml::listData($records, 'districtId', 'name');
            $dropDownDist = "<option value=''>Select District</option>"; 
            foreach($list as $value=>$name)
                $dropDownDist .= CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
 
            // return data (JSON formatted)
            echo CJSON::encode(array(
              'dropDownDist'=>$dropDownDist,
            ));
	}
	
	public function actionUpdateState()
	{
		//States
            $records = States::model()->findAll('countryId=:countryId and active=1', array(':countryId'=>(int) $_POST['countryId']));
            $list = CHtml::listData($records, 'stateId', 'name');
            $dropDownStates = "<option value=''>Select State</option>"; 
            foreach($list as $value=>$name)
                $dropDownStates .= CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
 
            // return data (JSON formatted)
            echo CJSON::encode(array(
              'dropDownStates'=>$dropDownStates,
            ));
	}
	
	public function actionUpdateCaste()
	{
		//Castes
            $records = Caste::model()->findAll('religionId=:religionId and active=1', array(':religionId'=>(int) $_POST['religionId']));
            $list = CHtml::listData($records, 'casteId', 'name');
            $dropDownCastes = "<option value=''>Select Caste</option>"; 
            foreach($list as $value=>$name)
                $dropDownCastes .= CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
 
            // return data (JSON formatted)
            echo CJSON::encode(array(
              'dropDownCastes'=>$dropDownCastes,
            ));
		
	}
	
	public function actionUpdateCastes()
	{
		//Castes
            $records = Caste::model()->findAll('religionId=:religionId and active=1', array(':religionId'=>(int) $_POST['religionId']));
            $list = CHtml::listData($records, 'casteId', 'name');
            $dropDownCastes = ""; 
            foreach($list as $value=>$name)
                $dropDownCastes .= CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
 
            // return data (JSON formatted)
            echo CJSON::encode(array(
              'dropDownCastes'=>$dropDownCastes,
            ));
		
	}
	
	
	public function actionUpdatePlaces()
	{
		//States
            $records = Places::model()->findAll('districtId=:districtId and active=1', array(':districtId'=>(int) $_POST['districtId']));
            $list = CHtml::listData($records, 'placeId', 'name');
            $dropDownDist = "<option value=''>Select Places</option>"; 
            foreach($list as $value=>$name)
                $dropDownDist .= CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
 
            // return data (JSON formatted)
            echo CJSON::encode(array(
              'dropDownDist'=>$dropDownDist,
            ));
	}
	
	public function actionDeleteReference()
	{
		$user = Yii::app()->session->get('user');
		if(isset($_POST['referId']))
		{
			$reference = $user->references(array('condition'=>"referenceId = {$_POST['referId']}"));

			if( is_array($reference )) {
				foreach( $reference  as $relRecord ) {
					$relRecord->delete();
				}
			}
			else {
				$reference->delete();
			}

				$user->references = Reference::model()->findAll(array('condition'=>"userId = {$user->userId}"));
				echo json_encode(TRUE);
			
		}
		else
		echo json_encode(FALSE);
	}
	
	/*
	 * 
	 * cal this only for promo, this can be used only once by a user who hasnt subscribed to the site
	 * 
	 */
	public function actionCoupon()
	{
		if(isset($_POST['coupon'])) {
				
			
			$coupon = Coupon::model()->findByAttributes(array('couponCode'=>$_POST['coupon']));
			if(isset($coupon) && $coupon->status == 1)
			{
				$user = Yii::app()->session->get('user');
				if($coupon->couponType == 'normal' && $coupon->isUsed == 1)
				echo json_encode(FALSE);
				else if($coupon->couponType == 'promo')
				{
					if(isset($user))
					{
						$payment = Payment::model()->findByAttributes(array('couponcode'=>$_POST['coupon'],'userID'=>$user->userId));
						if(isset($payment) && $payment->userID)
						echo json_encode(FALSE);
					}
					else 	
					echo json_encode(TRUE);
				}
				
				
				
			}
			else
			echo json_encode(FALSE);
		}
		else
		echo json_encode(FALSE);

	}
	
	public function actionRecoupon()
	{
		if(isset($_POST['coupon'])) {
				
			$user = Yii::app()->session->get('user');
			$coupon = Coupon::model()->findByAttributes(array('couponCode'=>$_POST['coupon']),'isUsed=0');
			if(isset($coupon) && $coupon->status == 1 && $coupon->couponType == 'normal' && $coupon->isUsed == 0)
			{
					$payment = Payment::model()->findByAttributes(array('couponcode'=>$_POST['coupon'],'userID'=>$user->userId));
					if(isset($payment) && $payment->userID)
					echo json_encode(FALSE);
					else
					echo json_encode(TRUE);

			}
			else
			echo json_encode(FALSE);
		}
		else
		echo json_encode(FALSE);

	}
	
	public function actionNotify()
	{
		if(isset($_POST['userId']) && !empty($_POST['userId'])) {
			$userIds = implode(",", $_POST['userId']);
		// remove the unwanted records from table
		$query = "update notifications set status = 1 where userId in ({$userIds})";
		Utilities::executeRawQuery($query);
		}
	}
	
	public function actionUpdateInvitation()
	{
		$user = Yii::app()->session->get('user');
		if(isset($_POST['email']) && !empty($_POST['email'])) {
			$body = '<html><body>
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
                                            <td valign="middle" height="35"><span style="color:#ffffff;font-size:24px;margin-left:20px;float:left">Wow..! You have been invited to join marrydoor!</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table width="590" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center" style="background-color:#ffffff;padding-bottom:30px;padding-top:30px"> 
                                    <tbody>
                                        <tr>
                                            <td valign="top" bgcolor="#ffffff">
                                                <font style="font:normal 16px arial;text-align:justify;color:#666666;float:left;margin-left:20px;margin-right:20px">
                                                     '.$user->name.' '.($user->marryId).' Invited you to join Marrydoor.
                                                </font>
                                            </td>
                                        </tr>
                                        <tr>
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
MarryDoor.com Privacy Policy.MarryDoor.com is not responsible for content other 
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
</body>
</html>';
       				Utilities::sendClaimEmail($_POST['email'],'Wow..! Marrydoor welcomes you!',$body);
			$invite = new Invitations();
			$invite->userId =  $user->userId;
			$invite->email = $_POST['email'];
			$invite->status = 0;
			$invite->createdate = new CDbExpression('NOW()');
			$invite->save(); 
			echo json_encode(TRUE);
		}
	}
	
	public function actionUpdatetopmenu()
	{
		$user = Yii::app()->session->get('user');
		$tab = isset($_POST['tab'])?$_POST['tab']:"";
		if($tab != ""){
			switch($tab){
				case 'tab1':
					$query = "update interests set viewStatus = 1 where receiverId = {$user->userId} and viewStatus = 0";
					break;
				case 'tab2':
					$query = "update notifications set status = 1 where userId = {$user->userId} and status = 0";
					break;
				case 'tab3':
					$query = "update profileviews set status = 1 where visitedId = {$user->userId} and status = 0";
					break;
				case 'tab4':
					$query = "update messages set status = 1 where receiverId = {$user->userId} and status = 0";
					break;
				case 'tab5':
					$query = "";
					break;
			}
		}
		if($user->userType == '0')
		$query = "";
		if($query != ""){
			Utilities::executeRawQuery($query);
			echo true;
			die;
		}else{
			echo false;
			die;
		}
	}
	
	public function actionDeletemessage()
	{
		$user = Yii::app()->session->get('user');
		$messageId = isset($_POST['messageId'])?$_POST['messageId']:0;
		if($messageId != 0){
			$query = "update messages set receiverStatus = 1 where receiverId = {$user->userId}";
			Utilities::executeRawQuery($query);
			echo true;
			die;
		}else{
			echo false;
			die;
		}
	}
}