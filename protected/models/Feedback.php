<?php

/**
 * This is the model class for table "feedback".
 *
 * The followings are the available columns in table 'feedback':
 * @property string $feedId
 * @property string $name
 * @property string $email
 * @property string $message
 * @property string $feedType
 * @property integer $friendliness
 * @property integer $service
 * @property integer $privacy
 * @property integer $payment
 * @property integer $reseller
 */
class Feedback extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Feedback the static model class
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
		return 'feedback';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('friendliness, service, privacy, payment, reseller', 'numerical', 'integerOnly'=>true),
			array('name, email, feedType', 'length', 'max'=>250),
			array('message', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('feedId, name, email, message, feedType, friendliness, service, privacy, payment, reseller', 'safe', 'on'=>'search'),
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
			'feedId' => 'Feed',
			'name' => 'Name',
			'email' => 'Email',
			'message' => 'Message',
			'feedType' => 'Feed Type',
			'friendliness' => 'Friendliness',
			'service' => 'Service',
			'privacy' => 'Privacy',
			'payment' => 'Payment',
			'reseller' => 'Reseller',
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

		$criteria->compare('feedId',$this->feedId,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('feedType',$this->feedType,true);
		$criteria->compare('friendliness',$this->friendliness);
		$criteria->compare('service',$this->service);
		$criteria->compare('privacy',$this->privacy);
		$criteria->compare('payment',$this->payment);
		$criteria->compare('reseller',$this->reseller);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}