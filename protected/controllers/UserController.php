<?php

class UserController extends Controller
{
	  public function beforeAction(CAction $action)
        {
        		if($action->id == 'register')
        		return true;
                $user = Yii::app()->session->get('user');
                if(!isset($user)) {
                        $this->redirect(Yii::app()->user->loginUrl);
                        return false;
                }       
                else{
                	if(isset($user->userloggeddetails) && sizeof($user->userloggeddetails) > 0)
                	{
                		$this->redirect(array('/mypage'));
                	}
                	else{
                	return true;
                	}	
                }
        }   
	  
	
	public function actionRegister()
	{
		$user = new Users();
		$userPersonal = new Userpersonaldetails();
		$view = 'success';
		Yii::app()->getDb()->createCommand("SET time_zone='+05:30'")->execute();
		if(isset($_POST['UserForm']))
		{
			$transaction = Yii::app()->db->beginTransaction();
			try{
				//users table
				$dob = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['date'];
				$user->emailId = $_POST['UserForm']['emailId'];
				$user->password = new CDbExpression("MD5('{$_POST['UserForm']['password']}')");
				$user->name = $_POST['UserForm']['name'];
				$password = $_POST['UserForm']['password'];
				if(isset($_POST['date']) && isset($_POST['month']) && isset($_POST['year']) )
				{	
					$user->dob = $dob;
				}
				$user->gender = $_POST['gender'];
				$user->motherTounge = $_POST['motherTounge'];
				$user->createdOn = new CDbExpression('NOW()');
				$user->active = '0';
				$user->userType = 1; 
				$user->save();
					
				//marrydoor ID updated
				$user->marryId = sprintf("MD%05s",$user->primaryKey);
				$user->updateByPk($user->primaryKey,array('marryId'=>$user->marryId));
					
				
				if(isset($_POST['UserForm']['coupon']))
				{
					//check for coupon detail, if its promo and also check if its active
					$coupon = Coupon::model()->findByAttributes(array('couponCode'=>$_POST['UserForm']['coupon']));
					$isValid = false;
						
					if($coupon->couponType == 'promo')
					{
						$isValid = true;
					}
					else {
						if($coupon->isUsed == 0)
						{
							$isValid = true;
							$coupon->isUsed = 1;
							$coupon->save();			
						}
					}
					
						
					if($isValid) {
						$payment = new Payment();
						$payment->couponcode = $_POST['UserForm']['coupon'];
						$payment->userID = $user->primaryKey;
						$payment->startdate = new CDbExpression('NOW()');
						$payment->actionItem = 'membership';
						$payment->createdate = new CDbExpression('NOW()');
						$payment->save();
						$user->userType = 1; 
					}
				}
					
				//user personal details table
				$userPersonal->userId = $user->primaryKey;
				$userPersonal->casteId = $_POST['caste'];
				$userPersonal->religionId  = $_POST['religion'];
				$userPersonal->countryId = $_POST['country'];
				$userPersonal->districtId = '1';
				$userPersonal->placeId = '1';
				$userPersonal->stateId = $_POST['state'];
				$userPersonal->mobilePhone = $_POST['UserForm']['mobileNo'];
				$userPersonal->landPhone = $_POST['UserForm']['mobileNo'];
				$userPersonal->save();
				$user->save();	
				$transaction->commit();
				
			}
			catch (Exception $e)
			{
				$transaction->rollBack();
				Yii::app()->user->setFlash('error', "{$e->getMessage()}");
				$this->refresh();
			}
				$form = new LoginForm();
				$form->username = $user->marryId;
				$form->password = $password;
				
				$this->sendEmail($user->emailId,$password,$user->marryId);
				if($form->login())
				{
					Yii::app()->session->add('user',$user);
				}
				else
				{
					 $this->redirect(array('/site'));
				}
				
				
		$this->render('contacts',array('user'=>$user,'userPersonal'=>$userPersonal));
		}
		else 
		{
		$this->redirect(array('/site'));
		}
	}

