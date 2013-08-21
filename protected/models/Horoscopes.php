<?php

/**
 * This is the model class for table "horoscopes".
 *
 * The followings are the available columns in table 'horoscopes':
 * @property string $horoscopeId
 * @property string $userId
 * @property integer $sign
 * @property string $time
 * @property integer $astrodate
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $horoscopeFile
 * @property string $grahanilaFile
 * @property integer $visibility
 * @property integer $dosham
 * @property integer $sudham
 * @property integer $motherTounge
 * @property string $dob
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Horoscopes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Horoscopes the static model class
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
		return 'horoscopes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sign, astrodate, visibility, dosham, sudham, motherTounge', 'numerical', 'integerOnly'=>true),
			array('userId', 'length', 'max'=>20),
			array('time, country, state, city, dob', 'length', 'max'=>250),
			array('horoscopeFile, grahanilaFile', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('horoscopeId, userId, sign, time, astrodate, country, state, city, horoscopeFile, grahanilaFile, visibility, dosham, sudham, motherTounge, dob', 'safe', 'on'=>'search'),
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
			'horoscopeId' => 'Horoscope',
			'userId' => 'User',
			'sign' => 'Sign',
			'time' => 'Time',
			'astrodate' => 'Astrodate',
			'country' => 'Country',
			'state' => 'State',
			'city' => 'City',
			'horoscopeFile' => 'Horoscope File',
			'grahanilaFile' => 'Grahanila File',
			'visibility' => 'Visibility',
			'dosham' => 'Dosham',
			'sudham' => 'Sudham',
			'motherTounge' => 'Mother Tounge',
			'dob' => 'Dob',
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

		$criteria->compare('horoscopeId',$this->horoscopeId,true);
		$criteria->compare('userId',$this->userId,true);
		$criteria->compare('sign',$this->sign);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('astrodate',$this->astrodate);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('horoscopeFile',$this->horoscopeFile,true);
		$criteria->compare('grahanilaFile',$this->grahanilaFile,true);
		$criteria->compare('visibility',$this->visibility);
		$criteria->compare('dosham',$this->dosham);
		$criteria->compare('sudham',$this->sudham);
		$criteria->compare('motherTounge',$this->motherTounge);
		$criteria->compare('dob',$this->dob,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}