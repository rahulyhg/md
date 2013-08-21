<?php

/**
 * This is the model class for table "delete_feedback".
 *
 * The followings are the available columns in table 'delete_feedback':
 * @property string $id
 * @property string $userId
 * @property integer $married
 * @property integer $service
 * @property integer $engaged
 * @property integer $other
 * @property integer $useful
 * @property integer $compromised
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class DeleteFeedback extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DeleteFeedback the static model class
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
		return 'delete_feedback';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('married, service, engaged, other, useful, compromised', 'numerical', 'integerOnly'=>true),
			array('userId', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userId, married, service, engaged, other, useful, compromised', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'userId' => 'User',
			'married' => 'Married',
			'service' => 'Service',
			'engaged' => 'Engaged',
			'other' => 'Other',
			'useful' => 'Useful',
			'compromised' => 'Compromised',
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
		$criteria->compare('userId',$this->userId,true);
		$criteria->compare('married',$this->married);
		$criteria->compare('service',$this->service);
		$criteria->compare('engaged',$this->engaged);
		$criteria->compare('other',$this->other);
		$criteria->compare('useful',$this->useful);
		$criteria->compare('compromised',$this->compromised);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}