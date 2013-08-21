<?php
/*
 *
 * $Id$
 --------------------------------------------------------------------------------------------------------------------------
 * Information contained in this file is the intellectual property of MarryDoor Plc
 * Copyright © 2011 MarryDoor. All Rights Reserved.
 * ---------------------------------------------------------------------------------------------------------------------------
 *
 * @author  Ageesh K Gopinath
 * @title MypageController.php
 * @description <Description of this class>
 *  @filesource <URL>
 *  @version <Revision>
 */
class MypageController extends Controller
{

	public function beforeAction(CAction $action)
	{
		$user = Yii::app()->session->get('user');
		$user = Users::model()->findbyPk($user->userId);
		Yii::app()->session->add('user',$user);
		if(!isset($user)) {
			$this->redirect(Yii::app()->user->loginUrl);
			return false;
		}
		return true;
	}

	public function actionIndex()
	{
		$user = Yii::app()->session->get('user');
		$user = Users::model()->findbyPk($user->userId);
		
		/*
		//$condition = "userId in ($userIds)";	
		$scondition = "FIND_IN_SET('{$user->userId}',profileIDs)";
		$profileBlock = ProfileBlock::model()->findAll(array('condition'=>$scondition));
		$profileUpdatedUsers = null;
		
		$blockId = array();
		foreach ($profileBlock as $key => $value) {
			$blockId[] = $value->userId;
		}
		$blockIdList = implode(",", $blockId);
			
		$sendInterest = $user->interestSender;	
		$suserId = array();
		if(sizeof($sendInterest) > 0){
		$userInterest = array();
		foreach ($sendInterest as $value) {
			$suserId[] = $value->receiverId;
		}
		}
		
		
		$receiveInterest = $user->interestReceiver;
		$ruserId = array();
		if(sizeof($receiveInterest) > 0){
		$userInterest = array();
		foreach ($receiveInterest as $value) {
			$ruserId[] = $value->senderId;
		}
		}
		
		if(sizeof($suserId) > 0 || sizeof($ruserId) > 0 )
		{
			$profileIds = array();
			$intersetUserIds = array_merge($suserId,$ruserId);
			$userList = implode(",", $intersetUserIds);
			$scondition = " userId in ({$userList})";
			$profileUpdated = ProfileUpdates::model()->findAll(array('condition'=>$scondition));
			foreach ($profileUpdated as $key => $value) {
			$profileIds[] = $value->userId;
				}
			$profileIdLists = implode(",", $profileIds);
			
			if(isset($profileIds) && sizeof($profileIds) > 0 ) {
			$condition = "userId IN({$profileIdLists})"; 
			
			$profileUpdatedUsers = Users::model()->findAll(array('condition'=>$condition));
			}
		}
		*/
		
		if(isset($user->partnerpreferences))
		{
			$condition  = Utilities::getPartnerPreference($user->partnerpreferences);
			
			if($user->gender == 'M')
			$condition .= " AND gender = 'F'";
			else
			$condition .= " AND gender = 'M'";
			
			$usersV = ViewUsers::model()->findAll(array('condition'=>$condition,
			'select'=>'t.userId',
    		'distinct'=>true,
			'order'=> 'createdOn DESC' ));
		$userIds = array();
		foreach ($usersV as $key => $value) {
			$userIds[] = $value->userId; 
		}

			if(sizeof($userIds) > 0 )
			{
				$userList = implode(",", $userIds);
				$scondition = " userId in ({$userList}) AND userId != {$user->userId} ";
				if(isset($blockIdList) && sizeof($blockId) > 0 )
				$scondition .= " AND userId NOT IN({$blockIdList})"; 
				
				$users = Users::model()->findAll(array(
				'condition'=>$scondition,
				'order'=> 'createdOn DESC' ),'active=1');

				

				$highLightUser = array();
				$normalUser = array();
				foreach ($users as $key => $value) {
					if($value->highlighted == 1 )
					$highLightUser[] = $value;
					else
					$normalUser[] = $value;
				}
				if(sizeof($normalUser) > 0 || sizeof($highLightUser) > 0)
				{
				$totalUser = sizeof($normalUser);
				$totalPage = ceil($totalUser/10);
				$this->render('index',array('highlight'=>$highLightUser,'normal'=>$normalUser,'totalUser'=>$totalUser,'totalPage' => $totalPage));
				//$this->render('index');
				}
				
			}
			else 
			$this->render('index');
		}
		else
		{
			$this->render('index');
		}
	}

	public function actionComplete()
	{
		$percentage = 100;
		$user = Yii::app()->session->get('user');
		$statusArray = Utilities::getProfileCompleteStatus();
		
		$profile = false;
		$family = false;
		$document = false;
		$astro = false;
		$reference = false;
		$contact = false;
		$physical = false;
		$education = false;
		$partner  = false;
		$hobbies = false;
		$album = false;
		
		if(!isset($user->userpersonaldetails))
		{
			$percentage = $percentage - $statusArray['personal'];
				
		}
		if(!isset($user->usercontactdetails))
		{
			$percentage = $percentage - $statusArray['contact'];
			//$contact = true;
		}
		if(!isset($user->physicaldetails))
		{
			$percentage = $percentage - $statusArray['physical'];
			//$physical = true;
			
		}
		if(!isset($user->educations))
		{
			$percentage = $percentage - $statusArray['education'];
			//$education = true;
				
		}
		if(!isset($user->habits))
		{
			$percentage = $percentage - $statusArray['habit'];
			//$habits = true;
			
		}
		if(!isset($user->familyprofiles))
		{
			$percentage = $percentage - $statusArray['family'];
			//$family = true;
					
		}
		if(!isset($user->partnerpreferences))
		{
			$percentage = $percentage - $statusArray['partner'];
			//$partner  = true;
		
		}
		if(!isset($user->hobies))
		{
			$percentage = $percentage - $statusArray['hobby'];
			//$hobbies = false;
		
		}
		if(!isset($user->horoscopes))
		{
				$percentage = $percentage - $statusArray['astro'];
				//$astro = true;
		}
			if(sizeof($user->references) == 0 )
			{
				$percentage = $percentage - $statusArray['reference'];
				//$reference = true;
			}
			if(sizeof($user->documents) == 0)
			{
				$percentage = $percentage - $statusArray['documents'];
				//$document = true;
			}
	
		if(isset($user->album))
		{
			$falbum = $user->album(array('condition'=>'type=1'));
			if(sizeof($falbum) == 0){
			$percentage = $percentage - $statusArray['album'];
			//$album = true;				
			}
		}
	
		if(isset($user->photos))
		{
			$profileImage = $user->photos(array('condition'=>'profileImage=1'));
			if(sizeof($profileImage) == 0)
			{
			$percentage = $percentage - $statusArray['profile'];
			//$profile = true;
			}
		}
	
		if($percentage != 100)
		{
		Yii::app()->session->add('percentage',$percentage);	
		$this->render('complete',
		array('percent'=>$percentage,'astro'=>$astro,'profile'=>$profile,'album'=>$album,'document'=>$document,'reference'=>$reference,
		'profile'=>$profile,
		'family'=> $family,
		'document'=>$document,
		'astro'=> $astro,
		'reference'=> $reference,
		'contact'=> $contact,
		'physical' => $physical,
		'education' => $education,
		'partner' => $partner,
		'hobbies' => $hobbies,
		));
		}
		else
		$this->forward('index');
	}
	
