<?php

/**
 * This is the model class for table "savesearch".
 *
 * The followings are the available columns in table 'savesearch':
 * @property string $id
 * @property string $userId
 * @property string $searchName
 * @property string $gender
 * @property integer $ageFrom
 * @property integer $ageTo
 * @property string $maritalStatus
 * @property integer $heightFrom
 * @property integer $heightTo
 * @property integer $physicalStatus
 * @property integer $religion
 * @property integer $state
 * @property integer $district
 * @property string $occupation
 * @property integer $residentStatus
 * @property string $motherTounge
 * @property string $countries
 * @property string $caste
 * @property string $keyword
 * @property string $education
 * @property integer $annualIncomeFrom
 * @property integer $annualIncomeTo
 * @property string $star
 * @property integer $dosham
 * @property integer $sudham
 * @property string $eating
 * @property string $drinking
 * @property string $smoking
 * @property integer $photo
 * @property integer $horoscope
 * @property string $showTo
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Savesearch extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Savesearch the static model class
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
		return 'savesearch';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ageFrom, ageTo, heightFrom, heightTo, physicalStatus, religion, state, district, residentStatus, annualIncomeFrom, annualIncomeTo, dosham, sudham, photo, horoscope', 'numerical', 'integerOnly'=>true),
			array('userId', 'length', 'max'=>20),
			array('searchName', 'length', 'max'=>100),
			array('gender', 'length', 'max'=>1),
			array('maritalStatus, occupation, motherTounge, countries, caste, keyword, education, star, eating, drinking, smoking, showTo', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userId, searchName, gender, ageFrom, ageTo, maritalStatus, heightFrom, heightTo, physicalStatus, religion, state, district, occupation, residentStatus, motherTounge, countries, caste, keyword, education, annualIncomeFrom, annualIncomeTo, star, dosham, sudham, eating, drinking, smoking, photo, horoscope, showTo', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'userId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'userId' => 'User',
			'searchName' => 'Search Name',
			'gender' => 'Gender',
			'ageFrom' => 'Age From',
			'ageTo' => 'Age To',
			'maritalStatus' => 'Marital Status',
			'heightFrom' => 'Height From',
			'heightTo' => 'Height To',
			'physicalStatus' => 'Physical Status',
			'religion' => 'Religion',
			'state' => 'State',
			'district' => 'District',
			'occupation' => 'Occupation',
			'residentStatus' => 'Resident Status',
			'motherTounge' => 'Mother Tounge',
			'countries' => 'Countries',
			'caste' => 'Caste',
			'keyword' => 'Keyword',
			'education' => 'Education',
			'annualIncomeFrom' => 'Annual Income From',
			'annualIncomeTo' => 'Annual Income To',
			'star' => 'Star',
			'dosham' => 'Dosham',
			'sudham' => 'Sudham',
			'eating' => 'Eating',
			'drinking' => 'Drinking',
			'smoking' => 'Smoking',
			'photo' => 'Photo',
			'horoscope' => 'Horoscope',
			'showTo' => 'Show To',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('userId',$this->userId,true);
		$criteria->compare('searchName',$this->searchName,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('ageFrom',$this->ageFrom);
		$criteria->compare('ageTo',$this->ageTo);
		$criteria->compare('maritalStatus',$this->maritalStatus,true);
		$criteria->compare('heightFrom',$this->heightFrom);
		$criteria->compare('heightTo',$this->heightTo);
		$criteria->compare('physicalStatus',$this->physicalStatus);
		$criteria->compare('religion',$this->religion);
		$criteria->compare('state',$this->state);
		$criteria->compare('district',$this->district);
		$criteria->compare('occupation',$this->occupation,true);
		$criteria->compare('residentStatus',$this->residentStatus);
		$criteria->compare('motherTounge',$this->motherTounge,true);
		$criteria->compare('countries',$this->countries,true);
		$criteria->compare('caste',$this->caste,true);
		$criteria->compare('keyword',$this->keyword,true);
		$criteria->compare('education',$this->education,true);
		$criteria->compare('annualIncomeFrom',$this->annualIncomeFrom);
		$criteria->compare('annualIncomeTo',$this->annualIncomeTo);
		$criteria->compare('star',$this->star,true);
		$criteria->compare('dosham',$this->dosham);
		$criteria->compare('sudham',$this->sudham);
		$criteria->compare('eating',$this->eating,true);
		$criteria->compare('drinking',$this->drinking,true);
		$criteria->compare('smoking',$this->smoking,true);
		$criteria->compare('photo',$this->photo);
		$criteria->compare('horoscope',$this->horoscope);
		$criteria->compare('showTo',$this->showTo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}