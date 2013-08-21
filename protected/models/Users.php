<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $userId
 * @property string $marryId
 * @property string $emailId
 * @property string $password
 * @property string $name
 * @property string $dob
 * @property string $gender
 * @property integer $motherTounge
 * @property string $createdOn
 * @property integer $active
 * @property integer $handicapped
 * @property integer $highlighted
 * @property integer $userType
 *
 * The followings are the available model relations:
 * @property Address[] $addresses
 * @property Documents[] $documents
 * @property Education[] $educations
 * @property Familyprofile[] $familyprofiles
 * @property Habit[] $habits
 * @property Hobiesandinterests[] $hobiesandinterests
 * @property Horoscopes[] $horoscopes
 * @property Partnerpreferences[] $partnerpreferences
 * @property Photos[] $photoses
 * @property Physicaldetails[] $physicaldetails
 * @property Reference[] $references
 * @property Usercontactdetails[] $usercontactdetails
 * @property Userloggeddetails[] $userloggeddetails
 * @property Userpersonaldetails[] $userpersonaldetails
 */
class Users extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
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
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('motherTounge, active, handicapped, highlighted, userType', 'numerical', 'integerOnly'=>true),
			array('marryId, emailId, password', 'length', 'max'=>100),
			array('name', 'length', 'max'=>250),
			array('gender', 'length', 'max'=>1),
			array('dob, createdOn', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userId, marryId, emailId, password, name, dob, gender, motherTounge, createdOn, active, handicapped, highlighted, userType', 'safe', 'on'=>'search'),
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
			'addresses' => array(self::HAS_MANY, 'Address', 'userId'),
			'documents' => array(self::HAS_MANY, 'Documents', 'userId'),
			'educations' => array(self::HAS_ONE, 'Education', 'userId'),
			'familyprofiles' => array(self::HAS_ONE, 'Familyprofile', 'userId'),
			'habits' => array(self::HAS_ONE, 'Habit', 'userId'),
			'hobies' => array(self::HAS_ONE, 'Hobiesandinterests', 'userId'),
			'horoscopes' => array(self::HAS_ONE, 'Horoscopes', 'userId'),
			'partnerpreferences' => array(self::HAS_ONE, 'Partnerpreferences', 'userId'),
			'photos' => array(self::HAS_MANY, 'Photos', 'userId'),
			'physicaldetails' => array(self::HAS_ONE, 'Physicaldetails', 'userId'),
			'references' => array(self::HAS_MANY, 'Reference', 'userId'),
			'usercontactdetails' => array(self::HAS_ONE, 'Usercontactdetails', 'userId'),
			'userloggeddetails' => array(self::HAS_MANY, 'Userloggeddetails', 'userId'),
			'userpersonaldetails' => array(self::HAS_ONE, 'Userpersonaldetails', 'userId'),
			'messageSender' => array(self::HAS_MANY, 'Messages', 'senderId'),
			'messageReceiver' => array(self::HAS_MANY, 'Messages', 'receiverId'),
			'interestSender' => array(self::HAS_MANY, 'Interests', 'senderId'),
			'interestReceiver' => array(self::HAS_MANY, 'Interests', 'receiverId'),
			'albumSender' => array(self::HAS_MANY, 'Albumrequest', 'senderId'),
			'albumReceiver' => array(self::HAS_MANY, 'Albumrequest', 'receiverId'),
			'familyAlbumSender' => array(self::HAS_MANY, 'FamilyAlbum', 'senderId'),
			'familyAlbumReceiver' => array(self::HAS_MANY, 'FamilyAlbum', 'receiverId'),
			'documentSender' => array(self::HAS_MANY, 'DocumentRequest', 'senderId'),
			'documentReceiver' => array(self::HAS_MANY, 'DocumentRequest', 'receiverId'),
			'contactSender' => array(self::HAS_MANY, 'ContactRequest', 'senderId'),
			'contactReceiver' => array(self::HAS_MANY, 'ContactRequest', 'receiverId'),
			'privacy' => array(self::HAS_MANY, 'Privacy', 'userId'),
			'profileUser' => array(self::HAS_MANY, 'Profileviews', 'userID'),
			'shortlist' => array(self::HAS_ONE, 'Shortlist', 'userID'),
			'search' => array(self::HAS_ONE, 'Search', 'userId'),
			'payment' => array(self::HAS_MANY, 'Payment', 'userID'),
			'bookmark' => array(self::HAS_ONE, 'Bookmark', 'userID'),
			'addressBook' => array(self::HAS_ONE, 'Addressbook', 'userID'),
			'album' => array(self::HAS_MANY, 'Album', 'userId'),
			'profileUpdates' => array(self::HAS_ONE, 'Profileupdates', 'userId'),
			'profileBlock' => array(self::HAS_ONE, 'Profileblock', 'userId'),
			'saveSearch' => array(self::HAS_ONE, 'Savesearch', 'userId'),
			'requestSender' => array(self::HAS_MANY, 'Requests', 'senderId'),
			'requestReceiver' => array(self::HAS_MANY, 'Requests', 'receiverId'),
			'notification' => array(self::HAS_MANY, 'Notifications', 'userId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userId' => 'User',
			'marryId' => 'Marry',
			'emailId' => 'Email',
			'password' => 'Password',
			'name' => 'Name',
			'dob' => 'Dob',
			'gender' => 'Gender',
			'motherTounge' => 'Mother Tounge',
			'createdOn' => 'Created On',
			'active' => 'Active',
			'handicapped' => 'Handicapped',
			'highlighted' => 'Highlighted',
			'userType' => 'User Type',
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

		$criteria->compare('userId',$this->userId,true);
		$criteria->compare('marryId',$this->marryId,true);
		$criteria->compare('emailId',$this->emailId,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('motherTounge',$this->motherTounge);
		$criteria->compare('createdOn',$this->createdOn,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('handicapped',$this->handicapped);
		$criteria->compare('highlighted',$this->highlighted);
		$criteria->compare('userType',$this->userType);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}