	public function actionMyprofile()
	{
		$this->render('myprofile');
	}

	public function actionContact()
	{
		$this->render('mycontact');
	}
	public function actionEditcontact()
	{
		$user = Yii::app()->session->get('user');
		$userPersonal = $user->userpersonaldetails;
		
		
		if(isset($user->usercontactdetails))
		{
			$contact = $user->usercontactdetails;
		}
		else
		{
			$contact = new Usercontactdetails();
			$contact->userId = $user->userId;
		}
		
		if(isset($_POST['mobile'])){
		if(isset($_POST['mobile']))
		$userPersonal->mobilePhone = $_POST['mobile'];
		$userPersonal->save();	
			
		$userAddrs = $user->addresses;
		if(isset($userAddrs)) {
		if( is_array($userAddrs)) {
				foreach( $userAddrs  as $relRecord ) {
					$relRecord->delete();
				}
			}
			else {
				$userAddrs->delete();
			}
		}	
			
		$address = new Address();
		$address->addresType = 0;
		$address->userId = $user->userId; 
		//communication address
		if(isset($_POST['house1']))
		$address->houseName = $_POST['house1'];
		if(isset($_POST['houseplace1']))
		$address->place = $_POST['houseplace1'];
		if(isset($_POST['post1']))
		$address->postoffice = $_POST['post1'];
		if(isset($_POST['postcode1']))
		$address->pincode = $_POST['postcode1'];
		if(isset($_POST['housecity1']))
		$address->city = $_POST['housecity1'];
		if(isset($_POST['housedistrict1']))
		$address->district = $_POST['housedistrict1'];
		if(isset($_POST['housestate1']))
		$address->state = $_POST['housestate1'];
		if(isset($_POST['housecountry1']))
		$address->country  = $_POST['housecountry1'];
		$address->save();
		
		
		//permanent address
		$paddress = new Address();
		$paddress->addresType = 1;
		$paddress->userId = $user->userId;
		if(isset($_POST['house']))
		$paddress->houseName = $_POST['house'];
		if(isset($_POST['houseplace']))
		$paddress->place = $_POST['houseplace'];
		if(isset($_POST['post']))
		$paddress->postoffice = $_POST['post'];
		if(isset($_POST['postcode']))
		$paddress->pincode = $_POST['postcode'];
		if(isset($_POST['housecity']))
		$paddress->city = $_POST['housecity'];
		if(isset($_POST['housedistrict']))
		$paddress->district = $_POST['housedistrict'];
		if(isset($_POST['housestate']))
		$paddress->state = $_POST['housestate'];
		if(isset($_POST['housecountry']))
		$paddress->country  = $_POST['housecountry'];
		$paddress->save();
			
		$user->addresses = Address::model()->findAll(array('condition'=>"userId = {$user->userId}"));
		//contact details	
		if(isset($_POST['alterMobile']))
		$contact->alternativeNo = $_POST['alterMobile'];
		if(isset($_POST['phoneVerify']))
		$contact->landLine = $_POST['phoneVerify'];
		if(isset($_POST['facebook']))
		$contact->facebookUrl = $_POST['facebook'];
		if(isset($_POST['skype']))
		$contact->skypeId = $_POST['skype'];
		if(isset($_POST['google']))
		$contact->googleIM = $_POST['google'];
		if(isset($_POST['yahoo']))
		$contact->yahooIM = $_POST['yahoo'];
		$contact->save();
		
		if(isset($_POST['pcontact']))
		{
				$privacy =  $user->privacy(array('condition'=>"items='contact'"));
				if(isset($privacy) && sizeof($privacy) > 0 ){
				$privacy1 = $privacy[0];
				$privacy1->privacy = $_POST['pcontact'];
				$privacy1->save();	
				}
				else {
				$privacy = new Privacy();
				$privacy->userId = $user->userId;
				$privacy->items = 'contact';
				$privacy->privacy = $_POST['pcontact'];
				$privacy->save();	
				}
		}
		
		$notification = new Notifications();
		$notification->userId = $user->userId;
		$notification->name = $user->name;
		$notification->marryId = $user->marryId;
		$notification->notificationType = 'contact';
		$notification->notification = Utilities::getNotificationMessage('contact');
		$notification->status = 0;
		$notification->createdate = new CDbExpression('NOW()');
		$notification->save();
		
		
		
		$this->forward('contact');
		}
		
		else {
		$this->render('editcontact');
		}
	}

	public function actionReference()
	{
		$user = Yii::app()->session->get('user');
		$user->references = Reference::model()->findAll(array('condition'=>"userId = {$user->userId}"));
		$referenceList = $user->references;
		$showReference = false;
		if(isset($user->references) && !empty($user->references) )
		{
				$showReference = false;
				if( is_array($referenceList)) {
				foreach ($referenceList as $value) {
				if(!empty($value->referName) || !empty($value->referCallFrom) ||		!empty($value->referHouseName)||
						!empty($value->referPostOffice)|| !empty($value->referCity)||	!empty($value->referState)||
						!empty($value->referEmail)||	!empty($value->referOccupation))
						
						$showReference = true;
				}
				}
				else if(isset($referenceList->referenceId))
				$showReference = true;
			
		}
		if($showReference)
		$this->render('myreference',array('referenceList'=>$referenceList));
		else
		$this->render('noreference');
	}

