<?php

/**
 * This is the model class for table "view_users".
 *
 * The followings are the available columns in table 'view_users':
 * @property string $userId
 * @property string $marryId
 * @property string $emailId
 * @property string $password
 * @property string $name
 * @property string $dob
 * @property string $gender
 * @property integer $motherTounge
 * @property string $createdOn
 * @property integer $active
 * @property integer $handicapped
 * @property integer $highlighted
 * @property integer $userType
 * @property integer $age
 * @property integer $mobileNo
 * @property integer $landLine
 * @property string $alternativeNo
 * @property string $facebookUrl
 * @property string $skypeId
 * @property string $googleIM
 * @property string $yahooIM
 * @property integer $visibility
 * @property string $casteId
 * @property string $caste
 * @property string $religionId
 * @property string $religion
 * @property string $countryId
 * @property string $country
 * @property string $stateId
 * @property string $state
 * @property string $districtId
 * @property string $district
 * @property string $placeId
 * @property string $place
 * @property string $mobilePhone
 * @property string $landPhone
 * @property integer $intercasteable
 * @property integer $createdBy
 * @property integer $maritalStatus
 * @property string $heightId
 * @property integer $weight
 * @property integer $bodyType
 * @property integer $complexion
 * @property integer $physicalstatus
 * @property string $profileBlocked
 * @property string $userDesc
 * @property integer $dosham
 * @property integer $sudham
 * @property string $horoscope
 * @property integer $food
 * @property integer $smoking
 * @property integer $drinking
 * @property string $languages
 * @property string $photo
 * @property string $educationId
 * @property string $educationName
 * @property string $occupationId
 * @property string $occupationName
 * @property integer $annualIncome
 */
