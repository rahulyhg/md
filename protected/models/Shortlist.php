<?php

/**
 * This is the model class for table "shortlist".
 *
 * The followings are the available columns in table 'shortlist':
 * @property string $shortlistId
 * @property string $userID
 * @property string $profileID
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Shortlist extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Shortlist the static model class
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
		return 'shortlist';
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
			array('profileID', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('shortlistId, userID, profileID', 'safe', 'on'=>'search'),
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
			'shortlistId' => 'Shortlist',
			'userID' => 'User',
			'profileID' => 'Profile',
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

		$criteria->compare('shortlistId',$this->shortlistId,true);
		$criteria->compare('userID',$this->userID,true);
		$criteria->compare('profileID',$this->profileID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}