	public function actionAccount()
	{
		$user = Yii::app()->session->get('user');
		$sql = "SELECT count(*) as pCount FROM profileviews WHERE ( FIND_IN_SET( {$user->userId},visitedId))";
		$command=Yii::app()->db->createCommand($sql);
		$profileCount = $command->queryRow();
		$this->render('myaccount',array('user' =>$user,'profileCount' => $profileCount['pCount']));
	}
	

	// album actions
	public function actionAlbum()
	{
		$user = Yii::app()->session->get('user');
		$album = new Album();
		$photos = new Photos();
		$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "";
		if($action == "delete"){
		$photoId = (int)trim($_GET['pId']);
			$userId = (int)trim($_GET['uId']);
			if($user->userId == $userId){
				$photo = $photos->find('photoId='.$photoId);
				$profileStatus = $photo->profileImage;
				$path = Utilities::getDirectory('images',array('profile',$user->marryId));
				$targetFile = Utilities::getFullFilePath($path, $photo->imageName);
				if(file_exists($targetFile)){
					if(unlink($targetFile)){
						$photos->deleteByPk($photoId);
						if($profileStatus == 1){
							$query = 'update photos set profileImage = 1 where userId ='.$user->userId.' limit 1';
							Utilities::executeRawQuery($query);
						}
					}
				}
			}
		}elseif($action == "setprofilephoto"){
				$photoId = (int)trim($_GET['pId']);
				$userId = (int)trim($_GET['uId']);
				if($user->userId == $userId){
					$photos->updateAll(array('profileImage'=>0),'userId='.$userId);  // unset the existing
					$photos->updateAll(array('profileImage'=>1),'photoId='.$photoId);  // set the new image
				}
			}
		$photosList = $photos->findAll('userId='.$user->userId);
		$this->render('myalbum',array('photosList' => $photosList));
	}

	
	public function actionAstro()
	{
		$user = Yii::app()->session->get('user');
		$user->horoscopes = Horoscopes::model()->findByAttributes(array('userId' => $user->userId));
		if(isset($user->horoscopes) && $user->horoscopes->userId ==  $user->userId)
		$this->render('astro');
		else
		$this->render('noastro');
		
	}
	
	public function actionShortlist()
	{
		$this->forward('//shortlist/index');
	}
	
	public function actionBookmark()
	{
		$this->forward('//bookmark/index');
	}
	
	public function actionSettings()
	{
		$this->forward('//privacy');
	}
	
	public function actionHighlightprofile()
	{
		$this->render('highlightprofile');
	}
	
	public function actionPartnerpreference()
	{
		$user = Yii::app()->session->get('user');
		$user->partnerpreferences = Partnerpreferences::model()->findByAttributes(array('userId'=>$user->userId));
		$this->render('partnerpreference');
	}
	
	public function actionEditpartner()
	{
		$user = Yii::app()->session->get('user');
		$user->partnerpreferences = Partnerpreferences::model()->findByAttributes(array('userId'=>$user->userId));
		
		if(isset($_POST)&& !empty($_POST) ) {
		
		if(isset($user->partnerpreferences))
		{
			$partner = $user->partnerpreferences; 
		}
		else
		{
			$partner  = new Partnerpreferences();
			$partner->userId = $user->userId;
		}
			
		
		if(!empty($_POST['ageFrom']))
		$partner->ageFrom = $_POST['ageFrom'];
		if(!empty($_POST['ageTo']))
		$partner->ageTo = $_POST['ageTo'];
		if(isset($_POST['maritial']))
		$partner->maritalStatus = implode(",", $_POST['maritial']);
		
		if(isset($_POST['child']))
		$partner->haveChildren = $_POST['child'];
		if(!empty($_POST['heightFrom']))
		$partner->heightFrom = $_POST['heightFrom'];
		if(!empty($_POST['heightTo']))
		$partner->heightTo = $_POST['heightTo'];
		if(isset($_POST['status']))
		$partner->physicalStatus = $_POST['status'];
		if(!empty($_POST['religion']))
		$partner->religion = $_POST['religion'];
		if(!empty($_POST['caste1']))
		$partner->caste = implode(",", $_POST['caste1']);
		if(isset($_POST['star1']))
		$partner->star = implode(",", $_POST['star1']);
		if(isset($_POST['jathakam']))
		$partner->sudham = $_POST['jathakam'];
		if(isset($_POST['dhosham']))
		$partner->dosham = $_POST['dhosham'];
		if(isset($_POST['eat']))
		$partner->eatingHabits = implode(",", $_POST['eat']);
		if(isset($_POST['drink']))
		$partner->drinkingHabits = implode(",", $_POST['drink']);
		if(isset($_POST['smoke']))
		$partner->smokingHabits = implode(",", $_POST['smoke']);
		if(!empty( $_POST['country1']))
		$partner->countries = implode(",", $_POST['country1']);
		if(!empty($_POST['state1']))
		$partner->states = implode(",", $_POST['state1']);
		if(!empty($_POST['district1']))
		$partner->districts = implode(",", $_POST['district1']);
		if(!empty($_POST['language1']))
		$partner->languages = implode(",", $_POST['language1']);
		if(!empty($_POST['citizen1']))
		$partner->citizenship = implode(",", $_POST['citizen1']);
		if(!empty($_POST['occupation1']))
		$partner->occupation = implode(",", $_POST['occupation1']);
		if(!empty($_POST['income']))
		$partner->annualIncome = $_POST['income'];
		if(!empty($_POST['partnerDesc']))
		$partner->partnerDescription = $_POST['partnerDesc'];
		

		$partner->save();
		$this->forward('partnerpreference');
		}
		else
		{			
			$this->render('editpartner');
		}
	}
	
	public function actionProfile()
	{
		$user = Yii::app()->session->get('user');
		$photos = new Album();
		$photosList = $photos->findAll('userId='.$user->userId.' and type=1');
		
		// remove the unwanted records from photos table
		$query = 'delete from photos where userId ='.$user->userId.' and active = 2';
		Utilities::executeRawQuery($query);
		
		// remove the unwanted records from album table
		$query = 'delete from album where userId ='.$user->userId.' and active = 2 and type=1';
		Utilities::executeRawQuery($query);
		
		// remove the unwanted records from document table
		$query = 'delete from documents where userId ='.$user->userId.' and active = 2';
		Utilities::executeRawQuery($query);
		
		$this->render('profile',array('photosList'=>$photosList));
	}
	
