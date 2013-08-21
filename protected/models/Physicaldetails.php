<?php

/**
 * This is the model class for table "physicaldetails".
 *
 * The followings are the available columns in table 'physicaldetails':
 * @property string $physicalId
 * @property string $userId
 * @property string $heightId
 * @property integer $weight
 * @property integer $bodyType
 * @property integer $complexion
 * @property integer $physicalStatus
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Physicaldetails extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Physicaldetails the static model class
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
		return 'physicaldetails';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('weight, bodyType, complexion, physicalStatus', 'numerical', 'integerOnly'=>true),
			array('userId, heightId', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('physicalId, userId, heightId, weight, bodyType, complexion, physicalStatus', 'safe', 'on'=>'search'),
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
			'physicalId' => 'Physical',
			'userId' => 'User',
			'heightId' => 'Height',
			'weight' => 'Weight',
			'bodyType' => 'Body Type',
			'complexion' => 'Complexion',
			'physicalStatus' => 'Physical Status',
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

		$criteria->compare('physicalId',$this->physicalId,true);
		$criteria->compare('userId',$this->userId,true);
		$criteria->compare('heightId',$this->heightId,true);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('bodyType',$this->bodyType);
		$criteria->compare('complexion',$this->complexion);
		$criteria->compare('physicalStatus',$this->physicalStatus);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
		public function beforeSave()
        {
                if(parent::beforeSave())
                {
                      if( !empty($this->heightId) || !empty($this->weight) || !empty($this->bodyType) || !empty($this->complexion) || !empty($this->physicalStatus))
                      return true;
                      else
                      return false;
                }
                else
        		return true;
        }
	
}