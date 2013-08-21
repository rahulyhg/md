<?php

/**
 * This is the model class for table "notifications".
 *
 * The followings are the available columns in table 'notifications':
 * @property string $notificationId
 * @property string $userId
 * @property string $name
 * @property string $marryId
 * @property string $notification
 * @property string $notificationType
 * @property integer $status
 * @property string $createdate
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Notifications extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Notifications the static model class
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
		return 'notifications';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status', 'numerical', 'integerOnly'=>true),
			array('userId', 'length', 'max'=>20),
			array('name', 'length', 'max'=>250),
			array('marryId', 'length', 'max'=>100),
			array('notificationType', 'length', 'max'=>9),
			array('notification, createdate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('notificationId, userId, name, marryId, notification, notificationType, status, createdate', 'safe', 'on'=>'search'),
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
			'notificationId' => 'Notification',
			'userId' => 'User',
			'name' => 'Name',
			'marryId' => 'Marry',
			'notification' => 'Notification',
			'notificationType' => 'Notification Type',
			'status' => 'Status',
			'createdate' => 'Createdate',
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

		$criteria->compare('notificationId',$this->notificationId,true);
		$criteria->compare('userId',$this->userId,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('marryId',$this->marryId,true);
		$criteria->compare('notification',$this->notification,true);
		$criteria->compare('notificationType',$this->notificationType,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('createdate',$this->createdate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}