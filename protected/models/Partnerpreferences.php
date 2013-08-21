<?php

/**
 * This is the model class for table "partnerpreferences".
 *
 * The followings are the available columns in table 'partnerpreferences':
 * @property string $preferenceId
 * @property string $userId
 * @property integer $ageFrom
 * @property integer $ageTo
 * @property integer $maritalStatus
 * @property integer $haveChildren
 * @property integer $heightFrom
 * @property integer $heightTo
 * @property integer $physicalStatus
 * @property integer $religion
 * @property string $caste
 * @property string $subcaste
 * @property integer $manglik
 * @property integer $dosham
 * @property integer $sudham
 * @property string $star
 * @property string $eatingHabits
 * @property string $drinkingHabits
 * @property string $smokingHabits
 * @property string $languages
 * @property string $countries
 * @property string $states
 * @property string $districts
 * @property string $places
 * @property string $citizenship
 * @property string $occupation
 * @property integer $annualIncome
 * @property string $partnerDescription
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Partnerpreferences extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Partnerpreferences the static model class
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
		return 'partnerpreferences';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ageFrom, ageTo, maritalStatus, haveChildren, heightFrom, heightTo, physicalStatus, religion, manglik, dosham, sudham, annualIncome', 'numerical', 'integerOnly'=>true),
			array('userId', 'length', 'max'=>20),
			array('caste, subcaste, star, eatingHabits, drinkingHabits, smokingHabits, languages, countries, states, districts, places, citizenship, occupation, partnerDescription', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('preferenceId, userId, ageFrom, ageTo, maritalStatus, haveChildren, heightFrom, heightTo, physicalStatus, religion, caste, subcaste, manglik, dosham, sudham, star, eatingHabits, drinkingHabits, smokingHabits, languages, countries, states, districts, places, citizenship, occupation, annualIncome, partnerDescription', 'safe', 'on'=>'search'),
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
			'preferenceId' => 'Preference',
			'userId' => 'User',
			'ageFrom' => 'Age From',
			'ageTo' => 'Age To',
			'maritalStatus' => 'Marital Status',
			'haveChildren' => 'Have Children',
			'heightFrom' => 'Height From',
			'heightTo' => 'Height To',
			'physicalStatus' => 'Physical Status',
			'religion' => 'Religion',
			'caste' => 'Caste',
			'subcaste' => 'Subcaste',
			'manglik' => 'Manglik',
			'dosham' => 'Dosham',
			'sudham' => 'Sudham',
			'star' => 'Star',
			'eatingHabits' => 'Eating Habits',
			'drinkingHabits' => 'Drinking Habits',
			'smokingHabits' => 'Smoking Habits',
			'languages' => 'Languages',
			'countries' => 'Countries',
			'states' => 'States',
			'districts' => 'Districts',
			'places' => 'Places',
			'citizenship' => 'Citizenship',
			'occupation' => 'Occupation',
			'annualIncome' => 'Annual Income',
			'partnerDescription' => 'Partner Description',
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

		$criteria->compare('preferenceId',$this->preferenceId,true);
		$criteria->compare('userId',$this->userId,true);
		$criteria->compare('ageFrom',$this->ageFrom);
		$criteria->compare('ageTo',$this->ageTo);
		$criteria->compare('maritalStatus',$this->maritalStatus);
		$criteria->compare('haveChildren',$this->haveChildren);
		$criteria->compare('heightFrom',$this->heightFrom);
		$criteria->compare('heightTo',$this->heightTo);
		$criteria->compare('physicalStatus',$this->physicalStatus);
		$criteria->compare('religion',$this->religion);
		$criteria->compare('caste',$this->caste,true);
		$criteria->compare('subcaste',$this->subcaste,true);
		$criteria->compare('manglik',$this->manglik);
		$criteria->compare('dosham',$this->dosham);
		$criteria->compare('sudham',$this->sudham);
		$criteria->compare('star',$this->star,true);
		$criteria->compare('eatingHabits',$this->eatingHabits,true);
		$criteria->compare('drinkingHabits',$this->drinkingHabits,true);
		$criteria->compare('smokingHabits',$this->smokingHabits,true);
		$criteria->compare('languages',$this->languages,true);
		$criteria->compare('countries',$this->countries,true);
		$criteria->compare('states',$this->states,true);
		$criteria->compare('districts',$this->districts,true);
		$criteria->compare('places',$this->places,true);
		$criteria->compare('citizenship',$this->citizenship,true);
		$criteria->compare('occupation',$this->occupation,true);
		$criteria->compare('annualIncome',$this->annualIncome);
		$criteria->compare('partnerDescription',$this->partnerDescription,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}