class ViewUsers extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ViewUsers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'view_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('motherTounge, active, handicapped, highlighted, userType, age, mobileNo, landLine, visibility, intercasteable, createdBy, maritalStatus, weight, bodyType, complexion, physicalstatus, dosham, sudham, food, smoking, drinking, annualIncome', 'numerical', 'integerOnly'=>true),
			array('userId, alternativeNo, casteId, religionId, countryId, stateId, districtId, placeId, heightId, educationId, occupationId', 'length', 'max'=>20),
			array('marryId, emailId, password, horoscope, photo', 'length', 'max'=>100),
			array('name, caste, religion, country, state, district, place, educationName, occupationName', 'length', 'max'=>250),
			array('gender', 'length', 'max'=>1),
			array('facebookUrl, skypeId, googleIM, yahooIM', 'length', 'max'=>255),
			array('mobilePhone, landPhone', 'length', 'max'=>15),
			array('dob, createdOn, profileBlocked, userDesc, languages', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userId, marryId, emailId, password, name, dob, gender, motherTounge, createdOn, active, handicapped, highlighted, userType, age, mobileNo, landLine, alternativeNo, facebookUrl, skypeId, googleIM, yahooIM, visibility, casteId, caste, religionId, religion, countryId, country, stateId, state, districtId, district, placeId, place, mobilePhone, landPhone, intercasteable, createdBy, maritalStatus, heightId, weight, bodyType, complexion, physicalstatus, profileBlocked, userDesc, dosham, sudham, horoscope, food, smoking, drinking, languages, photo, educationId, educationName, occupationId, occupationName, annualIncome', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userId' => 'User',
			'marryId' => 'Marry',
			'emailId' => 'Email',
			'password' => 'Password',
			'name' => 'Name',
			'dob' => 'Dob',
			'gender' => 'Gender',
			'motherTounge' => 'Mother Tounge',
			'createdOn' => 'Created On',
			'active' => 'Active',
			'handicapped' => 'Handicapped',
			'highlighted' => 'Highlighted',
			'userType' => 'User Type',
			'age' => 'Age',
			'mobileNo' => 'Mobile No',
			'landLine' => 'Land Line',
			'alternativeNo' => 'Alternative No',
			'facebookUrl' => 'Facebook Url',
			'skypeId' => 'Skype',
			'googleIM' => 'Google Im',
			'yahooIM' => 'Yahoo Im',
			'visibility' => 'Visibility',
			'casteId' => 'Caste',
			'caste' => 'Caste',
			'religionId' => 'Religion',
			'religion' => 'Religion',
			'countryId' => 'Country',
			'country' => 'Country',
			'stateId' => 'State',
			'state' => 'State',
			'districtId' => 'District',
			'district' => 'District',
			'placeId' => 'Place',
			'place' => 'Place',
			'mobilePhone' => 'Mobile Phone',
			'landPhone' => 'Land Phone',
			'intercasteable' => 'Intercasteable',
			'createdBy' => 'Created By',
			'maritalStatus' => 'Marital Status',
			'heightId' => 'Height',
			'weight' => 'Weight',
			'bodyType' => 'Body Type',
			'complexion' => 'Complexion',
			'physicalstatus' => 'Physicalstatus',
			'profileBlocked' => 'Profile Blocked',
			'userDesc' => 'User Desc',
			'dosham' => 'Dosham',
			'sudham' => 'Sudham',
			'horoscope' => 'Horoscope',
			'food' => 'Food',
			'smoking' => 'Smoking',
			'drinking' => 'Drinking',
			'languages' => 'Languages',
			'photo' => 'Photo',
			'educationId' => 'Education',
			'educationName' => 'Education Name',
			'occupationId' => 'Occupation',
			'occupationName' => 'Occupation Name',
			'annualIncome' => 'Annual Income',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('userId',$this->userId,true);
		$criteria->compare('marryId',$this->marryId,true);
		$criteria->compare('emailId',$this->emailId,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('motherTounge',$this->motherTounge);
		$criteria->compare('createdOn',$this->createdOn,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('handicapped',$this->handicapped);
		$criteria->compare('highlighted',$this->highlighted);
		$criteria->compare('userType',$this->userType);
		$criteria->compare('age',$this->age);
		$criteria->compare('mobileNo',$this->mobileNo);
		$criteria->compare('landLine',$this->landLine);
		$criteria->compare('alternativeNo',$this->alternativeNo,true);
		$criteria->compare('facebookUrl',$this->facebookUrl,true);
		$criteria->compare('skypeId',$this->skypeId,true);
		$criteria->compare('googleIM',$this->googleIM,true);
		$criteria->compare('yahooIM',$this->yahooIM,true);
		$criteria->compare('visibility',$this->visibility);
		$criteria->compare('casteId',$this->casteId,true);
		$criteria->compare('caste',$this->caste,true);
		$criteria->compare('religionId',$this->religionId,true);
		$criteria->compare('religion',$this->religion,true);
		$criteria->compare('countryId',$this->countryId,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('stateId',$this->stateId,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('districtId',$this->districtId,true);
		$criteria->compare('district',$this->district,true);
		$criteria->compare('placeId',$this->placeId,true);
		$criteria->compare('place',$this->place,true);
		$criteria->compare('mobilePhone',$this->mobilePhone,true);
		$criteria->compare('landPhone',$this->landPhone,true);
		$criteria->compare('intercasteable',$this->intercasteable);
		$criteria->compare('createdBy',$this->createdBy);
		$criteria->compare('maritalStatus',$this->maritalStatus);
		$criteria->compare('heightId',$this->heightId,true);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('bodyType',$this->bodyType);
		$criteria->compare('complexion',$this->complexion);
		$criteria->compare('physicalstatus',$this->physicalstatus);
		$criteria->compare('profileBlocked',$this->profileBlocked,true);
		$criteria->compare('userDesc',$this->userDesc,true);
		$criteria->compare('dosham',$this->dosham);
		$criteria->compare('sudham',$this->sudham);
		$criteria->compare('horoscope',$this->horoscope,true);
		$criteria->compare('food',$this->food);
		$criteria->compare('smoking',$this->smoking);
		$criteria->compare('drinking',$this->drinking);
		$criteria->compare('languages',$this->languages,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('educationId',$this->educationId,true);
		$criteria->compare('educationName',$this->educationName,true);
		$criteria->compare('occupationId',$this->occupationId,true);
		$criteria->compare('occupationName',$this->occupationName,true);
		$criteria->compare('annualIncome',$this->annualIncome);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}