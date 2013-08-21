<?php

/**
 * This is the model class for table "reference".
 *
 * The followings are the available columns in table 'reference':
 * @property string $referenceId
 * @property string $userId
 * @property string $relation
 * @property string $referName
 * @property string $referHouseName
 * @property string $referPlace
 * @property string $referCity
 * @property string $referState
 * @property integer $referPostcode
 * @property string $referPostOffice
 * @property string $referDistrict
 * @property string $referCountry
 * @property string $referEmail
 * @property string $referOccupation
 * @property integer $referCallFrom
 * @property integer $referCallTo
 * @property string $referCallTime
 * @property integer $visibility
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Reference extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Reference the static model class
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
		return 'reference';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('referenceId, userId, relation, referName, referHouseName, referPlace, referCity, referState, referPostcode, referPostOffice, referDistrict, referCountry, referEmail, referOccupation, referCallFrom, referCallTo, referCallTime, visibility', 'safe', 'on'=>'search'),
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
			'referenceId' => 'Reference',
			'userId' => 'User',
			'relation' => 'Relation',
			'referName' => 'Refer Name',
			'referHouseName' => 'Refer House Name',
			'referPlace' => 'Refer Place',
			'referCity' => 'Refer City',
			'referState' => 'Refer State',
			'referPostcode' => 'Refer Postcode',
			'referPostOffice' => 'Refer Post Office',
			'referDistrict' => 'Refer District',
			'referCountry' => 'Refer Country',
			'referEmail' => 'Refer Email',
			'referOccupation' => 'Refer Occupation',
			'referCallFrom' => 'Refer Call From',
			'referCallTo' => 'Refer Call To',
			'referCallTime' => 'Refer Call Time',
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

		$criteria->compare('referenceId',$this->referenceId,true);
		$criteria->compare('userId',$this->userId,true);
		$criteria->compare('relation',$this->relation,true);
		$criteria->compare('referName',$this->referName,true);
		$criteria->compare('referHouseName',$this->referHouseName,true);
		$criteria->compare('referPlace',$this->referPlace,true);
		$criteria->compare('referCity',$this->referCity,true);
		$criteria->compare('referState',$this->referState,true);
		$criteria->compare('referPostcode',$this->referPostcode);
		$criteria->compare('referPostOffice',$this->referPostOffice,true);
		$criteria->compare('referDistrict',$this->referDistrict,true);
		$criteria->compare('referCountry',$this->referCountry,true);
		$criteria->compare('referEmail',$this->referEmail,true);
		$criteria->compare('referOccupation',$this->referOccupation,true);
		$criteria->compare('referCallFrom',$this->referCallFrom);
		$criteria->compare('referCallTo',$this->referCallTo);
		$criteria->compare('referCallTime',$this->referCallTime,true);
		$criteria->compare('visibility',$this->visibility);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
}