	public function actionEditpartnerpreference()
	{
		$user = Yii::app()->session->get('user');
		
		//$partner = new Partnerpreferences();
		
		if(isset($_REQUEST['editPartner'])){
			$user->partnerpreferences->userId = $user->userId;
			if(isset($_POST['ageFrom']))
			$user->partnerpreferences->ageFrom = $_POST['ageFrom'];
			if(isset($_POST['ageTo']))
			$user->partnerpreferences->ageTo = $_POST['ageTo'];
			if(isset($_POST['maritial']))
			$user->partnerpreferences->maritalStatus = implode(",", $_POST['maritial']);
			
			if(isset($_POST['child']))
			$user->partnerpreferences->haveChildren = $_POST['child'];
			if(isset($_POST['heightFrom']))
			$user->partnerpreferences->heightFrom = $_POST['heightFrom'];
			if(isset($_POST['heightTo']))
			$user->partnerpreferences->heightTo = $_POST['heightTo'];
			if(isset($_POST['status']))
			$user->partnerpreferences->physicalStatus = $_POST['status'];
			if(isset($_POST['religion']))
			$user->partnerpreferences->religion = $_POST['religion'];
			if(isset($_POST['caste1']))
			$user->partnerpreferences->caste = implode(",", $_POST['caste1']);
			if(isset($_POST['star1']))
			$user->partnerpreferences->star = implode(",", $_POST['star1']);
			if(isset($_POST['jathakam']))
			$user->partnerpreferences->sudham = $_POST['jathakam'];
			if(isset($_POST['dhosham']))
			$user->partnerpreferences->dosham = $_POST['dhosham'];
			if(isset($_POST['eat']))
			$user->partnerpreferences->eatingHabits = implode(",", $_POST['eat']);
			if(isset($_POST['drink']))
			$user->partnerpreferences->drinkingHabits = implode(",", $_POST['drink']);
			if(isset($_POST['smoke']))
			$user->partnerpreferences->smokingHabits = implode(",", $_POST['smoke']);
			if(isset( $_POST['country1']))
			$user->partnerpreferences->countries = implode(",", $_POST['country1']);
			if(isset($_POST['state1']))
			$user->partnerpreferences->states = implode(",", $_POST['state1']);
			if(isset($_POST['district1']))
			$user->partnerpreferences->districts = implode(",", $_POST['district1']);
			if(isset($_POST['place1']))
			$user->partnerpreferences->places = implode(",", $_POST['place1']);
			if(isset($_POST['language1']))
			$user->partnerpreferences->languages = implode(",", $_POST['language1']);
			if(isset($_POST['citizen1']))
			$user->partnerpreferences->citizenship = implode(",", $_POST['citizen1']);
			if(isset($_POST['occupation1']))
			$user->partnerpreferences->occupation = implode(",", $_POST['occupation1']);
			if(isset($_POST['income']))
			$user->partnerpreferences->annualIncome = $_POST['income'];
			if(isset($_POST['partnerDesc']))
			$user->partnerpreferences->partnerDescription = $_POST['partnerDesc'];
			
			$user->partnerpreferences->save();
		}
		//$query = "UPDATE partnerpreferences SET ";
		$this->render('editpartnerpreference');
	}
	
	/*
	 * Function to edit the documents
	 * */
	
public function actionEditdocument()
	{
		$user = Yii::app()->session->get('user');
  		$documents = new Documents();
  		$privacy = new Privacy();
		//upload profile document
  		$documentCount = isset($_POST['documentCount']) ? $_POST['documentCount']:1;
  		for($i = 1; $i < $documentCount; $i++){
			if (!empty($_FILES['profileDocument_'.$i]['tmp_name']) && $_POST['documentType_'.$i] != 0){   // upload the documents
				$file = $_FILES['profileDocument_'.$i];
				$documentType = trim($_POST['documentType_'.$i]);
				$fileName=basename( $_FILES['profileDocument_'.$i]['name']);   
				$extension = strtolower(Utilities::getExtension($fileName));  
				if(Utilities::isValidDocumentExtension($extension)){         
				 	$path = Utilities::getDirectory('images',array('documents',$user->marryId)); 
				 	$fileName = $user->marryId.date("his").".".$extension; 
					$targetPath = Utilities::getFullFilePath($path, $fileName);
					if(Utilities::uploadFile($_FILES['profileDocument_'.$i]['tmp_name'], $targetPath)) {
						//code to insert to db
						$documents = new Documents();
						$documents->userId = $user->userId;
						$documents->documentName = $fileName;
						$documents->documentType = $documentType;
						$documents->active = 2;   // temperory record
						$documents->save();
						
						$notification = new Notifications();
						$notification->userId = $user->userId;
						$notification->name = $user->name;
						$notification->marryId = $user->marryId;
						$notification->notificationType = 'documents';
						$notification->notification = Utilities::getNotificationMessage('documents');
						$notification->status = 0;
						$notification->createdate = new CDbExpression('NOW()');
						$notification->save();
						
		
						
						
					}else{
						echo "There was an error uploading the file, please try again!";
					}				
				}	
					
			}
			sleep(1); // set a time delay to upload
  		}
		if(isset($_GET['r']) && $_GET['r'] == 'deletedocument'){   // delete the document
			$documentId = (int)trim($_GET['dId']);
			$userId = (int)trim($_GET['uId']);
			$user = Yii::app()->session->get('user');
			if($user->userId == $userId){
				$document = $documents->find('documentId='.$documentId);
				$path = Utilities::getDirectory('images',array('documents',$user->marryId));
				$targetFile = Utilities::getFullFilePath($path, $document->documentName);
				if(file_exists($targetFile)){
					if(unlink($targetFile)){
						$documents->deleteByPk($documentId);
					}
				}
				$this->redirect(Yii::app()->params['homeUrl']."/mypage/editdocument");
				Yii::app()->end();	
			}
		}elseif(isset($_POST['updateDocument']) && $_POST['updateDocument'] != ""){
				// update the temp images to active one
				$query = 'update documents set active = 1 where userId ='.$user->userId.' and active = 2';
				Utilities::executeRawQuery($query);
				// update the photo privacy settings
				$visibility = isset($_POST['documentview']) ? trim($_POST['documentview']): 'subscribers';
				$settings = $privacy->find("userId=".$user->userId." and items = 'documents'");
				if(count($settings) > 0 ){  // update new settings
					$query = "update privacy set privacy = '".$visibility."' where userId =".$user->userId." and items = 'documents'";
					Utilities::executeRawQuery($query);
				}else{
					$privacy->userId = $user->userId;
					$privacy->items = 'documents';
					$privacy->privacy = $visibility;
					$privacy->save();
				}
				?>
				<script type="text/javascript">
				parent.window.location.href = '<?php echo Utilities::createAbsoluteUrl('mypage','profile'); ?>';
				</script>
				<?php 
			}
		
  		$documentList = $documents->findAll('userId='.$user->userId);
  		$settings = $privacy->find("userId=".$user->userId. " and items='documents'");
		$this->layout= '//layouts/popup';
		$this->render('editdocument',array('documents'=>$documentList,'user'=>$user,'documentsettings'=>$settings));
	}
	
