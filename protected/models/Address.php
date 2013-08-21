<?php

/**
 * This is the model class for table "address".
 *
 * The followings are the available columns in table 'address':
 * @property string $addressId
 * @property string $userId
 * @property string $houseName
 * @property string $place
 * @property string $city
 * @property string $postoffice
 * @property string $district
 * @property string $state
 * @property string $country
 * @property integer $pincode
 * @property integer $addresType
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Address extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Address the static model class
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
		return 'address';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pincode, addresType', 'numerical', 'integerOnly'=>true),
			array('userId', 'length', 'max'=>20),
			array('houseName, place, city, postoffice, district, state, country', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('addressId, userId, houseName, place, city, postoffice, district, state, country, pincode, addresType', 'safe', 'on'=>'search'),
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
			'addressId' => 'Address',
			'userId' => 'User',
			'houseName' => 'House Name',
			'place' => 'Place',
			'city' => 'City',
			'postoffice' => 'Postoffice',
			'district' => 'District',
			'state' => 'State',
			'country' => 'Country',
			'pincode' => 'Pincode',
			'addresType' => 'Addres Type',
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

		$criteria->compare('addressId',$this->addressId,true);
		$criteria->compare('userId',$this->userId,true);
		$criteria->compare('houseName',$this->houseName,true);
		$criteria->compare('place',$this->place,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('postoffice',$this->postoffice,true);
		$criteria->compare('district',$this->district,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('pincode',$this->pincode);
		$criteria->compare('addresType',$this->addresType);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
		public function beforeSave()
        {
                if(parent::beforeSave())
                {
                      if( !empty($this->houseName) || !empty($this->place) || !empty($this->city) || !empty($this->postoffice) || !empty($this->district) || !empty($this->pincode) || !empty($this->state)|| !empty($this->country))
                      return true;
                      else
                      return false;
                      
                      
                }
                else
        		return true;
        }
}