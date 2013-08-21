<?php

/**
 * This is the model class for table "profileviews".
 *
 * The followings are the available columns in table 'profileviews':
 * @property string $profileViewId
 * @property string $userID
 * @property string $visitedId
 * @property integer $counter
 * @property string $visitTime
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property Users $visited
 */
class Profileviews extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Profileviews the static model class
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
		return 'profileviews';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('counter', 'numerical', 'integerOnly'=>true),
			array('userID, visitedId', 'length', 'max'=>20),
			array('visitTime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('profileViewId, userID, visitedId, counter, status, visitTime', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'userID'),
			'visited' => array(self::BELONGS_TO, 'Users', 'visitedId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'profileViewId' => 'Profile View',
			'userID' => 'User',
			'visitedId' => 'Visited',
			'counter' => 'Counter',
			'status' => 'Status',
			'visitTime' => 'Visit Time',
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

		$criteria->compare('profileViewId',$this->profileViewId,true);
		$criteria->compare('userID',$this->userID,true);
		$criteria->compare('visitedId',$this->visitedId,true);
		$criteria->compare('counter',$this->counter);
		$criteria->compare('status',$this->status);
		$criteria->compare('visitTime',$this->visitTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}