	/*
	 * Function to edit the family photo
	 * */
	
	public function actionEditfamilyphoto()
	{
	
		$user = Yii::app()->session->get('user');
  		$photos = new Album();
  		$privacy = new Privacy();
  		
		//Upload the profile photo
  		$photoCount = isset($_POST['photoCount']) ? $_POST['photoCount']:1; 
  		for($i = 1; $i < $photoCount; $i++){		  
		if (!empty($_FILES['profilePhoto_'.$i]['tmp_name']) && $_POST['photoRelation_'.$i] != 0){  
				$file = $_FILES['profilePhoto_'.$i];
				$fileName=basename( $_FILES['profilePhoto_'.$i]['name']);   
				$extension = strtolower(Utilities::getExtension($fileName));  
				if(Utilities::isValidImageExtension($extension)){         
				 	$path = Utilities::getDirectory('images',array('album',$user->marryId)); 
				 	$fileName = $user->marryId.date("his").".".$extension; 
					$targetPath = Utilities::getFullFilePath($path, $fileName);
					if(Utilities::uploadFile($_FILES['profilePhoto_'.$i]['tmp_name'], $targetPath)) {
						//code to insert to db
						$photos = new Album();
						$photos->userId = $user->userId;
						$photos->imageName = $fileName;
						$photos->type = 1;
						$photos->photorelation = trim($_POST['photoRelation_'.$i]);
						$photos->active = 2;  //temp record
						$photos->save();
						
		$notification = new Notifications();
		$notification->userId = $user->userId;
		$notification->name = $user->name;
		$notification->marryId = $user->marryId;
		$notification->notificationType = 'album';
		$notification->notification = Utilities::getNotificationMessage('album');
		$notification->status = 0;
		$notification->createdate = new CDbExpression('NOW()');
		$notification->save();
		
						
					}else{
						echo "There was an error uploading the file, please try again!";
					}				
				}	
					
			}
			sleep(1); // set a time delay to upload
  		}
  		
  		// delete the image
		if(isset($_GET['r']) && $_GET['r'] == 'deleteimage'){   // delete the image
			$photoId = (int)trim($_GET['pId']);
			$userId = (int)trim($_GET['uId']);
			$user = Yii::app()->session->get('user');
			if($user->userId == $userId){
				$photo = $photos->find('albumId='.$photoId);
				$path = Utilities::getDirectory('images',array('album',$user->marryId));
				$targetFile = Utilities::getFullFilePath($path, $photo->imageName);
				if(file_exists($targetFile)){
					if(unlink($targetFile)){
						$photos->deleteByPk($photoId);
					}
				}
			 	$this->redirect(Yii::app()->params['homeUrl']."/mypage/editfamilyphoto");
				Yii::app()->end();
			}
		}elseif(isset($_POST['updatePhoto']) && $_POST['updatePhoto'] !=""){
				// update the temp images to active one
				$query = 'update album set active = 1 where userId ='.$user->userId.' and active = 2 and type=1';
				Utilities::executeRawQuery($query);
				// update the photo privacy settings
				$visibility = isset($_POST['familypictureview']) ? trim($_POST['familypictureview']): 'all';
				$settings = $privacy->find("userId=".$user->userId." and items = 'family'");
				if(count($settings) > 0 ){  // update new settings
					$query = "update privacy set privacy = '".$visibility."' where userId =".$user->userId." and items = 'family'";
					Utilities::executeRawQuery($query);
				}else{
					$privacy->userId = $user->userId;
					$privacy->items = 'family';
					$privacy->privacy = $visibility;
					$privacy->save();
				}
				?>
				<script type="text/javascript">
				parent.window.location.href = '<?php echo Utilities::createAbsoluteUrl('mypage','profile'); ?>';
				</script>
				<?php 
			}
		
  		$photosList = $photos->findAll('userId='.$user->userId);
  		$settings = $privacy->find("userId=".$user->userId. " and items='family'");
		$this->layout= '//layouts/popup';
		$this->render('editfamilyphoto',array('photos'=>$photosList,'user'=>$user,'settings'=>$settings));
	}
	
	/*
	 * Function to edit the profile photo
	 * */
	
