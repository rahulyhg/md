<?php

/**
 * This is the model class for table "userloggeddetails".
 *
 * The followings are the available columns in table 'userloggeddetails':
 * @property string $logId
 * @property string $userId
 * @property string $loggedIn
 * @property string $loggedOut
 * @property integer $profileUpdage
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Userloggeddetails extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Userloggeddetails the static model class
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
		return 'userloggeddetails';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('profileUpdage', 'numerical', 'integerOnly'=>true),
			array('userId', 'length', 'max'=>20),
			array('loggedIn, loggedOut', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('logId, userId, loggedIn, loggedOut, profileUpdage', 'safe', 'on'=>'search'),
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
			'logId' => 'Log',
			'userId' => 'User',
			'loggedIn' => 'Logged In',
			'loggedOut' => 'Logged Out',
			'profileUpdage' => 'Profile Updage',
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

		$criteria->compare('logId',$this->logId,true);
		$criteria->compare('userId',$this->userId,true);
		$criteria->compare('loggedIn',$this->loggedIn,true);
		$criteria->compare('loggedOut',$this->loggedOut,true);
		$criteria->compare('profileUpdage',$this->profileUpdage);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}