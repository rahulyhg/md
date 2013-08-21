<?php

/**
 * This is the model class for table "profileupdates".
 *
 * The followings are the available columns in table 'profileupdates':
 * @property string $profileId
 * @property string $userId
 * @property string $profile
 * @property string $status
 * @property string $statusTime
 */
class ProfileUpdates extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProfileUpdates the static model class
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
		return 'profileupdates';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId', 'length', 'max'=>20),
			array('profile', 'length', 'max'=>9),
			array('status, statusTime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('profileId, userId, profile, status, statusTime', 'safe', 'on'=>'search'),
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
			'profileId' => 'Profile',
			'userId' => 'User',
			'profile' => 'Profile',
			'status' => 'Status',
			'statusTime' => 'Status Time',
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

		$criteria->compare('profileId',$this->profileId,true);
		$criteria->compare('userId',$this->userId,true);
		$criteria->compare('profile',$this->profile,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('statusTime',$this->statusTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}