	public function actionEditprofilephoto()
	{
	
		$user = Yii::app()->session->get('user');
  		$photos = new Photos();
  		$privacy = new Privacy();
  		
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
					if(Utilities::uploadFile($_FILES['profilePhoto_'.$i]['tmp_name'], $targetPath)) {
						//code to insert to db
						$photos = new Photos();
						//$photos->updateAll(array('profileImage'=>0),'userId='.$user->userId);  // unset the existing 
						$photos->userId = $user->userId;
						$photos->imageName = $fileName;
						$photos->active = 2;   // temperory record
						$profilePics = $photos->findAll('userId='.$user->userId.' and profileImage=1');
						if(count($profilePics) > 0){
							$photos->profileImage = 0;
						}else{
							$photos->profileImage = 1;
						}
						$photos->save();
						
						
						
						
					}else{
						echo "There was an error uploading the file, please try again!";
					}				
				}	
					
			}
			sleep(1); // set a time delay to upload
  		}
  		// photo delete action
		if(isset($_GET['r']) && $_GET['r'] == 'setimage'){   // set the profile image
				$photoId = (int)trim($_GET['pId']);
				$userId = (int)trim($_GET['uId']);
				$user = Yii::app()->session->get('user');
				if($user->userId == $userId){
					$photos->updateAll(array('profileImage'=>0),'userId='.$userId);  // unset the existing
					$photos->updateAll(array('profileImage'=>1),'photoId='.$photoId);  // set the new image
					$this->redirect(Yii::app()->params['homeUrl']."/mypage/editprofilephoto");
					Yii::app()->end();
				}
			}elseif(isset($_GET['r']) && $_GET['r'] == 'deleteimage'){   // delete the image
				$photoId = (int)trim($_GET['pId']);
				$userId = (int)trim($_GET['uId']);
				$user = Yii::app()->session->get('user');
				if($user->userId == $userId){
					$photo = $photos->find('photoId='.$photoId);
					$profileStatus = $photo->profileImage;
					$path = Utilities::getDirectory('images',array('profile',$user->marryId));
					$targetFile = Utilities::getFullFilePath($path, $photo->imageName);
					if(file_exists($targetFile)){
						if(unlink($targetFile)){
							$photos->deleteByPk($photoId);
							if($profileStatus == 1){
								$query = 'update photos set profileImage = 1 where userId ='.$user->userId.' limit 1';
								Utilities::executeRawQuery($query);
							}
						}
					}
					$this->redirect(Yii::app()->params['homeUrl']."/mypage/editprofilephoto");
					Yii::app()->end();	
				}
			}elseif(isset($_POST['updatePhoto'])){
				// update the temp images to active one
				$query = 'update photos set active = 1 where userId ='.$user->userId.' and active = 2';
				Utilities::executeRawQuery($query);
				// update the photo privacy settings
				$visibility = isset($_POST['profilepictureview']) ? trim($_POST['profilepictureview']): 'all';
				$settings = $privacy->find("userId=".$user->userId." and items = 'album'");
				if(count($settings) > 0 ){  // update new settings
					$query = "update privacy set privacy = '".$visibility."' where userId =".$user->userId." and items = 'album'";
					Utilities::executeRawQuery($query);
				}else{
					$privacy->userId = $user->userId;
					$privacy->items = 'album';
					$privacy->privacy = $visibility;
					$privacy->save();
				}
				?>
				<script type="text/javascript">
				parent.window.location.href = '<?php echo Utilities::createAbsoluteUrl('mypage','profile'); ?>';
				</script>
				<?php 
			}
  		$photosList = $photos->findAll('userId='.$user->userId);
  		$settings = $privacy->find("userId=".$user->userId. " and items='album'");
		$this->layout= '//layouts/popup';
		$this->render('editprofilephoto',array('photos'=>$photosList,'user'=>$user,'settings'=>$settings));
	}
	
	public function actionDelete()
	{
		$this->layout= '//layouts/popup';
		if(isset($_POST) && !empty($_POST))
		{
			$user = Yii::app()->session->get('user');
			$delete = new DeleteFeedback();
			
			$delete->userId = $user->userId;
			
			if(isset($_POST['married']))
			$delete->married = 1;

			if(isset($_POST['service']))
			$delete->service = 1;
			
			if(isset($_POST['engaged']))
			$delete->engaged = 1;
			
			if(isset($_POST['other']))
			$delete->other = 1;
			
			if(isset($_POST['useful']))
			$delete->useful = 1;
			
			if(isset($_POST['compromised']))
			$delete->compromised = 1;
			
			$user->active = 3;
			$user->save();
			
			$delete->save();
			
			$userLogged = $user->userloggeddetails(array('order'=>'loggedIn DESC','limit'=>1));
			if(isset($userLogged) && sizeof($userLogged) > 0)
			{		
				Yii::app()->getDb()->createCommand("SET time_zone='+05:30'")->execute();
				$userLogged[0]->loggedOut = new CDbExpression('NOW()');
				$userLogged[0]->save();
			}
			Yii::app()->user->logout();
			Yii::app()->session->clear();
			Yii::app()->session->destroy();
			
			
			//delete the user
			$this->render('delete',array('success'=>true));
		}	
		else 
		{
			
			$this->render('delete');
		}
	}
	public function actionDeactivate()
	{
		$this->layout= '//layouts/popup';;
		if(isset($_POST) && !empty($_POST))
		{
			$user = Yii::app()->session->get('user');
			$user->active = 2;
			$user->save();
			
		$userLogged = $user->userloggeddetails(array('order'=>'loggedIn DESC','limit'=>1));
		if(isset($userLogged) && sizeof($userLogged) > 0)
		{	
			Yii::app()->getDb()->createCommand("SET time_zone='+05:30'")->execute();	
			$userLogged[0]->loggedOut = new CDbExpression('NOW()');
			$userLogged[0]->save();
		}
		Yii::app()->user->logout();
		Yii::app()->session->clear();
		Yii::app()->session->destroy();
		$this->render('deactivate',array('success'=>true));
		}
		else{	
			$this->render('deactivate');
		}
			
	}
	
