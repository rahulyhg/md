<?php

/**
 * This is the model class for table "education".
 *
 * The followings are the available columns in table 'education':
 * @property string $edId
 * @property string $userId
 * @property string $educationId
 * @property string $occupationId
 * @property integer $employedIn
 * @property integer $yearlyIncome
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property EducationMaster $education
 * @property OccupationMaster $occupation
 */
class Education extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Education the static model class
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
		return 'education';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('employedIn, yearlyIncome', 'numerical', 'integerOnly'=>true),
			array('userId, educationId, occupationId', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('edId, userId, educationId, occupationId, employedIn, yearlyIncome', 'safe', 'on'=>'search'),
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
			'education' => array(self::BELONGS_TO, 'EducationMaster', 'educationId'),
			'occupation' => array(self::BELONGS_TO, 'OccupationMaster', 'occupationId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'edId' => 'Ed',
			'userId' => 'User',
			'educationId' => 'Education',
			'occupationId' => 'Occupation',
			'employedIn' => 'Employed In',
			'yearlyIncome' => 'Yearly Income',
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

		$criteria->compare('edId',$this->edId,true);
		$criteria->compare('userId',$this->userId,true);
		$criteria->compare('educationId',$this->educationId,true);
		$criteria->compare('occupationId',$this->occupationId,true);
		$criteria->compare('employedIn',$this->employedIn);
		$criteria->compare('yearlyIncome',$this->yearlyIncome);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}