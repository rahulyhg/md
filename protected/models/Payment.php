<?php

/**
 * This is the model class for table "payment".
 *
 * The followings are the available columns in table 'payment':
 * @property string $paymentId
 * @property string $userID
 * @property string $couponcode
 * @property string $startdate
 * @property string $actionItem
 * @property string $createdate
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Payment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Payment the static model class
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
		return 'payment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userID', 'length', 'max'=>20),
			array('couponcode', 'length', 'max'=>15),
			array('actionItem', 'length', 'max'=>10),
			array('startdate, createdate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('paymentId, userID, couponcode, startdate, actionItem, createdate', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'paymentId' => 'Payment',
			'userID' => 'User',
			'couponcode' => 'Couponcode',
			'startdate' => 'Startdate',
			'actionItem' => 'Action Item',
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

		$criteria->compare('paymentId',$this->paymentId,true);
		$criteria->compare('userID',$this->userID,true);
		$criteria->compare('couponcode',$this->couponcode,true);
		$criteria->compare('startdate',$this->startdate,true);
		$criteria->compare('actionItem',$this->actionItem,true);
		$criteria->compare('createdate',$this->createdate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}