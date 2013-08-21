<?php

/**
 * This is the model class for table "coupon".
 *
 * The followings are the available columns in table 'coupon':
 * @property string $id
 * @property string $couponCode
 * @property string $creationDate
 * @property string $startDate
 * @property string $endDate
 * @property integer $validity
 * @property integer $status
 * @property integer $isUsed
 * @property string $batchNo
 * @property integer $serialNo
 * @property integer $couponId
 * @property string $couponType
 */
class Coupon extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Coupon the static model class
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
		return 'coupon';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('validity, status, isUsed, serialNo, couponId', 'numerical', 'integerOnly'=>true),
			array('couponCode', 'length', 'max'=>15),
			array('batchNo', 'length', 'max'=>10),
			array('couponType', 'length', 'max'=>6),
			array('creationDate, startDate, endDate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, couponCode, creationDate, startDate, endDate, validity, status, isUsed, batchNo, serialNo, couponId, couponType', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'couponCode' => 'Coupon Code',
			'creationDate' => 'Creation Date',
			'startDate' => 'Start Date',
			'endDate' => 'End Date',
			'validity' => 'Validity',
			'status' => 'Status',
			'isUsed' => 'Is Used',
			'batchNo' => 'Batch No',
			'serialNo' => 'Serial No',
			'couponId' => 'Coupon',
			'couponType' => 'Coupon Type',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('couponCode',$this->couponCode,true);
		$criteria->compare('creationDate',$this->creationDate,true);
		$criteria->compare('startDate',$this->startDate,true);
		$criteria->compare('endDate',$this->endDate,true);
		$criteria->compare('validity',$this->validity);
		$criteria->compare('status',$this->status);
		$criteria->compare('isUsed',$this->isUsed);
		$criteria->compare('batchNo',$this->batchNo,true);
		$criteria->compare('serialNo',$this->serialNo);
		$criteria->compare('couponId',$this->couponId);
		$criteria->compare('couponType',$this->couponType,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}