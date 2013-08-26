<?php
/**
* Utility class
*/
class Utilities
{

   const DS = DIRECTORY_SEPARATOR;
   const PS = PATH_SEPARATOR;
   
   public static function getRegDays() {
     $days = array();
     foreach( range(1,31) as $day){
      if($day < 10) {
       $days['0'.$day] = '0'.$day;
      } else {
       $days[$day] = $day;
      }
     }
     return $days;
    }
    
 public static function getRegMonths()
 {
  return array(
     '01' => Yii::t('app','January'), 
     '02' => Yii::t('app','February'),
     '03' => Yii::t('app','March'), 
     '04' => Yii::t('app', 'April'),
     '05' => Yii::t('app','May'),
     '06' => Yii::t('app','June'),
     '07' => Yii::t('app','July'),
     '08' => Yii::t('app','August'), 
     '09' => Yii::t('app','September'), 
     '10' => Yii::t('app','October'), 
     '11' => Yii::t('app','November'),
     '12' => Yii::t('app','December'),
  );
 }
 
 
 public static function getRegYears()
 {

  $yearNow = self::currentYear();
  $yearFrom = $yearNow - 55;
  $yearTo = $yearNow - 18;
  $arrYears = array();

  foreach (range($yearFrom, $yearTo) as $number) {
   $arrYears[$number] = $number;
  }
  return $arrYears;
 }
 
