<?php

/**
 * This is the model class for table "userpersonaldetails".
 *
 * The followings are the available columns in table 'userpersonaldetails':
 * @property string $personalDetailsId
 * @property string $userId
 * @property string $casteId
 * @property string $religionId
 * @property string $countryId
 * @property string $stateId
 * @property string $districtId
 * @property string $placeId
 * @property string $mobilePhone
 * @property string $landPhone
 * @property integer $intercasteable
 * @property integer $createdBy
 * @property integer $maritalStatus
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property Caste $caste
 * @property Religion $religion
 * @property Country $country
 * @property States $state
 * @property Districts $district
 */
class Userpersonaldetails extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Userpersonaldetails the static model class
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
		return 'userpersonaldetails';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('intercasteable, createdBy, maritalStatus', 'numerical', 'integerOnly'=>true),
			array('userId, casteId, religionId, countryId, stateId, districtId, placeId', 'length', 'max'=>20),
			array('mobilePhone, landPhone', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('personalDetailsId, userId, casteId, religionId, countryId, stateId, districtId, placeId, mobilePhone, landPhone, intercasteable, createdBy, maritalStatus', 'safe', 'on'=>'search'),
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
			'caste' => array(self::BELONGS_TO, 'Caste', 'casteId'),
			'religion' => array(self::BELONGS_TO, 'Religion', 'religionId'),
			'country' => array(self::BELONGS_TO, 'Country', 'countryId'),
			'state' => array(self::BELONGS_TO, 'States', 'stateId'),
			'district' => array(self::BELONGS_TO, 'Districts', 'districtId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'personalDetailsId' => 'Personal Details',
			'userId' => 'User',
			'casteId' => 'Caste',
			'religionId' => 'Religion',
			'countryId' => 'Country',
			'stateId' => 'State',
			'districtId' => 'District',
			'placeId' => 'Place',
			'mobilePhone' => 'Mobile Phone',
			'landPhone' => 'Land Phone',
			'intercasteable' => 'Intercasteable',
			'createdBy' => 'Created By',
			'maritalStatus' => 'Marital Status',
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

		$criteria->compare('personalDetailsId',$this->personalDetailsId,true);
		$criteria->compare('userId',$this->userId,true);
		$criteria->compare('casteId',$this->casteId,true);
		$criteria->compare('religionId',$this->religionId,true);
		$criteria->compare('countryId',$this->countryId,true);
		$criteria->compare('stateId',$this->stateId,true);
		$criteria->compare('districtId',$this->districtId,true);
		$criteria->compare('placeId',$this->placeId,true);
		$criteria->compare('mobilePhone',$this->mobilePhone,true);
		$criteria->compare('landPhone',$this->landPhone,true);
		$criteria->compare('intercasteable',$this->intercasteable);
		$criteria->compare('createdBy',$this->createdBy);
		$criteria->compare('maritalStatus',$this->maritalStatus);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}