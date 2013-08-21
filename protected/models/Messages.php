<?php

/**
 * This is the model class for table "messages".
 *
 * The followings are the available columns in table 'messages':
 * @property string $messageId
 * @property string $senderId
 * @property string $receiverId
 * @property string $message
 * @property integer $status
 * @property string $sendDate
 * @property integer $senderStatus
 * @property integer $receiverStatus
 *
 * The followings are the available model relations:
 * @property Users $sender
 * @property Users $receiver
 */
class Messages extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Messages the static model class
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
		return 'messages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status, senderStatus, receiverStatus', 'numerical', 'integerOnly'=>true),
			array('senderId, receiverId', 'length', 'max'=>20),
			array('message, sendDate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('messageId, senderId, receiverId, message, status, sendDate, senderStatus, receiverStatus', 'safe', 'on'=>'search'),
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
			'sender' => array(self::BELONGS_TO, 'Users', 'senderId'),
			'receiver' => array(self::BELONGS_TO, 'Users', 'receiverId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'messageId' => 'Message',
			'senderId' => 'Sender',
			'receiverId' => 'Receiver',
			'message' => 'Message',
			'status' => 'Status',
			'sendDate' => 'Send Date',
			'senderStatus' => 'Sender Status',
			'receiverStatus' => 'Receiver Status',
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

		$criteria->compare('messageId',$this->messageId,true);
		$criteria->compare('senderId',$this->senderId,true);
		$criteria->compare('receiverId',$this->receiverId,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('sendDate',$this->sendDate,true);
		$criteria->compare('senderStatus',$this->senderStatus);
		$criteria->compare('receiverStatus',$this->receiverStatus);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}