 public static function getTime()
 {
  return array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'11','12'=>'12');
 }
 
 public static function getMinutes()
 {
 	 $days = array();
     foreach( range(0,60) as $day){
   		$days[$day] = $day;
     }
     return $days; 
 }
 
 public static function getHeights()
 {
  $height = array();
  foreach( range(150,200) as $cm){
   $feet = $cm*0.3937008/12;
      $ft = (int)$feet;
      $inc = ceil(($feet-$ft)*12);
   $height[strval($cm)] = strval($cm.'cm - '.$ft.'ft '.$inc.'in');
     }
  return $height; 
 }
 
 public static function getAge()
 {
  $days = array();
     foreach( range(18,55) as $day){
   $days[$day] = $day;
     }
     return $days; 
 }
 
 public static function getAnnualSalary()
 {
  $salary = array();
     foreach( range(18,50) as $day){
   $days[$day] = $day;
     }
     return $days;
 }
 
 public static function getMeridiem()
 {
  return array('am' => 'AM','pm' =>'PM');
 }
 
 public static function getBodyType()
 {
 	return array('0'=>'Average','1'=>'Athletic','2'=>'Slim','3'=>'Heavy');
 }
	public static function getBodyColor()
 {
 	return array('0'=>'Very Fair','1'=>'Fair','2'=>'Wheatish','3'=>'Wheatish Brown','4'=>'Dark');
 }
 public static function getMaritalStatus()
 {
 	return array('0'=>'Unmarried','1'=>'widower','2'=>'Divorced','3'=>'Awating divorce','4'=>'Any');
 }
 
 public static function getProfileCreated()
 {
 	
 }
 public static function getInterCaste()
 {
 	
 }
 
 public static function getFamilyStatus()
 {
 	return array('0'=>'lower middle class','1'=>'middle class','2'=>'upper middle class','3'=>'rich','4'=>'affluent');
 } 
 
 public static function getFamilyType()
 {
 	return  array('0'=>'joint','1'=>'nuclear');
 }
 
 public static function getFamilyValues()
 {
 	return array('0'=>'orthodox','1'=>'traditional','2'=>'moderate','3'=>'liberal');
 }
 

 public static function getValueForIds($model,$ids,$param)
 {
 	$valuString = "";
 	$arrayIds = explode(",", $ids);
   	$result = $model->findAllByAttributes(array($param=>$arrayIds));
   	if(sizeof($result) > 0)
   	{
   	foreach ($result as $value) {
   		$valuString = $valuString.', '. $value->name;
   	}
 	return trim($valuString, ",");
   	}
   	else
   	return 'Not specified';
 }
 
 
 
 public static function getArrayValues($arrayToFetch,$indexes)
 {
 	$stringValue = "";
 	$arrayIds = explode(",", $indexes);
 	if(sizeof($arrayIds)> 0)
 	{
 	foreach ($arrayIds as $value) {
		$stringValue = $stringValue.','.$arrayToFetch[$value];
 	}
	return trim($stringValue, ","); 	
 	}
 	else 
 	return "Not specified";
 }
 
 
 public static function getJob()
 {
 	return array('0'=>'Goverment','1'=>'private','2'=>'Business','3'=>'Defence','4'=>'self','5'=>'NRI');
 }
 
 public static function physicalStatus()
 {
 	return array('0'=>'Normal','1'=> 'physically challenged');
 }
 
 public static function getFood()
 {
 	return array('0'=>'Vegetarian','1'=>'Non-Vegetarian','2'=>'Eggetarian','3'=>"Doesn't matter");
 }
 
 public static function getDrink()
 {
 	return array('0'=>'Non-Drinker','1'=> 'Occasinoaly','2'=>'Drinker','3'=>"Doesn't matter");
 }
 
	public static function getSmoke()
	{
		return array('0'=>'Non-smoker','1'=> 'Occasinoaly','2'=>'Smoker','3'=>"Doesn't matter");
	} 
	
	public static function getChildren()
	{
		return array('0'=>"Doesn't matter",'1'=>"Yes. living together",'2'=>"Yes. not living together",'3'=>"No" );
	}

 public static function getYears()
 {
  $yearNow = self::currentYear();
  $yearFrom = $yearNow - 10;
  $yearTo = $yearNow + 10;
  $arrYears = array(''=>'Year');

  foreach (range($yearFrom, $yearTo) as $number) {
   $arrYears[$number] = $number;
  }
  return $arrYears;
 }

 public static function getAgeFromDateofBirth($dob)
 {
    return floor((time() - strtotime($dob)) / 31556926);
 }
 
 public static function getHumanTime($time)
 {
 	
    $time = time() - $time; // to get the time since that moment
    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }

 }
 
 /**
  * Get the current year
  */
  
 public static function currentYear()
 {
  return date("Y");
 } 
 
 /**
  * Get the current Day
  */
  
 public static function currentDay()
 {
  return date("d");
 }
 
 /**
  * Get the current Day
  */
  
 public static function currentMonth()
 {
  return date("m");
 }
   public static function getFtpPath(){
   	return Yii::app()->params['ftpPath'];
   }
   
	public static function getDirectory($path,$subdirectory=array()){

		$createPath = self::getFtpPath().self::DS.$path;	
		if(!is_dir($createPath)){
				mkdir($createPath, 0777);
				chmod($createPath, 0777);
			}
		$returnPath = $createPath;
		if(!empty($subdirectory)){
			foreach($subdirectory as $dir){
				$createPath = $returnPath.self::DS.$dir;
				if(!is_dir($createPath)){
					mkdir($createPath, 0777);
					chmod($createPath, 0777);
				}
				$returnPath = $createPath;
			}
		}
		return $returnPath;
   }
	
   public static function getExtension($file) {  
		$position = strrpos($file,".");  
		if (!$position) { return ""; } 
		$length = strlen($file) - $position;  
		$extension = substr($file,$position+1,$length);  
		return $extension;  
	} 
	
	public static function getFullFilePath($path,$fileName){
		return $path.self::DS.$fileName;
	}
	
	public static function isValidImageExtension($extension){
		if(in_array($extension,array('jpg','jpeg','gif','png'))){
			return true;
		}else{
			return false;
		}
	}
	
	public static function uploadFile($fileName,$path){
		if(move_uploaded_file($fileName, $path)) { 
				return true;
			} else{  
				 return false;  
			} 
	}
	
	public static function getProfileImage($marryId,$imageName){
		if($imageName != ''){
			$file = Yii::app()->params['mediaUrl']."/profile/".$marryId."/".$imageName;
			if (@file_get_contents($file)){
				return $file;
			}else{
				return Yii::app()->params['mediaUrl']."/profile/noimage.jpg";
			}
		}else{
			return Yii::app()->params['mediaUrl']."/profile/noimage.jpg";
		}
	}
	
		public static function getProfileImageForId($userId){
		if(isset($userId)){
			$user = Users::model()->findbyPk($userId);
			if(isset($user))
			{
				$profileImage = $user->photos(array('condition'=>'profileImage = 1'));
			 	if(count($profileImage) > 0){
			 		$image = $profileImage[0]->imageName;
			 	}else{
			 		$image = '';
			 	}
			}
			if($image != '')			
			$file = Yii::app()->params['mediaUrl']."/profile/".$user->marryId."/".$image;
			if (@file_get_contents($file)){
				return $file;
			}else{
				return Yii::app()->params['mediaUrl']."/profile/noimage.jpg";
			}
		}else{
			return Yii::app()->params['mediaUrl']."/profile/noimage.jpg";
		}
	}
	
	public static function getHoroscope($marryId,$imageName){
		if($imageName != ''){
			$file = Yii::app()->params['mediaUrl']."/horoscope/".$marryId."/".$imageName;
			if (@file_get_contents($file)){
				return $file;
			}
		}
	}
	
	
	
	public static function getAlbumImage($marryId,$imageName){
		if($imageName != ''){
			$file = Yii::app()->params['mediaUrl']."/album/".$marryId."/".$imageName;
			if (@file_get_contents($file)){
				return $file;
			}else{
				return Yii::app()->params['mediaUrl']."/profile/noimage.jpg";
			}
		}else{
			return Yii::app()->params['mediaUrl']."/profile/noimage.jpg";
		}
	}
	public static function getDocumentImage($marryId,$imageName){
		if($imageName != ''){
			$file = Yii::app()->params['mediaUrl']."/documents/".$marryId."/".$imageName;
			if (@file_get_contents($file)){
				return $file;
			}else{
				return Yii::app()->params['mediaUrl']."/profile/noimage.jpg";
			}
		}else{
			return Yii::app()->params['mediaUrl']."/profile/noimage.jpg";
		}
	}
	
	public static function isValidDocumentExtension($extension){
		if(in_array($extension,array('txt','doc','docx','pdf','rft','jpg','jpeg','png'))){
			return true;
		}else{
			return false;
		}
	}
	
 public static function getInterestStatus()
 {
 	return array('0'=>'no','1'=>'accept','2'=>'decline','3'=>'delete');
 }
 
 public static function createAbsoluteUrl($controller,$action='',$params=array(),$protocol='')
 {
 	if($action == ''){
 		$action = 'index';
 	}
 	if($protocol == ''){
 		$protocol = 'http';
 	}
 	if($protocol == "https"){
    		$selfUrl = 'http://'.$_SERVER['SERVER_NAME']."/".$controller."/".$action;
    	}else{
    		$selfUrl = 'http://'.$_SERVER['SERVER_NAME']."/".$controller."/".$action;
    	}
    	if(!empty($params)){
    		$selfUrl.= "?";
    		foreach($params as $key=>$value){
    			$selfUrl.= $key."=".$value."&";
    		}
    		$selfUrl = substr($selfUrl,0,strlen($selfUrl)-1);
    	}
    	return $selfUrl;
 }
 
 public static function getProtocol(){
 	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https" : "http";
 	return $protocol;
 }
 public static function getMediaUrl()
 {
 	if(self::getProtocol()=='https'){
 		return Yii::app()->params['sslmediaUrl'];
 	}else{
 		return Yii::app()->params['mediaUrl'];
 	}
 }
 
 public static function getUserTypes()
 {
 	return array('0'=>'normal','1'=>'paid','2'=>'deleted');
 }
 
	public static function getUserDisplay($index)
	 {
	 	$userType =  array('0'=>'You can change your account to subscribe user','1'=>'You are subscribed','2'=>'deleted');
	 	return $userType[$index]; 
	 }
 
 
 public static function getWeight()
 {
 	$weights = array();
     foreach( range(25,130) as $weight){
   $weights[$weight] = $weight;
     }
     return $weights; 	
 }
 
 public static function getBrotherCount()
 {
 	$weights = array();
     foreach( range(0,5) as $weight){
   $weights[$weight] = $weight;
     }
     return $weights; 	
 }
 
 public static function getAnnualIncome()
 {
	return array('49'=>'Belove 50000','50'=>'50000','60'=>'60000','70'=>'70000',
	'80'=>'80000','90'=>'90000','110'=>'110000','120'=>'120000','130'=>'130000'
	,'140'=>'140000','150'=>'150000','160'=>'160000','170'=>'170000','180'=>'180000',
	'190'=>'190000','200'=>'2 Lakhs','250'=>'2.5 lakhs','300'=>'3 Lakhs','400'=>'4 Lakhs',
	'500'=>'5 Lakhs','600'=>'6 Lakhs','700'=>'7 Lakhs','800'=>'8 Lakhs','900'=>'9 Lakhs',
	'1000'=>'10 Lakhs','1200'=>'12 Lakhs','1400'=>'14 Lakhs','1600'=>'16 Lakhs','1800'=>'18 Lakhs',
	'2000'=>'20 Lakhs','2500'=>'25 Lakhs','3000'=>'30 Lakhs','3500'=>'35 Lakhs','4000'=>'40 Lakhs',
	'4500'=>'45 Lakhs','5000'=>'50 Lakhs','5500'=>'55 Lakhs','6000'=>'60 Lakhs','6500'=>'65 Lakhs',
	'7000'=>'70 Lakhs','7500'=>'75 Lakhs','8000'=>'80 Lakhs','8500'=>'85 Lakhs','9000'=>'90 Lakhs',
	'9500'=>'95 Lakhs','10000'=>'1 crore','10001'=>'Above 1 crore');
 }
 
 
 public static function getHomeUrl()
 {
 	return Yii::app()->params['homeUrl']; 
 }
 
	public static function sendClaimEmail($to,$subject,$body) {
        // escaped just in case...
        $datetime = new DateTime(); 
        $dString = $datetime->format('Y/m/d H:i:s');
        set_time_limit(0);
        Yii::import('application.extensions.*');
        $message = new YiiMailMessage();
       	$message->setTo($to);
        $message->setFrom(Yii::app()->params['adminEmail']);
        $message->setSubject($subject);
        $message->setBody($body, 'text/html');
        $numsent = Yii::app()->mail->send($message);
	}
 
	public static function getLanguageForId($id)
	{
		$language = Languages::model()->findbyPk($id);
		return $language->name;
	}
	
	public static function getAddressType()
	{
		return array('0' =>'communication','1' =>'permanent');
	}
 
 
 public static function getScriptUrl()
 {
 	if(self::getProtocol()=='https'){
 		return Yii::app()->params['sslScriptUrl'];
 	}else{
 		return Yii::app()->params['scriptUrl'];
 	}
 }
 
 public static function getPartnerPreference($parenterPrefObj)
 {
 	$condition = "age BETWEEN {$parenterPrefObj->ageFrom} AND {$parenterPrefObj->ageTo} and active =1";
 	if($parenterPrefObj->heightFrom){
	 	$condition .= " AND heightId BETWEEN {$parenterPrefObj->heightFrom} AND {$parenterPrefObj->heightTo}";
 	}
	if(isset($parenterPrefObj->maritalStatus))
	{
		if($parenterPrefObj->maritalStatus != 4)
		$condition .= " AND maritalStatus = {$parenterPrefObj->maritalStatus}";
	}
	/*
 	if(isset($parenterPrefObj->haveChildren))
	{
		$condition .= "AND haveChildren = {$parenterPrefObj->haveChildren}";
	}*/
	if(isset($parenterPrefObj->physicalStatus))
	{
		if($parenterPrefObj->physicalStatus != 2)
		$condition .= " AND physicalStatus = {$parenterPrefObj->physicalStatus}";
	}
 	
	if(isset($parenterPrefObj->religion))
	{
		$condition .= " AND religionId = {$parenterPrefObj->religion}";
	}
 	if(isset($parenterPrefObj->caste))
	{
		$condition .= " AND casteId IN ($parenterPrefObj->caste)";
	}
 	/*if(isset($parenterPrefObj->subcaste))
	{
		$condition .= "AND casteId = {$parenterPrefObj->subcaste}";
	}
	*/
	
 	if(isset($parenterPrefObj->dosham))
	{
		if($parenterPrefObj->dosham == 1)
		$condition .= " AND dosham = {$parenterPrefObj->dosham}";
		else
		$condition .= " AND (dosham = {$parenterPrefObj->dosham} OR dosham IS NULL)";
		
		
	
	}
 	if(isset($parenterPrefObj->sudham))
	{
		if($parenterPrefObj->sudham == 0)
		$condition .= " AND sudham = {$parenterPrefObj->sudham}";
		else
		$condition .= " AND (sudham = {$parenterPrefObj->sudham}  OR sudham IS NULL)";
		
	}
 	if(isset($parenterPrefObj->eatingHabits))
	{
		if($parenterPrefObj->eatingHabits != 3)
		$condition .= " AND food IN ($parenterPrefObj->eatingHabits)";
	}
 	if(isset($parenterPrefObj->drinkingHabits))
	{
		if($parenterPrefObj->drinkingHabits != 3)
		$condition .= " AND drinking IN ($parenterPrefObj->drinkingHabits)";
	}
		if(isset($parenterPrefObj->smokingHabits))
	{
		if($parenterPrefObj->smokingHabits != 3)
		$condition .= " AND smoking IN ($parenterPrefObj->smokingHabits)";
	}
 	if(isset($parenterPrefObj->languages))
	{
		
		$condition .= " AND motherTounge IN ($parenterPrefObj->languages)";
	}
 if(isset($parenterPrefObj->countries))
	{
	
		$condition .= " AND countryId IN ($parenterPrefObj->countries)";
	}
 if(isset($parenterPrefObj->states))
	{
		
		$condition .= " AND stateId IN ($parenterPrefObj->states)";
	}
 if(isset($parenterPrefObj->districts))
	{
		$condition .= " AND districtId IN ($parenterPrefObj->districts)";
	}	
	if(isset($parenterPrefObj->places))
	{
		$condition .= " AND placeId IN ($parenterPrefObj->places)";
	}	
	/*
	if(isset($parenterPrefObj->citizenship))
	{
		$condition .= "AND citizenship = {$parenterPrefObj->citizenship}";
	}	
	*/
	if(isset($parenterPrefObj->occupation))
	{
		
		$condition .= " AND occupationId IN ($parenterPrefObj->occupation)";
	}	
 	return $condition;
 }
 
	public static function getTimeDuration($time)
	{
			$currentDate = new DateTime('now');
			$date = new DateTime($time);
			$balance = $date->diff($currentDate);
		
		
			$strTimeSpent = "";
			$days = $balance->format('%a');
			$hours = $balance->format('%H');
			$minutes = $balance->format('%I');
			
			if($days > 0)
			$strTimeSpent = date('F d Y', strtotime($time));
			elseif($days == 0 && $hours > 0 )
			$strTimeSpent = "{$hours} hours ago";		
			elseif($days == 0 && $hours == 0)
			$strTimeSpent = $minutes.' minutes ago';
			else
			$strTimeSpent = "few seconds ago";
			
			return $strTimeSpent;	
	}
	
	public static function executeRawQuery($query)
	{
		$connection=Yii::app()->db;
		$command=$connection->createCommand($query);
		$command->execute();
	}
	
	public static function executeSelectQuery($query)
	{
		$connection=Yii::app()->db;
		$command=$connection->createCommand($query);
		return $command->queryAll();
	}
	
	public static function executeSQLQuery($query)
	{
		$connection=Yii::app()->db;
		$command=$connection->createCommand($query);
		return $command->query();
	}
	
	public function getRequestProtocol(){
			$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? 'https' : 'http';
			return $protocol;
	}
	
	public static function getSelfUrl() {
    	$selfUrl = self::getRequestProtocol()."://".$_SERVER['SERVER_NAME'].'/';
        return $selfUrl;
    }
    
	public static function getCurrentUrl(){
    	return self::getRequestProtocol()."://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    
    	public static function getChova()
	{
		return array('0'=>'No','1'=>'Yes','2'=> 'Do not know');
	}
	
	public static function getSudham()
	{
		return array('0'=>'No','1'=>'Yes','2'=> 'Do not know');
	}
	
	public static function getShowProfileForSearch()
	{
		return array('0'=>'ignore','1'=>'contact','2'=>'shortlist','3'=>'view');				
	}
	
    public static function getDocumentType($value){
    	switch($value){
    		case 1:
    		return 'Passport';
    		break;
    		case 2:
    		return 'Voters ID';
    		break;
    		case 3:
    		return 'PAN Card';
    		break;
    		case 4:
    		return 'ADHAR Card';
    		break;
    		case 5:
    		return 'Ration Card';
    		break;
    		case 6:
    		return 'University Certificate';
    		break;
    		case 7:
    		return 'SSLC Book';
    		break;
    		case 8:
    		return 'Bank Pass Book';
    		break;
    		case 9:
    		return 'Driving Licence';
    		break;
    		case 10:
    		return 'Birth Certificate';
    		break;
    	}
    }
    
	public static function getFamilyRelationType($value){
    	switch($value){
    		case 1:
    		return 'Father';
    		break;
    		case 2:
    		return 'Mother';
    		break;
    		case 3:
    		return 'Brother';
    		break;
    		case 4:
    		return 'Sister';
    		break;
    	}
    }
    
    public static function getUserActivityStatus($user)
    {
    	if(isset($user)){
    		if(isset($user->userloggeddetails))
    		{
    			$time = Utilities::executeSQLQuery("SELECT loggedIn  FROM `userloggeddetails` WHERE userId = {$user->userId} order by loggedIn DESC limit 1");
    			if(isset($time) && !empty($time))
    			{
    				foreach($time as $row)
					{		
					if(isset($row))	
    				return Utilities::getTimeDuration($row['loggedIn']);
    				else
    				return "No activity";
					}
    			}
    			else
    			return Utilities::getTimeDuration($user->createdOn);
    		}
    	}
    	else
    	return "No activity";
    	
    }
    
    public static  function getCurrentUserStatus($user)
    {
    	if(isset($user))
    	{
    		$userArray  = Utilities::getUserStatus();
    		$userStatus = $userArray[$user->userType];
    		if(isset($userStatus))
    		return $userStatus;
    		else
    		return $userArray[0];		
    	}
    }
  	public static function getUserStatus()
    {
    	return array('0'=> 'Normal', '1' => 'Subscribed');
    }

    public static function getProfileCompleteStatus()
    {
    	return array('personal'=>10,'contact'=>10,'physical'=>5,'education'=>10,'habit'=>5,'family'=>5,'partner'=>10,'hobby'=>5,'astro'=>5,'reference'=>5,'documents'=>5,'profile'=>20,'album'=>5);
    }
    
	public static function getUserPrivacySettings($userId)
	{
		$result = Utilities::executeSelectQuery("select * from privacy where userId = {$userId}");
		return $result;
	}
	
	public static function getUserPrivacyStatus($settings,$type)
	{
		if(!empty($settings)){
			$status = '';
			foreach($settings as $item){
				if($item['items'] == $type)
					$status = $item['privacy'];
				else
					continue;
			}
			if($status != '')
			return $status;
			else
			return 'all';
		}else{
			return 'all';
		}
	}
	
	public static function getUserPrivacyRequestStatus($type='album',$senderId=0,$receiverId=0)
	{
		switch($type){
			case 'documents':
			$type = 1;
			break;
			case 'album':
			$type = 2;
			break;
			case 'family':
			$type = 3;
			break;
			case 'astro':
			$type = 4;
			break;
			case 'contact':
			$type = 5;
			break;
			case 'reference':
			$type = 6;
			break;
		}
		
		$result = self::executeSelectQuery("select * from requests where senderId = {$senderId} and receiverId = {$receiverId} and requestType={$type} and status = 1");
		if(!empty($result)){
			return true;
		}else{
			return false;
		}
	}
	
	public static function getRequestType($type = 'album')
	{
		$reqTypes = array('documents' =>1,'album'=>2,'family'=>3,'astro'=>4,'contact'=>5,'reference'=>6);
		return $reqTypes[$type];
	}
    
	public static function getRequestTypeText($typeId = 1)
	{
		$reqTypes = array('1' =>'Documents','2'=>'Album','3'=>'Family Album','4'=>'Astro','5'=>'Contact','6'=>'Reference');
		return $reqTypes[$type];
	}
	
 public static function getNotificationMessage($value){
 	//'album', 'family', 'documents','astro','reference','contact','password','subscribe','recharge','system'
    	switch($value){
    		case 'album':
    		return 'Album has been updated';
    		break;
    		case 'family':
    		return 'Family album has been updated';
    		break;
    		case 'documents':
    		return 'Documents has been updated';
    		break;
    		case 'astro':
    		return 'Astro details has been updated';
    		break;
    		case 'reference':
    		return 'Reference details has been updated';
    		break;
    		case 'contact':
    		return 'Contact details hass been updated';
    		break;
    		case 'password':
    		return 'User password has been changed';
    		break;
    		case 'subscribe':
    		return 'Congrats,You have been subscribed to marrydoor';
    		break;
    		case 'recharge':
    		return 'Congrats,You have recharge succesfully';
    		break;
    		case 'system':
    		return 'Notifications';
    		break;
    		default:
  			return "User profile has been updated";
    	}
    }
	
  
}