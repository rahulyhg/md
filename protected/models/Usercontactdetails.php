<?php

/**
 * This is the model class for table "usercontactdetails".
 *
 * The followings are the available columns in table 'usercontactdetails':
 * @property string $contactDetailsId
 * @property string $userId
 * @property integer $mobileNo
 * @property integer $landLine
 * @property string $alternativeNo
 * @property string $facebookUrl
 * @property string $skypeId
 * @property string $googleIM
 * @property string $yahooIM
 * @property integer $visibility
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Usercontactdetails extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Usercontactdetails the static model class
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
		return 'usercontactdetails';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mobileNo, landLine, visibility', 'numerical', 'integerOnly'=>true),
			array('userId, alternativeNo', 'length', 'max'=>20),
			array('facebookUrl, skypeId, googleIM, yahooIM', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('contactDetailsId, userId, mobileNo, landLine, alternativeNo, facebookUrl, skypeId, googleIM, yahooIM, visibility', 'safe', 'on'=>'search'),
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
			'contactDetailsId' => 'Contact Details',
			'userId' => 'User',
			'mobileNo' => 'Mobile No',
			'landLine' => 'Land Line',
			'alternativeNo' => 'Alternative No',
			'facebookUrl' => 'Facebook Url',
			'skypeId' => 'Skype',
			'googleIM' => 'Google Im',
			'yahooIM' => 'Yahoo Im',
			'visibility' => 'Visibility',
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

		$criteria->compare('contactDetailsId',$this->contactDetailsId,true);
		$criteria->compare('userId',$this->userId,true);
		$criteria->compare('mobileNo',$this->mobileNo);
		$criteria->compare('landLine',$this->landLine);
		$criteria->compare('alternativeNo',$this->alternativeNo,true);
		$criteria->compare('facebookUrl',$this->facebookUrl,true);
		$criteria->compare('skypeId',$this->skypeId,true);
		$criteria->compare('googleIM',$this->googleIM,true);
		$criteria->compare('yahooIM',$this->yahooIM,true);
		$criteria->compare('visibility',$this->visibility);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}