	public function actionFamilyPic(){
		
	}
	
	
	public function actionContact()
	{
		$user = Yii::app()->session->get('user');
		$userPersonal = $user->userpersonaldetails;
		$address = new Address();
		$paddress = new Address();
		$contact = new Usercontactdetails();
		
			$physical = new Physicaldetails();
			$education = new Education();
    		$habit = new Habit();
     		$family = new Familyprofile();

		//Will fetch this from session
		$userPersonal->userId = $user->userId;
		if(isset($_POST['profileFor']))
		$userPersonal->createdBy = $_POST['profileFor'];
		if(isset($_POST['marital']))
		$userPersonal->maritalStatus = $_POST['marital'];
		if(isset($_POST['intercasteable']))
		$userPersonal->intercasteable = $_POST['interCaste'];
		if(isset($_POST['state']))
		$userPersonal->stateId = $_POST['state'];
		if(isset($_POST['district']))
		$userPersonal->districtId = $_POST['district'];
		if(isset($_POST['place']))
		$userPersonal->placeId = $_POST['place'];
		if(isset($_POST['caste']))
		$userPersonal->casteId = $_POST['caste'];
		if(isset($_POST['religion']))
		$userPersonal->religionId = $_POST['religion'];
		if(isset($_POST['country']))
		$userPersonal->countryId = $_POST['country'];
		if(isset($_POST['mobile']))
		$userPersonal->mobilePhone = $_POST['mobile'];
		$userPersonal->save();
			
		//Permanent address
		$address->userId = $user->userId;
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
		$address->addresType = 1;
		$address->save();
		
		//communication address
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
		$paddress->addresType = 0;
		$paddress->save();
			
		//contact details	
		$contact->userId = $user->userId;
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
			
		//physical details
		$physical->userId = $user->userId;
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
			
		
		//education details
		$education->userId = $user->userId;
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
			
		//habits
		$habit->userId = $user->userId;
		if(isset($_POST['food']))
		$habit->food = $_POST['food'];
		if(isset($_POST['smoke']))
		$habit->smoking = $_POST['smoke'];
		if(isset($_POST['drink']))
		$habit->drinking = $_POST['drink'];
		$habit->save();
			
		
		//family details
		$family->userId = $user->userId;
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
		
			if(isset($_POST['Users']['familyAlbum'])){
				
			$file = CUploadedFile::getInstance($user,'familyAlbum');
			if(isset($file) && !empty($file->name))
			{
			$extension = strtolower(Utilities::getExtension($file->name));  
			if(Utilities::isValidImageExtension($extension)){         
			$path = Utilities::getDirectory('images',array('familyAlbum',$user->marryId)); 
			
			
			$file->saveAs($path.$user->marryId.'-'.$file->name);
            $family->familyPic = $user->marryId.'-'.$file->name;
			}
			}
			}
		
		$family->save();
			
		
		if(isset($_POST['pcontact']))
		{
				$privacy = new Privacy();
				$privacy->userId = $user->userId;
				$privacy->items = 'contact';
				$privacy->privacy = $_POST['pcontact'];
				$privacy->save();	
		}
		if(isset($_POST['family']))
		{
		$privacy = new Privacy();
				$privacy->userId = $user->userId;
				$privacy->items = 'family';
				$privacy->privacy = implode(',', $_POST['family']);
				$privacy->save();
		}
		//$url = Yii::app()->createUrl('mypage/index');
		//$this->redirect($url);
		//$this->render('hobbies');
		$this->render("partner");
		
	}
	public function actionHobby()
	{
		$user = Yii::app()->session->get('user');
		$userHobby  = new Hobiesandinterests();
		$userHobby->userId = $user->userId;
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
		
		
		$this->render('horoscope');
	}
	
