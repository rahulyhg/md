<?php

class ContactController extends Controller
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
		if(isset($_GET['id']))
			{
				$user = Users::model()->findByAttributes(array('marryId'=>$_GET['id']));
	
				if(isset($user->name))
				{
					$loggedUser = Yii::app()->session->get('user');
					if(isset($loggedUser)){
					if(isset($loggedUser->addressBook)){
						$userBook = Addressbook::model()->findByAttributes(array('userID' => $usersList->userId));
						$arrayList = explode(",",$userBook->visitedId);
						if(!in_array($user->userId,$arrayList)){
						$arrayList[] = $user->userId;
						$visitedId = implode(",", $arrayList);
						$loggedUser->addressBook->visitedId = $visitedId ;
						$loggedUser->addressBook->save();
						}
					}
					else {
						$addressbook = new Addressbook();
						$addressbook->userID = $loggedUser->userId;
						$addressbook->visitedId = $user->userId;
						$addressbook->save(); 
					}
					
					}
					$this->render('index',array('model'=>$user));
				}
			}
			else
			{
				$this->render('index');
			}
	}
	
	public function actionReference()
	{
		if(isset($_GET['id']))
		{
			$user = Yii::app()->session->get('user');
			$reference = new Reference();
			$references = $reference->findAll('userId='.$user->userId);
			$this->render('reference',array('references'=>$references));
		}
		$this->render('reference');
	}
	
	public function actionDetails()
	{
		if(isset($_GET['id']))
		{
			$user = Users::model()->findByAttributes(array('marryId'=>$_GET['id']));
		
				if(isset($user->name))
				{
					$loggedUser = Yii::app()->session->get('user');
					$loggedUser->addressBook = Addressbook::model()->findByAttributes(array('userID' => $loggedUser->userId));
					if(isset($loggedUser->addressBook)){
						$arrayList = explode(",",$loggedUser->addressBook->visitedId);
						$arr = array_merge($arrayList, array($user->userId));
						$visitedId = implode(",", $arr);
						$loggedUser->addressBook->visitedId = $visitedId ;
						$loggedUser->addressBook->save();
					}
					else {
						$addressbook = new Addressbook();
						$addressbook->userID = $loggedUser->userId;
						$addressbook->visitedId = $user->userId;
						$addressbook->save(); 
					}
					
				}
			
				$this->layout= '//layouts/popup';
				$this->render('contactdetails',array('model'=>$user));
		}
	}
	
	public function actionReferencedetails()
	{
		if(isset($_GET['id']))
		{
			$user = Users::model()->findByAttributes(array('marryId'=>$_GET['id']));
		
				if(isset($user->name))
				{
					$this->layout= '//layouts/popup';
					$this->render('referencedetails',array('model'=>$user));
				}
		}
	}
	
	public function actionAstrodetails()
	{
		if(isset($_GET['id']))
		{
			$user = Users::model()->with('horoscopes')->findByAttributes(array('marryId'=>$_GET['id']));
		
				if(isset($user->name))
				{
					$this->layout= '//layouts/popup';
					$this->render('astrodetails',array('model'=>$user));
				}
		}
	}
	
	
	public function actionDetailsedit()
	{
		$user = Yii::app()->session->get('user');
		$userPersonal = $user->userpersonaldetails;
		$contact = $user->usercontactdetails;
		if(isset($_POST['mobile'])){
		if(isset($_POST['mobile']))
		$userPersonal->mobilePhone = $_POST['mobile'];
		$userPersonal->save();	
			
		
		$caddress = $user->addresses(array('condition'=>'addresType=0'));
		if(isset($caddress) && sizeof($caddress) > 0)
		$address = $caddress[0]; 
		else {
			$address = new Address();
			$address->userId = $user->userId;
			$address->addresType = 0;
		}
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
		
		$peraddress = $user->addresses(array('condition'=>'addresType=1'));
		if(isset($peraddress ) && sizeof($peraddress ) > 0)
		$paddress = $peraddress [0]; 
		else {
			$paddress = new Address();
			$paddress->userId = $user->userId;
			$paddress->addresType = 1;
		}
		//permanent address
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
		
		/*
		if(isset($_POST['pcontact']))
		{
				$privacy =  $user->privacy(array('condition'=>"items='contact'"));
				if(isset($privacy) && $privacy->items == 'contact'){
				$privacy->privacy = implode(',', $_POST['pcontact']);
				$privacy->save();	
				}
				else {
				$privacy = new Privacy();
				$privacy->userId = $user->userId;
				$privacy->items = 'contact';
				$privacy->privacy = implode(',', $_POST['pcontact']);
				$privacy->save();	
				}
		}
		*/
		
			$notification = new Notifications();
			$notification->userId = $user->userId;
			$notification->name = $user->name;
			$notification->marryId = $user->marryId;
			$notification->notificationType = 'contact';
			$notification->notification = Utilities::getNotificationMessage('contact');
			$notification->status = 0;
			$notification->createdate = new CDbExpression('NOW()');
			$notification->save();
						
		
		}
		$this->layout= '//layouts/popup';
		$this->render('detailsedit');
	}
	
	public function actionReferenceadd()
	{
		$this->layout= '//layouts/popup';
		
		$this->render('addReference');
	}
	
	public function actionReferenceedit()
	{
		$user = Yii::app()->session->get('user');
		if(isset($_POST) && !empty($_POST)) {
		$referenceList = $user->references;
		if(isset($referenceList) && isset($referenceList[0]))
		{
			$reference = $referenceList[0];
		}
		else
		{
		$reference = new Reference();
		$reference->userId = $user->userId;
		}
		if(isset($_POST['relation0']))
		$reference->relation = $_POST['relation0'];
		if(isset($_POST['name0']))
		$reference->referName = $_POST['name0'];
		if(isset($_POST['house0']))
		$reference->referHouseName = $_POST['house0'];
		if(isset($_POST['place0']))
		$reference->referPlace = $_POST['place0'];
		if(isset($_POST['city0']))
		$reference->referCity = $_POST['city0'];
		if(isset($_POST['state0']))
		$reference->referState = $_POST['state0'];
		if(isset($_POST['pin0']))
		$reference->referPostcode = $_POST['pin0'];
		if(isset($_POST['post0']))
		$reference->referPostOffice = $_POST['post0'];
		if(isset($_POST['district0']))
		$reference->referDistrict = $_POST['district0'];
		if(isset($_POST['country0']))
		$reference->referCountry = $_POST['country0'];
		if(isset($_POST['email0']))
		$reference->referEmail = $_POST['email0'];
		if(isset($_POST['occupation0']))
		$reference->referOccupation = $_POST['occupation0'];
		if(!empty($_POST['timeFrom0']) && !empty($_POST['fromA0']) && !empty($_POST['timeTo0']) && !empty($_POST['toA0'])){
		$time = $_POST['timeFrom0'].':'.$_POST['fromA0'].'-'.$_POST['timeTo0'].':'.$_POST['toA0'];
		$reference->referCallFrom  = $time;
		}
		
		if(!empty($reference->referName) || !empty($reference->referCallFrom) ||		!empty($reference->referHouseName)||
						!empty($reference->referPostOffice)|| !empty($reference->referCity)||	!empty($reference->referState)||
						!empty($reference->referEmail)||	!empty($reference->referOccupation))
						{
							$reference->save();
						}

		if(isset($referenceList) && isset($referenceList[1]))
		{
			$reference1 = $referenceList[1];
		}
		else
		{
		$reference1 = new Reference();
		$reference1->userId = $user->userId;
		}
		if(isset($_POST['relation1']))
		$reference1->relation = $_POST['relation1'];
		if(isset($_POST['name1']))
		$reference1->referName = $_POST['name1'];
		if(isset($_POST['house1']))
		$reference1->referHouseName = $_POST['house1'];
		if(isset($_POST['place1']))
		$reference1->referPlace = $_POST['place1'];
		if(isset($_POST['city1']))
		$reference1->referCity = $_POST['city1'];
		if(isset($_POST['state1']))
		$reference1->referState = $_POST['state1'];
		if(isset($_POST['pin1']))
		$reference1->referPostcode = $_POST['pin1'];
		if(isset($_POST['post1']))
		$reference1->referPostOffice = $_POST['post1'];
		if(isset($_POST['district1']))
		$reference1->referDistrict = $_POST['district1'];
		if(isset($_POST['country1']))
		$reference1->referCountry = $_POST['country1'];
		if(isset($_POST['email1']))
		$reference1->referEmail = $_POST['email1'];
		if(isset($_POST['occupation1']))
		$reference1->referOccupation = $_POST['occupation1'];
		if(!empty($_POST['timeFrom1']) && !empty($_POST['fromA1']) && !empty($_POST['timeTo1']) && !empty($_POST['toA1'])){
		$time = $_POST['timeFrom1'].':'.$_POST['fromA1'].'-'.$_POST['timeTo1'].':'.$_POST['toA1'];
		$reference1->referCallFrom  = $time;
		}
			if(!empty($reference1->referName) || !empty($reference1->referCallFrom) ||		!empty($reference1->referHouseName)||
						!empty($reference1->referPostOffice)|| !empty($reference1->referCity)||	!empty($reference1->referState)||
						!empty($reference1->referEmail)||	!empty($reference1->referOccupation))
						
						{
								$reference1->save();
						}
		
		
		if(isset($referenceList) && isset($referenceList[2]))
		{
			$reference2 = $referenceList[2];
		}
		else
		{
		$reference2 = new Reference();
		$reference2->userId = $user->userId;
		}
		if(isset($_POST['relation2']))
		$reference2->relation = $_POST['relation2'];
		if(isset($_POST['name2']))
		$reference2->referName = $_POST['name2'];
		if(isset($_POST['house2']))
		$reference2->referHouseName = $_POST['house2'];
		if(isset($_POST['place1']))
		$reference2->referPlace = $_POST['place2'];
		if(isset($_POST['city2']))
		$reference2->referCity = $_POST['city2'];
		if(isset($_POST['state2']))
		$reference2->referState = $_POST['state2'];
		if(isset($_POST['pin2']))
		$reference2->referPostcode = $_POST['pin2'];
		if(isset($_POST['post2']))
		$reference2->referPostOffice = $_POST['post2'];
		if(isset($_POST['district2']))
		$reference2->referDistrict = $_POST['district2'];
		if(isset($_POST['country2']))
		$reference2->referCountry = $_POST['country2'];
		if(isset($_POST['email2']))
		$reference2->referEmail = $_POST['email2'];
		if(isset($_POST['occupation2']))
		$reference2->referOccupation = $_POST['occupation2'];
		if(!empty($_POST['timeFrom2']) && !empty($_POST['fromA2']) && !empty($_POST['timeTo2']) && !empty($_POST['toA2'])){
		$time = $_POST['timeFrom2'].':'.$_POST['fromA2'].'-'.$_POST['timeTo2'].':'.$_POST['toA2'];
		$reference2->referCallFrom  = $time;
		}
		
		if(!empty($reference2->referName) || !empty($reference2->referCallFrom) ||		!empty($reference2->referHouseName)||
						!empty($reference2->referPostOffice)|| !empty($reference2->referCity)||	!empty($reference2->referState)||
						!empty($reference2->referEmail)||	!empty($reference2->referOccupation))
						{
							$reference2->save();
						}
		
		
		
		
		/*
		if(isset($_POST['reference']))
		{
				
				$privacy =  $user->privacy(array('condition'=>"items='reference'"));
				if(isset($privacy)  && sizeof($privacy) > 0 ){
				$privacy1 = $privacy[0];	
				$privacy1->privacy = $_POST['reference'];
				$privacy1->save();	
				}
				else {
				$privacy = new Privacy();
				$privacy->userId = $user->userId;
				$privacy->items = 'reference';
				$privacy->privacy = $_POST['reference'];
				$privacy->save();	
				}
		}
		*/
		}
		$this->layout= '//layouts/popup';
		
		$success= false;
		
		if(isset($_POST) && !empty($_POST)){
		$success = true;
		$notification = new Notifications();
		$notification->userId = $user->userId;
		$notification->name = $user->name;
		$notification->marryId = $user->marryId;
		$notification->notificationType = 'reference';
		$notification->notification = Utilities::getNotificationMessage('reference');
		$notification->status = 0;
		$notification->createdate = new CDbExpression('NOW()');
		$notification->save();
		
		}
		$this->render('referenceedit',array('success'=>$success));
	}
	
	public function actionAstroadd()
	{

		$this->layout= '//layouts/popup';
		$this->render('addAstro');
	}
		
	
	public function actionAstroedit()
	{
		$user = Yii::app()->session->get('user');
		
		if(isset($user->horoscopes)) 
		$horoscope = $user->horoscopes;
		else {
		$horoscope = new Horoscopes();
		$horoscope->userId = $user->userId;
		}
		
		if(isset($_POST) && !empty($_POST)){
		
		if(isset($_POST['date']))
		$horoscope->dob = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['date'];
		if(isset($_POST['astrodate']))
		$horoscope->astrodate = $_POST['astrodate'];
		if(isset($_POST['city']))
		$horoscope->city = $_POST['city'];
		if(isset($_POST['state']))
		$horoscope->state = $_POST['state'];
		if(isset($_POST['country']))
		$horoscope->country = $_POST['country'];
		if(isset($_POST['hours']) || isset($_POST['minutes']) || isset($_POST['seconds']) || isset($_POST['am']))
		$horoscope->time = $_POST['hours'].'-'.$_POST['minutes'].'-'.$_POST['seconds'].' ,'.$_POST['am'];
		if(isset($_POST['chova']))
		$horoscope->dosham = $_POST['chova'];
		if(isset($_POST['sudha']))
		$horoscope->sudham = $_POST['sudha'];
		if(isset($_POST['sign']))
		$horoscope->sign = $_POST['sign'];
		
			if(isset($_FILES['horoscopeFile'])){
			if(!$_FILES['horoscopeFile']['error']){
			$file = $_FILES['horoscopeFile'];
			$fileName=basename( $_FILES['horoscopeFile']['name']);   
			$extension = strtolower(Utilities::getExtension($fileName));  	
			if(Utilities::isValidImageExtension($extension)){         
				$path = Utilities::getDirectory('images',array('horoscope',$user->marryId));
				$fileName = $user->marryId.".".$extension;
				$targetPath = Utilities::getFullFilePath($path, $fileName);
				if(Utilities::uploadFile($_FILES['horoscopeFile']['tmp_name'], $targetPath)) {
	            $horoscope->horoscopeFile = $fileName;
				}
			}
			}
			}
		
		$user->horoscopes = $horoscope;
		$user->horoscopes->save();
		
		$notification = new Notifications();
		$notification->userId = $user->userId;
		$notification->name = $user->name;
		$notification->marryId = $user->marryId;
		$notification->notificationType = 'astro';
		$notification->notification = Utilities::getNotificationMessage('astro');
		$notification->status = 0;
		$notification->createdate = new CDbExpression('NOW()');
		$notification->save();
		
		
		if(isset($_POST['astro']))
		{

				$privacy =  $user->privacy(array('condition'=>"items='astro'"));
				if(isset($privacy) && $privacy->items == 'astro'){
				$privacy->privacy = implode(',', $_POST['astro']);
				$privacy->save();	
				}
				else {
				$privacy = new Privacy();
				$privacy->userId = $user->userId;
				$privacy->items = 'astro';
				$privacy->privacy = implode(',', $_POST['astro']);
				$privacy->save();	
				}
					
		}
			$this->layout= '//layouts/popup';
			$this->render('astroedit',array('edit'=>true));
		}
		else 
		{
		$this->layout= '//layouts/popup';
		$this->render('astroedit',array('edit'=>false));
		}
	}
	
	public function actionPersonaledit()
	{
		$user = Yii::app()->session->get('user');
		$user = Users::model()->with('horoscopes','userpersonaldetails','familyprofiles','physicaldetails','educations','hobies')->findbyPk($user->userId);	
		$this->layout= '//layouts/popup';
		$this->render('personaledit');
	}
	public function actionPersonalupdate()
	{
		$user = Yii::app()->session->get('user');
		$user = Users::model()->with('horoscopes','userpersonaldetails','familyprofiles','physicaldetails','educations','hobies')->findbyPk($user->userId);	
		if(isset($user->userpersonaldetails))
		$userPersonal = $user->userpersonaldetails;
		else{
		$userPersonal = new Userpersonaldetails();
		$userPersonal->userId = $user->userId;
		}
		
		
		if(isset($_POST['state']))
		$userPersonal->stateId = $_POST['state'];
		if(!empty($_POST['district']))
		$userPersonal->districtId = $_POST['district'];
		if(!empty($_POST['place']))
		$userPersonal->placeId = $_POST['place'];
		if(isset($_POST['country']))
		$userPersonal->countryId = $_POST['country'];
		$userPersonal->save();
		
		if(isset($user->physicaldetails))
		$physical = $user->physicaldetails;
		else {
		$physical = new Physicaldetails();
		$physical->userId = $user->userId;
		}
		
		if(isset($_POST['height']))
		$physical->heightId = $_POST['height'];
		if(isset($_POST['weight']))
		$physical->weight = $_POST['weight'];
		if(isset($_POST['bodyType']))
		$physical->bodyType = $_POST['bodyType'];
		if(isset($_POST['complexion']))
		$physical->complexion = $_POST['complexion'];
		if(isset($_POST['physical']))
		$physical->physicalStatus = $_POST['physical'];
		$physical->save();
		
		if(isset($user->educations))
		$education = $user->educations;
		else {
		$education = new Education();
		$education->userId = $user->userId;
		}
		
		if(isset($_POST['education']) && !empty($_POST['education']))
		$education->educationId = $_POST['education'];
		if(isset($_POST['occupation']) && !empty($_POST['occupation']))
		$education->occupationId = $_POST['occupation'];
		if(isset($_POST['employed']))
		$education->employedIn = $_POST['employed'];
		if(isset($_POST['income']) && !empty($_POST['income']))
		{
		$education->yearlyIncome = intval($_POST['income']);
		}
		$education->save();

		if(isset($user->habits))
		$habit = $user->habits;
		else {
		$habit = new Habit();
		$habit->userId = $user->userId;
		}
		
		//habits

		if(isset($_POST['food']))
		$habit->food = $_POST['food'];
		if(isset($_POST['smoke']))
		$habit->smoking = $_POST['smoke'];
		if(isset($_POST['drink']))
		$habit->drinking = $_POST['drink'];
		$habit->save();

		
		if(isset($user->familyprofiles))
		$family = $user->familyprofiles;
		else {
		$family = new Familyprofile();
		$family->userId = $user->userId;
		}
		
		if(isset($_POST['status']))
		$family->familyStatus = $_POST['status'];
		if(isset($_POST['type']))
		$family->familyType = $_POST['type'];
		if(isset($_POST['familyValues']))
		$family->familyValues = $_POST['familyValues'];
		if(isset($_POST['brothers']))
		$family->brothers = $_POST['brothers'];
		if(isset($_POST['brothersMarry']))
		$family->brotherMarried = $_POST['brothersMarry'];
		if(isset($_POST['sisters']))
		$family->sisters = $_POST['sisters'];
		if(isset($_POST['sistersMarry']))
		$family->SisterMarried = $_POST['sistersMarry'];
		if(isset($_POST['familyDesc']))
		$family->familyDesc = $_POST['familyDesc'];
		if(isset($_POST['myDesc']))
		$family->userDesc = $_POST['myDesc'];
		
		$family->save();
		
		if(isset($user->hobies))
		$userHobby = $user->hobies;
		else {
		$userHobby = new Hobiesandinterests();
		$userHobby->userId = $user->userId;
		}
		
		if(isset($_POST['hobby']))
		{
			$userHobby->hobies = implode(",", $_POST['hobby']);
		}
		if(isset($_POST['interest']))
		{
			$userHobby->interests = implode(",", $_POST['interest']);
		}
		if(isset($_POST['sports']))
		{
			$userHobby->activities = implode(",", $_POST['sports']);
		}
		if(isset($_POST['read']))
		{
			$userHobby->reading = implode(",", $_POST['read']);
		}
		if(isset($_POST['movies']))
		{
			$userHobby->movies = implode(",", $_POST['movies']);
		}
		if(isset($_POST['music']))
		{
			$userHobby->musics = implode(",", $_POST['music']);
		}
		if(isset($_POST['cuisine']))
		{
			$userHobby->cuisine = implode(",", $_POST['cuisine']);
		}
		if(isset($_POST['language']))
		{
			$userHobby->languages = implode(",", $_POST['language']);
		}
		if(isset($_POST['othersLanguage'])&& isset($_POST['otherLanguage']))
		{
			$userHobby->languageOther= $_POST['otherLanguage'];
		}
		$userHobby->save();
		
		
		$notification = new Notifications();
		$notification->userId = $user->userId;
		$notification->name = $user->name;
		$notification->marryId = $user->marryId;
		$notification->notificationType = 'contact';
		$notification->notification = Utilities::getNotificationMessage('contact');
		$notification->status = 0;
		$notification->createdate = new CDbExpression('NOW()');
		$notification->save();
		
		
		
		
		$this->layout= '//layouts/popup';
		$this->render('personaledit',array('update'=>true));
	}
	
	
}