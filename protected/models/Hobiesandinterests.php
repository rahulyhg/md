<?php

/**
 * This is the model class for table "hobiesandinterests".
 *
 * The followings are the available columns in table 'hobiesandinterests':
 * @property string $hobiesId
 * @property string $userId
 * @property string $hobies
 * @property string $interests
 * @property string $musics
 * @property string $reading
 * @property string $movies
 * @property string $activities
 * @property string $cuisine
 * @property string $languages
 * @property string $languageOther
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Hobiesandinterests extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Hobiesandinterests the static model class
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
		return 'hobiesandinterests';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId', 'length', 'max'=>20),
			array('languageOther', 'length', 'max'=>100),
			array('hobies, interests, musics, reading, movies, activities, cuisine, languages', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('hobiesId, userId, hobies, interests, musics, reading, movies, activities, cuisine, languages, languageOther', 'safe', 'on'=>'search'),
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
			'hobiesId' => 'Hobies',
			'userId' => 'User',
			'hobies' => 'Hobies',
			'interests' => 'Interests',
			'musics' => 'Musics',
			'reading' => 'Reading',
			'movies' => 'Movies',
			'activities' => 'Activities',
			'cuisine' => 'Cuisine',
			'languages' => 'Languages',
			'languageOther' => 'Language Other',
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

		$criteria->compare('hobiesId',$this->hobiesId,true);
		$criteria->compare('userId',$this->userId,true);
		$criteria->compare('hobies',$this->hobies,true);
		$criteria->compare('interests',$this->interests,true);
		$criteria->compare('musics',$this->musics,true);
		$criteria->compare('reading',$this->reading,true);
		$criteria->compare('movies',$this->movies,true);
		$criteria->compare('activities',$this->activities,true);
		$criteria->compare('cuisine',$this->cuisine,true);
		$criteria->compare('languages',$this->languages,true);
		$criteria->compare('languageOther',$this->languageOther,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
		public function beforeSave()
        {
                if(parent::beforeSave())
                {
                      if( !empty($this->hobies) || !empty($this->interests) || !empty($this->musics) || !empty($this->movies)
                       || !empty($this->reading) || !empty($this->activities) || !empty($this->cuisine) || !empty($this->languages) || !empty($this->languageOther))
                      return true;
                      else
                      return false;
                }
                else
        		return true;
        }
	
}