public function actionChange()
	{
		$this->layout= '//layouts/popup';;
		if(isset($_POST) && !empty($_POST))
		{
			$user = Yii::app()->session->get('user');
				
			$condition = "marryId = '{$user->marryId}' AND password = md5('{$_POST['oldPassword']}')  AND active != 3";
			$record = Users::model()->find(array('condition' => $condition));
				
			if(isset($record))
			{
					
				if($record->marryId == $user->marryId)
				{
					$user->password =  new CDbExpression("MD5('{$_POST['newpassword']}')");
					$user->save();
					$userLogged = $user->userloggeddetails(array('order'=>'loggedIn DESC','limit'=>1));
					if(isset($userLogged) && sizeof($userLogged) > 0)
					{
						Yii::app()->getDb()->createCommand("SET time_zone='+05:30'")->execute();
						$userLogged[0]->loggedOut = new CDbExpression('NOW()');
						$userLogged[0]->save();
					}
					
							$notification = new Notifications();
							$notification->userId = $user->userId;
							$notification->name = $user->name;
							$notification->marryId = $user->marryId;
							$notification->notificationType = 'password';
							$notification->notification = Utilities::getNotificationMessage('password');
							$notification->status = 0;
							$notification->createdate = new CDbExpression('NOW()');
							$notification->save();
										
					
					Yii::app()->user->logout();
					Yii::app()->session->clear();
					Yii::app()->session->destroy();
					$this->render('password',array('success'=>true));
				}
			else{
				$this->render('password',array('success'=>false));
			}
				
			}
			else{
				$this->render('password',array('success'=>false));
			}
		}
		else{	
			$this->render('password');
		}
			
	}
	
	public function actionFamilyalbum()
	{
		$user = Yii::app()->session->get('user');
		$photos = new Album();
		$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "";
		if($action == "delete"){
		$photoId = (int)trim($_GET['pId']);
			$userId = (int)trim($_GET['uId']);
			$user = Yii::app()->session->get('user');
			if($user->userId == $userId){
				$photo = $photos->find('albumId='.$photoId);
				$path = Utilities::getDirectory('images',array('album',$user->marryId));
				$targetFile = Utilities::getFullFilePath($path, $photo->imageName);
				if(file_exists($targetFile)){
					if(unlink($targetFile)){
						$photos->deleteByPk($photoId);
					}
				}
			}
		}
		$photosList = $photos->findAll('userId='.$user->userId.' and type=1');
		$this->render('myfamilyalbum',array('photosList'=>$photosList));
	}
	
	public function actionPhotoupload()
	{
	
		$user = Yii::app()->session->get('user');
  		$photos = new Photos();
  		$privacy = new Privacy();
  		
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
					if(Utilities::uploadFile($_FILES['profilePhoto_'.$i]['tmp_name'], $targetPath)) {
						//code to insert to db
						$photos = new Photos();
						//$photos->updateAll(array('profileImage'=>0),'userId='.$user->userId);  // unset the existing 
						$photos->userId = $user->userId;
						$photos->imageName = $fileName;
						$photos->active = 2;   // temperory record
						$profilePics = $photos->findAll('userId='.$user->userId.' and profileImage=1');
						if(count($profilePics) > 0){
							$photos->profileImage = 0;
						}else{
							$photos->profileImage = 1;
						}
						$photos->save();
						
					}else{
						echo "There was an error uploading the file, please try again!";
					}				
				}	
					
			}
			sleep(1); // set a time delay to upload
  		}
  		// photo delete action
		if(isset($_GET['r']) && $_GET['r'] == 'setimage'){   // set the profile image
				$photoId = (int)trim($_GET['pId']);
				$userId = (int)trim($_GET['uId']);
				$user = Yii::app()->session->get('user');
				if($user->userId == $userId){
					$photos->updateAll(array('profileImage'=>0),'userId='.$userId);  // unset the existing
					$photos->updateAll(array('profileImage'=>1),'photoId='.$photoId);  // set the new image
					$this->redirect(Yii::app()->params['homeUrl']."/mypage/photoupload");
					Yii::app()->end();
				}
			}elseif(isset($_GET['r']) && $_GET['r'] == 'deleteimage'){   // delete the image
				$photoId = (int)trim($_GET['pId']);
				$userId = (int)trim($_GET['uId']);
				$user = Yii::app()->session->get('user');
				if($user->userId == $userId){
					$photo = $photos->find('photoId='.$photoId);
					$profileStatus = $photo->profileImage;
					$path = Utilities::getDirectory('images',array('profile',$user->marryId));
					$targetFile = Utilities::getFullFilePath($path, $photo->imageName);
					if(file_exists($targetFile)){
						if(unlink($targetFile)){
							$photos->deleteByPk($photoId);
							if($profileStatus == 1){
								$query = 'update photos set profileImage = 1 where userId ='.$user->userId.' limit 1';
								Utilities::executeRawQuery($query);
							}
						}
					}
					$this->redirect(Yii::app()->params['homeUrl']."/mypage/photoupload");
					Yii::app()->end();	
				}
			}elseif(isset($_POST['updatePhoto'])){
				// update the temp images to active one
				$query = 'update photos set active = 1 where userId ='.$user->userId.' and active = 2';
				Utilities::executeRawQuery($query);
				// update the photo privacy settings
				$visibility = isset($_POST['profilepictureview']) ? trim($_POST['profilepictureview']): 'all';
				$settings = $privacy->find("userId=".$user->userId." and items = 'album'");
				if(count($settings) > 0 ){  // update new settings
					$query = "update privacy set privacy = '".$visibility."' where userId =".$user->userId." and items = 'album'";
					Utilities::executeRawQuery($query);
				}else{
					$privacy->userId = $user->userId;
					$privacy->items = 'album';
					$privacy->privacy = $visibility;
					$privacy->save();
				}
				?>
				<script type="text/javascript">
				parent.window.location.href = '<?php echo Utilities::createAbsoluteUrl('mypage','album'); ?>';
				</script>
				<?php 
			}
  		$photosList = $photos->findAll('userId='.$user->userId);
  		$settings = $privacy->find("userId=".$user->userId. " and items='album'");
		$this->layout= '//layouts/popup';
		$this->render('photoupload',array('photos'=>$photosList,'user'=>$user,'settings'=>$settings));
	}
	
