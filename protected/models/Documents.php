<?php

/**
 * This is the model class for table "documents".
 *
 * The followings are the available columns in table 'documents':
 * @property string $documentId
 * @property string $userId
 * @property string $documentName
 * @property integer $documentType
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Documents extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Documents the static model class
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
		return 'documents';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('documentType', 'numerical', 'integerOnly'=>true),
			array('userId', 'length', 'max'=>20),
			array('documentName', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('documentId, userId, documentName, documentType', 'safe', 'on'=>'search'),
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
			'documentId' => 'Document',
			'userId' => 'User',
			'documentName' => 'Document Name',
			'documentType' => 'Document Type',
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

		$criteria->compare('documentId',$this->documentId,true);
		$criteria->compare('userId',$this->userId,true);
		$criteria->compare('documentName',$this->documentName,true);
		$criteria->compare('documentType',$this->documentType);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}