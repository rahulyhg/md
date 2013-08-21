<?php

/**
 * This is the model class for table "familyprofile".
 *
 * The followings are the available columns in table 'familyprofile':
 * @property string $familyProfileID
 * @property string $userId
 * @property integer $familyStatus
 * @property integer $familyType
 * @property integer $familyValues
 * @property integer $brothers
 * @property integer $sisters
 * @property integer $brotherMarried
 * @property integer $SisterMarried
 * @property string $familyPic
 * @property integer $visibility
 * @property string $familyDesc
 * @property string $userDesc
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Familyprofile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Familyprofile the static model class
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
		return 'familyprofile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('familyStatus, familyType, familyValues, brothers, sisters, brotherMarried, SisterMarried, visibility', 'numerical', 'integerOnly'=>true),
			array('userId', 'length', 'max'=>20),
			array('familyPic', 'length', 'max'=>255),
			array('familyDesc, userDesc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('familyProfileID, userId, familyStatus, familyType, familyValues, brothers, sisters, brotherMarried, SisterMarried, familyPic, visibility, familyDesc, userDesc', 'safe', 'on'=>'search'),
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
			'familyProfileID' => 'Family Profile',
			'userId' => 'User',
			'familyStatus' => 'Family Status',
			'familyType' => 'Family Type',
			'familyValues' => 'Family Values',
			'brothers' => 'Brothers',
			'sisters' => 'Sisters',
			'brotherMarried' => 'Brother Married',
			'SisterMarried' => 'Sister Married',
			'familyPic' => 'Family Pic',
			'visibility' => 'Visibility',
			'familyDesc' => 'Family Desc',
			'userDesc' => 'User Desc',
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

		$criteria->compare('familyProfileID',$this->familyProfileID,true);
		$criteria->compare('userId',$this->userId,true);
		$criteria->compare('familyStatus',$this->familyStatus);
		$criteria->compare('familyType',$this->familyType);
		$criteria->compare('familyValues',$this->familyValues);
		$criteria->compare('brothers',$this->brothers);
		$criteria->compare('sisters',$this->sisters);
		$criteria->compare('brotherMarried',$this->brotherMarried);
		$criteria->compare('SisterMarried',$this->SisterMarried);
		$criteria->compare('familyPic',$this->familyPic,true);
		$criteria->compare('visibility',$this->visibility);
		$criteria->compare('familyDesc',$this->familyDesc,true);
		$criteria->compare('userDesc',$this->userDesc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
		public function beforeSave()
        {
                if(parent::beforeSave())
                {
                      if( !empty($this->familyStatus) || !empty($this->familyType) || !empty($this->familyValues) || !empty($this->familyDesc)|| !empty($this->userDesc) || !empty($this->brotherMarried) || !empty($this->brothers)|| !empty($this->SisterMarried) || !empty($this->sisters))
                      return true;
                      else
                      return false;
                      
                      
                }
                else
        		return true;
        }
	
}