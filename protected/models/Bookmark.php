<?php

/**
 * This is the model class for table "bookmark".
 *
 * The followings are the available columns in table 'bookmark':
 * @property string $bookMarkId
 * @property string $userID
 * @property string $profileIDs
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Bookmark extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Bookmark the static model class
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
		return 'bookmark';
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
			array('profileIDs', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('bookMarkId, userID, profileIDs', 'safe', 'on'=>'search'),
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
			'bookMarkId' => 'Book Mark',
			'userID' => 'User',
			'profileIDs' => 'Profile Ids',
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

		$criteria->compare('bookMarkId',$this->bookMarkId,true);
		$criteria->compare('userID',$this->userID,true);
		$criteria->compare('profileIDs',$this->profileIDs,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}