	public function actionHoro()
	{
		$user = Yii::app()->session->get('user');
		
		if(isset($_POST) && !empty($_POST))
		{
		$horoscope = new Horoscopes();
		$horoscope->userId = $user->userId;
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
		if(isset($_POST['motherTounge']))
		$horoscope->motherTounge = $_POST['motherTounge'];
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
		$horoscope->save();
		$user->horoscopes = $horoscope;
	 		    // redirect to success page
		
	if(isset($_POST['astro']))
		{
				$privacy = new Privacy();
				$privacy->userId = $user->userId;
				$privacy->items = 'astro';
				$privacy->privacy = implode(",", $_POST['astro']);
				$privacy->save();	
		}
		
		
		$reference = new Reference();
		$reference->userId = $user->userId;
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
		$reference->save();

		$reference1 = new Reference();
		$reference1->userId = $user->userId;
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
		$reference1->save();
		
		
		$reference2 = new Reference();
		$reference2->userId = $user->userId;
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
		$reference2->save();
		
		
		
		
		if(isset($_POST['reference']))
		{
				$privacy = new Privacy();
				$privacy->userId = $user->userId;
				$privacy->items = 'reference';
				$privacy->privacy = $_POST['reference'];
				$privacy->save();
		}
		}
		$this->forward('horoupload');
	}
	public function actionHoroupload()
	{
		$user = Yii::app()->session->get('user');
		
		// get the user photos
		$photos = new Photos();
  		$documents = new Documents();
  		$album = new Album();
  		$privacy = new Privacy();
  		//phoot and document action
  		
	if(isset($_GET['r']) && $_GET['r'] == 'setimage'){   // set the profile image
			$photoId = (int)trim($_GET['pId']);
			$userId = (int)trim($_GET['uId']);
			$user = Yii::app()->session->get('user');
			if($user->userId == $userId){
				$photos->updateAll(array('profileImage'=>0),'userId='.$userId);  // unset the existing
				$photos->updateAll(array('profileImage'=>1),'photoId='.$photoId);  // set the new image
				$this->redirect(Yii::app()->params['homeUrl']."/user/horoupload");
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
				$this->redirect(Yii::app()->params['homeUrl']."/user/horoupload");
				Yii::app()->end();	
			}
		}elseif(isset($_GET['r']) && $_GET['r'] == 'deletealbumimage'){   // delete the image
			$photoId = (int)trim($_GET['pId']);
			$userId = (int)trim($_GET['uId']);
			$user = Yii::app()->session->get('user');
			if($user->userId == $userId){
				$photo = $album->find('albumId='.$photoId);
				$path = Utilities::getDirectory('images',array('album',$user->marryId));
				$targetFile = Utilities::getFullFilePath($path, $photo->imageName);
				if(file_exists($targetFile)){
					if(unlink($targetFile)){
						$album->deleteByPk($photoId);
					}
				}
				$this->redirect(Yii::app()->params['homeUrl']."/user/horoupload");
				Yii::app()->end();	
			}
		}elseif(isset($_GET['r']) && $_GET['r'] == 'deletedocument'){   // delete the document
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
				$this->redirect(Yii::app()->params['homeUrl']."/user/horoupload");
				Yii::app()->end();	
			}
		}
		
		// remove the unwanted records from photos table
		$query = 'delete from photos where userId ='.$user->userId.' and active = 2';
		Utilities::executeRawQuery($query);
		
		// remove the unwanted records from album table
		$query = 'delete from album where userId ='.$user->userId.' and active = 2 and type=1';
		Utilities::executeRawQuery($query);
		
		// remove the unwanted records from album table
		$query = 'delete from documents where userId ='.$user->userId.' and active = 2';
		Utilities::executeRawQuery($query);
							