public function actionFamilyphotoupload()
	{
	
		$user = Yii::app()->session->get('user');
  		$photos = new Album();
  		$privacy = new Privacy();
  		
		//Upload the profile photo
  		$photoCount = isset($_POST['photoCount']) ? $_POST['photoCount']:1; 
  		for($i = 1; $i < $photoCount; $i++){		  
		if (!empty($_FILES['profilePhoto_'.$i]['tmp_name']) && $_POST['photoRelation_'.$i] != 0){  
				$file = $_FILES['profilePhoto_'.$i];
				$fileName=basename( $_FILES['profilePhoto_'.$i]['name']);   
				$extension = strtolower(Utilities::getExtension($fileName));  
				if(Utilities::isValidImageExtension($extension)){         
				 	$path = Utilities::getDirectory('images',array('album',$user->marryId)); 
				 	$fileName = $user->marryId.date("his").".".$extension; 
					$targetPath = Utilities::getFullFilePath($path, $fileName);
					if(Utilities::uploadFile($_FILES['profilePhoto_'.$i]['tmp_name'], $targetPath)) {
						//code to insert to db
						$photos = new Album();
						$photos->userId = $user->userId;
						$photos->imageName = $fileName;
						$photos->type = 1;
						$photos->photorelation = trim($_POST['photoRelation_'.$i]);
						$photos->active = 2;  //temp record
						$photos->save();
						
		$notification = new Notifications();
		$notification->userId = $user->userId;
		$notification->name = $user->name;
		$notification->marryId = $user->marryId;
		$notification->notificationType = 'family';
		$notification->notification = Utilities::getNotificationMessage('family');
		$notification->status = 0;
		$notification->createdate = new CDbExpression('NOW()');
		$notification->save();
		
						
					}else{
						echo "There was an error uploading the file, please try again!";
					}				
				}	
					
			}
			sleep(1); // set a time delay to upload
  		}
  		
  		// delete the image
		if(isset($_GET['r']) && $_GET['r'] == 'deleteimage'){   // delete the image
			$photoId = (int)trim($_GET['pId']);
			$userId = (int)trim($_GET['uId']);
			$user = Yii::app()->session->get('user');
			if($user->userId == $userId){
				$photo = $photos->find('albumId='.$photoId);
				$path = Utilities::getDirectory('images',array('album',$user->marryId));
				$targetFile = Utilities::getFullFilePath($path, $photo->imageName);
				if(file_exists($targetFile)){
					if(unlink($targetFile)){
						$photos->deleteByPk($photoId);
					}
				}
			 	$this->redirect(Yii::app()->params['homeUrl']."/mypage/familyphotoupload");
				Yii::app()->end();
			}
		}elseif(isset($_POST['updatePhoto']) && $_POST['updatePhoto'] !=""){
				// update the temp images to active one
				$query = 'update album set active = 1 where userId ='.$user->userId.' and active = 2 and type=1';
				Utilities::executeRawQuery($query);
				// update the photo privacy settings
				$visibility = isset($_POST['familypictureview']) ? trim($_POST['familypictureview']): 'all';
				$settings = $privacy->find("userId=".$user->userId." and items = 'family'");
				if(count($settings) > 0 ){  // update new settings
					$query = "update privacy set privacy = '".$visibility."' where userId =".$user->userId." and items = 'family'";
					Utilities::executeRawQuery($query);
				}else{
					$privacy->userId = $user->userId;
					$privacy->items = 'family';
					$privacy->privacy = $visibility;
					$privacy->save();
				}
				?>
				<script type="text/javascript">
				parent.window.location.href = '<?php echo Utilities::createAbsoluteUrl('mypage','familyalbum'); ?>';
				</script>
				<?php 
			}
		
  		$photosList = $photos->findAll('userId='.$user->userId);
  		$settings = $privacy->find("userId=".$user->userId. " and items='family'");
		$this->layout= '//layouts/popup';
		$this->render('familyphotoupload',array('photos'=>$photosList,'user'=>$user,'settings'=>$settings));
	}
	
	public function actionDocument()
	{
		$user = Yii::app()->session->get('user');
  		$documents = new Documents();
  		$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "";
		if($action == "delete"){
		$documentId = (int)trim($_GET['dId']);
			$userId = (int)trim($_GET['uId']);
			$user = Yii::app()->session->get('user');
			if($user->userId == $userId){
				$document = $documents->find('documentId='.$documentId);
				$path = Utilities::getDirectory('images',array('documents',$user->marryId));
				$targetFile = Utilities::getFullFilePath($path, $document->documentName);
				if(file_exists($targetFile)){
					if(unlink($targetFile)){
						$documents->deleteByPk($documentId);
					}
				}
			}
		}
  		$documentList = $documents->findAll('userId='.$user->userId);
		$this->render('document',array('documents'=>$documentList));
	}
	
	public function actionDocumentupload()
	{
		$user = Yii::app()->session->get('user');
  		$documents = new Documents();
  		$privacy = new Privacy();
		//upload profile document
  		$documentCount = isset($_POST['documentCount']) ? $_POST['documentCount']:1;
  		for($i = 1; $i < $documentCount; $i++){
			if (!empty($_FILES['profileDocument_'.$i]['tmp_name']) && $_POST['documentType_'.$i] != 0){   // upload the documents
				$file = $_FILES['profileDocument_'.$i];
				$documentType = trim($_POST['documentType_'.$i]);
				$fileName=basename( $_FILES['profileDocument_'.$i]['name']);   
				$extension = strtolower(Utilities::getExtension($fileName));  
				if(Utilities::isValidDocumentExtension($extension)){         
				 	$path = Utilities::getDirectory('images',array('documents',$user->marryId)); 
				 	$fileName = $user->marryId.date("his").".".$extension; 
					$targetPath = Utilities::getFullFilePath($path, $fileName);
					if(Utilities::uploadFile($_FILES['profileDocument_'.$i]['tmp_name'], $targetPath)) {
						//code to insert to db
						$documents = new Documents();
						$documents->userId = $user->userId;
						$documents->documentName = $fileName;
						$documents->documentType = $documentType;
						$documents->active = 2;   // temperory record
						$documents->save();
						
					
					$notification = new Notifications();
					$notification->userId = $user->userId;
					$notification->name = $user->name;
					$notification->marryId = $user->marryId;
					$notification->notificationType = 'documents';
					$notification->notification = Utilities::getNotificationMessage('documents');
					$notification->status = 0;
					$notification->createdate = new CDbExpression('NOW()');
					$notification->save();
						
						
					}else{
						echo "There was an error uploading the file, please try again!";
					}				
				}	
					
			}
			sleep(1); // set a time delay to upload
  		}
		if(isset($_GET['r']) && $_GET['r'] == 'deletedocument'){   // delete the document
			$documentId = (int)trim($_GET['dId']);
			$userId = (int)trim($_GET['uId']);
			$user = Yii::app()->session->get('user');
			if($user->userId == $userId){
				$document = $documents->find('documentId='.$documentId);
				$path = Utilities::getDirectory('images',array('documents',$user->marryId));
				$targetFile = Utilities::getFullFilePath($path, $document->documentName);
				if(file_exists($targetFile)){
					if(unlink($targetFile)){
						$documents->deleteByPk($documentId);
					}
				}
				$this->redirect(Yii::app()->params['homeUrl']."/mypage/documentupload");
				Yii::app()->end();	
			}
		}elseif(isset($_POST['updateDocument']) && $_POST['updateDocument'] != ""){
				// update the temp images to active one
				$query = 'update documents set active = 1 where userId ='.$user->userId.' and active = 2';
				Utilities::executeRawQuery($query);
				// update the photo privacy settings
				$visibility = isset($_POST['documentview']) ? trim($_POST['documentview']): 'subscribers';
				$settings = $privacy->find("userId=".$user->userId." and items = 'documents'");
				if(count($settings) > 0 ){  // update new settings
					$query = "update privacy set privacy = '".$visibility."' where userId =".$user->userId." and items = 'documents'";
					Utilities::executeRawQuery($query);
				}else{
					$privacy->userId = $user->userId;
					$privacy->items = 'documents';
					$privacy->privacy = $visibility;
					$privacy->save();
				}
				?>
				<script type="text/javascript">
				parent.window.location.href = '<?php echo Utilities::createAbsoluteUrl('mypage','document'); ?>';
				</script>
				<?php 
			}
		
  		$documentList = $documents->findAll('userId='.$user->userId);
  		$settings = $privacy->find("userId=".$user->userId. " and items='documents'");
		$this->layout= '//layouts/popup';
		$this->render('documentupload',array('documents'=>$documentList,'user'=>$user,'documentsettings'=>$settings));
	}

}