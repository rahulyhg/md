<?php

/**
 * This is the model class for table "habit".
 *
 * The followings are the available columns in table 'habit':
 * @property string $habitId
 * @property string $userId
 * @property integer $food
 * @property integer $smoking
 * @property integer $drinking
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Habit extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Habit the static model class
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
		return 'habit';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('food, smoking, drinking', 'numerical', 'integerOnly'=>true),
			array('userId', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('habitId, userId, food, smoking, drinking', 'safe', 'on'=>'search'),
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
			'habitId' => 'Habit',
			'userId' => 'User',
			'food' => 'Food',
			'smoking' => 'Smoking',
			'drinking' => 'Drinking',
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

		$criteria->compare('habitId',$this->habitId,true);
		$criteria->compare('userId',$this->userId,true);
		$criteria->compare('food',$this->food);
		$criteria->compare('smoking',$this->smoking);
		$criteria->compare('drinking',$this->drinking);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}