		$photosList = $photos->findAll('userId='.$user->userId.' and active=1');
		$documentList = $documents->findAll('userId='.$user->userId.' and active=1');
		$albumList = $album->findAll('userId='.$user->userId.' and type=1 and active=1');
		$settings = $privacy->find("userId=".$user->userId. " and items='album'");
		$familysettings = $privacy->find("userId=".$user->userId. " and items='family'");
		$documentsettings = $privacy->find("userId=".$user->userId. " and items='documents'");
		$this->render('horoupload',array('photos'=>$photosList,'user'=>$user,'documents'=>$documentList, 'familyPhotos'=>$albumList,'settings'=>$settings, 'familysettings'=>$familysettings, 'documentsettings'=>$documentsettings));
		//here we have to show the documents and album upload page
		//then show profile complete page
	}
	
	public function actionShowpartner()
	{
		
		$this->render("hobbies");
	}
	
	public function actionPartner()
	{
		$user = Yii::app()->session->get('user');
		
		$partner = new Partnerpreferences();
		
		$partner->userId = $user->userId;
		if(isset($_POST['ageFrom']))
		$partner->ageFrom = $_POST['ageFrom'];
		if(isset($_POST['ageTo']))
		$partner->ageTo = $_POST['ageTo'];
		if(isset($_POST['maritial']))
		$partner->maritalStatus = implode(",", $_POST['maritial']);
		
		if(isset($_POST['child']))
		$partner->haveChildren = $_POST['child'];
		if(isset($_POST['heightFrom']))
		$partner->heightFrom = $_POST['heightFrom'];
		if(isset($_POST['heightTo']))
		$partner->heightTo = $_POST['heightTo'];
		if(isset($_POST['status']))
		$partner->physicalStatus = $_POST['status'];
		if(isset($_POST['religion']))
		$partner->religion = $_POST['religion'];
		if(isset($_POST['caste1']))
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
		if(isset( $_POST['country1']))
		$partner->countries = implode(",", $_POST['country1']);
		if(isset($_POST['state1']))
		$partner->states = implode(",", $_POST['state1']);
		if(isset($_POST['district1']))
		$partner->districts = implode(",", $_POST['district1']);
		if(isset($_POST['place1']))
		$partner->places = implode(",", $_POST['place1']);
		if(isset($_POST['language1']))
		$partner->languages = implode(",", $_POST['language1']);
		if(isset($_POST['citizen1']))
		$partner->citizenship = implode(",", $_POST['citizen1']);
		if(isset($_POST['occupation1']))
		$partner->occupation = implode(",", $_POST['occupation1']);
		if(isset($_POST['income']))
		$partner->annualIncome = $_POST['income'];
		if(isset($_POST['partnerDesc']))
		$partner->partnerDescription = $_POST['partnerDesc'];
		
		$partner->save();
		$subject = "Congratulations!";
		$body = "You have successfully registered with marrydoor.com with the {$user->marryId} . Please visit the site http://marrydoor.com";
		Utilities::sendClaimEmail($user->emailId,$subject,$body);
		$this->render('success',array('user'=>$user));
		
	}
	
	
	public function actionPassword()
	{
		
	}
	
	
	public function actionIndex()
	{
		
		
		$user = Yii::app()->session->get('user');
		$this->render('contacts',array('user'=>$user));
		
		//$this->render('horoscope',array('model' => new Horoscopes()));
	}

	public function actionProfilepicture()
	{
		$user = Yii::app()->session->get('user');
  		$photos = new Photos();
  		$documents = new Documents();
  		$album = new Album();
		$privacy = new Privacy();
  		//phoot and document action
  		
	if(isset($_GET['r']) && $_GET['r'] == 'setimage'){   // set the profile image
			$photoId = (int)trim($_GET['pId']);
			$userId = (int)trim($_GET['uId']);
			$user = Yii::app()->session->get('user');
			if($user->userId == $userId){
				$photos->updateAll(array('profileImage'=>0),'userId='.$userId);  // unset the existing
				$photos->updateAll(array('profileImage'=>1),'photoId='.$photoId);  // set the new image
				$this->redirect(Yii::app()->params['homeUrl']."/user/horoupload");
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
				$this->redirect(Yii::app()->params['homeUrl']."/user/horoupload");
				Yii::app()->end();	
			}
		}elseif(isset($_GET['r']) && $_GET['r'] == 'deletealbumimage'){   // delete the image
			$photoId = (int)trim($_GET['pId']);
			$userId = (int)trim($_GET['uId']);
			$user = Yii::app()->session->get('user');
			if($user->userId == $userId){
				$photo = $album->find('albumId='.$photoId);
				$path = Utilities::getDirectory('images',array('album',$user->marryId));
				$targetFile = Utilities::getFullFilePath($path, $photo->imageName);
				if(file_exists($targetFile)){
					if(unlink($targetFile)){
						$album->deleteByPk($photoId);
					}
				}
				$this->redirect(Yii::app()->params['homeUrl']."/user/horoupload");
				Yii::app()->end();	
			}
		}elseif(isset($_GET['r']) && $_GET['r'] == 'deletedocument'){   // delete the document
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
				$this->redirect(Yii::app()->params['homeUrl']."/user/horoupload");
				Yii::app()->end();	
			}
		}
		
		// remove the unwanted records from photos table
		$query = 'delete from photos where userId ='.$user->userId.' and active = 2';
		Utilities::executeRawQuery($query);
		
		// remove the unwanted records from album table
		$query = 'delete from album where userId ='.$user->userId.' and active = 2 and type=1';
		Utilities::executeRawQuery($query);
		
		// remove the unwanted records from album table
		$query = 'delete from documents where userId ='.$user->userId.' and active = 2';
		Utilities::executeRawQuery($query);
							
		$photosList = $photos->findAll('userId='.$user->userId.' and active=1');
		$documentList = $documents->findAll('userId='.$user->userId.' and active=1');
		$albumList = $album->findAll('userId='.$user->userId.' and type=1 and active=1');
		$settings = $privacy->find("userId=".$user->userId. " and items='album'");
		$familysettings = $privacy->find("userId=".$user->userId. " and items='family'");
		$documentsettings = $privacy->find("userId=".$user->userId. " and items='documents'");
		$this->render('profilepicture',array('photos'=>$photosList,'user'=>$user,'documents'=>$documentList, 'familyPhotos'=>$albumList,'settings'=>$settings, 'familysettings'=>$familysettings, 'documentsettings'=>$documentsettings));
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
					$this->redirect(Yii::app()->params['homeUrl']."/user/photoupload");
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
					$this->redirect(Yii::app()->params['homeUrl']."/user/photoupload");
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
				parent.window.location.href = '<?php echo Utilities::createAbsoluteUrl('user','horoupload'); ?>';
				</script>
				<?php 
			}
  		$photosList = $photos->findAll('userId='.$user->userId);
  		$settings = $privacy->find("userId=".$user->userId. " and items='album'");
		$this->layout= '//layouts/popup';
		$this->render('photoupload',array('photos'=>$photosList,'user'=>$user,'settings'=>$settings));
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
				$this->redirect(Yii::app()->params['homeUrl']."/user/documentupload");
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
				parent.window.location.href = '<?php echo Utilities::createAbsoluteUrl('user','horoupload'); ?>';
				</script>
				<?php 
			}
		
  		$documentList = $documents->findAll('userId='.$user->userId);
  		$settings = $privacy->find("userId=".$user->userId. " and items='documents'");
		$this->layout= '//layouts/popup';
		$this->render('documentupload',array('documents'=>$documentList,'user'=>$user,'documentsettings'=>$settings));
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
			 	$this->redirect(Yii::app()->params['homeUrl']."/user/familyphotoupload");
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
				parent.window.location.href = '<?php echo Utilities::createAbsoluteUrl('user','horoupload'); ?>';
				</script>
				<?php 
			}
		
  		$photosList = $photos->findAll('userId='.$user->userId);
  		$settings = $privacy->find("userId=".$user->userId. " and items='family'");
		$this->layout= '//layouts/popup';
		$this->render('familyphotoupload',array('photos'=>$photosList,'user'=>$user,'settings'=>$settings));
	}
	
	
	public function sendEmail($email,$password,$marryId)
	{

		$body = '
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <title>marrydoor.com</title>
</head>
<body style="margin: 0;padding: 0;font-family: sans-serif;">
<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" style="background-color:#ffffff;font-family:Arial,Helvetica,sans-serif">
    <tbody>
        <tr>
            <td>
                <table width="600" cellspacing="0" cellpadding="0" border="0" bgcolor="#c8bfe7" align="left" style="background:#c8bfe7;padding-top: 5px;padding-bottom: 5px;">
                    <tbody>
                        <tr>
                            <td width="100%" bgcolor="#c8bfe7" align="center" style="background-color:#c8bfe7">
                                <table width="590" cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#7c51a1" style="background-color:#7c51a1;margin-bottom: 5px;">
                                    <tbody>
                                        <tr>
                                            <td height="80" valign="middle"><span style="color: #ffffff;font-size: 50px;margin-left: 20px;float: left;">marrydoor</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table width="590" cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#c8bfe7" style="background-color:#c8bfe7;margin-top: 5px;margin-bottom: 5px;">
                                    <tbody>
                                        <tr>
                                            <td height="35" valign="middle"><span style="color: #ffffff;font-size: 24px;margin-left: 20px;float: left;">Welcometo Marrydoor.com</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table width="590" cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#ffffff" style="background-color:#ffffff;padding-bottom: 30px;padding-top: 30px;"> 
                                    <tbody>
                                        <tr>
                                            <td valign="top" bgcolor="#ffffff" >
                                                <font style="font:normal 20px arial;text-align:justify;color:#009900;float: left;margin-left: 20px;margin-right: 20px;margin-bottom: 5px;">
                                                    You have successfully registered for partner search.
                                                </font>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top" bgcolor="#ffffff" >
                                                <font style="font:normal 16px arial;text-align:justify;color:#666666;float: left;margin-left: 20px;margin-right: 20px;margin-top: 0px;margin-bottom: 20px;">
                                                    We will update you about your matches, requests &amp; messages from them.
                                                </font>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top" bgcolor="#ffffff" >
                                                <font style="font:normal 16px arial;text-align:justify;color:#666666;float: left;margin-left: 20px;margin-right: 20px;margin-top: 10px;margin-bottom: 5px;">
                                                    Your login details are:
                                                </font>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top" bgcolor="#ffffff" >
                                                <font style="font:normal 16px arial;text-align:justify;color:#666666;float: left;margin-left: 20px;margin-right: 20px;margin-top: 10px;margin-bottom: 5px;">
                                                    Profile ID : <b>'.$marryId.'</b>
                                                </font>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top" bgcolor="#ffffff" >
                                                <font style="font:normal 16px arial;text-align:justify;color:#666666;float: left;margin-left: 20px;margin-right: 20px;margin-top: 10px;margin-bottom: 5px;">
                                                    Email ID: <b>'.$email.'</b>
                                                </font>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top" bgcolor="#ffffff" >
                                                <font style="font:normal 16px arial;text-align:justify;color:#666666;float: left;margin-left: 20px;margin-right: 20px;margin-top: 10px;margin-bottom: 30px;">
                                                    Password: <b>'.$password.'</b>
                                                </font>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top" bgcolor="#ffffff" >
                                                <font style="font:normal 16px arial;text-align:justify;color:#333333;float: left;margin-left: 20px;">
                                                    Best wishes
                                                </font>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top" bgcolor="#ffffff" >
                                                <font style="font:normal 16px arial;text-align:justify;color:#666666;float: left;margin-left: 20px;">
                                                    Biju George
                                                </font>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top" bgcolor="#ffffff" >
                                                <font style="font:normal 14px arial;text-align:justify;color:#666666;float: left;margin-left: 20px;">
                                                    Cheaf Executive Officer
                                                </font>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top" bgcolor="#ffffff" >
                                                <font style="font:normal 14px arial;text-align:justify;color:#666666;float: left;margin-left: 20px;">
                                                    Marrydoor.com
                                                </font>
                                            </td>
                                        </tr> 
                                    </tbody>
                                </table>
                                <table width="590" cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#c8bfe7" style="background-color:#c8bfe7;"> 
                                    <tbody>
                                        <tr>
                                            <td valign="top" >
                                                <font style="font:normal 14px arial;text-align:justify;color:#ffffff;margin-left: 20px;margin-right: 20px;margin-top: 10px;margin-bottom: 10px;float: left;">
                                                    Wishing You all the very best in Your partner search, <br /> Team - MARRYDOOR
                                                </font>
                                            </td>
                                        </tr>  
                                    </tbody>
                                </table>
                                <table width="590" cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#ffffff" style="background-color:#ffffff;"> 
                                    <tbody>
                                        <tr>
                                            <td height="50" valign="top" bgcolor="#ffffff" >
                                                <font style="font:normal 12px arial;text-align:justify;color:#939598;float: left;margin-left: 20px;margin-right: 20px;margin-top: 10px;margin-bottom: 10px;">
                                                    You are a MarryDoor.com member. This e-mail comes to you in accordance with MarryDoor.com Privacy Policy. <a style="color:#408EF8;text-decoration: none;" href="https://www.marrydoor.com/">Click here</a>  to unsubscribe. MarryDoor.com is not responsible for content other than its own and makes no warranties or guaratees about the products or services that are advetised.
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
		Utilities::sendClaimEmail($email,'Welcome to Marrydoor.com',$body);
		
	}	
}